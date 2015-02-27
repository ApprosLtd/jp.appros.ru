var mainApp = angular.module('mainApp',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});
mainApp.controller('MainController', ['$scope', '$location', function($scope, $location) {
    //
}]);
mainApp.controller('ProductTableController', ['$scope', '$location', function($scope, $location) {

    //$location.path('/newValue');

    $scope.alertData = function(product){
        console.log(product);
    }

    $scope.products = [{
        id: 1,
        name: 'Hello 1'
    },{
        id: 2,
        name: 'Hello 2'
    }
    ];
}]);
