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
  /*  constructor: function() {
        this.callParent(arguments);
    },*/
    contextmenu: Ext.create('Ext.menu.Menu', {
        contextmenu_record: 0,
        items: [{
            text: 'Редактировать',
            handler: function(item, e){
                var record = this.up('menu').contextmenu_record;
                var data = record.getData();
                Ext.create('App.view.seller.Catalog.CatalogEditWindow', {
                    title: 'Редактирование элемента каталога',
                    fields: {
                        id: data.id,
                        name: data.text,
                        parent_id: data.parentId
                    }
                });
            }
        },{
            text: 'Удалить',
            handler: function(item, e){
                var record = this.up('menu').contextmenu_record;
                //var store = Ext.data.StoreManager.lookup('sellerCatalogListStore');
                var store = this.up('menu');
                console.log(store); return;
                //store.beginUpdate();
                store.remove(record);
                //store.endUpdate();
                //store.sync();
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
