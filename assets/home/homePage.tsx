import React from "react";
import ReactDOM from "react-dom";
import Menu from "./components/menu/menu";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <Menu/>,
        document.getElementById('root')
    );
});
