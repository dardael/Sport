import React from "react";
import Button from "../../../components/base/button/index";
import Input from "../../../components/base/inputs/text/index";
import Link from "../../../components/base/link/index";
import './styles.scss'

const AuthenticateBlock:React.FunctionComponent<{}> = () => {
    return <>
    <div className="authenticate-block">
        <Input label={"Identifiant"} id={"id"}/>
        <Input label={"Mot de passe"} id={"password"}/>
        <div className="footer">
            <Link text={"Créer un compte"} target={"/account/create"}></Link>
            <Button id={"connection"} label={"Connexion"} icone={"fas fa-sign-in-alt"}/>
        </div>
    </div>
</>
}

export default AuthenticateBlock;