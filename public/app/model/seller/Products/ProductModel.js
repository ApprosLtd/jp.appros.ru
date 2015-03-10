Ext.define('App.model.seller.Products.ProductModel', {
    extend: 'Ext.data.Model',
    //alias: 'model.seller.products.productsListModel',
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'name',  type: 'string'},
        {name: 'description',  type: 'string'}
    ],
    proxy: {
        type: 'rest',
        url : '/rest/product'
    }
});