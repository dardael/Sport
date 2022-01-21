import React, { ReactNode } from "react";
import { Avatar, Box, Container, Typography } from "../../../../../node_modules/@mui/material/index";
import './styles.scss'

const CenteredPage:React.FunctionComponent<{ children: ReactNode, icon?: ReactNode, title?:string}> = ({ children, icon, title}) => {
    return <>
        <Container component="main" maxWidth="xs">
            <Box className = "centered-page">
                {icon && <Avatar sx={{ m: 1, bgcolor: 'secondary.main' }}>{icon}</Avatar>}
                {title && <Typography component="h1" variant="h5">{title}</Typography>}
                {children}
            </Box>
        </Container>
    </>
}

export default CenteredPage;