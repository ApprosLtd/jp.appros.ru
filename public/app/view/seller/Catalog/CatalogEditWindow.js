/**
 * Окно редактирования каталога
 */
Ext.define('App.view.seller.Catalog.CatalogEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование элемента каталога',
    //height: 300,
    width: 500,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    dockedItems: [{
        dock: 'bottom',
        xtype: 'toolbar',
        items: ['->', {
            xtype: 'button',
            text: 'Сохранить',
            handler: function(){
                var baseForm = Ext.getCmp('catalogEditWindowBaseForm');
                baseForm.submit({
                    url: '/rest/catalog',
                    params: {
                        _token: __TOKEN__
                    },
                    success: function(form, action){
                        this.up('window').destroy();
                    },
                    failure: function(form, action) {}
                });
            }
        },{
            xtype: 'button',
            text: 'Сохранить и создать новый'
        },{
            xtype: 'button',
            text: 'Отмена',
            handler: function(){
                this.up('window').destroy();
            }
        }]
    }],
    items: {
        xtype: 'form',
        id: 'catalogEditWindowBaseForm',
        layout: 'anchor',
        bodyPadding: 5,
        border: false,
        defaults: {
            anchor: '100%'
        },
        items: [{
            fieldLabel: 'Наименование',
            xtype: 'textfield',
            name: 'name',
            allowBlank: false
        },{
            xtype: 'hidden',
            name: 'parent_id',
            allowBlank: true
        },
        {
            fieldLabel: 'Родитель',
            xtype: 'treepanel',
            name: 'parent_id',
            height: 200,
            rootVisible: false,
            //store: Ext.data.StoreManager.lookup('sellerCatalogListStore'),
            store: Ext.create('App.store.seller.Catalog.CatalogListStore'),
            listeners: {
                select: function(el, record){
                    var baseForm = Ext.getCmp('catalogEditWindowBaseForm').getForm();
                    baseForm.setValues({
                        parent_id: record.getData().id
                    });
                }
            }
        }]
    }
})