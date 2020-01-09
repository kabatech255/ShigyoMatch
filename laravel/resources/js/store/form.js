import { OK, CREATED, UNPROCESSABLE_ENTITY } from '@/util'

const state = {
  apiStatus: null,
  responseData: null,
  address: null,
  successMessage: null,
}

const getters = {
  address: state => state.address,
  successMessage: state => state.successMessage,
}


const mutations = {
  setResponse(state, data) {
    state.responseData = data
  },
  setAddress(state, data) {
    state.address = data
  },
  setSuccessMessage(state, data) {
    state.successMessage = data
  },
}

const actions = {
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}