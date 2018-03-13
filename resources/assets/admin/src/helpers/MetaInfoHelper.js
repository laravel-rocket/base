class MetaInfoHelper {
  static get(name) {
    let result = [];
    const metas = document.getElementsByTagName("META");
    for(let i = 0; i < metas.length; i++) {
      if( metas[i].name === name ){
        result.push(metas[i].content)
      }
    }
    return result;
  };
}

export default MetaInfoHelper;
