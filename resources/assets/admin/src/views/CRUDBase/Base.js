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

  setPageInfo() {
    this.title = this.info.title || '';
    this.path = this.info.path || '';
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

}

export default Base;
