import objectPath from 'object-path';

class ObjectHelper {
  static get(object, path, defaultValue) {
    return objectPath.get(object, path, defaultValue);
  };

  static set(object, path, value) {
    return objectPath.set(object, path, value);
  };

}

export default ObjectHelper;
