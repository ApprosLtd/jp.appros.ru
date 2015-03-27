<?php namespace App\Http\Controllers;


class CatalogController extends Controller {

    public function getIndex()
    {
        $offset = intval(\Input::get('start', 0));
        $limit = intval(\Input::get('limit', 40));

        $products_in_purchase = \App\Helpers\CatalogHelper::getProducts();

        $products = [];
        foreach ($products_in_purchase as $product) {

            $image_min = '';
            $first_image = $product->media('image')->first();
            if ($first_image) {
                $image_min = $first_image->file_name;
            }

            $products[] = (object) [
                'id' => $product->id,
                'name' => $product->name,
                'image_min' => $image_min,
                'alias' => 'product-' . $product->id,
                'stars' => rand(1,5),
            ];
        }

        return view('catalog.index', ['products' => $products_in_purchase]);
    }

}