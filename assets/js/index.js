import React from "react";
import ReactDom from "react-dom";
import "../styles/app.css";
import App from "./App";
import { BrowserRouter } from "react-router-dom";

ReactDom.render(
    <BrowserRouter>
        <App />
    </BrowserRouter>,
    document.getElementById("root")
);