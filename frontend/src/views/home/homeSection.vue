<template lang="pug">
.container-fluid#home
  section#home-section
    .row.welcome-screen
      .col-md-8.col-xs-12.main-card
          .row
              .company-data
                  img.company-logo(:src="logo", alt="company-logo", style="width: 170px")
              .welcome-data
                  .row
                      .col-md-6.without-padding
                          h4 Ic Services
                          h4 Bienvenido Jesus Guerrero

                      .col-md-5.col-xs-6.date-container
                          p.day {{ date.day }}
                          p.month-year {{ date.monthYear }}
                          span.dayweek {{ date.dayWeek }}

</template>

<script>
import HomeDetailCards from './components/HomeDetailCards.vue';
// import HomeSearchClientModal from './components/HomeSearchClientModal.vue';
// import ClientModal from './../clientes/components/ClientModal.vue';
// import ClientStore from './../clientes/store/clientStore';

// const clientStore = new ClientStore();

export default {
  name: 'home-section',
  components: {
    HomeDetailCards,
    // HomeSearchClientModal,
    // ClientModal
  },
  mounted() {
    this.getDate();
  },
  data() {
    return {
      date: {
        day: '',
        monthYear: '',
        dayWeek: '',
        hour: ''
      },
      appStore: this.$root.store
    };
  },

  methods: {
    getDate() {
      const self = this;
      const days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
      const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

      function updateHour() {
        const date = new Date();
        self.date.day = date.getDate();
        self.date.monthYear = `De ${months[date.getMonth()]} de ${date.getFullYear()}`;
        self.date.dayWeek = days[date.getDay()];
        self.date.hour = date.toLocaleTimeString();
      }

      setInterval(updateHour, 1000);
    },

    sendTo(url) {
      this.$router.push({ path: url });
    }
  },

  computed: {
    store() {
      return this.appStore;
    },
    logo() {
      const logo = this.$store.state.company.logo || 'company/default.png';
      return `assets/uploads/${logo}`;
    }
  },
};
</script>
