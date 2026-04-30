package com.example.passwordencrypt.controller;

import org.springframework.web.bind.annotation.*;
import com.example.passwordencrypt.service.AuthService;
import com.example.passwordencrypt.model.User;

import java.util.Map;
import java.util.HashMap;

@RestController
@RequestMapping("/api/auth")
@CrossOrigin
public class AuthController {

    private final AuthService service;

    public AuthController(AuthService service) {
        this.service = service;
    }

    @PostMapping("/register")
    public Map<String, String> register(@RequestBody User user) {
        return service.register(user);
    }

    @PostMapping("/login")
    public String login(@RequestBody User user) {
        return service.login(user.getUsername(), user.getPassword());
    }
}