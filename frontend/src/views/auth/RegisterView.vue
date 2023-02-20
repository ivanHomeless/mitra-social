<template>
  <div class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <b>Mitra</b>Social
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Регистрация</p>

        <form @submit.prevent="sendForm" method="post">

          <app-input v-model.trim="name"
                     type="text"
                     placeholder="Имя"
                     :error="errors.name"
                     icon="fas fa-user"
          ></app-input>

          <app-input v-model.trim="lastname"
                     type="text"
                     placeholder="Фамилия"
                     :error="errors.lastname"
                     icon="fas fa-user"
          ></app-input>

          <app-input v-model.trim="email"
                     type="email"
                     placeholder="E-mail"
                     :error="errors.email"
                     icon="fas fa-envelope"
          ></app-input>

          <div class="form-group">
            <select id="gender"
                    v-model="gender"
                    class="form-control"
                    :class="{'is-invalid': errors.gender}"
            >
              <option value="">Пол</option>
              <option value="1">Мужской</option>
              <option value="2">Женский</option>
            </select>

            <span v-if="errors.gender" class="error invalid-feedback">{{ errors.gender }}</span>
          </div>

          <app-input v-model.trim="password"
                     type="password"
                     placeholder="Пароль"
                     :error="errors.password"
                     icon="fas fa-lock"
          ></app-input>

          <app-input v-model.trim="password_confirmation"
                     type="password"
                     placeholder="Повторите пароль"
                     :error="errors.password_confirmation"
                     icon="fas fa-lock"
          ></app-input>

          <div class="form-group mb-3">
            <span :class="{'is-invalid': errors.city_id}">Город: </span>
            <v-select @search="searchCities" v-model="city_id" :options="options"></v-select>
            <span v-if="errors.city_id" class="error invalid-feedback">{{ errors.city_id }}</span>
          </div>

          <div class="form-group mb-3">
            <span class="is-invalid" v-if="errors.birth"></span>
            <date-picker
                :placeholder="'Дата рождения'"
                v-model="birth"
                valueType="format"
                :disabled-date="disabledRange"
                :default-value="new Date(2000, 0, 1)"
            ></date-picker>
            <span v-if="errors.birth" class="error invalid-feedback">{{ errors.birth }}</span>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input :class="{'is-invalid': errors.agreeTerms}" type="checkbox" id="agreeTerms" name="terms" v-model="agreeTerms">
                <label for="agreeTerms">
                  Я согласен с <a href="#">правилами</a>
                </label>
                <span v-if="errors.agreeTerms" class="error invalid-feedback">{{ errors.agreeTerms }}</span>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Зарегестрироваться</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <router-link class="text-center" :to="{name: 'auth.login'}">Войти</router-link>

      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
  </div>
</template>

<script>
import AppInput from "@/components/form/AppInput";
import checkErrors from "@/mixins/checkErrorResponse";
import DatePicker from 'vue2-datepicker';
import vSelect from 'vue-select'
import 'vue2-datepicker/index.css';
import 'vue-select/dist/vue-select.css';
import 'vue2-datepicker/locale/ru';

export default {
  name: "RegisterView",
  data() {
    return {
      disabledSelect: false,
      name: null,
      lastname: null,
      password: null,
      password_confirmation: null,
      email: null,
      birth: null,
      city_id: '',
      agreeTerms: false,
      gender: '',
      errors: {
        name: null,
        lastname: null,
        password: null,
        password_confirmation: null,
        email: null,
        birth: null,
        city_id: null,
        agreeTerms: null,
        gender: null,
      },
      options: [
        ''
      ],
    }
  },
  methods: {
    sendForm() {
      if (this.agreeTerms) {
        axios.get('/sanctum/csrf-cookie/').then(response => {
          axios.post('/register/', {
            name: this.name,
            lastname: this.lastname,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
            city_id: this.city_id.id,
            birth: this.birth,
            gender: this.gender,
          }).then(response => {
            localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])
            this.$router.push({name: 'user.profile'})
          }).catch(error => {
            this.checkError(error, this.errors)
            toastr.error(error.response.data.message)
          })
        })
      } else {
        this.errors.agreeTerms = 'Вы должны согласиться с правилами.'
      }
    },

    searchCities(string) {
      axios.get('/api/geo/cities/' + string).then(response => {
        this.options = response.data.map((element) => {
          return {
            id: element.id,
            label: element.fullName
          }
        })
      }).catch(error => {})
    },
    disabledRange(date) {
      return date < new Date(1920, 1, 1) || date > new Date();
    }
  },
  components: {vSelect, AppInput, DatePicker},
  mixins: [checkErrors]
}
</script>

<style scoped>
.login-box, .register-box {
  width: auto;
  max-width: 427px;
}
</style>