import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import ImageField from './../Fields/ImageField';
import UrlField from './../Fields/UrlField';

export default class MenuBanner extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
            name : props.name,
            items : []
        };
    }

    componentDidMount() {
        this.query();
    }

    query() {

        var params = {
          fields : '["title","like","'+this.state.name+'"]'
        };

        var self = this;

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data
                  });
              }


          }).catch(function (error) {
             console.log(error);
          });
    }

    processText(fields,fieldName){
      return fields[fieldName].values != null && fields[fieldName].values[LOCALE] !== undefined ?
        fields[fieldName].values[LOCALE] : '' ;
    }

    render() {

        const item = this.state.items.length > 0 ? this.state.items[0] : null;

        if(item == null){
          return null;
        }

        const fields = item.fields;

        return (
            <UrlField
              field={fields['url']}
            >
              <div>
                <p className="image">
                  <ImageField
                    field={fields['imatge-fons']}
                  />
                </p>
                <div className="intro"
                  dangerouslySetInnerHTML={{__html: this.processText(fields,'contingut')}}>
                </div>
              </div>
            </UrlField>
        );
    }
}


if (document.getElementById('menu_banner')) {
    document.querySelectorAll('[id=menu_banner]').forEach( element =>
        ReactDOM.render(
          <MenuBanner
            name={element.getAttribute('name')}
          />,
          element
        )
    );
}
