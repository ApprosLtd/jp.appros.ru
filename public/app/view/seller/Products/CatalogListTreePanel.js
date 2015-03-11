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
        listeners: {
            beforedrop: function(nodeEl, data) { // dropNode, dragNode, overModel

                var record = data.records[0];

                if (record.store !== this.getStore()) {
                    // Record from the grid. Take a copy ourselves
                    // because the built-in copying messes it up.
                    var copy = {children: []};

                    console.log(record);
                    /*
                    record.fields.each(function(field) {
                        copy[field.name] = record.get(field.name);
                    }); */

                    data.records = [copy];

                    // Remove the record from the grid
                    //record.store.remove(record);
                }

                return true;
            }
        },
        plugins: {
            ptype: 'treeviewdragdrop',
            ddGroup: 'catalog-tree-dg'
        }
    },
    constructor: function() {
        var me = this;

        me.store = Ext.create('App.store.seller.Catalog.CatalogListStore');

        me.contextmenu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Редактировать',
                handler: function(item, e){
                    var record = this.up('menu').record;
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
                    var record = this.up('menu').record;
                    me.getRootNode().removeChild(this.up('menu').record);
                }
            }]
        });

        this.callParent(arguments);
    },
    //store: Ext.create('App.store.seller.Catalog.CatalogListStore'),
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
            this.contextmenu.record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }

    }
});
