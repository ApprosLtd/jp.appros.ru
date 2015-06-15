<?php
/**
 * @var $product_in_purchase \App\Models\ProductInPurchaseModel
 */

?>
<div class="col-sm-6 col-md-3 catalog-item">
    <div class="catalog-item-wrapper">
        <div class="catalog-item-header">
            <a href="{{ $product_in_purchase->alias() }}" title="{{ $product_in_purchase->product->name }}">
                <img alt="" src="/media/images/177x139/{{ $product_in_purchase->getFirstImageFileName() }}">
            </a>
        </div>
        <div class="catalog-item-body">
            <h5 class="title"><a href="{{ $product_in_purchase->alias() }}" title="{{ $product_in_purchase->product->name }}">{{ $product_in_purchase->product->name }}</a></h5>

            <span class="stars-small">

            </span>
            <?php
            $purchase = $product_in_purchase->purchase;
            ?>
            <div class="font-mini catalog-item-info">
                <span class="glyphicon glyphicon-user" title="Продавец" style="color: #00708e"></span> <a href="/seller/{{ $purchase->seller->id }}">{{ $purchase->seller->name }}</a><br>
                <span class="glyphicon glyphicon-piggy-bank" title="Закупка" style="color: #00708e"></span> <a href="/zakupka/{{ $purchase->id }}">{{ $purchase->name }}</a><br>
                Завершено на 84%
                <br>
                Покупателей - 13
            </div>
        </div>
        <div class="catalog-item-footer">
            <span class="glyphicon glyphicon-eye-open"></span> 250
            <span class="glyphicon glyphicon-thumbs-up"></span> 13
            <span class="glyphicon glyphicon-comment"></span> 24
        </div>
    </div>
</div>