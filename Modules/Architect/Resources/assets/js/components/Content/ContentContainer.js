import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';

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

     // Set translations
     var translations = {};
     LANGUAGES.map(function(v,k){
         translations[v.iso] = true;
     });

     // Build state
     this.state = {
         status: 0,
         template: "",
         category: props.content && props.content.categories && props.content.categories.length > 0 ? props.content.categories[0].id : null,
         errors : {},
         tags : this.props.content.tags ? this.props.content.tags : [],  // Los tags del contenido que hay que guardar
         tagsList : props.tags ? props.tags : [], // La lista de los tags
         translations: translations,
         author: props.content ? props.content.author_id : CURRENT_USER.id,
         authors: props.authors,
         content: props.content,
         typology: props.typology,
         categories: props.categories,
         languages: LANGUAGES,
         fields: props.fields ? props.fields : props.typology.fields,
         created_at: props.content ? moment(props.content.created_at).format('DD/MM/YYYY') : null,

         //modal states
         displayMediaModal: false,
         sourceField: null,

         displayContentModal: false,
         contentSourceField: null
     };
     
     console.log('CONTENT =>', props.content);
     console.log('LOADED FIELDS => ', this.state.fields);

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
      console.log('handleImageSelect => ', identifier);

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

  handleImageSelected(media){
      this.updateImage(this.state.sourceField,media);
  }

  updateImage(field,media){

      var fields = this.state.fields;

      switch (field.type) {
          case FIELDS.IMAGES.type:
              fields[field.identifier].value.push(media);
              break;

          case FIELDS.IMAGE.type:
              fields[field.identifier].value = media;
              break;
      }

    this.setState({
      fields : fields,
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
      this.updateContent(this.state.contentSourceField, content);
  }

  updateContent(identifier,content){

    var fields = this.state.fields;

    Object.keys(fields).map(function(k){
        if(fields[k].identifier == identifier){
            switch(fields[k].type) {
                case FIELDS.LINK.type:

                    if(fields[identifier].value == null){
                      fields[identifier].value = {};
                    }
                    else if(fields[identifier].value.url !== undefined){
                      delete fields[identifier].value['url'];
                    }
                    fields[identifier].value.content = content;
                    break;
                case FIELDS.CONTENTS.type:
                    if(fields[identifier].value == null) {
                        fields[identifier].value = [];
                    }
                    fields[identifier].value.push(content);
                    break;
            }
        }
    })


    this.setState({
        fields : fields,
        displayContentModal : false,
        contentSourceField : null
    });

  }

  /********  Form ********/


  handleSubmitForm(e) {
    e.preventDefault();
    
    this.state.content ? this.update() : this.create();
  }

  getFormData()
  {
      return {
          content_id : this.state.content !== undefined ? this.state.content.id : null,
          typology_id : this.state.typology.id,
          status : this.state.status,
          category_id : this.state.category,
          tags : this.state.tags,
          fields : this.state.fields,
          author_id : this.state.author
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
      if(response.content) {
          this.setState({
              content : response.content
          });
          toastr.success('ok');
      }
  }


 onSaveError(response)
 {
     var errors = response.errors ? response.errors : null;
     var _this = this;
     var stateErrors = this.state.errors;

     if(errors) {

         var fields = errors.fields ? errors.fields : null;

         if(fields) {
             fields.map(function(field){
                Object.keys(field).map(function(identifier){
                    stateErrors[identifier] = field[identifier];
                })
             });
         }

         if(errors['author_id'] !== undefined) {
            stateErrors['author_id'] = errors['author_id'][0] ? errors['author_id'][0] : null;
         }

         this.setState({
             errors : stateErrors
         });
     }



     if(response.message) {
         toastr.error(response.message);
     }
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
        
        console.log("handleFieldChange =====>", result);
        

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
      var fields = this.state.fields;
      fields[field.identifier].value = field.value;

      this.setState({
          fields : fields
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
                content={this.state.content}
                errors={this.state.errors}
                status={this.state.status}
                template={this.state.template}
                category={this.state.category}
                categories={this.state.categories}
                tagsList={this.state.tagsList}
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

            <DragDropContextProvider backend={HTML5Backend}>
            {this.state.errors &&
              <ContentFields
                errors={this.state.errors}
                fields={this.state.fields}
                translations={this.state.translations}
                onFieldChange={this.handleCustomFieldChange}
                onImageSelect={this.handleImageSelect}
                onContentSelect={this.handleContentSelect}
              />
            }
            </DragDropContextProvider>

        </div>

      </div>
    );
  }

}
export default ContentContainer;
