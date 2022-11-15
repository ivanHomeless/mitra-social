<template>
  <div class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Mitra</b>SOCIAL
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="forgot-password">
          <p class="login-box-msg">Вы забыли пароль? Вы можете получить новый.</p>

          <form @submit.prevent="send" method="post">
            <app-input v-model.trim="email"
                       type="email"
                       placeholder="E-mail"
                       :error="errors.email"
                       icon="fas fa-envelope"
            ></app-input>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Востоновить пароль</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>


        <p class="mt-3 mb-1">
          <router-link :to="{name: 'auth.login'}">Вход</router-link>
        </p>
        <p class="mb-0">
          <router-link :to="{name: 'auth.register'}">Регистрация</router-link>
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
        modal-title="Пароль отправлен вам на почту"
        modal-body="Перейдите по ссылке в письме."
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
  name: "ForgotPasswordView",
  data() {
    return {
      email: null,
      isSend: false,
      errors: {
        email: null,
      }
    }
  },
  methods: {
    send() {
      axios.post('/forgot-password', {email: this.email})
          .then(response => {
            this.isSend = true
            this.email = ''
            toastr.success(response.data.message)
          })
          .catch(error => {
            this.isSend = false
            this.checkError(error, this.errors)
            toastr.error(error.response.data.message)
          })
    }
  },
  mixins: [checkErrors],
  components: {AppInput, AppModal}
}
</script>

<style scoped>

</style>