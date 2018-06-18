import React, {Component} from 'react';
import { render } from 'react-dom';

import Col from './../ColTypes/Col';
import ColTypeOption from './../ColTypes/ColTypeOption';

class Row extends Component {

  constructor(props){
    super(props);

    this.deleteRow = this.deleteRow.bind(this);

    this.colTypes = [
      ['col-xs-12'],
      ['col-xs-6','col-xs-6'],
      ['col-xs-4','col-xs-8'],
      ['col-xs-8','col-xs-4'],
      ['col-xs-4','col-xs-4','col-xs-4'],
      ['col-xs-3','col-xs-3','col-xs-3','col-xs-3']
    ];

    this.handleColTypeSelect = this.handleColTypeSelect.bind(this);

  }

  renderChildren() {

    var children = [];

    if(this.props.data.children != null){
      for(var key in this.props.data.children){
          var item = this.props.data.children[key];
          if(item.type == "col"){
            children.push(
              <Col
                key={key}
                colClass={item.colClass}
                data={item}
              />
            );
          }
      }
    }

    return children;
  }

  deleteRow(e) {

    e.preventDefault();

    this.props.onDeleteRow(this.props.index);

  }

  handleColTypeSelect(cols) {

    this.props.colTypeSelect(this.props.index,cols);

  }

  renderColTypes() {


    return (
      <div className="col-types-container">
        <ul>

          {this.colTypes.map((item,index) => (
            <li key={index}>
              <ColTypeOption
                cols={item}
                onSelected={this.handleColTypeSelect}
              />
            </li>
          ))
          }

        </ul>
      </div>
    );

  }


  render() {

    return (
      <div className="page-row filled">
        <div className="row-container">
          <div className="row-container-header">
            <div className="left-buttons">
              <a href="" className="btn btn-link">
                <i className="fa fa-arrow-up"></i>
              </a>
              <a href="" className="btn btn-link">
                <i className="fa fa-arrow-down"></i>
              </a>
              <a href="" className="btn btn-link">
                <i className="fa fa-columns"></i>
              </a>
            </div>
            <div className="right-buttons">
              <a href="" className="btn btn-link">
                <i className="fa fa-files-o"></i>
              </a>
              <a href="" className="btn btn-link text-danger" onClick={this.deleteRow}>
                <i className="fa fa-trash"></i>
              </a>
            </div>
          </div>

          {this.renderColTypes()}

          <div className="row-container-body">

            {this.props.data.children != null &&
              <div className="row">
                {this.renderChildren()}
              </div>
            }

          </div>
        </div>
      </div>
    );
  }

}
export default Row;
