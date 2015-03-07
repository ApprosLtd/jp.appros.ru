Ext.define('App.store.seller.Products.ProductsListStore', {
    extend: 'Ext.data.Store',
    storeId:'sellerProductsListStore',
    autoLoad: true,
    autoSync: true,
    model: 'App.model.seller.Products.ProductsListModel',
    proxy: {
        type: 'rest',
        url: '/rest/products-list',
        reader: {
            type: 'json',
            rootProperty: 'data'
        },
        writer: {
            type: 'json'
        }
    },
    listeners: {
        load: function(self, records, successful, eOpts) {
            //
        }
    }
});