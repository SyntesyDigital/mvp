import React, {Component} from 'react';
import { render } from 'react-dom';

class TypologySidebar extends Component {

  render() {
    return (
      <div className="sidebar">
        <div className="form-group bmd-form-group">
           <label htmlFor="name" className="bmd-label-floating">Nom</label>
           <input type="text" className="form-control" id="name" />
        </div>

        <div className="form-group bmd-form-group">
           <label htmlFor="icon" className="bmd-label-floating">Icone</label>
           <select className="form-control" id="icon">
              <option name="" value=""> Icon </option>
              <option name="" value=""> Icon </option>
              <option name="" value=""> Icon </option>
           </select>
        </div>

        <hr/>

        <div className="togglebutton">
          <label>
              Accessible via URL
              <input type="checkbox" />
          </label>
        </div>

        <div className="form-group bmd-form-group">
           <input type="text" className="form-control" id="slug-ca" placeholder="Slug - català"/>
        </div>
        <div className="form-group bmd-form-group">
           <input type="text" className="form-control" id="slug-es" placeholder="Slug - español"/>
        </div>
        <div className="form-group bmd-form-group">
           <input type="text" className="form-control" id="slug-en" placeholder="Slug - english"/>
        </div>


        <hr/>

        <div className="togglebutton">
          <label>
              Categories
              <input type="checkbox" />
          </label>
        </div>

        <div className="togglebutton">
          <label>
              Etiquetes
              <input type="checkbox" />
          </label>
        </div>

        <hr/>

        <h3>Afegeix camps</h3>

        <div className="field-list">
          <div className="field">
            <i className="fa fa-font"></i> &nbsp; Text
          </div>

          <div className="field">
            <i className="fa fa-align-left"></i> &nbsp; Text Enriquit
          </div>

          <div className="field">
            <i className="fa fa-picture-o"></i> &nbsp; Imatge
          </div>

          <div className="field">
            <i className="fa fa-calendar"></i> &nbsp; Data
          </div>

          <div className="field">
            <i className="fa fa-map-marker"></i> &nbsp; Localització
          </div>

          <div className="field">
            <i className="fa fa-th-large"></i> &nbsp; Imatges
          </div>

          <div className="field">
            <i className="fa fa-file-o"></i> &nbsp; Continguts
          </div>

          <div className="field">
            <i className="fa fa-th-list"></i> &nbsp; Llista
          </div>

          <div className="field">
            <i className="fa fa-link"></i> &nbsp; Enllaç
          </div>

          <div className="field">
            <i className="fa fa-video-camera"></i> &nbsp; Video
          </div>
        </div>

      </div>
    );
  }

}
export default TypologySidebar;
