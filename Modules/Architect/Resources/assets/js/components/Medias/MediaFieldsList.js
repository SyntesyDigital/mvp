import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class MediaFieldsList extends Component {

    constructor(props)
    {
        super(props);

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {

      var field = null;

      console.log(event.target.type);

      if(event.target.type == "text" || event.target.type == "textarea"){
        field = {
          name : event.target.name,
          value : event.target.value
        };
      }

      this.props.onHandleChange(field)
    }

    render() {
        return (

          <div>
            <div className="image-info row">
              <div className="col-xs-6">

                <ul>
                  <li>
                    <b>Nom arxiu</b> : title_image.jpg
                  </li>
                  <li>
                    <b>Data</b> : 14, Oct, 2017
                  </li>
                  <li>
                    <b>Autor</b> : Nom Autor
                  </li>
                </ul>
              </div>
              <div className="col-xs-6">
              <ul>
                <li>
                  <b>Tipus</b> : image/jpeg
                </li>
                <li>
                  <b>Pes original</b> : 335 Kb
                </li>
                <li>
                  <b>Mida original</b> : 1200 x 1800
                </li>

              </ul>
              </div>

            </div>
            <hr/>

            <div className="media-form">

              <div className="fields-group">
                <label>Llegenda</label>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Llegenda - català" name="titleCa" value={this.props.fields.titleCa} onChange={this.handleChange} />
                  </div>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Llegenda - español" name="titleEs" value={this.props.fields.titleEs} onChange={this.handleChange} />
                  </div>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Llegenda - english" name="titleEn" value={this.props.fields.titleEn} onChange={this.handleChange} />
                  </div>
              </div>

              <div className="fields-group">
                <label>Text alternatiu</label>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Text alternatiu - català" name="altCa" value={this.props.fields.altCa} onChange={this.handleChange} />
                  </div>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Text alternatiu - español" name="altEs" value={this.props.fields.altEs} onChange={this.handleChange} />
                  </div>
                  <div className="form-group bmd-form-group">
                     <input type="text" className="form-control" placeholder="Text alternatiu - english" name="altEn" value={this.props.fields.altEn} onChange={this.handleChange} />
                  </div>
              </div>

              <div className="fields-group">
                <label>Descripció</label>
                <div className="form-group bmd-form-group">
                   <textarea className="form-control" id="descriptionCa" placeholder="Descripció - català" rows="4" name="descriptionCa" onChange={this.handleChange} value={this.props.fields.descriptionCa}></textarea>
                </div>
                <div className="form-group bmd-form-group">
                   <textarea className="form-control" id="descriptionEs"  placeholder="Descripció - español" rows="4" name="descriptionEs" onChange={this.handleChange} value={this.props.fields.descriptionEs}></textarea>
                </div>
                <div className="form-group bmd-form-group">
                   <textarea className="form-control" id="descriptionEn"  placeholder="Descripció - english" rows="4" name="descriptionEn" onChange={this.handleChange} value={this.props.fields.descriptionEn}></textarea>
                </div>

              </div>

            </div>
          </div>
        );
    }
}

export default MediaFieldsList;
