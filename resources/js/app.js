/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// app.js
// import jQuery from 'jquery';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';
//老版本使用webpack的话需要在scss文件里面导入，vite可直接在js文件中导入
import { createApp } from 'vue'
import SelectDistrict from './components/SelectDistrict.vue'
import UserAddressesCreateAndEdit from './components/UserAddressesCreateAndEdit.vue'
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';
// import jQuery from 'jquery';

// import jQuery from './node_modules/jquery/dist/jquery.min.js';
const app = createApp()

app.component('select-district', SelectDistrict)
app.component('user-addresses-create-and-edit', UserAddressesCreateAndEdit)

app.mount('#app')

window.Swal = Swal;

// window.$ = $;
// window.$ = jQuery;
// window.jQuery = jQuery;

// console.log(jQuery);
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
