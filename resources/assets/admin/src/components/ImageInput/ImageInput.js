import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Input,
} from "reactstrap";

class ImageInput extends Component {

  constructor() {
    super();
    this.handleOnChange = this.handleOnChange.bind(this);
    this.state = {
      file: null,
      currentImageUrl: '',
    }
  }

  componentWillMount() {
    this.setState({
      currentImageUrl: this.props.currentImageUrl
    });
  }

  handleOnChange(e) {
    const file = e.target.files[0];
    let reader = new FileReader();
    reader.onloadend = () => {
      this.setState({
        file: file,
        currentImageUrl:reader.result,
      });
    };
    reader.readAsDataURL(file);
    this.props.onChange(e)
  }

  componentWillReceiveProps(newProps) {
    this.setState({
      currentImageUrl: newProps.currentImageUrl
    });
  }

  render() {
    const {
      thumbnailSize,
      name,
    } = this.props;

    return (
      <div>
        <img src={this.state.currentImageUrl} width={thumbnailSize} height={thumbnailSize} className={'img-thumbnail'}/>
        <Input type="file"
               id={name}
               name={name}
               onChange={e => this.handleOnChange(e)}/>
      </div>
    );
  }
}

ImageInput.propTypes = {
  name: PropTypes.string,
  currentImageUrl: PropTypes.string,
  onChange: PropTypes.func,
  thumbnailSize: PropTypes.number,
};

ImageInput.defaultProps = {
  name: '',
  currentImageUrl: '',
  thumbnailSize: 200,
  onChange: () => {},
};

export default ImageInput;
