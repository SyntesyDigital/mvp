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

  renderTextPreview() {
    var value = null;

    if(this.props.data.field.value !== undefined &&
      this.props.data.field.value.ca !== undefined ){

      value = this.props.data.field.value.ca;
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
      this.props.data.field.value.ca !== undefined ){

      value = this.props.data.field.value.ca;
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

      //console.log("renderImagePreview => ",this.props.data.field.value);

      value = this.props.data.field.value.urls.thumbnail;
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

      default :
        return this.renderDefaultPreview();
    }
  }

  render() {

    console.log("PageItem => ",this.props);

    return (
      <div className="row page-row item-filled" onClick={this.onEditItem.bind(this)}>
          {this.renderPreview()}
      </div>
    );
  }

}
export default PageItem;
