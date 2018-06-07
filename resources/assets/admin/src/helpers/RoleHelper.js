import roles from '../config/roles';

class RoleHelper {
  static hasRole(authUser, role) {

    if( !authUser ){
      return false;
    }

    const userRoles = authUser.roles || [];
    const targetRoles = Array.isArray(role) ? role : [role];

    for (const targetRole of targetRoles) {
      if (userRoles.includes(targetRole)) {
        return true;
      }

      for (const userRole of userRoles) {
        const roleInfo = roles[userRole];
        if (roleInfo) {
          if (roleInfo.subRoles.includes(targetRole)) {
            return true;
          }
        }
      }
    }

    return false;
  }
}

export default RoleHelper;
