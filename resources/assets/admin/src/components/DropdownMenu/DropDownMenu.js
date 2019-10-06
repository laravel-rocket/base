import React, {Component} from 'react';
import PropTypes from "prop-types";
import {ButtonDropdown, DropdownToggle, DropdownMenu as ReactDropdownMenu, DropdownItem} from 'reactstrap';

class DropdownMenu extends Component {

  constructor(props) {
    super(props);
    this.state = {
      currentIndex: -1,
      dropdownOpen: false,
    };
    this.handleOnClick = this.handleOnClick.bind(this);
    this.handleToggle = this.handleToggle.bind(this);
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

  handleToggle() {
    this.setState({
      dropdownOpen: !this.state.dropdownOpen
    });
  }

  buildButtons() {
    const {
      options,
    } = this.props;
    const result = [];

    options.forEach((option, index) => {
      result.push((<DropdownItem
        key={"group-" + option.value}
        onClick={() => {
          this.handleOnClick(option, index)
        }}
      >{option.name}</DropdownItem>))
    });

    return result;
  }

  buildText() {
    const {
      options,
      value
    } = this.props;
    let text = "Select";
    options.forEach((option, index) => {
      if (String(option.value) === String(value)) {
        text = option.name;
      }
    });

    return text;
  }

  render() {
    const buttons = this.buildButtons();
    const {
      size,
    } = this.props;
    const text = this.buildText();
    return (
      <ButtonDropdown isOpen={this.state.dropdownOpen} toggle={this.handleToggle}>
        <DropdownToggle size={size} caret={true}>
          {text}
        </DropdownToggle>
        <ReactDropdownMenu>
          {buttons}
        </ReactDropdownMenu>
      </ButtonDropdown>
    )
  }
}

DropdownMenu.propTypes = {
  options: PropTypes.arrayOf(PropTypes.object),
  size: PropTypes.string,
  value: PropTypes.string,
  onChange: PropTypes.func,
};

DropdownMenu.defaultProps = {
  options: [],
  size: "",
  value: "",
  onChange: () => {
  },
};

export default DropdownMenu;
