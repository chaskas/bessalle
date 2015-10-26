(function(){

  var app = angular.module('store', [
    'ngRoute',
    'StoreControllers',
    'ng-rut'
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
            when('/checkout', {
              templateUrl: 'partials/checkout.html',
              controller: 'CheckOutCtrl'
            }).
            otherwise({
              redirectTo: '/home'
            });
    }]);

})();

angular.module('ng-rut', [])
    .directive('ngRut', function() {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function(scope, elem, attr, ctrl) {
                var Fn={
                    validaRut : function (rutCompleto) {
                        if (!/^[0-9]+-[0-9kK]{1}$/.test( rutCompleto )) return false;
                        var tmp = rutCompleto.split('-');
                        if ( tmp[1] == 'K' ) tmp[1] = 'k';
                        return (Fn.dv(tmp[0])) == tmp[1];
                    },
                    dv : function(T){
                        var M=0,S=1;
                        for(;T;T=Math.floor(T/10))
                            S=(S+T%10*(9-M++%6))%11;
                        return S?S-1:'k';
                    }
            };
                scope.$watch(attr.ngModel, function(value) {
                    if (value=='') return;

                    if (!Fn.validaRut(value))
                        ctrl.$setValidity('rut', false);
                    else ctrl.$setValidity('rut', true);
                });
            }
        }
    });
