import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import News from './../Typologies/News';
import Publication from './../Typologies/Publication';

class ListItem extends Component {

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
        case 'publication' :
          return (
            <Publication
              field={this.props.field}
            />
          )
        default :
          return null;
      }
    }

    render() {

        return (
            <li>
              {this.renderItem()}
            </li>
        );
    }
}

export default ListItem;
