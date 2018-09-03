import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import PublicationSummary from './../Typologies/PublicationSummary';
import StatisticsSummary from './../Typologies/StatisticsSummary';
import CartographySummary from './../Typologies/CartographySummary';
import LogosSummary from './../Typologies/LogosSummary';


class ListSelectedSummary extends Component {

    constructor(props)
    {
        super(props);

    }

    renderItem() {

      switch(this.props.field.typology.identifier){
        case 'publication' :
          return (
            <PublicationSummary
              field={this.props.field}
            />
          )
        case 'estadistica' :
          return (
            <StatisticsSummary
              field={this.props.field}
            />
          )
        case 'cartografia' :
          return (
            <CartographySummary
              field={this.props.field}
            />
          )
        case 'logo' :
          return (
            <LogosSummary
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

export default ListSelectedSummary;
