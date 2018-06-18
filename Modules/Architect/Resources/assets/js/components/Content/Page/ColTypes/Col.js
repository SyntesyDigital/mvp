import React, {Component} from 'react';
import { render } from 'react-dom';

import Row from './../RowTypes/Row';
import EmptyItem from './../EmptyItem';
import PageItem from './../PageItem';


class Col extends Component {

  constructor(props){
    super(props);

  }

  renderChildren() {

    var children = [];

    if(this.props.data.children != null){
      for(var key in this.props.data.children){
          var item = this.props.data.children[key];
          if(item.type == "row"){
            children.push(
              <Row
                key={key}
                data={item}
              />
            );
          }
          else if(item.type == "item"){
            children.push(
              <PageItem
                key={key}
                data={item}
              />
            );
          }
      }
    }
    else {
      children.push(
        <EmptyItem
          key={0}
        />
      );
    }

    return children;
  }


  render() {

    return (

      <div className={this.props.colClass}>
        <div className="row-container-body-content">

          <div className="row-container-body-top">
            <a href="" className="btn btn-link">
              <i className="fa fa-plus"></i>
            </a>
          </div>


            {this.renderChildren()}


          <div className="row-container-body-bottom">
            <a href="" className="btn btn-link">
              <i className="fa fa-plus"></i>
            </a>
          </div>

        </div>
      </div>


    );
  }

}
export default Col;
