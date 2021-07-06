import React from "react";
import "./App.css";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Home from "./pages/Home";
import Signin from "./pages/Signin";
import Signup from "./pages/Signup";
import Project from "./pages/Project";
import CreateProject from "./pages/CreateProject";
import CreateOrganization from "./pages/CreateOrganization";

function App() {
  return (
    <div className="App">
      <Router>
        <Switch>
          <Route exact from="/">
            <Home />
          </Route>
          <Route exact from="/Signin">
            <Signin />
          </Route>
          <Route exact from="/Signup">
            <Signup />
          </Route>
          <Route exact from="/Project">
            <Project />
          </Route>
          <Route exact from="/CreateProject">
            <CreateProject />
          </Route>
          <Route exact from="/CreateOrganization">
            <CreateOrganization />
          </Route>
        </Switch>
      </Router>
    </div>
  );
}

export default App;
