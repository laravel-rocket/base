import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
} from "reactstrap";

class ShowListTable extends Component {

  constructor() {
    super();
    this.state = {}
  }

  buildHeader() {
    const {
      columns,
    } = this.props;
    const headers = Object.keys(columns).map((entry, i) => {
      return (<th>{columns[entry]}</th>)
    });
    return (<tr>{headers}</tr>);

  }

  buildRows() {
    const {
      columns,
      items,
    } = this.props;

    const headers = Object.keys(columns).map((entry, i) => {
      return (<td>{columns[entry]}</td>)
    });

    return items.map((item, i) => {
      const row = Object.keys(columns).map((entry, j) => {
        return (<td key={"item-col-" + j + '-' + i}>{item[entry]}</td>)
      });
      return (<tr key={"item-row-" + i}>{row}</tr>)
    });
  }

  render() {
    const header = this.buildHeader();
    const rows = this.buildRows();
    const {
      columns,
      items,
    } = this.props;

    return (
      <div>
        <Table responsive>
          <thead>
          {header}
          </thead>
          <tbody>
          {rows}
          </tbody>
        </Table>
      </div>
    );
  }
}

ShowListTable.propTypes = {
  columns: PropTypes.object,
  items: PropTypes.array,
};

ShowListTable.defaultProps = {
  columns: {'id': 'ID'},
  items: []
};

export default ShowListTable;
