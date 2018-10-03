import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FilterBarPublication extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          language : '',
          free : false,
          categories : [],
          category:''
        };

        this.handleChange = this.handleChange.bind(this);
    }

    componentDidMount() {
      this.loadCategories();
    }

    handleSubmit(event) {
      event.preventDefault();

      const state = this.state;

      var query = [];

      if(this.state.language != '' && this.state.language != null){
          query.push('["idiomes","like","%'+this.state.language+'%"]');
      }

      if(this.state.free){
          query.push('["es-de-pagament","=","1"]');
      }

      this.props.onSubmit({
        text : this.state.language != '' ? this.state.language : null,
        free : this.state.free,
        query : this.processQuery(query),
        category_id : this.state.category
      });

    }

    processQuery(filtersArray) {

      var fieldsQuery = '';

      if(filtersArray != null && filtersArray.length > 0){

        var fieldsQuery = '[';

        for(var key in filtersArray){
          fieldsQuery += (key > 0 ? ',' : '')+filtersArray[key];
        }
        fieldsQuery+=']';
      }

      return fieldsQuery;

    }


    loadCategories() {

      var self = this;

      axios.get(ASSETS+'api/categories/tree?accept_lang='+LOCALE+'&category_id=15')
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

    handleChange(event) {
      event.preventDefault();

      const state = this.state;
      state[event.target.name] = event.target.value;

      this.setState(state);
    }

    handleCheckboxChange(event) {

      const state = this.state;
      state[event.target.name] = event.target.checked;

      this.setState(state);
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
            <div className="filter-bar filter-publication">
              <form onSubmit={this.handleSubmit.bind(this)} className="nova-cerca">

                <select name="category" className="col-xs-3" onChange={this.handleChange}  value={this.state.category}>
                  <option value="">{window.localization['GENERAL_WIDGET_SELECT_CATEGORY']}</option>
                  {this.renderCategories()}
                </select>


                <select name="language" className="col-xs-3" onChange={this.handleChange} value={this.state.language}>
                  <option value="">----</option>
                  <option value="català">{window.localization['GENERAL_FORM_LANG_CAT']}</option>
                  <option value="castellano">{window.localization['GENERAL_FORM_LANG_SPA']}</option>
                  <option value="english">{window.localization['GENERAL_FORM_LANG_ENG']}</option>
                </select>

                <div className="col-xs-3 checkbox" style={{paddingLeft:40}}>
                  <label className="col-md-4 col-sm-6 col-xs-12">
    				          <input
                        type="checkbox"
                        name="free"
                        checked={ this.state.free }
                        onChange={this.handleCheckboxChange.bind(this)}
                      />
    				          Gratuitas
                  </label>
                </div>

                <input type="submit" value={window.localization['GENERAL_BUTTON_SEARCH']} className="btn" />
                <div className="separator"></div>
              </form>
            </div>
        );
    }
}

export default FilterBarPublication;
