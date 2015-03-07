/**
 * Вкладка "Управление товарами"
 */
Ext.define('App.view.seller.Products.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Управление товарами',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.view.seller.Products.ProductsListToolbarPanel', {region: 'north'}),
        Ext.create('App.view.seller.Products.ProductsListGridPanel', {region: 'center'}),
        Ext.create('App.view.seller.Products.CatalogListTreePanel', {region: 'west'}), // west | east
        Ext.create('App.view.seller.Products.QuickViewFormPanel', {region: 'east'}) // west | east
    ]
});
