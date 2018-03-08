import BaseRepository from "./BaseRepository";

class AdminUserRepository extends BaseRepository {

  constructor(){
    super();
    this.PATH = "/admin-users";
  }

}

export default AdminUserRepository;
