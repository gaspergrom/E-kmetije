// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/owl-carousel';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import templatePovprasevanje from './routes/template-povprasevanje';
import templatePovprasevanjeTuristicni from './routes/template-povprasevanje-turisticni';
import templateZemljevid from './routes/template-zemljevid';
import templateKontakt from './routes/template-kontakt';

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
    home,
    templatePovprasevanje,
    templatePovprasevanjeTuristicni,
    templateZemljevid,
    templateKontakt,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
