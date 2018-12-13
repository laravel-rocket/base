import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBody,
  Button,
} from "reactstrap";

import IndexList from "../../components/IndexList/IndexList";
import Base from "./Base";
import queryString from 'query-string'

class Index extends Base {

  constructor(props) {
    super(props);
    this.setButtonInfo();
  }

  setButtonInfo() {
    console.log(this.info.features);
    if( this.info.features ){
      this.hasShowButton = this.info.features.includes('show');
      this.hasEditButton = this.info.features.includes('edit');
      this.hasDeleteButton = this.info.features.includes('delete');
    }else{
      this.hasShowButton = true;
      this.hasEditButton = true;
      this.hasDeleteButton = true;
    }
  }

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
    const values = queryString.parse(this.props.location.search);
    let offset = 0;
    if( values.offset > 0){
      offset = parseInt(values.offset);
      this.setState({
        params: {
          ...this.state.params,
          page: Math.floor(offset / this.getDefaultPageSize()),
          offset: parseInt(offset),
        }
      });
    }
    this.getIndexList(
      offset,
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

  getExportUrl() {
    return "/admin" + this.path + '/' + 'export';
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
      if( offset > 0 ) {
        this.props.history.push({pathname: this.path, search: "offset=" + offset});
      }else{
        this.props.history.push({pathname: this.path});
      }
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
    const exportUrl = this.getExportUrl();
    const exportButton = this.exportable ? (<a className="btn btn-primary btn-sm" href={exportUrl}>
      <i className="fa fa-download"></i> Download
    </a>) : null;

    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                {this.title}
                <div className="float-right">
                  {exportButton}
                  {" "}
                  <Button size="sm" color="primary" onClick={this.handleCreateNew}>
                    <i className="fa fa-plus-circle"></i> Create New
                  </Button>
                </div>
              </CardHeader>
              <CardBody className="card-body">
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
                  hasEditButton={this.hasEditButton}
                  hasShowButton={this.hasShowButton}
                  hasDeleteButton={this.hasDeleteButton}
                />
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default Index;

