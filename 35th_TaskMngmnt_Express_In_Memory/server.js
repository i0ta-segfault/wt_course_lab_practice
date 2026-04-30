const express = require("express");
const app = express();

app.use(express.json());

// using an array for in memory storage
let tasks = [];
let idCounter = 1;

// create post
app.post("/tasks", (req, res) => {
  const { title } = req.body;

  if (!title) {
    return res.status(400).json({ message: "Task title required" });
  }

  const task = {
    id: idCounter++,
    title,
    status: "pending", // default
    createdAt: new Date()
  };

  tasks.push(task);

  res.status(201).json(task);
});

// retr all posts
app.get("/tasks", (req, res) => {
  res.json(tasks);
});

// edit a single post
app.put("/tasks/:id", (req, res) => {
  const task = tasks.find(t => t.id == req.params.id);

  if (!task) {
    return res.status(404).json({ message: "Task not found" });
  }

  const { status } = req.body;

  if (!["pending", "completed"].includes(status)) {
    return res.status(400).json({ message: "Invalid status" });
  }

  task.status = status;

  res.json(task);
});

// delete a single post
app.delete("/tasks/:id", (req, res) => {
  const index = tasks.findIndex(t => t.id == req.params.id);

  if (index === -1) {
    return res.status(404).json({ message: "Task not found" });
  }

  if (tasks[index].status !== "completed") {
    return res.status(400).json({
      message: "Only completed tasks can be deleted"
    });
  }

  tasks.splice(index, 1);

  res.json({ message: "Task deleted" });
});

// serve a webpage instead of messin w postamn
app.get("/", (req, res) => {
  res.send(`
<!DOCTYPE html>
<html>
<head>
<title>Task Manager</title>
<style>
body { font-family: Arial; background:#f1f5f9; padding:20px; }
.container { max-width:600px; margin:auto; }

input { width:100%; padding:8px; margin:5px 0; }

button {
  padding:6px 10px;
  margin:5px;
  border:none;
  border-radius:5px;
  cursor:pointer;
}

.add { background:#22c55e; color:white; }
.done { background:#3b82f6; color:white; }
.delete { background:#ef4444; color:white; }

.card {
  background:white;
  padding:10px;
  margin-top:10px;
  border-radius:8px;
}

.completed { text-decoration: line-through; color: gray; }
</style>
</head>

<body>
<div class="container">
<h1>Task Manager</h1>

<input id="taskInput" placeholder="Enter task">
<button class="add" onclick="addTask()">Add Task</button>

<div id="tasks"></div>
</div>

<script>
function loadTasks() {
  fetch("/tasks")
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById("tasks");
      container.innerHTML = "";

      data.forEach(t => {
        container.innerHTML += \`
        <div class="card">
          <span class="\${t.status === "completed" ? "completed" : ""}">
            \${t.title}
          </span>

          <br>

          <button class="done"
            onclick="markDone(\${t.id})">
            Mark Done
          </button>

          <button class="delete"
            onclick="deleteTask(\${t.id})">
            Delete
          </button>
        </div>\`;
      });
    });
}

function addTask() {
  fetch("/tasks", {
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body: JSON.stringify({
      title: document.getElementById("taskInput").value
    })
  }).then(() => {
    document.getElementById("taskInput").value = "";
    loadTasks();
  });
}

function markDone(id) {
  fetch("/tasks/" + id, {
    method:"PUT",
    headers:{ "Content-Type":"application/json" },
    body: JSON.stringify({ status:"completed" })
  }).then(() => loadTasks());
}

function deleteTask(id) {
  fetch("/tasks/" + id, {
    method:"DELETE"
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    loadTasks();
  });
}

loadTasks();
</script>
</body>
</html>
  `);
});

app.listen(3000, () => {
  console.log("Server running on http://localhost:3000");
});