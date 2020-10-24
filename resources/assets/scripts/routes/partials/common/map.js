import style from './map/style';
import renderLocations from "./map/renderLocations";

export default () => {
    const mapElement = document.getElementById('map');
    if(mapElement){
        if (typeof locations !== 'undefined' && locations && locations.length) {
            const map = new google.maps.Map(mapElement, {
                zoom: 8.6,
                center: {
                    lat: 46.119944,
                    lng: 14.815333
                },
                styles: style,
                fullscreenControl: false,
                streetViewControl: false,
                mapTypeControl: false,
            });
            const infowindow = new google.maps.InfoWindow({
                content: "",
            });
            renderLocations(map, locations, infowindow);
            window.map = map;
            window.infowindow = infowindow;
        }
        else if(typeof loc !== 'undefined' && loc){
            const map = new google.maps.Map(mapElement, {
                zoom: 12,
                center: loc,
                styles: style,
                fullscreenControl: false,
                streetViewControl: false,
                mapTypeControl: false,
            });
            const marker = new google.maps.Marker({
                position: loc,
                map: map,
                icon: 'https://e-kmetije.si/wp-content/uploads/pin.png'
            });
            window.map = map;
        }
    }

}
