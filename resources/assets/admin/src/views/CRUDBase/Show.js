import React, {Component} from "react";
import {
  Row,
  Col,
} from "reactstrap";

import ShowTable from "../../components/ShowTable/ShowTable";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'

class Show extends Component {

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
  }

  setInitialState(props) {
    this.state = {
      params: {
        ...props.params,
        model: {},
      },
      methods: {
        ...props.methods,
        get: this.get.bind(this),
      }
    }
  }

  componentWillMount() {
    let {id} = this.props.match.params;
    this.get(id);
  }

  componentWillReceiveProps(newProps) {
    this.setState({
      params: {
        ...newProps.params,
        model: this.state.params.model,
      },
      methods: {
        ...newProps.methods,
        get: this.state.methods.get,
      }
    });
  }

  get(id) {
    this.repository.show(id).then(repos => {
      this.setState({params: {model: repos}});
      console.log(this.state);
    });
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <ShowTable
              title={this.title}
              columns={this.columns.show}
              columnInfo={this.columns.columns}
              model={this.state.params.model}
            />
          </Col>
        </Row>
      </div>
    )
  }
}

export default Show;
