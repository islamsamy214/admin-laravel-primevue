window._ = require('lodash');
try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {
    console.log(e);
}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

//noty
window.Noty = require("noty");