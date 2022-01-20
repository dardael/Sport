import React from "react";
import './styles.scss'

const Link:React.FunctionComponent<{ text: string, target: string }> = ({ text, target}) => {
  return <>
    <a className = "link" href = {target}>{text}</a>
  </>
}

export default Link;