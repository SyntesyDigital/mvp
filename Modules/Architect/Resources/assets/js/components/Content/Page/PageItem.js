import React, {Component} from 'react';
import { render } from 'react-dom';

class PageItem extends Component {

  constructor(props){
    super(props);

  }

  onEditItem(e) {
    e.preventDefault();

    this.props.onEditItem(this.props);
  }

  render() {

    return (
      <div className="row page-row item-filled" onClick={this.onEditItem.bind(this)}>
          <a href="" className="btn btn-link">
            <i className={"fa "+this.props.data.field.icon}></i>
            <p className="title">{this.props.data.field.name}</p>
          </a>
      </div>
    );
  }

}
export default PageItem;
