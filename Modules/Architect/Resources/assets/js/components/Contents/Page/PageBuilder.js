import React, {Component} from 'react';
import { render } from 'react-dom';
import {connect} from 'react-redux';

import {
  initPageState
} from './../actions/';

import TextField from './../ContentFields/TextField';
import SlugField from './../ContentFields/SlugField';
import RichTextField from './../ContentFields/RichTextField';


class PageBuilder extends Component {

  constructor(props){
    super(props);

  }

  render() {

    //console.log("PageBuilder :: editItemData => ",this.state.editItemData);

    return (
      <div className="col-xs-9 page-content page-builder">
        <div className="field-group">
          <TextField
            field={this.props.app.title}
          />

          <SlugField
            field={this.props.app.slug}
            sourceField={this.props.title}
            blocked={this.props.app.saved}
          />

          <RichTextField
            field={this.props.app.description}
          />
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
        /*
        initPageState: (content) => {
            return dispatch(initPageState(content));
        }
        */
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PageBuilder);
