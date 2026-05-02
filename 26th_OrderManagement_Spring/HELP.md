Assuming mysql compass runs the mysql service on port 3306, if not make changes to ```application.properties``` in ```src/main/resources```

Create mysql database named ```order_db```

REST API endpoints


# POST
```http://localhost:8080/api/orders```

payload body :

```json
{
  "customerName": "R",
  "product": "Laptop",
  "quantity": 1,
  "price": 70000
}
```


---

# GET
```http://localhost:8080/api/orders```

no payload body

---

# GET by id
```http://localhost:8080/api/orders/{id}``` eg: ```http://localhost:8080/api/orders/1```

no payload body

---

# PUT by id
```http://localhost:8080/api/orders/{id}``` eg: ```http://localhost:8080/api/orders/1```

payload body :

```json
{
  "customerName": "S",
  "product": "Phone",
  "quantity": 1,
  "price": 7000
}
```


---

# DELETE by id
```http://localhost:8080/api/orders/{id}``` eg: ```http://localhost:8080/api/orders/1```

no payload body