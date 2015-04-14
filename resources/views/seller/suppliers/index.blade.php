@extends('seller.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Поставщики</div>

                <div class="panel-body">
                    <div class="btn-toolbar" style="margin-bottom: 10px">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editFormModal">
                            Добавить
                        </button>
                    </div>

                    <div class="row">
                        @foreach ($suppliers_models_arr as $supplier_model)
                        <div class="col-md-4">
                            <div class="panel panel-info">
                                <div class="panel-heading" title="{{ $supplier_model->name }}">{{ str_limit($supplier_model->name, 34, '*') }}</div>
                                <div class="panel-body">
                                    <a href="/seller/suppliers/{{ $supplier_model->id }}">{{ $supplier_model->name }}</a>
                                    <p>{{ str_limit($supplier_model->description, 200, '...') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <?= $suppliers_models_arr->render() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="editFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Новый поставщик</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/seller/suppliers/save">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Наименование*</label>
                        <input name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>


                    <p class="help-block">* - Обязательно для заполнения</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#editFormModal form').submit()">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

@endsection