package com.example.passwordencrypt.service;

import org.springframework.stereotype.Service;
import com.example.passwordencrypt.repository.UserRepository;
import com.example.passwordencrypt.model.User;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;

import java.util.Map;
import java.util.HashMap;

@Service
public class AuthService {

    private final UserRepository repo;
    private final BCryptPasswordEncoder encoder;

    public AuthService(UserRepository repo, BCryptPasswordEncoder encoder) {
        this.repo = repo;
        this.encoder = encoder;
    }

    public Map<String, String> register(User user) {
        String hashed = encoder.encode(user.getPassword());
        user.setPassword(hashed);
        repo.save(user);
        Map<String, String> response = new HashMap<>();
        response.put("message", "User registered successfully");
        response.put("hashed_password", hashed);
        return response;
    }

    public String login(String username, String password) {
        User user = repo.findByUsername(username);

        if (user == null) {
            return "User not found";
        }

        if (encoder.matches(password, user.getPassword())) {
            return "Login successful";
        } else {
            return "Invalid password";
        }
    }
}