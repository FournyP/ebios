import React, { useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import Typography from "@material-ui/core/Typography";
import IconButton from "@material-ui/core/IconButton";
import MenuIcon from "@material-ui/icons/Menu";
import Button from "@material-ui/core/Button";
import { Link } from 'react-router-dom';
import { useHistory } from "react-router-dom";


const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  menuButton: {
    marginRight: theme.spacing(2),
  },
  title: {
    flexGrow: 1,
  },
  background: {
    background: "black",
  },
}));

function Appbar() {
  const history = useHistory();
  const classes = useStyles();
  const [isLogged, setIsLogged] = useState(localStorage.getItem('username') ? true : false);
  const handleLogout = () => {
    localStorage.removeItem("username")
    localStorage.removeItem("roles")
    setIsLogged(false)
    window.location.reload();
  }
  function handleClick() {
    history.push("/");
  }

  return (
    <div className={classes.root}>
      <AppBar position="static" className={classes.background}>
        <Toolbar>
          <IconButton edge="start" color="inherit" aria-label="menu">
            <MenuIcon />
          </IconButton>
          <Typography className={classes.title} onClick={handleClick} >
            EBIOS Risk Manager
          </Typography>
          <div>
            <Button color="inherit" component={Link} to="/signup">Signup</Button>

            {isLogged ?
              <Button color="inherit" onClick={handleLogout}>Logout</Button>
              :
              <Button color="inherit" component={Link} to="/signin">Login</Button>
            }
          </div>
        </Toolbar>
      </AppBar>
    </div >
  );
}
export default Appbar;
