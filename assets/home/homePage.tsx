import React from "react";
import ReactDOM from "react-dom";
import SptMenu from "./components/sptMenu";
import ChartSummary from "./components/chartSummary";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <SptMenu>
            <ChartSummary sessions={spt.sessions} sessionsTypes={spt.sessionTypes}>
            </ChartSummary>
        </SptMenu>,
        document.getElementById('root')
    );
});
