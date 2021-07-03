import React, { useState } from "react";
import Appbar from "./Appbar";
import Alert from '@material-ui/lab/Alert';
import Button from "@material-ui/core/Button";
import { Link } from 'react-router-dom';
import Container from '@material-ui/core/Container';

function Home() {
  const [isLogged, setIsLogged] = useState(localStorage.getItem('username') ? true : false);
  return (
    <div>
      <Appbar />
      <h1>EBIOS HOME PAGE</h1>
      {isLogged ? (
        <Container maxWidth="md">
          <Alert severity="info">
            Connecté : {localStorage.getItem("username")} && Roles :{" "}
            {localStorage.getItem("roles")}
          </Alert>
          <Button component={Link} color="inherit" to="/createorganization">
            Créer une organization
          </Button>
          <Button component={Link} color="inherit" to="/createproject">
            Créer un projet
          </Button>
          <Button component={Link} color="inherit" to="/project">
            Accéder à mes projets
          </Button>
        </Container>
      ) : (
        <></>
      )}
    </div>
  );
}

export default Home;
