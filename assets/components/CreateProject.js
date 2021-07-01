import React from "react";
import Appbar from "./Appbar";
import Container from '@material-ui/core/Container';
import TextField from '@material-ui/core/TextField';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import Select from '@material-ui/core/Select';
import Button from '@material-ui/core/Button';
import InputLabel from '@material-ui/core/InputLabel';
import Tableau from '../resources/Tableau-Create-Project.png';
import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles((theme) => ({
  table: {
    maxWidth: 600,
    marginTop: theme.spacing(1),
  }
}));

function CreateProject() {
  const classes = useStyles();
  return (
    <div className={classes.bg}>
      <Appbar />
      <Container component="main" maxWidth="md">
        <h1>Créer un nouveau projet</h1>
        <TextField
          variant="outlined"
          margin="normal"
          required
          fullWidth
          id="project-name"
          label="Nom du projet"
          name="project-name"
          autoFocus
        />
        <FormControl variant="outlined" fullWidth>
          <InputLabel id="method-choice"> Scenario </InputLabel>
          <Select
            labelId="method-choice"
            id="method-choice"
            label="Scenario"
            fullWidth
            required
          >
            <MenuItem value={[1]}>Identifier le socle de sécurité adapté à l’objet de l’étude</MenuItem>
            <MenuItem value={[1, 5]}>Être en conformité avec les référentiels de sécurité numérique</MenuItem>
            <MenuItem value={[3]}>Évaluer le niveau de menace de l’écosystème vis-à-vis de l’objet de l’étude</MenuItem>
            <MenuItem value={[2, 3]}>Identifier et analyser les scénarios de haut niveau, intégrant l’écosystème</MenuItem>
            <MenuItem value={[1, 2, 3, 5]}>Réaliser une étude préliminaire de risque pour identifier les axes prioritaires d’amélioration de la sécurité</MenuItem>
            <MenuItem value={[1, 2, 3, 4, 5]}>Conduire une étude de risque complète et fine, par exemple sur un produit de sécurité ou en vue de l’homologation d’un système</MenuItem>
            <MenuItem value={[3, 4]}>Orienter un audit de sécurité et notamment un test d’intrusion</MenuItem>
            <MenuItem value={[3, 4]}>Orienter les dispositifs de détection et de réaction, par exemple au niveau d’un centre opérationnel de la sécurité (SOC) </MenuItem>
          </Select>
        </FormControl>
      </Container>
      <Container component="main">
        <img className={classes.table} src={Tableau} alt="Tableau" fullWidth />
      </Container>

      <Button variant="contained" color="primary">
        Créer le projet
      </Button>
    </div >
  );
}

export default CreateProject;