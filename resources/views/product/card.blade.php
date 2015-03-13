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
                                <!--div id="carousel-images-gallery" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-images-gallery" data-slide-to="0" class="active"></li>
                                        @for($im = 1; $im <= ($product_images->count() - 1); $im++)
                                            <li data-target="#carousel-images-gallery" data-slide-to="{{ $im }}" class=""></li>
                                        @endfor
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        @foreach($product_images as $key => $image)
                                            <div class="item @if ($key == 0) active @endif">
                                                <img alt="" src="/cdn/images/{{ $image->file_name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="left carousel-control" href="#carousel-images-gallery" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-images-gallery" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div-->
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div>
                                <div style="padding: 20px 20px 10px 10px">
                                    <span style="font-size: 27px; line-height: 23px;">{{ $product->name }}</span>
                                    <p>
                                        <span class="product-stars">
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        </span>
                                    </p>
                                    <h4><a href="#">{{ $product->attr('brand') }}</a> ({{ $product->attr('country') }})</h4>
                                    <p>Объем: {{ $product->attr('weight') }}</p>
                                    <p class="truncate" style="height: 110px">{{ $product->description }}</p>

                                    <div class="row" style="margin: 5px 0 10px">
                                        <div class="col-md-4">
                                            <a href="#" class="button button-rounded button-flat button-small">подробнее</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#"><span class="glyphicon glyphicon-paperclip"></span> в избранное</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#"><span class="glyphicon glyphicon-duplicate"></span> к сравнению</a>
                                        </div>
                                    </div>

                                    <div class="row" style="margin: 20px 0 30px; color: #B6B6B6">
                                        <div class="col-md-4">
                                            <span class="glyphicon glyphicon-eye-open"></span> Просмотры: 30
                                        </div>
                                        <div class="col-md-4">
                                            <span class="glyphicon glyphicon-thumbs-up"></span> Рекомендации: 5
                                        </div>
                                        <div class="col-md-4">
                                            <span class="glyphicon glyphicon-comment"></span> Комментарии: 12
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6" style="text-align: center">
                                            <div style="font-size: 35px; padding: 0; line-height: 34px;">
                                                от 560,00
                                                <sup style="font-size: 20px"><span class="glyphicon glyphicon-ruble" title="Рублей"></span></sup>
                                            </div>
                                            <a href="#" style="font-size: 12px; color: #DB3232;">как формируются цены?</a>
                                        </div>
                                        <div class="col-md-6" style="text-align: right">
                                            <button class="button button-rounded button-flat-caution" style="padding: 2px 12px;">
                                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                                ДОБАВИТЬ В КОРЗИНУ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="middle-block">
                                <div id="carousel-similar-offers" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <ul class="media-list media-slider item active">
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="media-list media-slider item">
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla.
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-similar-offers" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-similar-offers" data-slide-to="1" class=""></li>
                                    </ol>
                                    <a class="left carousel-control" href="#carousel-similar-offers" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-similar-offers" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
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
                                                <span class="comment-stars">
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
                                <a href="#" class="button button-block button-rounded button-flat" onclick="return false;">показать еще</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 container-item">
                    <div class="sidebar-block">
                        <div class="content-block">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong>Как работать с закупками?</strong><br>
                                Если Вы впервые совершаете совместную покупку и не знакомы с процессом заказа, то рекомендуем
                                <br><a href="#">ознакомиться с документацией</a>.
                            </div>
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
                            <h5 class="content-block-title">
                                Текущее состояние закупки
                                <span class="glyphicon glyphicon-question-sign" data-container="body" data-toggle="popover" data-placement="left" data-content="Справочная информация, описывающая раздел.<a href=&#34;#&#34; onclick=&#34;alert('hello');&#34;>ссылка</a>" title="Текущее состояние закупки"></span>
                            </h5>

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
                        <div class="content-block">
                            <a href="#" class="button button-rounded button-flat button-small"><span class="glyphicon glyphicon-link"></span> Перейти к закупке</a>
                            <!--p><span class="glyphicon glyphicon-link"></span> <a href="#">http://exsemple.com/product-10</a></p-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            //$('.carousel').carousel();

            $('[data-toggle="popover"]').popover({html : true});
        })
    </script>
@endsection
