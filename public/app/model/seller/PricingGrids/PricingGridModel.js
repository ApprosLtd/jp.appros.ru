Ext.define('App.model.seller.PricingGrids.PricingGridModel', {
    extend: 'Ext.data.Model',
    entityName: 'pricingGridModel',
    proxy: Ext.create('App.common.proxies.RestProxy', {url: '/rest/pricing-grid'}),
    fields: ['id', 'name'],
    getColumns: function(){
        var me = this;
        var columnsStore = Ext.data.StoreManager.lookup('pricingGridColumnsStore');
        var columnsModels = [];
        columnsStore.each(function(record){
            if (record.get('pricing_grid_id') == me.getId()) {
                columnsModels.push(record);
            }
        });
        return columnsModels;
    }
});