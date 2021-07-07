import React, { useState } from "react";
import PropTypes from "prop-types";
import Box from '@material-ui/core/Box';
import TextareaAutosize from '@material-ui/core/TextareaAutosize';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import { makeStyles } from "@material-ui/core/styles";
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
    button: {
        width: "33%",
        marginTop: theme.spacing(1)
    },
    formControl: {
        margin: theme.spacing(1),
        minWidth: "15%",
    },
    faibleMenu: {
        color: "blue",
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
function Workshop1(props) {
    const classes = useStyles();
    const [feardEvents, setfeardEvents] = useState([
        { id: uuidv4(), valeurMetier: '', evenementRedouté: '', evenementRedouté: '', impacts: '', gravite: 1 },
    ]);

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("feardEvents", feardEvents);
    };

    const handleChangeInput = (id, event) => {
        const newfeardEvents = feardEvents.map(i => {
            if (id === i.id) {
                i[event.target.name] = event.target.value
            }
            return i;
        })

        setfeardEvents(newfeardEvents);
    }

    const handleAddFields = () => {
        setfeardEvents([...feardEvents, { id: uuidv4(), valeurMetier: '', evenementRedouté: '', impacts: '', gravite: 1 }])
    }

    const handleRemoveFields = id => {
        const values = [...feardEvents];
        values.splice(values.findIndex(value => value.id === id), 1);
        setfeardEvents(values);
    }

    return (
        <Box flexDirection="row">
            <h2>1/ DÉFINIR LE PÉRIMÈTRE MÉTIER ET TECHNIQUE</h2>
            <Box>
                <Typography > MISSIONS </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > DÉNOMINATION DE LA VALEUR MÉTIER </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > NATURE DE LA VALEUR MÉTIER (PROCESSES OU INFORMATION) </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > DESCRIPTION </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > ENTITÉ OU PERSONNE RESPONSABLE (INTERNE / EXTERNE) </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > DÉNOMINATION DU / DES BIEN(S) SUPPORT(S) ASSOCIÉ(S) </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > DESCRIPTION </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Typography > ENTITÉ OU PERSONNE RESPONSABLE (INTERNE / EXTERNE) </Typography>
                <TextareaAutosize
                    aria-label="minimum height"
                    rowsMin={3}
                    className={classes.textarea} />
            </Box>
            <Box>
                <Button variant="contained" color="primary" className={classes.button}>
                    SEND
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
            <form onSubmit={handleSubmit}>
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
                            value={inputField.valeurMetier}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <TextField
                            name="evenementRedouté"
                            label="Evènement redouté"
                            className={classes.textField}
                            multiline
                            value={inputField.evenementRedouté}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <TextField
                            name="impacts"
                            label="Impacts"
                            className={classes.textField}
                            multiline
                            value={inputField.impacts}
                            onChange={event => handleChangeInput(inputField.id, event)}
                        />
                        <FormControl className={classes.formControl}>
                            <InputLabel>Gravité</InputLabel>
                            <Select
                                name="gravite"
                                defaultValue={1}
                                onClick={event => handleChangeInput(inputField.id, event)}>
                                <MenuItem value={1}>Mineur</MenuItem>
                                <MenuItem value={2}>Significative</MenuItem>
                                <MenuItem value={3}>Critique</MenuItem>
                                <MenuItem value={4}>Grave</MenuItem>
                            </Select>
                        </FormControl>
                        <IconButton disabled={feardEvents.length === 1} onClick={() => handleRemoveFields(inputField.id)}>
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


        </Box>
    );
}

Workshop1.propTypes = {
  projectId: PropTypes.number,
};

export default Workshop1;