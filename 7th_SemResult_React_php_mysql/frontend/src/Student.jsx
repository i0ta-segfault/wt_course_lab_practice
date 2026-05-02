function Student({ student, subjects, updateMarks }) {

  return (
    <div>

      <h2>{student.name}</h2>
      <p>{student.course}</p>

      <div className="grid">
        {subjects.map((sub, index) => {

          const total = Number(sub.mse) * 0.3 + Number(sub.ese) * 0.7;
          const pass = total >= 50;

          return (
            <div key={sub.id} className="card">

              <h3>{sub.name}</h3>

              <p>MSE: {sub.mse}</p>
              <button onClick={() => updateMarks(index, "mse", 1)}>+</button>
              <button onClick={() => updateMarks(index, "mse", -1)}>-</button>

              <p>ESE: {sub.ese}</p>
              <button onClick={() => updateMarks(index, "ese", 1)}>+</button>
              <button onClick={() => updateMarks(index, "ese", -1)}>-</button>

              <p>Total: {total.toFixed(2)}</p>
              <p className={pass ? "pass" : "fail"}>
                {pass ? "PASS" : "FAIL"}
              </p>

            </div>
          );
        })}
      </div>

    </div>
  );
}

export default Student;