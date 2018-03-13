import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Row,
  Col,
  FormGroup,
  Label,
  Input,
  Card,
  CardBlock,
  CardHeader,
  CardFooter,
  Button,
} from "reactstrap";
import DatePicker from 'react-datepicker';
import ImageInput from "../ImageInput/ImageInput";

class EditTable extends React.Component {
  constructor() {
    super();
    this.state = {
      model: {},
      formData: {},
    };
    this.handleDataChange.bind(this);
    this.handleReset.bind(this);
    this.handleSubmit.bind(this);
  }

  componentWillReceiveProps(newProps) {
    this.setState({
      ...this.state,
      model: Object.assign({}, newProps.model),
    })
  }

  handleDataChange(key, data) {
    const newFormData = this.state.formData;
    const newModelData = this.state.model;
    newFormData[key] = data;
    newModelData[key] = data;
    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    });
    this.state.formData[key] = data;
    console.log(this.state);
  }

  handleReset(e) {
    this.setState({
      ...this.state,
      model: Object.assign({}, this.props.model),
    })
  }

  handleSubmit(e) {
    console.log("handleSubmit");
    this.props.onSubmit(this.state.formData);
  }

  buildForm(item, key, id) {
    const {
      columnInfo,
    } = this.props;
    if (item === undefined) {
      item = '';
    }
    switch (columnInfo[key]['type']) {
      case 'password':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Input type="password"
                   id={key}
                   name={key}
                   onChange={e => this.handleDataChange(key, e.target.value)}/>
          </FormGroup>
        );
      case 'file':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Input type="file"
                   id={key}
                   name={key}
                   onChange={e => this.handleDataChange(key, e.target.value)}/>
          </FormGroup>
        );
      case 'date':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <DatePicker
              selected={item}
              onChange={e => this.handleDataChange(key, e.target.value)}
            />
          </FormGroup>
        );
      case 'image':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <ImageInput onChange={e => this.handleDataChange(key, e.target.value)} currentImageUrl={item.url}
                        name={key} thumbnailSize={200}/>
          </FormGroup>
        );
      case 'datetime':
      case 'select':
    }

    return (
      <FormGroup key={'input-' + key}>
        <Label htmlFor={key}>{columnInfo[key].name}</Label>
        <Input type="text" id={key} name={key} value={item}
               onChange={e => this.handleDataChange(key, e.target.value)}/>
      </FormGroup>
    );
  }

  buildRows() {
    const rows = [];
    const {
      columns,
    } = this.props;
    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const form = this.buildForm(this.state.model[columns[i]], columns[i], this.state.model['id']);
      rows.push(
        <Row key={columns[i]}>
          <Col xs="12">
            {form}
          </Col>
        </Row>
      );
    }

    return rows;
  }


  render() {
    const rows = this.buildRows();

    return (
      <Card>
        <CardHeader>
          <i className="fa fa-align-justify"></i> {this.props.title}
        </CardHeader>
        <CardBlock className="card-body">
          <div>
            {rows}
          </div>
        </CardBlock>
        <CardFooter>
          <Button type="submit" size="sm" color="primary" onClick={e => {this.handleSubmit()}}><i
            className="fa fa-dot-circle-o"></i> Submit</Button>
          {' '}
          <Button type="reset" size="sm" color="danger" onClick={e => {this.handleReset()}}><i
            className="fa fa-ban"></i> Reset</Button>
        </CardFooter>
      </Card>
    );
  }
}

EditTable.propTypes = {
  title: PropTypes.string,
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  model: PropTypes.object,
  onSubmit: PropTypes.func,
};

EditTable.defaultProps = {
  title: '',
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  model: {},
  onSubmit: () => {
  },
};

export default EditTable;
