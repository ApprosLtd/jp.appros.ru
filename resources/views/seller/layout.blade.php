<!DOCTYPE html>
<html lang="en" ng-app="mainApp">
<head>
    <meta charset="UTF-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <style>
        body{
            font-family: arial;
            font-size: 13px;
        }
    </style>

    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="/app/app.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>

    <title></title>
</head>
<body ng-controller="MainController">

{!! \App\Helpers\Widget::region('top', 'seller') !!}

@yield('content')

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>



</body>
</html>