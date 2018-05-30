import React, {Component} from 'react';
import { render } from 'react-dom';

import ContentBar from './ContentBar';
import ContentSidebar from './ContentSidebar';
import ContentFields from './ContentFields';

import CustomFieldTypes from './../common/CustomFieldTypes';
import MediaSelectModal from './../Medias/MediaSelectModal';

import moment from 'moment';

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
            settings : {
              type : "thumb",
              name : "Thumbnail",
              width : 500,
              height : 500,
              ratio : "1:1"
            },
            values : {
              url : ""
            }
          },
          {
            id : 4,
            type : CustomFieldTypes.DATE.value,
            name : "Inici event",
            identifier : "data_1",
            values : moment()
          },
          {
            id : 5,
            type : CustomFieldTypes.IMAGES.value,
            name : "Galería",
            identifier : "images_1",
            settings : {
              type : "banner",
              name : "Banner",
              width : 1000,
              height : 500,
              ratio : "2:1"
            },
            values : [{
                url : ASSETS+"modules/architect/images/default.jpg"
              },
              {
                url : ASSETS+"modules/architect/images/default.jpg"
              }
            ]
          },
          {
            id : 6,
            type : CustomFieldTypes.LIST.value,
            name : "Tipus",
            identifier : "list_1",
            settings : {},
            values : [
              {name:"Tipus 1", value:"1",checked:false},
              {name:"Tipus 2", value:"2",checked:false},
              {name:"Tipus 3", value:"3",checked:true}
            ]
          },
          {
            id : 7,
            type : CustomFieldTypes.CONTENTS.value,
            name : "Events",
            identifier : "contents_1",
            settings : {},
            values : [
              {id:1,name:"Event 1",type:"event",label:"Event",icon:"fa-calendar"},
              {id:2,name:"Event 2",type:"event",label:"Event",icon:"fa-calendar"},
              {id:3,name:"Event 3",type:"event",label:"Event",icon:"fa-calendar"},
            ]
          }

        ]
      },

      //FIXME quiza esto va dentro del custom field
      displayMediaModal : false,
      sourceField : null
    };

    this.handleSubmitForm = this.handleSubmitForm.bind(this);
    this.handlePublish = this.handlePublish.bind(this);
    this.handleUnpublish = this.handleUnpublish.bind(this);
    this.handleFieldChange = this.handleFieldChange.bind(this);
    this.handleTagAdded = this.handleTagAdded.bind(this);
    this.handleRemoveTag = this.handleRemoveTag.bind(this);
    this.handleTranslationChange = this.handleTranslationChange.bind(this);
    this.handleCustomFieldChange = this.handleCustomFieldChange.bind(this);
    this.handleImageSelect = this.handleImageSelect.bind(this);
    this.handleImageSelected = this.handleImageSelected.bind(this);
    this.handleImageCancel = this.handleImageCancel.bind(this);
  }

  handleImageSelect(identifier) {

    this.setState({
      displayMediaModal : true,
      sourceField : identifier
    });

  }

  handleImageCancel(){
    this.setState({
      displayMediaModal : false,
      sourceField : null
    });
  }

  handleImageSelected(image){

    console.log("handleImageSelected :: images : ");

    this.updateImage(this.state.sourceField,image);

  }

  updateImage(identifier,image){

    const {typology} = this.state;

    for(var i=0;i<typology.fields.length;i++) {
      var item = typology.fields[i];
      if(item.identifier == identifier ){

        if(item.type == CustomFieldTypes.IMAGES.value){
          typology.fields[i].values.push(image);
          break;
        }
        else if(item.type == CustomFieldTypes.IMAGE.value){
          typology.fields[i].values = image;
          break;
        }
      }
    }

    this.setState({
      typology : typology,
      displayMediaModal : false,
      sourceField : null
    });

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
        typology.fields[i].values = field.values;
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

        <MediaSelectModal
          display={this.state.displayMediaModal}
          field={this.state.sourceField}
          onImageSelected={this.handleImageSelected}
        />

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
              onImageSelect={this.handleImageSelect}
            />


        </div>

      </div>
    );
  }

}
export default ContentContainer;
