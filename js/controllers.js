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

storeControllers.controller('ShippingCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', function($scope, $routeParams, $http,$filter, ngCart, Data){

    var store = this;

    Data.shippingT1 = 0;
    Data.shippingT2 = 0;

    // Data.shipping = [];
    // Data.billing = [];

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
            $http.get('shopping/index.php/getShippCost/'+$scope.shipping.currentComuna.id+'/'+value.getId()).success(function(data)
            {
                costo = data['costo'] * value.getQuantity();
                Data.shippingT1 = Data.shippingT1 + costo;
                ngCart.setShipping(Data.shippingT1);
            });

        });
    }

    this.getPreviousData = function () {

        //console.log(Data.billing.rut);

        $http.get('shopping/index.php/user/'+Data.billing.rut).success(function(data)
        {
            //console.log(data.billing_region);

            Data.billing.rut = data.billing_rut;
            Data.billing.business = data.billing_business;
            Data.billing.name = data.billing_name;
            Data.billing.email = data.billing_email;
            Data.billing.phone = data.billing_phone;

            // Data.billing.region = Data.billing.region;
            $scope.billing.currentRegion.id = data.billing_region;

            //setRegionBilling(data.billing_region);
            //
            // store.billing.provincias = store.billing.provincias;
            // Data.billing.provincia = Data.billing.provincia;
            // $scope.billing.currentProvincia.id = Data.billing.provincia.PROVINCIA_ID;
            //
            // store.billing.comunas = store.billing.comunas;
            // Data.billing.comuna = Data.billing.comuna;
            // $scope.billing.currentComuna.id = Data.billing.comuna.COMUNA_ID;

            Data.billing.address1 = data.billing_address1;
            Data.billing.address2 = data.billing_address2;

            Data.shipping.rut = data.shipping_rut;
            Data.shipping.name = data.shipping_name;
            Data.shipping.email = data.shipping_email;
            Data.shipping.phone = data.shipping_phone;

            // Data.shipping.region = Data.billing.region;
            // $scope.shipping.currentRegion.id = Data.shipping.region.REGION_ID;
            //
            // store.shipping.provincias = store.billing.provincias;
            // Data.shipping.provincia = Data.billing.provincia;
            // $scope.billing.currentProvincia.id = Data.shipping.provincia.PROVINCIA_ID;
            //
            // store.shipping.comunas = store.billing.comunas;
            // Data.shipping.comuna = Data.billing.comuna;
            // $scope.shipping.currentComuna.id = Data.shipping.comuna.COMUNA_ID;

            Data.shipping.address1 = data.shipping_address1;
            Data.shipping.address2 = data.shipping_address2;

        });
    }

    this.saveUserData = function () {

        var billing = Data.billing;
        var shipping = Data.shipping;

        //console.log(billing);

        $http({
            method: 'POST',
            url: 'shopping/index.php/user/add',
            data: JSON.stringify({ billing: { "rut": billing.rut, "business": billing.business, "name": billing.name, "email": billing.email, "phone": billing.phone, "region": billing.region.REGION_ID, "provincia": billing.provincia.PROVINCIA_ID, "comuna": billing.comuna.COMUNA_ID, "address1": billing.address1, "address2": billing.address2 }, shipping: { "rut": shipping.rut, "name": shipping.name, "email": shipping.email, "phone": shipping.phone, "region": shipping.region.REGION_ID, "provincia": shipping.provincia.PROVINCIA_ID, "comuna": shipping.comuna.COMUNA_ID, "address1": shipping.address1, "address2": shipping.address2 } }),
            headers: {'Content-Type': 'application/json'}
        }).success(function(data){
            //console.log(data);
        });

    }

    this.processShipping = function () {

        store.calcChilexpressCost();

        store.saveUserData();

    }

    this.sameAsBilling = function(){

        Data.shipping.rut = Data.billing.rut;
        Data.shipping.name = Data.billing.name;
        Data.shipping.email = Data.billing.email;
        Data.shipping.phone = Data.billing.phone;

        Data.shipping.region = Data.billing.region;
        $scope.shipping.currentRegion.id = Data.shipping.region.REGION_ID;

        store.shipping.provincias = store.billing.provincias;
        Data.shipping.provincia = Data.billing.provincia;
        $scope.billing.currentProvincia.id = Data.shipping.provincia.PROVINCIA_ID;

        store.shipping.comunas = store.billing.comunas;
        Data.shipping.comuna = Data.billing.comuna;
        $scope.shipping.currentComuna.id = Data.shipping.comuna.COMUNA_ID;

        Data.shipping.address1 = Data.billing.address1;
        Data.shipping.address2 = Data.billing.address2;
    }



    store.Data = Data;

}]);

storeControllers.factory('Data', function(){

    var data = [];
    data.shipping = [];
    data.billing = [];

    return data;
});
