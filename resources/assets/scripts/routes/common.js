import header from './partials/common/header'
import map from './partials/common/map'
import dataAcc from './partials/common/data-acc'

window.initMap = function () {
    map();
};

export default {
  init() {

    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
      header();
      dataAcc()
  },
};
