import React, {Component} from 'react';
import { render } from 'react-dom';
import {connect} from 'react-redux';

import {
  copyItem,
  editItem,
  pullUpItem,
  pullDownItem,
  deletePageItem
} from './../actions/';

class PageItem extends Component {

  constructor(props){
    super(props);
  }

  onEditItem(e) {
    e.preventDefault();

    this.props.editItem(this.props);
  }

  onDeleteItem(e) {
    e.preventDefault();
    var self = this;

    bootbox.confirm({
				message: Lang.get('modals.delete_permanently_alert'),
				buttons: {
						confirm: {
								label: Lang.get('fields.si'),
								className: 'btn-primary'
						},
						cancel: {
								label: Lang.get('fields.no'),
								className: 'btn-default'
						}
				},
				callback: function (result) {
					if(result){
						self.props.deletePageItem(
              self.props.pathToIndex,
              self.props.app.layout
            );
					}
				}
		});

  }

  onPullDownItem(e) {
    e.preventDefault();

    this.props.pullDownItem(
      this.props.pathToIndex,
      this.props.app.layout
    );

  }

  onPullUpItem(e) {
    e.preventDefault();

    this.props.pullUpItem(
      this.props.pathToIndex,
      this.props.app.layout
    );

  }

  onCopyItem(e) {
    e.preventDefault();

    this.props.copyItem(
      this.props.pathToIndex,
      this.props.app.layout
    );
  }

  renderTextPreview() {
    var value = null;

    if(this.props.data.field.value !== undefined &&
      this.props.data.field.value[DEFAULT_LOCALE] !== undefined ){

      value = this.props.data.field.value[DEFAULT_LOCALE];
    }

    if(value != null) {
      return (
        <a href="" className="text-preview">
          <p>{value}</p>
        </a>
      );
    }
    else {
      return this.renderDefaultPreview();
    }
  }

  renderLinkPreview() {
    var value = null;

    //console.log("this.props.data.field.value => ",this.props.data.field.value);

    if(this.props.data.field.value !== undefined && this.props.data.field.value != null
      && this.props.data.field.value.title !== undefined && this.props.data.field.value.title != null
      && this.props.data.field.value.title[DEFAULT_LOCALE] !== undefined ){

      value = this.props.data.field.value.title[DEFAULT_LOCALE];
    }

    if(value != null) {
      return (
        <a href="" className="text-preview">
          <p>{value}</p>
        </a>
      );
    }
    else {
      return this.renderDefaultPreview();
    }
  }

  renderRichTextPreview() {
    var value = null;

    if(this.props.data.field.value !== undefined &&
      this.props.data.field.value[DEFAULT_LOCALE] !== undefined ){

      value = this.props.data.field.value[DEFAULT_LOCALE];
    }

    if(value != null) {
      return (
        <a href="" className="richtext-preview">
          <div dangerouslySetInnerHTML={{ __html: value }} />
        </a>


      );
    }
    else {
      return this.renderDefaultPreview();
    }
  }

  renderImagePreview() {

    var value = null;

    if(this.props.data.field.value !== undefined &&
      this.props.data.field.value != null ){

      ////console.log("renderImagePreview => ",this.props.data.field.value);
      var crop = 'original';

      if(this.props.data.field.settings.cropsAllowed != null){
        crop = this.props.data.field.settings.cropsAllowed;
      }

      value = this.props.data.field.value.urls[crop];
    }

    if(value != null) {
      return (
        <a href="" className="image-preview">
          <div className="background-image" style={{backgroundImage:"url(/"+ value +")"}}>
          </div>
        </a>

      );
    }
    else {
      return this.renderDefaultPreview();
    }

  }

  renderImageTextLinkPreview() {
    var value = null;

    //console.log("PageItem :: renderImageTextLinkPreview => ",this.props.data.field);

    if(this.props.data.field.fields[1] !== undefined &&
      this.props.data.field.fields[1].value !== undefined &&
      this.props.data.field.fields[1].value != null &&
      this.props.data.field.fields[1].value.title[DEFAULT_LOCALE] !== undefined ){

      value = this.props.data.field.fields[1].value.title[DEFAULT_LOCALE];
    }

    if(value != null) {
      return (
        <a href="" className="text-preview">
          <p>{value}</p>
        </a>
      );
    }
    else {
      return this.renderDefaultPreview();
    }
  }

  renderDefaultPreview() {
    return (
      <a href="" className="btn btn-link">
        <i className={"fa "+this.props.data.field.icon}></i>
        <p className="title">{this.props.data.field.name}</p>
      </a>
    );
  }

  renderPreview() {

    switch (this.props.data.field.type) {
      case FIELDS.TEXT.type:
        return this.renderTextPreview();
      case FIELDS.RICHTEXT.type:
        return this.renderRichTextPreview();
      case FIELDS.IMAGE.type:
        return this.renderImagePreview();
      case FIELDS.LINK.type:
        return this.renderLinkPreview();

      /*
      case WIDGETS.IMAGE_TEXT_LINK.type:
        return this.renderImageTextLinkPreview();
      */

      default :
        return this.renderDefaultPreview();
    }
  }

  render() {

    ////console.log("PageItem => ",this.props);
    const childrenIndex = this.props.pathToIndex[this.props.pathToIndex.length-1];
    const childrenLength = this.props.childrenLength;

    return (
      <div className="row page-row item-filled">

        <div className="item-header">

          {!architect.currentUserHasRole(ROLES['ROLE_EDITOR']) &&
            <div className="left-buttons">
              { childrenIndex > 0 &&
                <a href="" className="btn btn-link" onClick={this.onPullUpItem.bind(this)}>
                  <i className="fa fa-arrow-up"></i>
                </a>
              }
              {childrenIndex < childrenLength - 1 &&
                <a href="" className="btn btn-link" onClick={this.onPullDownItem.bind(this)}>
                  <i className="fa fa-arrow-down"></i>
                </a>
              }
            </div>
          }
          {!architect.currentUserHasRole(ROLES['ROLE_EDITOR']) &&
            <div className="right-buttons">
              <a href="" className="btn btn-link" onClick={this.onCopyItem.bind(this)}>
                <i className="fa fa-files-o"></i>
              </a>
              <a href="" className="btn btn-link text-danger" onClick={this.onDeleteItem.bind(this)}>
                <i className="fa fa-trash"></i>
              </a>
            </div>
          }
        </div>

        <div className="item-content" onClick={this.onEditItem.bind(this)}>
          {this.renderPreview()}
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
        copyItem: (pathToIndex,layout) => {
          return dispatch(copyItem(pathToIndex,layout))
        },
        editItem: (item) => {
          return dispatch(editItem(item))
        },
        pullUpItem: (pathToIndex,layout) => {
            return dispatch(pullUpItem(pathToIndex,layout))
        },
        pullDownItem: (pathToIndex,layout) => {
            return dispatch(pullDownItem(pathToIndex,layout))
        },
        deletePageItem: (pathToIndex,layout) => {
            return dispatch(deletePageItem(pathToIndex,layout))
        }

    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PageItem);
