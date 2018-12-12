import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBody,
  Button,
} from "reactstrap";

import ShowTable from "../../components/ShowTable/ShowTable";
import Base from "./Base";

class Show extends Base {

  bindMethods() {
    this.get = this.get.bind(this);
    this.handleEditClick = this.handleEditClick.bind(this);
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

  // Event Handlers
  handleEditClick() {
    this.props.history.push(this.path + '/' + this.props.match.params.id + '/edit');
  }

  // Utility Functions
  get(id) {
    this.repository.show(id).then(repos => {
      this.setState({params: {model: repos}});
      console.log(this.state);
    }).catch(error => {
      this.props.methods.errorMessage('Data Fetch Failed. Please access again later');
    });
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                {this.title}
                <Button className="float-right" size="sm" color="primary" onClick={e => { this.handleEditClick() }}>
                  <i className="fa fa-pencil"></i> Edit
                </Button>
              </CardHeader>
              <CardBody className="card-body">
                <ShowTable
                  columns={this.columns.show}
                  columnInfo={this.columns.columns}
                  model={this.state.params.model}
                />
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default Show;
