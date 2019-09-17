export default class ClientStore {
  constructor() {
    this.columns = [
      {
        field: 'orden',
        title: 'No.',
        align: 'center',
        type: 'index',
        valign: 'middle',
      },
      {
        field: 'nombres',
        title: 'Nombres',
        align: 'center',
        valign: 'middle',
      },
      {
        field: 'apellidos',
        title: 'Apellidos',
        align: 'center',
        valign: 'middle',
      },
      {
        field: 'cedula',
        title: 'Cedula',
        align: 'center',
        valign: 'middle',
      },
      {
        field: 'celular',
        title: 'Celular',
        align: 'center',
        valign: 'middle',
      },
      {
        field: 'estado',
        title: 'Estado',
        align: 'left',
        valign: 'middle',
      },
    ];
    this.clientMode = 'add';
    this.client = {
      nombres: '',
      apellidos: '',
      cedula: '',
      celular: '',
      provincia: '',
      ciudad: '',
      sector: '',
      calle: '',
      casa: '',
      detalles_direccion: '',
      telefono: '',
      lugar_trabajo: '',
      telefono_trabajo: '',
      ingresos: 0,
    };
  }

  setClientMode(mode) {
    this.clientMode = mode;
  }

  setClient(client) {
    this.client = client;
  }

  clientEmpty() {
    this.client = {
      nombres: '',
      apellidos: '',
      cedula: '',
      celular: '',
      provincia: '',
      ciudad: '',
      sector: '',
      calle: '',
      casa: '',
      detalles_direccion: '',
      telefono: '',
      lugar_trabajo: '',
      telefono_trabajo: '',
      ingresos: 0,
    };
  }
}
