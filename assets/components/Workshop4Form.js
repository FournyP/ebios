import React from "react";
import PropTypes from "prop-types";
import {
  Button,
  IconButton,
  FormControl,
  MenuItem,
  InputLabel,
  CircularProgress,
  TextField,
  Box,
  Select,
  makeStyles,
} from "@material-ui/core";
import { RemoveCircle, AddCircle } from "@material-ui/icons";
import { v4 as uuidv4 } from "uuid";
import { Autocomplete } from "@material-ui/lab";

const useStyles = makeStyles((theme) => ({
  button: {
    margin: theme.spacing(1),
  },
  formControl: {
    margin: theme.spacing(1),
    minWidth: "18%",
  },
  textField: {
    margin: theme.spacing(1),
    minWidth: "70%",
  },
}));

async function fetchStrategicScenarios() {
  const request = new Request(process.env.API_URL + "api/strategic_scenarios", {
    method: "GET",
    headers: {
      "Content-Type": "application/json"
    },
  });

  return await (await fetch(request)).json();
}

function AsyncOperationalScenarioField(props) {
  const [open, setOpen] = React.useState(false);
  const [options, setOptions] = React.useState([]);
  const loading = open && options.length === 0;

  React.useEffect(async () => {
    if (!loading) {
      return undefined;
    }

    let strategicScenarios = await fetchStrategicScenarios();
    setOptions(strategicScenarios["hydra:member"]);

    return () => {
      active = false;
    };
  }, [loading]);

  React.useEffect(() => {
    if (!open) {
      setOptions([]);
    }
  }, [open]);

  return (
    <Autocomplete
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
      value={props.value}
      className={props.className}
      onChange={(event, newValue) => {
        props.onChange(event, newValue);
      }}
      renderInput={(params) => (
        <TextField
          {...params}
          label={props.label}
          variant="outlined"
          className={props.className}
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
  );
}

function Workshop4Form(props) {
  const classes = useStyles();
  const [inputFields, setInputFields] = React.useState(
    props.initValues.length > 0
      ? props.initValues
      : [
          {
            id: uuidv4(),
            strategicScenario: null,
            overallLikelihood: 1,
            toCreate: true,
          },
        ]
  );

  const handleSubmit = (e) => {
    e.preventDefault();
    props.handleSubmit(inputFields);
  };

  const handleChangeInput = (index, value, field) => {
    inputFields[index][field] = value;
    setInputFields(inputFields);
  };

  const handleAddFields = () => {
    setInputFields([
      ...inputFields,
      {
        id: uuidv4(),
        strategicScenario: null,
        overallLikelihood: 1,
        toCreate: true,
      },
    ]);
  };

  const handleRemoveFields = (id) => {
    const values = [...inputFields];
    values.splice(
      values.findIndex((value) => value.id === id),
      1
    );
    setInputFields(values);
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        {inputFields.map((inputField, index) => (
          <Box
            key={inputField.id}
            display="flex"
            alignItems="center"
            borderTop={1}
            borderColor="grey.500"
          >
            <AsyncOperationalScenarioField
              className={classes.textField}
              name="strategicScenario"
              label="Scénario Opérationnel"
              multiline
              value={inputField.strategicScenario}
              onChange={(_, newValue) =>
                handleChangeInput(index, newValue, "strategicScenario")
              }
            />
            <FormControl className={classes.formControl}>
              <InputLabel>Vraisemblance</InputLabel>
              <Select
                name="overallLikelihood"
                defaultValue={inputField.overallLikelihood}
                onClick={(event) =>
                  handleChangeInput(
                    index,
                    event.target.value,
                    "overallLikelihood"
                  )
                }
              >
                <MenuItem value={1}>V1 Peu Vraisemblable</MenuItem>
                <MenuItem value={2}>V2 Vraisemblable</MenuItem>
                <MenuItem value={3}>V3 Très Vraisemblable</MenuItem>
                <MenuItem value={4}>V4 Quasi-certain</MenuItem>
              </Select>
            </FormControl>
            <IconButton
              disabled={inputFields.length === 1}
              onClick={() => handleRemoveFields(inputField.id)}
            >
              <RemoveCircle />
            </IconButton>
            <IconButton onClick={handleAddFields}>
              <AddCircle />
            </IconButton>
          </Box>
        ))}
        <Button
          className={classes.button}
          variant="contained"
          color="primary"
          type="submit"
        >
          Send
        </Button>
      </form>
    </div>
  );
}

Workshop4Form.propTypes = {
  handleSubmit: PropTypes.func,
  initValues: PropTypes.array,
};

export default Workshop4Form;
