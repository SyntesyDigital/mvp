import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import update from 'immutability-helper'

import ContentBar from './ContentBar';
import ContentSidebar from './ContentSidebar';
import ContentFields from './ContentFields';

class ContentContainer extends Component {

  constructor(props){
    super(props);

    this.state = {

    };

  }


  render() {
    return (
      <div>

        <ContentBar

        />

        <DragDropContextProvider backend={HTML5Backend}>

          <div className="container rightbar-page content">

              <ContentSidebar

              />

              <ContentFields

              />


          </div>

        </DragDropContextProvider>




      </div>
    );
  }

}
export default ContentContainer;
