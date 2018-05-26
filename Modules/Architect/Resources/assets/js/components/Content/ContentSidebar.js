import React, {Component} from 'react';
import { render } from 'react-dom';
import Select from 'react-select';

class ContentSidebar extends Component {

  constructor(props) {

    super(props);

    this.state = {
      fields : {}
    };

  }

  render() {
    return (
      <div className="sidebar">


        <div className="publish-form">
            <b>Estat</b> : <i className="fa fa-circle text-success"></i> Publicat <br/>

            <a className="btn btn-default"> Despublicar </a>

            <p className="field-help">Publicat el 14, Oct, 2018</p>
        </div>

        {/*
        <div className="publish-form sidebar-item">
            <b>Estat</b> : <i className="fa fa-circle text-warning"></i> Esborrany <br/>

            <a className="btn btn-success"> Publicar </a>

            <p className="field-help">Publicat el 14, Oct, 2018</p>
        </div>
        */}

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label htmlFor="template" className="bmd-label-floating">Plantilla</label>
           <select className="form-control" id="template" name="template" value=""  onChange={this.handleChange}>
              <option name="" value="1"> Plantilla 1 </option>
              <option name="" value="2"> Plantilla 2 </option>
              <option name="" value="3"> Plantilla 3 </option>
           </select>
        </div>

        <hr/>

        <div className="form-group bmd-form-group">
           <label htmlFor="template" className="bmd-label-floating">Categoria</label>
           <select className="form-control" id="template" name="template" value=""  onChange={this.handleChange}>
              <option name="" value="1"> Categoria 1 </option>
              <option name="" value="2"> Categoria 2 </option>
              <option name="" value="3"> Categoria 3 </option>
           </select>
        </div>

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label htmlFor="template" className="bmd-label-floating">Etiquetes</label>
           <input type="text" className="form-control" id="name" name="name" value="" onChange={this.handleChange} placeholder="Introduex etiquetes..." />
           {/* <a className="input-button"><i className="fa fa-plus"></i></a> */}

           <div className="tags">
             <span className="tag"> Tag 1 <a href="" className="remove-btn"> <i className="fa fa-times-circle"></i> </a> </span>
             <span className="tag"> Tag 2 <a href="" className="remove-btn"> <i className="fa fa-times-circle"></i> </a> </span>
             <span className="tag"> Tag 3 <a href="" className="remove-btn"> <i className="fa fa-times-circle"></i> </a> </span>
           </div>
        </div>

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label className="bmd-label-floating">Traduccions</label>

          <div className="togglebutton">
            <label>
                Català
                <input type="checkbox" name="ca" checked="true" onChange="" />
            </label>
          </div>
          <div className="togglebutton">
            <label>
                Español
                <input type="checkbox" name="ca" checked="true" onChange="" />
            </label>
          </div>
          <div className="togglebutton">
            <label>
                English
                <input type="checkbox" name="ca" checked="true" onChange="" />
            </label>
          </div>

        </div>

        <hr/>

        <div className="form-group bmd-form-group sidebar-item">
           <label htmlFor="author" className="bmd-label-floating">Autor</label>
           <select className="form-control" id="author" name="author" value=""  onChange={this.handleChange}>
              <option name="" value="1"> Autor 1 </option>
              <option name="" value="2"> Autor 2 </option>
              <option name="" value="3"> Autor 3 </option>
           </select>

           <p className="field-help">Creat el 14, Oct, 2018</p>

        </div>


      </div>
    );
  }

}
export default ContentSidebar;
