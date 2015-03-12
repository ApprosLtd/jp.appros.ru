Ext.define('App.store.seller.PricingGrids.PricingGridsListStore', {
    extend: 'Ext.data.Store',
    //storeId:'',
    autoLoad: true,
    autoSync: true,
    model: 'App.model.seller.PricingGrids.PricingGridModel'
});