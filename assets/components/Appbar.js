import React, { useState } from "react";
import {
  AppBar,
  Toolbar,
  Typography,
  Button,
  Menu,
  MenuItem,
  IconButton,
  makeStyles,
} from "@material-ui/core";
import { Link, useHistory } from "react-router-dom";
import AccountCircleIcon from "@material-ui/icons/AccountCircle";

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
  const [isLogged, setIsLogged] = useState(
    localStorage.getItem("username") ? true : false
  );

  const [anchorEl, setAnchorEl] = React.useState(null);

  const isMenuOpen = Boolean(anchorEl);

  const handleProfileMenuOpen = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleMenuClose = () => {
    setAnchorEl(null);
  };

  const handleLogout = () => {
    localStorage.removeItem("username");
    localStorage.removeItem("roles");
    setIsLogged(false);
    window.location.reload();
    handleMenuClose();
  };

  function handleClick() {
    history.push("/");
  }

  const menuId = "primary-search-account-menu";
  const renderMenu = (
    <Menu
      anchorEl={anchorEl}
      anchorOrigin={{ vertical: "top", horizontal: "right" }}
      id={menuId}
      keepMounted
      transformOrigin={{ vertical: "top", horizontal: "right" }}
      open={isMenuOpen}
      onClose={handleMenuClose}
    >
      {isLogged ? (
        <MenuItem onClick={handleLogout}>Logout</MenuItem>
      ) : (
        <>
          <MenuItem
            color="inherit"
            component={Link}
            to="/signup"
            onClick={handleMenuClose}
          >
            Signup
          </MenuItem>
          <MenuItem
            color="inherit"
            component={Link}
            to="/signin"
            onClick={handleMenuClose}
          >
            Login
          </MenuItem>
        </>
      )}
    </Menu>
  );

  return (
    <div className={classes.root}>
      <AppBar position="static" className={classes.background}>
        <Toolbar>
          <Typography className={classes.title} onClick={handleClick}>
            EBIOS Risk Manager
          </Typography>
          <div className={classes.sectionDesktop}>
            <IconButton
              edge="end"
              aria-label="account of current user"
              aria-controls={menuId}
              aria-haspopup="true"
              onClick={handleProfileMenuOpen}
              color="inherit"
            >
              <AccountCircleIcon />
            </IconButton>
          </div>
        </Toolbar>
      </AppBar>
      {renderMenu}
    </div>
  );
}
export default Appbar;
