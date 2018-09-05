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
        const init = props.init ? props.init : '1';
        const showTags = props.showTags ? props.showTags : '1';
        const showFilter = props.showFilter ? props.showFilter : '1';
        const categoryId = props.categoryId ? props.categoryId : null;
        const tagId = props.tagId ? props.tagId : null;
        const entrevistas = props.entrevistas ? props.entrevistas : null;

        var filters = {};
        if(categoryId != null){
          filters.category =categoryId;
        }

        if(tagId != null){
          filters.tag =tagId;
        }

        if(entrevistas != null){
          filters.entrevistas = entrevistas;
        }

        if(filters.category == null && filters.tag == null && filters.entrevistas == null){
          filters= null;
        }


        this.state = {
            field : field,
            init: init,
            showTags: showTags,
            items : null,
            currPage : null,
            loaded: false,
            textIdentifier : '',
            dateIdentifier : '',
            filters : filters,
            tags : null,
            showFilter:showFilter,
        };
    }

    componentDidMount() {

        const {filters} = this.state;
        const {init} = this.state;
        const {showTags} = this.state;

        if(init == '1'){
          this.query(1,filters);
        }
        if(showTags == '1'){
          this.queryTags();
        }
    }

    query(page,filters) {
        var self = this;

        var searchQuery = '';
        var datesQuery = '';
        var entrevistaQuery = '';

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

          if(filters.entrevistas != null && filters.entrevistas == '1' ){
            entrevistaQuery = '["es-entrevista","=",'+filters.entrevistas+']';
          }

          var query = searchQuery+(searchQuery != '' && datesQuery != '' ? ',':'')+datesQuery+((searchQuery != '' || datesQuery != '') && entrevistaQuery != '' ? ',':'')+entrevistaQuery;
          fieldsQuery = fieldsQuery.replace(':query',query);
        }

        console.log("Blog :: query : "+fieldsQuery);

        var params = {
            size : 9,
            typology_id : 2,
            category_id : filters!= null && filters.category != null?filters.category:null,
            tags : filters!= null && filters.tag != null?filters.tag:null,
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


        axios.get(ASSETS+'api/tags')
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
      var classEntrevista = '';
      for(var key in items){
       // console.log("TypologyPaginated => ",items[key]);

        if(null != items[key].fields["es-entrevista"].values && items[key].fields["es-entrevista"].values == '1'){
          classEntrevista = 'item_blog col-md-4 col-sm-4 col-xs-12 entrevista';
        }else{
          classEntrevista = 'item_blog col-md-4 col-sm-4 col-xs-12';
        }


        result.push(
          <li className={classEntrevista} key={key}>
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
      const tags = this.state.tags;
           // console.log(tags);

      for(var key in tags){
        result.push(
          <li key={key}>
              <a href={'/blog/tags/'+tags[key].slug}> {tags[key].name}</a>
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
        const {showFilter} = this.state;
        var filterBar = '';
        if(showFilter == '1'){
          filterBar = <FilterBarBlog 
                  onSubmit={this.handleFilterSubmit.bind(this)}
                />;
        }

        return (
            <div className="blog-home">

                
              {filterBar}

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
    var init = element.getAttribute('init');
    var showTags = element.getAttribute('showTags');
    var showFilter = element.getAttribute('showFilter');
    var categoryId = element.getAttribute('categoryId');
    var tagId = element.getAttribute('tagId');
    var entrevistas = element.getAttribute('entrevistas');

    ReactDOM.render(<Blog
        field={field}
        init={init} 
        showTags={showTags} 
        showFilter={showFilter} 
        categoryId={categoryId} 
        tagId={tagId} 
        entrevistas={entrevistas} 
      />, element);
}
