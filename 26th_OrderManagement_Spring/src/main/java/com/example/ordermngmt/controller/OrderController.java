package com.example.ordermngmt.controller;

import org.springframework.web.bind.annotation.*;
import java.util.List;

import com.example.ordermngmt.model.Order;
import com.example.ordermngmt.repository.OrderRepository;

@RestController
@RequestMapping("/api/orders")
@CrossOrigin
public class OrderController {

    private final OrderRepository repo;

    public OrderController(OrderRepository repo) {
        this.repo = repo;
    }

    // post
    @PostMapping
    public Order create(@RequestBody Order o) {
        return repo.save(o);
    }

    // get
    @GetMapping
    public List<Order> getAll() {
        return repo.findAll();
    }

    // get/{id}
    @GetMapping("/{id}")
    public Order getOne(@PathVariable Long id) {
        return repo.findById(id).orElseThrow();
    }

    // put/{id}
    @PutMapping("/{id}")
    public Order update(@PathVariable Long id, @RequestBody Order updated) {
        Order o = repo.findById(id).orElseThrow();

        o.setCustomerName(updated.getCustomerName());
        o.setProduct(updated.getProduct());
        o.setQuantity(updated.getQuantity());
        o.setPrice(updated.getPrice());

        return repo.save(o);
    }

    // delete/{id}
    @DeleteMapping("/{id}")
    public void delete(@PathVariable Long id) {
        repo.deleteById(id);
    }
}