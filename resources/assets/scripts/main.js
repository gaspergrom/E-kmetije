// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import templatePovprasevanje from './routes/template-povprasevanje';

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
    templatePovprasevanje,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
