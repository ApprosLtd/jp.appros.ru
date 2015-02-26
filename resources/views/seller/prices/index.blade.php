@extends('seller.layout')

@section('content')
    <div class="container">
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
                                    <td>2</td>
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

    <script>

        var productModel = function($scope){
            //
        }
    </script>

@endsection