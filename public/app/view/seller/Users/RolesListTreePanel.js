/**
 * Панель "Дерево ролей"
 */
Ext.define('App.view.seller.Users.RolesListTreePanel', {
    extend: 'Ext.tree.Panel',
    title: 'Роли',
    width: 300,
    minWidth: 200,
    maxWidth: 500,
    split: true,
    resizable: true,
    collapsible: true,
    rootVisible: true,
    viewConfig: {
        listeners: {
            beforedrop: function(node, data, overModel, dropPosition, dropHandlers) { // dropNode, dragNode, overModel

                if (dropPosition == 'append') {
                    return false;
                }

                var record = data.records[0];
                record.attachToCategory(overModel.getId());

                return false;
            }
        },
        plugins: {
            ptype: 'treeviewdragdrop',
            ddGroup: 'catalog-tree-dg'
        }
    },
    constructor: function() {
        var me = this;

        me.store = Ext.create('App.treestore.Role');

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
        itemclick: function(el, record, item, index, e, eOpts){
            var gridStore = Ext.getCmp('productsListGridPanelView').getStore();
            gridStore.getProxy().setExtraParam('root_category_id', record.getId());
            gridStore.load();
        },
        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
            this.contextmenu.record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }
    }
});
