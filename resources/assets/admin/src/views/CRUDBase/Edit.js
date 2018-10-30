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

  constructor(props) {
    super(props);
    this.setRelationRepository();
  }

  setRelationRepository() {
    this.relationRepositories = {};
  }

  bindMethods() {
    this.get = this.get.bind(this);
    this.handleOnSubmit = this.handleOnSubmit.bind(this);
    this.getRelationCandidates = this.getRelationCandidates.bind(this);
    this.handleModelChange = this.handleModelChange.bind(this);
  }

  setInitialState(props) {
    this.state = {
      model: {},
      initialModel: {},
      id: 0,
      relationModels: {}
    };
  }

  componentWillMount() {
    let {id} = this.props.match.params;
    this.setState({
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

  handleModelChange(model) {
    this.setState({
      model: model,
    });
  }

  get(id) {
    this.repository.show(id).then(repos => {
      this.setState({id: id, model: repos, initialModel: repos});
      console.log(this.state);
    }).catch(error => {
      this.props.methods.errorMessage('Data Fetch Failed. Please access again later');
    });
  }

  getRelationCandidates(name, searchWord) {
    if( !this.relationRepositories[name] ) {
      console.log('No Repositories');
      console.log(this.relationRepositories);
      if (!searchWord) {
        return Promise.resolve({ options: [] });
      }
    }

    const repository = this.relationRepositories[name];

    return repository.index(0, 100, '', '', searchWord, []).then(repos => {
      const relations = {...this.state.relationModels};
      relations[name] = repos.items;
      this.setState({
        ...this.state,
        'relationModels': relations
      });
      console.log(this.state);
      console.log(relations);
      return {options: repos.items};
    }).catch(error => {
      console.log(error);
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
                  initialModel={this.state.initialModel}
                  selectCandidates={this.relationModels}
                  onSubmit={this.handleOnSubmit}
                  onSelect={this.getRelationCandidates}
                  onModelChange={this.handleModelChange}
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
