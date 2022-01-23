import React from "react";
import ReactDOM from "react-dom";
import CreationBlock from "./components/creationBlock/index";

document.addEventListener("DOMContentLoaded", function(event) { 
	ReactDOM.render(
    	<CreationBlock email = {spt.email} pseudo = {spt.pseudo}/>,
    	document.getElementById('root')
	);
});

