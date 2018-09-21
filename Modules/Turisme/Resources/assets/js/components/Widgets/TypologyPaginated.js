import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import ListItem from './../Common/ListItem';


export default class TypologyPaginated extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
            field : props.field ? JSON.parse(atob(props.field)) : '',
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
        };
    }

    componentDidMount() {
        this.query(1);
    }

    query(page) {
        const field = this.state.field;
        var self = this;
        const size = 2;
        const category = field.settings.category;
        const maxItems = field.settings.maxItems?parseInt(field.settings.maxItems):null;
        var size_limited = size;
        const categoryQuery = category != null ? "&category_id="+category : '';
        console.log('LAST:',this.state.lastPage );
        console.log('CURR:',this.state.currPage );

        if(this.state.lastPage && this.state.lastPage == this.state.currPage+1 && maxItems){
          size_limited = maxItems - this.state.items.length;
        }

        axios.get(ASSETS+'api/contents?size='+size_limited+'&typology_id=' + field.settings.typology + categoryQuery + '&page=' + (page ? page : null))
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined
                  && response.data.data.length > 0)
              {
                  var old_items = self.state.items;
                  if(old_items !== null){
                    old_items.push.apply(old_items, response.data.data);
                  }else{
                    old_items =response.data.data;
                  }
                  self.setState({
                      items : old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }


    renderItems() {

      var result = [];

      const {items,field} = this.state;

      const extended = field.settings.extended != null ? field.settings.extended : false;

      for(var key in items){
        console.log("TypologyPaginated => ",items[key]);

        result.push(
          <li key={key}>
            <ListItem
              field={items[key]}
              extended={extended}
            />
          </li>
        );
      }

      return result;
    }

    onPageChange(page) {
        this.query(page);
    }

    render() {

        return (
            <div>
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
                    <MoreResults
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      maxItems={this.state.field.settings.maxItems}
                      currentItems={this.state.items.length}
                      onChange={this.onPageChange.bind(this)}
                    />
                }
            </div>
        );
    }
}

if (document.getElementById('typology-paginated')) {

    document.querySelectorAll('[id=typology-paginated]').forEach( element => {

      var field = element.getAttribute('field');

      ReactDOM.render(<TypologyPaginated
          field={field}
        />, element);
    });
}
