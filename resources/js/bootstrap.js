/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

// add the token to the header
axios.interceptors.request.use(function (config) {
    const token = localStorage.getItem('adminToken');
    console.log(token);
    config.headers.Authorization = token ? `Bearer ${token}` : '';
    return config;
});

axios.interceptors.response.use(
    response => response,
    error => {
        // if the token is expired, log the user out
        if (error.response.status === 401) {
            store.dispatch('auth/admin/logout');
        }
        return Promise.reject(error);
    }
);
