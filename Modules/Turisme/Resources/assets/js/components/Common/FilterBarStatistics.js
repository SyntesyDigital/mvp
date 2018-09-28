import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class FilterBarStatistics extends Component {

    constructor(props)
    {
        super(props);

        this.currentYear = (new Date()).getFullYear();
        this.minYear = 2000;

        this.state = {
          year : this.currentYear
        };

        this.handleChange = this.handleChange.bind(this);
    }

    componentDidMount() {
      this.submitYear(this.currentYear);
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

      const year = event.target.value;

      this.submitYear(year);

    }

    submitYear(year) {

      const state = this.state;

      state[event.target.name] = year;
      this.setState(state);

      var initYear = parseInt(year);
      var endYear = initYear+1;

      var initTimestamp = Math.floor(new Date(initYear, 0, 1 ).getTime()/1000);
      var endTimestamp = Math.floor(new Date(endYear, 0, 1 ).getTime()/1000);

      var query = [];
      query.push('["data",">=","'+initTimestamp+'"]');
      query.push('["data","<","'+endTimestamp+'"]');

      this.props.onSubmit({
        year : event.target.value,
        query : this.processQuery(query)
      });

    }

    renderYears(){
      var years = [];
      for ( var i=this.currentYear;i>=this.minYear;i--){
        years.push(
          <option key={i} value={i}>{i}</option>
        )
      }
      return years;
    }

    render() {

        return (
            <div className="filter-bar">
              <form onSubmit={this.handleSubmit.bind(this)} className="nova-cerca">

                <div className="col-xs-3">
                  <p>
                    window.localization['WIDGET_BAR_CONSULTA_SELECT_YEAR']
                  </p>
                </div>
                <select name="year" className="col-xs-3" value={this.state.year} onChange={this.handleChange} value={this.state.language}>
                  {this.renderYears()}
                </select>
                <div className="separator"></div>
              </form>
            </div>
        );
    }
}

export default FilterBarStatistics;
