import { useState } from 'react'
import { Routes, Route } from 'react-router-dom';
import React from 'react';

import './App.css'

function App() {
  const [count, setCount] = useState(0)

  return (
    <React.Fragment>
    <Routes>
     
      <Route path="/" element={<Home />} />

    </Routes>
  </React.Fragment>
);
}

export default App
