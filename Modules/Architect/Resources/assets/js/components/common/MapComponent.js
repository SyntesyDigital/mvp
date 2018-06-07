import React, {Component} from 'react';
import { render } from 'react-dom';

import { Map, TileLayer } from 'react-leaflet';

const stamenTonerTiles = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const stamenTonerAttr = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
const mapCenter = [41.3850639, 2.1734];
const zoomLevel = 12;

class MapComponent extends Component
{
  constructor(props)
  {
    super(props);

  }

  componentDidMount() {
    const leafletMap = this.leafletMap.leafletElement;
    leafletMap.on('zoomend', () => {
        window.console.log('Current zoom level -> ', leafletMap.getZoom());
    });
  }


  render() {
    return (
      <div className="map-container">
          <Map
              ref={m => { this.leafletMap = m; }}
              center={mapCenter}
              zoom={zoomLevel}
          >
              <TileLayer
                  attribution={stamenTonerAttr}
                  url={stamenTonerTiles}
              />
          </Map>
      </div>
    );
  }

}
export default MapComponent;
