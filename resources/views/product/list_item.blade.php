<?php
/**
 * @var $product_in_purchase \App\Models\ProductsInPurchaseModel
 */

?>
<div class="col-sm-6 col-md-3 catalog-item">
    <div class="catalog-item-wrapper">
        <div class="catalog-item-header">
            <img alt="" src="/media/images/177x139/{{ $product_in_purchase->getFirstImageFileName() }}">
        </div>
        <div class="catalog-item-body">
            <h5 class="title"><a href="{{ $product_in_purchase->alias() }}" title="{{ $product_in_purchase->product->name }}">{{ $product_in_purchase->product->name }}</a></h5>

        <span class="stars-small">

        </span>

            <div class="font-mini catalog-item-info">Завершено на 84%<br>Покупателей - 13</div>
        </div>
        <div class="catalog-item-footer">
            <span class="glyphicon glyphicon-eye-open"></span> 250
            <span class="glyphicon glyphicon-thumbs-up"></span> 13
            <span class="glyphicon glyphicon-comment"></span> 24
        </div>
    </div>
</div>