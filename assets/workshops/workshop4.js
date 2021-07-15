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

async function fetchOperationalScenarios() {
  const request = new Request(
    process.env.API_URL + "api/operational_scenarios",
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

function createOperationelScenatioPutRequest(operationalScenario) {
  return new Request(
    process.env.API_URL + "api/operational_scenarios/" + operationalScenario.id,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(operationalScenario),
    }
  );
}

async function sendOperationalScenarios(workshopId, inputFields) {
  let requests = [];
  for (let field of inputFields) {
    let request;
    if (field.toCreate) {
      request = createOperationalScenarioPostRequest(field);
    } else {
      request = createOperationelScenatioPutRequest(field);
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
    let response = await fetchOperationalScenarios();
    let collection = response["hydra:member"];
    collection.map((operationalScenario) => {
      operationalScenario.toCreate = false;
    });
    setOperationalScenarios(collection);
  };

  React.useEffect(async () => {
    if (isLoading) {
      await initView();
      setIsLoading(false);
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
