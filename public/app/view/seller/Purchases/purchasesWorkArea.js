Ext.define('App.view.seller.Purchases.PurchasesWorkArea', {
    extend: 'Ext.tab.Panel',
    requires: [
        'App.store.Product'
    ],
    tabPosition: 'bottom',
    border: false,
    constructor: function(config) {
        var me = this;

        Ext.apply(me, {
            //
        }, config);

        var productStore = Ext.data.StoreManager.lookup('storeProduct');
        if (!productStore) {
            productStore = Ext.create('App.store.Product');
        }

        me.items = [{
            title: 'Продукты',
            border: false,
            padding: 4,
            layout: {
                type: 'hbox',
                pack: 'start',
                align: 'stretch'
            },
            items: [
                Ext.create('App.tree.Catalog', {
                    title: 'Каталог',
                    width: 300//,
                    //store: Ext.StoreManager.lookup('treestoreCatalog')
                }),
                {
                    xtype: 'splitter'
                },
                Ext.create('App.grid.Product', {
                    title: 'Продукты',
                    setToolBar: false,
                    xtype: 'checkbox-selection',
                    selType: 'checkboxmodel',
                    flex: 1,
                    store: Ext.StoreManager.lookup('storeProduct'),
                    setToolBar: false,
                    dockedItems: ['->',{
                        xtype: 'toolbar',
                        dock: 'top',
                        items: [{
                            text: 'Добавить выделенные в закупку',
                            handlers: function(){
                                //
                            }
                        }]
                    }]
                }),
                {
                    xtype: 'splitter'
                },
                Ext.create('App.grid.ProductInPurchase', {
                    title: 'Продукты в закупке',
                    setToolBar: false,
                    xtype: 'checkbox-selection',
                    selType: 'checkboxmodel',
                    flex: 1,
                    setToolBar: false,
                    dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top',
                        items: [{
                            text: 'Удалить выделенные',
                            handlers: function(){
                                //
                            }
                        }]
                    }]
                })
            ]
        },{
            title: 'Статистика',
            border: false
        }]

        this.callParent(arguments);
    }
});
