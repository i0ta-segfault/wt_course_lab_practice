import { useDispatch } from "react-redux";
import {
  addNotification,
  clearAll
} from "./features/notificationsSlice";
import Notifications from "./components/Notifications";
import "./App.css";

function App() {
  const dispatch = useDispatch();

  return (
    <div className="container">
      <h1>Notifications Demo</h1>

      <div className="controls">
        <button onClick={() => dispatch(addNotification("Saved!", "success"))}>
          Success
        </button>

        <button onClick={() => dispatch(addNotification("Something went wrong", "error"))}>
          Error
        </button>

        <button onClick={() => dispatch(addNotification("FYI: Update available", "info"))}>
          Info
        </button>

        <button onClick={() => dispatch(clearAll())}>
          Clear All
        </button>
      </div>

      <Notifications />
    </div>
  );
}

export default App;