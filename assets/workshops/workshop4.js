import React from "react";
import PropTypes from "prop-types";
import { Box, Container, makeStyles } from "@material-ui/core";
import Workshop4Form from "../components/Workshop4Form";
import Waiting from "../components/Waiting";

const useStyles = makeStyles((theme) => ({
  formControl: {
    margin: theme.spacing(1),
    minWidth: "18%",
  },
  textField: {
    margin: theme.spacing(1),
    minWidth: "70%",
  },
  header: {
    background: "#c2a91f",
    color: "white",
  },
}));

async function fetchOperationalScenarios(workshopRef) {
  const request = new Request(
    process.env.API_URL + "api/operational_scenarios?workshop2=" + workshopRef,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  return await (await fetch(request)).json();
}

function createOperationalScenarioPostRequest(operationalScenario) {
  return new Request(process.env.API_URL + "api/operational_scenarios", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(operationalScenario),
  });
}

function createOperationalScenarioPutRequest(operationalScenario, operationalScenarioId) {
  return new Request(
    process.env.API_URL + "api/operational_scenarios/" + operationalScenarioId,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(operationalScenario),
    }
  );
}

async function sendOperationalScenarios(workshopRef, inputFields) {
  let requests = [];
  for (let operationalScenario of inputFields) {
    let request;
    let operationalScenarioId = operationalScenario.id;
    delete operationalScenario.id;
    operationalScenario.workshop4 = workshopRef;
    operationalScenario.strategicScenario = operationalScenario.scenario["@id"];
    delete operationalScenario.scenario;

    if (operationalScenario.toCreate) {
      request = createOperationalScenarioPostRequest(operationalScenario);
    } else {
      request = createOperationalScenarioPutRequest(
        operationalScenario,
        operationalScenarioId
      );
    }

    requests.push(request);
  }

  return await Promise.all(
    requests.map((request) => {
      return fetch(request);
    })
  );
}

function Workshop4(props) {
  const classes = useStyles();
  const [operationalScenarios, setOperationalScenarios] = React.useState([]);
  const [isLoading, setIsLoading] = React.useState(true);

  const initView = async () => {
    let response = await fetchOperationalScenarios(props.project.workshop4["@id"]);
    let collection = response["hydra:member"];
    collection.map((operationalScenario) => {
      operationalScenario.toCreate = false;
    });
    setOperationalScenarios(collection);
    setIsLoading(false);
  };

  React.useEffect(async () => {
    if (isLoading) {
      await initView();
    }
  }, []);

  const handleSubmit = async (inputFields) => {
    await sendOperationalScenarios(props.project.workshop4["@id"], inputFields);
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
          {/* Table header */}
          <Box display="flex" alignItems="center" className={classes.header}>
            <Box
              className={classes.textField}
              borderRight={1}
              borderColor="grey.500"
            >
              <h3>Scénarios stratégic</h3>
            </Box>
            <Box className={classes.formControl}>
              <h3>Vraisemblance</h3>
            </Box>
          </Box>
          <Workshop4Form
            handleSubmit={handleSubmit}
            initValues={operationalScenarios}
          />
        </div>
      )}
    </Container>
  );
}

Workshop4.propTypes = {
  project: PropTypes.object,
};

export default Workshop4;
