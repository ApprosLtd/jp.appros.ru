Ext.define('App.store.seller.Catalog.CatalogListStore', {
    extend: 'Ext.data.TreeStore',
    storeId:'sellerCatalogListStore',
    autoLoad: true,
    autoSync: true,
    //model: 'App.model.seller.Catalog.CatalogListModel',
    proxy: {
        type: 'rest',
        url: '/rest/catalog',
        reader: {
            type: 'json'
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