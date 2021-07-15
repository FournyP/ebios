import React from "react";
import PropTypes from "prop-types";
import {
  Button,
  IconButton,
  FormControl,
  MenuItem,
  InputLabel,
  TextField,
  Box,
  Select,
  makeStyles,
} from "@material-ui/core";
import { RemoveCircle, AddCircle } from "@material-ui/icons";
import { v4 as uuidv4 } from "uuid";

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

function Workshop4Form(props) {
  const classes = useStyles();
  const [inputFields, setInputFields] = React.useState(
    props.initValues.length > 0
      ? props.initValues
      : [{ id: uuidv4(), scenario: "", vraisemblance: 1, toCreate: true }]
  );

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
      { id: uuidv4(), scenario: "", vraisemblance: 1, toCreate: true },
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
              name="scenario"
              label="Scénario Opérationnel"
              multiline
              value={inputField.scenario}
              onChange={(event) => handleChangeInput(inputField.id, event)}
            />

            <FormControl className={classes.formControl}>
              <InputLabel>Vraisemblance</InputLabel>
              <Select
                name="vraisemblance"
                defaultValue={1}
                onClick={(event) => handleChangeInput(inputField.id, event)}
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
