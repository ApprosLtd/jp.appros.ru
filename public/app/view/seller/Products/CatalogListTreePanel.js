/**
 * Панель "Дерево каталога"
 */
Ext.define('App.view.seller.Products.CatalogListTreePanel', {
    extend: 'Ext.tree.Panel',
    title: 'Дерево каталога',
    width: 300,
    minWidth: 200,
    maxWidth: 500,
    split: true,
    resizable: true,
    collapsible: true,
    rootVisible: false,
    store: Ext.create('App.store.seller.Catalog.CatalogListStore')
});
