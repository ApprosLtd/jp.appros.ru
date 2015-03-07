Ext.define('App.model.seller.Products.ProductsListModel', {
    extend: 'Ext.data.Model',
    //alias: 'model.seller.products.productsListModel',
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'firstName',  type: 'string'},
        {name: 'age',   type: 'int'}
    ]
});