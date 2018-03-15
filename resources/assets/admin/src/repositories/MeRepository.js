import BaseRepository from "./BaseRepository";

class InformationRepository extends BaseRepository {

  constructor() {
    super();
    this.PATH = "/me";
  }

  showMe(params = {}) {
    return this.get(this.PATH, params);
  }

  updateMe(params = {}) {
    return this.put(this.PATH, params);
  }
}

export default InformationRepository;
