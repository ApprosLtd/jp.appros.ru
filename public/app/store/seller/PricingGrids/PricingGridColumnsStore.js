Ext.define('App.store.seller.PricingGrids.PricingGridColumnsStore', {
    extend: 'Ext.data.Store',
    storeId:'pricingGridColumnsStore',
    autoLoad: true,
    autoSync: true,
    model: 'App.model.seller.PricingGrids.PricingGridColumnModel'
});