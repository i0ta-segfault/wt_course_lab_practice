import { useSelector, useDispatch } from "react-redux";
import { removeNotification } from "../features/notificationsSlice";
import { useEffect } from "react";

function Notifications() {
  const notifications = useSelector(s => s.notifications.list);
  const dispatch = useDispatch();

  // auto dismiss notification after 3
  useEffect(() => {
    const timers = notifications.map(n =>
      setTimeout(() => dispatch(removeNotification(n.id)), 3000)
    );
    return () => timers.forEach(clearTimeout);
  }, [notifications, dispatch]);

  return (
    <div className="toast-container">
      {notifications.map(n => (
        <div key={n.id} className={`toast ${n.type}`}>
          <span>{n.message}</span>
          <button onClick={() => dispatch(removeNotification(n.id))}>
            ×
          </button>
        </div>
      ))}
    </div>
  );
}

export default Notifications;