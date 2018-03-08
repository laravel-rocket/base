import BaseRepository from "./BaseRepository";

class InformationRepository extends BaseRepository {

  constructor(){
    super();
    this.PATH = "/information";
  }

  getInfo() {
    return this.get(this.PATH);
  }

}

export default InformationRepository;
