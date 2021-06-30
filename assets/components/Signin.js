import Appbar from "./Appbar";
import React, { useState } from 'react';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Link from '@material-ui/core/Link';
import Grid from '@material-ui/core/Grid';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';
import logo from './logo.png';
import { useHistory } from "react-router-dom";
import Alert from '@material-ui/lab/Alert';

async function loginUser(credentials) {
    return fetch('https://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(credentials)
    })
        .then(response => {
            if (!response.ok) { throw 'Incorrect Password or Username' }
            return response.json()  //we only get here if there is no error
        })
        .then(json => {
            localStorage.setItem('username', JSON.stringify(json.username));
            localStorage.setItem('roles', JSON.stringify(json.roles));
        })
}

const useStyles = makeStyles((theme) => ({
    paper: {
        marginTop: theme.spacing(8),
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
    },
    avatar: {
        margin: theme.spacing(1),
        width: 125,
    },
    submit: {
        marginTop: theme.spacing(1),
    },
    form: {
        width: '100%', // Fix IE 11 issue.
        marginTop: theme.spacing(1),
    }
}));


function Signin() {
    const history = useHistory();
    const classes = useStyles();
    const [username, setUserName] = useState();
    const [password, setPassword] = useState();
    const [alert, setAlert] = useState(false);
    const [alertMsg, setAlertMsg] = useState('');

    const handleSubmit = async e => {
        e.preventDefault();
        try {
            await loginUser({
                username,
                password
            });
            history.push("/");
        } catch (e) {
            console.log(e);
            setAlert(true);
            setAlertMsg(e);
        }
    }

    return (
        <div>
            <Appbar />
            <Container component="main" maxWidth="xs">
                <CssBaseline />
                <div className={classes.paper}>
                    <img className={classes.avatar} src={logo} alt="Logo" />
                    <form className={classes.form} onSubmit={handleSubmit}>
                        <TextField
                            variant="outlined"
                            margin="normal"
                            required
                            fullWidth
                            id="email"
                            label="Email Address"
                            name="email"
                            autoComplete="email"
                            autoFocus
                            onChange={e => setUserName(e.target.value)}
                        />
                        <TextField
                            variant="outlined"
                            margin="normal"
                            required
                            fullWidth
                            name="password"
                            label="Password"
                            type="password"
                            id="password"
                            autoComplete="current-password"
                            onChange={e => setPassword(e.target.value)}
                        />
                        <FormControlLabel
                            control={<Checkbox value="remember" color="primary" />}
                            label="Remember me"
                        />
                        {alert ? <Alert severity='error'>{alertMsg}</Alert> : <></>}
                        <Button
                            type="submit"
                            fullWidth
                            variant="contained"
                            color="primary"
                            className={classes.submit}
                        >
                            Sign In
                        </Button>
                        <Grid container justify="flex-end">
                            <Grid item>
                                <Link href="/signup" variant="body2">
                                    {"Don't have an account? Sign Up"}
                                </Link>
                            </Grid>
                        </Grid>
                    </form>
                </div>
            </Container>
        </div>
    );
}

export default Signin;