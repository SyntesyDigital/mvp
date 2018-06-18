import React, {Component} from 'react';
import { render } from 'react-dom';

class EmptyItem extends Component {

  constructor(props){
    super(props);

  }


  render() {

    return (
      <div className="row empty-item">
          <a href="" className="btn btn-link">
            <i className="fa fa-plus"></i>
          </a>
      </div>
    );
  }

}
export default EmptyItem;
