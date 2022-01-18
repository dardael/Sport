import React, { ReactNode } from "react";
import './styles.scss'

const Page:React.FunctionComponent<{ body: ReactNode, footer?: ReactNode, title?: string }> = ({ body, footer, title = ""}) => {
  return <>
    <div className="page"> 
      <div className="page-content"> 
        <div className="page-body">{body}</div>
        {footer && <div className="page-footer">{footer}</div>}
      </div>
    </div>
  </>
}

export default Page;