import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MoreResults from './../Common/MoreResults';

export default class ElementFile extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';
        const collapsable = props.collapsable ? props.collapsable : null;

        this.state = {
            field : field,
            collapsable : collapsable
        };
    }

    componentDidMount() {
      //this.query();
    }

    query(page,filters) {
        /*var self = this;

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
           });*/
    }

    renderItems() {

      return (
        <div className="row">
          <div className="col-md-6">
            <div className="element-file-input-container">
              <div className="col-xs-6 element-file-title">
                Référence courtier
              </div>
              <div className="col-xs-6 element-file-content">
                Référence courtier
              </div>
            </div>
          </div>
          <div className="col-md-6">
            <div className="element-file-input-container">
              <div className="col-xs-6 element-file-title">
                Référence courtier
              </div>
              <div className="col-xs-6 element-file-content">
                Référence courtier
              </div>
            </div>
          </div>
        </div>
      );

      /*for(var key in items){
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
        );*/


    //  return result;
    }

    render() {

        return (
          <div id="collapsetable" className="element-file-container-body collapse in">
            {this.renderItems()}
          </div>
        );
    }
}

if (document.getElementById('elementFile')) {

   document.querySelectorAll('[id=elementFile]').forEach(function(element){
       var field = element.getAttribute('field');
       var collapse = element.getAttribute('collapse');

       ReactDOM.render(<ElementFile
           field={field}
           collapse={collapse}
         />, element);
   });
}
