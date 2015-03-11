Ext.define('App.model.seller.Products.ProductsListModel', {
    extend: 'Ext.data.Model',
    //alias: 'model.seller.products.productsListModel',
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'name',  type: 'string'},
        {name: 'cn_link',   type: 'string'}
    ]
});