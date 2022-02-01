import React from "react";
import ReactDOM from "react-dom";
import AuthenticateBlock from "./components/authenticateBlock/index";

document.addEventListener("DOMContentLoaded", function() {
    ReactDOM.render(
        <AuthenticateBlock
            isFromCreation={spt.isFromCreation}
            isFromInvalidCertification={spt.isFromInvalidCertification}
            isFromValidCertification={spt.isFromValidCertification}
            isFromForgottenEmail={spt.isFromForgottenEmail}
        />,
        document.getElementById('root')
    );
});
