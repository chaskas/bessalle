var storeControllers = angular.module('StoreControllers', ['ngCart']);

storeControllers.run(function($rootScope, $location) {

    $rootScope.menuClass = function(page) {
        var current = $location.path().split('/')[1];
        if(current === "detail" || current === "cart" || current === "shipping" || current === "summary" || current === "checkout" || current === "success") current = "shopping";
        if(current === "") current = "home";
        return page === current ? "current-menu-item" : "";
    };

});

storeControllers.controller('ProductHighlightsCtrl', ['$scope', '$routeParams', '$http', '$filter', 'Data', function($scope, $routeParams, $http, $filter, Data){

    var store = this;
    store.products = [];

    $http.get('shopping/index.php/products/highlights').success(function(data) {
        store.products = data;
    });


}]);

storeControllers.controller('ProductListCtrl', ['$scope', '$routeParams', '$http', '$filter', 'Data', '$location', function($scope, $routeParams, $http, $filter, Data, $location){

    var store = this;
    store.products = [];

    $scope.currentCategory = [];

    $scope.highlights = [];

    if (!angular.isDefined($routeParams.categoryId)) {

        $scope.highlights = $location.path().split('/')[2];

        $http.get('shopping/index.php/products/highlights').success(function(data) {
            store.products = data;
        });

    } else {

        $scope.currentCategory.id = $routeParams.categoryId;

        $http.get('shopping/index.php/category/'+$routeParams.categoryId).success(function(data) {
            $scope.currentCategory.name = data.name;
            $scope.currentCategory.id = data.id;
            Data.currentCategory.name = data.name;
            Data.currentCategory.id = data.id;
        });

        $http.get('shopping/index.php/products/'+$scope.currentCategory.id).success(function(data) {
            store.products = data;
        });

    }

    this.hasStock = function (stock) {
        if (stock > 0)
            return true;
        else return false;
    }

    this.getCurrentCategory = function () {

        return Data.currentCategory.name;

    }

    store.Data = Data;

}]);



storeControllers.controller('ProductCtrl', ['$scope', '$routeParams', '$http', '$filter', 'Data', '$log', function($scope, $routeParams, $http, $filter, Data, $log){

    var store = this;
    store.product = [];

    $scope.currentCategory = [];

    if (!angular.isDefined($routeParams.productId))
        $scope.currentProductId = 1;
    else
        $scope.currentProductId = $routeParams.productId;

    $http.get('shopping/index.php/product/'+$routeParams.productId).success(function(data) {
        store.product = data;

        $http.get('shopping/index.php/category/'+data.category_id).success(function(data) {

            Data.currentCategory = [];

            $scope.currentCategory.name = data.name;
            $scope.currentCategory.id = data.id;
            Data.currentCategory.name = data.name;
            Data.currentCategory.id = data.id;
        });

    });

    store.Data = Data;

}]);

storeControllers.controller('CategoryCtrl', ['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', function($scope, $routeParams, $http, $filter, ngCart, Data){

    var store = this;
    store.categories = [];
    $scope.currentCategory = [];

    Data.currentCategory = [];

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

        $http.get('shopping/index.php/category/'+idCategory).success(function(data) {
            $scope.currentCategory.name = data.name;
            $scope.currentCategory.id = data.id;
            Data.currentCategory.name = data.name;
            Data.currentCategory.id = data.id;
        });

    }

    store.Data = Data;

}]);

