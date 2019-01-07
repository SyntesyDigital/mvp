import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ModalEditUser from './ModalEditUser';

export default class CustomerUsers extends Component {

  constructor(props)
  {
      super(props);
      this.state = {
        display : false,
        user_id : null,
        config : props.config ? JSON.parse(atob(props.config)) : '',
        initializated: false,
        items : [],
        routes : null,
      };
  }

  componentDidMount() {
      this.loadUsers();
  }

  loadUsers() {
      var self = this;
      if(this.state.config.type == "ajax") {
        axios.get(this.state.config.route)
            .then(function (response) {
                self.setState({
                    initializated : true,
                    items : response.data.users,
                    routes : response.data.routes
                });
            }).catch(function (error) {
                console.log(error);
            });
      }
  }

  onRemoveField(id,e) {

    e.preventDefault();

    console.log("CustomerUsers :: onRemoveField => ",id);

    var self = this;
    var user = null;

    bootbox.confirm({
        message: 'Etes-vous sur de vouloir supprimer ?',
        buttons: {
            confirm: {
                label: 'Oui',
                className: 'btn-primary'
            },
            cancel: {
                label: 'Non',
                className: 'btn-default'
            }
        },
        callback: function(result) {
            if (result) {

                // FIXME : find best way to do this :)
                if(self.state.items) {
                    for(var i =0;i<self.state.items.length;i++){
                        if(self.state.items[i].id == id){
                            user = self.state.items[i];
                        }
                    }
                }

                if(user) {
                    axios.delete(user.routes.delete)
                        .then((response) => {
                            toastr.success('User remove correctly');
                            self.loadUsers();
                        })
                        .catch((error) => {
                            toastr.error('An error occurred');
                        });
                }

            }
        }
    });



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
      user_id : id,
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

  getSelectedItem() {
    const {user_id,items} = this.state;

    if(user_id !== null && items != null){
        for(var i =0;i<items.length;i++){
            if(items[i].id == user_id){
                return items[i];
            }
        }
    }

    return null;
  }

  render() {
      var users = this.state.initializated ? this.renderUsers() : '';

      return (
          <div className="container">

            {this.state.initializated &&
                <ModalEditUser
                  display={this.state.display}
                  onUserCancel={this.onUserCancel.bind(this)}
                  onUserSubmit={this.onUserSubmit.bind(this)}
                  selectedItem={this.getSelectedItem()}
                  routes={this.state.routes}
                />
            }

            <div className="field-form fields-list-container">
                {users}
            </div>

            <div className="add-content-button">
              <a href="" className="btn btn-default" onClick={this.onCreateUser.bind(this)}><i className="fa fa-plus-circle"></i> Ajouter </a>
            </div>

          </div>
      );
  }

}

if (document.getElementById('customer_users')) {
    var element = document.getElementById('customer_users');
    var config = element.getAttribute('config');

    ReactDOM.render(<CustomerUsers config={config} />, document.getElementById('customer_users'));
}
