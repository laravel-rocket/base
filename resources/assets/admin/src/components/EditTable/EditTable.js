import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Row,
  Col,
  FormGroup,
  Label,
  Input,
  Button,
} from "reactstrap";
import DatePicker from 'react-datepicker';
import ImageInput from "../ImageInput/ImageInput";
import Select from 'react-select';
import 'react-select/dist/react-select.css';

class EditTable extends Component {
  constructor() {
    super();
    this.state = {
      model: {},
      formData: {},
    };
    this.handleDataChange = this.handleDataChange.bind(this);
    this.handleReset = this.handleReset.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleSelectChange = this.handleSelectChange.bind(this)
  }

  componentWillReceiveProps(newProps) {
    this.setState({
      ...this.state,
      model: Object.assign({}, newProps.model),
    })
  }

  handleDataChange(key, data) {
    const {
      columnInfo,
    } = this.props;
    const newFormData = this.state.formData;
    const newModelData = this.state.model;

    switch (columnInfo[key].type) {
      case "checkbox":
        if (!Array.isArray(newModelData[key])) {
          newModelData[key] = [];
          newFormData[key] = [];
        }
        const pos = newModelData[key].indexOf(data);
        if (pos >= 0) {
          newModelData[key].splice(pos, 1);
        } else {
          newModelData[key].push(data);
        }
        newFormData[key] = newModelData[key];
        break;
      default:
        newFormData[key] = data;
        newModelData[key] = data;
    }

    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    });
    console.log(this.state);
  }

  handleReset(e) {
    this.setState({
      ...this.state,
      model: Object.assign({}, this.props.model),
    })
  }

  handleSubmit(e) {
    this.props.onSubmit(this.state.formData);
  }

  handleSelectChange(name, value) {
    if (!value) {
      return Promise.resolve({options: []});
    }

    console.log('Get Changes for ' + name + ' -> ' + value);
    return this.props.onSelect(name, value).then((options) => {
      console.log("SUCCESS!");
      console.log(options);
      return options;
    });
  }

  buildForm(item, key, id) {
    const {
      columnInfo,
    } = this.props;
    if (item === undefined) {
      item = '';
    }
    switch (columnInfo[key].type) {
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
      case 'checkbox':
        const options = [];
        for (
          let i = 0;
          i < columnInfo[key].options.length;
          i++
        ) {
          const option = columnInfo[key].options[i];
          options.push(
            <div className="checkbox" key={key + '_' + option}>
              <Label check htmlFor={key + '_' + option}>
                <Input
                  onChange={e => this.handleDataChange(key, e.target.value)}
                  checked={item.indexOf(option) >= 0}
                  type="checkbox"
                  id={key + '_' + option}
                  name={key}
                  value={option}/> {columnInfo[key].optionNames[option]}
              </Label>
            </div>
          )
        }
        return (
          <FormGroup key={'input-' + key} row>
            <Col md="3"><Label>{columnInfo[key].name}</Label></Col>
            <Col md="9">
              <FormGroup check>
                {options}
              </FormGroup>
            </Col>
          </FormGroup>
        );
      case 'textarea':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <TextArea type="textarea" id={key} name={key} value={item}
                      onChange={e => this.handleDataChange(key, e.target.value)}/>
          </FormGroup>
        );
      case 'select':
      case 'select_single':
        if (columnInfo[key].relation) {
          return (
            <FormGroup key={'input-' + key}>
              <Label htmlFor={key}>{columnInfo[key].name}</Label>
              <Select.Async
                multi={false}
                value={item}
                onChange={value => this.handleDataChange(key, value)}
                onValueClick={(value, event) => {
                  return false;
                }}
                valueKey="id"
                labelKey="name"
                loadOptions={(value) => {
                  return this.handleSelectChange(columnInfo[key].relation, value);
                }}
                backspaceRemoves={this.state.backspaceRemoves}
              />
            </FormGroup>
          );
        }
        const optionValues = [];
        for (const option of columnInfo[key].options) {
          optionValues.push({
            value: option.value,
            label: option.name,
          });
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              name={key}
              value={item}
              onChange={(value) => this.handleDataChange(key, value)}
              options={optionValues}
            />
          </FormGroup>
        );
      case 'datetime':

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
      <div>
        {rows}
        <Row>
          <Col xs="12">
            <Button type="submit" size="sm" color="primary" onClick={e => {
              this.handleSubmit()
            }}><i className="fa fa-dot-circle-o"></i> Submit</Button>
            {' '}
            <Button type="reset" size="sm" color="danger" onClick={e => {
              this.handleReset()
            }}><i className="fa fa-ban"></i> Reset</Button>
          </Col>
        </Row>
      </div>
    );
  }
}

EditTable.propTypes = {
  columns: PropTypes.arrayOf(PropTypes.string),
  columnInfo: PropTypes.object,
  model: PropTypes.object,
  selectCandidates: PropTypes.object,
  onSubmit: PropTypes.func,
  onSelect: PropTypes.func,
};

EditTable.defaultProps = {
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  model: {},
  selectCandidates: {},
  onSubmit: () => {
  },
  onSelect: () => {
  },
};

export default EditTable;
