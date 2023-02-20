import router from "@/router";

export default {
  state() {
    return {
      token: null,
      user: {},
    }
  },
  getters: {
    token(state) {
      if (!state.token) {
        state.token = localStorage.getItem('x_xsrf_token')
      }
      return state.token
    },
    user(state) {
      return state.user
    }
  },
  mutations: {
    setToken(state, token) {
      state.token = token
      localStorage.setItem('x_xsrf_token', token)
    },
    deleteToken(state) {
      state.token = null
      localStorage.removeItem('x_xsrf_token')
    },

    setUser(state, user) {
      state.user = user
    },

  },
  actions: {
    async logout({ commit }) {
      await axios.post('/logout')
      commit('deleteToken')
      await router.push({name: 'auth.login'})
    },
    async login({ commit }, formData) {
      try {
        await axios.get('/sanctum/csrf-cookie')
        const response = await axios.post('/login', formData)
        commit('setToken', response.config.headers['X-XSRF-TOKEN'])
        await router.push({name: 'user.profile'})
      } catch (e) {
          throw e
      }
    },
    async fetchUser({commit}) {
      const response = await axios.get('/api/auth/user')
      commit('setUser', response.data)
    }
  }
}