const mysql = require("mysql2");

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

db.connect(err => {
  if (err) { throw err; }

  console.log("Seeding DB...");

  db.query("CREATE DATABASE IF NOT EXISTS library_db");
  db.query("USE library_db");

  db.query(`
    CREATE TABLE IF NOT EXISTS books (
      book_id INT AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(100),
      author VARCHAR(100),
      year INT
    )
  `);

  console.log("DB ready");
});