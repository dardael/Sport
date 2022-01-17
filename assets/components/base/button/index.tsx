import React from "react";
import './styles.scss'

const Button:React.FunctionComponent<{ id: string, label: string, icone: string }> = ({  id, label, icone}) => {
  return <>
    <button id = {id} className="btn" type="button"><span className={icone}></span> {label}</button>
  </>
}

export default Button;