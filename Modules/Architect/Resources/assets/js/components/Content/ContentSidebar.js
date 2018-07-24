import React, {Component} from 'react';
import { render } from 'react-dom';
import Select from 'react-select';

import TagManager from "./Tags/TagManager";
import InputSettingsField from './../Typology/Settings/InputSettingsField';

import moment from 'moment';

class ContentSidebar extends Component {

  constructor(props) {

    super(props);

    console.log('PROPS ======>', props);

    this.handleChange = this.handleChange.bind(this);
    this.handleTranslationChange = this.handleTranslationChange.bind(this);
  }

  handleChange(event) {

    var field = null;

    if(event.target.type == "text" || event.target.type == "select-one"){
        field = {
            name : event.target.name,
            value : event.target.value
        };
    }
    else if(event.target.type == "checkbox"){
        field = {
            name : event.target.name,
            value : event.target.checked
        };
    }

    if(field != null) {
        this.props.onFieldChange(field);
    }

  }

  handleTranslationChange(event) {
    var field = {
      name : event.target.name,
      value : event.target.checked
    };

    this.props.onTranslationChange(field);
  }

  renderLanguagesCheckbox()
  {
    return (LANGUAGES.map((language, k) => (
        <div className="togglebutton" key={k}>
            <label>
              {language.name}
              <input type="checkbox" name={language.iso} checked={this.props.translations[language.iso]} onChange={this.handleTranslationChange} />
            </label>
        </div>
    )));
  }

  printSpace(level)
  {

    if(level <= 1)
      return null;

    var spaces = [];
    for(var i=1;i<level;i++){
      spaces.push(
        "- "
      );
    }

    return spaces;
  }

  handleFieldSettingsChange(field) {

      //console.log("ModalEditItem :: handleFieldSettingsChange => ", field);

      const stateField = this.state.field;

      stateField[field.source][field.name] = field.value;

      this.setState({
          field : stateField
      });
  }

  renderSettings()
  {
    return (
      <InputSettingsField
        field={this.props}
        name="htmlClass"
        source="settings"
        //onFieldChange={this.handleFieldSettingsChange.bind(this)}
        label="Html Class"
        inputLabel="Indica la clase CSS personalitzada"
      />
    )
  }

  render() {

    var self = this;

    console.log('CONTENTSIDEBAR PAGES =>', this.props.pages);

    return (
      <div className="sidebar">
        {this.props.status == 1 &&
          <div className="publish-form sidebar-item">
              <b>Estat</b> : <i className="fa fa-circle text-success"></i> Publicat <br/>
              <a className="btn btn-default" href="" onClick={this.props.onUnpublish}> Despublicar </a>
              <p className="field-help">{moment(this.props.content.published_at).format('LLLL')}</p>
          </div>
        }

        {this.props.status == 0 &&
          <div className="publish-form sidebar-item">
              <b>Estat</b> : <i className="fa fa-circle text-warning"></i> Esborrany <br/>
              <a className="btn btn-success" href=""  onClick={this.props.onPublish}> Publicar </a>
              <p className="field-help"></p>
          </div>
        }

        <hr/>

        {this.props.template != null &&
          <div>
            <div className="form-group bmd-form-group sidebar-item">
               <label htmlFor="template" className="bmd-label-floating">Plantilla</label>
               <select className="form-control" id="template" name="template" value={this.props.template}  onChange={this.handleChange}>
                  <option name="" value="1"> Plantilla 1 </option>
                  <option name="" value="2"> Plantilla 2 </option>
                  <option name="" value="3"> Plantilla 3 </option>
               </select>
            </div>
            <hr/>
          </div>
        }

        {this.props.pages !== undefined && this.props.pages != null &&
          <div>
            <div className="form-group bmd-form-group sidebar-item">
               <label htmlFor="parent_id" className="bmd-label-floating">Pàgina pare</label>
               <select className="form-control" id="parent_id" name="parent_id" value={this.props.parent_id}  onChange={this.handleChange}>
                    <option value="">---</option>
                   {
                     this.props.pages && this.props.pages.map(function(page, i) {
                         return <option value={page.id} key={i} selected={self.props.content && self.props.content.parent_id == page.id ? "selected" : ""}>{page.title}</option>
                     })
                   }
               </select>

            </div>
            <hr/>
          </div>
        }

        {this.props.enableCategories == 1 &&
          <div>
            <div className="form-group bmd-form-group has-danger">
               <label htmlFor="template" className="bmd-label-floating">Categoria</label>
               <select className="form-control" id="template" name="category" value="" value={this.props.category} onChange={this.handleChange}>
                    <option value="">---</option>
                   {
                     this.props.categories && this.props.categories.map(function(category, i) {
                       return <option value={category.id} key={i}>{self.printSpace(category.level)}{category.name}</option>
                     })
                   }
               </select>
            </div>
            <hr/>
          </div>
        }

        {this.props.enableTags  == 1 &&
          <div>
            <div className="form-group bmd-form-group sidebar-item">
              <TagManager
                tagsList={this.props.tagsList}
                content={this.props.content}
                onTagAdded={this.props.onTagAdded}
                onRemoveTag={this.props.onRemoveTag}
              />
            </div>

            <hr/>
          </div>
        }

        <div className="form-group bmd-form-group sidebar-item">
           <label className="bmd-label-floating">Traduccions</label>
           {this.renderLanguagesCheckbox()}
        </div>

        <hr/>

        <div className={'form-group bmd-form-group sidebar-item ' + ( this.props.errors['author_id'] ? 'has-error' : '')}>
           <label htmlFor="author" className="bmd-label-floating">Autor</label>
           <select className="form-control" id="author" name="author" value={this.props.author} onChange={this.handleChange} placeholder="---">
           <option value=""></option>
           {
             this.props.authors.map(function(author, i) {
               return <option value={author.id} key={i}>{author.firstname + ' ' + author.lastname}</option>
             })
           }
           </select>

           <p className="field-help">Creat el {this.props.createdAt}</p>

        </div>

        {this.props.settings !== undefined &&
          <div className="form-group bmd-form-group sidebar-item">
             <label className="bmd-label-floating">Configuració</label>
             {this.renderSettings()}
          </div>
        }


      </div>
    );
  }

}
export default ContentSidebar;
