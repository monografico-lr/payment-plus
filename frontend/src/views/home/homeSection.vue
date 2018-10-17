<template lang="pug">
.container-fluid#home
  section#home-section
    .row.welcome-screen
      .col-md-7.col-xs-12.main-card
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
      HomeDetailCards(:pages="['proximos pagos', 'averias', 'otras', 'final']")

    .row.home-options-container
      .col-md-7.hidden-xs.shortcuts-container
          .col-sm-3.shortcut#caller-new-client(data-toggle="modal", data-target="#client-modal")
              i.material-icons person_add
              p.section-title Nuevo Cliente

          .col-sm-3.shortcut(data-toggle="modal", @click="sendTo('/nuevo_contrato')")
              i.material-icons library_books
              p.section-title Nuevo Contrato

          .col-sm-3.shortcut(data-toggle="modal", data-target="#search-client-modal")
              i.material-icons monetization_on
              p.section-title Registrar Pago
          .col-sm-3.shortcut#desk-cash-caller(@click="sendTo('/cierre')")
              i.material-icons lock_open
              p.section-title Cerrar Caja

      .col-md-4.clock-card
          h3.card-title.t-center Hora
          h4.hour.h3-4.t-center {{ date.hour }}

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
