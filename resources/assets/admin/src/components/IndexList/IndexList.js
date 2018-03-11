import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
  Button,
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
    getIndexList()
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
    switch(columnInfo[key]['type']) {
      case 'image':
        return (<img key={'image-' + id + '-' + key} src={item.url} className={'img-thumbnails'} width={50} height={50}/>);
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
        <Button size="sm" color="primary"><i className="fa fa-folder"></i> Show</Button>
        <Button size="sm" color="info"><i className="fa fa-pencil"></i> Edit</Button>
        <Button size="sm" color="danger"><i className="fa fa-trash-o"></i> Delete</Button>
      </td>
    );
    return rowItems;
  }

  buildRows() {
    const rows = [];
    const {
      list,
    } = this.props;

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
    } = this.props;

    return (
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
        <Pagination totalItemsCount={list.count} onChange={this.handlePaginationClick}/>
      </div>
    );
  }
}

IndexList.propTypes = {
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  list: PropTypes.object,
  getIndexList: PropTypes.func.isRequired,
};

IndexList.defaultProps = {
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
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
};

export default IndexList;
