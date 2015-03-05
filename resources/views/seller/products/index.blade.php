@extends('seller.layout')

@section('content')

<?php

$project_id = 1;

$project = \App\Models\Project::find($project_id);

$categories_models = \App\Helpers\Project::getCategoriesByProjectId($project_id);
$pricing_grids_models = \App\Helpers\Project::getPricingGridsByProjectId($project_id);

$attributes_group_id = \App\Helpers\Project::getDefaultAttributesGroupId();

$attributes = \App\Models\Attribute::where('attribute_group_id', '=', $attributes_group_id)->get();
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
                    <ul>
                    @foreach ($categories_models as $category_model)
                        <li><a href="#{{ $category_model->id }}">{{ $category_model->name }}</a></li>
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
                            <th>ID</th>
                            <th>Товар</th>
                            <th></th>
                            <th></th>
                            <th style="width: 80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($goods_models_arr as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td><a href="#" onclick="openProduct({{ $product->id }}); return false;">{{ $product->name }}</a></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-danger btn-xs" onclick="deleteProduct({{ $product->id }})">Удалить</button></td>
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

            modal.find('[name="categories_ids"] option').attr('selected', null);
        });

        $('#fileupload').fileupload({
            url: '/seller/media/upload',
            formData: {
                product_id: $('#editProduct input[name="id"]').val(),
                _token: '{{ csrf_token() }}'
            },
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
    });

</script>

<!-- Modal -->
@include('seller.products.modals.edit_product')
@include('seller.products.modals.edit_category')

@endsection