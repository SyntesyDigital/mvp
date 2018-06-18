import React, {Component} from 'react';
import { render } from 'react-dom';

class PageItem extends Component {

  constructor(props){
    super(props);

  }

  render() {

    return (
      <div className="row page-row item-filled">
          <a href="" className="btn btn-link">
            <i className={"fa "+this.props.data.icon}></i>
            <p className="title">{this.props.data.name}</p>
          </a>
      </div>
    );
  }

}
export default PageItem;
