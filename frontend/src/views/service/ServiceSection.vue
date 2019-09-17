<template lang="pug">
  .screen.clients.row
    .left-navigation.col-md-2
      .aside-nav-container
        .left-navigation__header
          h3.left-navigation__header-text {{ title }}
        ul.aside-nav
          li.aside-buttons
            a(href="#" data-toggle="modal", data-target="#service-modal")
              i.material-icons person_add
              | Nuevo Servicio
          li.aside-buttons
            a(href="#" id="update-service", data-toggle="modal", @click.prevent="getService")
              i.material-icons edit
              | Editar Servicio
          li.aside-buttons
            a(href="" id="delete-service", @click.prevent="deleteService")
              i.material-icons delete
              | Eliminar Servicio
          li.aside-buttons
            a(href="" id="get-service-details")
              i.material-icons find_in_page
              | Ver Detalles

    .main-content.col-md-10
      #service-table-container
        .searcher-container.main-toolbar#service-toolbar
          .input-group.search
            .input-group-addon: i.material-icons search
            input.form-control.searcher(type="text" placeholder="Buscar servicio" v-model.lazy="search")
          .pull-right
            a.btn.icon.print-table(target="_blank" href="process/getreport/services'"): i.material-icons print
          .pull-right
            select#service-filter.form-group.filter.btn.btn-primary
              option(:value="option.id", v-for="option of options") {{ option.text }}
        CustomTable(ids="service-table", ref="Table", :parentId="parentId", :data="services", :cols="cols", :toolbar="toolbar", :search="search",:options="tableOptions", @check-uncheck="listen")
    ServiceModal(:store="store", :service="store.service", :modal-mode="store.serviceMode" @save="addUpdate")

</template>

<script>
import swal from 'sweetalert2';
import utils from './../../config/utils';
import DataTable from './../../components/DataTable.vue';
import CustomTable from './../../components/CustomTable.vue';
import ServiceModal from './components/ServiceModal.vue';
import Store from './store/ServiceStore';

export default {
  components: {
    DataTable,
    CustomTable,
    ServiceModal,
  },

  mounted() {
    utils.spyLeftNavigation();
  },

  data() {
    const store = new Store();
    return {
      store,
      title: 'Servicios',
      parentId: '#service-table-container',
      toolbar: '#service-toolbar',
      services: [],
      search: '',

      tableOptions: {
        pageSize: 25,
        pageList: [25, 50, 100, 200, 500, 1000],
        states: ['internet', 'reparacion', 'seguro'],
        stateField: 'tipo',
        endpoint: 'service',
      },
      selectedService: null,
      options: [
        { id: 'todo', text: 'Todos' },
        { id: 'internet', text: 'Internet' },
        { id: 'reparacion', text: 'Reparacion' },
        { id: 'seguro', text: 'seguro' },
      ],
    };
  },

  computed: {
    cols() {
      return this.store.columns;
    },
  },

  methods: {
    addUpdate() {
      const { service } = this.store;
      const empty = utils.isEmpty(service);
      const method = this.store.serviceMode == 'add' ? 'post' : 'put';
      const url = service.id ? `/service/${service.id}` : '/service';

      if (!empty) {
        this.$http[method](url, service)
          .then(res => {
            this.$toasted.success('Servicio creado');
            this.$refs.Table.getData();
            $('#service-modal').modal('hide');
          })
          .catch(err => {
            this.$toasted.error(err.data.message);
          });
      } else {
        this.$toasted.info('LLene todos los campos por favor');
      }
    },

    getService() {
      const service = this.$refs.Table.currentRow;

      if (service) {
        this.$http
          .get(`service/${service.id}`)
          .then(res => {
            this.store.setService(res.data);
            this.store.setServiceMode('update');
            $('#service-modal').modal();
          })
          .catch(err => {
            this.$toasted.error(err);
          });
      } else {
        this.$toasted.info('seleccione un servicio primero');
      }
    },

    listen(name, row) {
      this.selectedService = row;
    },

    deleteService() {
      const self = this;
      const service = this.$refs.Table.currentRow;

      function sendDelete(id) {
        self.$http.delete(`/service/${id}`).then(res => {
          self.$toasted.success('Servicio eliminado');
          self.$refs.Table.getData();
        });
      }

      if (service) {
        swal({
          title: 'Eliminar Servicio',
          text: `¿Está seguro de querer eliminar a ${service.nombre}`,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar',
        }).then(result => {
          if (result.value) {
            sendDelete(service.id);
          }
        });
      } else {
        this.$toasted.info('seleccione un servicio primero');
      }
    },
  },
};
</script>
