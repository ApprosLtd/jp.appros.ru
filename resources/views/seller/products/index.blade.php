@extends('seller.layout')

@section('content')

<?php

$project_id = 1;

$project = \App\Models\ProjectModel::find($project_id);

$categories_models = \App\Helpers\ProjectHelper::getCategoriesByProjectId($project_id);
$pricing_grids_models = \App\Helpers\ProjectHelper::getPricingGridsByProjectId($project_id);

$attributes_group_id = \App\Helpers\ProjectHelper::getDefaultAttributesGroupId();

$attributes = \App\Models\AttributeModel::where('attribute_group_id', '=', $attributes_group_id)->get();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Категории</div>
                <div class="btn-toolbar" role="toolbar" style="padding: 10px;">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editCategory">
                        Добавить категорию
                    </button>
                </div>

                <div class="panel-body">
                    <?php
                    $catalog = \App\Models\CatalogModel::getRootNode()->getDescendants()->toTree();
                    //var_dump(count($catalog));
                    ?>
                    <ul class="list-unstyled">
                        @foreach($catalog as $catalog_item)
                            <li><h5>{{ $catalog_item->name }}</h5>
                                <ul>
                                    @foreach($catalog_item->children as $catalog_sub_item)
                                        <li><a href="#">{{ $catalog_sub_item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Товары</div>

                <div class="pull-right">
                    <div class="pagination pagination-sm" style="margin: 10px 10px 0 0">
                        <!-- pager -->
                    </div>
                </div>

                <div class="btn-toolbar" role="toolbar" style="padding: 10px;">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProduct">
                        Добавить товар
                    </button>
                </div>

                <div class="">
                    <table class="table table-condensed table-striped table-hover" style="border-bottom: 1px solid #DDD; border-top: 1px solid #DDD">
                        <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th style="width: 34px"></th>
                            <th>Товар</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($goods_models_arr as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <th>
                                    <div class="btn-group btn-group-xs">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="openProduct({{ $product->id }}); return false;">Редактировать</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onclick="deleteProduct({{ $product->id }}); return false;">Удалить</a></li>
                                        </ul>
                                    </div>
                                </th>
                                <td><a href="#" onclick="openProduct({{ $product->id }}); return false;">{{ $product->name }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?= $goods_models_arr->render() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
@include('seller.products.modals.edit_product')
@include('seller.products.modals.edit_category')

<!-- Scripts -->
<script>
    function deleteProduct(product_id) {
        if (!confirm('При удалении продукта, будут удалены все связанные с ним данные. Продолжить?')) {
            return;
        }

        $.get('/seller/product/delete/' + product_id, function(){
            window.location = window.location;
        });
    }
    function openProduct(product_id){
        var modal = $('#editProduct');

        $.get('/seller/product/' + product_id, function(data){

            modal.find('[name="id"]').val(data.id);
            modal.find('[name="name"]').val(data.name);
            modal.find('[name="description"]').val(data.description);

            modal.find('[role="attr"]').each(function(){
                if (data.attributes[this.name]) {
                    this.value = data.attributes[this.name];
                }
            });

            $.each(data.categories_ids, function(index, item){
                modal.find('[name="categories_ids"] [value="'+item+'"]').attr('selected', 'selected');
            });

            $.each(data.prices, function(index, item){
                modal.find('[role="pricing_grid"] input[name="col_'+item.column_id+'"]').val(item.price);
            });

            $.each(data.images, function(index, item){
                modal.find('#files').append('<img src="/cdn/images/'+item.file_name+'" alt="" class="img-rounded" style="width:100px; height:100px">');
            });

            modal.modal('show');
        });
    }
    function saveProduct(){
        var modal = $('#editProduct');

        var attributes = {};
        modal.find('[role="attr"]').each(function(){
            attributes[this.name] = this.value;
        });

        var prices = {};
        modal.find('[role="pricing_grid"] input').each(function(){
            prices[this.name] = this.value;
        });

        $.post('/seller/products/save', {
            id: modal.find('[name="id"]').val(),
            name: modal.find('[name="name"]').val(),
            description: modal.find('[name="description"]').val(),
            project_id: '{{ $project_id }}',
            attributes_group_id: '{{ $attributes_group_id }}',
            _token: '{{ csrf_token() }}',
            attributes: attributes,
            categories_ids: modal.find('[name="categories_ids"]').val(),
            prices: prices
        }, function(data){
            modal.modal('hide');
            window.location = window.location;
        });
    }

    $(document).ready(function(){
        $('#editProduct').on('hidden.bs.modal', function (e) {
            var modal = $('#editProduct');
            modal.find('[name="id"]').val('');
            modal.find('[name="name"]').val('');
            modal.find('[name="description"]').val('');
            modal.find('[role="attr"]').val('');
            modal.find('[role="pricing_grid"] input').val('');
            modal.find('#files').html('');
            modal.find('[name="categories_ids"] option').attr('selected', null);
        });

        $('#fileupload')
        .fileupload({
            url: '/seller/media/upload',
            dataType: 'json',
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 5000000, // 5 MB
            disableImageResize: /Android(?!.*Chrome)|Opera/
                    .test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true
        })
        .bind('fileuploadsubmit', function (e, data) {
            data.formData = {
                product_id: $('#editProduct input[name="id"]').val(),
                _token: '{{ csrf_token() }}'
            };
        })
        .bind('fileuploaddone', function (e, data) {
            $('#editProduct #files').append('<img src="'+data.result.file_path+'" alt="" class="img-rounded" style="width:100px; height:100px">');
        })
    });

</script>

@endsection