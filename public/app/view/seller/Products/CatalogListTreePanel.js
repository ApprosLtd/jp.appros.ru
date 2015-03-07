/**
 * Панель "Дерево каталога"
 */
Ext.define('App.view.seller.Products.CatalogListTreePanel', {
    extend: 'Ext.tree.Panel',
    title: 'Дерево каталога',
    width: 300,
    minWidth: 200,
    maxWidth: 500,
    split: true,
    resizable: true,
    collapsible: true,
    rootVisible: false,
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
                children: [{
                    name: 'UK of GB & NI',
                    mtype: 'Country',
                    children: [{
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
});
