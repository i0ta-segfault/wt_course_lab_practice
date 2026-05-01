function Result({ subjects }) {

  const total = subjects.reduce(
    (sum, s) => sum + (Number(s.mse) * 0.3 + Number(s.ese) * 0.7),
    0
  );

  const pass = subjects.every(
    s => (Number(s.mse) * 0.3 + Number(s.ese) * 0.7) >= 50
  );

  return (
    <div className="report-card">

      <h2>Final Report</h2>

      <table>
        <thead>
          <tr>
            <th>Subject</th>
            <th>MSE</th>
            <th>ESE</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          {subjects.map(s => {
            const t = Number(s.mse) * 0.3 + Number(s.ese) * 0.7;
            const status = t >= 50;

            return (
              <tr key={s.id}>
                <td>{s.name}</td>
                <td>{s.mse}</td>
                <td>{s.ese}</td>
                <td>{t.toFixed(2)}</td>
                <td className={status ? "pass" : "fail"}>
                  {status ? "PASS" : "FAIL"}
                </td>
              </tr>
            );
          })}

          <tr>
            <td colSpan="3">Total</td>
            <td>{total.toFixed(2)}</td>
            <td className={pass ? "pass" : "fail"}>
              {pass ? "PASS" : "FAIL"}
            </td>
          </tr>

        </tbody>
      </table>

    </div>
  );
}

export default Result;