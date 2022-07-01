import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const modules = {
}

const state = {
  sidebarShow: 'responsive',
  sidebarMinimize: true,
  url_base: 'http://localhost:8000/',
}
const mutations = {
  toggleSidebarDesktop (state) {
    const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
    state.sidebarShow = sidebarOpened ? false : 'responsive'
  },
  toggleSidebarMobile (state) {
    const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
    state.sidebarShow = sidebarClosed ? true : 'responsive'
  },
  set (state, [variable, value]) {
    state[variable] = value
  }
}



export default new Vuex.Store({
  state,
  mutations,
  modules
})