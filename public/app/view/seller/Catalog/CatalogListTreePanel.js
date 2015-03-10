/**
 * Панель "Дерево каталога"
 */
Ext.define('App.view.seller.Catalog.CatalogListTreePanel', {
    extend: 'Ext.tree.Panel',
    //title: 'Дерево каталога',
    rootVisible: false,
    useArrows: false,
    border: false,
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top',
        items: [{
            text: 'Добавить категорию',
            scale: 'medium',
            handler: function(){

                Ext.create('App.view.seller.Catalog.CatalogEditWindow', {
                    title: 'Новый элемент каталога'
                });

            }
        }]
    }],
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
