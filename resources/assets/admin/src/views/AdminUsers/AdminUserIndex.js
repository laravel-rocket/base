import React from "react";

import AdminUserRepository from "../../repositories/AdminUserRepository";
import columns from './_columns'
import info from './_info'
import {withRouter} from 'react-router-dom'
import Index from "../CRUDBase/Index";

class AdminUserIndex extends Index {

  setPageInfo() {
    this.title = info.title;
    this.path = info.path;
  }

  setRepository() {
    this.repository = new AdminUserRepository();
  }

  setColumnInfo() {
    this.columns = columns;
  }

}

export default withRouter(AdminUserIndex);
