import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import {connect} from 'react-redux';

import ContentBar from './../Content/ContentBar';
import ContentSidebar from './../Content/ContentSidebar';
import PageBuilder from './PageBuilder';

import {
  initPageState
} from './../actions/';

/*
import PageBuilder from './PageBuilder';
import moment from 'moment';
import axios from 'axios';

import LayoutSelectModal from './LayoutSelectModal';
*/

class PageContainer extends Component {

  constructor(props) {
     super(props);

     this.props.initPageState(props.app.content);
   }

  render() {

    return (
      <div>

        <ContentBar
          /*
          onLayoutSave={this.handleLayoutSave}
          onLoadLayout={this.handleLoadLayout}
          */
        />

        <div className="container rightbar-page content">
          <ContentSidebar />

          <DragDropContextProvider backend={HTML5Backend}>

            <PageBuilder
              /*
              layout={this.state.layout}
              updateLayout={this.handleUpdateLayout}
              translations={this.state.translations}
              onFieldChange={this.handleFieldChange}
              title={this.state.title}
              slug={this.state.slug}
              description={this.state.description}
              saved={this.props.saved}
              errors={this.state.errors}
              */
            />

          </DragDropContextProvider>

        </div>

      </div>
    );
  }

}

const mapStateToProps = state => {
    return {
        app: state.app
    }
}

const mapDispatchToProps = dispatch => {
    return {
        initPageState: (content) => {
            return dispatch(initPageState(content));
        }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PageContainer);
