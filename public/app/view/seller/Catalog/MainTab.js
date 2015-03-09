/**
 * Вкладка "Каталоги"
 */
Ext.define('App.view.seller.Catalog.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Каталоги',
    layout: 'border',
    defaults: {
        border: false
    },
    items: [
        Ext.create('App.view.seller.Catalog.CatalogListTreePanel', {region: 'center'}),
    ]
});
