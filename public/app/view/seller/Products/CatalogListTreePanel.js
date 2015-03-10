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
    store: Ext.create('App.store.seller.Catalog.CatalogListStore'),
    listeners: {
        itemdblclick: function(el, record, item, index, e, eOpts){
            var data = record.getData();

            Ext.create('App.view.seller.Catalog.CatalogEditWindow', {
                title: 'Новый элемент каталога',
                fields: {
                    id: data.id,
                    name: data.text,
                    parent_id: data.parentId
                }
            });
        }
    }
});
