import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBlock,
} from "reactstrap";

import EditTable from "../../components/EditTable/EditTable";
import Base from "./Base";

class Edit extends Base {

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
        this.props.methods.successMessage('Successfully Updated ');
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
              </CardHeader>
              <CardBlock className="card-body">
                <EditTable
                  columns={this.columns.edit}
                  columnInfo={this.columns.columns}
                  model={this.state.model}
                  onSubmit={this.handleOnSubmit}
                />
              </CardBlock>
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default Edit;
