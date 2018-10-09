import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBlock,
  Button,
} from "reactstrap";

import IndexList from "../../components/IndexList/IndexList";
import Base from "./Base";

class Index extends Base {

  bindMethods() {
    this.getIndexList = this.getIndexList.bind(this);
    this.handleShowClick = this.handleShowClick.bind(this);
    this.handleEditClick = this.handleEditClick.bind(this);
    this.handleDeleteClick = this.handleDeleteClick.bind(this);
    this.deleteItem = this.deleteItem.bind(this);
    this.reloadPage = this.reloadPage.bind(this);
    this.getIndexListByPage = this.getIndexListByPage.bind(this);
    this.handleCreateNew = this.handleCreateNew.bind(this);
  }

  setInitialState(props) {
    this.state = {
      params: {
        offset: 0,
        limit: this.getDefaultPageSize(),
        order: this.getDefaultOrder(),
        direction: this.getDefaultDirection(),
        searchWord: '',
        page: 1,
        queryParams: {},
        list: {},
      },
      methods: {
        getIndexList: this.getIndexList.bind(this),
      }
    }
  }

  getDefaultPageSize() {
    return 20;
  }

  getDefaultOrder() {
    return 'id';
  }

  getDefaultDirection() {
    return 'asc';
  }

  componentWillMount() {
    this.getIndexList(
      this.state.params.offset,
      this.state.params.limit,
      this.state.params.order,
      this.state.params.direction
    );
  }

  componentWillReceiveProps(newProps) {
  }

  getIndexListByPage(page) {
    if (page < 1) {
      page = 1;
    }
    this.getIndexList(
      this.state.params.limit * (page - 1),
      this.state.params.limit,
      this.state.params.order,
      this.state.params.direction,
      this.state.params.searchWord,
      this.state.params.queryParams
    );
  }

  reloadPage() {
    this.getIndexList(
      this.state.params.offset,
      this.state.params.limit,
      this.state.params.order,
      this.state.params.direction,
      this.state.params.searchWord,
      this.state.params.queryParams
    );

  }

  getIndexList(offset, limit, order, direction, searchWord = '', params = {}) {
    this.repository.index(offset, limit, order, direction, searchWord, params).then(repos => {
      this.setState({
        params: {
          ...this.state.params,
          offset: offset,
          limit: limit,
          order: order,
          direction: direction,
          searchWord: searchWord,
          queryParams: params,
          list: repos,
          page: Math.floor(offset / limit) + 1,
        }
      });
    }).catch(error => {
      this.props.methods.errorMessage('Data Fetch Failed. Please access again later');
    });
  }

  deleteItem(id) {
    this.repository.destroy(id).then(repos => {
      this.props.methods.successMessage('Delete Item Successfully');
      this.reloadPage();
    }).catch(error => {
      this.props.methods.errorMessage('Delete Item Failed');
    });
  }

  handleShowClick(id) {
    this.props.history.push(this.path + '/' + id);
  }

  handleEditClick(id) {
    this.props.history.push(this.path + '/' + id + '/edit');
  }

  handleCreateNew() {
    this.props.history.push(this.path + '/create');
  }

  handleDeleteClick(id) {
    this.props.methods.confirmation('Delete Data', 'Are you okay to delete this item?', () => {
      this.deleteItem(id)
    }, null)
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                {this.title}
                <Button className="float-right" size="sm" color="primary" onClick={this.handleCreateNew}>
                  <i className="fa fa-plus-circle"></i> Create New
                </Button>
              </CardHeader>
              <CardBlock className="card-body">
                <IndexList
                  activePage={this.state.params.page}
                  totalItemCount={this.state.params.list.count || 0}
                  basePath={this.path}
                  columns={this.columns.list}
                  columnInfo={this.columns.columns}
                  list={this.state.params.list}
                  getIndexList={this.getIndexListByPage}
                  onDeleteClick={this.handleDeleteClick}
                  onEditClick={this.handleEditClick}
                  onShowClick={this.handleShowClick}
                />
              </CardBlock>
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default Index;
