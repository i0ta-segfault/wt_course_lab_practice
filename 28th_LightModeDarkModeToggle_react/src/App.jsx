import { useState, useEffect } from "react";
import "./App.css";

function App() {

  // load from localStorage OR default to light
  const [theme, setTheme] = useState(
    localStorage.getItem("theme") || "light"
  );

  // persist theme
  useEffect(() => {
    localStorage.setItem("theme", theme);
  }, [theme]);

  const toggleTheme = () => {
    setTheme(prev => (prev === "light" ? "dark" : "light"));
  };

  return (
    <div className={`container ${theme}`}>
      <div className="card">
        <p>Toggle theme</p>

        <p>Current Mode: <strong>{theme.toUpperCase()}</strong></p>

        <button onClick={toggleTheme}>
          Switch to {theme === "light" ? "Dark" : "Light"} Mode
        </button>
      </div>
    </div>
  );
}

export default App;