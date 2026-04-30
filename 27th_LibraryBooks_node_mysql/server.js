const express = require("express");
const cors = require("cors");
const db = require("./db");

const app = express();

app.use(cors());
app.use(express.json());

// post
app.post("/books", (req, res) => {
  const { title, author, year } = req.body;

  db.query(
    "INSERT INTO books (title, author, year) VALUES (?, ?, ?)",
    [title, author, year],
    (err) => {
      if (err) return res.status(500).send(err);
      res.send("Book added");
    }
  );
});

// get
app.get("/books", (req, res) => {
  db.query("SELECT * FROM books", (err, result) => {
    if (err) return res.status(500).send(err);
    res.json(result);
  });
});

// put/{id}
app.put("/books/:id", (req, res) => {
  const { id } = req.params;
  const { title, author, year } = req.body;

  db.query(
    "UPDATE books SET title=?, author=?, year=? WHERE book_id=?",
    [title, author, year, id],
    (err) => {
      if (err) return res.status(500).send(err);
      res.send("Book updated");
    }
  );
});

// delete/{id}
app.delete("/books/:id", (req, res) => {
  const { id } = req.params;

  db.query(
    "DELETE FROM books WHERE book_id=?",
    [id],
    (err) => {
      if (err) return res.status(500).send(err);
      res.send("Book deleted");
    }
  );
});

// get the webpage
app.get("/", (req, res) => {
  db.query("SELECT * FROM books", (err, rows) => {
    let html = `
    <html>
    <head>
    <style>
      body { font-family: Arial; background:#f1f5f9; text-align:center; }
      .card { margin:40px auto; width:500px; padding:20px; background:white; border-radius:10px; }
      input { width:100%; padding:8px; margin:5px 0; }
      button { padding:8px; margin:3px; background:#0ea5e9; color:white; border:none; cursor:pointer; }
      table { width:100%; margin-top:15px; border-collapse:collapse; }
      td, th { border:1px solid #ddd; padding:8px; }
      th { background:#0ea5e9; color:white; }
    </style>
    </head>
    <body>

    <div class="card">
    <h2>Library</h2>

    <input id="title" placeholder="Title">
    <input id="author" placeholder="Author">
    <input id="year" placeholder="Year">

    <button onclick="addBook()">Add Book</button>

    <table>
    <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>Action</th></tr>
    `;

    rows.forEach(r => {
      html += `
      <tr>
        <td>${r.book_id}</td>
        <td>${r.title}</td>
        <td>${r.author}</td>
        <td>${r.year}</td>
        <td>
          <button onclick="deleteBook(${r.book_id})">Delete</button>
        </td>
      </tr>`;
    });

    html += `
    </table>
    </div>

    <script>
    function addBook(){
      fetch("/books", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body: JSON.stringify({
          title: title.value,
          author: author.value,
          year: year.value
        })
      }).then(()=>location.reload());
    }

    function deleteBook(id){
      fetch("/books/" + id, { method:"DELETE" })
      .then(()=>location.reload());
    }
    </script>

    </body>
    </html>
    `;

    res.send(html);
  });
});

app.listen(3000, () => console.log("Server running on port 3000"));