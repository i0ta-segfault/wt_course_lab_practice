package com.example.multiplelogin.repository;

import org.springframework.data.mongodb.repository.MongoRepository;
import com.example.multiplelogin.model.User;

public interface UserRepository extends MongoRepository<User, String> {
    User findByUsername(String username);
}