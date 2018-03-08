import React, {Component} from "react";
import Pagination from '../../components/Pagination/Pagination'
import {
  Row,
  Col,
  Card,
  CardHeader,
  CardBlock,
  Table,
} from "reactstrap";
import AdminUserRepository from "../../repositories/AdminUserRepository";
import IndexList from "../../components/IndexList/IndexList";

class AdminUsers extends Component {


  constructor(props) {
    super(props);
    this.getIndexList = this.getIndexList.bind(this);
    this.state = {
      params: {
        ...props.params,
        indexList: [],
      },
      methods: {
        ...props.methods,
        getIndexList: this.getIndexList,
      }
    }
  }

  componentWillMount() {
    this.getIndexList(0,0,'id', 'asc');
  }

  componentWillReceiveProps(newProps) {
    this.setState({
      params: {
        ...newProps.params,
        indexList: this.state.params.indexList,
      },
      methods: {
        ...newProps.methods,
        getIndexList: this.state.methods.getIndexList,
      }
    });
  }

  getIndexList(offset, limit, order, direction, searchWord = '', params = {}) {
    let repository = new AdminUserRepository();
    repository.index(offset, limit, order, direction, searchWord, params).then(repos => {
      this.setState({params: {list: repos}});
      console.log(this.state);
    });
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Row>
          <Col xs="12" lg="12">
            <Card>
              <CardHeader>
                <i className="fa fa-align-justify"></i> Admin Users
              </CardHeader>
              <CardBlock className="card-body">
                <IndexList list={this.state.params.list} stategetIndexList={this.getIndexList}/>
              </CardBlock>
            </Card>
          </Col>
        </Row>
      </div>
    )
  }
}

export default AdminUsers;
