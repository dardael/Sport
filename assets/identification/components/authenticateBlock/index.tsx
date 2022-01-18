import React from "react";
import Button from "../../../components/base/button/index";
import Input from "../../../components/base/inputs/text/index";
import Link from "../../../components/base/link/index";
import Page from "../../../components/base/page/index";

const AuthenticateBlock: React.FunctionComponent<{}> = () => {
    return <>
        <Page body={<>
                <Input label={"Identifiant"} id={"id"} />
                <Input label={"Mot de passe"} id={"password"} />
            </>} 
            footer={<>
                <Link text={"Créer un compte"} target={"/account/create"}></Link>
                <Button id={"connection"} label={"Connexion"} icone={"fas fa-sign-in-alt"} />
            </>} 
        />
    </>
}

export default AuthenticateBlock;