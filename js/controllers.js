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

storeControllers.controller('ShippingCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', function($scope, $routeParams, $http, $filter, ngCart, Data){

    var store = this;

    Data.shippingT1 = 0;
    Data.shippingT2 = 0;

    store.shipping = [];
    $scope.shipping = [];

    store.billing = [];
    $scope.billing = [];

    store.shipping.regiones = [];
    store.billing.regiones = [];
    $scope.shipping.currentRegion = [];
    $scope.billing.currentRegion = [];

    store.shipping.provincias = [];
    store.billing.provincias = [];
    $scope.shipping.currentProvincia = [];
    $scope.billing.currentProvincia = [];

    store.shipping.comunas = [];
    store.billing.comunas = [];
    $scope.shipping.currentComuna = [];
    $scope.billing.currentComuna = [];

    store.ngCart = ngCart;

    $http.get('shopping/index.php/region').success(function(data)
    {
        store.shipping.regiones = data;
        store.billing.regiones = data;
    });

    this.setRegionShipping = function(idRegion)
    {
        $scope.shipping.currentRegion.id = idRegion;
        $http.get('shopping/index.php/provincia/'+$scope.shipping.currentRegion.id).success(function(data)
        {
            store.shipping.provincias = data;
        });
    }
    this.setRegionBilling = function(idRegion)
    {
        $scope.billing.currentRegion.id = idRegion;
        $http.get('shopping/index.php/provincia/'+$scope.billing.currentRegion.id).success(function(data)
        {
            store.billing.provincias = data;
        });
    }

    this.setProvinciaShipping = function(idProvincia)
    {
        $scope.shipping.currentProvincia.id = idProvincia;
        $http.get('shopping/index.php/comuna/'+$scope.shipping.currentProvincia.id).success(function(data)
        {
            store.shipping.comunas = data;
        });
    }

    this.setProvinciaBilling = function(idProvincia)
    {
        $scope.billing.currentProvincia.id = idProvincia;
        $http.get('shopping/index.php/comuna/'+$scope.billing.currentProvincia.id).success(function(data)
        {
            store.billing.comunas = data;
        });
    }

    this.setComunaShipping = function(idComuna)
    {
        $scope.shipping.currentComuna.id = idComuna;
    }

    this.setShipping = function(type) {

        if(type === 0) {
            ngCart.setShipping(Data.shippingT1);
        } else if (type === 1) {
            ngCart.setShipping(Data.shippingT2);
        }
    }

    this.calcChilexpressCost = function(){
        $scope.shipping.currentComuna.id;

        $scope.shipping.shippingT1 = 0;

        angular.forEach(ngCart.getCart().items, function(value, key){

            costo = 0;
            //console.log("comunaID: " + $scope.shipping.currentComuna.id + " itemID: " + value.getId() + " cantidad: " + value.getQuantity());
            $http.get('shopping/index.php/getShippCost/'+$scope.shipping.currentComuna.id+'/'+value.getId()).success(function(data)
            {
                //console.log(data['costo']);
                costo = data['costo'] * value.getQuantity();
                Data.shippingT1 = Data.shippingT1 + costo;
                ngCart.setShipping(Data.shippingT1);
                //console.log($scope.shipping.shippingT1);
            });

        });
    }

    store.Data = Data;

}]);

storeControllers.factory('Data', function(){

    var data = [];

    return data;
});
