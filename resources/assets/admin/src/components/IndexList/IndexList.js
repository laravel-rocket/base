import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Table,
  Button,
  Badge
} from "reactstrap";
import Pagination from "../Pagination/Pagination";
import {Link} from 'react-router-dom';

class IndexList extends Component {

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
      columnInfo,
    } = this.props;
    switch (columnInfo[key]['type']) {
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
            options.push(<div key={key + '_' + item[i]}>{columnInfo[key].optionNames[item[i]]}</div>)
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
      case 'datetime':
        if (item !== null && parseInt(item) > 1000000000) {
          const datetime = new Date(item * 1000);
          return [
              datetime.getFullYear(),
              datetime.getMonth() + 1,
              datetime.getDate()
            ].join('/') + ' '
            + datetime.toLocaleTimeString();
        }
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

  buildRowItem(row) {
    const rowItems = [];
    const {
      columns,
      hasShowButton,
      hasEditButton,
      hasDeleteButton,
    } = this.props;
    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const rowData = this.buildRowItemContent(row[columns[i]], columns[i], row['id']);
      rowItems.push(<td key={'data-' + row['id'] + '-' + columns[i]}>{rowData}</td>);
    }
    const buttons = [];
    if (hasShowButton) {
      buttons.push(<Button key="show" size="sm" color="primary" onClick={e => this.props.onShowClick(row['id'])}><i
        className="fa fa-folder"></i> Show</Button>)
    }
    if (hasEditButton) {
      if (buttons.length > 0) {
        buttons.push((<span key="space-edit">&nbsp;</span>));
      }
      buttons.push(<Button key="edit" size="sm" color="info" onClick={e => this.props.onEditClick(row['id'])}><i
        className="fa fa-pencil"></i> Edit</Button>)
    }
    if (hasDeleteButton) {
      if (buttons.length > 0) {
        buttons.push((<span key="space-delete">&nbsp;</span>));
      }
      buttons.push(<Button key="delete" size="sm" color="danger" onClick={e => this.props.onDeleteClick(row['id'])}><i
        className="fa fa-trash-o"></i> Delete</Button>)
    }
    rowItems.push(
      <td key={'data-' + row['id'] + '-buttons'}>
        {buttons}
      </td>
    );
    return rowItems;
  }

  buildRows() {
    const rows = [];
    const {
      list,
    } = this.props;
    if (!list.items) {
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
      <div>
        <Pagination
          activePage={activePage}
          itemsCountPerPage={list.limit}
          totalItemsCount={totalItemCount || 0}
          onChange={this.handlePaginationClick}/>
        <div style={{overflowY: "auto"}}>
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
        </div>
        <Pagination
          activePage={activePage}
          itemsCountPerPage={list.limit}
          totalItemsCount={totalItemCount || 0}
          onChange={this.handlePaginationClick}/>
      </div>
    );
  }
}

IndexList.propTypes = {
  activePage: PropTypes.number,
  totalItemCount: PropTypes.number,
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  list: PropTypes.object,
  getIndexList: PropTypes.func.isRequired,
  basePath: PropTypes.string.isRequired,
  onShowClick: PropTypes.func.isRequired,
  onEditClick: PropTypes.func.isRequired,
  onDeleteClick: PropTypes.func.isRequired,
  hasShowButton: PropTypes.bool,
  hasEditButton: PropTypes.bool,
  hasDeleteButton: PropTypes.bool,
};

IndexList.defaultProps = {
  activePage: 1,
  totalItemCount: 0,
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  basePath: "",
  list: {
    count: 0,
    offset: 0,
    limit: 10,
    items: [],
  },
  hasShowButton: true,
  hasEditButton: true,
  hasDeleteButton: true,
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
