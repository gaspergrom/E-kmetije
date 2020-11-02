import serialize from "../../../core/serialize";
import renderLocations from "./map/renderLocations";

export default () => {
    const filterform = $('#filterform');
    const filterInputs = filterform.find('input');

    filterInputs.change(() => {
        const filters = serialize(filterform);
        Object.keys(filters).forEach((name) => {
            if (typeof filters[name] === 'string') {
                filters[name] = [parseInt(filters[name])];
            } else {
                filters[name] = filters[name].map((f) => parseInt(f));
            }
        });
        const filterLocations = locations.filter((l) => {
            let dostava = true;
            if(filters.dostava){
                dostava = l.dostava.filter((d) => {
                    return filters.dostava.includes(d.ID);
                }).length > 0;
                if(filters.dostava[0] === 0){
                    dostava = true;
                }
            }
            let vrsta = true;
            if(filters.vrste){
                vrsta = l.vrste.filter((v) => {
                    return filters.vrste.includes(v.ID);
                }).length > 0;
            }
            return vrsta && dostava;
        });
        renderLocations(window.map, filterLocations, window.infowindow)
    })
}
