import { useEffect, useState } from "react";
import Student from "./Student.jsx";
import Result from "./Result.jsx";
import "./App.css";

function App() {
  const [subjects, setSubjects] = useState([]);

  const student = {
    name: "Generic name oonga boonga",
    course: "CSE branch omgggg slay"
  };

  useEffect(() => {
    fetch("http://localhost/WT_lab_practice/7th_SemResult_React_php_mysql/backend/get_results.php")
      .then(res => res.json())
      .then(setSubjects);
  }, []);

  const updateMarks = (index, type, delta) => {
    const updated = [...subjects];

    let val = Number(updated[index][type]) + delta;

    if (val < 0) val = 0;
    if (type === "mse" && val > 30) val = 30;
    if (type === "ese" && val > 70) val = 70;

    updated[index][type] = val;

    setSubjects(updated);

    fetch("http://localhost/WT_lab_practice/7th_SemResult_React_php_mysql/backend/update_marks.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(updated[index])
    });
  };

  return (
    <div className="container">

      <h1>VIT Semester Result</h1>

      <Student
        student={student}
        subjects={subjects}
        updateMarks={updateMarks}
      />

      <Result subjects={subjects} />

    </div>
  );
}

export default App;