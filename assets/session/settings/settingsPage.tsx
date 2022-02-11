import React from "react";
import ReactDOM from "react-dom";
import SptMenu from "../../home/components/sptMenu";
import SessionDataGrid from "./components/sessionDataGrid";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <SptMenu><SessionDataGrid/></SptMenu>,
        document.getElementById('root')
    );
});
