// includo la libreria Vue.js
window.Vue = require('vue');

// importo il componente principale della nostra applicazione 'App.vue'
import App from './views/App.vue';

// renderizzo App all'avvio
const app = new Vue({
    el: '#app',
    render: h => h(App),
});
