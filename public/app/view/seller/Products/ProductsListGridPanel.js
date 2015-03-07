/**
 * Панель "Список товаров"
 */
Ext.define('App.view.seller.Products.ProductsListGridPanel', {
    extend: 'Ext.grid.Panel',
    title: 'Список товаров',
    requires: [
        //'App.view.seller.Products.ProductsListController',
        //'App.model.seller.Products.ProductsListModel'
        //'App.store.seller.Products.ProductsListStore'
    ],
    //controller: 'seller.products_list_grid',
    //store: Ext.data.StoreManager.lookup('seller_products_list_store'),
    store: Ext.create('App.store.seller.Products.ProductsListStore'),
    columns: [
        { text: 'Наименование',  dataIndex: 'firstName', flex: 1 },
        { text: 'Группа', dataIndex: 'age' }//,
        //{ text: 'Брэнд', dataIndex: 'id' }
    ],
    dockedItems: [{
        xtype: 'pagingtoolbar',
        store: 'sellerProductsListStore',
        dock: 'bottom',
        displayInfo: true
    }]
});
