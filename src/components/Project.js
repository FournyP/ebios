import Appbar from "./Appbar";
import React from 'react';
import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import { makeStyles } from '@material-ui/core/styles';

import WorkShop1 from './workshops/workshop1';
import WorkShop2 from './workshops/workshop2';
import WorkShop3 from './workshops/workshop3';
import WorkShop4 from './workshops/workshop4';
import WorkShop5 from './workshops/workshop5';

function TabPanel(props) {
    const { children, value, index, ...other } = props;
    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box p={3}>
                    <Typography>{children}</Typography>
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired,
};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        'aria-controls': `simple-tabpanel-${index}`,
    };
}

const useStyles = makeStyles((theme) => ({
    tabs: {
        background: '#555',
    }
}));

function Project() {
    const classes = useStyles();
    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };
    return (
        <div className="Project">
            <Appbar />
            <AppBar position="static">
                <Tabs
                    value={value}
                    onChange={handleChange}
                    aria-label="Workshops"
                    variant="fullWidth"
                    className={classes.tabs}
                >
                    <Tab label="Atelier 1" {...a11yProps(0)} />
                    <Tab label="Atelier 2" {...a11yProps(1)} />
                    <Tab label="Atelier 3" {...a11yProps(2)} />
                    <Tab label="Atelier 4" {...a11yProps(3)} />
                    <Tab label="Atelier 5" {...a11yProps(4)} />
                </Tabs>
            </AppBar>
            <TabPanel value={value} index={0}>
                <WorkShop1 />
            </TabPanel>
            <TabPanel value={value} index={1}>
                <WorkShop2 />
            </TabPanel>
            <TabPanel value={value} index={2}>
                <WorkShop3 />
            </TabPanel>
            <TabPanel value={value} index={3}>
                <WorkShop4 />
            </TabPanel>
            <TabPanel value={value} index={4}>
                <WorkShop5 />
            </TabPanel>
        </div >
    );
}

export default Project;