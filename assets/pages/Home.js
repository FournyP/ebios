import React from "react";
import Appbar from "../components/Appbar";
import Table from "../components/Table";
import Alert from "@material-ui/lab/Alert";
import {
  Button,
  Container
} from "@material-ui/core";
import { Link } from "react-router-dom";

async function fetchProjects() {
  let request = new Request(process.env.API_URL + "api/projects", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await (await fetch(request)).json();
}

function Home() {
  const [isLogged, setIsLogged] = React.useState(
    localStorage.getItem("username") ? true : false
  );

  const tableColumns = React.useMemo(() => [
    {
      Header: "Id",
      accessor: "id"
    },
    {
      Header: "Name",
      accessor: "name",
    },
    {
      Header: "Organization",
      accessor: "organization.name",
    },
    {
      Header: "Workshops",
      accessor: "workshops",
    },
  ]);

  const [loadingData, setLoadingData] = React.useState(true);
  const [tableData, setTableData] = React.useState([]);

  React.useEffect(async () => {
    if (loadingData) {
      let response = await fetchProjects();
      setTableData(response["hydra:member"]);
      setLoadingData(false);
    }
  }, []);

  return (
    <div>
      <Appbar />
      <h1>EBIOS HOME PAGE</h1>
      {isLogged ? (
        <Container maxWidth="md">
          <Alert severity="info">
            Connecté : {localStorage.getItem("username")} && Roles :{" "}
            {localStorage.getItem("roles")}
          </Alert>
          <Button component={Link} color="inherit" to="/createorganization">
            Créer une organization
          </Button>
          <Button component={Link} color="inherit" to="/createproject">
            Créer un projet
          </Button>
          {loadingData ? (
            <p>Loading Please wait...</p>
          ) : (
            <Table columns={tableColumns} data={tableData} />
          )}
        </Container>
      ) : (
        <></>
      )}
    </div>
  );
}

export default Home;
