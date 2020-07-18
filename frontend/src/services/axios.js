// First we need to import axios.js
import axios from 'axios';
// Next we make an 'instance' of it
const instance = axios.create({
// .. where we make our configurations
    baseURL: 'http://localhost:8000/'
});

// Where you would set stuff like your 'Authorization' header, etc ...
//instance.defaults.headers['Authorization'] = 'Bearer ' + localStorage.getItem('token');
instance.defaults.headers.post['Content-Type'] = 'application/json';

// Also add/ configure interceptors && all the other cool stuff

instance.interceptors.request.use(request => {
    console.log(`request to server ${JSON.stringify(request)}`)
    // Edit request config
    return request;
}, error => {
    return Promise.reject(error);
});

instance.interceptors.response.use(response => {
    // Edit response config
    console.log(`response from server ${JSON.stringify(response)}`)
    return response;
}, error => {
    return Promise.reject(error.response.data);
});

export default instance;