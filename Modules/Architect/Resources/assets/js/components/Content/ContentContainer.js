import React, {Component} from 'react';
import { render } from 'react-dom';

import ContentBar from './ContentBar';
import ContentSidebar from './ContentSidebar';
import ContentFields from './ContentFields';

import CustomFieldTypes from './../common/CustomFieldTypes';

class ContentContainer extends Component {

  constructor(props){
    super(props);

    this.state = {
      status : 0,
      template : "",
      category : "",
      tags : [
        {id:1,name:"Tag 1"},
        {id:2,name:"Tag 2"},
        {id:3,name:"Tag 3"}
      ],
      translations : {
        ca : true,
        es : true,
        en : true
      },
      author : "",
      created_at : "14, Oct 2018",
      typology : {
        icon : 'fa-file-o',
        name : "Content",
        fields : [
          {
            id : 1,
            type : CustomFieldTypes.TEXT.value,
            name : "Title",
            identifier : "text_1",
            values : {
              "ca" : "Hola",
              "es" : "Hola",
              "en" : "Hola"
            }
          },
          {
            id : 2,
            type : CustomFieldTypes.RICH.value,
            name : "Description",
            identifier : "rich_1",
            values : {
              "ca" : "Hola",
              "es" : "Hola",
              "en" : "Hola"
            }
          },
          {
            id : 3,
            type : CustomFieldTypes.IMAGE.value,
            name : "Imatge",
            identifier : "image_1",
            values : {
              "ca" : "",
              "es" : "",
              "en" : ""
            }
          }

        ]
      }

    };

    this.handleSubmitForm = this.handleSubmitForm.bind(this);
    this.handlePublish = this.handlePublish.bind(this);
    this.handleUnpublish = this.handleUnpublish.bind(this);
    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleTagAdded = this.handleTagAdded.bind(this);
    this.handleRemoveTag = this.handleRemoveTag.bind(this);
    this.handleTranslationChange = this.handleTranslationChange.bind(this);
    this.handleCustomFieldChange = this.handleCustomFieldChange.bind(this);

  }

  handleSubmitForm(e) {

    e.preventDefault();

    console.log("submit form!");
    console.log(this.state);

    //TODO hacer el ajax para guardar la información de la typologia

  }

  handlePublish(e) {

    e.preventDefault();

    this.setState({
      status : 1
    });

    console.log("publish!");
    console.log(this.state);

    //TODO

  }

  handleUnpublish(e) {

    e.preventDefault();

    this.setState({
      status : 0
    });

    console.log("unpublish!");
    console.log(this.state);

    //TODO

  }

  handleFieldChange(field) {

    const result = {};
    result[field.name] = field.value;

		this.setState(result);

	}

  handleTranslationChange(field) {

    const {translations} = this.state;
    translations[field.name] = field.value;

		this.setState({
      translations : translations
    });

	}

  handleTagAdded(tag) {

    const {tags} = this.state;

    var found = false;
    for(var i=0;i<tags.length;i++){
      if(tags[i].id == tag.id){
        found = true;
        break;
      }
    }

    if(!found){
      tags.push(tag);

      this.setState({
        tags : tags
      });
    }
    else {
        console.error("Tag already added");
    }
  }

  handleRemoveTag(tagId) {
    const {tags} = this.state;

    for(var i=0;i<tags.length;i++){
      if(tags[i].id == tagId){
        tags.splice(i,1);
        break;
      }
    }

    this.setState({
      tags : tags
    });
  }

  handleCustomFieldChange(field){

    console.log("ContentContainer :: handleCustomFieldChange :: ");
    console.log(field);

    const {typology} = this.state;

    for(var i=0;i<typology.fields.length;i++) {
      var item = typology.fields[i];
      if(item.identifier == field.identifier ){
        typology.fields[i].values[field.language] = field.value;
        break;
      }
    }

    this.setState({
      typology : typology
    });

  }

  render() {
    return (
      <div>

        <ContentBar
          icon={this.state.typology.icon}
          name={this.state.typology.name}
          onSubmitForm={this.handleSubmitForm}
        />

        <div className="container rightbar-page content">

            <ContentSidebar
              status={this.state.status}
              template={this.state.template}
              category={this.state.category}
              tags={this.state.tags}
              translations={this.state.translations}
              author={this.state.author}
              createdAt={this.state.created_at}

              onPublish={this.handlePublish}
              onUnpublish={this.handleUnpublish}
              onFieldChange={this.handleFieldChange}
              onTranslationChange={this.handleTranslationChange}
              onTagAdded={this.handleTagAdded}
              onRemoveTag={this.handleRemoveTag}
            />

            <ContentFields
              fields={this.state.typology.fields}
              translations={this.state.translations}
              onFieldChange={this.handleCustomFieldChange}
            />


        </div>

      </div>
    );
  }

}
export default ContentContainer;
