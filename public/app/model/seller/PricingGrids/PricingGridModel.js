Ext.define('App.model.seller.PricingGrids.PricingGridModel', {
    extend: 'Ext.data.Model',
    entityName: 'pricingGridModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/pricing-grid'}),
    fields: [
        {name: 'id',  type: 'int'},
        {name: 'name',  type: 'string'}
    ],
    hasMany: 'pricingGridColumnModel'
});