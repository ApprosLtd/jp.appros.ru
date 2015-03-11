Ext.define('App.model.seller.Catalog.CatalogListModel', {
    extend: 'Ext.data.TreeModel',
    //alias: 'model.seller.products.productsListModel',
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'text',  type: 'string'}
    ]
});