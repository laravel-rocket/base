import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
  Badge, Col,
} from "reactstrap";
import {Link} from 'react-router-dom';
import Map from "../Map/Map";

class ShowTable extends Component {
  constructor() {
    super();
    this.state = {}
  }

  buildRowItemContent(item, key, id) {
    const {
      columnInfo,
      model
    } = this.props;
    if (item === undefined) {
      item = '';
    }
    switch (columnInfo[key].type) {
      case 'image':
        if (item !== null && typeof item === 'object') {
          return (
            <img key={'image-' + id + '-' + key} src={item.url} className={'img-thumbnails'} width={50} height={50}/>);
        }
        return "";
      case 'checkbox':
        const options = [];
        if (!Array.isArray(item)) {
          return options;
        }
        for (
          let i = 0;
          i < item.length;
          i++
        ) {
          if (columnInfo[key].presentation === 'badge') {
            options.push(<Badge color="secondary"
                                key={key + '_' + item[i]}>{columnInfo[key].optionNames[item[i]]}</Badge>)
          } else {
            options.push(<div>{columnInfo[key].optionNames[item[i]]}</div>)
          }
        }
        return (<div>{options}</div>);
      case 'select_multiple':
        if (item !== null && Array.isArray(item)) {
          const items = [];
          item.forEach(function (object) {
            items.push(<Badge color="primary" key={key + '_' + object.id}>{object.name}</Badge>)
          });
          return (<div>{items}</div>)
        }
        return "";
      case 'location':
        const longitude = model[columnInfo[key].longitudeQueryName];
        const latitude = model[columnInfo[key].latitudeQueryName];
        console.log(longitude);
        return (
          <Map height={"300px"} latitude={parseFloat(latitude)} longitude={parseFloat(longitude)}/>
        );
    }

    if (item !== null && typeof item === 'object') {
      const text = item['name'] || item['id'];
      if (columnInfo[key].link) {
        return (<Link to={columnInfo[key].link + '/' + item['id']}>{text}</Link>)
      }
      return text
    }

    if (item instanceof Array) {
      const data = [];
      for (const value in item) {
        let text = "";
        if (value !== null && typeof value === 'object') {
          text = value['name'] || value['id'];
        } else {
          text = value;
        }
        if (data.length > 0) {
          data.push(',');
        }
        if (columnInfo[key].link) {
          data.push(<Link key={value['id']} to={columnInfo[key].link + '/' + value['id']}>{text}</Link>)
        } else {
          data.push(text);
        }
      }
      return data;
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
      if( columnInfo[columns[i]].type === 'list'){
        continue;
      }
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
      <div>
        <Table responsive>
          <tbody>
          {rows}
          </tbody>
        </Table>
      </div>
    );
  }
}

ShowTable.propTypes = {
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  model: PropTypes.object,
};

ShowTable.defaultProps = {
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  model: {},
};

export default ShowTable;
