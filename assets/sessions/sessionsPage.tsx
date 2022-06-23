import React from "react";
import ReactDOM from "react-dom";
import SptMenu from "../home/components/sptMenu";
import SessionsDataGrid from "./components/sessionsDataGrid";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <SptMenu><SessionsDataGrid initialSessions={spt.sessions} sessionTypes={spt.sessionTypes}/></SptMenu>,
        document.getElementById('root')
    );
});
