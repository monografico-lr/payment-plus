<template>
  <div class="col-md-4 col-xs-12 details-card">
    <div class="layout-container">
      <div class="pagos-layer">
        <h3 class="card-title">Proximos Pagos</h3>
        <div class="placeholder-icon">
          <i class="material-icons icon-placeholder">notifications_active</i>
        </div>
        <div class="list-nextpayments"></div>
      </div>
      <div class="averias-layer">
        <h3 class="card-title">Caja Chica</h3>
        <div class="placeholder-icon">
          <i class="material-icons icon-placeholder">money</i>
        </div>
        <div class="list-repair centered-container">
          <h2 class="current-saldo">RD$ 0.00</h2>
        </div>
      </div>
      <div class="deudores-layer">
        <h3 class="card-title">Lista de Deudores</h3>
        <div class="placeholder-icon">
          <i class="material-icons icon-placeholder">money_off</i>
        </div>
        <div class="list-nextpayments"></div>
      </div>
      <div class="day-income-layer">
        <h3 class="card-title">Ganancias del dia</h3>
        <div class="list-repair centered-container">
          <a
            target="_blank"
            href="base_url('process/getreport/payment/today"
          ></a>
          <h2 class="current-saldo">RD$ 0.00</h2>
        </div>
      </div>
    </div>
    <div class="details-control-container">
      <button
        class="detail-control"
        :key="`detail-button-${index}`"
        @click="moveControls(index)"
        v-for="(page, index) in pages"
      >
        {{ page }}
      </button>
    </div>
  </div>
</template>

<script>
import HomeDetailCardsItem from './HomeDetailCardsItem.vue';
import $ from 'jquery';

export default {
  components: {
    HomeDetailCardsItem,
  },
  props: {
    pages: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      mode: '',
      nextPayments: null,
      debtors: null,
    };
  },
  mounted() {
    this.moveControls();
    // this.getList('get_next_payments', 'nextPayments');
    // this.getList('get_debtors', 'debtors');
  },

  methods: {
    moveControls(index) {
      const position = index == 0 ? index : index * -100;
      const layoutContainer = $('.layout-container');

      layoutContainer.animate(
        {
          left: `${position}%`,
        },
        200
      );
    },

    getList(endpoint, propertyToFill) {
      this.$http.get(`report/${endpoint}`).then(res => {
        this[propertyToFill] = res.data[propertyToFill];
      });
    },
  },
};
</script>
