package com.example.ordermngmt.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.ordermngmt.model.Order;

public interface OrderRepository extends JpaRepository<Order, Long> {
}