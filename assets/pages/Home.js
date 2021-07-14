import React from "react";
import Appbar from "../components/Appbar";
import Table from "../components/Table";
import Alert from "@material-ui/lab/Alert";
import logo from '../resources/logo.png';
import pierre from '../resources/Pierre.png';
import valentin from '../resources/Valentin.png';
import vincent from '../resources/Vincent.png';
import matthias from '../resources/Matthias.png';
import { makeStyles } from "@material-ui/core/styles";
import EmojiObjectsOutlinedIcon from '@material-ui/icons/EmojiObjectsOutlined';
import WhatshotIcon from '@material-ui/icons/Whatshot';
import LockIcon from '@material-ui/icons/Lock';
import {
  Button,
  Container,
  Typography,
  Box,
  Card,
  CardActionArea,
  CardContent
} from "@material-ui/core";
import { Link } from "react-router-dom";
import Waiting from "../components/Waiting";

async function fetchProjects() {
  let request = new Request(process.env.API_URL + "api/projects", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await (await fetch(request)).json();
}
const useStyles = makeStyles(theme => ({
  logo: {
    maxHeight: 275,
    maxWidth: 275
  },
  tittle: {
    fontWeight: "bold",
    color: "#4A3933",
  },
  icon: {
    fontSize: 100,
    color: "#F0A500",
    marginTop: 25
  },
  photo: {
    maxHeight: 175,
    maxWidth: 175,
    borderColor: "#F0A500",
    borderRadius: 20,
    margin: 10
  }
}));

function Home() {
  const classes = useStyles();
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
    if (isLogged) {
      if (loadingData) {
        let response = await fetchProjects();
        setTableData(response["hydra:member"]);
        setLoadingData(false);
      }
    } else {
      setLoadingData(false);
    }
  }, []);

  return (
    <div style={{ background: "#F8F5F1" }}>
      <Appbar />

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
            <Waiting />
          ) : (
            <Table columns={tableColumns} data={tableData} />
          )}
        </Container>
      ) : (
        <Container maxWidth="lg">

          <Box display="flex" m={2} px={7}>

            <Box display="flex" flexDirection="column" flexGrow={1}
              justifyContent="space-evenly" alignItems="center">
              <Box >
                <Typography variant="h2" className={classes.tittle}>Ebios By Risk&Co.</Typography>
              </Box>
              <Box width="75%" >
                <Typography variant="h5">A l'ère de la transition digitale, le développement numérique est un levier incontournable de l'expansion de nos clients. </Typography>
              </Box>
            </Box>

            <Box flexGrow={1}>
              <img className={classes.logo} src={logo} alt="Logo" />
            </Box>
          </Box>

          <Box display="flex" justifyContent="center">
            <Box maxWidth="60%">
              <Typography variant="h4" className={classes.tittle}>Une prise en compte en continu
                de vos enjeux sécurité</Typography>
            </Box>
          </Box>

          <Box display="flex" flexGrow={1}>
            <Box flexGrow={1} m={3}>
              <Card className={classes.root}>
                <CardActionArea>
                  <LockIcon className={classes.icon} />
                  <CardContent>
                    <Typography gutterBottom variant="h5" component="h2">
                      Votre sécurité
                    </Typography>
                    <Typography variant="body2" color="textSecondary" component="p">
                      Nous vous accompagnons et nous garantissons pour une meilleure sécurité de vos données.
                      Nous vous aidons à exprimer vos menaces ainsi qu'identifier les processus
                      à protéger tout en ne créant pas de nouvelle faille.
                    </Typography>
                  </CardContent>
                </CardActionArea>
              </Card>
            </Box>

            <Box flexGrow={1} m={3}>
              <Card className={classes.root}>
                <CardActionArea>
                  <WhatshotIcon className={classes.icon} />
                  <CardContent>
                    <Typography gutterBottom variant="h5" component="h2">
                      Notre solution
                    </Typography>
                    <Typography variant="body2" color="textSecondary" component="p">
                      Pour vous outiller et faciliter la gestion de la sécurité de vos systèmes d’informations.
                      Des moyens simples pour une évangélisation efficace et une harmonisation de vos
                      pratiques internes afin de vous armer pour une résilience totale.
                    </Typography>
                  </CardContent>
                </CardActionArea>
              </Card>
            </Box>

            <Box flexGrow={1} m={3}>
              <Card className={classes.root}>
                <CardActionArea>
                  <EmojiObjectsOutlinedIcon className={classes.icon} />
                  <CardContent>
                    <Typography gutterBottom variant="h5" component="h2">
                      Nos innovations
                    </Typography>
                    <Typography variant="body2" color="textSecondary" component="p">
                      Nous poursuivons notre R&D pour améliorer continuellement nos outils, anticiper sur les failles de demain,
                      assurer et réussir la protection de vos patrimoines informationnels lors de vos présentes
                      et prochaines transformations numériques.
                    </Typography>
                  </CardContent>
                </CardActionArea>
              </Card>
            </Box>
          </Box>

          <Typography variant="h4" className={classes.tittle}>Notre equipe</Typography>
          <Box display="flex" m={2} px={7}>
            <Box display="flex" flexGrow={1}
              justifyContent="space-around" alignItems="center">

              <Box>
                <img className={classes.photo} src={vincent} alt="photo"
                  border={3} />
                <Typography>Team Manager</Typography>
              </Box>
              <Box>
                <img className={classes.photo} src={matthias} alt="photo"
                  border={3} />
                <Typography>Analyste</Typography>
              </Box>
              <Box>
                <img className={classes.photo} src={pierre} alt="photo"
                  border={3} />
                <Typography>Développeur back-end</Typography>
              </Box>
              <Box>
                <img className={classes.photo} src={valentin} alt="photo"
                  border={3} />
                <Typography>Développeur front-end</Typography>
              </Box>
            </Box>
          </Box>
        </Container>
      )
      }
    </div >
  );
}

export default Home;
