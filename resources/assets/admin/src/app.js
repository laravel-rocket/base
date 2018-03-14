import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import {createBrowserHistory} from 'history';

// Styles
// Import Font Awesome Icons Set
import 'font-awesome/css/font-awesome.min.css';
  // Import Simple Line Icons Set
import 'simple-line-icons/css/simple-line-icons.css';
// Import Main styles for this application
import '../scss/app.scss'

// Containers
import App from './containers/App/App'

const history = createBrowserHistory();

ReactDOM.render((
  <BrowserRouter history={history} basename="/admin" >
    <Switch>
      <Route path="/" name="Home" component={App}/>
    </Switch>
  </BrowserRouter>
), document.getElementById('root'));
