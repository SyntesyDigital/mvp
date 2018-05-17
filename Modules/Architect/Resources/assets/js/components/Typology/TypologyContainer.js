import React, {Component} from 'react';
import { render } from 'react-dom';

import TypologyFields from './TypologyFields';
import TypologySidebar from './TypologySidebar';

class TypologyContainer extends Component {

  render() {
    return (
      <div className="container rightbar-page">

        <TypologyFields />

        <TypologySidebar />
      </div>
    );
  }

}
export default TypologyContainer;
