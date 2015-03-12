Ext.define('App.store.seller.PricingGrids.PricingGridsStore', {
    extend: 'Ext.data.Store',
    storeId:'pricingGridsStore',
    autoLoad: true,
    autoSync: true,
    model: 'App.model.seller.PricingGrids.PricingGridModel'
});