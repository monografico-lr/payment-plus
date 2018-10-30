<template>
    <header class="loading">
        <div class="header-low">
            <div class="brand">
            <a href="#" @click.prevent="toggleMenu">
                <i class="material-icons brand__menu">menu</i>
            </a>
            <a href="/" class="hidden-xs">
                <h3>Payment+ </h3>
            </a>
            </div>

            <nav class="top-nav">
            <li class="navButton hidden-xs"><a href="/"> Dashboard </a></li>
            <li class="navButton hidden-xs"><a href="/clientes">Clientes</a></li>
            <li class="navButton hidden-xs"><a href="/servicios">Servicios</a></li>
            <li class="navButton hidden-xs"><a href="/contratos">Contratos</a>
                <ul class="submenu">
                <li class="navButton hidden-xs"><a href="/extras">Extras</a></li>
                </ul>
            </li>

            <li class="navButton hidden-xs"><a href="/secciones">Secciones</a></li>
            <li class="navButton hidden-xs"><a href="/reportes">Reportes</a></li>
            </nav>

            <div class="user-div ">
            <nav class="user-controls">
                <li class="navButton">
                <a href="#" data-toggle="modal" data-target="#app-petty-cash-modal" title="Caja Chica" @click.prevent="openPettyCash('retire')">
                <i class="material-icons">inbox</i>
                </a></li>
                <li class="navButton">
                <a href="" data-toggle="modal" data-target="#app-ticket-modal" data-placement="bottom" title="Averias">
                <i class="material-icons">assignment</i>
                </a></li>
                <li class="navButton">
                <!-- <a href="" data-toggle="modal" data-target="#app-message-modal" data-placement="bottom" title="Mensajes">
                <i class="material-icons">perm_phone_msg</i>
                </a></li> -->
                <li class="navButton dropdown mymenu">
                    <a href="/averias" id="dropdown-notification" title="notificaciones" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                    </a>
                    <span class="badge" v-if="notifications">{{notifications}}</span>

                 <app-notifications />
                </li>
            </nav>
            <div class="dropdown mymenu">
                <a id="dLabel" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="user-name hidden-xs"> </span>
                <div class="profile-picture">
                    <span> </span>
                </div>
                <span class="caret"></span>
                </a>
                <app-user></app-user>
            </div>
            </div>
        </div>
    </header>
</template>

<script>

import { mapGetters } from 'vuex';
import AppNotifications from './AppNotifications';
import AppUser from './AppUser';

export default {
    data() {
        return {
            notifications: false
        }
    },
    components: {
        AppNotifications,
        AppUser,
    },
  mounted() {

  },

  computed: {
      ...mapGetters(['company', 'user'])
  },

  methods: {
    toggleMenu() {
      window.appBus.$emit('toggle-menu');
    },

    openPettyCash(mode) {
      this.store.setPettyCashMode(mode);
    },

    getSaldo() {
      axios.get('petty_cash/get_balance')
        .then((res) => {
          this.store.setPettyCashBalance(res.data);
        });
    },

    getDayIncome() {
      axios.get('report/get_day_income')
        .then((res) => {
          this.store.setDayIncome(res.data.income);
        });
    }
  }
  };
</script>
