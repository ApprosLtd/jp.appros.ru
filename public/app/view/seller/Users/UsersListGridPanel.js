/**
 * Панель "Список пользователей"
 */
Ext.define('App.view.seller.Users.UsersListGridPanel', {
    extend: 'Ext.grid.Panel',
    id: 'usersListGridPanel',
    title: 'Список пользователей',
    constructor: function(config) {
        var me = this;

        me.store = Ext.create('App.store.seller.Users.UsersListStore');

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
            flex: 1,
            renderer: function(value, metaData, rec){
                return value + ' (<a href="' + rec.get('cn_link') + '" target="_blank">ссылка</a>)';
            }
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
    dockedItems: [{
        xtype: 'pagingtoolbar',
        store: 'sellerProductsListStore',
        dock: 'bottom',
        displayInfo: true
    }],
    listeners: {
        itemdblclick: function(el, record, item, index, e, eOpts){
            var data = record.getData();
            Ext.create('App.view.seller.Products.ProductEditWindow', {
                title: 'Редактирование продукта',
                record: record
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
