/**
 * Окно редактирования продукта
 */
Ext.define('App.view.seller.Products.ProductEditWindow', {
    extend: 'Ext.window.Window',
    title: 'Редактирование продукта',
    height: 400,
    width: 600,
    autoShow: true,
    constrain: true,
    modal: true,
    layout: 'fit',
    dockedItems: [{
        dock: 'bottom',
        xtype: 'toolbar',
        items: [{
            xtype: 'button',
            text: 'Сохранить',
            handler: function(){
                var baseForm = Ext.getCmp('productEditWindowBaseForm');

                console.log(baseForm);
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
        xtype: 'tabpanel',
        border: false,
        defaults: {
            border: false,
            layout: 'fit'
        },
        items: [{
            title: 'Главная',
            xtype: 'panel',
            items: {
                xtype: 'form',
                id: 'productEditWindowBaseForm',
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
                    fieldLabel: 'Описание',
                    xtype: 'textarea',
                    name: 'description',
                    allowBlank: true
                }]
            }
        },{
            title: 'Атрибуты',
            items: {
                xtype: 'grid',
                border: false,
                features: [{
                    id: 'group',
                    ftype: 'groupingsummary',
                    groupHeaderTpl: '{name}',
                    hideGroupedHeader: true,
                    enableGroupingMenu: false
                }],
                plugins: [
                    Ext.create('Ext.grid.plugin.CellEditing', {
                        clicksToEdit: 1
                    })
                ],
                columns: [{
                    text: 'Атрибут',
                    flex: 1,
                    tdCls: 'task',
                    sortable: true,
                    dataIndex: 'name',
                    hideable: false
                }, {
                    header: 'Значение',
                    width: 180,
                    sortable: true,
                    dataIndex: 'value',
                    field: {
                        xtype: 'textfield'
                    }
                }],
                store: Ext.create('Ext.data.Store', {
                    fields: ['id', 'name', 'value', 'group'],
                    groupField: 'group',
                    data: [
                        {
                            id: 1,
                            name: 'Store',
                            value: 300,
                            group: 'Общие атрибуты'
                        },
                        {
                            id: 2,
                            name: 'Norton',
                            value: 600,
                            group: 'Общие атрибуты'
                        },
                        {
                            id: 3,
                            name: 'Hello world',
                            value: 780,
                            group: 'Простые атрибуты'
                        }
                    ]
                })
            }
        },{
            title: 'Каталог',
            items: {
                xtype: 'treepanel',
                rootVisible: false,
                border: false,
                viewConfig: {
                    plugins: { ptype: 'treeviewdragdrop' }
                },
                store: {
                    fields: [{
                        name: 'text',
                        mapping: 'name'
                    }],
                    proxy: {
                        type: 'memory',
                        reader: {
                            typeProperty: 'mtype'
                        }
                    },
                    root: {
                        children: [{
                            name: 'Europe, ME, Africa',
                            mtype: 'Territory',
                            checked: false,
                            children: [{
                                name: 'UK of GB & NI',
                                mtype: 'Country',
                                children: [{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                }]
                            }]
                        },{
                            name: 'Europe, ME, Africa',
                            mtype: 'Territory',
                            children: [{
                                name: 'UK of GB & NI',
                                mtype: 'Country',
                                children: [{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                }]
                            }]
                        },{
                            name: 'Europe, ME, Africa',
                            mtype: 'Territory',
                            children: [{
                                name: 'UK of GB & NI',
                                mtype: 'Country',
                                checked: true,
                                children: [{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                }]
                            }]
                        },{
                            name: 'Europe, ME, Africa',
                            mtype: 'Territory',
                            children: [{
                                name: 'UK of GB & NI',
                                mtype: 'Country',
                                children: [{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                },{
                                    name: 'London',
                                    mtype: 'City',
                                    leaf: true
                                }]
                            }]
                        }, {
                            name: 'North America',
                            mtype: 'Territory',
                            children: [{
                                name: 'USA',
                                mtype: 'Country',
                                children: [{
                                    name: 'Redwood City',
                                    mtype: 'City',
                                    leaf: true
                                }]
                            }]
                        }]
                    }
                }
            }
        },{
            title: 'Цены',
            bodyPadding: 5,
            layout: {
                type: 'anchor'
            },
            items: [{
                xtype: 'grid',
                title: 'Основная колонка',
                columns: [{
                    text: 'от 15т.р.'
                },{
                    text: '15т.р.- 30т.р.'
                },{
                    text: '30т.р. - 50т.р.'
                }]
            },{
                xtype: 'grid',
                title: 'Основная колонка',
                columns: [{
                    text: 'от 15т.р.'
                },{
                    text: '15т.р.- 30т.р.'
                },{
                    text: '30т.р. - 50т.р.'
                }]
            }]
        },{
            title: 'Фотогалерея',
            html: 'Фотогалерея'
        }]
    }
})