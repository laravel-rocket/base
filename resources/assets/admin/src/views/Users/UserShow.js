import React from "react";

import UserRepository from "../../repositories/UserRepository";
import columns from './_columns'
import info from "./_info";
import {withRouter} from 'react-router-dom'
import Show from "../CRUDBase/Show";

class UserShow extends Show {

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

export default withRouter(UserShow);
