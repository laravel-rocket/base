import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
  Button,
  Card,
  CardHeader,
  CardBlock,
} from "reactstrap";
import Pagination from "../Pagination/Pagination";

class IndexList extends React.Component {

  constructor() {
    super();
    this.handlePaginationClick = this.handlePaginationClick.bind(this);
    this.state = {}
  }

  handlePaginationClick(page) {
    const {
      getIndexList,
    } = this.props;
    getIndexList(page);
  }

  buildHeader() {
    const headers = [];
    const {
      columns,
      columnInfo,
    } = this.props;
    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const headerText = "" + columnInfo[columns[i]]['name'];
      headers.push(<th key={'header-' + columns[i]}>{headerText}</th>);
    }
    headers.push(<th key={'header-buttons'}>&nbsp;</th>);
    return headers;
  }

  buildRowItemContent(item, key, id) {
    const {
      columns,
      columnInfo,
    } = this.props;
    switch (columnInfo[key]['type']) {
      case 'image':
        return (
          <img key={'image-' + id + '-' + key} src={item.url} className={'img-thumbnails'} width={50} height={50}/>);
    }

    return item;
  }

  buildRowItem(row) {
    const rowItems = [];
    const {
      columns,
      columnInfo,
    } = this.props;
    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const rowData = this.buildRowItemContent(row[columns[i]], columns[i], row['id']);
      rowItems.push(<td key={'data-' + row['id'] + '-' + columns[i]}>{rowData}</td>);
    }
    rowItems.push(
      <td key={'data-' + row['id'] + '-buttons'}>
        <Button size="sm" color="primary" onClick={e => this.props.onShowClick(row['id'])}><i
          className="fa fa-folder"></i> Show</Button>{' '}
        <Button size="sm" color="info" onClick={e => this.props.onEditClick(row['id'])}><i
          className="fa fa-pencil"></i> Edit</Button>{' '}
        <Button size="sm" color="danger" onClick={e => this.props.onDeleteClick(row['id'])}><i
          className="fa fa-trash-o"></i> Delete</Button>
      </td>
    );
    return rowItems;
  }

  buildRows() {
    const rows = [];
    const {
      list,
    } = this.props;
    if( !list.items ){
      return rows;
    }

    for (
      let i = 0;
      i < list.items.length;
      i++
    ) {
      const rowItem = this.buildRowItem(list.items[i]);
      rows.push(
        <tr key={list.items[i].id}>
          {rowItem}
        </tr>
      );
    }

    return rows;
  }

  render() {
    const header = this.buildHeader();
    const rows = this.buildRows();
    const {
      list,
      activePage,
      totalItemCount
    } = this.props;

    return (
      <Card>
        <CardHeader>
          <i className="fa fa-align-justify"></i> {this.props.title}
        </CardHeader>
        <CardBlock className="card-body">
          <div>
            <Table responsive>
              <thead>
              <tr>
                {header}
              </tr>
              </thead>
              <tbody>
              {rows}
              </tbody>
            </Table>
            <Pagination
              activePage={activePage}
              itemsCountPerPage={list.limit}
              totalItemsCount={list.count || 0}
              onChange={this.handlePaginationClick}/>
          </div>
        </CardBlock>
      </Card>
    );
  }
}

IndexList.propTypes = {
  activePage: PropTypes.number,
  totalItemCount: PropTypes.number,
  title: PropTypes.string,
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  list: PropTypes.object,
  getIndexList: PropTypes.func.isRequired,
  basePath: PropTypes.string.isRequired,
  onShowClick: PropTypes.func.isRequired,
  onEditClick: PropTypes.func.isRequired,
  onDeleteClick: PropTypes.func.isRequired,
};

IndexList.defaultProps = {
  activePage: 1,
  totalItemCount: 0,
  title: '',
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  basePath: "",
  list: {
    count: 0,
    offset: 0,
    limit: 10,
    items: [],
  },
  getIndexList: () => {
    return {
      count: 0,
      offset: 0,
      limit: 10,
      items: [],
    }
  },
  onShowClick: () => {
  },
  onEditClick: () => {
  },
  onDeleteClick: () => {
  },

};

export default IndexList;
