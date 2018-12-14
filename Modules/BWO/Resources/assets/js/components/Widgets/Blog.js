import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Masonry from 'react-masonry-component';

import MoreResults from './../Common/MoreResults';
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
        const showFilter = props.showFilter ? props.showFilter : '1';
        const categoryId = props.categoryId ? props.categoryId : null;

        var filters = {};
        if(categoryId != null){
          filters.category =categoryId;
        }

        if(filters.category == null ){
          filters= null;
        }

        this.state = {
            field : field,
            init: init,
            items : null,
            currPage : null,
            loaded: false,
            filters : filters,
            showFilter:showFilter,
            size:field.settings !== undefined && field.settings.itemsPerPage !== undefined ?  field.settings.itemsPerPage : 6,
        };
    }

    componentDidMount() {

        const {filters} = this.state;
        const {init} = this.state;

        if(init == '1'){
          this.query(1,filters);
        }
    }

    query(page,filters) {
        var self = this;

        const {field} = this.state;

        var params = {
            size : this.state.size,
            typology_id : 1,
            category_id : filters!= null && filters.category != null?filters.category:null,
            page : page ? page : null,
            accept_lang : LOCALE,
            orderBy : 'date',
            sortedBy : 'desc',
            loads : 'category'
          };

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                var old_items = self.state.items;
                if(response.data.meta.current_page != 1){
                  old_items.push.apply(old_items, response.data.data);
                }else{
                  old_items =response.data.data;
                }
                  self.setState({
                      items : old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
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

        result.push(
          <div className="col-md-6 col-sm-6 col-xs-12" key={key}>
            <NewsBlog
              field={items[key]}
            />
          </div>
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

    onPageChange(page) {
        const {filters} = this.state;

        this.query(page,filters);
    }

    handleFilterSubmit(filters) {
      this.query(1,filters);
    }

    render() {

        return (
            <div className="posts-list">

                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length == 0 &&
                    <p>{window.localization['GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY']}</p>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                    this.renderItems()
                }

                {this.state.lastPage &&
                    <MoreResults
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      onChange={this.onPageChange.bind(this)}
                    />
                }

            </div>
        );
    }
}

if (document.getElementById('blog')) {

   document.querySelectorAll('[id=blog]').forEach(function(element){
       var field = element.getAttribute('field');
       var init = element.getAttribute('init');
       var categoryId = element.getAttribute('categoryId');

       ReactDOM.render(<Blog
           field={field}
           init={init}
           categoryId={categoryId}
         />, element);
   });
}
