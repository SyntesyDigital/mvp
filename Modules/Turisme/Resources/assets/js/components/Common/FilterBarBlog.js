import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import DatePicker from 'react-datepicker';
import moment from 'moment';


class FilterBarBlog extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          category:'',
          text : '',
          categories : [],

        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleSubmit(event) {
      event.preventDefault();

      const state = this.state;

      this.props.onSubmit({
        category : this.state.category != null ? this.state.category : null,
        text : this.state.text != '' ? this.state.text : null,
        startDate : this.state.dateStart != null ? this.state.dateStart : null,
        endDate : this.state.dateEnd != null ? this.state.dateEnd : null,
      });
    }

    handleChange(event) {
      event.preventDefault();
      const state = this.state;
      state[event.target.name] = event.target.value;

      this.setState(state);

    }

    handleDateChange(name,date){
    //  console.log("handleDateChange => ",date,name);

      const state = this.state;
      state[name] = date;

      this.setState(state);
    }

    componentDidMount() {
      this.loadCategories();
    }


    loadCategories() {

      var self = this;

      axios.get(ASSETS+'api/categories/tree?accept_lang='+LOCALE+'&category_id=1')
        .then(function (response) {
            if(response.status == 200
                && response.data.data !== undefined
                && response.data.data.descendants.length > 0)
            {
                self.setState({
                    categories : response.data.data.descendants
                });
            }


        }).catch(function (error) {
           console.log(error);
         });

    }


    renderCategories() {
      return this.state.categories.map((item,key) =>
        <option key={key} value={item.id}>{item.name}</option>
      );
    }

    render() {

        return (
          <div className="grey">
            <div className="row">
              <div className="container">
                <form onSubmit={this.handleSubmit.bind(this)} className="blog-search">
                
                  <div className="row">
                    <label className="col-md-3 col-sm-4 col-xs-12">Selecciona una categoria </label>
                    <select name="category" className="col-md-9 col-sm-8 col-xs-12" onChange={this.handleChange} value={this.state.category}>
                        <option disabled value="">{Lang.get('widgets.select_category')}</option>
                        {this.renderCategories()}
                          </select>
                      </div>
                    <div className="row">
                      <div className="input-date">
                        <DatePicker
                            className="input-date"
                            selected={this.state.dateStart}
                            selectsStart
                            startDate={this.state.dateStart}
                            endDate={this.state.dateEnd}
                            onChange={this.handleDateChange.bind(this,'dateStart')}
                            locale="ca-es"
                        />
                      </div>
                    </div>
                    <div className="row">
                      <div className="input-date">
                        <DatePicker
                            className="input-date"
                            selected={this.state.dateEnd}
                            selectsEnd
                            startDate={this.state.dateStart}
                            minDate={this.state.dateStart}
                            endDate={this.state.dateEnd}
                            onChange={this.handleDateChange.bind(this,'dateEnd')}
                            locale="ca-es"
                        />
                      </div>  
                    </div>

                    <div className="row">
                      <input className="col-md-9 col-sm-8 col-xs-12" value={this.state.text} name="text" onChange={this.handleChange} placeholder={Lang.get('widgets.search_placeholder')} type="text"/>
                    </div> 
                    <div className="row">
                      <input value="Submit" className="btn" type="submit"/>
                    </div>
                  <div className="separator"></div>

                </form>
              </div>
            </div>
          </div>

        );
    }
}

export default FilterBarBlog;
