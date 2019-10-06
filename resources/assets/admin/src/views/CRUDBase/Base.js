import React, {Component} from "react";
import columns from './_columns'
import info from "./_info";

class Base extends Component {

  constructor(props) {
    super(props);
    this.setInfo();
    this.setPageInfo();
    this.setColumnInfo();
    this.bindMethods();
    this.setInitialState(props);
    this.setRepository();
  }

  setInfo()
  {
    this.info = info;
  }

  getPath() {
    return this.info.path || '';
  }

  setPageInfo() {
    this.title = this.info.title || '';
    this.path = this.getPath();
    this.exportable = this.info.exportable;
  }

  setRepository() {
    this.repository = null;
  }

  setColumnInfo() {
    this.columns = columns;
  }

  bindMethods() {
  }

  setInitialState(props) {
    this.state = {};
  }

  getAdditionalElements()
  {
    return null;
  }

  mapAPIToModel(apiResult) {
    let model = {};
    for( let column of Object.keys(this.columns.columns)) {
      let apiResultName = this.columns.columns[column].apiName || column;
      model[column] = apiResult[apiResultName];
    }

    return model;
  }
}

export default Base;
