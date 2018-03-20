import BaseRepository from "../repositories/BaseRepository";

class AuthService {

  static signOut() {
    const repository = new BaseRepository();
    return repository.post('/sign-out');
  }
}

export default AuthService;
