import React, {Component} from 'react';
import PropTypes from "prop-types";
import {ButtonGroup as ReactButtonGroup, Button} from "reactstrap";

class ButtonGroup extends Component {

  constructor(props) {
    super(props);
    this.state = {
      currentIndex: -1,
    };
    this.handleOnClick = this.handleOnClick.bind(this);
  }

  handleOnClick(option, index) {
    const {
      onChange
    } = this.props;
    this.setState({
      currentIndex: index,
    });
    onChange(option, index);
  }

  buildButtons() {
    const {
      options,
      value
    } = this.props;
    const result = [];

    options.forEach((option, index) => {
      result.push((<Button
        key={"group-" + option.value}
        onClick={() => {
          this.handleOnClick(option, index)
        }}
        active={value === option.value}
      >{option.name}</Button>))
    });

    return result;
  }

  render() {
    const buttons = this.buildButtons();
    const {
      size,
    } = this.props;
    return (
      <ReactButtonGroup size={size}>
        {buttons}
      </ReactButtonGroup>
    )
  }
}

ButtonGroup.propTypes = {
  options: PropTypes.arrayOf(PropTypes.object),
  size: PropTypes.string,
  value: PropTypes.string,
  onChange: PropTypes.func,
};

ButtonGroup.defaultProps = {
  options: [],
  size: "",
  value: "",
  onChange: () => {
  },
};

export default ButtonGroup;
