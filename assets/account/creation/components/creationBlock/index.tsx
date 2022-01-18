import React from "react";
import Button from "../../../../components/base/button/index";
import Input from "../../../../components/base/inputs/text/index";
import Page from "../../../../components/base/page/index";

const CreationBlock:React.FunctionComponent<{}> = ({}) => {
    return <>
        <Page
            body={<>
                <Input id={"identifiant"} label={"Identifiant"}></Input>
                <Input id={"mail"} label={"Mail"}></Input>
                <Input id={"password"} label={"Mot de passe"} type={"password"}></Input>
                <Input id={"repeated-password"} label={"Répéter le mot de passe"} type={"password"}></Input>
            </>}
            footer={<>
                <Button id={"create"} label={"Créer le compte"} icone={"fas fa-plus"}/>
            </>}
        />
    </>
  }
  
  export default CreationBlock;