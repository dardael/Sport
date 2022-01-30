import React from "react";
import { LockOutlined } from "../../../../node_modules/@mui/icons-material/index";
import { Avatar, Box, Button, Container, Grid, Link, TextField, Typography } from "../../../../node_modules/@mui/material/index";
import CenteredPage from "../../../components/base/page/centeredPage/index";

const AuthenticateBlock: React.FunctionComponent<{isFromCreation?: boolean}> = ({isFromCreation}) => {
    return <>
       <CenteredPage icon={<LockOutlined />} title="Connexion" successMessage={isFromCreation ? 'Création du compte validée' : null}>
            <Box component="form" onSubmit={()=>{}} noValidate sx={{ mt: 1 }}>
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
                    name="password"
                    label="Mot de passe"
                    type="password"
                    id="password"
                    autoComplete="current-password"
                />
                <Button
                    type="submit"
                    fullWidth
                    variant="contained"
                    sx={{ mt: 3, mb: 2 }}
                >
                    Se connecter
                </Button>
                <Grid container>
                    <Grid item xs>
                        <Link href="#" variant="body2">
                            Mot de passe oublié ?
                        </Link>
                    </Grid>
                    <Grid item>
                        <Link href="/account/create" variant="body2">
                            {"Créer un compte"}
                        </Link>
                    </Grid>
                </Grid>
            </Box>
        </CenteredPage>
    </>
}

export default AuthenticateBlock;
