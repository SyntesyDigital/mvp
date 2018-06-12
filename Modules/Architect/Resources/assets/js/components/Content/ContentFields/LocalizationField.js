import React, {Component} from 'react';
import { render } from 'react-dom';

import CustomFieldTypes from './../../common/CustomFieldTypes';
import MapComponent from './../../common/MapComponent';

class LocalizationField extends Component
{
  constructor(props)
  {
    super(props);
    this.handleOnChange = this.handleOnChange.bind(this);
    this.handleLatLngChange = this.handleLatLngChange.bind(this);
  }

  componentDidMount(){

    if(this.props.field.values === undefined || this.props.field.values == null){
      //setup values if not yet defined
      var newField = {
          identifier: this.props.field.identifier,
          values: {
            lat : "",
            lng : ""
          }
      };

      this.props.onFieldChange(newField);

    }
  }

  handleOnChange(event)
  {
    const values = this.props.field.values ? this.props.field.values : {};
    values[event.target.name] = parseFloat(event.target.value);

    var field = {
      identifier : this.props.field.identifier,
      values : values
    };

    console.log(field);

    this.props.onFieldChange(field);
  }

  handleLatLngChange(latLng){

    var field = {
      identifier : this.props.field.identifier,
      values : {
        lat : latLng.lat,
        lng : latLng.lng,
      }
    };

    this.props.onFieldChange(field);
  }

  renderInputs()
  {

    const values = this.props.field.values !== undefined && this.props.field.values != null ? this.props.field.values : null;

    const lat = values != null && values.lat !== undefined ? values.lat : "";
    const lng = values != null && values.lng !== undefined ? values.lng : "";

    return (
      <div className="row">
        <div className="col-xs-6">
          <div className="form-group bmd-form-group">
             <label htmlFor={this.props.field.identifier+"_lat"} className="bmd-label-floating">Latitud</label>
             <div>{lat}</div>
             {/*
             <input type="text" className="form-control" name="lat" value={lat} onChange={this.handleOnChange} />
             */}
          </div>
        </div>
        <div className="col-xs-6">
          <div className="form-group bmd-form-group">
             <label htmlFor={this.props.field.identifier+"_lng"} className="bmd-label-floating">Longitud</label>
             <div>{lng}</div>
             {/*
             <input type="text" className="form-control" name="lng" value={lng} onChange={this.handleOnChange} />
             */}
          </div>
        </div>
      </div>
    );
  }


  render() {
    return (
      <div className="field-item">

        <button id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa " + CustomFieldTypes.MAP.icon}></i> {CustomFieldTypes.MAP.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>

          <div className="field-form">

            <MapComponent
              markerPosition={this.props.field.values}
              onLatLngChange={this.handleLatLngChange}
            />

            {this.renderInputs()}

          </div>

        </div>

      </div>
    );
  }

}
export default LocalizationField;
