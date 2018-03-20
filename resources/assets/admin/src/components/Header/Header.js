import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import {
  Badge,
  Dropdown,
  DropdownMenu,
  DropdownItem,
  Nav,
  NavItem,
  NavbarToggler,
  NavbarBrand,
  DropdownToggle
} from 'reactstrap';

import ObjectHelper from "../../helpers/ObjectHelper";

class Header extends Component {

  constructor(props) {
    super(props);

    this.handleProfileDropDownToggle = this.handleProfileDropDownToggle.bind(this);
    this.handleNotificationDropDownToggle = this.handleNotificationDropDownToggle.bind(this);
    this.handleSidebarToggle = this.handleSidebarToggle.bind(this);
    this.handleSidebarMinimize = this.handleSidebarMinimize.bind(this);
    this.handleMobileSidebarToggle = this.handleMobileSidebarToggle.bind(this);
    this.handleSignOutOnClick = this.handleSignOutOnClick.bind(this);

    this.state = {
      profileDropDownOpen: false,
      notificationDropDownOpen: false,
      params: props.params
    };
  }

  handleSignOutOnClick(e) {
    this.props.methods.signOut(e);
  }

  componentWillReceiveProps(newProps) {
    this.setState({params: newProps.params});
  }

  handleProfileDropDownToggle(e) {
    this.setState({
      profileDropDownOpen: !this.state.profileDropDownOpen
    });
  }

  handleNotificationDropDownToggle(e) {
    this.setState({
      notificationDropDownOpen: !this.state.notificationDropDownOpen
    });
  }

  handleSidebarToggle(e) {
    e.preventDefault();
    document.body.classList.toggle('sidebar-hidden');
  }

  handleSidebarMinimize(e) {
    e.preventDefault();
    document.body.classList.toggle('sidebar-minimized');
  }

  handleMobileSidebarToggle(e) {
    e.preventDefault();
    document.body.classList.toggle('sidebar-mobile-show');
  }

  render() {
    const notificaitons = ObjectHelper.get(this.state, "params.information.notifications", []).map((notification) =>
      <DropdownItem><i className="fa fa-bell"></i> Notificaiton</DropdownItem>
    );

    return (
      <header className="app-header navbar">
        <NavbarToggler className="d-lg-none" onClick={this.handleMobileSidebarToggle}>&#9776;</NavbarToggler>
        <NavbarBrand href="#"></NavbarBrand>
        <NavbarToggler className="d-md-down-none" onClick={this.handleSidebarToggle}>&#9776;</NavbarToggler>
        <Nav className="ml-auto" navbar>
          <NavItem>
            <Dropdown isOpen={this.state.notificationDropDownOpen} toggle={this.handleNotificationDropDownToggle}>
              <DropdownToggle className="nav-link dropdown-toggle">
                <i className="icon-bell"></i>
                {ObjectHelper.get(this.state, "params.information.notificationCount", 0) > 0 &&
                <Badge pill
                       color="danger">{ObjectHelper.get(this.state, "params.information.notificationCount", 0)}</Badge>
                }
              </DropdownToggle>
              <DropdownMenu right className={this.state.notificationDropDownOpen ? 'show' : ''}>
                {ObjectHelper.get(this.state, "params.information.notificationCount", 0) <= 0 &&
                <DropdownItem>
                  <div className="text-center">No Unread Notification</div>
                </DropdownItem>
                }
                {notificaitons}
              </DropdownMenu>
            </Dropdown>
          </NavItem>
          <NavItem>
            <Dropdown isOpen={this.state.profileDropDownOpen} toggle={this.handleProfileDropDownToggle}>
              <DropdownToggle className="nav-link dropdown-toggle">
                <img src={ObjectHelper.get(this.state, "params.information.authUser.profileImage.url", '')}
                     className="img-avatar" alt=""/>
                <span
                  className="d-md-down-none">{ObjectHelper.get(this.state, "params.information.authUser.name", 'Unknown')}</span>
              </DropdownToggle>
              <DropdownMenu right className={this.state.profileDropDownOpen ? 'show' : ''}>
                <DropdownItem header tag="div" className="text-center"><strong>Settings</strong></DropdownItem>
                <DropdownItem onClick={this.props.methods.moveToProfileEdit}><i className="fa fa-user"></i> Profile</DropdownItem>
                <DropdownItem divider/>
                <DropdownItem onClick={(e)=>{this.handleSignOutOnClick(e)}}><i className="fa fa-lock"></i>Sign out</DropdownItem>
              </DropdownMenu>
            </Dropdown>
          </NavItem>
          <NavItem></NavItem>
        </Nav>
      </header>
    )
  }
}

export default Header;
