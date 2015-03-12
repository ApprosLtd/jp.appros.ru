/**
 * Панель "Список ценовых сеток"
 */
Ext.define('App.view.seller.PricingGrids.PricingGridsListGridPanel', {
    extend: 'Ext.grid.Panel',
    //title: 'Ценовые сетки',
    constructor: function() {
        var me = this;

        me.store = Ext.create('App.store.seller.PricingGrids.PricingGridsStore');

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
            flex: 1
        }
    ],
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
