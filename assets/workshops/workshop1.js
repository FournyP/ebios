import React, { useState } from "react";
import Box from '@material-ui/core/Box';
import TextareaAutosize from '@material-ui/core/TextareaAutosize';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import { makeStyles } from "@material-ui/core/styles";
import Container from '@material-ui/core/Container';
import TextField from '@material-ui/core/TextField';
import IconButton from '@material-ui/core/IconButton';
import RemoveIcon from '@material-ui/icons/RemoveCircle';
import AddIcon from '@material-ui/icons/AddCircle';
import { v4 as uuidv4 } from 'uuid';
import FormControl from '@material-ui/core/FormControl';
import MenuItem from '@material-ui/core/MenuItem';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';


const useStyles = makeStyles(theme => ({
    textarea: {
        resize: "both",
        width: "75%"
    },
    leftPart: {
        width: "70%",

    },
    rightPart: {
        width: "30%",
    },
    button: {
        width: "25%",
        marginTop: theme.spacing(1)
    },
    formControl: {
        margin: theme.spacing(1),
        minWidth: "15%",
    },
    textField: {
        margin: theme.spacing(1),
        width: "23%",
    },
    header: {
        background: '#c7317c',
        color: "white"
    }
}));
function Workshop1() {
    const classes = useStyles();

    // Function used to perimeter
    const [perimeter, setPerimeter] = useState([
        {
            id: uuidv4(), mission: '', denominationVM: '',
            natureVM: '', responsableVM: '', descriptionVM: '',
        },
    ]);

    const handleSubmitPerimeter = (e) => {
        e.preventDefault();
        console.log("Perimeter", perimeter);
    };

    const handleChangeInputPerimeter = (id, event) => {
        const newPerimeter = perimeter.map(i => {
            if (id === i.id) {
                i[event.target.name] = event.target.value
            }
            return i;
        })
        setPerimeter(newPerimeter);
    }

    const handleAddFieldsPerimeter = () => {
        setPerimeter([...perimeter, { id: uuidv4(), gravite: 1 }])
    }

    const handleRemoveFieldsPerimeter = id => {
        const values = [...perimeter];
        values.splice(values.findIndex(value => value.id === id), 1);
        setPerimeter(values);
    }

    // Function used to feared event
    const [feardEvents, setfeardEvents] = useState([
        { id: uuidv4(), valeurMetier: '', evenementRedouté: '', evenementRedouté: '', impacts: '', gravite: 1 },
    ]);

    const handleSubmitFearedEvents = (e) => {
        e.preventDefault();
        console.log("feardEvents", feardEvents);
    };

    const handleChangeInputFearedEvents = (id, event) => {
        const newfeardEvents = feardEvents.map(i => {
            if (id === i.id) {
                i[event.target.name] = event.target.value
            }
            return i;
        })
        setfeardEvents(newfeardEvents);
    }

    const handleAddFieldsFearedEvents = () => {
        setfeardEvents([...feardEvents, { id: uuidv4(), valeurMetier: '', evenementRedouté: '', impacts: '', gravite: 1 }])
    }

    const handleRemoveFieldsFearedEvents = id => {
        const values = [...feardEvents];
        values.splice(values.findIndex(value => value.id === id), 1);
        setfeardEvents(values);
    }

    return (
        <Box flexDirection="row">
            <h2>DÉFINITION DU PÉRIMÈTRE MÉTIER ET TECHNIQUE</h2>

            {perimeter.map(inputField => (
                <Box
                    key={inputField.id}
                    display="flex"
                    borderTop={3}
                    borderColor="#c7317c">
                    <Box display="flex"
                        flexGrow={1}>

                        <Box className={classes.leftPart}>
                            <h4>Valeur métier</h4>
                            <TextField
                                name="mission"
                                label="Mission"
                                className={classes.textField}
                                style={{ width: "45%" }}
                                multiline
                                value={inputField.mission}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                name="denominationValeurMetier"
                                label="Dénomination Valeur Métier"
                                className={classes.textField}
                                style={{ width: "45%" }}
                                multiline
                                value={inputField.denominationVM}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                name="natureValeurMetier"
                                label="Nature Valeur Métier"
                                className={classes.textField}
                                style={{ width: "30%" }}
                                multiline
                                value={inputField.natureVM}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                name="responsable"
                                label="Responsable"
                                className={classes.textField}
                                style={{ width: "30%" }}
                                multiline
                                value={inputField.responsableVM}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                width="100%"
                                name="description"
                                label="Description"
                                className={classes.textField}
                                style={{ width: "30%" }}
                                multiline
                                value={inputField.descriptionVM}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                        </Box>

                        <Box className={classes.righPart}>
                            <h4>Bien Support Associé</h4>
                            <TextField
                                name="bienAssocie"
                                label="Bien associé"
                                className={classes.textField}
                                style={{ width: "45%" }}
                                multiline
                                value={inputField.valeurMetier}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                name="responsable"
                                label="Responsable"
                                className={classes.textField}
                                style={{ width: "45%" }}
                                multiline
                                value={inputField.responsable}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                            <TextField
                                name="description"
                                label="Description"
                                className={classes.textField}
                                style={{ width: "93%" }}
                                multiline
                                value={inputField.description}
                                onChange={event => handleChangeInputPerimeter(inputField.id, event)}
                            />
                        </Box>
                    </Box>
                    <IconButton disabled={perimeter.length === 1} onClick={() => handleRemoveFieldsPerimeter(inputField.id)}>
                        <RemoveIcon />
                    </IconButton>
                    <IconButton onClick={handleAddFieldsPerimeter}>
                        <AddIcon />
                    </IconButton>
                </Box>
            ))
            }
            <Box>
                <Button variant="contained" color="primary" className={classes.button}>
                    Sauvegarder
                </Button>
            </Box>

            <h2>IDENTIFICATION DES ÉVÉNEMENTS REDOUTÉS</h2>
            <Box display="flex" alignItems="center" className={classes.header} textAlign="left">
                <Box className={classes.textField}>
                    <h3>Valeur Métier</h3>
                </Box>
                <Box className={classes.textField}>
                    <h3>Evènement redouté</h3>
                </Box>
                <Box className={classes.textField}>
                    <h3>Impacts</h3>
                </Box>
                <Box className={classes.formControl}>
                    <h3>Gravité</h3>
                </Box>
            </Box >
            <form onSubmit={handleSubmitFearedEvents}>
                {feardEvents.map(inputField => (
                    <Box key={inputField.id}
                        display="flex"
                        alignItems="center"
                        borderTop={1}
                        borderColor="grey.500">
                        <TextField
                            name="valeurMetier"
                            label="Valeur Métier"
                            className={classes.textField}
                            multiline
                            value={inputField.valeurMetier}
                            onChange={event => handleChangeInputFearedEvents(inputField.id, event)}
                        />
                        <TextField
                            name="evenementRedouté"
                            label="Evènement redouté"
                            className={classes.textField}
                            multiline
                            value={inputField.evenementRedouté}
                            onChange={event => handleChangeInputFearedEvents(inputField.id, event)}
                        />
                        <TextField
                            name="impacts"
                            label="Impacts"
                            className={classes.textField}
                            multiline
                            value={inputField.impacts}
                            onChange={event => handleChangeInputFearedEvents(inputField.id, event)}
                        />
                        <FormControl className={classes.formControl}>
                            <InputLabel>Gravité</InputLabel>
                            <Select
                                name="gravite"
                                defaultValue={1}
                                onClick={event => handleChangeInputFearedEvents(inputField.id, event)}>
                                <MenuItem value={1}>Mineur</MenuItem>
                                <MenuItem value={2}>Significative</MenuItem>
                                <MenuItem value={3}>Critique</MenuItem>
                                <MenuItem value={4}>Grave</MenuItem>
                            </Select>
                        </FormControl>
                        <IconButton disabled={feardEvents.length === 1} onClick={() => handleRemoveFieldsFearedEvents(inputField.id)}>
                            <RemoveIcon />
                        </IconButton>
                        <IconButton onClick={handleAddFieldsFearedEvents}>
                            <AddIcon />
                        </IconButton>
                    </Box>
                ))}
                <Button
                    className={classes.button}
                    variant="contained"
                    color="primary"
                    type="submit"
                    onClick={handleSubmitFearedEvents}>
                    Sauvegarder</Button>
            </form>


        </Box >
    );
}

export default Workshop1;