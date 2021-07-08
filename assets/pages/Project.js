import React from "react";
import Appbar from "../components/Appbar";
import { AppBar, Tabs, Tab } from '@material-ui/core';
import TabPanel from '../components/TabPanel';
import { makeStyles } from '@material-ui/core/styles';
import { useParams } from 'react-router-dom';
import WorkShop1 from '../workshops/workshop1';
import WorkShop2 from '../workshops/workshop2';
import WorkShop3 from '../workshops/workshop3';
import WorkShop4 from '../workshops/workshop4';
import WorkShop5 from '../workshops/workshop5';

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        'aria-controls': `simple-tabpanel-${index}`,
    };
}

const useStyles = makeStyles((theme) => ({
    tabs: {
        background: '#555',
    },
    tab1: {
        background: '#c7317c',
    },
    tab2: {
        background: '#6d2a69',
    },
    tab3: {
        background: '#24aca9',
    },
    tab4: {
        background: '#c2a91f',
    },
    tab5: {
        background: '#d54956',
    },
}));

async function fetchProject(projectId) {
  const request = new Request(
    process.env.API_URL + "api/project/" + projectId,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      }
    }
  );

  return await (await fetch(request)).json();
}

function Project() {
    const classes = useStyles();
    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const { id } = useParams();
    const projectId = parseInt(id);

    const project = fetchProject(projectId);

    if (project == null || project == undefined) {
      throw new "Unable to find the project";
    }

    return (
      <div>
        <Appbar />
        <AppBar position="static">
          <Tabs
            value={value}
            onChange={handleChange}
            aria-label="Workshops"
            variant="fullWidth"
            className={classes.tabs}
          >
            <Tab label="Atelier 1" {...a11yProps(0)} className={classes.tab1} />
            <Tab label="Atelier 2" {...a11yProps(1)} className={classes.tab2} />
            <Tab label="Atelier 3" {...a11yProps(2)} className={classes.tab3} />
            <Tab label="Atelier 4" {...a11yProps(3)} className={classes.tab4} />
            <Tab label="Atelier 5" {...a11yProps(4)} className={classes.tab5} />
          </Tabs>
        </AppBar>
        <TabPanel value={value} index={0}>
          <WorkShop1 project={project} />
        </TabPanel>
        <TabPanel value={value} index={1}>
          <WorkShop2 project={project} />
        </TabPanel>
        <TabPanel value={value} index={2}>
          <WorkShop3 project={project} />
        </TabPanel>
        <TabPanel value={value} index={3}>
          <WorkShop4 project={project} />
        </TabPanel>
        <TabPanel value={value} index={4}>
          <WorkShop5 project={project} />
        </TabPanel>
      </div>
    );
}

export default Project;