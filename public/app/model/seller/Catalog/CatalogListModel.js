Ext.define('App.model.seller.Catalog.CatalogListModel', {
    extend: 'Ext.data.Model',
    //alias: 'model.seller.products.productsListModel',
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'firstName',  type: 'string'},
        {name: 'age',   type: 'int'}
    ]
});