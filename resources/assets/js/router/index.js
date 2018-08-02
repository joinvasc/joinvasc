/**
 * Created by Harry on 03/01/2017.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

const childrenRoutes = [
  {
    path: '/',
    name: 'followup-patient-info',
    component: require('../pages/PatientInfo.vue')
  },
  {
    path: 'primeiro-evento',
    name: 'followup-first-event',
    component: require('../pages/FirstEvent.vue')
  },
  {
    path: 'evento-atual',
    name: 'followup-current-event',
    component: require('../pages/CurrentEvent.vue')
  },
  {
    path: 'exames',
    name: 'followup-exams',
    component: require('../pages/Exams.vue')
  },
  {
    path: 'demografico',
    name: 'followup-demographic',
    component: require('../pages/Demographic.vue')
  },
  {
    path: 'origem-paciente',
    name: 'followup-patient-origin',
    component: require('../pages/PatientOrigin.vue')
  },
  {
    path: 'condicoes-socioeconomicas',
    name: 'followup-socioeconomic-conditions',
    component: require('../pages/SocioeconomicConditions.vue')
  },
  {
    path: 'fatores-risco',
    name: 'followup-risk-factors',
    component: require('../pages/RiskFactors.vue')
  },
  {
    path: 'alta',
    name: 'followup-discharge',
    component: require('../pages/Discharge.vue')
  },
  {
    path: 'Biobanco',
    name: 'biobase',
    component: require('../pages/Biobase.vue')
  },
  {
    path: 'FormAlta',
    name: 'form-alta',
    component: require('../pages/FormAlta.vue')
  },
  {
    path: 'obito',
    name: 'followup-death',
    component: require('../pages/Death.vue')
  },
  {
    path: 'acompanhamento-ambulatorial',
    name: 'followup-ambulatory-care',
    component: require('../pages/AmbulatoryCare.vue')
  },
  {
    path: 'avaliacao-imagens',
    name: 'followup-image-evaluations',
    component: require('../pages/ImageEvaluations.vue')
  },
  {
    path: 'imagens',
    name: 'followup-image',
    component: require('../pages/ImageForm.vue')
  },
  {
    path: 'indicadores',
    name: 'followup-indicators',
    component: require('../pages/Indicators.vue')
  },
  {
    path: 'epivasc',
    name: 'followup-epivasc',
    component: require('../pages/EpiVasc.vue')
  },
  {
    path: 'followup30',
    name: 'followup-30',
    component: require('../pages/Followup30.vue')
  },
  {
    path: 'followup3m',
    name: 'followup-3m',
    component: require('../pages/Followup3m.vue')
  },
  {
    path: 'followup1a',
    name: 'followup-1a',
    component: require('../pages/Followup1a.vue')
  },
  {
    path: 'followup2a',
    name: 'followup-2a',
    component: require('../pages/Followup2a.vue')
  },
  {
    path: 'followup3a',
    name: 'followup-3a',
    component: require('../pages/Followup3a.vue')
  },
  {
    path: 'followup4a',
    name: 'followup-4a',
    component: require('../pages/Followup4a.vue')
  },
  {
    path: 'followup5a',
    name: 'followup-5a',
    component: require('../pages/Followup5a.vue')
  },
  {
    path: 'ImageForm',
    name: 'image-form',
    component: require('../pages/ImageForm.vue')
  }
]

// Install VueRouter onto Vue
Vue.use(VueRouter)

// Define routes
const routes = [
  {
    path: '/',
    component: require('../pages/Followup.vue'),
    children: childrenRoutes
  }
]

// Create the Router instance
const router = new VueRouter({
  mode: 'hash',
  linkActiveClass: 'active',
  routes
})


export default router