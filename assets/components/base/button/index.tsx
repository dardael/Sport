import React from "react";
import './styles.scss'

const Button: React.FunctionComponent<{ 
  id: string, 
  label: string, 
  icone: string, 
  type?: "button" | "submit" | "reset" 
}> = ({ id, label, icone, type = "button" }) => {
  return <>
    <button id={id} className="btn" type={type}><span className={icone}></span> {label}</button>
  </>
}

export default Button;