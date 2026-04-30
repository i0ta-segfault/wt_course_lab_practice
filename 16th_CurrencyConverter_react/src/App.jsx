import { useState, useEffect } from "react";
import "./App.css";

function App() {
  const [amount, setAmount] = useState("");
  const [result, setResult] = useState("");
  const [rate, setRate] = useState(83);
  const [isFallback, setIsFallback] = useState(true);
  const [mode, setMode] = useState("USD_TO_INR"); // toggle state

  useEffect(() => {
    fetch("https://api.exchangerate-api.com/v4/latest/USD")
      .then((res) => res.json())
      .then((data) => {
        if (data?.rates?.INR) {
          setRate(data.rates.INR);
          setIsFallback(false);
        } else {
          setIsFallback(true);
        }
      })
      .catch(() => setIsFallback(true));
  }, []);

  const convert = (value) => {
    if (!value) {
      setResult("");
      return;
    }

    let res;
    if (mode === "USD_TO_INR") {
      res = parseFloat(value) * rate;
    } else {
      res = parseFloat(value) / rate;
    }

    setResult(res.toFixed(2));
  };

  const handleChange = (e) => {
    const value = e.target.value;
    setAmount(value);
    convert(value);
  };

  const toggleMode = () => {
    setMode((prev) =>
      prev === "USD_TO_INR" ? "INR_TO_USD" : "USD_TO_INR"
    );
    setAmount("");
    setResult("");
  };

  return (
    <div className="container">
      <h1>Currency Converter</h1>

      <div className="card">

        <div className="toggle-pill" onClick={toggleMode}>
          {mode === "USD_TO_INR" ? "USD to INR" : "INR to USD"}
        </div>
        <br></br>
        <label>
          {mode === "USD_TO_INR" ? "USD" : "INR"}
        </label>

        <input
          type="number"
          value={amount}
          onChange={handleChange}
          placeholder={`Enter amount in ${
            mode === "USD_TO_INR" ? "USD" : "INR"
          }`}
        />

        <button onClick={() => convert(amount)}>Convert</button>

        {result && (
          <h2>
            {mode === "USD_TO_INR" ? "INR" : "USD"}: {result}
          </h2>
        )}

        <p>
          Exchange Rate: 1 USD = {rate} INR{" "}
          {isFallback && "(fallback)"}
        </p>

      </div>
    </div>
  );
}

export default App;