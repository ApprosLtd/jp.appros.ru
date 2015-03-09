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
                    }
                }); return;

                var values = baseForm.getValues();

                var store = Ext.data.StoreManager.lookup('sellerCatalogListStore');

                store.add(values);

                store.save();

                //console.log(store.getRecords());
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
            fieldLabel: 'Родитель',
            xtype: 'combobox',
            name: 'parent_id',
            allowBlank: false,
            queryMode: 'local',
            displayField: 'name',
            valueField: 'abbr',
            store: {
                xtype: 'store',
                fields: ['abbr', 'name'],
                data : [
                    {"abbr":"AL", "name":"Alabama"},
                    {"abbr":"AK", "name":"Alaska"},
                    {"abbr":"AZ", "name":"Arizona"}
                ]
            }
        }]
    }
})