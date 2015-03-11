Ext.define('App.store.seller.Products.ProductsListStore', {
    extend: 'Ext.data.Store',
    storeId:'sellerProductsListStore',
    autoLoad: true,
    autoSync: true,
    model: 'App.model.seller.Products.ProductsListModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/product'})
});