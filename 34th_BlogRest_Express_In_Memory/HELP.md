# In memory storage no db used



to make a post

# POST
```http://localhost:3000/posts```
Payload body - 
```json
{
  "title": "My Blog",
  "content": "Hello world"
}
```
---

# GET
```http://localhost:3000/posts```
No payload body 

---

# GET one
```http://localhost:3000/posts/{id}``` -> ```http://localhost:3000/posts/1```
No payload body 

---

# PUT
```http://localhost:3000/posts/{id}``` -> ```http://localhost:3000/posts/1```
Payload body - 
```json
{
  "title": "My new Blog",
  "content": "Welcome world"
}
```
---

# DELETE
```http://localhost:3000/posts/{id}``` -> ```http://localhost:3000/posts/1```
No payload body 