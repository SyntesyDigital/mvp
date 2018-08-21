import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FilterBarMembers extends Component {

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

      axios.get(ASSETS+'externalapi/programs-categories/all')
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

      if(this.state.category != ''){
          query.push('');
      }

      if(this.state.text != ''){
          query.push('&search='+text+'&searchFields=name:like');
      }

      this.props.onSubmit({
        text : this.state.language != '' ? this.state.language : null,
        free : this.state.free,
        query : this.processQuery(query)
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

    renderCategories() {
      return this.state.categories.map((item,key) =>
        <option key={key} value={item.code}>{item['description_'+LOCALE]}</option>
      );
    }

    render() {

        return (
            <div className="filter-bar">
              <form onSubmit={this.handleSubmit.bind(this)} className="nova-cerca">

                <select name="category" className="col-xs-3" onChange={this.handleChange} value={this.state.language}>
                  <option value="">{Lang.get('widgets.select_category')}</option>
                  {this.renderCategories()}
                </select>

                <input type="text" name="text" value={this.state.text} onChange={this.handleChange} placeholder={Lang.get('widgets.search_placeholder')} style={{marginLeft:20}} />

                <input type="submit" value={Lang.get('widgets.search')} className="btn" />
                <div className="separator"></div>
              </form>
            </div>
        );
    }
}

export default FilterBarMembers;
