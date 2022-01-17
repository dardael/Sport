import React from "react";
import ReactDOM from "react-dom";
import AuthenticateBlock from "./components/authenticateBlock/index";
import './styles.scss'

ReactDOM.render(
    <div className="authenticate-page"><AuthenticateBlock/></div>,
    document.getElementById('root')
);  