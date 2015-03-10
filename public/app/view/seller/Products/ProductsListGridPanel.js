/**
 * Панель "Список товаров"
 */
Ext.define('App.view.seller.Products.ProductsListGridPanel', {
    extend: 'Ext.grid.Panel',
    title: 'Список товаров',
    //controller: 'seller.products_list_grid',
    store: Ext.create('App.store.seller.Products.ProductsListStore'),
    columns: [
        { text: 'Наименование',  dataIndex: 'name', flex: 1 }//,
        //{ text: 'Группа', dataIndex: 'age' }//,
        //{ text: 'Брэнд', dataIndex: 'id' }
    ],
    dockedItems: [{
        xtype: 'pagingtoolbar',
        store: 'sellerProductsListStore',
        dock: 'bottom',
        displayInfo: true
    }]
});
