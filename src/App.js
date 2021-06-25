import './App.css';
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Home from './components/Home';
import Signin from './components/Signin';
import Signup from './components/Signup';
import Project from './components/Project';

function App() {
  return (
    <div className="App">
      <Router>
        <Switch>
          <Route exact from="/" component={Home} />
          <Route exact from="/Signin" component={Signin} />
          <Route exact from="/Signup" component={Signup} />
          <Route exact from="/Project" component={Project} />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
