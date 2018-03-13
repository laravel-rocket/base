import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
  Card,
  CardHeader,
  CardBlock,
} from "reactstrap";

class ShowTable extends React.Component {
  constructor() {
    super();
    this.state = {}
  }

  buildRowItemContent(item, key, id) {
    const {
      columns,
      columnInfo,
    } = this.props;
    if (item === undefined) {
      return "";
    }
    switch (columnInfo[key]['type']) {
      case 'image':
        return (
          <img key={'image-' + id + '-' + key} src={item.url} className={'img-thumbnails'} width={50} height={50}/>);
    }

    return item;
  }

  buildRows() {
    const rows = [];
    const {
      model,
      columns,
      columnInfo,
    } = this.props;

    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const rowData = this.buildRowItemContent(model[columns[i]], columns[i], model['id']);
      rows.push(
        <tr key={columns[i]}>
          <th>{columnInfo[columns[i]].name}</th>
          <td>{rowData}</td>
        </tr>
      );
    }

    return rows;
  }


  render() {
    const rows = this.buildRows();

    return (
      <Card>
        <CardHeader>
          <i className="fa fa-align-justify"></i> {this.props.title}
        </CardHeader>
        <CardBlock className="card-body">
          <div>
            <Table responsive>
              <tbody>
              {rows}
              </tbody>
            </Table>
          </div>
        </CardBlock>
      </Card>
    );
  }
}

ShowTable.propTypes = {
  title: PropTypes.string,
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  model: PropTypes.object,
};

ShowTable.defaultProps = {
  title: '',
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  model: {},
};

export default ShowTable;
