const express = require("express");
const app = express();

app.use(express.json());

// using an array for in memory storage
let posts = [];
let idCounter = 1;

// create post
app.post("/posts", (req, res) => {
  const { title, content } = req.body;

  if (!title || !content) {
    return res.status(400).json({ message: "Title and content required" });
  }

  const post = {
    id: idCounter++,
    title,
    content,
    createdAt: new Date()
  };

  posts.push(post);

  res.status(201).json(post);
});

// retr all posts
app.get("/posts", (req, res) => {
  res.json(posts);
});

//retr a single post
app.get("/posts/:id", (req, res) => {
  const post = posts.find(p => p.id == req.params.id);

  if (!post) {
    return res.status(404).json({ message: "Post not found" });
  }

  res.json(post);
});

// edit a single post
app.put("/posts/:id", (req, res) => {
  const post = posts.find(p => p.id == req.params.id);

  if (!post) {
    return res.status(404).json({ message: "Post not found" });
  }

  const { title, content } = req.body;

  if (title) post.title = title;
  if (content) post.content = content;

  res.json(post);
});

// delete a single post
app.delete("/posts/:id", (req, res) => {
  const index = posts.findIndex(p => p.id == req.params.id);

  if (index === -1) {
    return res.status(404).json({ message: "Post not found" });
  }

  posts.splice(index, 1);

  res.json({ message: "Post deleted successfully" });
});

app.get("/", (req, res) => {
  res.send(`
<!DOCTYPE html>
<html>
<head>
<title>Blog Manager</title>
<style>
body {
  font-family: Arial;
  background: #f1f5f9;
  padding: 20px;
}

.container {
  max-width: 700px;
  margin: auto;
}

input, textarea {
  width: 100%;
  margin: 5px 0;
  padding: 8px;
}

button {
  padding: 8px 12px;
  margin: 5px;
  cursor: pointer;
  border: none;
  border-radius: 5px;
}

.add { background: #22c55e; color: white; }
.edit { background: #3b82f6; color: white; }
.delete { background: #ef4444; color: white; }

.card {
  background: white;
  padding: 10px;
  margin-top: 10px;
  border-radius: 8px;
}
</style>
</head>

<body>
<div class="container">
<h1>Blog Manager</h1>

<h3>Add Post</h3>
<input id="title" placeholder="Title">
<textarea id="content" placeholder="Content"></textarea>
<button class="add" onclick="addPost()">Add</button>

<h3>Posts</h3>
<div id="posts"></div>
</div>

<script>
function loadPosts() {
  fetch("/posts")
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById("posts");
      container.innerHTML = "";

      data.forEach(p => {
        container.innerHTML += \`
        <div class="card">
          <b>\${p.title}</b>
          <p>\${p.content}</p>

          <button class="edit" onclick="editPost(\${p.id})">Edit</button>
          <button class="delete" onclick="deletePost(\${p.id})">Delete</button>
        </div>\`;
      });
    });
}

function addPost() {
  fetch("/posts", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({
      title: document.getElementById("title").value,
      content: document.getElementById("content").value
    })
  }).then(() => {
    document.getElementById("title").value = "";
    document.getElementById("content").value = "";
    loadPosts();
  });
}

function deletePost(id) {
  fetch("/posts/" + id, { method: "DELETE" })
    .then(() => loadPosts());
}

function editPost(id) {
  const newTitle = prompt("New title:");
  const newContent = prompt("New content:");

  fetch("/posts/" + id, {
    method: "PUT",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({
      title: newTitle,
      content: newContent
    })
  }).then(() => loadPosts());
}

loadPosts();
</script>

</body>
</html>
  `);
});

app.listen(3000, () => {
  console.log("Server running on http://localhost:3000");
});