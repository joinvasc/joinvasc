/**
 * Created by Harry on 10/01/2017.
 */

const moment = require('moment')
require('moment/locale/pt-br')

exports.install = function (Vue, options) {
  Vue.filter('date', function (date) {
    if (!date) {
      return 'N/A'
    }

    return moment(date, 'YYYY-MM-DD H:m:s').format('MM/DD/YYYY')
  })

  Vue.filter('datetime', function (date) {
    if (!date) {
      return 'N/A'
    }

    return moment(date, 'YYYY-MM-DD H:m:s').format('MM/DD/YYYY H:m')
  })

  Vue.filter('time', function (date) {
    if (!date) {
      return 'N/A'
    }

    return moment(date, 'YYYY-MM-DD H:m:s').format('H:m')
  })
}