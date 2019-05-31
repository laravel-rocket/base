import BaseRepository from "./BaseRepository";

class AdminUserRepository extends BaseRepository {

  constructor(){
    super();
    this.PATH = "/admin_users";
  }

}

export default AdminUserRepository;
