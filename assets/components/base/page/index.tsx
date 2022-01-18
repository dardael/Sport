import React, { ReactNode } from "react";
import './styles.scss'

const Page:React.FunctionComponent<{ body: ReactNode, footer?: ReactNode, title?: string, action?:string }> = ({ body, footer, title = "", action=""}) => {
  return <>
    <form className="page" action={action}> 
      <div className="page-content"> 
        <div className="page-body">{body}</div>
        {footer && <div className="page-footer">{footer}</div>}
      </div>
    </form>
  </>
}

export default Page;