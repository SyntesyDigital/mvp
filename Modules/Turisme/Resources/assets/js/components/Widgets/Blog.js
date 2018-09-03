import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Masonry from 'react-masonry-component';

import Paginator from './../Common/Paginator';
import FilterBarBlog from './../Common/FilterBarBlog';
import NewsBlog from './../Typologies/NewsBlog';

const masonryOptions = {
    transitionDuration: 0
};
const imagesLoadedOptions = { background: '.my-bg-image-el' }

export default class Blog extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';


        console.log("Blog => ",field);

        this.state = {
            field : field,
            items : null,
            categoryId : null,
            currPage : null,
            loaded: false,
            textIdentifier : '',
            dateIdentifier : '',
            filters : null,
            tags : null
        };
    }

    componentDidMount() {

        const {filters} = this.state;

        this.query(1,filters);
       // this.queryTags();
    }

    query(page,filters) {
        var self = this;

        var searchQuery = '';
        var datesQuery = '';

        const {field} = this.state;

        if(filters != null){

          var fieldsQuery = '[:query]';

          if(filters.text != null){
            searchQuery = '["title","like","%'+filters.text+'%"]';
          }
          if(filters.startDate != null && filters.endDate != null) {
            datesQuery = '["data",">=","'+filters.startDate+'"]';
            datesQuery += ',["data","<=","'+filters.endDate+'"]';
          }

          var query = searchQuery+(searchQuery != '' && datesQuery != '' ? ',':'')+datesQuery;
          fieldsQuery = fieldsQuery.replace(':query',query);
        }

        //console.log("Blog :: query : "+fieldsQuery);

        var params = {
            size : 1,
            typology_id : 2,
            category_id : filters != null?filters.category:null,
            fields : fieldsQuery,
            page : page ? page : null,
            accept_lang : LOCALE,
            orderBy : 'data',
            sortedBy : 'desc'
        };

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }

    queryTags() {
        var self = this;

        var searchQuery = '';
        var datesQuery = '';

        const {field} = this.state;


        var params = {
            typology_id : 2,
            accept_lang : LOCALE /*,
            orderBy : 'name',
            sortedBy : 'asc'*/
        };

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      tags : response.data.data
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
        console.log("TypologyPaginated => ",items[key]);

        result.push(
          <li className="item_blog col-md-4 col-sm-4 col-xs-12  entrevista-or-not" key={key}>
            <NewsBlog
              field={items[key]}
            />
          </li>
        );
      }

      return (
            <Masonry
                className={'list-blog'} // default ''
                elementType={'ul'} // default 'div'
                options={masonryOptions} // default {}
                disableImagesLoaded={false} // default false
                updateOnEachImageLoad={false} // default false and works only if disableImagesLoaded is false
                imagesLoadedOptions={imagesLoadedOptions} // default {}
            >
                {result}
            </Masonry>
        );
    

    //  return result;
    }


     renderTags() {

      var result = [];
      const tags = this.state;

      for(var key in tags){
        result.push(
          <li key={key}>
              <a href={'/blog/tags/'+items[key].slug.values[LOCALE]}> {items[key].name.values[LOCALE]}</a>
          </li>
        );
      } 

      return result;
    }

    onPageChange(page) {
        const {filters} = this.state;

        this.query(page,filters);
    }

    handleFilterSubmit(filters) {
      this.query(1,filters);
    }

    render() {
        return (
            <div className="blog-home">

                <FilterBarBlog 
                  onSubmit={this.handleFilterSubmit.bind(this)}
                />


                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length == 0 &&
                    <p>{Lang.get('widgets.last_typology.empty')}</p>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                  <div className="white">
                    <div className="row">
                      <div className="container">
                          {this.renderItems()}
                      </div>
                    </div>
                  </div>
                }

                {this.state.lastPage &&
                    <Paginator
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      onChange={this.onPageChange.bind(this)}
                    />
                }
                
                {this.state.tags != null && this.state.tags.length > 0 &&
                  <ul className="tags_blog">
                    {this.renderTags()}
                  </ul>
                }

            </div>
        );
    }
}


if (document.getElementById('blog')) {
    var element = document.getElementById('blog');
    var field = element.getAttribute('field');

    ReactDOM.render(<Blog
        field={field}
      />, element);
}
