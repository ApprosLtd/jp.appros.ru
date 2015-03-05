@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                {!! \App\Helpers\Widget::region('center_1') !!}
            </div>
        </div>
        <div class="col-md-3">
            <!--div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Каталог товаров</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Косметика
                          <ul>
                              <li>Для волос</li>
                              <li>Для лица</li>
                              <li>Для тела</li>
                              <li>Для ногтей</li>
                              <li>Для ванны и душа</li>
                              <li>Депиляция</li>
                              <li>Аксессуары</li>
                          </ul>
                        </li>
                        <li>Парфюмерия</li>
                        <li>Подарки</li>
                        <li>Макияж</li>
                        <li>Мама и малыш</li>
                        <li>Бытовая химия</li>
                    </ul>
                </div>
            </div-->

            <h4>Каталог товаров</h4>

            <div class="list-group">
                <a href="#" class="list-group-item active">Косметика</a>
                <a href="#" class="list-group-item">Парфюмерия</a>
                <a href="#" class="list-group-item">Подарки</a>
                <a href="#" class="list-group-item">Макияж</a>
                <a href="#" class="list-group-item">Мама и малыш</a>
                <a href="#" class="list-group-item">Бытовая химия</a>
            </div>
        </div>
        <div class="col-md-9">
            @for($i=0; $i<27; $i++)
                @include('product.list_item')
            @endfor
        </div>
    </div>
@endsection
