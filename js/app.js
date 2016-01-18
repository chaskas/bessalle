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
            when('/products/camiseta', {
              templateUrl: 'partials/products/camiseta.html',
            }).
            when('/products/rinon', {
              templateUrl: 'partials/products/rinon.html',
            }).
            when('/products/basura', {
              templateUrl: 'partials/products/basura.html',
            }).
            when('/products/medida', {
              templateUrl: 'partials/products/medida.html',
            }).
            when('/products/carbon', {
              templateUrl: 'partials/products/carbon.html',
            }).
            when('/products/prepicado', {
              templateUrl: 'partials/products/prepicado.html',
            }).
            when('/products/biodegradable', {
              templateUrl: 'partials/products/biodegradable.html',
            }).
            when('/products/almidon', {
              templateUrl: 'partials/products/almidon.html',
            }).
            when('/products/cintas', {
              templateUrl: 'partials/products/cintas.html',
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
            when('/detail/:productId', {
              templateUrl: 'partials/detail.html',
              controller: 'ProductCtrl'
            }).
            when('/shipping', {
              templateUrl: 'partials/shipping.html',
              controller: 'ShippingCtrl'
            }).
            when('/shopping/:categoryId', {
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
            when('/success', {
              templateUrl: 'partials/success.html',
              controller: 'SuccessCtrl'
            }).
            otherwise({
              redirectTo: '/home'
            });
    }]);

})();


'use strict';
function cleanRut(_value) {
  return typeof _value === 'string' ? _value.replace(/[^0-9kK]+/g,'').toUpperCase() : '';
}

function formatRut(_value, _default) {
  _value = cleanRut(_value);

  if(!_value) return _default;
  if(_value.length <= 1) return _value;

  var result = _value.slice(-4,-1) + '-' + _value.substr(_value.length-1);
  for(var i = 4; i < _value.length; i+=3) result = _value.slice(-3-i,-i) + '.' + result;
  return result;
}

function validateRut(_value) {
  if(typeof _value !== 'string') return false;
  var t = parseInt(_value.slice(0,-1), 10), m = 0, s = 1;
  while(t > 0) {
    s = (s + t%10 * (9 - m++%6)) % 11;
    t = Math.floor(t / 10);
  }
  var v = (s > 0) ? (s-1)+'' : 'K';
  return (v === _value.slice(-1));
}

function addValidatorToNgModel(ngModel){
  var validate = function(value) {
    var valid = validateRut(value);
    ngModel.$setValidity('rut', valid);
    return valid;
  };

  var validateAndFilter = function(_value) {
    _value = cleanRut(_value);
    return validate(_value) ? _value : null;
  };

  var validateAndFormat = function(_value) {
    _value = cleanRut(_value);
    validate(_value);
    return formatRut(_value);
  };

  ngModel.$parsers.unshift(validateAndFilter);
  ngModel.$formatters.unshift(validateAndFormat);
}

function formatRutOnWatch($scope, ngModel) {
  $scope.$watch(function() {
    return ngModel.$viewValue;
  }, function() {
    ngModel.$setViewValue(formatRut(ngModel.$viewValue));
    ngModel.$render();
  });
}

function formatRutOnBlur($element, ngModel) {
  $element.on('blur', function(){
    ngModel.$setViewValue(formatRut(ngModel.$viewValue));
    ngModel.$render();
  });
}

angular.module('ng-rut', [])

  .directive('ngRut', function() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function($scope, $element, $attrs, ngModel) {
        if ( typeof $attrs.rutFormat === 'undefined' ) {
          $attrs.rutFormat = 'live';
        }

        addValidatorToNgModel(ngModel);

        switch($attrs.rutFormat) {
        case 'live':
          formatRutOnWatch($scope, ngModel);
          break;
        case 'blur':
          formatRutOnBlur($element, ngModel);
          break;
        }
      }
    };
  })

  .filter('rut', function() {
    return formatRut;
  })

  .constant('RutHelper', {
    format: formatRut,
    clean: cleanRut,
    validate: function(value) {
      return validateRut(cleanRut(value));
    }
  });
