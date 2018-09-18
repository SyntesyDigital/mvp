import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import NewsBlog from './../Typologies/NewsBlog';


export default class RelatedNews extends Component {

    constructor(props)
    {
        super(props);

        const tags = props.tags ? JSON.parse(props.tags) : '';
        const category = props.category ? props.category : '';
        const content = props.content ? props.content : '';


        console.log("Related => ",tags);

        this.state = {
            category : category,
            items : null,
            tags : tags,
            content : content
        };
    }

    componentDidMount() {

        const {filters} = this.state;

        this.query(1,filters);
    }

    query(page,filters) {
        var self = this;

        const {tags} = this.state;

        var params = {
            size : 4,
            typology_id : 2,
            category_id : category,
            accept_lang : LOCALE,
            orderBy : 'data',
            sortedBy : 'desc',
            tags:tags
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


    render() {
      var result = [];
      const {items} = this.state;
      const {content} = this.state;

      var classEntrevista = '';
      var count = 0;
      for(var key in items){
        // CONTROLAR QEU AQUI NO SEA LA MISM NOTICIA QUE MOSTRAMOS
        console.log("TypologyPaginated => ", content);
        if(items[key].id != content && count < 3){
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
          count = count + 1;

        }

        
      }



      return (
            <div className="white">
              <div className="row">
                <div className="container">
                  <h2 className="subtitle-blog">{Lang.get('widgets.related_news')}</h2>
                  <ul className="list-blog">
                      {result}

                  </ul>
                </div>
              </div>
            </div>                   
      );
    }
}


if (document.getElementById('related-news')) {
    var element = document.getElementById('related-news');
    var tags = element.getAttribute('tags');
    var category = element.getAttribute('category');
    var content = element.getAttribute('content');

    ReactDOM.render(<RelatedNews
        tags={tags}
        category={category}
        content={content}
      />, element);
}
