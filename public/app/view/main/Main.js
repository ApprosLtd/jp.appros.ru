/**
 * This class is the main view for the application. It is specified in app.js as the
 * "autoCreateViewport" property. That setting automatically applies the "viewport"
 * plugin to promote that instance of this class to the body element.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('App.view.main.Main', {
    extend: 'Ext.container.Container',
    requires: [
        'App.view.main.MainController',
        'App.view.main.MainModel',
        'App.model.seller.PricingGrids.PricingGridModel',
        'App.model.seller.PricingGrids.PricingGridColumnModel'
    ],

    xtype: 'app-main',
    
    controller: 'main',
    viewModel: {
        type: 'main'
    },

    layout: {
        type: 'border'
    },

    items: [{
        xtype: 'panel',
        title: 'Панель управления',
        region: 'west',
        html: '<ul><li>This area is commonly used for navigation, for example, using a "tree" component.</li></ul>',
        width: 250,
        minWidth: 200,
        maxWidth: 500,
        split: true,
        collapsible: true,
        collapsed: true,
        tbar: [{
            text: 'Button',
            handler: 'onClickButton'
        }]
    },{
        region: 'center',
        xtype: 'tabpanel',
        items:[
            Ext.create('App.view.seller.Products.MainTab'),
            Ext.create('App.view.seller.PricingGrids.MainTab'),
            Ext.create('App.view.seller.Purchases.MainTab'),
        //    Ext.create('App.view.seller.Catalog.MainTab'),
            Ext.create('App.view.seller.Users.MainTab')
        ]
    }]
});
