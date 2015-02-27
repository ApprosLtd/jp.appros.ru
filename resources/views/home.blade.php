@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
                {!! \App\Helpers\Widget::region('center_1') !!}
			</div>
		</div>
		<div class="col-md-4">
		    <div class="panel panel-default" style="text-align: center">
			    <img src="http://pi2.lmcdn.ru/img320x461/A/D/AD093EWEAD48_1_v2.jpg" alt="">
			</div>
			<div class="panel panel-default">
                миникартинки
            </div>
		</div>
		<div class="col-md-5">
		    <div class="panel">
                <h2>Олимпийка EUROPA TT</h2>
                <h4>adidas Originals</h4>

                <h1>3 990 руб.</h1>

                <button class="btn btn-success">В КОРЗИНУ</button>
                <p></p>
                <p>
                    Олимпийка от adidas Originals выполнена из текстиля и декорирована тремя полосками на рукавах.
                    Детали: сетчатая подкладка, воротник-стойка, карманы на потайной молнии, эластичные манжеты, застежка на молнию.
                </p>

                <table class="table">
                    <tbody>
                    <tr><th class="product-content__th">Параметры модели</th><td>83-64-92 </td></tr>
                    <tr><th class="product-content__th">Состав</th><td>Хлопок - 52%, Полиэстер - 48% </td></tr>
                    <tr><th class="product-content__th">Материал подкладки</th><td>Полиэстер - 100% </td></tr>
                    <tr><th class="product-content__th">Длина по спинке</th><td>60 см</td></tr>
                    <tr><th class="product-content__th">Длина рукава</th><td>60 см</td></tr>
                    <tr><th class="product-content__th">Цвет</th><td>розовый </td></tr>
                    <tr><th class="product-content__th">Сезон</th><td>Мульти </td></tr>
                    <tr><th class="product-content__th">Коллекция</th><td>Весна-лето </td></tr>
                    <tr><th class="product-content__th">Артикул</th><td itemprop="sku">AD093EWEAD48</td></tr>
                    </tbody>
                </table>

			</div>

            <div class="panel">
                <h3>Отзывы</h3>
                <p>
                    ***** 24 декабря 2014
                    <br>
                    <strong>Достоинства</strong> - Компактный
                    -Высокая(заявленная) автономность
                    -Отличный сочный/чёткий FHD экран.
                    -Отлично ловит LTE и/или WI-FI.
                    Полноценная W8.1, работает шустро.
                    Бесплатный Office 365(на 1 планшет + 1 ПК/MAC), активируется на одну учётку.
                    ИМХО, презентабельный внешний вид.
                    Нормальный звук через колонки.
                    Приятный материал задней крышки
                    <br><strong>Недостатки</strong>
                    MicroUSB и только 1 :(
                    Внешнему(пассивному) винту на 1 gb(WD Passport 2,5``) не хватило питания
                    Зарядка через тот же единственный порт microUSB
                    Отключил автоподсветку экрана(проблема скорее всего софтовая, жду обновления)
                    <br><strong>Общие впечатления</strong>
                    В целом, создаёт приятное впечатление. Сразу докупил кабель OTG(MicroUSB->USB), USB тройник, беспроводную мышь(ес-но Logitech) и конечно 64 GB micro SDXC. Для удалённой работы(например через VPN, в SAP GUI:) - один из лучших вариантов. На использование для игр - не рассчитываю, а как рабочая лошадка - рекомендую.
                    P.S.: Тоже успел урвать до подорожания(за 26,5)
                </p>
            </div>
		</div>
		<div class="col-md-3">
		    <div class="panel panel-default" style="padding: 10px">
                <p>Продавец: <br><a href="#">Хороший магазин товаров</a><br>*****</p>
                <p><strong>Информация о закупке</strong></p>
                <p>Целевая сумма: 50 000 руб.</p>
                <p>Заказано: 46%</p>
                <p>Срок истечения: 25 марта 2015 в 22.10 </p>
                <p><a href="/zakupka/23456" class="btn btn-default btn-sm">Подробная информация о <strong>закупке</strong></a></p>
			</div>
		</div>
        <div class="col-md-12">
            <p>
                Описание товара носит информационный характер и может отличаться от описания,
                представленного в технической документации производителя.
                Рекомендуем при покупке проверять наличие желаемых функций и характеристик.
                Вы можете сообщить о неточности в описании товара — выделите её и нажмите
            </p>
        </div>
	</div>
</div>
@endsection
