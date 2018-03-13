import React, {Component} from 'react';
import {Switch, Route, Redirect} from 'react-router-dom';
import {Container} from 'reactstrap';
import {PropsRoute} from 'react-router-with-props';
import Header from '../../components/Header/';
import Sidebar from '../../components/Sidebar/';
import Breadcrumb from '../../components/Breadcrumb/';
import Aside from '../../components/Aside/';
import Footer from '../../components/Footer/';
import Dashboard from '../../views/Dashboard/';
import InformationRepository from '../../repositories/InformationRepository';

import AdminUserIndex from '../../views/AdminUsers/AdminUserIndex';
import AdminUserShow from '../../views/AdminUsers/AdminUserShow';
import AdminUserEdit from "../../views/AdminUsers/AdminUserEdit";
import ConfirmationModal from "../../components/ConfirmationModal/ConfirmationModal";

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
        confirmation: {
          isOpen: false,
          message: "",
          onOKCallback: null,
          onCancelCallback: null,
        },
      },
      methods: {
        getInformation: this.getInformation.bind(this),
        confirmation: this.confirmation.bind(this),
      }
    };
    this.handleConfirmationOnOK = this.handleConfirmationOnOK.bind(this);
    this.handleConfirmationOnCancel = this.handleConfirmationOnCancel.bind(this);
  }

  getInformation() {
    let repository = new InformationRepository();
    repository.getInfo().then(repos => {
      this.setState({params: {...this.state.params, information: repos}})
    });
  }

  componentWillMount() {
    this.getInformation();
  }

  handleConfirmationOnOK(e) {
    this.setState({
      params: {
        ...this.state.params,
        confirmation: {
          ...this.state.params.confirmation,
          isOpen: false,
        }
      }
    });
    if (this.state.params.confirmation.onOKCallback) {
      this.state.params.confirmation.onOKCallback(e);
    }
  }

  handleConfirmationOnCancel(e) {
    this.setState({
      params: {
        ...this.state.params,
        confirmation: {
          ...this.state.params.confirmation,
          isOpen: false,
        }
      }
    });
    if (this.state.params.confirmation.onCancelCallback) {
      this.state.params.confirmation.onCancelCallback(e);
    }
  }

  // Event Handlers
  confirmation(title, message, onOKCallback, onCancelCallback) {
    this.setState({
      params: {
        ...this.state.params,
        confirmation: {
          ...this.state.params.confirmation,
          title: title,
          message: message,
          isOpen: true,
          onOKCallback: onOKCallback,
          onCancelCallback: onCancelCallback,
        },
      }
    });
  }

  render() {
    return (
      <div className="app">
        <ConfirmationModal
          isOpen={this.state.params.confirmation.isOpen}
          message={this.state.params.confirmation.message}
          onOk={this.handleConfirmationOnOK}
          onCancel={this.handleConfirmationOnCancel}
        />
        <Header params={this.state.params} methods={this.state.methods} {...this.props}/>
        <div className="app-body">
          <Sidebar params={this.state.params} methods={this.state.methods} {...this.props}/>
          <main className="main">
            <div>
              <Breadcrumb/>
              <Container fluid>
                <Switch>
                  <PropsRoute path="/dashboard" name="Dashboard" component={Dashboard} {...this.state}/>
                  <PropsRoute path="/admin-users/:id/edit" name="Admin Users Edit" component={AdminUserEdit} {...this.state}/>
                  <PropsRoute path="/admin-users/create" name="Admin Users Create" component={AdminUserEdit} {...this.state}/>
                  <PropsRoute path="/admin-users/:id" name="Admin Users Show" component={AdminUserShow} {...this.state}/>
                  <PropsRoute path="/admin-users" name="Admin Users" component={AdminUserIndex} {...this.state}/>
                  <Redirect from="/" to="/dashboard"/>
                </Switch>
              </Container>
            </div>
          </main>
          <Aside/>
        </div>
        <Footer/>
      </div>
    );
  }
}

export default App;
