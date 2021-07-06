import React, { useState } from 'react';
import Container from '@material-ui/core/Container';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import RemoveIcon from '@material-ui/icons/RemoveCircle';
import AddIcon from '@material-ui/icons/AddCircle';
import { v4 as uuidv4 } from 'uuid';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';
import Box from '@material-ui/core/Box';

import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles((theme) => ({
    root: {
        '& .MuiTextField-root': {
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
    },
    header: {
        background: '#6d2a69',
        color: "white"
    }
}))

function Workshop2() {
    const classes = useStyles()
    const [inputFields, setInputFields] = useState([
        {
            id: uuidv4(), sourceRisk: '', objectif: '', motivation: '+',
            ressource: '+', activity: '+', pertinence: 1
        },
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
        setInputFields([...inputFields, {
            id: uuidv4(), sourceRisk: '', objectif: '', motivation: '+',
            ressource: '+', activity: '+', pertinence: 1
        }])
    }

    const handleRemoveFields = id => {
        const values = [...inputFields];
        values.splice(values.findIndex(value => value.id === id), 1);
        setInputFields(values);
    }
    return (
        <Container>
            <Box display="flex" alignItems="center" className={classes.header}>
                <Box className={classes.textField}>
                    <h3>Sources de risques</h3>
                </Box>
                <Box className={classes.textField}>
                    <h3>Objectif Visé</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Motivation</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Ressource</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Activité</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Pertinence</h3>
                </Box>
            </Box >
            <form className={classes.root} onSubmit={handleSubmit}>
                {inputFields.map(inputField => (
                    <Box key={inputField.id}
                        display="flex"
                        alignItems="center"
                        borderTop={1}
                        borderColor="grey.500">
                        <TextField
                            className={classes.textField}
                            name="sourceRisk"
                            label="Source de risque"
                            value={inputField.sourceRisk}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <TextField
                            className={classes.textField}
                            name="objectif"
                            label="Objectif Visé"
                            multiline
                            value={inputField.objectif}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <FormControl className={classes.formControl}>
                            <InputLabel id="motivation-select">Motivation</InputLabel>
                            <Select
                                id="motivation-select"
                                name="motivation"
                                defaultValue={'+'}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={'+'}>+</MenuItem>
                                <MenuItem value={'++'}>++</MenuItem>
                                <MenuItem value={'+++'}>+++</MenuItem>
                            </Select>
                        </FormControl>
                        <FormControl className={classes.formControl}>
                            <InputLabel>Ressources</InputLabel>
                            <Select
                                name="ressource"
                                defaultValue={'+'}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={'+'}>+</MenuItem>
                                <MenuItem value={'++'}>++</MenuItem>
                                <MenuItem value={'+++'}>+++</MenuItem>
                            </Select>
                        </FormControl>
                        <FormControl className={classes.formControl}>
                            <InputLabel>Activité</InputLabel>
                            <Select
                                name="activity"
                                defaultValue={'+'}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={'+'}>+</MenuItem>
                                <MenuItem value={'++'}>++</MenuItem>
                                <MenuItem value={'+++'}>+++</MenuItem>
                            </Select>
                        </FormControl>
                        <FormControl className={classes.formControl}>
                            <InputLabel>Pertinence</InputLabel>
                            <Select
                                name="pertinence"
                                defaultValue={1}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={1}>Faible</MenuItem>
                                <MenuItem value={2}>Moyenne</MenuItem>
                                <MenuItem value={3}>Élevée</MenuItem>
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

export default Workshop2;