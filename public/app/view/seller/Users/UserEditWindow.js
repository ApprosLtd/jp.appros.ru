/**
 * Окно редактирования пользователя
 */
Ext.define('App.view.seller.Users.UserEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование пользователя',
    height: 400,
    width: 600,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    setFieldsData: function(record){
        if (!record) {
            return;
        }
        var me = this;
        me.productId = record.getId();
    },
    constructor: function(config) {
        var me = this;

        me.setFieldsData(config.record);

        me.baseForm = Ext.create('Ext.form.Panel', {
            layout: 'anchor',
            bodyPadding: 5,
            border: false,
            defaults: {
                anchor: '100%'
            },
            items: [{
                xtype: 'hidden',
                name: 'id'
            },{
                fieldLabel: 'Имя',
                xtype: 'textfield',
                name: 'name',
                allowBlank: false
            },{
                fieldLabel: 'Email',
                xtype: 'textfield',
                name: 'email',
                allowBlank: false
            },{
                fieldLabel: 'Пароль',
                xtype: 'textfield',
                name: 'password',
                allowBlank: false
            }]
        });

        me.items = {
            xtype: 'tabpanel',
            border: false,
            defaults: {
                border: false,
                layout: 'fit'
            },
            items: [{
                title: 'Главная',
                xtype: 'panel',
                items: me.baseForm
            },{
                title: 'Роли',
                items: {
                    //
                }
            }]
        };

        me.dockedItems = [{
            dock: 'bottom',
            xtype: 'toolbar',
            items: ['->', {
                xtype: 'button',
                text: 'Сохранить',
                handler: function(){
                    var fields = me.baseForm.getValues();
                    var upWindow = this.up('window');

                    me.baseForm.submit({
                        clientValidation: true,
                        url: '/rest/user',
                        params: {
                            _token: __TOKEN__
                        },
                        success: function(form, action) {
                            upWindow.destroy();
                            Ext.data.StoreManager.lookup('storeUser').load();
                        },
                        failure: function(form, action) {
                            switch (action.failureType) {
                                case Ext.form.action.Action.CLIENT_INVALID:
                                    Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
                                    break;
                                case Ext.form.action.Action.CONNECT_FAILURE:
                                    Ext.Msg.alert('Failure', 'Ajax communication failed');
                                    break;
                                case Ext.form.action.Action.SERVER_INVALID:
                                    Ext.Msg.alert('Failure', action.result.msg);
                            }
                        }
                    });
                }
            },{
                xtype: 'button',
                text: 'Отмена',
                handler: function(){
                    this.up('window').destroy();
                }
            }]
        }];

        this.callParent([config]);
    }
})