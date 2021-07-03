import React from "react";
import Appbar from "./Appbar";
import Container from "@material-ui/core/Container";
import TextField from "@material-ui/core/TextField";
import Button from "@material-ui/core/Button";
import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles((theme) => ({
  table: {
    maxWidth: 600,
    marginTop: theme.spacing(1),
  },
}));

async function handleSubmit(parameters) {
  const request = new Request(process.env.API_URL + "api/organizations", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(parameters),
  });

  return fetch(request).then((response) => {
    if (!response.ok) {
      console.log(response);
      throw response.status;
    }
  });
}

function CreateOrganization() {
  const classes = useStyles();
  return (
    <div className={classes.bg}>
      <Appbar />
      <Container component="main" maxWidth="md">
        <h1>Créer une nouvelle organization</h1>
        <form onSubmit={handleSubmit}>
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            id="name"
            label="Nom de l'organization"
            name="name"
            autoFocus
          />
          <Button variant="contained" color="primary">
            Créer l'organization
          </Button>
        </form>
      </Container>
    </div>
  );
}

export default CreateOrganization;
