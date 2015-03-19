/**
 * Панель "Дерево ролей"
 */
Ext.define('App.view.seller.Users.RolesListTreePanel', {
    extend: 'Ext.tree.Panel',
    id: 'mainRolesListTreePanel',
    title: 'Роли',
    width: 300,
    minWidth: 200,
    maxWidth: 500,
    split: true,
    resizable: true,
    collapsible: true,
    rootVisible: true,
    root: {
        expanded: true,
        text: 'Все роли'
    },
    editWindowClass: 'App.view.seller.Users.RoleEditWindow',
    createEditWindow: function(title, record){
        if (!this.editWindowClass) {
            return;
        }
        Ext.create(this.editWindowClass, {
            title: title,
            record: record,
            store: this.store
        });
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
                    var self = this;
                    Ext.MessageBox.confirm('Удаление', 'Будут удалены все связанные с записью данные. Продолжить?', function(btn, text){
                        if (btn == 'yes') {
                            me.getRootNode().removeChild(self.up('menu').record);
                        }
                    });
                }
            }]
        });

        this.callParent(arguments);
    },
    listeners: {
        itemdblclick: function(el, record, item, index, e, eOpts){
            this.createEditWindow('Редактирование роли', record);
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
