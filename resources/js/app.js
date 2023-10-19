/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */


const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => app.component(key.split('/').pop().split('.')[0], files(key).default));


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


import { createApp } from 'vue';
import SideDialog from './components/SideDialog.vue';
import SignIn from './components/SignIn.vue';
import LogIn from './components/Login.vue';
import PlaceManual from './components/placeManual';
import DialogManual from './components/dialogManual';
import ActionManual from './components/actionManual';
import ARManual from './components/ARManual';
import VirtualManual from './components/virtualManual';
import FrontPage from './components/frontPage';
import OpenDialog from './components/openDialog';
import CloseDialog from './components/closeDialog';
const wrap = createApp({});
wrap.component('light-box',LogIn);
wrap.component('user-sign',SignIn);
wrap.component('place-manual', PlaceManual);
wrap.component('dialog-manual', DialogManual);
wrap.component('action-manual', ActionManual);
wrap.component('ar-manual', ARManual);
wrap.component('virtual-manual', VirtualManual);
wrap.component('front-page', FrontPage);
wrap.component('open-dialog', OpenDialog);
wrap.component('close-dialog', CloseDialog);
wrap.mount('#wrap');


const user = createApp({});
user.mount('#user');


import AddTopic from './components/AddTopic';
import DialogManage from './components/DialogManage';
import AddPlace from './components/AddPlace';
import Side from './components/Side';
const add = createApp({});
add.component('add-topic', AddTopic);
add.component('dialog-manage', DialogManage);
add.component('add-place', AddPlace);
add.component('side', Side);
add.component('side-dialog', SideDialog);
add.mount('#add');
