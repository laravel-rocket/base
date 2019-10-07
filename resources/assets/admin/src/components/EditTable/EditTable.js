import React, {Component} from "react";
import PropTypes from "prop-types";
import {
  Row,
  Col,
  FormGroup,
  Label,
  Input,
  Button,
  Table,
} from "reactstrap";
import DatePicker from 'react-datepicker';
import ImageInput from "../ImageInput/ImageInput";
import Select from 'react-select';
import {Async as SelectAsync} from 'react-select';
import Map from '../../components/Map/Map'
import "react-datepicker/dist/react-datepicker.css";
import moment from 'moment';
import countries from 'country-data';
import HTMLEditor from '../HTMLEditor/HTMLEditor'


class EditTable extends Component {
  constructor(props) {
    super(props);
    this.state = {
      model: {},
      formData: {},
      options: {},
      errors: props.errors,
    };
    this.handleDataChange = this.handleDataChange.bind(this);
    this.handleReset = this.handleReset.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleSelectChange = this.handleSelectChange.bind(this);
    this.handleMapClick = this.handleMapClick.bind(this);
    this.handleDeleteFromList = this.handleDeleteFromList.bind(this);
  }

  componentWillReceiveProps(newProps) {
    const {
      columns, columnInfo
    } = newProps;
    const newFormData = this.state.formData;
    for (
      let i = 0;
      i < columns.length;
      i++
    ) {
      const key = columns[i];
      const formKey = columnInfo[key].queryName;
      switch (columnInfo[key].type) {
        case "checkbox":
          if (!Array.isArray(newProps.model[key])) {
            newFormData[formKey] = [];
          } else {
            newFormData[formKey] = newProps.model[key];
          }
          break;
        case "select_multiple":
        case "select_list":
          newFormData[formKey] = [];
          if (Array.isArray(newProps.model[key])) {
            newFormData[formKey] = [];
            newProps.model[key].forEach((item) => {
              newFormData[formKey].push(item.value || item.id);
            });
          }
          break;
      }
    }

    this.setState({
      ...this.state,
      model: Object.assign({}, newProps.model),
      formData: Object.assign({}, newFormData),
      errors: newProps.errors,
    })
  }

