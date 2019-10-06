import React from "react";
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBody,
  Button,
  Input,
} from "reactstrap";

import IndexList from "../../components/IndexList/IndexList";
import Base from "./Base";
import queryString from 'query-string'
import ButtonGroup from "../../components/ButtonGroup/ButtonGroup";
import DropdownMenu from "../../components/DropdownMenu/DropDownMenu";

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
    this.defaultParams = {
      offset: 0,
      limit: this.getDefaultPageSize(),
      order: this.getDefaultOrder(),
      direction: this.getDefaultDirection(),
      searchWord: '',
      page: 1,
      queryParams: this.getDefaultFilters(),
      list: {},
    };
    this.state = {
      params: {
        offset: 0,
        limit: this.getDefaultPageSize(),
        order: this.getDefaultOrder(),
        direction: this.getDefaultDirection(),
        searchWord: '',
        page: 1,
        queryParams: this.getDefaultFilters(),
        list: {},
      },
      methods: {
        getIndexList: this.getIndexList.bind(this),
      }
    }
  }

  getDefaultPageSize() {
    if (this.info.limits && this.info.limits.default > 0) {
      return this.info.limits.default;
    }

    return 20;
  }

  getPageSizeOptions() {
    if (this.info.limits && Array.isArray(this.info.limits.options)) {
      return this.info.limits.options;
    }

    return null;
  }

  getDefaultOrder() {
    return 'id';
  }

  getDefaultDirection() {
    return 'asc';
  }

  getDefaultFilters() {
    if (!this.info.filters) {
      return {};
    }
    const result = {};
    Object.keys(this.info.filters).forEach((type) => {
      const filter = this.info.filters[type];
      if (filter.default) {
        result[type] = filter.default;
      }
    });
    return result;
  }

  parseQueryString() {
    const queryParams = queryString.parse(this.props.location.search);
    const params = this.state.params;
    Object.keys(queryParams).forEach((key, index) => {
      switch (key) {
        case "offset":
          params.page = Math.floor(queryParams[key] / this.getDefaultPageSize());
          params.offset = parseInt(queryParams[key]);
          break;
        case "limit":
          params.limit = parseInt(queryParams[key]);
          break;
        case "direction":
        case "order":
          params[key] = queryParams[key];
          break;
        case "query":
          params.searchWord = queryParams[key];
          break;
        default:
          params.queryParams[key] = queryParams[key];
          break;
      }
    });
    this.setState({
      params: params,
    })
  }

  componentWillMount() {
    this.parseQueryString();
    this.getIndexList(
      this.state.params.offset,
      this.state.params.limit,
      this.state.params.order,
      this.state.params.direction,
      this.state.params.searchWord,
      this.state.params.queryParams
    );
    this.props.methods.setTitle(this.info.title);
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

  generateCurrentQueryParam() {
    const params = {};
    ['offset', 'limit', 'direction', 'order'].forEach((name) => {
      if (this.defaultParams[name] !== this.state.params[name]) {
        params[name] = this.state.params[name];
      }
    });
    if (this.defaultParams.searchWord !== this.state.params.searchWord) {
      params.query = this.state.params.searchWord;
    }
    Object.keys(this.state.params.queryParams).forEach((key) => {
      if (this.defaultParams.queryParams[key] !== this.state.params.queryParams[key])
        params[key] = this.state.params.queryParams[key];
    });

    const query = Object.keys(params)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(params[key]))
      .join('&');

    return query;
  }

  getIndexList(offset, limit, order, direction, searchWord = '', params = {}) {
    this.repository.index(offset, limit, order, direction, searchWord, params).then(repos => {
      let records = [];
      for( let record of repos.items) {
        records.push(this.mapAPIToModel(record));
      }
      repos.items = records;
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


  applyFilter(type, value) {
    const params = this.state.params.queryParams;
    if (params[type] !== value) {
      params[type] = value;
      const newParams = {
        ...this.state.params,
        queryParams: params,
      };
      this.setState({
        params: newParams
      });
      this.getIndexListByPage(1, newParams);
    }
  }

  buildFilters() {
    const result = [];
    if (this.info.filters) {
      Object.keys(this.info.filters).forEach((type) => {
        const filter = this.info.filters[type];
        result.push((<ButtonGroup
          key={"filter-" + type}
          options={filter.options}
          onChange={(option, index) => {
            this.applyFilter(type, option.value)
          }}
          value={this.state.params.queryParams[type]}
        />))
      })
    }

    return result;
  }

  applyLimitOption(option) {
    const limit = parseInt(option.value);
    if (limit > 0 && parseInt(this.state.params.limit) !== limit) {
      const newParams = {
        ...this.state.params,
        limit: String(limit),
      };
      this.setState({
        params: newParams
      });
      this.getIndexListByPage(1, newParams);
    }
  }

  buildLimitOptions() {
    const options = this.getPageSizeOptions();
    if (!options) {
      return null;
    }

    return (
      <span className={"limit-options"}>
        <DropdownMenu options={options} value={this.state.params.limit} onChange={(value) => {
          this.applyLimitOption(value)
        }}/>
      </span>
    )
  }

  applySearchWord(searchWord) {
    if (this.state.params.searchWord !== searchWord) {
      const newParams = {
        ...this.state.params,
        searchWord: searchWord,
      };
      this.setState({
        params: newParams,
      });
      this.getIndexListByPage(1, newParams);
    }
  }

  buildSearchField() {
    if (!this.info.searchable) {
      return null;
    }

    return (
      <div className="search-input float-right">
        <Input type="text" id={"search"} name={"search"} value={this.state.params.searchWord}
               onChange={e => this.applySearchWord(e.target.value)}/>
      </div>
    )
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
    const params = queryString.stringify(this.state.params.queryParams);
    this.props.history.push(this.path + '/create?' + params);
  }

  handleDeleteClick(id) {
    this.props.methods.confirmation('Delete Data', 'Are you okay to delete this item?', () => {
      this.deleteItem(id)
    }, null)
  }

  render() {
    const exportUrl = this.getExportUrl();
    const exportButton = this.exportable ? (<a className="btn btn-primary btn-sm" href={exportUrl}>
      <i className="fa fa-download"/> Download
    </a>) : null;
    const filters = this.buildFilters();
    const filterWrapper = (filters.length > 0) ? (
      <Row className={"filter"}>
        <Col xs="12" lg="12">
          {filters}
        </Col>
      </Row>
    ) : null;
    const limitOptions = this.buildLimitOptions();
    const searchField = this.buildSearchField();
    const additionalElements = this.getAdditionalElements();

    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                {this.title}
                {limitOptions}
                <div className="float-right">
                  {exportButton}
                  {" "}
                  <Button size="sm" color="primary" onClick={this.handleCreateNew}>
                    <i className="fa fa-plus-circle"/> Create New
                  </Button>
                </div>
              {searchField}
              </CardHeader>
              <CardBody className="card-body">
                {filterWrapper}
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
        {additionalElements}
      </div>
    )
  }
}

export default Index;
