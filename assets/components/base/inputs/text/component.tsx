import React from "react";

const Input:React.FunctionComponent<{ initialValue?: string }> = ({ initialValue = '' }) => {
  const [value, setValue] = React.useState(initialValue);
  return <>
    <input onChange={(evt) => setValue(evt.target.value)} value ={value}></input>
  </>
}

export default Input;