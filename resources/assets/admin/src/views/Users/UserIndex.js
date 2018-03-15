import React from "react";

import UserRepository from "../../repositories/UserRepository";
import columns from './_columns'
import info from './_info'
import {withRouter} from 'react-router-dom'
import Index from "../CRUDBase/Index";

class UserIndex extends Index {

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

export default withRouter(UserIndex);
