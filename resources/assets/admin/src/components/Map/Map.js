import React, {Component} from "react"
import ReactGoogleMapLoader from "react-google-maps-loader"
import ReactGoogleMap from "react-google-map"
import PropTypes from "prop-types";


class Map extends Component {

  render() {
    const {longitude, latitude, height, onClick, zoom} = this.props;
    const pos = {
      lat: latitude,
      lng: longitude,
    };
    return (
      <ReactGoogleMapLoader
        params={{
          key: "<<REPLACE>>",
        }}

        render={googleMaps => {
          return (
            googleMaps && (
              <div style={{height}}>
              <ReactGoogleMap
                googleMaps={googleMaps}
                coordinates={[
                  {
                    position: pos,
                  },
                ]}
                center={pos}
                zoom={zoom}
                onLoaded={(googleMaps, map) => {
                  googleMaps.event.addListener(map, "click", (e) => {
                    if( onClick ){
                      onClick(e.latLng.lat(), e.latLng.lng());
                    }
                  })
                }}
              />
              </div>
            )
          )
        }}
      />
    );
  }
}

Map.propTypes = {
  longitude: PropTypes.number,
  latitude: PropTypes.number,
  height: PropTypes.string,
  zoom: PropTypes.number,
  onClick: PropTypes.func,
};

Map.defaultProps = {
  longitude: 0,
  latitude: 0,
  height: "100px",
  zoom: 13,
  onClick: () => {
  },
};

export default Map;
