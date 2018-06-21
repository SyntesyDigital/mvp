import React, {Component} from 'react';
import { render } from 'react-dom';

import Col from './../ColTypes/Col';
import ColTypeOption from './../ColTypes/ColTypeOption';

class Row extends Component {

  constructor(props){
    super(props);

    console.log("Row : constructor ",props);

    this.state = {
      colsOpen : false
    };

    this.colTypes = [
      ['col-xs-12'],
      ['col-xs-6','col-xs-6'],
      ['col-xs-4','col-xs-8'],
      ['col-xs-8','col-xs-4'],
      ['col-xs-4','col-xs-4','col-xs-4'],
      ['col-xs-3','col-xs-3','col-xs-3','col-xs-3']
    ];

    this.deleteRow = this.deleteRow.bind(this);
    this.handleColTypeSelect = this.handleColTypeSelect.bind(this);
    this.toggleColumns = this.toggleColumns.bind(this);

  }

  componentWillReceiveProps(nextProps) {

    console.log("Row : componentWillRecieveProps ",nextProps);

    this.setState({
      colsOpen : false
    });

  }

  getPathToIndex(index) {
    const pathToIndex = this.props.pathToIndex.slice(0);
    pathToIndex.push(parseInt(index));
    return pathToIndex;
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
                index={parseInt(key)}
                data={item}
                onSelectItem={this.props.onSelectItem}
                onColsChanged={this.props.onColsChanged}
                onDeleteRow={this.props.onDeleteRow}
                pathToIndex={this.getPathToIndex(key)}
                onEditItem={this.props.onEditItem}
                onSelectItemBefore={this.props.onSelectItemBefore}
                onSelectItemAfter={this.props.onSelectItemAfter}
              />
            );
          }
      }
    }

    return children;
  }

  deleteRow(e) {

    e.preventDefault();

    console.log("this.props.pathToIndex => ",this.props.pathToIndex);

    this.props.onDeleteRow(this.props.pathToIndex);

  }

  toggleColumns(e) {
    e.preventDefault();

    this.setState({
      colsOpen : !this.state.colsOpen
    });
  }

  handleColTypeSelect(cols) {

    //this.props.colTypeSelect(this.props.index,cols);

    this.setColType(cols);
  }

  renderColTypes() {


    return (
      <div className={"col-types-container "+(this.state.colsOpen ? 'open' : '')}>
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

  setColType(cols) {

    const children = this.props.data.children;

    if(cols.length < children.length ){
      //join cols
      //TODO como mejora unir las filas para no perder hijos
    }

    var resultChildren = [];

    for(var i=0;i<cols.length;i++){
      resultChildren.push({
        type : 'col',
        colClass : cols[i],
        //children : children[i] !== undefined && children[i] != null ? children : []
        children : []
      });

    }

    //var pathToIndex = [];
    //pathToIndex.push(this.props.index);

    console.log("Row :: setColType : "+this.props.pathToIndex);

    this.props.onColsChanged(this.props.pathToIndex,resultChildren);

  }

  joinChildren() {

    var childrenData = [];

    for(var i=0; i < this.props.data.children.length;i++){
      var col = this.props.data.children[i];

    }



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
              <a href="" className="btn btn-link" onClick={this.toggleColumns}>
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
