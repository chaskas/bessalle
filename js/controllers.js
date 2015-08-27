var storeControllers = angular.module('StoreControllers', ['ngCart']);

storeControllers.controller('ProductListCtrl', ['$scope', '$routeParams', '$http', '$filter', function($scope, $routeParams, $http, $filter){

    var store = this;
    store.products = [];

    if (!angular.isDefined($routeParams.categoryId))
        $scope.currentCategoryId = 1;
    else
        $scope.currentCategoryId = $routeParams.categoryId;

    $http.get('shopping/index.php/product/'+$scope.currentCategoryId).success(function(data) {
        store.products = data;
    });

}]);

storeControllers.controller('CategoryCtrl', ['$scope', '$routeParams', '$http', '$filter', 'ngCart', function($scope, $routeParams, $http, $filter, ngCart){

    var store = this;
    store.categories = [];
    $scope.currentCategory = [];

    ngCart.setTaxRate(19);
    //ngCart.setShipping(2500);

    $http.get('shopping/index.php/category').success(function(data) {
        store.categories = data;
    });

    if (!angular.isDefined($routeParams.categoryId))
    {    $scope.currentCategory.id = 1; }
    else
    {    $scope.currentCategory.id = $routeParams.categoryId; }

    this.isSelected = function(idCategory){
        return $scope.currentCategory.id == idCategory;
    };

    this.setCategory = function(idCategory){
        $scope.currentCategory.id = idCategory;
    }

}]);

storeControllers.controller('ShippingCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', function($scope, $routeParams, $http, $filter, ngCart){

    var store = this;

    store.regiones = [];
    $scope.currentRegion = [];

    store.provincias = [];
    $scope.currentProvincia = [];

    store.comunas = [];
    $scope.currentComuna = [];

    store.ngCart = ngCart;

    store.shippingT1 = 4500;
    store.shippingT2 = 2000;

    $http.get('shopping/index.php/region').success(function(data)
    {
        store.regiones = data;
    });

    this.setRegion = function(idRegion)
    {
        $scope.currentRegion.id = idRegion;
        $http.get('shopping/index.php/provincia/'+$scope.currentRegion.id).success(function(data)
        {
            store.provincias = data;
        });
    }

    this.setProvincia = function(idProvincia)
    {
        $scope.currentProvincia.id = idProvincia;
        $http.get('shopping/index.php/comuna/'+$scope.currentProvincia.id).success(function(data)
        {
            store.comunas = data;
        });
    }

    this.setShipping = function(type) {

        if(type === 0) {
            ngCart.setShipping(store.shippingT1);
        } else if (type === 1) {
            ngCart.setShipping(store.shippingT2);
        }
    }

}]);
