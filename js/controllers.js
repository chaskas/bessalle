var storeControllers = angular.module('StoreControllers', ['ngCart']);

storeControllers.controller('ProductListCtrl', ['$scope', '$routeParams', '$http', '$filter', function($scope, $routeParams, $http, $filter){

    var store = this;
    store.products = [];

    if (!angular.isDefined($routeParams.categoryId))
        $scope.currentCategoryId = 1;
    else 
        $scope.currentCategoryId = $routeParams.categoryId;

    $http.get('shopping/product/'+$scope.currentCategoryId).success(function(data) {
        store.products = data;
    });

}]);

storeControllers.controller('CategoryCtrl', ['$scope', '$routeParams', '$http', '$filter', 'ngCart', function($scope, $routeParams, $http, $filter, ngCart){

    var store = this;
    store.categories = [];
    $scope.currentCategory = [];

    ngCart.setTaxRate(19);
    //ngCart.setShipping(2500); 

    $http.get('shopping/category').success(function(data) {
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