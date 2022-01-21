import React from "react";
import { LockOutlined } from "../../../../../node_modules/@mui/icons-material/index";
import { Box, Button, Grid, Link, TextField } from "../../../../../node_modules/@mui/material/index";
import CenteredPage from "../../../../components/base/page/centeredPage/index";

const CreationBlock:React.FunctionComponent<{}> = ({}) => {
    return <>
        <CenteredPage icon={<LockOutlined />} title="S'inscrire">
            <Box component="form" action='/account/save' noValidate sx={{ mt: 1 }}>
                <TextField                 
                    margin="normal"
                    required
                    fullWidth
                    id="email"
                    label="Mail"
                    name="email"
                    autoComplete="email"
                    autoFocus
                />
                <TextField                 
                    margin="normal"
                    required
                    fullWidth
                    id="pseudo"
                    label="Pseudo"
                    name="pseudo"
                    autoComplete="pseudo"
                />
                <TextField
                    margin="normal"
                    required
                    fullWidth
                    name="password"
                    label="Mot de passe"
                    type="password"
                    id="password"
                    autoComplete="current-password"
                />
                <TextField
                    margin="normal"
                    required
                    fullWidth
                    name="repeted-password"
                    label="Répétez le Mot de passe"
                    type="password"
                    id="repeted-password"
                    autoComplete="repeted-password"
                />          
                <Button
                    type="submit"
                    fullWidth
                    variant="contained"
                    sx={{ mt: 3, mb: 2 }}
                >
                    S'inscire
                </Button>
                <Link href="/" variant="body2">
                    {"Vous avez déja un compte ?"}
                </Link>
            </Box>
        </CenteredPage>
    </>
  }
  
  export default CreationBlock;