function chestnut_layerednav_show_loading()
{
    var items = $('chestnut_layerednav_dl').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].addClassName('chestnut_layerednav_disabled');
    }

    var divs = $$('div.layerednav_loading');
    for (var i = 0; i < divs.length; ++i)
        divs[i].show();
}

function chestnut_layerednav_show_products(transport)
{
    var response = {};
    if (transport && transport.responseText) {
        try {
            response = eval('(' + transport.responseText + ')');
        }
        catch (e) {
            response = {};
        }
    }

    if (response.products) {
        if ($('chestnut_layerednav_container') == undefined) {

            var c = $$('.col-main')[0];
            if (c.hasChildNodes()) {
                while (c.childNodes.length > 2) {
                    c.removeChild(c.lastChild);
                }
            }

            var div = document.createElement('div');
            div.setAttribute('id', 'chestnut_layerednav_container');
            $$('.col-main')[0].appendChild(div);

        }

        var el = $('chestnut_layerednav_container');
        el.update(response.products.gsub(layerednavAjaxUrl, categoryUrl));
        catalog_toolbar_init();

        $('chestnut_layerednav').update(response.layer.gsub(layerednavAjaxUrl, categoryUrl));
    }

    var items = $('chestnut_layerednav_dl').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].removeClassName('chestnut_layerednav_disabled');
    }
}

function chestnut_layerednav_add_params(k, v, isSingleVal)
{
    categoryUrlParams = categoryUrlParams.gsub('&amp;', '&');
    var params = categoryUrlParams.parseQuery();

    var strVal = params[k];
    if (typeof strVal == 'undefined' || !strVal.length) {
        params[k] = v;
    }
    else if ('clear' == v) {
        params[k] = 'clear';
    }
    else {
        if (k == 'price')
            var values = strVal.split(',');
        else
            var values = strVal.split('-');

        if (-1 == values.indexOf(v)) {
            if (isSingleVal)
                values = [v];
            else
                values.push(v);
        }
        else {
            values = values.without(v);
        }

        if (-1 != values.indexOf('clear')) {
            values = values.without('clear');
        }

        params[k] = values.join('-');
    }

    categoryUrlParams = Object.toQueryString(params).gsub('%2B', '+');
}

function chestnut_layerednav_send_request()
{
    chestnut_layerednav_show_loading();

    categoryUrlParams = categoryUrlParams.gsub('&amp;', '&');

    // var params = categoryUrlParams.parseQuery();
    // if (!params['dir']) { categoryUrlParams += '&dir=' + 'asc'; }

    new Ajax.Request(layerednavAjaxUrl + '?' + categoryUrlParams, {
        method: 'get',
        onSuccess: chestnut_layerednav_show_products
    });
}

function chestnut_layerednav_update_links(evt, className, isSingleVal)
{
    var link = Event.findElement(evt, 'A'),
        sel = className + '-selected';

    if (link.hasClassName(sel))
        link.removeClassName(sel);
    else
        link.addClassName(sel);

    if (isSingleVal) {
        var items = $('chestnut_layerednav_dl').getElementsByClassName(className);
        var i, n = items.length;
        for (i = 0; i < n; ++i) {
            if (items[i].hasClassName(sel) && items[i].id != link.id)
                items[i].removeClassName(sel);
        }
    }

    chestnut_layerednav_add_params(link.id.split('-')[0], link.id.split('-')[1], isSingleVal);
    chestnut_layerednav_send_request();

    Event.stop(evt);
}

function chestnut_layerednav_attribute_listener(evt)
{
    chestnut_layerednav_add_params('p', 1, 1);
    chestnut_layerednav_update_links(evt, 'chestnut_layerednav_attribute', 0);
}

function chestnut_layerednav_clear_listener(evt)
{
    var link = $(this);
    if (!(queryKey = link.id.split('-')[0])) {
        queryKey = priceQueryKey;
    }

    chestnut_layerednav_add_params('p', 1, 1);
    chestnut_layerednav_add_params(queryKey, 'clear', 1);
    chestnut_layerednav_send_request();

    Event.stop(evt);
}

function get_price_value(num) {
    var regExp = /[^0-9]/;
    if (num.search(regExp) != -1) {
        num = num.substr(1);
    }
    num = parseFloat(num);
    if (isNaN(num))
        num = 0;

    return Math.round(num);
}

function chestnut_layerednav_category_listener(evt) {
    var link = Event.findElement(evt, 'A');
    var catId = link.id.split('-')[1];
    chestnut_layerednav_add_params('cat', catId, 1);
    chestnut_layerednav_add_params('p', 1, 1); 
    chestnut_layerednav_send_request();
    Event.stop(evt);
}

function price_input_listener(evt) {
    if (evt.type == 'keypress' && 13 != evt.keyCode)
        return;

    if (evt.type == 'keypress') {
        var inpObj = Event.findElement(evt, 'INPUT');
    } else {
        var inpObj = Event.findElement(evt, 'BUTTON');
    }

    var priceFrom = get_price_value($('price_from').value),
        priceTo = get_price_value($('price_to').value);

    if ((priceFrom < 0.01 && priceTo < 0.01) || priceFrom < 0 || priceTo < 0 || (priceTo < priceFrom))
        return;

    chestnut_layerednav_add_params('p', 1, 1);
    chestnut_layerednav_add_params(priceQueryKey, priceFrom + ',' + priceTo, true);
    chestnut_layerednav_send_request();
}

function catalog_toolbar_listener(evt) {
    catalog_toolbar_make_request(Event.findElement(evt, 'A').href);
    Event.stop(evt);
}

function catalog_toolbar_make_request(href)
{
    var pos = href.indexOf('?');
    if (pos > -1) {
        categoryUrlParams = href.substring(pos + 1, href.length);
    }
    chestnut_layerednav_send_request();
}

function catalog_toolbar_init()
{
    var items = $('chestnut_layerednav_container').select('.pages a', '.view-mode a', '.sort-by a');
    var i, n = items.length;
    for (i = 0; i < n; ++i) {
        Event.observe(items[i], 'click', catalog_toolbar_listener);
    }
}

function chestnut_layerednav_dt_listener(evt) {
    var e = Event.findElement(evt, 'DT');
    e.nextSiblings()[0].toggle();
    e.toggleClassName('chestnut_layerednav_dt_selected');
}

function chestnut_layerednav_clearall_listener(evt)
{
    var params = categoryUrlParams.parseQuery();
    categoryUrlParams = 'clearall=true';
    chestnut_layerednav_send_request();
    categoryUrlParams = "";
    Event.stop(evt);
}

function chestnut_layerednav_init()
{
    var items, i, j, n,
            classes = ['category', 'attribute', 'icon', 'clear', 'dt', 'clearall'];

    for (j = 0; j < classes.length; ++j) {
        items = $('chestnut_layerednav_dl').select('.chestnut_layerednav_' + classes[j]);
        n = items.length;
        for (i = 0; i < n; ++i) {
            Event.observe(items[i], 'click', eval('chestnut_layerednav_' + classes[j] + '_listener'));
        }
    }

    var btn = $('price_button_ok');
    if (Object.isElement(btn)) {
        Event.observe(btn, 'click', price_input_listener);
        Event.observe($('price_from'), 'keypress', price_input_listener);
        Event.observe($('price_to'), 'keypress', price_input_listener);
    }
}