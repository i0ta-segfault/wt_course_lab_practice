import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  products: [
    { id: 1, name: "Laptop", category: "Electronics", price: 70000 },
    { id: 2, name: "Phone", category: "Electronics", price: 30000 },
    { id: 3, name: "Shoes", category: "Fashion", price: 2000 },
    { id: 4, name: "T-Shirt", category: "Fashion", price: 800 },
  ],
  filtered: [],
  category: "ALL",
  maxPrice: 100000
};

const slice = createSlice({
  name: "products",
  initialState,
  reducers: {

    filterByCategory(state, action) {
      state.category = action.payload;
      applyFilters(state);
    },

    filterByPrice(state, action) {
      state.maxPrice = action.payload;
      applyFilters(state);
    },

    resetFilters(state) {
      state.category = "ALL";
      state.maxPrice = 100000;
      state.filtered = state.products;
    }
  }
});

function applyFilters(state) {
  state.filtered = state.products.filter(p => {
    return (
      (state.category === "ALL" || p.category === state.category) &&
      p.price <= state.maxPrice
    );
  });
}

export const { filterByCategory, filterByPrice, resetFilters } = slice.actions;
export default slice.reducer;