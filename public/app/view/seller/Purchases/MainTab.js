/**
 * Вкладка "Управление закупками"
 */
Ext.define('App.view.seller.Purchases.MainTab', {
    extend: 'Ext.container.Container',
    title: 'Управление закупками',
    layout: 'border',
    items: [
        Ext.create('App.view.seller.Purchases.TopToolbarPanel', {
            region: 'north'
        }),
        Ext.create('App.tree.Purchase', {
            title: 'Закупки',
            region: 'west',
            split: true,
            rootVisible: false,
            width: 300,
            root: {
                id: 0
            },
            listeners: {
                itemclick: function(self, record, item, index, e, eOpts){
                    var basePanel =Ext.getCmp('purchasesBasePanel');
                    basePanel.removeAll(true);
                    basePanel.add(
                        Ext.create('App.view.seller.Purchases.purchasesWorkArea', {
                            purchasesId: record.getId()
                        })
                    );
                },
                cellcontextmenu: function(el, td, cellIndex, record, tr, rowIndex, e, eOpts){
                    this.contextmenu.record = record;
                    this.contextmenu.showAt(e.getXY());
                    e.stopEvent();
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
