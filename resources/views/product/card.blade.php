@extends('app')

@section('content')
    <?php
    $product_images = $product->media('image')->get();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    {!! \App\Helpers\WidgetHelper::region('center_1') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="col-md-5">
                    <div class="panel panel-default" style="text-align: center">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            @for($im = 1; $im <= ($product_images->count() - 1); $im++)
                                <li data-target="#carousel-example-generic" data-slide-to="{{ $im }}" class=""></li>
                            @endfor
                            </ol>
                            <div class="carousel-inner" role="listbox">
                            @foreach($product_images as $key => $image)
                                <div class="item @if ($key == 0) active @endif">
                                    <img alt="" src="/cdn/images/{{ $image->file_name }}">
                                </div>
                            @endforeach
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-wrapper">
                            <span style="font-size: 27px; line-height: 23px;">{{ $product->name }} <img src="/img/stars_110.png"></span>
                            <h4>{{ $product->attr('brand') }} ({{ $product->attr('country') }})</h4>
                            <p>Объем: {{ $product->attr('weight') }}</p>
                            <p>{{ $product->description }}</p>

                            <div class="alert alert-warning" role="alert" style="margin: 0">
                                <strong>Внимание!</strong> Лучше посмотрите, что-то здесь не в порядке.
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs nav-tabs-modern" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                    Отзывы
                                </a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">
                                    Обсуждения
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                                <div class="comment-item">
                                    <ul class="media-list">
                                        <li class="media">
                                            <a class="media-left" href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Ирина Завалова</h4>
                                                <img src="/img/stars_80.png"> 24 декабря 2014
                                            </div>
                                        </li>
                                    </ul>
                                    <p>
                                        <strong>Достоинства</strong> - Компактный
                                        -Высокая(заявленная) автономность
                                        -Отличный сочный/чёткий FHD экран.
                                        -Отлично ловит LTE и/или WI-FI.
                                        Полноценная W8.1, работает шустро.
                                        Бесплатный Office 365(на 1 планшет + 1 ПК/MAC), активируется на одну учётку.
                                        ИМХО, презентабельный внешний вид.
                                        Нормальный звук через колонки.
                                        Приятный материал задней крышки
                                    </p>
                                    <p>
                                        <strong>Недостатки</strong>
                                        MicroUSB и только 1 :(
                                        Внешнему(пассивному) винту на 1 gb(WD Passport 2,5``) не хватило питания
                                        Зарядка через тот же единственный порт microUSB
                                        Отключил автоподсветку экрана(проблема скорее всего софтовая, жду обновления)
                                    </p>
                                    <p>
                                        <strong>Общие впечатления</strong>
                                        В целом, создаёт приятное впечатление. Сразу докупил кабель OTG(MicroUSB->USB), USB тройник, беспроводную мышь(ес-но Logitech) и конечно 64 GB micro SDXC. Для удалённой работы(например через VPN, в SAP GUI:) - один из лучших вариантов. На использование для игр - не рассчитываю, а как рабочая лошадка - рекомендую.
                                        P.S.: Тоже успел урвать до подорожания(за 26,5)
                                    </p>
                                </div>
                                <div class="comment-item">
                                    <ul class="media-list">
                                        <li class="media">
                                            <a class="media-left" href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Ирина Завалова</h4>
                                                <img src="/img/stars_80.png"> 24 декабря 2014
                                            </div>
                                        </li>
                                    </ul>
                                    <p>
                                        <strong>Достоинства</strong> - Компактный
                                        -Высокая(заявленная) автономность
                                        -Отличный сочный/чёткий FHD экран.
                                        -Отлично ловит LTE и/или WI-FI.
                                        Полноценная W8.1, работает шустро.
                                        Бесплатный Office 365(на 1 планшет + 1 ПК/MAC), активируется на одну учётку.
                                        ИМХО, презентабельный внешний вид.
                                        Нормальный звук через колонки.
                                        Приятный материал задней крышки
                                    </p>
                                    <p>
                                        <strong>Недостатки</strong>
                                        MicroUSB и только 1 :(
                                        Внешнему(пассивному) винту на 1 gb(WD Passport 2,5``) не хватило питания
                                        Зарядка через тот же единственный порт microUSB
                                        Отключил автоподсветку экрана(проблема скорее всего софтовая, жду обновления)
                                    </p>
                                    <p>
                                        <strong>Общие впечатления</strong>
                                        В целом, создаёт приятное впечатление. Сразу докупил кабель OTG(MicroUSB->USB), USB тройник, беспроводную мышь(ес-но Logitech) и конечно 64 GB micro SDXC. Для удалённой работы(например через VPN, в SAP GUI:) - один из лучших вариантов. На использование для игр - не рассчитываю, а как рабочая лошадка - рекомендую.
                                        P.S.: Тоже успел урвать до подорожания(за 26,5)
                                    </p>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                Список обсуждений
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-wrapper">
                            <p><strong>Информация о закупке</strong></p>
                            <p>Целевая сумма: 50 000 руб.</p>
                            <p>Закупка завершена на: 84%</p>

                            <p style="padding: 5px 0">
                                <button class="btn btn-danger">ПРИСОЕДИНИТЬСЯ К ЗАКУПКЕ</button>
                            </p>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Таблица цен</h5>
                                </div>
                                <div class="panel-body" style="padding: 1px">
                                    <table class="table table-bordered table-condensed table-hover" style="margin: 0;">
                                        <thead>
                                            <tr>
                                                <th>Условия закупки</th>
                                                <th style="width: 90px">Цена</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Helpers\PurchaseHelper::getPricingGridMixForProduct($product->id, $purchase->id) as $pricing_grid_mix)
                                            <tr>
                                                <td>{{ $pricing_grid_mix['title'] }}
                                                    <br><span style="font-size: 12px">Крайний срок: {{ $pricing_grid_mix['expiry_date'] }}</span>
                                                    <div class="progress" style="height: 8px; margin: 3px 0 0">
                                                        <div class="progress-bar progress-bar-danger progress-bar-striped"
                                                             role="progressbar" aria-valuenow="84" aria-valuemin="0"
                                                             aria-valuemax="100" style="width: 84%"></div>
                                                    </div>
                                                </td>
                                                <td><h4>{{ $pricing_grid_mix['price'] }}</h4></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p>Срок истечения: 25 марта 2015 в 22.10 </p>
                            <p><a href="/zakupka/23456" class="btn btn-default btn-sm">Подробная информация о <strong>закупке</strong></a></p>

                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Название панели</h5>
                                </div>
                                <div class="panel-body">Содержимое панели</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-wrapper">
                            панель
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
