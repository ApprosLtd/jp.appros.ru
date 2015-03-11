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
    rootVisible: true,
    viewConfig: {
        plugins: {
            ptype: 'treeviewdragdrop'
        }
    },
    contextmenu: Ext.create('Ext.menu.Menu', {
        contextmenu_record: 0,
        items: [{
            text: 'Редактировать',
            handler: function(item, e){
                var record = this.up('menu').contextmenu_record;
                //
            }
        },{
            text: 'Удалить',
            handler: function(item, e){
                var record = this.up('menu').contextmenu_record;
                var store = Ext.data.StoreManager.lookup('sellerCatalogListStore');
                store.remove(record);
                store.save();
            }
        }]
    }),
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
            e.stopEvent();
        },
        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
            this.contextmenu.contextmenu_record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }

    }
});
