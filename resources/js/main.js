import { createApp } from 'vue';
import App from './App.vue';
import SignIn from './components/SignIn.vue';
import { s3Layer } from 'vue3-layer';
import 'vue3-layer/dist/s3Layer.css';

const app = createApp(App);
app.component('s3-layer', s3Layer);
app.mount('#app');