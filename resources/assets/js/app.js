/**
 * First we will load other project's JavaScript dependencies which
 * include Lodash, jQuery and Bootstrap. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = require('lodash')
window.$ = window.jQuery = require('jquery')
require('bootstrap-sass')
require('bootstrap-datepicker')
require('select2')

/**
 * Now, we import Vue and libraries which uses it.
*/

import Vue from 'vue'
import Moment from './libs/moment'
import Mask from './libs/vue-the-mask'
import store from './store'
import router from './router'
import toasted from './libs/vue-toasted'
import {ServerTable, ClientTable, Event} from 'vue-tables-2';


import VueVisible from 'vue-visible';
Vue.use(VueVisible);

import VModal from 'vue-js-modal';
//Vue.use(VModal);

Vue.use(VModal, { dialog: true });


Vue.prototype.$verifyAccess = function (userAccess, field = null) {
  switch (userAccess) {
    case 0:
      return false
      break;
    case 1:
      if(field == 'biobase'){
        return true
      }else{
        return false
      }
      break;
    case 2:
      if(field == 'biobase'){
        return false
      }else{
        return true
      }
      break;
    case 3:
      if(field == 'demographic'){
        return false
      }else{
        return true
      }
      break;

    default:
      return true
      break;
  }
}


Vue.use(ClientTable);

/**
 * Add Mask to the project.
 * This custom library add jQuery Mask Plugin as a Vue directive.
 */

Vue.use(Mask)

/**
 * Add Moment to the project.
 * This custom library adds some date filters to Vue.
 */

Vue.use(Moment)

/**
 * Check whether there are values for store state saved from Back-end,
 * so we can map it together with the actual store state.
 */

if (window.__STATE__) {
  const state = {
    ...store.state,
    ...window.__STATE__
  }

  store.replaceState(state)
}

Vue.use(toasted)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('jv-search-box', require('./components/SearchBox.vue'))
Vue.component('jv-section', require('./components/Section.vue'))
Vue.component('jv-months', require('./components/Months.vue'))
Vue.component('jv-date', require('./components/Date.vue'))
Vue.component('jv-datepicker', require('./components/Datepicker.vue'))
Vue.component('jv-radio-group', require('./components/RadioGroup.vue'))
Vue.component('jv-check-group', require('./components/CheckGroup.vue'))
Vue.component('jv-select', require('./components/Select.vue'))
Vue.component('jv-yesno', require('./components/YesNo.vue'))
Vue.component('jv-laboratory-exam', require('./components/LaboratoryExam.vue'))
Vue.component('jv-assets-number', require('./components/AssetsNumber.vue'))
Vue.component('jv-ccs', require('./sections/CCS.vue'))
Vue.component('jv-rankin', require('./sections/Rankin.vue'))
Vue.component('jv-table', require('./components/Table.vue'))
Vue.component('jv-export', require('./components/Export.vue'))
Vue.component('jv-qrcode', require('./pages/QrCode.vue'))
Vue.component('jv-dashboard', require('./pages/Dashboard.vue'))
Vue.component('clip-loader', require('vue-spinner/src/ClipLoader.vue'));

const app = new Vue({
  store,
  router
})

app.$mount('#app')
