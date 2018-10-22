
<template>
    <div class="login-body pace-running">
        <div class="container-fluid">
            <div class="loader"> <span class="load"></span></div>
            <div class="row justify-content-center">
            <div class="col-md-6 justify-content-center hidden-xs">
            <div class="hidden-xs">
                <h1>PAYMENT+</h1>
            </div>
            </div>
            <div class="col-md-6 login-box">
                <form>
                <div class="cabecera">
                    <img src="favicon-96x96.png" alt="">
                    <h4>Ingresa tus datos</h4>
                </div>
                <div class="form-group">
                    <label for="user-input">Usuario</label>
                    <input v-model ="credentials.nickname" id="user-input" type="text" class="form-control"  @keypress.enter="login">
                </div>
                <div class="form-group">
                    <label for="password-input">Contraseña</label>
                    <input id="password-input" type="password" class="form-control" v-model="credentials.password" @keypress.enter="login">
                </div>
                <p class="validation"></p>
                <div class="form-group">
                    <input type="button" id="btn-send-credentials" value="Ingresar" @click="login">
                </div>

                </form>

            </div>
            </div>
        </div>
        <div class="copyrights">
            <p>Code and Design by Jesus Guerrero</p>
            <p>2018 &copy; All Rights Reserved</p>
        </div>

        <div class="splash-screen">
            <img class="splash-logo" src="{url}assets/img/icpayment_logo_alter.svg" alt="">
            <h1>IC Payment</h1>
        </div>
  </div>

</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import Toasted from 'vue-toasted';
import globals from '@/config/globals';
import Service from './service/loginService';
import utils from '@/config/utils';

globals(Vue, Toasted, axios);
export default {
  data() {
      return {
        credentials: {
        nickname: '',
        password: '',
        email: '',
        reset_toke: '',
        csrf_token_name: ''
        }
      }
  },

  mounted() {
    this.service = new Service();
    this.quitSplash();
  },

  methods: {
    login() {
      if (!utils.isEmpty([this.credentials.nickname, this.credentials.password])) {
        this.doLogin();
      } else {
        this.$toasted.error('LLene todos los campos indicados para ingresar');
      }
    },

    doLogin() {
      const self = this;
      this.service.doLogin(this.credentials)
        .then((res) => {
          if (res) {
            console.log(res)
            window.location.href = `/`;
          } else {
            self.$toasted.info('Usuario y Contraseña no validos');
          }
        })
        .catch((err) => {
          self.$toasted.error(err);
        });
    },

    sendResetEmail() {
      const self = this;
      this.service.emailResetPassword()
        .then((res) => {
          self.showMessage(res.data.message);
        })
        .catch((err) => {
          self.$toasted.error(err);
        });
    },

    resetPassword() {
      const self = this;
      this.service.resetPassword()
        .then((res) => {
          self.showMessage(res.data.message);
        })
        .catch((err) => {
          self.$toasted.error(err);
        });
    },

    quitSplash() {
      setTimeout(() => {
        document.querySelector('.splash-screen').classList.add('hidden');
      }, 1000);
      setTimeout(() => {
        document.querySelector('.splash-screen').classList.add('d-none');
      }, 1001);
    }
  }
}
</script>

