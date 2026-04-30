# In memory storage no db used



to make a post

# POST
```http://localhost:3000/tasks```
Payload body - 
```json
{
  "title": "Get curd"
}
```
---

# GET
```http://localhost:3000/tasks```
No payload body 

---

# PUT
```http://localhost:3000/tasks/{id}``` -> ```http://localhost:3000/tasks/1```
Payload body - 
```json
{
  "status": "completed"
}
```

OR

Payload body - 
```json
{
  "status": "pending"
}
```
---

# DELETE
```http://localhost:3000/tasks/{id}``` -> ```http://localhost:3000/tasks/1```
No payload body 