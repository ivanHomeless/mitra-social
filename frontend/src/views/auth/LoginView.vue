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
            <app-input v-model.trim="email"
                       type="email"
                       placeholder="E-mail"
                       :error="errors.email"
                       icon="fas fa-envelope"
            ></app-input>

            <app-input v-model.trim="password"
                       type="password"
                       placeholder="Пароль"
                       :error="errors.password"
                       icon="fas fa-lock"
            ></app-input>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input v-model="remember" type="checkbox" id="remember" name="remember">
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
            <router-link :to="{name: 'auth.forgot-password'}">Забыли пароль?</router-link>
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
import AppInput from "@/components/form/AppInput";
import checkErrors from "@/mixins/checkErrors";
export default {
  name: 'LoginView',
  data() {
    return {
      email: null,
      password: null,
      remember: false,
      errors: {
        email: null,
        password: null
      }
    }
  },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', {email: this.email, password: this.password, remember: this.remember})
            .then(response => {
              localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])
              this.$router.push({name: 'user.profile'})
            })
            .catch(error => {
              this.checkError(error, this.errors)
              toastr.error(error.response.data.message)
            })
      });
    },
  },
  mixins: [checkErrors],
  components: {AppInput}

}
</script>

<style lang="scss">

</style>