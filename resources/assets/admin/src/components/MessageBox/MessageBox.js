import React, {Component} from 'react';
import {
  Alert
} from 'reactstrap';
import PropTypes from "prop-types";

class MessageBox extends Component {

  constructor(props) {
    super(props);
    this.state = {
      errorMessage: "",
      errorVisible:false,
      successMessage: "",
      successVisible: false,
    };
    this.handleSuccessDismissSuccess = this.handleSuccessDismissSuccess.bind(this);
    this.handleErrorDismissSuccess = this.handleErrorDismissSuccess.bind(this);
  }

  componentWillReceiveProps(newProps) {
    if( newProps.successMessage.length > 0  ){
      this.setState({successMessage: newProps.successMessage, successVisible: true});
    }
    if( newProps.errorMessage.length > 0  ){
      this.setState({errorMessage: newProps.errorMessage, errorVisible: true});
    }
  }

  handleSuccessDismissSuccess() {
    this.setState({
      ...this.state,
      successMessage: '',
      successVisible: false,
    });
    this.props.onDismissSuccess();
  }

  handleErrorDismissSuccess() {
    this.setState({
      ...this.state,
      errorMessage: '',
      errorVisible: false,
    });
    this.props.onDismissError();
  }


  render() {
    return (
      <div>
        <Alert color="success" isOpen={this.state.successVisible} toggle={this.handleSuccessDismissSuccess}>
          {this.state.successMessage}
        </Alert>
        <Alert color="danger"  isOpen={this.state.errorVisible} toggle={this.handleErrorDismissSuccess}>
          {this.state.errorMessage}
        </Alert>
      </div>
    );
  }
}

MessageBox.propTypes = {
  successMessage: PropTypes.string,
  errorMessage: PropTypes.string,
  onDismissError: PropTypes.func,
  onDismissSuccess: PropTypes.func,
};

MessageBox.defaultProps = {
  successMessage: "",
  errorMessage: "",
  onDismissError: () => {},
  onDismissSuccess: () => {},
};

export default MessageBox;
