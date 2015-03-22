app.service('bracelet', function($http) {
  return {
    getTotal: function(id) {
        return $http.get(App.webService + '/gettotal?param=' + id);
    },
    getDescription: function(id) {
        return $http.get(App.webService + '/getOrderDescription?id=' + id);
    }

  }
})