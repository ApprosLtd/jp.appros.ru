/**
 * Окно редактирования продукта
 */
Ext.define('App.view.seller.Products.ProductEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование продукта',
    height: 600,
    width: 800,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    items: {
        xtype: 'tabpanel',
        items: [{
            title: 'Главная',
            xtype: 'panel',
            items: {
                xtype: 'form',
                layout: 'fit',
                //height: 500,
                bodyPadding: 5,
                border: false,
                defaults: {
                    //anchor: '100%'
                },
                items: [{
                    fieldLabel: 'First Name',
                    name: 'first',
                    allowBlank: false
                },{
                    fieldLabel: 'Last Name',
                    name: 'last',
                    allowBlank: false
                }]
            }
        },{
            title: 'Атрибуты'
        },{
            title: 'Каталог'
        },{
            title: 'Цены'
        },{
            title: 'Фотогалерея'
        }],
        buttons: [{
            text: 'Reset',
            handler: function() {
                this.up('form').getForm().reset();
            }
        }, {
            text: 'Submit',
            formBind: true, //only enabled once the form is valid
            disabled: true,
            handler: function() {
                var form = this.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        success: function(form, action) {
                            Ext.Msg.alert('Success', action.result.msg);
                        },
                        failure: function(form, action) {
                            Ext.Msg.alert('Failed', action.result.msg);
                        }
                    });
                }
            }
        }]
    }
})