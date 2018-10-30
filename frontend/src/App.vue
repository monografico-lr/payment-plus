<template>
  <div id="app">
      <app-header></app-header>
      <transition name="slide">
        <router-view/>
      </transition>
  </div>
</template>

<script>

import { mapGetters } from 'vuex';
import AppHeader from './components/AppHeader';

export default {
  components: {
      AppHeader
  },
  mounted() {
    this.getCompany();
    this.getUser();
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

    getCompany() {
      axios.get('/currentcompany')
        .then((res) => {
          this.$store.dispatch('setCompany', res.data);
        });
    },

    getDayIncome() {
      axios.get('report/get_day_income')
        .then((res) => {
          this.store.setDayIncome(res.data.income);
        });
    },

    getUser() {
      axios.get('/currentuser')
        .then((res) => {
          this.$store.dispatch('setUser', res.data.user);
        });
    }
  }
  };
</script>


<style lang="scss">
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}
#nav {
    padding: 30px;
    a {
        font-weight: bold;
        color: #2c3e50;
        &.router-link-exact-active {
            color: #42b983;
        }
    }
}
</style>
