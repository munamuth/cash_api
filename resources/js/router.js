
import Vue from 'vue';
import Router from 'vue-router';


Vue.use(Router);

import home from './page/home.vue';
import cash from './page/cash.vue';
import tongtin from './page/tongtin.vue';
import loan from './page/loan.vue';
var app_name = "/myapp"
var router = new Router({
    mode : 'history',
    routes : [
        { path: app_name + '/', name : 'home', component: home, },
        { path: app_name + '/cash', name : 'cash', component: cash, },
        { path: app_name + '/tongtin', name : 'tongtin', component: tongtin, },
        { path: app_name + '/loan', name : 'loan', component: loan, },
      ],
});


export default router;