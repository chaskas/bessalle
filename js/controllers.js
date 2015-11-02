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

storeControllers.controller('ShippingCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', '$location', '$timeout', function($scope, $routeParams, $http,$filter, ngCart, Data, $location, $timeout){

    var store = this;

    Data.shippingT1 = 0;
    Data.shippingT2 = 0;

    Data.carrier = 0;

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
            Data.carrier = 0;
            ngCart.setShipping(Data.shippingT1);
        } else if (type === 1) {
            Data.carrier = 1;
            ngCart.setShipping(Data.shippingT2);
        }
    }

    this.calcShippingCost = function(){

        $scope.shipping.currentComuna.id;
        $scope.shipping.shippingT1 = 0;
        $scope.shipping.shippingT2 = 0;

        Data.carrier = 0;

        angular.forEach(ngCart.getCart().items, function(value, key){
            costo = 0;
            $http.get('shopping/index.php/getShippCost/'+$scope.shipping.currentComuna.id+'/'+value.getId()+'/1').success(function(data)
            {
                costo = data['costo'] * value.getQuantity();
                Data.shippingT2 = Data.shippingT2 + costo;
                ngCart.setShipping(Data.shippingT2);
            });
        });

        $timeout(function(){
            angular.forEach(ngCart.getCart().items, function(value, key){
                costo = 0;
                $http.get('shopping/index.php/getShippCost/'+$scope.shipping.currentComuna.id+'/'+value.getId()+'/0').success(function(data)
                {
                    costo = data['costo'] * value.getQuantity();
                    Data.shippingT1 = Data.shippingT1 + costo;
                    ngCart.setShipping(Data.shippingT1);
                });
            });
        },1000);



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

            $scope.billing.currentRegion.id = data.billing_region;
            angular.forEach(store.billing.regiones, function(value, key) {
                if(data.billing_region == value.REGION_ID)
                    Data.billing.region = value;
            });

            $http.get('shopping/index.php/provincia/'+data.billing_region).success(function(provincias)
            {
                store.billing.provincias = provincias;
                $scope.billing.currentProvincia.id = data.billing_provincia;
                angular.forEach(store.billing.provincias, function(value, key) {
                    if(data.billing_provincia == value.PROVINCIA_ID)
                        Data.billing.provincia = value;
                });
            });

            $http.get('shopping/index.php/comuna/'+data.billing_provincia).success(function(comunas)
            {
                store.billing.comunas = comunas;
                $scope.billing.currentComuna.id = data.billing_comuna;
                angular.forEach(store.billing.comunas, function(value, key) {
                    if(data.billing_comuna == value.COMUNA_ID)
                        Data.billing.comuna = value;
                });
            });

            Data.billing.address1 = data.billing_address1;
            Data.billing.address2 = data.billing_address2;

            Data.shipping.rut = data.shipping_rut;
            Data.shipping.name = data.shipping_name;
            Data.shipping.email = data.shipping_email;
            Data.shipping.phone = data.shipping_phone;

            $scope.shipping.currentRegion.id = data.shipping_region;
            angular.forEach(store.shipping.regiones, function(value, key) {
                if(data.shipping_region == value.REGION_ID)
                    Data.shipping.region = value;
            });

            $http.get('shopping/index.php/provincia/'+data.shipping_region).success(function(provincias)
            {
                store.shipping.provincias = provincias;
                $scope.shipping.currentProvincia.id = data.shipping_provincia;
                angular.forEach(store.shipping.provincias, function(value, key) {
                    if(data.shipping_provincia == value.PROVINCIA_ID)
                        Data.shipping.provincia = value;
                });
            });

            $http.get('shopping/index.php/comuna/'+data.shipping_provincia).success(function(comunas)
            {
                store.shipping.comunas = comunas;
                $scope.shipping.currentComuna.id = data.shipping_comuna;
                angular.forEach(store.shipping.comunas, function(value, key) {
                    if(data.shipping_comuna == value.COMUNA_ID)
                        Data.shipping.comuna = value;
                });
            });

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


        store.calcShippingCost();
        store.saveUserData();

        $location.path('summary');

    }

    this.sameAsBilling = function(){

        Data.shipping.rut = Data.billing.rut;
        Data.shipping.name = Data.billing.name;
        Data.shipping.email = Data.billing.email;
        Data.shipping.phone = Data.billing.phone;

        Data.shipping.region = Data.billing.region;
        $scope.shipping.currentRegion.id = Data.billing.region.REGION_ID;

        store.shipping.provincias = store.billing.provincias;
        Data.shipping.provincia = Data.billing.provincia;
        $scope.shipping.currentProvincia.id = Data.billing.provincia.PROVINCIA_ID;

        store.shipping.comunas = store.billing.comunas;
        Data.shipping.comuna = Data.billing.comuna;
        $scope.shipping.currentComuna.id = Data.billing.comuna.COMUNA_ID;

        Data.shipping.address1 = Data.billing.address1;
        Data.shipping.address2 = Data.billing.address2;
    }



    store.Data = Data;

}]);

storeControllers.controller('CheckOutCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', '$location', function($scope, $routeParams, $http,$filter, ngCart, Data, $location){

    var store = this;

    $http({

        method: 'POST',
        url: 'shopping/index.php/checkout/process',
        data: JSON.stringify({ 'user_rut': Data.billing.rut, 'cart': ngCart.getCart(), 'carrier': Data.carrier }),
        headers: { 'Content-Type': 'application/json' }

    }).success(function(data) {

        store.ngCart = ngCart;
        ngCart.setShipping(0);
        store.ngCart.empty();
        Data.billing = [];
        Data.shipping = [];

        $location.path('success');

    });

}]);

storeControllers.controller('SuccessCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', '$location', function($scope, $routeParams, $http,$filter, ngCart, Data, $location){



}]);

storeControllers.factory('Data', function(){

    var data = [];
    data.shipping = [];
    data.billing = [];

    return data;
});
