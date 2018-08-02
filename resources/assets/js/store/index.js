/**
 * Created by Harry on 03/01/2017.
 */

import Vue from 'vue'
import Vuex from 'vuex'
import api from '../api'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    user: null,
    action: null,
    followup: null,
    isDead: {
      status: false,
      when: null
    },
    errors: []
  },

  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setAction(state, action) {
      state.action = action
    },
    setFollowup(state, followup) {
      state.followup = followup
    },
    setDead(state, payload) {
      state.isDead.status = payload.status
      state.isDead.when = payload.when
    }
  },

  actions: {
    createFollowup ({ commit, state }, { followup, patient }) {
      followup.ambulatory_care.dead_in = state.isDead.when
      return api.post('/followups', { followup, patient })
        .then(response => {
          commit('setAction', 'update')
          commit('setFollowup', response.data)

          return response.data
        })
        .catch(error => {
          this.saving = false
        })
    },

    updateFollowup ({ commit, state }, { followup, patient }) {
      followup.ambulatory_care.dead_in = state.isDead.when
      return api.put(`/followups/${followup.id}`, { followup, patient })
        .then(response => {
          commit('setFollowup', response.data)

          return response.data
        })
        .catch(error => {
          this.saving = false
        })
    },

    updateDead({ commit, state }, obj){
      var x = [
        "followup30",
        "followup3m",
        "followup1a",
        "followup2a",
        "followup3a",
        "followup4a",
        "followup5a"
      ]
      var valAtual = x.indexOf(obj.when)
      var valSalvo = x.indexOf(state.isDead.when)

      if (state.isDead.when != null) {
        return valAtual > valSalvo
      } else {
        return false;
      }
    },

    verifyDead({ commit }, obj) {

      if (obj.when == null) {
        commit('setDead', {
          status: false,
          when: null
        })
      } else {
        commit('setDead', {
          status: true,
          when: obj.when
        })
      }
    }
  },

  getters: {
    progress: (state) => {
      const f = state.followup
      let total = 18
      let progress = 0

      // Page Patient Info
      if (f.patient.records_identifier) progress++
      if (f.interview_date) progress++
      if (f.admission_date) progress++
      if (f.patient.name) progress++
      if (f.patient.birth_date) progress++
      if (f.patient.gender) progress++
      if (f.treatment_type) progress++

      // Page First Event
      if (f.first_event.previous) {
        progress++

        if (f.first_event.previous === 'sim') {
          total += 2
          if (f.first_event.number_of_events) progress++
          if (f.first_event.last_event_date) progress++
        }
      }

      if (f.first_event.rehab) progress++
      if (f.first_event.hospital) {
        progress++

        if (f.first_event.hospital === 'hmsj') {
          total += 1
          if (f.first_event.hmsj_uavc) progress++
        }
      }

      // Page Current Event
      if (f.current_event.event_datetime) progress++
      if (f.current_event.help_datetime) progress++
      if (f.current_event.arrival_datetime) progress++
      if (f.current_event.transportation) progress++
      if (f.current_event.note) progress++

      // Return the progress
      return progress * 100 / total
    }
  }
})

export default store
