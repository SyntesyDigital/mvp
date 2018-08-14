import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FilterBarPublication extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          language : '',
          free : false
        };

        this.handleChange = this.handleChange.bind(this);
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
        query : this.processQuery(query)
      });

    }

    processQuery(filtersArray) {

      var fieldsQuery = '';

      if(filtersArray != null && filtersArray.length > 0){

        var fieldsQuery = '&fields=[';

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

    render() {

        return (
            <div className="filter-bar">
              <form onSubmit={this.handleSubmit.bind(this)} className="nova-cerca">

                <select name="language" className="col-xs-3" onChange={this.handleChange} value={this.state.language}>
                  <option value="">----</option>
                  <option value="català">Català</option>
                  <option value="castellano">Castellano</option>
                  <option value="english">English</option>
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

                <input type="submit" value={Lang.get('widgets.search')} className="btn" />
                <div className="separator"></div>
              </form>
            </div>
        );
    }
}

export default FilterBarPublication;
