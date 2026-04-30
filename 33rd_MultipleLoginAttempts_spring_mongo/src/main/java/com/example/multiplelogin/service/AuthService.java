package com.example.multiplelogin.service;

import org.springframework.stereotype.Service;
import com.example.multiplelogin.repository.UserRepository;
import com.example.multiplelogin.model.User;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;

import java.util.Map;
import java.util.HashMap;

@Service
public class AuthService {

    private final UserRepository repo;
    private final BCryptPasswordEncoder encoder;

    private static final int MAX_ATTEMPTS = 3;
    private static final long LOCK_TIME = 60 * 1000; // a minute of lock time

    public AuthService(UserRepository repo, BCryptPasswordEncoder encoder) {
        this.repo = repo;
        this.encoder = encoder;
    }

    public Map<String, String> register(User user) {

        String hashed = encoder.encode(user.getPassword());

        user.setPassword(hashed);
        user.setFailedAttempts(0);
        user.setAccountLocked(false);

        repo.save(user);

        Map<String, String> res = new HashMap<>();
        res.put("message", "User registered successfully");
        res.put("hashed_password", hashed);

        return res;
    }

    public String login(String username, String password) {
        User user = repo.findByUsername(username);
        if (user == null) return "User not found";

        // is account locked?
        if (user.isAccountLocked()) {

            long unlockTime = user.getLockTime() + LOCK_TIME;

            if (System.currentTimeMillis() < unlockTime) {
                return "Account locked. Try later.";
            } 
            else {
                // unlock account
                user.setAccountLocked(false);
                user.setFailedAttempts(0);
                repo.save(user);
            }
        }

        // correct password
        if (encoder.matches(password, user.getPassword())) {
            user.setFailedAttempts(0);
            repo.save(user);
            return "Login successful";
        }

        // incorrect password
        user.setFailedAttempts(user.getFailedAttempts() + 1);

        if (user.getFailedAttempts() >= MAX_ATTEMPTS) {
            user.setAccountLocked(true);
            user.setLockTime(System.currentTimeMillis());
            repo.save(user);
            return "Account locked due to multiple failed attempts";
        }

        repo.save(user);
        return "Invalid password (" + user.getFailedAttempts() + " attempts)";
    }
}