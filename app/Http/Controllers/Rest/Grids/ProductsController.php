<?php namespace App\Http\Controllers\Rest\Grids;


class ProductsController
{

    public function index($options)
    {
        $columns = [
            [
                'label'=> 'ID',
                'property'=> 'id',
                'sortable'=> true,
                'width' => 70
            ],
            [
                'label'=> 'Наименование',
                'property'=> 'name',
                'sortable'=> true
            ]
        ];

        $page_size = 10;
        if (array_key_exists('pageSize', $options)) {
            $page_size = intval($options['pageSize']);
        }

        $page_index = 0;
        if (array_key_exists('pageIndex', $options)) {
            $page_index = intval($options['pageIndex']);
        }

        $items = \App\Models\ProductModel::take($page_size)->offset($page_index * $page_size);

        $count = \App\Models\ProductModel::count();

        $items = $items->get()->toArray();

        $pages = ceil($count / $page_size);

        return [
            'count' => $count,
            //'start' => 4,
            //'end' => 10,
            'page' => $page_index,
            'pages' => $pages,
            'items' => $items,
            'options' => $options,
            'columns' => $columns
        ];
    }

}