import React, {Component} from 'react';
import { render } from 'react-dom';
import { DragDropContextProvider } from 'react-dnd';
import HTML5Backend from 'react-dnd-html5-backend';
import ContentBar from './../ContentBar';
import ContentSidebar from './../ContentSidebar';
import ContentFields from './../ContentFields';
import CustomFieldTypes from './../../common/CustomFieldTypes';

import PageBuilder from './PageBuilder';
import moment from 'moment';
import axios from 'axios';

import LayoutSelectModal from './LayoutSelectModal';

class PageContainer extends Component {

  constructor(props) {
     super(props);


     console.log('LAYOUT LOADED', props.page);
     console.log('CONTENT LOADED', props.content);

        var titleField = {
            id:0,
            identifier:"title",
            value:{},
            name:"Títol"
        };

        var slugField = {
          id:1,
          identifier:"slug",
          value:{},
          name:"Enllaç permanent"
        };

    // Build translations state from content languages fields
    var translations = {};
    LANGUAGES.map(function(language){
        if(props.content) {
            var exist = false;
           props.content.languages.map(function(contentLanguage){
               if(contentLanguage.iso == language.iso) {
                   exist = true;
               }
           });
           translations[language.iso] = exist;
        } else {
            translations[language.iso] = true;
        }
    });

    if(props.content) {
        // Builds fields values
        LANGUAGES.map(function(language,k){
            props.content.fields.map(function(field){
                if(field.name == "title") {
                    if(language.id == field.language_id) {
                        titleField.value[language.iso] = field.value;
                    }
                }

                if(field.name == "slug") {
                    if(language.id == field.language_id) {
                        slugField.value[language.iso] = field.value;
                    }
                }
            });
        });
    }

     // Build state...
     this.state = {
         status: props.content ? props.content.status : 0,
         template: "",
         parent_id: props.content && props.content.parent_id != null ? props.content.parent_id : "",
         category: props.content && props.content.categories && props.content.categories.length > 0 ? props.content.categories[0].id : null,
         categories: props.categories,
         tags : this.props.content.tags ? this.props.content.tags : [],
         errors : {},
         tagsList : props.tags ? props.tags : [], // La lista de los tags
         title : titleField,
         slug : slugField,
         translations: translations,
         author: props.content ? props.content.author_id : CURRENT_USER.id,
         authors: props.authors,
         content: props.content,
         pages: props.pages ? props.pages : null,
         languages: props.languages,
         layout : props.page ? props.page : null,
         parent_id : this.props.content ? this.props.content.parent_id : null,
         //fields: props.typology.fields,
         created_at: props.content ? moment(props.content.created_at).format('DD/MM/YYYY') : null,

         displayLayoutModal: false,
     };


     this.handleSubmitForm = this.handleSubmitForm.bind(this);
     this.handlePublish = this.handlePublish.bind(this);
     this.handleUnpublish = this.handleUnpublish.bind(this);
     this.handleFieldChange = this.handleFieldChange.bind(this);
     this.handleTagAdded = this.handleTagAdded.bind(this);
     this.handleRemoveTag = this.handleRemoveTag.bind(this);
     this.handleTranslationChange = this.handleTranslationChange.bind(this);
     this.handleCustomFieldChange = this.handleCustomFieldChange.bind(this);
     this.handleUpdateLayout = this.handleUpdateLayout.bind(this);
     this.handleLayoutSave = this.handleLayoutSave.bind(this);
     this.handleLoadLayout = this.handleLoadLayout.bind(this);
     this.handleLayoutSelected = this.handleLayoutSelected.bind(this);
 }


     handleLayoutSelected(layout) {
         alert('layout !');
     }

    handleUpdateLayout(layout) {

        console.log("PageContainer :: handleUpdateLayout!");

        this.setState({
            layout : layout
        });
    }

    handleLoadLayout()
    {
        var _this = this;
        bootbox.confirm({
			message: "Loading layout will erase current page builder, do you really want ?",
			buttons: {
				confirm: {
						label: 'Sí',
						className: 'btn-primary'
				},
				cancel: {
						label: 'No',
						className: 'btn-default'
				}
			},
			callback: function (result) {
                if(result) {
                    axios.get('/architect/page-layouts/1/show')
                        .then((response) => {
                            _this.setState({
                                layout : JSON.parse(response.data.definition)
                            });
                            toastr.success('Layout loaded !');
                        })
                        .catch((error) => {
                            toastr.error('Error !');
                        });
                }
			}
		});
    }

    handleLayoutSave()
    {
        axios.post('/architect/page-layouts', {
            name : 'My Layout',
            definition : this.state.layout
        })
        .then((response) => {
            toastr.success('Layout saved !');
        })
        .catch((error) => {
            toastr.error('Error !');
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
          fields : {
              title : this.state.title,
              slug : this.state.slug,
          },
          parent_id: this.state.parent_id,
          content_id : this.state.content !== undefined ? this.state.content.id : null,
          status : this.state.status,
          is_page : true,
          page: this.state.layout,
          category_id : this.state.category,
          tags : this.state.tags,
          //fields : this.state.fields,
          author_id : this.state.author,
          translations : this.state.translations
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

     publishToogle(newStatus)
     {
         var _this = this;

         axios.put('/architect/contents/' + this.state.content.id + '/publish', {
             status : newStatus
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

        const newStatus = 1;

        this.setState({
            status : newStatus
        });

        this.publishToogle(newStatus);
    }

    handleUnpublish(e)
    {
        e.preventDefault();

        const newStatus = 0;

        this.setState({
            status : newStatus
        });

        this.publishToogle(newStatus);
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

          <LayoutSelectModal
            display={true}
            onLayoutSelected={this.handleLayoutSelected}
            zIndex={10000}
          />

        <ContentBar
          content={this.state.content}
          icon={'fa-file-o'}
          name={'Pàgina'}
          onSubmitForm={this.handleSubmitForm}
          onLayoutSave={this.handleLayoutSave}
          onLoadLayout={this.handleLoadLayout}
        />

        <div className="container rightbar-page content">

            <ContentSidebar
                errors={this.state.errors}
                status={this.state.status}
                pages={this.state.pages}
                content={this.state.content}
                template={null}
                category={this.state.category}
                categories={this.state.categories}
                tags={this.state.tags}
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
                parent_id={this.state.parent_id}
            />

            <DragDropContextProvider backend={HTML5Backend}>
            {/* {this.state.errors &&  */}
              <PageBuilder
                layout={this.state.layout}
                updateLayout={this.handleUpdateLayout}
                translations={this.state.translations}
                onFieldChange={this.handleFieldChange}
                title={this.state.title}
                slug={this.state.slug}
                saved={this.props.saved}
              />
            {/*  } */}
            </DragDropContextProvider>

        </div>

      </div>
    );
  }

}
export default PageContainer;
