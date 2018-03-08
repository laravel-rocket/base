import React, {Component} from 'react';
import {Switch, Route, Redirect} from 'react-router-dom';
import {Container} from 'reactstrap';
import Header from '../../components/Header/';
import Sidebar from '../../components/Sidebar/';
import Breadcrumb from '../../components/Breadcrumb/';
import Aside from '../../components/Aside/';
import Footer from '../../components/Footer/';
import Dashboard from '../../views/Dashboard/';
import AdminUsers from '../../views/AdminUsers/';

import InformationRepository from '../../repositories/InformationRepository';

class App extends Component {
  constructor() {
    super();
    this.state = {
      params: {
        information: {
          authUser: null,
          notifications: [],
          notificationCount: 0,
        },
      },
      methods: {
        getInformation: this.getInformation.bind(this),
      }
    }
  }

  getInformation() {
    let repository = new InformationRepository();
    repository.getInfo().then(repos => {
      this.setState(...this.state, {params: {information: repos}});
      console.log(this.state);
    });
  }

  componentWillMount() {
    this.getInformation();
  }

  render() {
    return (
      <div className="app">
        <Header params={this.state.params} methods={this.state.methods} {...this.props}/>
        <div className="app-body">
          <Sidebar params={this.state.params} methods={this.state.methods} {...this.props}/>
          <main className="main">
            <Breadcrumb/>
            <Container fluid>
              <Switch>
                <Route path="/dashboard" name="Dashboard" component={Dashboard}/>
                <Route path="/admin-users" name="Admin Users" component={AdminUsers}/>
                <Redirect from="/" to="/dashboard"/>
              </Switch>
            </Container>
          </main>
          <Aside/>
        </div>
        <Footer/>
      </div>
    );
  }
}

export default App;
