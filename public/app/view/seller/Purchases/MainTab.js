/**
 * Вкладка "Управление закупками"
 */
Ext.define('App.view.seller.Purchases.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Управление закупками',
    layout: 'border',
    items: [
        Ext.create('App.tree.Purchase', {
            title: 'Закупки',
            region: 'west',
            split: true,
            rootVisible: false,
            width: 300,
            listeners: {
                itemclick: function(self, record, item, index, e, eOpts){
                    var basePanel =Ext.getCmp('purchasesBasePanel');
                    basePanel.removeAll(true);
                    basePanel.add(
                        Ext.create('App.view.seller.Purchases.purchasesWorkArea', {
                            purchasesId: record.getId()
                        })
                    );
                }
            }
        }),
        Ext.create('Ext.panel.Panel', {
            id: 'purchasesBasePanel',
            region: 'center',
            layout: 'fit',
            border: false
        })
    ]
});
