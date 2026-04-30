package com.example.passwordencrypt.repository;

import org.springframework.data.mongodb.repository.MongoRepository;
import com.example.passwordencrypt.model.User;

public interface UserRepository extends MongoRepository<User, String> {
    User findByUsername(String username);
}