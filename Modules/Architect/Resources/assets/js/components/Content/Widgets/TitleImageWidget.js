import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';
import RichTextField from './../ContentFields/RichTextField';
import ImageField from './../ContentFields/ImageField';
import UrlField from './../ContentFields/UrlField';


/**

{
    title : {
      "ca" : "asdfasdfasdf",
      "es" : "sdfasdfsdf"
    },
    richtect : {
      "ca" : "sfasdfasdf",
      "es" : "asfasdfasdf"
    }

}
*
*/
class TitleImageWidget extends Component
{
  constructor(props)
  {
    super(props);

    this.state = {
      title : {
        id : 0,
        identifier : "title",
        value : {},
        name : "Títol"
      },
      richtext : {
        id : 1,
        identifier : "richtext",
        value : {},
        name : "Descripció"
      },
      url : {
        id : 1,
        identifier : "url",
        value : {},
        name : "URL"
      },

    }

  }

  componentDidMount() {

    var titleValue = {};
    var richtextValue = {};
    var urlValue = {};

    console.log("TitleImageWIdget :: componentDidMount => ",this.props);

    if(this.props.field.value !== undefined && this.props.field.value != null){

      if(this.props.field.value.title !== undefined && this.props.field.value.title != null){
        titleValue = this.props.field.value.title;
      }

      if(this.props.field.value.richtext !== undefined && this.props.field.value.richtext != null){
        richtextValue = this.props.field.value.richtext;
      }

      if(this.props.field.value.url !== undefined && this.props.field.value.url != null){
        urlValue = this.props.field.value.url;
      }
    }

    const state = this.state;
    state["title"].value = titleValue;
    state["richtext"].value = richtextValue;
    state["url"].value = urlValue;


    console.log("TitleImageWidget state : ",state);

    this.setState(state);

  }

  componentWillReceiveProps(nextProps){

    var titleValue = {};
    var richtextValue = {};
    var urlValue = {};

    if(nextProps.field.value !== undefined && nextProps.field.value != null){

      if(nextProps.field.value.title !== undefined && nextProps.field.value.title != null){
        titleValue = nextProps.field.value.title;
      }

      if(nextProps.field.value.richtext !== undefined && nextProps.field.value.richtext != null){
        richtextValue = nextProps.field.value.richtext;
      }

      if(this.props.field.value.url !== undefined && this.props.field.value.url != null){
        urlValue = this.props.field.value.url;
      }
    }

    const state = this.state;
    state["title"].value = titleValue;
    state["richtext"].value = richtextValue;
    state["url"].value = urlValue;

    console.log("TitleImageWidget state : ",state);

    this.setState(state);

  }

  onFieldChange(field) {

    //console.log("onFieldChange => ",field);

    const value = this.props.field.value !== undefined && this.props.field.value != null ?
      this.props.field.value : {};

    value[field.identifier] = field.value;

    var field = {
      identifier : this.props.field.identifier,
      value : value
    };

    //propagate the state to its parent
    this.props.onFieldChange(field);
  }


  render() {

    const hideTab = this.props.hideTab !== undefined && this.props.hideTab == true ? true : false;

    return (
      <div className="widget-item">

        <TextField
          field={this.state.title}
          translations={this.props.translations}
          onFieldChange={this.onFieldChange.bind(this)}

        />

        <RichTextField
          field={this.state.richtext}
          translations={this.props.translations}
          onFieldChange={this.onFieldChange.bind(this)}

        />

        <UrlField
          field={this.state.url}
          translations={this.props.translations}
          onFieldChange={this.onFieldChange.bind(this)}
          //onContentSelect={this.props.onContentSelect}
        />

      </div>
    );
  }

}
export default TitleImageWidget;
