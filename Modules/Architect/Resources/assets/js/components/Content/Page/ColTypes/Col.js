import React, {Component} from 'react';
import { render } from 'react-dom';

import Row from './../RowTypes/Row';
import EmptyItem from './../EmptyItem';
import PageItem from './../PageItem';


class Col extends Component {

  constructor(props){
    super(props);

    console.log("Col :: props => ",props);

  }

  getPathToIndex(index) {
    const pathToIndex = this.props.pathToIndex.slice(0);
    pathToIndex.push(parseInt(index));
    return pathToIndex;
  }

  renderChildren() {

    var children = [];

    if(this.props.data.children != null && this.props.data.children !== undefined &&
       this.props.data.children.length > 0){
      for(var key in this.props.data.children){
          var item = this.props.data.children[key];
          if(item.type == "row"){
            children.push(
              <Row
                key={key}
                index={parseInt(key)}
                onSelectItem={this.props.onSelectItem}
                onColsChanged={this.props.onColsChanged}
                onDeleteRow={this.props.onDeleteRow}
                data={item}
                pathToIndex={this.getPathToIndex(key)}
                onEditItem={this.props.onEditItem}
                onSelectItemBefore={this.props.onSelectItemBefore}
                onSelectItemAfter={this.props.onSelectItemAfter}
              />
            );
          }
          else if(item.type == "item"){
            children.push(
              <PageItem
                key={key}
                data={item}
                pathToIndex={this.getPathToIndex(key)}
                onEditItem={this.props.onEditItem}
              />
            );
          }
          else {
            <EmptyItem
              key={key}
              index={key}
              onSelectItem={this.props.onSelectItem}
              pathToIndex={this.props.pathToIndex}
            />
          }

      }
    }
    else {
      children.push(
        <EmptyItem
          key={0}
          index={0}
          onSelectItem={this.props.onSelectItem}
          pathToIndex={this.props.pathToIndex}
        />
      );
    }

    return children;
  }

  onSelectItemAfter(e) {
    e.preventDefault();
    this.props.onSelectItemAfter(this.props.pathToIndex);
  }

  onSelectItemBefore(e) {
    e.preventDefault();
    this.props.onSelectItemBefore(this.props.pathToIndex);
  }


  render() {

    return (

      <div className={this.props.colClass}>
        <div className="row-container-body-content">

          <div className="row-container-body-top">
            <a href="" className="btn btn-link" onClick={this.onSelectItemBefore.bind(this)}>
              <i className="fa fa-plus"></i>
            </a>
          </div>


            {this.renderChildren()}


          <div className="row-container-body-bottom">
            <a href="" className="btn btn-link" onClick={this.onSelectItemAfter.bind(this)}>
              <i className="fa fa-plus"></i>
            </a>
          </div>

        </div>
      </div>


    );
  }

}
export default Col;
