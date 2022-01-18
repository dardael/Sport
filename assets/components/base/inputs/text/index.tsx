import React from "react";
import './styles.scss'

const Input: React.FunctionComponent<{ 
  id: string,
  label: string,
  initialValue?: string
  type?: string 
}> = ({ id, label, initialValue = '', type = 'text' }) => {
  const [value, setValue] = React.useState(initialValue);
  return <>
    <div className="input-container">
      <label>{label}</label>
      <input type={type} id={id} onChange={(evt) => setValue(evt.target.value)} value={value}></input>
    </div>
  </>
}

export default Input;