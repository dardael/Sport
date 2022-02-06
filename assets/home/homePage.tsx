import React from "react";
import ReactDOM from "react-dom";
import SptMenu from "./components/sptMenu";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <SptMenu pseudo = {spt.pseudo}/>,
        document.getElementById('root')
    );
});
