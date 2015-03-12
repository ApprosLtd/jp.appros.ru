Ext.define('App.view.seller.PricingGrids.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    items: [
        {
            text: 'Добавить ценовую сетку',
            handler: function(){
                Ext.create('App.view.seller.PricingGrids.PricingGridEditWindow', {
                    title: 'Новая ценовая сетка'
                });

            }
        }
    ]
});