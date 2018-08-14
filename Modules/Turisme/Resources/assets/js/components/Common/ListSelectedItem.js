import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import News from './../Typologies/News';
import PublicationSelected from './../Typologies/PublicationSelected';
import Link from './../Typologies/Link';
import Note from './../Typologies/Note';

class ListSelectedItem extends Component {

    constructor(props)
    {
        super(props);

    }

    renderItem() {

      switch(this.props.field.typology.identifier){
        case 'news' :
          return (
              <News
                field={this.props.field}
              />
           );
       case 'notes' :
         return (
             <Note
               field={this.props.field}
             />
          );
        case 'publication' :
          return (
            <PublicationSelected
              field={this.props.field}
              onRemove={this.props.onRemove}
            />
          )
        case 'link' :
          return (
            <Link
              field={this.props.field}
            />
          )
        default :
          return null;
      }
    }

    render() {
        return (
            this.renderItem()
        );
    }
}

export default ListSelectedItem;
