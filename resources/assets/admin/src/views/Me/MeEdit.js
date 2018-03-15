import React from "react";

import MeRepository from "../../repositories/MeRepository";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'
import Edit from "../CRUDBase/Edit";

class MeEdit extends Edit {

  componentWillMount() {
    this.setState({
      ...this.state,
      id: 0,
    });
    this.get();
  }

  setPageInfo() {
    this.title = info.title;
    this.path = info.path;
  }

  setRepository() {
    this.repository = new MeRepository();
  }

  handleOnSubmit(formData) {
    this.repository.updateMe(formData).then(repos => {
      this.setState({id: repos.id, model: repos});
      this.props.methods.successMessage('Successfully Updated ');
    });
  }

  get() {
    this.repository.showMe().then(repos => {
      this.setState({id: repos.id, model: repos});
      console.log(this.state);
    }).catch(error => {
      this.props.methods.errorMessage('Data Fetch Failed. Please access again later');
    });
  }

  setColumnInfo() {
    this.columns = columns;
  }
}

export default withRouter(MeEdit);
