import React, {Component} from 'react';
import { render } from 'react-dom';

class TextField extends Component {

  constructor(props){
    super(props);

  }


  render() {
    return (
      <div className="field-item">

        <button id="headingOne" className="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span className="field-type">
            <i className="fa fa-font"></i> Text
          </span>
          <span className="field-name">
            Title
          </span>
        </button>

        <div id="collapseOne" className="collapse in" aria-labelledby="headingOne">

          <div className="field-form">

            <div className="form-group bmd-form-group">
               <label htmlFor="name" className="bmd-label-floating">Title - ca</label>
               <input type="text" className="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div className="form-group bmd-form-group">
               <label htmlFor="name" className="bmd-label-floating">Title - ca</label>
               <input type="text" className="form-control" id="name" name="name" value="" onChange="" />
            </div>
            <div className="form-group bmd-form-group">
               <label htmlFor="name" className="bmd-label-floating">Title - ca</label>
               <input type="text" className="form-control" id="name" name="name" value="" onChange="" />
            </div>


          </div>

        </div>

      </div>
    );
  }

}
export default TextField;
