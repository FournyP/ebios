import React from "react";
import PropTypes from "prop-types";
import {
  TextField,
  Button,
  Box,
  IconButton,
  FormControl,
  MenuItem,
  InputLabel,
  Select,
  makeStyles
} from "@material-ui/core";
import { RemoveCircle, AddCircle } from "@material-ui/icons";
import { v4 as uuidv4 } from "uuid";

const useStyles = makeStyles((theme) => ({
  root: {
    "& .MuiTextField-root": {
      margin: theme.spacing(1),
    },
  },
  button: {
    margin: theme.spacing(1),
  },
  formControl: {
    margin: theme.spacing(1),
    width: "10%",
  },
  textField: {
    margin: theme.spacing(1),
    width: "20%",
  }
}));

function Workshop2Form(props) {
  const classes = useStyles();

  const [inputFields, setInputFields] = React.useState([
    {
      id: uuidv4(),
      source: "",
      goal: "",
      evaluation: {
        motivation: 1,
        resource: 1,
        activity: 1,
        pertinence: 1
      }
    },
  ]);

  const handleSubmit = (e) => {
    e.preventDefault();
    props.handleSubmit(inputFields);
  };

  const handleChangeInput = (id, event) => {
    const newInputFields = inputFields.map((i) => {
      if (id === i.id) {
        i[event.target.name] = event.target.value;
      }
      return i;
    });

    setInputFields(newInputFields);
  };

  const handleAddFields = () => {
    setInputFields([
      ...inputFields,
      {
        id: uuidv4(),
        source: "",
        goal: "",
        evaluation: {
          motivation: 1,
          resource: 1,
          activity: 1,
          pertinence: 1,
        },
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
      <form className={classes.root} onSubmit={handleSubmit}>
        {inputFields.map((inputField) => (
          <Box
            key={inputField.id}
            display="flex"
            alignItems="center"
            borderTop={1}
            borderColor="grey.500"
          >
            <TextField
              className={classes.textField}
              name="source"
              label="Source de risque"
              value={inputField.source}
              onChange={(event) => handleChangeInput(inputField.id, event)}
            />
            <TextField
              className={classes.textField}
              name="goal"
              label="Objectif Visé"
              multiline
              value={inputField.goal}
              onChange={(event) => handleChangeInput(inputField.id, event)}
            />
            <FormControl className={classes.formControl}>
              <InputLabel id="motivation-select">Motivation</InputLabel>
              <Select
                id="motivation-select"
                name="motivation"
                defaultValue={inputField.evaluation.motivation}
                onClick={(event) => handleChangeInput(inputField.id, event)}
              >
                <MenuItem value={1}>+</MenuItem>
                <MenuItem value={2}>++</MenuItem>
                <MenuItem value={3}>+++</MenuItem>
              </Select>
            </FormControl>
            <FormControl className={classes.formControl}>
              <InputLabel>Ressources</InputLabel>
              <Select
                name="resource"
                defaultValue={inputField.evaluation.resource}
                onClick={(event) => handleChangeInput(inputField.id, event)}
              >
                <MenuItem value={1}>+</MenuItem>
                <MenuItem value={2}>++</MenuItem>
                <MenuItem value={3}>+++</MenuItem>
              </Select>
            </FormControl>
            <FormControl className={classes.formControl}>
              <InputLabel>Activité</InputLabel>
              <Select
                name="activity"
                defaultValue={inputField.evaluation.activity}
                onClick={(event) => handleChangeInput(inputField.id, event)}
              >
                <MenuItem value={1}>+</MenuItem>
                <MenuItem value={2}>++</MenuItem>
                <MenuItem value={3}>+++</MenuItem>
              </Select>
            </FormControl>
            <FormControl className={classes.formControl}>
              <InputLabel>Pertinence</InputLabel>
              <Select
                name="pertinence"
                defaultValue={inputField.evaluation.pertinence}
                onClick={(event) => handleChangeInput(inputField.id, event)}
              >
                <MenuItem value={1}>Faible</MenuItem>
                <MenuItem value={2}>Moyenne</MenuItem>
                <MenuItem value={3}>Élevée</MenuItem>
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
          onClick={handleSubmit}
        >
          Send
        </Button>
      </form>
    </div>
  );
}

Workshop2Form.propTypes = {
    handleSubmit: PropTypes.func,
    initValues: PropTypes.array
}

export default Workshop2Form;
