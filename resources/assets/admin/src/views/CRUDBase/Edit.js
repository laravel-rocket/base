import React, {Component} from "react";
import {
  Row,
  Col,
} from "reactstrap";

import EditTable from "../../components/EditTable/EditTable";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'

class Edit extends Component {

  constructor(props) {
    super(props);
    this.setPageInfo();
    this.setColumnInfo();
    this.bindMethods();
    this.setInitialState(props);
    this.setRepository();
  }

  setPageInfo() {
    this.title = info.title;
    this.path = info.path;
  }

  setRepository() {
    this.repository = null;
  }

  setColumnInfo() {
    this.columns = columns;
  }

  bindMethods() {
    this.get = this.get.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
  }

  setInitialState(props) {
    this.state = {
      model: {},
      id: 0,
    };
  }

  componentWillMount() {
    let {id} = this.props.match.params;
    this.setState({
      ...this.state,
      id: id || 0,
    });
    if (id) {
      this.get(id);
    }
  }

  componentWillReceiveProps(newProps) {
  }

  handleOnSubmit(formData) {
    const id = this.state.id;
    if (id > 0) {
      this.repository.update(id, formData).then(repos => {
        this.props.history.push(this.path + '/' + id);
      });
    } else {
      this.repository.store(formData).then(repos => {
        this.props.history.push(this.path + '/' + repos.id);
      });
    }
  }

  get(id) {
    this.repository.show(id).then(repos => {
      this.setState({id: id, model: repos});
      console.log(this.state);
    });
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <EditTable
              title={this.title}
              columns={this.columns.edit}
              columnInfo={this.columns.columns}
              model={this.state.model}
              onSubmit={this.handleOnSubmit}
            />
          </Col>
        </Row>
      </div>
    )
  }
}

export default Edit;
