@extends('seller.layout')

@section('content')
    <script>

        angular.module('myApp', []).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
        });

        angular.controller('ProductController', ['$scope', function($scope) {
            $scope.products = [
                {"name": "Nexus S",
                    "snippet": "Fast just got faster with Nexus S."},
                {"name": "Motorola XOOM™ with Wi-Fi",
                    "snippet": "The Next, Next Generation tablet."},
                {"name": "MOTOROLA XOOM™",
                    "snippet": "The Next, Next Generation tablet."}
            ];
        }]);

    </script>
    <div class="container" ng-controller="ProductController">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    {!! \App\Helpers\Widget::region('center_1') !!}

                    <div class="">
                        <table class="table table-condensed table-striped table-hover" style="border-bottom: 1px solid #DDD; border-top: 1px solid #DDD">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Блок</th>
                                <th>Обработчик</th>
                                <th>Регион</th>
                                <th>Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="product in products">
                                    <th scope="row">1</th>
                                    <td>{[{ product.name }]}</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection