Ext.define('App.view.seller.Purchases.TopToolbarPanel', {
    extend: 'Ext.toolbar.Toolbar',
    defaults: {
        scale: 'medium'
    },
    getProductsListGridPanelView: function(){
        var me = this;

        if (!me.productsListGridPanelView) {
            me.productsListGridPanelView = Ext.getCmp('productsListGridPanelView');
        }

        return me.productsListGridPanelView;
    },
    constructor: function(config) {
        var me = this;

        me.items = [
            {
                text: 'Создать папку закупок',
                scale: 'medium',
                handler: function(){
                    var store = Ext.StoreManager.lookup('treestorePurchase');

                    store.getRootNode().appendChild({
                        text: 'Новая папка',
                        name: 'Новая папка',
                        leaf: true
                    });
                }
            },
            {
                text: 'Создать закупку',
                scale: 'medium',
                handler: function(){
                    Ext.create('App.view.seller.Purchases.PurchasesEditWindow', {
                        title: 'Новая закупка',
                        storeName: 'treestorePurchase'
                    });
                }
            }
        ];

        this.callParent([config]);
    }

});