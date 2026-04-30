run ```node seed.js``` to populate db
run ```node server.js``` to run REST API server

## POST
```http://localhost:3000/books```
payload body :
```json
{
  "title": "Clean Code",
  "author": "Robert Martin",
  "year": 2008
}
```


---

## GET
```http://localhost:3000/books```
no payload body

---

## PUT
```http://localhost:3000/students/{id}```
payload body :
```json
{
  "name": "",
  "email": "",
  "course": ""
}
```

---

## DELETE
```http://localhost:3000/students/{id}```
no payload body


