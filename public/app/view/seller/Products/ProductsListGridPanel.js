/**
 * Панель "Список товаров"
 */
Ext.define('App.view.seller.Products.ProductsListGridPanel', {
    extend: 'Ext.grid.Panel',
    xtype: 'locking-grid',
    title: 'Список товаров',
    constructor: function() {
        var me = this;

        me.store = Ext.create('App.store.seller.Products.ProductsListStore');

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

        this.callParent(arguments);
    },
    columns: [
        {
            text: 'Наименование',
            dataIndex: 'name',
            locked: true,
            width: 500,
            //flex: 1,
            renderer: function(value, metaData, rec){
                return value + ' (<a href="' + rec.get('cn_link') + '" target="_blank">ссылка</a>)';
            }
        },
        {
            text: 'Наименование1',
            locked: false,
            dataIndex: 'name'
        },
        {
            text: 'Наименование2',
            locked: false,
            dataIndex: 'name'
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
            //
            e.stopEvent();
        },
        cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
            this.contextmenu.record = record;
            this.contextmenu.showAt(e.getXY());
            e.stopEvent();
        }

    }
});
