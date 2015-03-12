Ext.define('App.model.seller.Products.ProductModel', {
    extend: 'Ext.data.Model',
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