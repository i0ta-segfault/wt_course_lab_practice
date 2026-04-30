import { useSelector, useDispatch } from "react-redux";
import { useState } from "react";
import { filterByCategory, filterByPrice, resetFilters } from "./features/productSlice";
import "./App.css";

function App() {

  const { filtered, products } = useSelector(state => state.products);
  const dispatch = useDispatch();

  const [price, setPrice] = useState(100000);

  const data = filtered.length ? filtered : products;

  return (
    <div className="container">

      <h1>Product Filter</h1>

      <div className="controls">

        <div className="control-group">
          <label>Category</label>
          <select
            onChange={(e) => dispatch(filterByCategory(e.target.value))}
          >
            <option value="ALL">All</option>
            <option value="Electronics">Electronics</option>
            <option value="Fashion">Fashion</option>
          </select>
        </div>

        <div className="control-group">
          <label>Max Price: {price}</label>
          <input
            type="range"
            min="0"
            max="100000"
            value={price}
            onChange={(e) => {
              const val = Number(e.target.value);
              setPrice(val);
              dispatch(filterByPrice(val));
            }}
          />
        </div>

        <button className="reset" onClick={() => dispatch(resetFilters())}>
          Reset Filters
        </button>

      </div>

      <div className="grid">
        {data.map(p => (
          <div className="card" key={p.id}>
            <h3>{p.name}</h3>
            <p>{p.category}</p>
            <p>{p.price}</p>
          </div>
        ))}
      </div>

    </div>
  );
}

export default App;