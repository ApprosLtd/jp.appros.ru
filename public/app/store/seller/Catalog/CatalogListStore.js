Ext.define('App.store.seller.Catalog.CatalogListStore', {
    extend: 'Ext.data.TreeStore',
    storeId:'sellerCatalogListStore',
    autoLoad: true,
    autoSync: true,
    //model: 'App.model.seller.Catalog.CatalogListModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/catalog'}),
    root: {
        expanded: true,
        text: 'Каталог товаров',
        id: 1
    },
    listeners: {
        load: function(self, records, successful, eOpts) {
            //
        }
    }
});