import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';

import FirstEmptyRow from './RowTypes/FirstEmptyRow';
import Row from './RowTypes/Row';

class PageBuilder extends Component {

  constructor(props){
    super(props);

    this.state = {
        fields : [],
        errors : this.props.errors,

        layout : [

          /*
          {
            type : 'row',
            children : [
              {
                type : 'col',
                colClass : 'col-xs-6',
                children : [
                  {
                    type : 'item',
                    id : 1,
                    name : 'Titol',
                    icon : 'fa-font',
                    values : ''
                  },
                  {
                    type : 'row',
                    children : [
                      {
                        type : "col",
                        colClass : 'col-xs-6',
                      },
                      {
                        type : "col",
                        colClass : 'col-xs-6',
                      }
                    ]
                  },
                  {
                    type : 'item',
                    id : 1,
                    name : 'Titol',
                    icon : 'fa-font',
                    values : ''
                  }
                ]
              },
              {
                type : 'col',
                colClass : 'col-xs-6',
                children : [
                  {
                    type : 'item',
                    id : 1,
                    name : 'Titol',
                    icon : 'fa-font',
                    values : ''
                  },
                  {
                    type : 'item',
                    id : 1,
                    name : 'Titol',
                    icon : 'fa-font',
                    values : ''
                  },
                  {
                    type : 'item',
                    id : 1,
                    name : 'Titol',
                    icon : 'fa-font',
                    values : ''
                  }
                ]
              }
            ]
          },
          {
            type : 'row',
            children : [
              {
                type : 'col',
                colClass : 'col-xs-12'
              }
            ]
          }
          */
          {
            type : 'row',
            children : [
              {
                type : 'col',
                colClass : 'col-xs-12'
              }
            ]
          }
        ]
    };

    this.handleAddRow = this.handleAddRow.bind(this);
    this.handleDeleteRow = this.handleDeleteRow.bind(this);
    this.handleColTypeSelected = this.handleColTypeSelected.bind(this);

  }

  handleAddRow(e) {

    e.preventDefault();

    const {layout} = this.state;

    layout.push({
        type : 'row',
        children : [
          {
            type : 'col',
            colClass : 'col-xs-12'
          }
        ]
      }
    );

    this.setState({
      layout : layout
    });

  }

  handleColTypeSelected(index,cols){

    console.log("page builder : index : "+index+", cols : "+cols);

  }

  handleDeleteRow(index) {

    const {layout} = this.state;

    layout.splice(index,1);

    this.setState({
      layout : layout
    });

  }


  renderRows() {

    const {layout} = this.state;

    return (
        layout.map((item,index) =>
          <Row
            index={index}
            key={index}
            data={item}
            onDeleteRow={this.handleDeleteRow}
            colTypeSelect={this.handleColTypeSelected}
          />
        )
    );

  }

  render() {

    return (
      <div className="col-xs-9 page-content page-builder">
        <div className="field-group">
          <TextField
            field={{
              id:0,
              identifier:"text",
              values:{
                "ca" : "",
                "es" : "",
                "en" : ""
              },
              name:"Títol"
            }}
            translations={this.props.translations}
            key={1}
            onFieldChange={this.props.onFieldChange}
          />


          {this.renderRows()}



          <FirstEmptyRow
            onAddRow={this.handleAddRow}
          />


        </div>




      </div>
    );
  }

}
export default PageBuilder;
