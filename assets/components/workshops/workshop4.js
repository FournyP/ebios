import React, { useState } from "react";
import Container from '@material-ui/core/Container';
import TextField from '@material-ui/core/TextField';
import Box from '@material-ui/core/Box';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import RemoveIcon from '@material-ui/icons/RemoveCircle';
import AddIcon from '@material-ui/icons/AddCircle';
import { v4 as uuidv4 } from 'uuid';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';

import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles((theme) => ({
    button: {
        margin: theme.spacing(1),
    },
    formControl: {
        margin: theme.spacing(1),
        minWidth: "18%",
    },
    texField: {
        margin: theme.spacing(1),
        minWidth: "70%",
    },
    header: {
        background: '#c2a91f',
        color: "white"
    }
}))

function Workshop4() {
    const classes = useStyles()
    const [inputFields, setInputFields] = useState([
        { id: uuidv4(), scenario: '', vraisemblance: 1 },
    ]);

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("InputFields", inputFields);
    };

    const handleChangeInput = (id, event) => {
        const newInputFields = inputFields.map(i => {
            if (id === i.id) {
                i[event.target.name] = event.target.value
            }
            return i;
        })
        setInputFields(newInputFields);
    }

    const handleAddFields = () => {
        setInputFields([...inputFields, { id: uuidv4(), scenario: '', vraisemblance: 1 }])
    }

    const handleRemoveFields = id => {
        const values = [...inputFields];
        values.splice(values.findIndex(value => value.id === id), 1);
        setInputFields(values);
    }
    return (
        <Container>
            {/* Table header */}
            <Box display="flex" alignItems="center" className={classes.header}>
                <Box className={classes.texField}
                    borderRight={1}
                    borderColor="grey.500">
                    <h3>Scénarios opérationnels</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Vraisemblance</h3>
                </Box>
            </Box>

            {/* Example of sending data :
            Array(
            {id: "737a8730-144b-4707-815d-aa762d136a0c", scenario: "Un concurrent vole [...] informatique", vraisemblance: 4}
            {id: "47ab8d3b-243b-4053-bc57-0ecdb29b11f2", scenario: "Un hacktiviste perturbe [...] étiquetage", vraisemblance: 1}
            ) */}
            <form onSubmit={handleSubmit}>
                {inputFields.map(inputField => (
                    <Box key={inputField.id}
                        display="flex"
                        alignItems="center"
                        borderTop={1}
                        borderColor="grey.500">

                        <TextField
                            className={classes.texField}
                            name="scenario"
                            label="Scénario Opérationnel"
                            multiline
                            value={inputField.scenario}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />

                        <FormControl className={classes.formControl}>
                            <InputLabel>Vraisemblance</InputLabel>
                            <Select
                                name="vraisemblance"
                                defaultValue={1}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={1}>V1 Peu Vraisemblable</MenuItem>
                                <MenuItem value={2}>V2 Vraisemblable</MenuItem>
                                <MenuItem value={3}>V3 Très Vraisemblable</MenuItem>
                                <MenuItem value={4}>V4 Quasi-certain</MenuItem>
                            </Select>
                        </FormControl>

                        <IconButton disabled={inputFields.length === 1} onClick={() => handleRemoveFields(inputField.id)}>
                            <RemoveIcon />
                        </IconButton>

                        <IconButton onClick={handleAddFields}>
                            <AddIcon />
                        </IconButton>
                    </Box>
                ))}
                <Button
                    className={classes.button}
                    variant="contained"
                    color="primary"
                    type="submit"
                    onClick={handleSubmit}
                >Send</Button>
            </form>
        </Container >
    );
}

export default Workshop4;