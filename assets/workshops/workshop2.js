import React from "react";
import PropTypes from "prop-types";
import { Container, Box, makeStyles } from "@material-ui/core";
import Waiting from "../components/Waiting";
import Workshop2Form from "../components/Workshop2Form";

const useStyles = makeStyles((theme) => ({
  formControl: {
    margin: theme.spacing(1),
    width: "10%",
  },
  textField: {
    margin: theme.spacing(1),
    width: "20%",
  },
  header: {
    background: "#6d2a69",
    color: "white",
  },
}));

async function fetchWorkshop2(projectId) {
  const request = new Request(
    process.env.API_URL + "api/workshop2s/" + projectId.workshop2.id,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  return await (await fetch(request)).json();
}

async function fetchRisks(workshop2Id) {
  const request = new Request(
    process.env.API_URL + "api/risks?workshop2=" + workshop2Id,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  return await (await fetch(request)).json();
}

function createRiskPostRequest(risk) {
  return new Request(process.env.API_URL + "api/risks", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(risk),
  });
}

function createRiskPutRequest(risk, id) {
  return new Request(process.env.API_URL + "api/risks/" + id, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(risk),
  });
}

async function sendRisks(workshopRef, risks) {
  let requests = [];
  for (let risk of risks) {
    let request;
    let riskId = risk.id;
    delete risk.id;
    risk.workshop2 = workshopRef;

    console.log(risk);
    
    if (risk.toCreate) {
      request = createRiskPostRequest(risk);
    } else {
      request = createRiskPutRequest(risk, riskId);
    }

    requests.push(request);
  }

  return await Promise.all(
    requests.map((request) => {
      return fetch(request);
    })
  );
}

function Workshop2(props) {
  const classes = useStyles();
  const [isLoading, setIsLoading] = React.useState(true);
  const [risks, setRisks] = React.useState([]);

  const initView = async () => {
    let response = await fetchRisks();
    let risks = response["hydra:member"];
    risks.map((risk) => {
      risk.toCreate = false;
    });
    setRisks(risks);
    setIsLoading(false);
  };

  React.useEffect(async () => {
    if (isLoading) {
      await initView();
    }
  }, []);

  const handleSubmit = async (inputs) => {
    await sendRisks(props.project.workshop2["@id"], inputs);
    setIsLoading(true);
    await initView();
  };

  return (
    <Container>
      {isLoading ? (
        <div>
          <Waiting />
        </div>
      ) : (
        <div>
          <Box
            display="flex"
            alignItems="center"
            className={classes.header}
            textAlign="left"
          >
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
          </Box>
          <Workshop2Form handleSubmit={handleSubmit} initValues={risks} />
        </div>
      )}
    </Container>
  );
}

{
  /* Array(): 
            {activity: "++" 
            id: "aa1a384e-77ec-4c86-8570-27c8f721fe22" 
            motivation: "++"objectif: "Saboter la camp..."
            pertinence: 2
            ressource: "+"
            sourceRisk: "Hacktiviste"}
            {...}*/
}

Workshop2.propTypes = {
  project: PropTypes.object,
};

export default Workshop2;
