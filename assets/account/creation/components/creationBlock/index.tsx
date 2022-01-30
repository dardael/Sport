import React, {useState} from "react";
import { LockOutlined } from "../../../../../node_modules/@mui/icons-material/index";
import { Box, Button, Link, TextField } from "../../../../../node_modules/@mui/material/index";
import CenteredPage from "../../../../components/base/page/centeredPage/index";

const CreationBlock:React.FunctionComponent<{
	pseudo?: string,
	email?: string
}> = ({
	pseudo,
	email,
}) => {
    const [ account, setAccount] = useState({
        pseudo : pseudo || '',
        email : email || '',
        password: '',
        repeatedPassword: ''
    });
    const [ errors, setErrors] = useState({
        pseudo : null,
        email : null,
        password: null,
        repeatedPassword: null,
    });
    const isAccountValid = async (evt: React.FormEvent<HTMLFormElement>) => {
        evt.preventDefault();
        let formData = new FormData();
        formData.append('pseudo', account.pseudo);
        formData.append('email', account.email);
        formData.append('password',account.password );
        formData.append('repeatedPassword', account.repeatedPassword);
        let response = await fetch(
            '/account/isValid',
            {
                method: 'POST',
                body: formData,
            }       
        );
        let wrongFields = await response.json();
        if ( wrongFields.length !== 0 ) {
            setErrors({...errors, ...wrongFields});
        } else {
            evt.currentTarget.submit();
        }
    };

    const onEmailChange = (evt: React.ChangeEvent<HTMLInputElement>): void => {
        setErrors({...errors, email: null});
        setAccount({...account, email: evt.currentTarget.value});
    };

    const onPseudoChange = (evt: React.ChangeEvent<HTMLInputElement>): void => {
        setErrors({...errors, pseudo: null});
        setAccount({...account, pseudo: evt.currentTarget.value});
    };

    const onPasswordChange = (evt: React.ChangeEvent<HTMLInputElement>): void => {
        setErrors({...errors, password: null, repeatedPassword: null});
        setAccount({...account, password: evt.currentTarget.value});
    };

    const onRepeatedPasswordChange = (evt: React.ChangeEvent<HTMLInputElement>): void => {
        setErrors({...errors, password: null, repeatedPassword: null});
        setAccount({...account, repeatedPassword: evt.currentTarget.value});
    };

    return <>
        <CenteredPage icon={<LockOutlined />} title="S'inscrire">
            <Box 
				component="form" 
				action='/account/save' 
                onSubmit={isAccountValid}
                noValidate sx={{ mt: 1 }}
			>
                <TextField                 
                    margin = "normal"
                    required
                    error = {!!errors.email}
                    helperText = {errors.email}
                    fullWidth
                    id = "email"
                    label = "Mail"
                    name = "email"
                    autoComplete = "email"
                    autoFocus
                    value = {account.email}
                    onChange = {onEmailChange}
                />
                <TextField                 
                    margin = "normal"
                    required
                    fullWidth
                    id = "pseudo"
                    label = "Pseudo"
                    name = "pseudo"
                    autoComplete = "pseudo"
                    value = {account.pseudo}
                    onChange = {onPseudoChange}
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
                    value = {account.password}
                    onChange = {onPasswordChange}
                />
                <TextField
                    margin="normal"
                    required
                    fullWidth
                    name="repeated-password"
                    label="Répétez le Mot de passe"
                    type="password"
                    id="repeated-password"
                    autoComplete="repeated-password"
                    value = {account.repeatedPassword}
                    onChange = {onRepeatedPasswordChange}
                />          
                <Button
                    type='submit'
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
