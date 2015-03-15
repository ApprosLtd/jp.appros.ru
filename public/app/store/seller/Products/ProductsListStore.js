Ext.define('App.store.seller.Products.ProductsListStore', {
    extend: 'Ext.data.Store',
    storeId:'sellerProductsListStore',
    autoLoad: true,
    autoSync: true,
    currentPricingGridId: 0,
    model: 'App.model.seller.Products.ProductsListModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/product'}),
    listeners: {
        beforeload: function(options, eOpts){
            this.getProxy().setExtraParam('pricing_grid_id', this.currentPricingGridId);
        }
    }
});