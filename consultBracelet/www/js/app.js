var app = angular.module('consultBracelet', ['ionic','ngCordova.plugins.nfc']).

  config(['$httpProvider', function($httpProvider) {
          $httpProvider.defaults.useXDomain = true;

          delete $httpProvider.defaults.headers.common['X-Requested-With'];
      }
  ]);

app.config(function($stateProvider, $urlRouterProvider) {
  $urlRouterProvider.otherwise('/home')
  $stateProvider
  .state('home', {
    url: '/home',
    controller: 'home',
    templateUrl: 'main.html'
  })
  .state('total',{
    url: '/total:param',
    controller: 'total',
    templateUrl: 'total.html',
    resolve: {
      Total: function(bracelet) {
        return bracelet;
      }
    }
  })
  .state('description',{
    url: '/description:id',
    controller: 'description',
    templateUrl: 'description.html',
    resolve: {
      Description: function(bracelet) {
        return bracelet;
      }
    }
  })
})

