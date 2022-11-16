import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    meta: {layout: 'main'},
    component: () => import('../views/HomeView')
  },
  {
    path: '/login',
    name: 'auth.login',
    meta: {layout: 'empty'},
    component: () => import('../views/auth/LoginView')
  },
  {
    path: '/forgot-password',
    name: 'auth.forgot-password',
    meta: {layout: 'empty'},
    component: () => import('../views/auth/ForgotPasswordView')
  },
  {
    path: '/reset-password/:token/email/:email',
    name: 'auth.reset-password',
    meta: {layout: 'empty'},
    component: () => import('../views/auth/ResetPasswordView')
  },
  {
    path: '/register',
    name: 'auth.register',
    meta: {layout: 'empty'},
    component: () => import('../views/auth/RegisterView')
  },
  {
    path: '/profile',
    name: 'user.profile',
    meta: {layout: 'main'},
    component: () => import('../views/ProfileView')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('x_xsrf_token')

  if (!token) {
    if (to.name === 'auth.login' || to.name === 'auth.register' || to.name === 'auth.forgot-password'
        || to.name === 'auth.reset-password') {
      return next()
    } else {
      return next({name: 'auth.login'})
    }
  }

  if (to.name === 'auth.login' || to.name === 'auth.register' && token) {
    return next({name: 'user.profile'})
  }


  if (to.name === 'home' && token) {
    return next({name: 'user.profile'})
  }

  next()

})

export default router
