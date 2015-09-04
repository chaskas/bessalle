(function(){

  var app = angular.module('store', [
    'ngRoute',
    'StoreControllers'
    ]);

    app.config(['$routeProvider',
        function($routeProvider) {
          $routeProvider.
            when('/', {
              templateUrl: 'partials/home.html',
            }).
            when('/home', {
              templateUrl: 'partials/home.html',
            }).
            when('/we', {
              templateUrl: 'partials/we.html',
            }).
            when('/products', {
              templateUrl: 'partials/products.html',
            }).
            when('/services', {
              templateUrl: 'partials/services.html',
            }).
            when('/offers', {
              templateUrl: 'partials/offers.html',
            }).
            when('/news', {
              templateUrl: 'partials/news.html',
            }).
            when('/contact', {
              templateUrl: 'partials/contact.html',
            }).
            when('/shopping', {
              templateUrl: 'partials/shopping.html',
              controller: 'ProductListCtrl'
            }).
            when('/shipping', {
              templateUrl: 'partials/shipping.html',
              controller: 'ShippingCtrl'
            }).
            when('/category/:categoryId', {
              templateUrl: 'partials/shopping.html',
              controller: 'ProductListCtrl'
            }).
            when('/cart', {
              templateUrl: 'partials/cart.html',
            }).
            when('/summary', {
              templateUrl: 'partials/summary.html',
              controller: 'ShippingCtrl'
            }).
            otherwise({
              redirectTo: '/home'
            });
    }]);

})();
