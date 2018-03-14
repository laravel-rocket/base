import React, {Component} from "react";
import columns from './_columns'
import info from "./_info";

class Base extends Component {

  constructor(props) {
    super(props);
    this.setPageInfo();
    this.setColumnInfo();
    this.bindMethods();
    this.setInitialState(props);
    this.setRepository();
  }

  setPageInfo() {
    this.title = info.title;
    this.path = info.path;
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
