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
      var params = '';
      var first = true;
      if(this.state.category != null && this.state.category != '')
      {
        if(first)
        {
          first = false;
          params = '?';
        }
        else
        {
          params = '&'
        }
        params +='category='+this.state.category;
      }
      if(this.state.text != null && this.state.text != '')
      {
        if(first)
        {
          first = false;
          params = '?';
        }
        else
        {
          params += '&'
        }
        params +='text='+this.state.text;
      }
      if(this.state.dateStart != null && this.state.dateStart != '')
      {
        if(first)
        {
          first = false;
          params = '?';
        }
        else
        {
          params += '&'
        }
        params +='startDate='+this.state.dateStart;
      }
      if(this.state.dateEnd != null && this.state.dateEnd != '')
      {
        if(first)
        {
          first = false;
          params = '?';
        }
        else
        {
          params += '&'
        }
        params +='endDate='+this.state.dateEnd;
      }

      window.location.href = '/'+LOCALE+'/blog/'+params;

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
                && response.data.data[0].descendants.length > 0)
            {

                self.setState({
                    categories : response.data.data[0].descendants
                });
            }


        }).catch(function (error) {
           console.log(error);
         });

    }



     printSpace(level)
    {

      if(level <= 1)
        return null;

      var spaces = [];
      for(var i=1;i<level;i++){
        spaces.push(
          "- "
        );
      }

      return spaces;
    }

    printCategories(categories, level, html){
      level++;
      for (var i = 0; i< categories.length; i++ ){
          html.push(<option key={categories[i].id} value={categories[i].id}>{this.printSpace(level)}{categories[i].name}</option>);
          if(categories[i].descendants.length > 0){
             this.printCategories(categories[i].descendants,level, html);
          }
      }

    }


    renderCategories() {
      var level = 0;
      var self = this;
      var html = [];
      self.printCategories(this.state.categories, level, html);
      console.log('RESULTAT:',html);
      return html;
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
                            placeholderText={Lang.get('messages.from_datepicker')}
                            locale="{LOCALE}"
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
                            placeholderText={Lang.get('messages.to_datepicker')}
                            locale="{LOCALE}"
                        />
                      </div>
                    </div>

                    <div className="row">
                      <input className="col-md-9 col-sm-8 col-xs-12" value={this.state.text} name="text" onChange={this.handleChange} placeholder={Lang.get('widgets.search_placeholder')} type="text"/>
                    </div>
                    <div className="row">
                      <input value={Lang.get('widgets.search')} className="btn" type="submit"/>
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
