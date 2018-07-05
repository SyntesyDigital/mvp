import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import ContentBar from './../ContentBar';
import ContentSidebar from './../ContentSidebar';
import ContentFields from './../ContentFields';
import CustomFieldTypes from './../../common/CustomFieldTypes';
import MediaSelectModal from './../../Medias/MediaSelectModal';
import ContentSelectModal from './../ContentSelectModal';
import PageBuilder from './PageBuilder';
import moment from 'moment';
import axios from 'axios';

class PageContainer extends Component {

  constructor(props) {
     super(props);

     // Set translations
     var translations = {};
     LANGUAGES.map(function(v,k){
         translations[v.iso] = true;
     });

     console.log('LAYOUT LOADED', props.page);

     // Build state...
     this.state = {
         status: 0,
         template: "",
         category: props.content && props.content.categories && props.content.categories.length > 0 ? props.content.categories[0].id : null,
         errors : {},
         tags : this.props.content.tags ? this.props.content.tags : [],  // Los tags del contenido que hay que guardar
         title : {
           id:0,
           identifier:"title",
           value:{},
           name:"Títol"
         },
         translations: translations,
         author: props.content ? props.content.author_id : CURRENT_USER.id,
         authors: props.authors,
         content: props.content,
         languages: props.languages,
         layout : props.page ? props.page : null,
         //fields: props.typology.fields,
         created_at: props.content ? moment(props.content.created_at).format('DD/MM/YYYY') : null,

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
     this.handleUpdateLayout = this.handleUpdateLayout.bind(this);
 }


    handleUpdateLayout(layout) {

        console.log("PageContainer :: handleUpdateLayout!");

        this.setState({
            layout : layout
        });
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
    this.updateImage(this.state.sourceField,image);
  }

  updateImage(identifier,image){

    const {typology} = this.state;

    for(var i=0;i<typology.fields.length;i++) {
      var item = typology.fields[i];
      if(item.identifier == identifier ){

        if(item.type == FIELDS.IMAGES.type){
          typology.fields[i].values.push(image);
          break;
        }
        else if(item.type == FIELDS.IMAGE.type){
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

      if(item.identifier == identifier){

        if(typology.fields[i].type == "link"){
            typology.fields[i].values.linkValues = content;
        }
        else {
            typology.fields[i].values.push(content);
        }


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

    if(this.state.content) {
        this.update();
    } else {
        this.create();
    }
  }

  getFormData()
  {
      return {
          content_id : this.state.content !== undefined ? this.state.content.id : null,
          status : this.state.status,
          is_page : true,
          page: this.state.layout,
          category : this.state.category,
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

                 setTimeout(function(){
                     window.location.href = routes.showContent.replace(':id',response.data.content.id);
                 },1500);
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
      toastr.success('ok page!');
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

     publishToogle()
     {
         var _this = this;

         axios.put('/architect/contents/' + this.state.content.id + '/publish', {
             status : _this.state.status
         })
             .then((response) => {
                 if(response.data.success) {
                     toastr.success('ok');
                 }
             })
             .catch((error) => {
                 toastr.error('Error !');
             });
     }

    handlePublish(e)
    {
        e.preventDefault();

        this.setState({
            status : 1
        });

        this.publishToogle();
    }

    handleUnpublish(e)
    {
        e.preventDefault();

        this.setState({
            status : 0
        });

        this.publishToogle();
    }

    handleFieldChange(field) {

        console.log("On text change : =>",field);

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
          icon={'fa-file-o'}
          name={'Pàgina'}
          onSubmitForm={this.handleSubmitForm}
        />

        <div className="container rightbar-page content">

            <ContentSidebar
                errors={this.state.errors}
                status={this.state.status}
                template={null}
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

            <DragDropContextProvider backend={HTML5Backend}>
            {/* {this.state.errors &&  */}
              <PageBuilder
                layout={this.state.layout}
                updateLayout={this.handleUpdateLayout}
                translations={this.state.translations}
                onFieldChange={this.handleFieldChange}
                title={this.state.title}
              />
            {/*  } */}
            </DragDropContextProvider>

        </div>

      </div>
    );
  }

}
export default PageContainer;
