import React, { useState } from "react";
import Appbar from "./Appbar";
import Alert from '@material-ui/lab/Alert';

function Home() {
  const [isLogged, setIsLogged] = useState(localStorage.getItem('username') ? true : false);
  return (
    <div className="Home">
      <Appbar />
      <h1>EBIOS HOME PAGE</h1>
      {isLogged ?
        <Alert severity='info'>
          Connecté : {localStorage.getItem('username')} &&
          Roles : {localStorage.getItem('roles')}
        </Alert> : <></>}
    </div>
  );
}

export default Home;
