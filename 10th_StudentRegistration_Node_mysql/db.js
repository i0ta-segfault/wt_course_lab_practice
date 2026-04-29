const mysql = require("mysql2");

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

connection.connect(err => {
  if (err) throw err;

  console.log("Connected to MySQL");

  connection.query("CREATE DATABASE IF NOT EXISTS student_reg_db");

  connection.query("USE student_reg_db");

  connection.query(`
    CREATE TABLE IF NOT EXISTS students (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(50),
      email VARCHAR(50),
      course VARCHAR(50)
    )
  `);
});

module.exports = connection;