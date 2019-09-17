import axios from 'axios';

const $http = axios.create({
  baseURL: '/',
});
export default class serviceService {
  constructor() {
    this.$http = $http;
  }

  getServiceList(type = '') {
    return this.$http.post(`/service?q=(tipo:${type})`);
  }

  getService(id) {
    return this.$http.post(`/service/${id}`).then(res => res.data);
  }
}
