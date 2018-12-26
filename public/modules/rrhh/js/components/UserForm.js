import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class UserForm extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          fields : {
            lastname : '',
            firstname : '',
            email : '',
            telephone : '',
            password : '',
            password_confirmation : ''
          }
        };

        this.handleChange = this.handleChange.bind(this);
    }

    componentDidMount()
    {

    }

    componentWillReceiveProps(nextProps)
    {

    }

    getAttributes() {
      return this.state.fields;
    }

    handleChange(e){

      const {fields} = this.state;

      fields[e.target.name] = e.target.value;

      this.setState({
        fields : fields
      });

    }

    render() {

        const {fields} = this.state;

        return (
          <div className="col-md-offset-1 col-md-10 col-xs-12">

            <div className="row">
              <div className="col-md-6 form-group">
                  <label htmlFor="name">Nom</label>
                  <input type="text" className="form-control" id="lastname" name="lastname" placeholder="" value={fields.lastname} onChange={this.handleChange}/>
              </div>
              <div className="col-md-6 form-group">
                  <label htmlFor="name">Prénom</label>
                  <input type="text" className="form-control" id="firstname" name="firstname" placeholder="" value={fields.firstname} onChange={this.handleChange}/>
              </div>
              <div className="col-md-6 form-group">
                  <label htmlFor="name">Email</label>
                  <input type="text" className="form-control" id="email" name="email" placeholder="" value={fields.email} onChange={this.handleChange}/>
              </div>
              <div className="col-md-6 form-group">
                  <label htmlFor="name">Telephone</label>
                  <input type="text" className="form-control" id="telephone" name="telephone" placeholder="" value={fields.telephone} onChange={this.handleChange}/>
              </div>

              <div className="col-md-6 form-group">
                  <label htmlFor="name">Mot de passe</label>
                  <input type="password" className="form-control" id="password" name="password" minLength="6" placeholder=""value={fields.password} onChange={this.handleChange}/>
              </div>
              <div className="col-md-6 form-group">
                  <label htmlFor="name">Confirmez le mot de passe</label>
                  <input type="password" className="form-control" id="password_confirmation" name="password_confirmation" minLength="6" placeholder="" value={fields.password_confirmation} onChange={this.handleChange}/>
              </div>
            </div>


          </div>
        );
    }
}

export default UserForm;
