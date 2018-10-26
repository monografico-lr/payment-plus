import axios from 'axios';

const $http = axios.create({
  baseURL: '/',
});

export default class RouterService {
  constructor() {
    this.$http = $http;
  }

  getSectionList() {
    return this.$http.get('/section');
  }

  getSectionIps(sectionId) {
    return this.$http.post(`/section/${sectionId}`);
  }
}
