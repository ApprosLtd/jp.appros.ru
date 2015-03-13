@extends('app')

@section('content')
    <?php
    $product_images = $product->media('image')->get();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 container-wrapper">
                <div class="col-md-8 container-item container-item-shadow">
                    <div class="row">
                        <div class="col-md-5">
                            <div style="text-align: center">
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
                            <div>
                                <div>
                                    <span style="font-size: 27px; line-height: 23px;">{{ $product->name }} <img src="/img/stars_110.png"></span>
                                    <h4>{{ $product->attr('brand') }} ({{ $product->attr('country') }})</h4>
                                    <p>Объем: {{ $product->attr('weight') }}</p>
                                    <p>{{ $product->description }}</p>

                                    <p style="padding: 5px 0">
                                        <button class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span> ПРИСОЕДИНИТЬСЯ К ЗАКУПКЕ</button>
                                    </p>

                                    <div class="alert alert-warning" role="alert" style="margin: 0">
                                        <strong>Внимание!</strong> Лучше посмотрите, что-то здесь не в порядке.
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="background: #373737; padding: 20px 50px; margin: 10px 0; color: #f5f5f9">
                        текст
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="comments-header">
                                <h3>Комментарии и обсуждение (12 сообщений)</h3>
                                <p>Вы должны <a href="#">авторизоваться</a>, что бы оставить сообщение</p>
                            </div>
                            <div class="comments-wrapper">
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                            <div class="media-footer">
                                                <span class="media-start">
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star-empty"></span>
                                                    <span class="glyphicon glyphicon-star-empty"></span>
                                                </span>
                                                <span class="comment-published">24 декабря 2014</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img width="50" height="50" src="http://cs421320.vk.me/v421320600/dd16/L0_MNmRYFCo.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Ирина Завалова</h4>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-footer">
                                <a href="#" class="button button-block button-rounded button-flat-primary" onclick="return false;">показать еще</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 container-item">
                    <div class="sidebar-block">
                        <div class="content-block">
                            <h5 class="content-block-title">Информация о закупке <span class="glyphicon glyphicon-question-sign"></span></h5>

                            <table class="table table-stats table-condensed table-hover">
                                <tr>
                                    <td style="width: 22px"><span class="glyphicon glyphicon-eye-open"></span></td>
                                    <td>Просмотры</td>
                                    <td class="data-value">250</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                                    <td>Рекомендации</td>
                                    <td class="data-value">10</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-comment"></span></td>
                                    <td>Комментарии</td>
                                    <td class="data-value">12</td>
                                </tr>
                            </table>
                        </div>
                        <div class="content-block">
                            <h5 class="content-block-title">Текущее состояние закупки <span class="glyphicon glyphicon-question-sign"></span></h5>

                            <table class="table table-stats table-condensed table-hover">
                                <tr>
                                    <td style="width: 22px"><span class="glyphicon glyphicon-user"></span></td>
                                    <td>Участники</td>
                                    <td class="data-value">34</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-ruble"></span></td>
                                    <td>Целевая сумма, руб.</td>
                                    <td class="data-value">50`000</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-time"></span></td>
                                    <td>Время истечения</td>
                                    <td class="data-value">13.03.2015 13:30</td>
                                </tr>
                            </table>

                        </div>
                        <div class="content-block">
                            <h5 class="content-block-title">Таблица цен <span class="glyphicon glyphicon-question-sign"></span></h5>

                            <table class="table table-stats table-condensed table-hover">
                                <tbody>
                                @foreach(\App\Helpers\PurchaseHelper::getPricingGridMixForProduct($product->id, $purchase->id) as $pricing_grid_mix)
                                    <tr>
                                        <td>
                                            {{ $pricing_grid_mix['title'] }}
                                            <br><span style="font-size: 12px">Срок истечения: {{ $pricing_grid_mix['expiry_date'] }}</span>
                                            <div class="progress" style="height: 8px; margin: 3px 0 0">
                                                <div class="progress-bar progress-bar-danger progress-bar-striped"
                                                     role="progressbar" aria-valuenow="84" aria-valuemin="0"
                                                     aria-valuemax="100" style="width: 84%"></div>
                                            </div>
                                        </td>
                                        <td class="data-value">{{ $pricing_grid_mix['price'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="sidebar-block">
                        <div class="content-block">
                            <h5 class="content-block-title">Информация о закупке <span class="glyphicon glyphicon-question-sign"></span></h5>

                            <table class="table table-stats table-condensed table-hover">
                                <tr>
                                    <td style="width: 22px"><span class="glyphicon glyphicon-eye-open"></span></td>
                                    <td>Просмотры</td>
                                    <td class="data-value">250</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                                    <td>Рекомендации</td>
                                    <td class="data-value">10</td>
                                </tr>
                                <tr>
                                    <td><span class="glyphicon glyphicon-comment"></span></td>
                                    <td>Комментарии</td>
                                    <td class="data-value">12</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
