import React, { useState } from 'react';
import Container from '@material-ui/core/Container';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import RemoveIcon from '@material-ui/icons/Remove';
import AddIcon from '@material-ui/icons/Add';
import { v4 as uuidv4 } from 'uuid';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';

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
        minWidth: 130,
    },
    faibleMenu: {
        color: "blue",
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
            <form className={classes.root} onSubmit={handleSubmit}>
                {inputFields.map(inputField => (
                    <div key={inputField.id}>
                        <TextField
                            name="sourceRisk"
                            label="Source de risque"
                            variant="filled"
                            value={inputField.sourceRisk}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <TextField
                            name="objectif"
                            label="Objectif Visé"
                            variant="filled"
                            multiline
                            value={inputField.objectif}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <FormControl variant="outlined" className={classes.formControl}>
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
                        <FormControl variant="outlined" className={classes.formControl}>
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
                        <FormControl variant="outlined" className={classes.formControl}>
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
                        <FormControl variant="outlined" className={classes.formControl}>
                            <InputLabel>Pertinence</InputLabel>
                            <Select
                                name="pertinence"
                                defaultValue={1}
                                onClick={event => handleChangeInput(inputField.id, event)}
                            >
                                <MenuItem value={1} className={classes.faibleMenu}>Faible</MenuItem>
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
                    </div>
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