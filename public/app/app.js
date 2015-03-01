webix.ready(function(){

    var productEditWindow = function(title, data) {
        return webix.ui({
            view: "window",
            id: "win3",
            move:true,
            modal:true,
            //height: 600,
            width: 800,
            left: 550,
            top: 150,
            head: {
                view: "toolbar",
                //margin: -4,
                cols: [
                    {view: "label", label: title},
                    {
                        view: "icon", icon: "question-circle",
                        click: "webix.message('About pressed')"
                    },
                    {
                        view: "icon", icon: "times-circle",
                        click: "$$('win3').close();"
                    }
                ]
            },
            body: {
                type: "clean",
                rows: [{
                    view: "tabbar",
                    multiview: true,
                    selected: "win-info",
                    options:[
                        {id: "win-info", value: "Описание", width: 150},
                        {id: "win-catalog", value: "Каталог", width: 150},
                        {id: "win-prices", value: "Цены", width: 150},
                        {id: "win-photos", value: "Фотогаларея", width: 150}
                    ]
                },{
                    view: "multiview",
                    animate:false,
                    height:500,
                    //autoheight:true,
                    cells:[{
                        id: "win-info",
                        template: "Описание"
                    },{
                        id: "win-catalog",
                        template: "Каталог"
                    },{
                        id: "win-prices",
                        template: "Цены"
                    },{
                        id: "win-photos",
                        template: "Фотогаларея"
                    },]
                }]
            }
        })
    };

    webix.ui({
        type: "space",
        height: '100%',
        rows: [{view:"toolbar",
            height: 40,
            elements:[
                {view:"label",  template: "<span class='main_title'>Админка</span>"},{},
                {view:"icon",width: 40, icon:"info-circle"},
                {view:"icon", width: 40,icon:"comments"},
                {view:"icon",width: 40, icon:"cog", popup: "lang" }
            ]
        },{
            type: "wide",
            height: "100%",
            cols: [{
                width: 300,
                rows: [{
                    view: 'form',
                    scroll: false,
                    cols: [{
                        view: "richselect",
                        text: "Выберите проект",
                        on: {
                            'onChange': function (newv, oldv) {
                                webix.message("Value changed from: " + oldv + " to: " + newv);
                            }
                        },
                        options: {
                            body: {
                                template: "#name#",
                                //yCount:3,
                                data: [
                                    {id: 1, name: "Banana"},
                                    {id: 2, name: "Papai"},
                                    {id: 3, name: "Apple"},
                                    {id: 4, name: "Mango"}
                                ]
                            }
                        }
                    }, {
                        view: "button",
                        label: "+",
                        width: 40,
                        tooltip: "Добавить проект",
                        click: function () {
                            alert("Форма нового проекта");
                        }
                    }]
                }]
            }, {
                gravity:3,
                type: "clean",
                rows: [{
                    view: "tabbar",
                    multiview: true,
                    selected: "products",
                    options:[
                        {id: "products", value: "Товары", width: 150},
                        {id: "purchases", value: "Закупки", width: 150},
                        {id: "pricing_grids", value: "Ценовые сетки", width: 150},
                        {id: "prices", value: "Управление ценами", width: 250}
                    ]
                },{
                    view: "multiview",
                    animate:false,
                    cells:[{
                        id: "products",
                        cols: [{
                            view: "tree",
                            width: 300,
                            drag: true,
                            select: true,
                            url:"api/catalog-tree"
                        }, {
                            rows: [{
                                view: "form",
                                padding: 5,
                                cols: [{
                                    view: "button",
                                    width: 100,
                                    label: "Добавить",
                                    click: function(){
                                        productEditWindow("Новый продукт").show();
                                    }
                                },{
                                    //
                                }]
                            },{
                                view:"pager",
                                id:"pagerA",
                                template: '{common.first()} {common.prev()} {common.pages()} {common.next()} {common.last()}',
                                size:20,
                                group:5,
                                count:150

                            },{
                                view: "datatable",
                                select: true,
                                columns: [{
                                    id: "id",
                                    header: "ID"
                                },{
                                    id: "name",
                                    header: "Наименование",
                                    fillspace: true
                                }],
                                datafetch: 5,
                                url:"api/model",
                                pager:"pagerA",
                                on: {
                                    onItemDblClick: function(row_obj, e, node){
                                        var item = this.getItem(row_obj.row);
                                        productEditWindow("Редактирование продукта #"+item.id, item).show();
                                    }
                                }
                            }]
                        }]
                    },{
                        id: "purchases",
                        template: "hello 2"
                    },{
                        id: "pricing_grids",
                        template: "hello 3"
                    },{
                        id: "prices",
                        template: "hello 4"
                    }]
                }]
            }]
        }]
    });
});