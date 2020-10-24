// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import templatePovprasevanje from './routes/template-povprasevanje';
import singlePonudniki from './routes/single-ponudniki';

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
    home,
    templatePovprasevanje,
    singlePonudniki,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
