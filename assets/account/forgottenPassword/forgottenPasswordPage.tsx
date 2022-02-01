import React from "react";
import ReactDOM from "react-dom";
import ForgottenPasswordBlock from "./components/forgottenPasswordBlock/index";

document.addEventListener("DOMContentLoaded", function() {
	ReactDOM.render(
    	<ForgottenPasswordBlock hasError={spt.hasError}/>,
    	document.getElementById('root')
	);
});

