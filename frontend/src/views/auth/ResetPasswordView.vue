<template>
  <div class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Mitra</b>SOCIAL
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="reset-password">
          <p class="login-box-msg">Введите новый пароль.</p>
          <div :class="{'is-invalid': errors.email}">
            <span class="error invalid-feedback">{{ errors.email }}</span>
          </div>
          <form @submit.prevent="sendRequest" method="post">

            <app-input v-model.trim="password"
                       type="password"
                       placeholder="Пароль"
                       :error="errors.password"
            ></app-input>

            <app-input v-model.trim="password_confirmation"
                       type="password"
                       placeholder="Повторите пароль"
                       :error="errors.password_confirmation"
            ></app-input>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Изменить пароль</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>

        <p class="mt-3 mb-1">
          <router-link :to="{name: 'auth.login'}">Вход</router-link>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
    <app-modal
        :show="isSend"
        @modal-close="isSend = false"
        @modal-action="$router.push({name: 'auth.login'})"
        modal-title="Пароль успешно изменен"
        modal-body="Используйте новый пароль, чтобы войти в систему"
        :control="true"
        control-title="Войти"
    ></app-modal>
  </div>
</template>

<script>
import AppInput from "@/components/form/AppInput";
import checkErrors from "@/mixins/checkErrors";
import AppModal from "@/components/common/AppModal";
export default {
  name: "ResetPasswordView",
  data() {
    return {
      password: null,
      password_confirmation: null,
      isSend: false,
      errors: {
        password: null,
        password_confirmation: null,
        email: null,
      }
    }
  },
  methods: {
    sendRequest() {
      const token = this.$route.params.token
      const email = this.$route.params.email
      axios.post('/reset-password', {
        token: token,
        password: this.password,
        email: email,
        password_confirmation: this.password_confirmation,
      })
      .then(response => {
        this.isSend = true
        this.password = ''
        this.password_confirmation = ''
        toastr.success(response.data.message)
      })
      .catch(error => {
        this.isSend = false
        this.checkError(error, this.errors)
        toastr.error(error.response.data.message)
      })
    }
  },
  mixins:  [checkErrors],
  components: {AppInput, AppModal}
}
</script>

<style scoped>
.is-invalid .invalid-feedback {
  display: block;
}
</style>