storeControllers.controller('ShippingCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', '$location', '$timeout', 'RutHelper', function($scope, $routeParams, $http,$filter, ngCart, Data, $location, $timeout, RutHelper){

    var store = this;

    Data.shippingT1 = 0;
    Data.shippingT2 = 0;

    Data.paymentType = -1;
    Data.shippingType = -1;

    Data.carrier = 0;

    store.shipping = [];
    $scope.shipping = [];

    store.billing = [];
    $scope.billing = [];

    // store.shipping.regiones = [];
    // store.billing.regiones = [];
    $scope.shipping.currentRegion = [];
    $scope.billing.currentRegion = [];

    // store.shipping.provincias = [];
    // store.billing.provincias = [];
    $scope.shipping.currentProvincia = [];
    $scope.billing.currentProvincia = [];

    // store.shipping.comunas = [];
    // store.billing.comunas = [];
    $scope.shipping.currentComuna = [];
    $scope.billing.currentComuna = [];

    store.ngCart = ngCart;

    if(angular.isUndefined(Data.billing.regiones)) {
        $http.get('shopping/index.php/region').success(function(data)
        {
            Data.billing.regiones = data;
        });
    }

    if(angular.isUndefined(Data.shipping.regiones)) {
        $http.get('shopping/index.php/region').success(function(data)
        {
            Data.shipping.regiones = data;
        });
    }


    this.setRegionShipping = function(idRegion)
    {
        $scope.shipping.currentRegion.id = idRegion;

        $http.get('shopping/index.php/provincia/'+$scope.shipping.currentRegion.id).success(function(data)
        {
            Data.shipping.provincias = data;
            Data.shipping.comunas = [];
        });


    }
    this.setRegionBilling = function(idRegion)
    {
        $scope.billing.currentRegion.id = idRegion;

        $http.get('shopping/index.php/provincia/'+$scope.billing.currentRegion.id).success(function(data)
        {
            Data.billing.provincias = data;
            Data.billing.comunas = [];
        });

    }

    this.setProvinciaShipping = function(idProvincia)
    {
        $scope.shipping.currentProvincia.id = idProvincia;
        $http.get('shopping/index.php/comuna/'+$scope.shipping.currentProvincia.id).success(function(data)
        {
            Data.shipping.comunas = data;
        });
    }

    this.setProvinciaBilling = function(idProvincia)
    {
        $scope.billing.currentProvincia.id = idProvincia;
        $http.get('shopping/index.php/comuna/'+$scope.billing.currentProvincia.id).success(function(data)
        {
            Data.billing.comunas = data;
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
        } else if (type === 2) {
            Data.carrier = 2;
            ngCart.setShipping(0);
        }
    }

    this.calcShippingCost = function(){

        //$scope.shipping.currentComuna.id;

        //console.log(Data.shipping.comuna.COMUNA_NOMBRE);

        Data.shippingT1 = 0;
        Data.shippingT2 = 0;
        ngCart.setShipping(0);

        Data.carrier = 0;

        $http({
            method: 'POST',
            url: 'shopping/index.php/getShippCost',
            data: JSON.stringify({ comuna: Data.shipping.comuna.COMUNA_ID, items: ngCart.getCart().items, carrier: 1 }),
            headers: {'Content-Type': 'application/json'}
        }).success(function(data){
            Data.shippingT2 = Data.shippingT2 + parseInt(data['costo']);
        });


        $timeout(function(){
            $http({
                method: 'POST',
                url: 'shopping/index.php/getShippCost',
                data: JSON.stringify({ comuna: Data.shipping.comuna.COMUNA_ID, items: ngCart.getCart().items, carrier: 0 }),
                headers: {'Content-Type': 'application/json'}
            }).success(function(data){
                Data.shippingT1 = Data.shippingT1 + parseInt(data['costo']);
            });
        },1000);

    }

    this.getPreviousData = function () {

        //console.log("previous region: " + Data.billing.region);

        $http.get('shopping/index.php/user/'+Data.billing.rut).success(function(data)
        {
            //console.log(data.billing_region);

            Data.billing.rut = data.billing_rut;
            Data.billing.business = data.billing_business;
            Data.billing.name = data.billing_name;
            Data.billing.email = data.billing_email;
            Data.billing.phone = data.billing_phone;

            $scope.billing.currentRegion.id = data.billing_region;
            angular.forEach(Data.billing.regiones, function(value, key) {
                if(data.billing_region == value.REGION_ID){
                    //console.log(value.REGION_NOMBRE + " seleccionado");
                    Data.billing.region = value;
                }
            });

            $http.get('shopping/index.php/provincia/'+data.billing_region).success(function(provincias)
            {
                Data.billing.provincias = provincias;
                $scope.billing.currentProvincia.id = data.billing_provincia;
                angular.forEach(Data.billing.provincias, function(value, key) {
                    if(data.billing_provincia == value.PROVINCIA_ID)
                        Data.billing.provincia = value;
                });
            });

            $http.get('shopping/index.php/comuna/'+data.billing_provincia).success(function(comunas)
            {
                Data.billing.comunas = comunas;
                $scope.billing.currentComuna.id = data.billing_comuna;
                angular.forEach(Data.billing.comunas, function(value, key) {
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
            angular.forEach(Data.shipping.regiones, function(value, key) {
                if(data.shipping_region == value.REGION_ID)
                    Data.shipping.region = value;
            });

            $http.get('shopping/index.php/provincia/'+data.shipping_region).success(function(provincias)
            {
                Data.shipping.provincias = provincias;
                $scope.shipping.currentProvincia.id = data.shipping_provincia;
                angular.forEach(Data.shipping.provincias, function(value, key) {
                    if(data.shipping_provincia == value.PROVINCIA_ID)
                        Data.shipping.provincia = value;
                });
            });

            $http.get('shopping/index.php/comuna/'+data.shipping_provincia).success(function(comunas)
            {
                Data.shipping.comunas = comunas;
                $scope.shipping.currentComuna.id = data.shipping_comuna;
                angular.forEach(Data.shipping.comunas, function(value, key) {
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

        Data.shipping.regiones = Data.billing.regiones;
        Data.shipping.region = Data.billing.region;
        $scope.shipping.currentRegion.id = Data.billing.region.REGION_ID;

        Data.shipping.provincias = Data.billing.provincias;
        Data.shipping.provincia = Data.billing.provincia;
        $scope.shipping.currentProvincia.id = Data.billing.provincia.PROVINCIA_ID;

        Data.shipping.comunas = Data.billing.comunas;
        Data.shipping.comuna = Data.billing.comuna;
        $scope.shipping.currentComuna.id = Data.billing.comuna.COMUNA_ID;

        Data.shipping.address1 = Data.billing.address1;
        Data.shipping.address2 = Data.billing.address2;
    }

    this.isCartEmpty = function () {
        return ngCart.getTotalItems() == 0;
    }

    this.askForShippingInfo = function () {
        $location.path('shipping');
    }

    this.setPaymentType = function (type) {
        if(type === 0)
            Data.paymentType = 0;
        else if (type === 1)
            Data.paymentType = 1;
    }

    this.getPaymentType = function () {
        return Data.paymentType;
    }

    this.proccessCheckout = function () {
        $location.path('checkout');
    }

    this.validCheckoxes = function () {
        if (Data.paymentType > -1 && Data.shippingType > -1)
            return true;
        else
            return false;
    }

    this.back = function () {
        window.history.back();
    }

    store.Data = Data;

}]);

storeControllers.controller('CheckOutCtrl',['$scope', '$routeParams', '$http', '$filter', 'ngCart', 'Data', '$location', function($scope, $routeParams, $http,$filter, ngCart, Data, $location){

    var store = this;

    $http({

        method: 'POST',
        url: 'shopping/index.php/checkout/process',
        data: JSON.stringify({ 'user_rut': Data.billing.rut, 'cart': ngCart.getCart(), 'carrier': Data.carrier, 'paymentType': Data.paymentType }),
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

storeControllers.controller('CostoRendimientoCtrl', ['$scope', '$routeParams', '$http', '$filter', 'Data', function($scope, $routeParams, $http, $filter, Data){

    var performance = [];

    $http.get('shopping/index.php/product/performance').success(function(data)
    {
        performance = data;
    });

    this.calc = function () {

        var clase_v = 0;
        var tipo_v = 0;
        var ancho_v = 0;
        var largo_v = 0;
        var espesor_v = 0;
        var valor = 0;

        $scope.clase_t = "";
        $scope.densidad_t = "";

        if(angular.isDefined($scope.clase) && $scope.clase == 0 && angular.isDefined($scope.tipo) && $scope.tipo == 0) {
            $scope.clase_t = performance[0].clase;
            $scope.densidad_t = "Alta Densidad";
            clase_v = performance[0].clase_v;
            tipo_v = performance[0].tipo_1;
            valor = parseInt(performance[0].valor_1);
        } else if(angular.isDefined($scope.clase) && $scope.clase == 0 && angular.isDefined($scope.tipo) && $scope.tipo == 1) {
            $scope.clase_t = performance[0].clase;
            $scope.densidad_t = "Baja Densidad";
            clase_v = performance[0].clase_v;
            tipo_v = performance[0].tipo_2;
            valor = parseInt(performance[0].valor_2);
        } else if(angular.isDefined($scope.clase) && $scope.clase == 1 && angular.isDefined($scope.tipo) && $scope.tipo == 0) {
            $scope.clase_t = performance[1].clase;
            $scope.densidad_t = "Alta Densidad";
            clase_v = performance[1].clase_v;
            tipo_v = performance[0].tipo_1;
            valor = parseInt(performance[1].valor_1);
        } else if(angular.isDefined($scope.clase) && $scope.clase == 1 && angular.isDefined($scope.tipo) && $scope.tipo == 1) {
            $scope.clase_t = performance[1].clase;
            $scope.densidad_t = "Baja Densidad";
            clase_v = performance[1].clase_v;
            tipo_v = performance[0].tipo_2;
            valor = parseInt(performance[1].valor_2);
        } else if(angular.isDefined($scope.clase) && $scope.clase == 2 && angular.isDefined($scope.tipo) && $scope.tipo == 0) {
            $scope.clase_t = performance[2].clase;
            $scope.densidad_t = "Alta Densidad";
            clase_v = performance[2].clase_v;
            tipo_v = performance[0].tipo_1;
            valor = parseInt(performance[2].valor_2);
        } else if(angular.isDefined($scope.clase) && $scope.clase == 2 && angular.isDefined($scope.tipo) && $scope.tipo == 1) {
            $scope.clase_t = performance[2].clase;
            $scope.densidad_t = "Baja Densidad";
            clase_v = performance[2].clase_v;
            tipo_v = performance[0].tipo_2;
            valor = parseInt(performance[2].valor_2);
        }

        if(angular.isDefined($scope.ancho)) {
            ancho_v = $scope.ancho;
        }
        if(angular.isDefined($scope.largo)) {
            largo_v = $scope.largo;
        }
        if(angular.isDefined($scope.espesor)) {
            espesor_v = $scope.espesor;
        }

        if(angular.isDefined($scope.color) && $scope.color == 1) {
            valor += parseInt(performance[3].clase_v);
        }

        if(angular.isDefined($scope.biodegradable) && $scope.biodegradable == 0) {
            valor += parseInt(performance[4].clase_v);
        }

        var rendimiento = 1000 / (( ancho_v * largo_v / 10) * 2 * espesor_v * tipo_v * clase_v );
        $scope.rendimiento = rendimiento;

        var neto = valor / rendimiento;
        $scope.neto = neto;

        console.log(rendimiento);
        console.log(valor);
        console.log(neto);

    }

}]);

storeControllers.controller('ContactCtrl', ['$scope', '$routeParams', '$http', '$filter', '$location', function($scope, $routeParams, $http, $filter, $location){

    this.send = function() {

        $location.path('contact-process');

        $http({

            method: 'POST',
            url: 'shopping/index.php/send_contact',
            data: JSON.stringify({ 'name': $scope.name, 'business': $scope.business, 'email': $scope.email, 'phone': $scope.phone, 'message': $scope.message }),
            headers: { 'Content-Type': 'application/json' }

        }).success(function(data) {

            $location.path('contact-sent');

        });

    };

}]);

storeControllers.factory('Data', function(){

    var data = [];
    data.shipping = [];
    data.billing = [];
    data.shippingType = [];
    data.paymentType = [];

    return data;
});
