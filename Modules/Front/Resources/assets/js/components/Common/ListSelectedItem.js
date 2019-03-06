import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import PublicationSelected from './../Typologies/PublicationSelected';
import StatisticsSelected from './../Typologies/StatisticsSelected';
import CartographySelected from './../Typologies/CartographySelected';
import LogosSelected from './../Typologies/LogosSelected';


class ListSelectedItem extends Component {

    constructor(props)
    {
        super(props);

    }

    renderItem() {

      switch(this.props.field.typology.identifier){
        case 'publication' :
          return (
            <PublicationSelected
              field={this.props.field}
              onRemove={this.props.onRemove}
              onItemChange={this.props.onItemChange}
            />
          )
        case 'estadistica' :
          return (
            <StatisticsSelected
              field={this.props.field}
              onRemove={this.props.onRemove}
              onItemChange={this.props.onItemChange}
            />
          )
        case 'cartografia' :
          return (
            <CartographySelected
              field={this.props.field}
              onRemove={this.props.onRemove}
              onItemChange={this.props.onItemChange}
            />
          )
        case 'logo' :
          return (
            <LogosSelected
              field={this.props.field}
              onRemove={this.props.onRemove}
              onItemChange={this.props.onItemChange}
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
