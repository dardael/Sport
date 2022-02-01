import React, {useState} from "react";
import { Box, Button, TextField } from "../../../../../node_modules/@mui/material/index";
import CenteredPage from "../../../../components/base/page/centeredPage/index";
import {QuestionMark} from '@mui/icons-material';

const ForgottenPasswordBlock:React.FunctionComponent<{hasError?: boolean}> = ({hasError}) => {
    const [email, setEmail] = useState('');
    const [isInError, setIsInError] = useState(hasError);
    const onEmailChange = (evt: React.ChangeEvent<HTMLInputElement>): void => {
        setEmail(evt.currentTarget.value);
    };

    const isAccountExisting = async (evt) => {
        evt.preventDefault();
        let formData = new FormData();
        formData.append('email', email);
        let response = await fetch(
            '/account/isExisting',
            {
                method: 'POST',
                body: formData,
            }
        );
        let isExisting = await response.json();
        if (!isExisting) {
            setIsInError(true);
        } else {
            evt.target.submit();
        }
    };

    return <>
        <CenteredPage
            icon={<QuestionMark />}
            title="Mots de passe oublié"
            errorMessage={isInError ? 'Aucun compte avec cette adresse mail trouvé' : null}
        >
            <Box
				component="form" 
				action='/account/sendPassword'
                onSubmit={isAccountExisting}
                noValidate sx={{ mt: 1 }}
			>
                <TextField                 
                    margin = "normal"
                    required
                    fullWidth
                    id = "email"
                    label = "Mail"
                    name = "email"
                    autoComplete = "email"
                    autoFocus
                    onChange = {onEmailChange}
                    value = {email}
                />
                <Button
                    type='submit'
                    fullWidth
                    variant="contained"
                    sx={{ mt: 3, mb: 2 }}
                >
                    Continuer
                </Button>
            </Box>
        </CenteredPage>
    </>
  }
  
  export default ForgottenPasswordBlock;
