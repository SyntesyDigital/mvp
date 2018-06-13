import React, {Component} from 'react';
import { render } from 'react-dom';
import Select from 'react-select';

import TagManager from "./Tags/TagManager";

class ContentSidebar extends Component {

  constructor(props) {

    super(props);
        
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


  render() {      
  
    return (
      <div className="sidebar">
        {this.props.status == 1 &&
          <div className="publish-form sidebar-item">
              <b>Estat</b> : <i className="fa fa-circle text-success"></i> Publicat <br/>

              <a className="btn btn-default" href="" onClick={this.props.onUnpublish}> Despublicar </a>

              <p className="field-help">Publicat el 14, Oct, 2018</p>
          </div>
        }

        {this.props.status == 0 &&
          <div className="publish-form sidebar-item">
              <b>Estat</b> : <i className="fa fa-circle text-warning"></i> Esborrany <br/>

              <a className="btn btn-success" href=""  onClick={this.props.onPublish}> Publicar </a>

              <p className="field-help">Publicat el 14, Oct, 2018</p>
          </div>
        }

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label htmlFor="template" className="bmd-label-floating">Plantilla</label>
           <select className="form-control" id="template" name="template" value={this.props.template}  onChange={this.handleChange}>
              <option name="" value="1"> Plantilla 1 </option>
              <option name="" value="2"> Plantilla 2 </option>
              <option name="" value="3"> Plantilla 3 </option>
           </select>
        </div>

        <hr/>

        <div className="form-group bmd-form-group has-danger">
           <label htmlFor="template" className="bmd-label-floating">Categoria</label>
           <select className="form-control" id="template" name="category" value="" value={this.props.category} onChange={this.handleChange}>
              <option name="" value="1"> Categoria 1 </option>
              <option name="" value="2"> Categoria 2 </option>
              <option name="" value="3"> Categoria 3 </option>
           </select>
        </div>

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
          <TagManager
            tags={this.props.tags}
            onTagAdded={this.props.onTagAdded}
            onRemoveTag={this.props.onRemoveTag}
          />
        </div>

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label className="bmd-label-floating">Traduccions</label>

          <div className="togglebutton">
            <label>
                Català
                <input type="checkbox" name="ca" checked={this.props.translations.ca} onChange={this.handleTranslationChange} />
            </label>
          </div>
          <div className="togglebutton">
            <label>
                Español
                <input type="checkbox" name="es" checked={this.props.translations.es} onChange={this.handleTranslationChange} />
            </label>
          </div>
          <div className="togglebutton">
            <label>
                English
                <input type="checkbox" name="en" checked={this.props.translations.en} onChange={this.handleTranslationChange} />
            </label>
          </div>

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


      </div>
    );
  }

}
export default ContentSidebar;
