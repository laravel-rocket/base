import React from "react";

import UserRepository from "../../repositories/UserRepository";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'
import Edit from "../CRUDBase/Edit";

class UserEdit extends Edit {

  setPageInfo() {
    this.title = info.title;
    this.path = info.path;
  }

  setRepository() {
    this.repository = new UserRepository();
  }

  setColumnInfo() {
    this.columns = columns;
  }
}

export default withRouter(UserEdit);
