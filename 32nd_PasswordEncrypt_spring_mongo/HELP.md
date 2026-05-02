Assuming mongo compass runs the mongo service on port 27017, if not make changes to ```application.properties``` in ```src/main/resources```

POST
```http://localhost:8080/api/auth/register```
Payload body - 
```json
{
  "username": "r",
  "password": "123"
}
```
will return bcrypt hashed password stored in db and success message
---

POST
```http://localhost:8080/api/auth/login```
Payload body - 
```json
{
  "username": "r",
  "password": "123"
}
```
wrong password will flag as Invalid password
wrong username will flag as User not found
---