/**
 * Панель "Список пользователей"
 */
Ext.define('App.view.seller.Users.UsersListGridPanel', {
    extend: 'Ext.grid.Panel',
    id: 'usersListGridPanel',
    title: 'Список пользователей',
    constructor: function(config) {
        var me = this;

        me.store = Ext.create('App.store.User');

        me.contextmenu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Редактировать',
                handler: function(item, e){
                    var record = this.up('menu').record;
                    var data = record.getData();
                    return;
                }
            },{
                text: 'Удалить',
                handler: function(item, e){
                    me.store.remove(this.up('menu').record);
                }
            }]
        });

        me.dockedItems = [
            Ext.create('Ext.toolbar.Paging', {
                store: me.store,
                dock: 'bottom',
                displayInfo: true
            })
        ],

        this.callParent([config]);
    },
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        })
    ],
    columns: [
        {
            text: 'ID',
            dataIndex: 'id',
            width: 50
        },
        {
            text: 'Имя пользователя',
            dataIndex: 'name',
            flex: 1
        },
        {
            text: 'Email',
            dataIndex: 'email',
            width: 300
        }
    ],
    viewConfig: {
        plugins: {
            ptype: 'gridviewdragdrop',
            dragText: 'Переместите продукт в нужный раздел каталога',
            ddGroup: 'catalog-tree-dg',
            enableDrop: false
        }
    },
    listeners: {
        itemdblclick: function(el, record, item, index, e, eOpts){
            Ext.create('App.view.seller.Users.UserEditWindow', {
                title: 'Редактирование пользователя',
                record: record
            });
        },
        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
            this.contextmenu.record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }

    }
});
