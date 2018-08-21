import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Paginator from './../Common/Paginator';
import ListExternalItem from './../Common/ListExternalItem';
import OrderBar from './../Common/OrderBar';


export default class MembersByProgram extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
            order : null
        };
    }

    componentDidMount() {
        this.query(1);
    }

    handleOrderChange(order) {

      const {filters} = this.state;

      console.log("TypologySelectionFilters :: handleOrderChange => ",order);

      this.query(1,order);
    }

    query(page,order) {
        const field = this.state.field;
        var self = this;

        var orderQuery = '';
        if(order != null && order != ''){
          var orderArray = order.split(',');
          orderQuery = '&orderBy='+orderArray[0]+'&sortedBy='+orderArray[1];
        }

        axios.get(ASSETS+'externalapi/members?search=program_id:1'+orderQuery+'&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined
                  && response.data.data.length > 0)
              {
                  self.setState({
                      items : response.data.data,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      order : order
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }


    renderItems() {

      var result = [];

      const {items} = this.state;

      for(var key in items){
        console.log("MembersByProgram => ",items[key]);

        result.push(
          <li key={key} className="col-md-4 col-xs-6">
            <ListExternalItem
              field={items[key]}
              type='member'
            />
          </li>
        );
      }

      return result;
    }

    onPageChange(page) {

        const {order} = this.state;

        this.query(page,order);
    }

    render() {
        return (
            <div>

                <OrderBar
                  fieldName="name"
                  onSubmit={this.handleOrderChange.bind(this)}
                />


                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length == 0 &&
                    <p>{Lang.get('widgets.last_typology.empty')}</p>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                    <ul>{this.renderItems()}</ul>
                }

                {this.state.lastPage &&
                    <Paginator
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      onChange={this.onPageChange.bind(this)}
                    />
                }
            </div>
        );
    }
}


if (document.getElementById('members-by-program')) {
    var element = document.getElementById('members-by-program');
    var field = element.getAttribute('field');

    ReactDOM.render(<MembersByProgram
        field={field}
      />, element);
}
