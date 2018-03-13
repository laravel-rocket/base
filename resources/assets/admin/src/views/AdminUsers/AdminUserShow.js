import React from "react";

import AdminUserRepository from "../../repositories/AdminUserRepository";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'
import Show from "../CRUDBase/Show";

class AdminUserShow extends Show {

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

export default withRouter(AdminUserShow);
