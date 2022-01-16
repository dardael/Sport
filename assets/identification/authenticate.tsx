import React from "react";
import ReactDOM from "react-dom";
import Input from '../components/base/inputs/text/component';
ReactDOM.render(
    <>
        <Input label={"Identifiant"} id={"id"}/>
        <Input label={"Mot de passe"} id={"password"}/>
    </>,
    document.getElementById('root')
);  