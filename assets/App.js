import React from "react";
import "./App.css";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Home from "./components/Home";
import Signin from "./components/Signin";
import Signup from "./components/Signup";
import Project from "./components/Project";
import CreateProject from "./components/CreateProject";
import CreateOrganization from "./components/CreateOrganization";

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
