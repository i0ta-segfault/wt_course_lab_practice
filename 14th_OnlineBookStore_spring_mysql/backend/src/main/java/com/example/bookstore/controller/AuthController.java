package com.example.bookstore.controller;

import org.springframework.web.bind.annotation.*;
import com.example.bookstore.repository.UserRepository;
import com.example.bookstore.model.User;

@RestController
@RequestMapping("/api/auth")
@CrossOrigin
public class AuthController {

    private final UserRepository repo;

    public AuthController(UserRepository repo) {
        this.repo = repo;
    }

    // register user
    @PostMapping("/register")
    public String register(@RequestBody User user) {

        if (repo.findByUsername(user.getUsername()) != null) {
            return "Username already exists";
        }

        repo.save(user);
        return "Registered successfully";
    }

    // login user
    @PostMapping("/login")
    public String login(@RequestBody User user) {

        User existing = repo.findByUsername(user.getUsername());

        if (existing == null) {
            return "User not found";
        }

        if (!existing.getPassword().equals(user.getPassword())) {
            return "Wrong password";
        }

        return "Login successful";
    }
}