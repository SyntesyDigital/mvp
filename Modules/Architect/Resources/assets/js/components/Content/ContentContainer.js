import React, {Component} from 'react';
import { render } from 'react-dom';

import ContentBar from './ContentBar';
import ContentSidebar from './ContentSidebar';
import ContentFields from './ContentFields';

import CustomFieldTypes from './../common/CustomFieldTypes';
import MediaSelectModal from './../Medias/MediaSelectModal';
import ContentSelectModal from './ContentSelectModal';

import moment from 'moment';

import axios from 'axios';

class ContentContainer extends Component {

  constructor(props) {
     super(props);

     var typology = props.typology;

     if(props.typology == "event"){
       typology = {};
     }

     this.state = {
         status: 0,
         template: "",
         category: "",
         tags: [{
                 id: 1,
                 name: "Tag 1"
             },
             {
                 id: 2,
                 name: "Tag 2"
             },
             {
                 id: 3,
                 name: "Tag 3"
             }
         ],
         translations: {
             ca: true,
             es: true,
             en: true
         },
         author: "",
         authors: props.authors,
         created_at: "14, Oct 2018",
         typology: typology,

         //FIXME quiza esto va dentro del custom field?
         displayMediaModal: false,
         sourceField: null,

         displayContentModal: false,
         contentSourceField: null

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
     this.handleContentSelect = this.handleContentSelect.bind(this);
     this.handleContentSelected = this.handleContentSelected.bind(this);
     this.handleContentCancel = this.handleContentCancel.bind(this);
 }

  /******** Images  ********/

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

  /******** Contents  ********/

  handleContentSelect(identifier) {

    this.setState({
      displayContentModal : true,
      contentSourceField : identifier
    });

  }

  handleContentCancel(){
    this.setState({
      displayContentModal : false,
      contentSourceField : null
    });
  }

  handleContentSelected(content){

    this.updateContent(this.state.contentSourceField,content);
  }

  updateContent(identifier,content){

    const {typology} = this.state;

    for(var i=0;i<typology.fields.length;i++) {
      var item = typology.fields[i];
      if(item.identifier == identifier ){
        typology.fields[i].values.push(content);
        break;
      }
    }

    this.setState({
      typology : typology,
      displayContentModal : false,
      contentSourceField : null
    });

  }

  /********  Form ********/


  handleSubmitForm(e) {

    e.preventDefault();

    // console.log("submit form!");
    // console.log(this.state);

    if(this.state.content) {
        this.update();
    } else {
        this.create();
    }

    //TODO hacer el ajax para guardar la información de la typologia

  }

  getFormData()
  {
      return {
          status : this.state.status,
          category : this.state.category,
          tags : this.state.tags,
          fields : this.state.typology.fields,
          author_id : this.state.author,
          typology_id : this.state.typology.id
      };
  }

  create()
  {
      var _this = this;
      axios.post('/architect/contents', this.getFormData())
     .then((response) => {
         if(response.data.success) {
             _this.onSaveSuccess(response.data);
         }
     })
     .catch((error) => {
         if (error.response) {
             _this.onSaveError(error.response.data);
         } else if (error.message) {
             toastr.error(error.message);
         } else {
             console.log('Error', error.message);
         }
         //console.log(error.config);
     });
  }

  update()
  {
      var _this = this;
      axios.put('/architect/contents/' + this.state.content.id + '/update', this.getFormData())
          .then((response) => {
              if(response.data.success) {
                  _this.onSaveSuccess(response.data);
              }
          })
          .catch((error) => {
              if (error.response) {
                  _this.onSaveError(error.response.data);
              } else if (error.message) {
                  toastr.error(error.message);
              } else {
                  console.log('Error', error.message);
              }
              //console.log(error.config);
          });
  }

  onSaveSuccess(response)
  {
      toastr.success('ok');
  }

 onSaveError(response)
 {
     console.log('error...');
     // var errors = response.errors ? response.errors : null;
     // var _this = this;
     // var stateErrors = this.state.errors;
     //
     // if(errors) {
     //     Object.keys(stateErrors).map(function(k){
     //         stateErrors[k] = errors[k] ? true : false;
     //
     //         if(errors[k]) {
     //             toastr.error(errors[k]);
     //         }
     //     });
     //
     //     this.setState({
     //         errors : stateErrors
     //     });
     // }
     //
     // if(response.message) {
     //     toastr.error(response.message);
     // }
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
          onImageCancel={this.handleImageCancel}
        />

        <ContentSelectModal
          display={this.state.displayContentModal}
          field={this.state.contentSourceField}
          onContentSelected={this.handleContentSelected}
          onContentCancel={this.handleContentCancel}
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
              authors={this.state.authors}
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
              onContentSelect={this.handleContentSelect}
            />


        </div>

      </div>
    );
  }

}
export default ContentContainer;
