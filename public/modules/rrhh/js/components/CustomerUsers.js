import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ModalEditUser from './ModalEditUser';

export default class CustomerUsers extends Component {

  constructor(props)
  {
      super(props);

      this.state = {
        display : true,
        user_id : null,
        items : [
          {
            id : 1,
            lastname : 'Lastname 1',
            firstname : 'Name 1',
            email : 'name1@gmail.com',
            telephone : '2342343'
          },
          {
            id : 2,
            lastname : 'Lastname 2',
            firstname : 'Name 2',
            email : 'name2@gmail.com',
            telephone : '234234'
            
          }

        ]
      };

  }

  loadUsers() {

    //TODO api to load users
    /*
    axios.get('/architect/customer/users/')
      .then(function (response) {

          if(response.status == 200
              && response.data.data !== undefined
              && response.data.data.length > 0)
          {
              self.setState({
                  items : response.data.data
              });
          }

      }).catch(function (error) {
         console.log(error);
       });
    */

  }

  onRemoveField(id,e) {

    e.preventDefault();

    console.log("CustomerUsers :: onRemoveField => ",id);

    var self = this;

    //TODO api remove item by id
    /*
      axios.post('/architect/customer/users/remove', {
          id : id
      })
      .then((response) => {
          toastr.success('User remove correctly');

          self.loadUsers();
      })
      .catch((error) => {
          toastr.error('An error occurred');
      });
    */

  }

  renderUsers() {

    var self = this;

    return this.state.items.map((item, key) =>
      <div className="typology-field" key={key}>
        <div className="field-type">
          <i className={"fa fa-user-o"}></i> &nbsp;
        </div>

        <div className="field-inputs" onClick={this.onEditUser.bind(this,item.id)}>
          <div className="field-name">
            {item.firstname} {item.lastname}
          </div>
          <div className="field-name">
            {item.email}
          </div>

        </div>

        <div className="field-actions">
          <a href="" className="remove-field-btn" onClick={self.onRemoveField.bind(this,item.id)}> <i className="fa fa-trash"></i>  </a>
          &nbsp;&nbsp;
        </div>
      </div>
    );

  }

  onEditUser(id,e) {

    e.preventDefault();

    console.log("CustomerUsers :: onEditUser => ",id);


    this.setState({
      display: true,
      user_id : id
    });

  }

  onCreateUser(e) {

    e.preventDefault();

    this.setState({
      display: true,
      user_id : null
    });

  }

  onUserCancel(){
    this.setState({
      display: false,
      user_id : null
    });
  }

  onUserSubmit() {

    toastr.success('User saved correctly.');

    this.loadUsers();

    this.setState({
      //update users
      display: false,
      user_id : null
    });
  }

  render() {
      return (
          <div className="container">

            <ModalEditUser
              display={this.state.display}
              onUserCancel={this.onUserCancel.bind(this)}
              onUserSubmit={this.onUserSubmit.bind(this)}
              user_id={this.state.user_id}
            />


            <div className="field-form fields-list-container">
                {this.renderUsers()}
            </div>

            <div className="add-content-button">
              <a href="" className="btn btn-default" onClick={this.onCreateUser.bind(this)}><i className="fa fa-plus-circle"></i> Ajouter </a>
            </div>

          </div>
      );
  }

}

if (document.getElementById('customer_users')) {
    ReactDOM.render(<CustomerUsers />, document.getElementById('customer_users'));
}
