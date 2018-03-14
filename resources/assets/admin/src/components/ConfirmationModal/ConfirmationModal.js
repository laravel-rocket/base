import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Modal,
  ModalFooter,
  ModalBody,
  ModalHeader,
  Button
} from "reactstrap";

class ConfirmationModal extends Component {

  constructor() {
    super();
    this.handleOnOK = this.handleOnOK.bind(this);
    this.handleOnCancel = this.handleOnCancel.bind(this);
  }

  componentWillMount() {
  }

  componentWillReceiveProps(newProps) {
  }

  handleOnOK(e) {
    this.props.onOk(e);
  }

  handleOnCancel(e) {
    this.props.onCancel(e);
  }

  render() {
    const {
      isOpen,
      title,
      message
    } = this.props;

    return (
      <Modal isOpen={isOpen} className={'modal-danger'}>
        <ModalHeader>{title}</ModalHeader>
        <ModalBody>
          { message }
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={this.handleOnOK}>OK</Button>{' '}
          <Button color="secondary" onClick={this.handleOnCancel}>Cancel</Button>
        </ModalFooter>
      </Modal>
    );
  }
}

ConfirmationModal.propTypes = {
  title: PropTypes.string,
  isOpen: PropTypes.bool,
  message: PropTypes.string,
  onOk: PropTypes.func,
  onCancel: PropTypes.func,
};

ConfirmationModal.defaultProps = {
  isOpen: false,
  title: 'Confirmation',
  message: '',
  onOk: () => {},
  onCancel: () => {},
};

export default ConfirmationModal;








