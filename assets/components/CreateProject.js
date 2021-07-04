import React from "react";
import Appbar from "./Appbar";
import Container from "@material-ui/core/Container";
import TextField from "@material-ui/core/TextField";
import FormControl from "@material-ui/core/FormControl";
import MenuItem from "@material-ui/core/MenuItem";
import Select from "@material-ui/core/Select";
import Autocomplete from "@material-ui/lab/Autocomplete";
import CircularProgress from "@material-ui/core/CircularProgress";
import Button from "@material-ui/core/Button";
import InputLabel from "@material-ui/core/InputLabel";
import Tableau from "../resources/Tableau-Create-Project.png";
import { makeStyles } from "@material-ui/core/styles";

async function initOptions() {
  let request = new Request(process.env.API_URL + "api/organizations", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await (await fetch(request)).json();
}

async function handleSubmit(parameters) {
  const request = new Request(process.env.API_URL + "api/projects", {
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

const CreateProject = () => {
  const classes = makeStyles((theme) => ({
    table: {
      maxWidth: 600,
      marginTop: theme.spacing(1),
    },
  }))();

  const [options, setOptions] = React.useState([]);
  const loading = open && options.length === 0;

  React.useEffect(async() => {
    let active = true;

    if (!loading) {
      return undefined;
    }

    let options = await initOptions();

    if (active) {
      for(option in options["hydra:member"])
      {
        setOptions(option.name);
      }
    }

    return () => {
      active = false;
    };
  }, [loading]);

  return (
    <div className={classes.bg}>
      <Appbar />
      <Container component="main" maxWidth="md">
        <h1>Créer un nouveau projet</h1>
        <form onSubmit={handleSubmit}>
          <FormControl variant="outlined" fullWidth>
            <InputLabel id="organization"> Organization </InputLabel>
            <Autocomplete
              id="organization"
              style={{ width: 300 }}
              open={open}
              onOpen={() => {
                setOpen(true);
              }}
              onClose={() => {
                setOpen(false);
              }}
              getOptionSelected={(option, value) => option.name === value.name}
              getOptionLabel={(option) => option.name}
              options={options}
              loading={loading}
              fullWidth
              renderInput={(params) => (
                <TextField
                  {...params}
                  label="Organization"
                  variant="outlined"
                  fullWidth
                  InputProps={{
                    ...params.InputProps,
                    endAdornment: (
                      <React.Fragment>
                        {loading ? (
                          <CircularProgress color="inherit" size={20} />
                        ) : null}
                        {params.InputProps.endAdornment}
                      </React.Fragment>
                    ),
                  }}
                />
              )}
            />
          </FormControl>
          <TextField
            variant="outlined"
            margin="normal"
            required
            fullWidth
            id="name"
            label="Nom du projet"
            name="name"
            autoFocus
          />
          <FormControl variant="outlined" fullWidth>
            <InputLabel id="workshopsDefined"> Scenario </InputLabel>
            <Select
              labelId="workshopsDefined"
              id="workshopsDefined"
              label="Scenario"
              fullWidth
              name="workshopsDefined"
              required
            >
              <MenuItem value={[1]}>
                Identifier le socle de sécurité adapté à l’objet de l’étude
              </MenuItem>
              <MenuItem value={[1, 5]}>
                Être en conformité avec les référentiels de sécurité numérique
              </MenuItem>
              <MenuItem value={[3]}>
                Évaluer le niveau de menace de l’écosystème vis-à-vis de l’objet
                de l’étude
              </MenuItem>
              <MenuItem value={[2, 3]}>
                Identifier et analyser les scénarios de haut niveau, intégrant
                l’écosystème
              </MenuItem>
              <MenuItem value={[1, 2, 3, 5]}>
                Réaliser une étude préliminaire de risque pour identifier les
                axes prioritaires d’amélioration de la sécurité
              </MenuItem>
              <MenuItem value={[1, 2, 3, 4, 5]}>
                Conduire une étude de risque complète et fine, par exemple sur
                un produit de sécurité ou en vue de l’homologation d’un système
              </MenuItem>
              <MenuItem value={[3, 4]}>
                Orienter un audit de sécurité et notamment un test d’intrusion
              </MenuItem>
              <MenuItem value={[3, 4]}>
                Orienter les dispositifs de détection et de réaction, par
                exemple au niveau d’un centre opérationnel de la sécurité (SOC){" "}
              </MenuItem>
            </Select>
          </FormControl>
        </form>
      </Container>
      <Container component="main">
        <img className={classes.table} src={Tableau} alt="Tableau" fullWidth />
      </Container>

      <Button variant="contained" color="primary">
        Créer le projet
      </Button>
    </div>
  );
};

export default CreateProject;