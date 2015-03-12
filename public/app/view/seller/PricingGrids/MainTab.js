/**
 * Вкладка "Ценовые сетки"
 */
Ext.define('App.view.seller.PricingGrids.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Ценовые сетки',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.view.seller.PricingGrids.TopToolbarPanel', {region: 'north'}),
        Ext.create('App.view.seller.PricingGrids.PricingGridsListGridPanel', {region: 'center'})
    ]
});
