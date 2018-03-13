import React, {Component} from "react";
import {
  Row,
  Col,
} from "reactstrap";

import IndexList from "../../components/IndexList/IndexList";
import columns from './_columns'
import info from './_info'
import {withRouter} from 'react-router-dom'

class Index extends Component {

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
    this.getIndexList = this.getIndexList.bind(this);
    this.handleShowClick = this.handleShowClick.bind(this);
    this.handleEditClick = this.handleEditClick.bind(this);
    this.handleDeleteClick = this.handleDeleteClick.bind(this);
    this.deleteItem = this.deleteItem.bind(this);
    this.reloadPage = this.reloadPage.bind(this);
    this.getIndexListByPage = this.getIndexListByPage.bind(this);
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
      console.log(this.state);
    });
  }

  deleteItem(id) {
    this.repository.destroy(id).then(repos => {
      this.reloadPage();
    });
  }

  handleShowClick(id) {
    this.props.history.push(this.path + '/' + id);
  }

  handleEditClick(id) {
    this.props.history.push(this.path + '/' + id + '/edit');
  }

  handleDeleteClick(id) {
    console.log('Delete Item ' + id);
    this.props.methods.confirmation('Delete Data', 'Are you okay to delete this item?', () => {
      this.deleteItem(id)
    }, null)
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <IndexList
              activePage={this.state.params.page}
              totalItemCount={this.state.params.list.count || 0}
              title={this.title}
              basePath={this.path}
              columns={this.columns.list}
              columnInfo={this.columns.columns}
              list={this.state.params.list}
              getIndexList={this.getIndexListByPage}
              onDeleteClick={this.handleDeleteClick}
              onEditClick={this.handleEditClick}
              onShowClick={this.handleShowClick}
            />
          </Col>
        </Row>
      </div>
    )
  }
}

export default Index;
