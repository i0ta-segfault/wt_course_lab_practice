In Postman choose Basic Auth (username: admin, password: admin123)

Assuming mongo compass runs the mongo service on port 27017, if not make changes to ```application.properties``` in ```src/main/resources```

## POST
```http://localhost:8080/products```
payload body :
```json
{
  "name": "",
  "price": 0,
  "quantity": 0
}
```


---

## GET
```http://localhost:8080/products```
no payload body

---

## PUT
```http://localhost:8080/products/{id}```
payload body :
```json
{
  "name": "",
  "price": 0,
  "quantity": 0
}
```

---

## DELETE
```http://localhost:8080/products/{id}```
no payload body


