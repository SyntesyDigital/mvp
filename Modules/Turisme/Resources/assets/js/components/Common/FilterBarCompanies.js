import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FilterBarCompanies extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          category : '',
          text : '',
          categories : []
        };

        this.handleChange = this.handleChange.bind(this);
    }

    componentDidMount() {
      this.loadCategories();
    }

    loadCategories() {

      var self = this;

      axios.get(ASSETS+'externalapi/indicators?search=axe_id:'+this.props.axe)
        .then(function (response) {

            if(response.status == 200
                && response.data.data !== undefined
                && response.data.data.length > 0)
            {
                self.setState({
                    categories : response.data.data
                });
            }


        }).catch(function (error) {
           console.log(error);
         });

    }

    handleSubmit(event) {
      event.preventDefault();

      const state = this.state;

      var query = [];

      //search=name:ADFO;indicator_id:10&searchFields=name:like;indicator_id:=&searchJoin=and

      query.push({
        search : 'indicator.axe_id:'+this.props.axe,
        searchFields : 'indicator.axe_id:='
      });

      if(this.state.category != ''){
          query.push({
            search : 'indicator_id:'+this.state.category,
            searchFields : 'indicator_id:='
          });
      }

      if(this.state.text != ''){
          query.push({
            search : 'name:'+this.state.text,
            searchFields : 'name:like'
          });
      }

      this.props.onSubmit({
        text : this.state.language != '' ? this.state.language : null,
        category : this.state.free,
        query : this.processQuery(query)
      });

    }

    processQuery(filtersArray) {

      var query = '&search=:search-query&searchFields=:search-fields&searchJoin=and';

      var searchQuery = '';
      var searchFields = '';

      if(filtersArray != null && filtersArray.length > 0){

        for(var key in filtersArray){
          searchQuery += (key > 0 ? ';' : '')+filtersArray[key]['search'];
          searchFields += (key > 0 ? ';' : '')+filtersArray[key]['searchFields'];
        }
      }

      query = query.replace(':search-query',searchQuery);
      query = query.replace(':search-fields',searchFields);

      return query;

    }

    handleChange(event) {
      event.preventDefault();

      const state = this.state;
      state[event.target.name] = event.target.value;

      this.setState(state);
    }

    renderCategories() {
      return this.state.categories.map((item,key) =>
        <option key={key} value={item.id}>{item['description_'+LOCALE]}</option>
      );
    }

    render() {

        return (
            <div className="filter-bar filter-companies">
              <form onSubmit={this.handleSubmit.bind(this)} className="nova-cerca">

                <select name="category" className="col-xs-3" onChange={this.handleChange} value={this.state.language}>
                  <option value="">{window.localization['GENERAL_WIDGET_SELECT_INDICADOR']}</option>
                  {this.renderCategories()}
                </select>

                <input type="text" name="text" value={this.state.text} onChange={this.handleChange} placeholder={window.localization['GENERAL_BUTTON_SEARCH']} style={{marginLeft:20}} />

                <input type="submit" value={window.localization['GENERAL_BUTTON_SEARCH']} className="btn" />
                <div className="separator"></div>
              </form>
            </div>
        );
    }
}

export default FilterBarCompanies;
