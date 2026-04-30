package com.example.bookstore.controller;

import org.springframework.web.bind.annotation.*;
import java.util.List;
import com.example.bookstore.repository.BookRepository;
import com.example.bookstore.model.Book;

@RestController
@RequestMapping("/api/books")
@CrossOrigin
public class BookController {

    private final BookRepository repo;

    public BookController(BookRepository repo) {
        this.repo = repo;
    }

    @GetMapping
    public List<Book> getAll() {
        return repo.findAll();
    }

    @PostMapping
    public Book add(@RequestBody Book b) {
        return repo.save(b);
    }

    @PutMapping("/{id}")
    public Book update(@PathVariable int id, @RequestBody Book updated) {
        Book b = repo.findById(id).orElseThrow();
        b.setTitle(updated.getTitle());
        b.setAuthor(updated.getAuthor());
        b.setPrice(updated.getPrice());
        return repo.save(b);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable int id) {
        repo.deleteById(id);
    }
}