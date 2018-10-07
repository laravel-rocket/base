import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBlock,
  Button,
} from "reactstrap";

import ShowTable from "../../components/ShowTable/ShowTable";
import ShowListTable from "../../components/ShowListTable/ShowListTable"
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

  renderList() {
    const lists = [];
    this.columns.show.forEach((item) => {
      if (this.columns.columns[item] && this.columns.columns[item].type === 'list') {
        lists.push(
          (
            <Row>
              <Col xs="12" lg="12">
                <Card>
                  <CardHeader>
                    {this.columns.columns[item].name}
                  </CardHeader>
                  <CardBlock className="card-body">

                    <ShowListTable
                      key={"list-" + item}
                      columns={this.columns.columns[item].columns}
                      items={this.state.params.model[item]}
                    />
                  </CardBlock>
                </Card>
              </Col>
            </Row>
          )
        );
      }
    });

    return lists;
  }

  render() {
    const list = this.renderList();
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                {this.title}
                <Button className="float-right" size="sm" color="primary" onClick={e => {
                  this.handleEditClick()
                }}>
                  <i className="fa fa-pencil"></i> Edit
                </Button>
              </CardHeader>
              <CardBlock className="card-body">
                <ShowTable
                  columns={this.columns.show}
                  columnInfo={this.columns.columns}
                  model={this.state.params.model}
                />
              </CardBlock>
            </Card>
          </Col>
        </Row>
        {list}
      </div>
    )
  }
}

export default Show;
