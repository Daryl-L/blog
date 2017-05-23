import ElementUI from 'element-ui'
import VueRouter from 'vue-router';
import 'element-ui/lib/theme-default/index.css'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter)
Vue.use(ElementUI)

Vue.component('example', require('./components/Example.vue'));

const routes = [
  { name: 'home', path: '/', component: require('./components/admin/Home.vue'), 
    children: [
      { name: 'newArticle', path: 'article/new', component: require('./components/admin/article/NewArticle.vue') },
      { name: 'articleList', path: 'article/list', component: require('./components/admin/article/ArticleList.vue') },
      { name: 'newCategory', path: 'category/list', component: require('./components/admin/category/NewCategory.vue') }
    ]
  }
]
const router = new VueRouter({
  routes
})

console.log(router)

const app = new Vue({
  router,
  el: '#app'
});
