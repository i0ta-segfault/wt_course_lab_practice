import { createSlice } from "@reduxjs/toolkit";
import { nanoid } from "nanoid";

const initialState = {
  list: [] // [{id, message, type}]
};

const notificationsSlice = createSlice({
  name: "notifications",
  initialState,
  reducers: {
    addNotification: {
      reducer(state, action) {
        state.list.push(action.payload);
      },
      prepare(message, type = "info") {
        return {
          payload: {
            id: nanoid(),
            message,
            type
          }
        };
      }
    },

    removeNotification(state, action) {
      state.list = state.list.filter(n => n.id !== action.payload);
    },

    clearAll(state) {
      state.list = [];
    }
  }
});

export const { addNotification, removeNotification, clearAll } =
  notificationsSlice.actions;

export default notificationsSlice.reducer;