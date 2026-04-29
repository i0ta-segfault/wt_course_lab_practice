const express = require("express");
const cors = require("cors");
const db = require("./db");

const app = express();

app.use(cors());
app.use(express.json());

// post endpoint
app.post("/students", (req, res) => {
  const { name, email, course } = req.body;

  db.query(
    "INSERT INTO students (name, email, course) VALUES (?, ?, ?)",
    [name, email, course],
    (err) => {
      if (err) return res.status(500).send(err);
      res.send("Student added");
    }
  );
});

// get endpoint
app.get("/students", (req, res) => {
  db.query("SELECT * FROM students", (err, result) => {
    if (err) return res.status(500).send(err);
    res.json(result);
  });
});

// put enfpoint
app.put("/students/:id", (req, res) => {
  const { id } = req.params;
  const { name, email, course } = req.body;

  db.query(
    "UPDATE students SET name=?, email=?, course=? WHERE id=?",
    [name, email, course, id],
    (err, result) => {
      if (err) return res.status(500).send(err);
      res.send("Student updated");
    }
  );
});

// delete endpoint
app.delete("/students/:id", (req, res) => {
  const { id } = req.params;

  db.query(
    "DELETE FROM students WHERE id=?",
    [id],
    (err, result) => {
      if (err) return res.status(500).send(err);
      res.send("Student deleted");
    }
  );
});

// browser view html
app.get("/", (req, res) => {
  db.query("SELECT * FROM students", (err, rows) => {
    let html = "<h1>Student List</h1><ul>";

    rows.forEach(r => {
      html += `<li>${r.id} - ${r.name} - ${r.email} - ${r.course}</li>`;
    });

    html += "</ul>";
    res.send(html);
  });
});

app.listen(3000, () => console.log("Server running on port 3000"));