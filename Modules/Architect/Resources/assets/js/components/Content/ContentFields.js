import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './ContentFields/TextField';

class ContentFields extends Component {

  constructor(props){
    super(props);

    this.state = {

    };

  }


  render() {
    return (
      <div className="col-xs-9 page-content">

        <div className="field-group">

          <TextField
            
          />

        </div>

      </div>
    );
  }

}
export default ContentFields;
