import axios from 'axios';

export default class Service {
  constructor() {
    this.user = axios.create({
      baseURL: '/',
    });
  }

  doLogin(credentials) {
    return this.user.post('login', credentials);
  }

  resetPassword(credentials) {
    return this.user.post('reset', this.getForm(credentials));
  }

  validateReset(credentials) {
    return this.user.post('validate_reset', this.getForm(credentials));
  }

  getForm(data) {
    return `data=${JSON.stringify(data)}`;
  }
}