  handleDataChange(key, data, actionMeta) {
    const {
      columnInfo,
    } = this.props;
    const newFormData = this.state.formData;
    const newModelData = this.state.model;

    const formKey = columnInfo[key].queryName || key;

    let pos = 0;
    switch (columnInfo[key].type) {
      case "boolean":
        const actualValue = data ? 1 : 0
        newFormData[formKey] = actualValue;
        newModelData[key] = !!actualValue;
        break;
      case "checkbox":
        if (!Array.isArray(newModelData[key])) {
          newModelData[key] = [];
          newFormData[formKey] = [];
        }
        pos = newModelData[key].indexOf(data);
        if (pos >= 0) {
          newModelData[key].splice(pos, 1);
        } else {
          newModelData[key].push(data);
        }
        newFormData[formKey] = newModelData[key];
        break;
      case "select_multiple":
        if (!Array.isArray(newModelData[key])) {
          newModelData[key] = [];
        }
        newModelData[key] = data;
        newFormData[formKey] = [];
        newModelData[key].forEach((item) => {
          newFormData[formKey].push(item.value);
        });
        break;
      case "select_single":
        newModelData[key] = data;
        newFormData[formKey] = data.value;
        break;
      case "date":
        newModelData[key] = data.format('YYYY-MM-DD');
        newFormData[formKey] = data.format('YYYY-MM-DD');
        break;
      case "datetime":
        newModelData[key] = data.format('YYYY-MM-DD h:mm:ss');
        newFormData[formKey] = data.format('YYYY-MM-DD h:mm:ss');
        break;
      default:
        newFormData[formKey] = data;
        newModelData[key] = data;
    }
    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    });
    this.props.onModelChange(newModelData);
  }

  handleAddToList(key, value, actionMeta) {
    const {
      columnInfo,
    } = this.props;
    const newFormData = this.state.formData;
    const newModelData = this.state.model;
    const formKey = columnInfo[key].queryName;

    let newItem = null;
    if (Array.isArray(this.state.options[key])) {
      this.state.options[key].forEach((item) => {
        if (item.id === value.value) {
          newItem = item;
        }
      });
    } else {
      newItem = {
        id: value,
      };
    }
    if (!Array.isArray(newModelData[key])) {
      newModelData[key] = [];
    }
    let exists = false;
    newModelData[key].forEach((item) => {
      if (item.id === newItem.id) {
        exists = true;
      }
    });
    if (!exists) {
      newModelData[key].push(newItem);
      newFormData[formKey] = [];
      newModelData[key].forEach((item) => {
        newFormData[formKey].push(item.id);
      });
    }
    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    });
    this.props.onModelChange(newModelData);
  }

  handleDeleteFromList(key, entry) {
    const {
      columnInfo,
    } = this.props;
    const newFormData = this.state.formData;
    const newModelData = this.state.model;
    const formKey = columnInfo[key].queryName;

    if (Array.isArray(this.state.model[key])) {
      newModelData[key] = [];
      this.state.model[key].forEach((item) => {
        if (item.id !== entry.id) {
          newModelData[key].push(item);
        }
      });
      newFormData[formKey] = [];
      newModelData[key].forEach((item) => {
        newFormData[formKey].push(item.id);
      });
    }
    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    });
    this.props.onModelChange(newModelData);
  }

  handleReset(e) {
    this.setState({
      ...this.state,
      model: Object.assign({}, this.props.initialModel),
    });
    this.props.onModelChange(Object.assign({}, this.props.initialModel));
  }

  handleSubmit(e) {
    this.props.onSubmit(this.state.formData);
  }

  handleSelectChange(key, name, value) {
    if (!value) {
      return Promise.resolve({options: []});
    }

    return this.props.onSelect(name, value).then((options) => {
      const newOptions = this.state.options;
      newOptions[key] = options.options;
      this.setState({
        ...this.state,
        options: newOptions,
      });
      return options.options.map(function (option) {
        return {
          label: option.name,
          value: option.id,
        };
      });
    });
  }

  handleMapClick(key, latitude, longitude) {
    const {
      columnInfo,
    } = this.props;
    const newFormData = this.state.formData;
    const newModelData = this.state.model;

    newFormData[columnInfo[key].longitudeQueryName] = longitude;
    newFormData[columnInfo[key].latitudeQueryName] = latitude;
    newModelData[columnInfo[key].longitudeQueryName] = longitude;
    newModelData[columnInfo[key].latitudeQueryName] = latitude;

    this.setState({
      ...this.state,
      model: newModelData,
      formData: newFormData,
    })
  }


  buildForm(item, key, id) {
    const self = this;
    const {
      columnInfo,
    } = this.props;
    const {
      errors,
    } = this.state;
    if (item === undefined) {
      item = '';
    }
    if (!columnInfo[key]) {
      return null;
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
                   onChange={e => this.handleDataChange(key, e.target.files[0])}/>
          </FormGroup>
        );
      case 'date':
        if (!item) {
          item = moment();
        } else {
          item = moment(item);
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <DatePicker
              selected={item.toDate()}
              onChange={e => this.handleDataChange(key, moment(e))}
            />

          </FormGroup>
        );
      case 'image':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <ImageInput onChange={e => this.handleDataChange(key, e.target.files[0])} currentImageUrl={item.url}
                        name={key} thumbnailSize={200}/>
          </FormGroup>
        );
      case 'boolean':
        return (
          <FormGroup key={'input-' + key} row>
            <Col md="12">
              <FormGroup check>
                <div className="checkbox" key={key + '_true'}>
                  <Label check htmlFor={key + '_true'}>
                    <Input
                      onChange={e => this.handleDataChange(key, !item)}
                      checked={item}
                      type="checkbox"
                      id={key + '_true'}
                      name={key}
                      value={1}/> {columnInfo[key].name}
                  </Label>
                </div>
              </FormGroup>
            </Col>
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
            <Input type="textarea" id={key} name={key} value={item}
                   onChange={e => this.handleDataChange(key, e.target.value)}/>
          </FormGroup>
        );
      case 'html':
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <HTMLEditor id={key} name={key} value={item}
                        onChange={html => this.handleDataChange(key, html)}/>
          </FormGroup>
        );
      case 'select':
      case 'select_single':
      case 'select_multiple':
        console.log(item);

        const isMulti = columnInfo[key].type === 'select_multiple';

        let defaultValues = null;
        if (isMulti) {
          defaultValues = [];
          if (Array.isArray(item)) {
            item.forEach((value) => {
              defaultValues.push({
                value: value.id || value.value,
                label: value.name || value.label,
              });
            });
          }
        } else {
          if (item && typeof item === 'object') {
            defaultValues = {
              value: item.id || item.value,
              label: item.name || item.label,
            };
            console.log(defaultValues);
          }
        }

        if (columnInfo[key].relation) {
          return (
            <FormGroup key={'input-' + key}>
              <Label htmlFor={key}>{columnInfo[key].name}</Label>
              <SelectAsync
                isMulti={isMulti}
                name={key}
                onChange={(value, actionMeta) => this.handleDataChange(key, value, actionMeta)}
                loadOptions={(value) => {
                  return this.handleSelectChange(key, columnInfo[key].relation, value);
                }}
                backspaceRemoves={this.state.backspaceRemoves}
                value={defaultValues}
                defaultOptions={[]}
              />
            </FormGroup>
          );
        }
        const optionValues = [];
        for (const option of columnInfo[key].options) {
          optionValues.push({
            value: option,
            label: columnInfo[key].optionNames[option],
          });
          if (Array.isArray(item)) {
            if (item.includes(option)) {
              if (!defaultValues) {
                defaultValues = [];
              }
              defaultValues.push({
                value: option,
                label: columnInfo[key].optionNames[option],
              });
            }
          } else {
            if (option === item) {
              defaultValues = {
                value: option,
                label: columnInfo[key].optionNames[option],
              };
            }
          }
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              isMulti={isMulti}
              name={key}
              onChange={(value, actionMeta) => this.handleDataChange(key, value)}
              options={optionValues}
              value={defaultValues}
            />
          </FormGroup>
        );
      case 'location':
        let longitude = this.state.model[columnInfo[key].longitudeQueryName];
        let latitude = this.state.model[columnInfo[key].latitudeQueryName];
        if (!longitude) {
          longitude = columnInfo[key].defaultLongtitude
        }
        if (!latitude) {
          latitude = columnInfo[key].defaultLatitude
        }
        let zoom = columnInfo[key].zoom

        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Row>
              <Col md="8">
                <Map height={"300px"} latitude={parseFloat(latitude)} longitude={parseFloat(longitude)}
                     zoom={parseInt(zoom)}
                     onClick={(latitude, longitude) => {
                       this.handleMapClick(key, latitude, longitude)
                     }}/>
              </Col>
              <Col md="4">
                <Label htmlFor={key}>Longitude</Label>
                <Input type="text" id={key} name={columnInfo[key].longitudeQueryName} value={longitude}
                       onChange={e => this.handleDataChange(key, e.target.value)}/>
                <Label htmlFor={key}>Latitude</Label>
                <Input type="text" id={key} name={columnInfo[key].latitudeQueryName} value={latitude}
                       onChange={e => this.handleDataChange(key, e.target.value)}/>
              </Col>
            </Row>
          </FormGroup>
        );
      case 'list':

        let columns = [];
        if (Array.isArray(item) && columnInfo[key].relation) {
          columns = item.map((entry, i) => {
            return (<tr key={"row-" + i}>
              {Object.keys(columnInfo[key].columns).map((column, i) =>
                <td key={"item-" + i}>{entry[column]}</td>)}
              <td>
                <Button size="sm" color="danger" onClick={e => {
                  self.handleDeleteFromList(key, entry);
                  return false;
                }}><i className="fa fa-trash-o"/> Delete</Button>
              </td>
            </tr>)
          });
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <SelectAsync
              name={key}
              onChange={(value, actionMeta) => self.handleAddToList(key, value, actionMeta)}
              loadOptions={(value) => {
                return self.handleSelectChange(key, columnInfo[key].relation, value);
              }}
              backspaceRemoves={true}
              value={""}
            />
            <Table responsive>
              <thead>
              <tr key={"header"}>
                {Object.keys(columnInfo[key].columns).map((column, i) => <th
                  key={key + i}>{columnInfo[key].columns[column]}</th>)}
                <th>&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              {columns}
              </tbody>
            </Table>
          </FormGroup>
        );
      case 'datetime':
        if (!item) {
          item = moment();
        } else {
          item = moment(item);
        }
        return (
          <FormGroup key={'input-' + key}>
            <Row>
              <Col md={3} xs={12}>
                <Label htmlFor={key}>{columnInfo[key].name}</Label>
              </Col>
              <Col md={9} xs={12}>
                <DatePicker
                  selected={item.toDate()}
                  onChange={e => this.handleDataChange(key, moment(e))}
                  showTimeSelect
                  dateFormat="yyyy/MM/dd hh:mm:ss"
                />
              </Col>
            </Row>
          </FormGroup>
        );
      case 'country':
        let countryList = [];
        for (let country of countries.countries.all) {
          if (country.alpha2.length === 2) {
            countryList.push({
              value: country.alpha2,
              label: country.name,
            });
          }
        }
        defaultValues = null;
        if (isMulti) {
          defaultValues = [];
          if (Array.isArray(item)) {
            item.forEach((value) => {
              defaultValues.push({
                value: value.id || value.value,
                label: value.name || value.label,
              });
            });
          }
        } else {
          if (item && typeof item === 'object') {
            defaultValues = {
              value: item.id || item.value,
              label: item.name || item.label,
            };
            console.log(defaultValues);
          }
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              name={key}
              onChange={(value, actionMeta) => this.handleDataChange(key, value)}
              options={countryList}
              value={defaultValues}
            />
          </FormGroup>
        );
      case 'language':
        let languageList = [];
        for (let language of countries.languages.all) {
          if (language.alpha2.length === 2) {
            languageList.push({
              value: language.alpha2,
              label: language.name,
            });
          }
        }
        defaultValues = null;
        if (isMulti) {
          defaultValues = [];
          if (Array.isArray(item)) {
            item.forEach((value) => {
              defaultValues.push({
                value: value.id || value.value,
                label: value.name || value.label,
              });
            });
          }
        } else {
          if (item && typeof item === 'object') {
            defaultValues = {
              value: item.id || item.value,
              label: item.name || item.label,
            };
            console.log(defaultValues);
          }
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              name={key}
              onChange={(value, actionMeta) => this.handleDataChange(key, value)}
              options={languageList}
              value={defaultValues}
            />
          </FormGroup>
        );
      case 'currency':
        let currencyList = [];
        for (let currency of countries.currencies.all) {
          currencyList.push({
            value: currency.code,
            label: currency.name,
          });
        }
        defaultValues = null;
        if (isMulti) {
          defaultValues = [];
          if (Array.isArray(item)) {
            item.forEach((value) => {
              defaultValues.push({
                value: value.id || value.value,
                label: value.name || value.label,
              });
            });
          }
        } else {
          if (item && typeof item === 'object') {
            defaultValues = {
              value: item.id || item.value,
              label: item.name || item.label,
            };
            console.log(defaultValues);
          }
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              name={key}
              onChange={(value, actionMeta) => this.handleDataChange(key, value)}
              options={currencyList}
              value={defaultValues}
            />
          </FormGroup>
        );
      case 'phone': {
        let phoneList = {};
        for (let currency of countries.currencies.all) {
          phoneList.push({
            value: currency.countryCallingCodes,
            label: currency.name,
          });
        }
        defaultValues = null;
        if (isMulti) {
          defaultValues = [];
          if (Array.isArray(item)) {
            item.forEach((value) => {
              defaultValues.push({
                value: value.id || value.value,
                label: value.name || value.label,
              });
            });
          }
        } else {
          if (item && typeof item === 'object') {
            defaultValues = {
              value: item.id || item.value,
              label: item.name || item.label,
            };
            console.log(defaultValues);
          }
        }
        return (
          <FormGroup key={'input-' + key}>
            <Label htmlFor={key}>{columnInfo[key].name}</Label>
            <Select
              name={key}
              onChange={(value, actionMeta) => this.handleDataChange(key, value)}
              options={phoneList}
              value={defaultValues}
            />
          </FormGroup>
        );
      }

    }
    console.log(countries);
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
    const {
      errors,
    } = this.state;
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
            <p className="alert-danger">
              {errors && errors[columns[i]] && errors[columns[i]]}</p>
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
            }}><i className="fa fa-dot-circle-o"/> Submit</Button>
            {' '}
            <Button size="sm" color="danger" onClick={e => {
              this.handleReset()
            }}><i className="fa fa-ban"/> Reset</Button>
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
  initialModel: PropTypes.object,
  selectCandidates: PropTypes.object,
  onSubmit: PropTypes.func,
  onSelect: PropTypes.func,
  onModelChange: PropTypes.func,
};

EditTable.defaultProps = {
  columns: ['id'],
  columnInfo: {id: {name: 'ID', type: "integer", editable: false}},
  model: {},
  initialModel: {},
  selectCandidates: {},
  onSubmit: () => {
  },
  onSelect: () => {
  },
  onModelChange: () => {
  },
};

export default EditTable;
