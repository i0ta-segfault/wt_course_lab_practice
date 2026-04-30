import { useState, useEffect, useRef } from "react";
import "./App.css";

function App() {

  const [time, setTime] = useState(new Date());
  const [running, setRunning] = useState(true);

  const intervalRef = useRef(null);

  // format to HH:MM:SS
  const formatTime = (date) => {
    return date.toLocaleTimeString("en-GB"); // 24-hour format
  };

  useEffect(() => {
    if (running) {
      intervalRef.current = setInterval(() => {  // triggers react re-render
        setTime(new Date());
      }, 1000);
    }

    // cleanup so no mem leak and buggy fast clock
    return () => clearInterval(intervalRef.current);

  }, [running]);

  const toggleClock = () => {
    setRunning(prev => !prev);
  };

  return (
    <div className="container">
      <div className="card">

        <h2>Digital Clock</h2>

        <h3>{formatTime(time)}</h3>

        <p>Status: {running ? "Running" : "Stopped"}</p>

        <button onClick={toggleClock}>
          {running ? "Stop" : "Start"}
        </button>

      </div>
    </div>
  );
}

export default App;