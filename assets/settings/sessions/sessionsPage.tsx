import React from "react";
import ReactDOM from "react-dom";
import SptMenu from "../../home/components/sptMenu";
import SessionDataGrid from "./components/sessionDataGrid";

document.addEventListener("DOMContentLoaded", function() {
    console.log(spt.sessions)
    ReactDOM.render(
        <SptMenu><SessionDataGrid initialSessions={spt.sessions}/></SptMenu>,
        document.getElementById('root')
    );
});
