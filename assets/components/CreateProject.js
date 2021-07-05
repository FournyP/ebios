import React from "react";
import Appbar from "./Appbar";
import {
  Container,
  TextField,
  FormControl,
  MenuItem,
  Select,
  CircularProgress,
  Button,
  InputLabel,
  makeStyles,
} from "@material-ui/core";
import { Autocomplete, Alert } from "@material-ui/lab";
import Tableau from "../resources/Tableau-Create-Project.png";
import { useHistory } from "react-router-dom";

const useStyles = makeStyles((theme) => ({
  table: {
    maxWidth: 600,
    marginTop: theme.spacing(1),
  },
}));

async function fetchOptions() {
  let request = new Request(process.env.API_URL + "api/organizations", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await (await fetch(request)).json();
}

async function createProject(parameters) {
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
  const history = useHistory();
  const classes = useStyles();

  const [open, setOpen] = React.useState(false);
  const [options, setOptions] = React.useState([]);
  const loading = open && options.length === 0;

  const [organization, setOrganization] = React.useState(null);
  const [name, setName] = React.useState(null);
  const [workshopsDefined, setWorkshopDefined] = React.useState(null);

  const [alert, setAlert] = React.useState(false);
  const [alertMsg, setAlertMsg] = React.useState("");

  React.useEffect(async () => {
    let active = true;

    if (!loading) {
      return undefined;
    }

    let response = await fetchOptions();

    if (active) {
      setOptions(response["hydra:member"]);
    }

    return () => {
      active = false;
    };
  }, [loading]);

  React.useEffect(() => {
    if (!open) {
      setOptions([]);
    }
  }, [open]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await createProject({
        organization,
        name,
        workshopsDefined,
      });
      history.push("/");
    } catch (e) {
      console.log(e);
      setAlert(true);
      setAlertMsg(e);
    }
  };

  return (
    <div className={classes.bg}>
      <Appbar />
      <Container component="main" maxWidth="md">
        <h1>Créer un nouveau projet</h1>
        <form onSubmit={handleSubmit}>
          <FormControl variant="outlined" fullWidth>
            <Autocomplete
              id="organization"
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
              onChange={(e, value) => setOrganization(value["@id"])}
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
            onChange={(e) => setName(e.target.value)}
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
              onChange={(e, child) => setWorkshopDefined(child.props.value.split(', '))}
            >
              <MenuItem value={"1"}>
                Identifier le socle de sécurité adapté à l’objet de l’étude
              </MenuItem>
              <MenuItem value={"1, 5"}>
                Être en conformité avec les référentiels de sécurité numérique
              </MenuItem>
              <MenuItem value={"3"}>
                Évaluer le niveau de menace de l’écosystème vis-à-vis de l’objet
                de l’étude
              </MenuItem>
              <MenuItem value={"2, 3"}>
                Identifier et analyser les scénarios de haut niveau, intégrant
                l’écosystème
              </MenuItem>
              <MenuItem value={"1, 2, 3, 5"}>
                Réaliser une étude préliminaire de risque pour identifier les
                axes prioritaires d’amélioration de la sécurité
              </MenuItem>
              <MenuItem value={"1, 2, 3, 4, 5"}>
                Conduire une étude de risque complète et fine, par exemple sur
                un produit de sécurité ou en vue de l’homologation d’un système
              </MenuItem>
              <MenuItem value={"3, 4"}>
                Orienter un audit de sécurité et notamment un test d’intrusion
              </MenuItem>
              <MenuItem value={"3, 4"}>
                Orienter les dispositifs de détection et de réaction, par
                exemple au niveau d’un centre opérationnel de la sécurité (SOC){" "}
              </MenuItem>
            </Select>
          </FormControl>{" "}
          <Container component="main">
            <img
              className={classes.table}
              src={Tableau}
              alt="Tableau"
              fullWidth
            />
          </Container>
          <Button type="submit" variant="contained" color="primary">
            Créer le projet
          </Button>
          {alert ? <Alert severity="error">{alertMsg}</Alert> : <></>}
        </form>
      </Container>
    </div>
  );
};

export default CreateProject;
