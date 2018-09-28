import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

export default class Table extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
          items : []
        };
    }

    componentDidMount() {

      var self = this;

      axios.get(this.props.route)
        .then(response => {
          var items = [];

          if(response.status == 200 && response.data.data !== undefined
            && response.data.data.length > 0){
                items = response.data.data;
          }

          self.setState({
            items : items
          });

        })
         .catch(function (error) {
           console.log(error);
         });

    }

    onItemClick(item,e) {
      e.preventDefault();

      //console.log("Table :: onItemClick => ",item,e);

      window.location.href = routes['showContent'].replace(':id',item.id);
    }

    getCircleClass(name){
      if(name == "Publicat"){
        return 'published';
      }
      else if(name == "Esborrany"){
        return 'draft';
      }
      return '';
    }

    renderItems() {

      var result = [];

      const {items} = this.state;

      var counter = 0;
      const max = this.props.max !== undefined ? parseInt(this.props.max) : 25;

      for(var key in items){

        if(counter < 25){
          result.push(
            <tr key={key} onClick={this.onItemClick.bind(this,items[key])}>
              <td>
                {items[key].title}
              </td>
              <td>
                <i className={"fa fa-circle "+this.getCircleClass(items[key].status)}></i>
              </td>
              <td>
                  {items[key].updated}
              </td>
            </tr>
          );
        }

        counter++;
      }

      return result;
    }

    render() {

        return (
          <div className="dashboard-table">
              <div className="dashboard-table-header">
                <h3> {this.props.title}</h3>

                <table>
                  <thead>
                    <tr>
                      <th>
                        Nom
                      </th>
                      <th>
                        Estat
                      </th>
                      <th>
                        Data
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>

              <div className="dashboard-table-body">
                <table>
                  <tbody>
                    {this.renderItems()}
                  </tbody>
                </table>
              </div>
          </div>
        );
    }
}

if (document.getElementById('dashboard-table')) {

    document.querySelectorAll('[id=dashboard-table]').forEach( element => {

      //var field = element.getAttribute('Table');

      var title = element.getAttribute('title');
      var route = element.getAttribute('route');
      var max = element.getAttribute('max');

      ReactDOM.render(<Table
          title = {title}
          route = {route}
          max = {max}
        />, element);
    });
}
