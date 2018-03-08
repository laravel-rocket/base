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
    this.state = {
    }
  }

  handlePaginationClick(page) {
    const {
      getIndexList,
    } = this.props;
    getIndexList()
  }

  buildHeader() {

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
      rows.push(
        <tr key={list.items[i].id}>
          <td>{list.items[i].id}</td>
          <td>{list.items[i].name}</td>
          <td>
            <Button size="sm" color="primary"><i className="fa fa-folder"></i> Show</Button>
            <Button size="sm" color="info"><i className="fa fa-pencil"></i> Edit</Button>
            <Button size="sm" color="danger"><i className="fa fa-trash-o"></i> Delete</Button>
          </td>
        </tr>
      );
    }

    return rows;
  }

  render() {
    const rows = this.buildRows();
    const {
      list,
    } = this.props;

    return (
      <div>
        <Table responsive>
          <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
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
  columnNames: PropTypes.object,
  list: PropTypes.object,
  getIndexList: PropTypes.func.isRequired,
};

IndexList.defaultProps = {
  columns: ['id'],
  columnNames: {id: 'ID'},
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
