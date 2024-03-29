export default (map, locations, infowindow) => {
    if(window.markers){
        window.markers.forEach((m) => {
            m.setMap(null);
        });
    }
    if(window.clusterer){
        window.clusterer.clearMarkers();
    }
    const markers = locations.map((location, i) => {
        if (location.lokacija) {
            const marker = new google.maps.Marker({
                position: {
                    lat: location.lokacija.lat,
                    lng: location.lokacija.lng
                },
                map: map,
                icon: 'https://e-kmetije.si/wp-content/uploads/pin.png'
            });
            marker.addListener("click", () => {
                infowindow.setContent(`
<div>
    <div style="max-width: 270px;">
        <h6>${location.title}</h6>
    </div>
    <p class="small" style="max-width: 200px">${location.vrste.map((d) => d.name).join(', ')}</p>
    ${location.kontakti ? location.kontakti.map((kontakt) => {
                    if (kontakt.vrsta === 'tel') {
                        return `<div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        <div style="height: 16px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                        </div>
                                    </span>
                                    <a href="tel:${kontakt.kontakt}" target="_blank" rel="noreferrer" class="link--reverse gtm-map-tel gtm-contact">
                                        ${kontakt.kontakt}
                                    </a>
                                </div>`;
                    }
                    else if (kontakt.vrsta === 'email') {
                        return `<div class="flex flex--middle mb8">
                                    <span class="text--green mr4">
                                        <div style="height: 16px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        </div>
                                    </span>
                                    <a href="mailto:${kontakt.kontakt}" target="_blank" rel="noreferrer" class="link--reverse gtm-map-email gtm-contact">
                                        ${kontakt.kontakt}
                                    </a>
                                </div>`;
                    }
                }).join('') : '' }
    <a href="${location.link}" class="flex flex--middle gtm-map-more">
        <p class="mb0 text-bold small">Poglej podrobnosti</p>
        <div style="height: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>
</div>
`);
                infowindow.open(map, marker);
            });
            return marker;
        }
    }).filter((m) => m);
    window.clusterer = new MarkerClusterer(map, markers, {
        imagePath:
            "https://e-kmetije.si/wp-content/uploads/m1.png?z='",
    });
    window.markers = markers;
}
