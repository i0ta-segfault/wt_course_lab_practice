There are 2 folders : ```backend``` and ```frontend```

IMPORTANT - create a db in mysql named ```book_db```

Assuming mysql compass runs the mysql service on port 3306, if not make changes to ```application.properties``` in ```src/main/resources```

```backend``` has Spring API setup for login register books post get put delete
run ```backend``` by doing mvn 
```cmd
spring-boot:run
```

```frontend``` has html css files for frontend, from browser open ```index.html```
```index.html``` is home page where all books are visible
```register.html``` is where you register
```login.html``` is where you login from. Will be redirected to ```catalog.html```
```catalog.html``` lets you add delete and edit books

once added books in catalog revisit home page to notice changes

in ```login.html``` we store a simple flag in ```localstorage``` to check login
to check ```localstorage``` head to browser's ```storage``` tab in ```Inspect``` window