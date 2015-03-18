Ext.define('App.view.seller.Purchases.purchasesWorkArea', {
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
                Ext.create('App.grid.Product', {
                    title: 'Продукты',
                    setToolBar: false,
                    store: Ext.data.StoreManager.lookup('storeProduct'),
                    flex: 1
                }),
                {
                    xtype: 'splitter'
                },
                Ext.create('App.grid.ProductInPurchase', {
                    title: 'Продукты в закупке',
                    setToolBar: false,
                    flex: 1
                })
            ]
        },{
            title: 'Статистика',
            border: false
        }]

        this.callParent(arguments);
    }
});
