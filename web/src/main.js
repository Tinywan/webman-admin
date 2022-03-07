import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import 'element-plus/theme-chalk/display.css'
import scui from './scui'
import i18n from './locales'

// 引入路由 src/router/index.js
import router from './router'
import store from './store'

// 引入vue框架
import { createApp } from 'vue'

// 引入 App.vue 根组件
import App from './App.vue'

// 通过用 createApp 函数创建一个新的应用实例。该应用实例是用来在应用中注册“全局”组件的
const app = createApp(App);

// 安装 Vue.js 插件。如果插件是一个对象，它必须暴露一个 install 方法。如果它本身是一个函数，它将被视为安装方法。
app.use(store);

// 注册路由
app.use(router);
app.use(ElementPlus, {size: 'small'});
app.use(i18n);
app.use(scui);

// Vue 应用挂载到 <div id="app"></div>
app.mount('#app');
