<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Mitra</b>SOCIAL
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">

          <form @submit.prevent="login" action="#" method="post">
            <div class="input-group mb-3">
              <input v-model="email"
                     :class="{'is-invalid': notValidEmail}"
                     type="email"
                     class="form-control"
                     placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <span v-if="notValidEmail" class="error invalid-feedback">{{ notValidEmailMessage }}</span>
            </div>
            <div class="input-group mb-3">
              <input v-model="password"
                     :class="{'is-invalid': notValidPassword}"
                     type="password"
                     class="form-control"
                     placeholder="Пароль">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <span v-if="notValidPassword" class="error invalid-feedback">{{ notValidPasswordMessage }}</span>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Запомнить меня?
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Войти</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-1">
            <a href="forgot-password.html">Забыли пароль?</a>
          </p>
          <p class="mb-0">
            <router-link :to="{name: 'auth.register'}" class="text-center">Зарегестрироваться</router-link>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
</template>

<script>

export default {
  name: 'LoginView',
  data() {
    return {
      email: null,
      password: null,
      notValidEmail: null,
      notValidEmailMessage: null,
      notValidPassword: null,
      notValidPasswordMessage: null,
    }
  },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', {email: this.email, password: this.password})
            .then(response => {
              localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])
              this.$router.push({name: 'user.profile'})
            })
            .catch(error => {
              if (error.response.data.errors.email) {
                this.notValidEmail = true
                this.notValidEmailMessage = error.response.data.errors.email[0]
              }
              if (error.response.data.errors.password) {
                this.notValidPassword = true
                this.notValidPasswordMessage = error.response.data.errors.password[0]
                console.log(error.response.data.errors.password[0])
              }
              toastr.error(error.response.data.message)

            })
      });
    }
  }

}
</script>

<style lang="scss">

</style>