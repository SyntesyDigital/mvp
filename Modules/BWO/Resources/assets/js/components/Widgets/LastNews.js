import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import NewsRelated from './../Typologies/NewsRelated';


export default class LastNews extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            items : null
        };
    }

    componentDidMount() {

        const {filters} = this.state;

        this.query(1,filters);
    }

    query(page,filters) {
        var self = this;

        const {category} = this.state;

        var params = {
            size : 2,
            typology_id : 1,
            accept_lang : LOCALE,
            order : 'date,asc',
            loads : 'category'
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
      const {items, content} = this.state;


      for(var key in items){
        // CONTROLAR QEU AQUI NO SEA LA MISM NOTICIA QUE MOSTRAMOS
        result.push(
            <div className="col-xs-12" key={key}>
              <NewsRelated
                field={items[key]}
              />
            </div>
        );

      }

      return (

          <div className="other-posts">
            {result}

          </div>
      );
    }
}


if (document.getElementById('last-news')) {

    document.querySelectorAll('[id=last-news]').forEach( element => {

        ReactDOM.render(<LastNews
          />, element);
    });
}
