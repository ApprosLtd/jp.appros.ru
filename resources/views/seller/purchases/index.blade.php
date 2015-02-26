@extends('seller.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Закупки</div>


                <div class="btn-toolbar" role="toolbar" style="padding: 10px;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProduct">
                        Добавить закупку
                    </button>
                </div>

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
                        @foreach ($items_models_arr as $item_model)
                            <tr>
                                <th scope="row">{{$item_model->id}}</th>
                                <td>{{ $item_model->name }}<div style="font-size: 80%">{{ $item_model->description }}</div></td>
                                <td>{{ $item_model->handler }}</td>
                                <td>{{ $item_model->region }}</td>
                                <td>{{ $item_model->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?= $items_models_arr->render() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Новая закупка</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/seller/purchases/save">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                    <?php
                    $pricing_grids = \App\Models\PricingGrid::getPricingGridsForCurrentUser();
                    ?>
                    <div class="form-group">
                        <label>Ценовая сетка</label>
                        <select class="form-control" name="pricing_grid_id">
                        <option></option>
                        @foreach ($pricing_grids as $pricing_grid)
                            <option value="{{ $pricing_grid->id }}">{{ $pricing_grid->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Колонка ценовой сетки</label>
                        <input class="form-control" name="pricing_grid_column" value="1">
                    </div>
                    <div class="form-group">
                        <label>Срок действия</label>
                        <input class="form-control" name="expiration_time" value="{{{ date('Y-m-d H:i:s', time() + 604800) }}}">
                    </div>


                    <p class="help-block">* - Обязательно для заполнения</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#editProduct form').submit()">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

@endsection