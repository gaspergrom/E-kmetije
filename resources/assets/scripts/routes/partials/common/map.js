import style from './map/style';
export default () => {
    const mapElement = document.getElementById("map");
    if(mapElement){
        // The location of Uluru
        const uluru = { lat: -25.344, lng: 131.036 };
        // The map, centered at Uluru
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
        // The marker, positioned at Uluru
        const locations = [
            {
                lat: 46.119944,
                lng: 14.815333
            },
            {
                lat: 46.119,
                lng: 14.815333
            },
        ];

        const markers = locations.map((location, i) => {
            return new google.maps.Marker({
                position: location,
                map: map,
                icon: 'https://e-kmetije.si/wp-content/uploads/pin.png'
            });
        });
        new MarkerClusterer(map, markers, {
            imagePath:
                "https://e-kmetije.si/wp-content/uploads/m1.png?z='",
        });
    }

}
