import { useEffect, useRef, useState } from "react";
import "./App.css";

function App() {

  const [name, setName] = useState("");
  const [course, setCourse] = useState("");
  const [message, setMessage] = useState("");

  const [feedbacks, setFeedbacks] = useState([]);
  const [error, setError] = useState("");

  const nameRef = useRef(null);
  const courseRef = useRef(null);
  const messageRef = useRef(null);

  useEffect(() => {
    fetchFeedback();
  }, []);

  const fetchFeedback = () => {
    fetch("http://localhost/WT_lab_practice/8th_FeedbackForm_React_php_mysql/backend/get_feedback.php")
      .then(res => res.json())
      .then(setFeedbacks);
  };

  const handleSubmit = () => {

    if (!name) {
      setError("Name required");
      nameRef.current.focus();
      return;
    }

    if (!course) {
      setError("Course required");
      courseRef.current.focus();
      return;
    }

    if (!message) {
      setError("Feedback required");
      messageRef.current.focus();
      return;
    }

    setError("");

    fetch("http://localhost/WT_lab_practice/8th_FeedbackForm_React_php_mysql/backend/submit_feedback.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ name, course, message })
    })
    .then(() => {
      setName("");
      setCourse("");
      setMessage("");
      fetchFeedback();
    });
  };

  return (
    <div className="container">

      <h1>Student Feedback Form</h1>

      <div className="form">

        <input
          ref={nameRef}
          value={name}
          onChange={e => setName(e.target.value)}
          placeholder="Your Name"
        />

        <input
          ref={courseRef}
          value={course}
          onChange={e => setCourse(e.target.value)}
          placeholder="Course"
        />

        <textarea
          ref={messageRef}
          value={message}
          onChange={e => setMessage(e.target.value)}
          placeholder="Your Feedback"
        />

        <button onClick={handleSubmit}>Submit</button>

        {error && <p className="error">{error}</p>}

      </div>

      <div className="list">

        <h2>Submitted Feedback</h2>

        {feedbacks.map(f => (
          <div key={f.id} className="card">
            <h3>{f.name}</h3>
            <p>{f.course}</p>
            <p>{f.message}</p>
          </div>
        ))}

      </div>

    </div>
  );
}

export default App;