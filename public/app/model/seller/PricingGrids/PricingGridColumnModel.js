Ext.define('App.model.seller.PricingGrids.PricingGridColumnModel', {
    extend: 'Ext.data.Model',
    entityName: 'pricingGridColumnModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/pricing-grid-column'}),
    fields: ['id', 'column_title', 'min_sum', 'min_sum_inclusive', 'max_sum', 'max_sum_inclusive', 'pricing_grid_id']
});