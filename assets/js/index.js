import React from "react";
import ReactDom from "react-dom";
import App from "./App";
import { BrowserRouter } from "react-router-dom";
window.React = React;

ReactDom.render(
    <BrowserRouter>
        <App />
    </BrowserRouter>,
    document.getElementById("root")
);