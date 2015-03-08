/**
 * Вкладка "Управление товарами"
 */
Ext.define('App.view.seller.Products.MainTab', {
    extend: 'Ext.container.Container',
    requires: [
        //'App.view.seller.Products.ProductsListController',
        //'App.model.seller.Products.ProductsListModel'
        //'App.store.seller.Products.ProductsListStore'
    ],
    title: 'Товары',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.view.seller.Products.TopToolbarPanel', {region: 'north'}),
        Ext.create('App.view.seller.Products.ProductsListGridPanel', {region: 'center'}),
        Ext.create('App.view.seller.Products.CatalogListTreePanel', {region: 'west'}), // west | east
        Ext.create('App.view.seller.Products.QuickViewFormPanel', {region: 'east'}) // west | east
    ]
});
