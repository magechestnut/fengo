isIE = /*@cc_on!@*/false;

Control.Slider.prototype.setDisabled = function()
{
    this.disabled = true;

    if (!isIE)
    {
        this.track.parentNode.className = this.track.parentNode.className + ' disabled';
    }
};

var Layerednav = Class.create();
Layerednav.prototype = {
    initialize: function(categoryUrl, categoryUrlParams, layerednavAjaxUrl) {
        this.categoryUrl = categoryUrl;
        this.categoryUrlParams = categoryUrlParams;
        this.layerednavAjaxUrl = layerednavAjaxUrl;
        this.init();      
    },

    showLoading: function() {
        var items = $('chestnut_layerednav_dl').select('a', 'input');
        n = items.length;
        for (i = 0; i < n; ++i) {
            items[i].addClassName('chestnut_layerednav_disabled');
        }

        var divs = $$('div.layerednav_loading');
        for (var i = 0; i < divs.length; ++i)
            divs[i].show();
    },

    showProducts: function(transport) {
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
            this.toolbarInit();

            $('chestnut_layerednav').update(response.layer.gsub(layerednavAjaxUrl, categoryUrl));
        }

        var items = $('chestnut_layerednav_dl').select('a', 'input');
        n = items.length;
        for (i = 0; i < n; ++i) {
            items[i].removeClassName('chestnut_layerednav_disabled');
        }
    },

    addParams: function(key, value, isSingle) {
        var params = categoryUrlParams.parseQuery();

        var strVal = params[key];
        if (typeof strVal == 'undefined' || !strVal.length) {
            params[key] = value;
        }
        else if (value == 'clear') {
            params[key] = value;
        }
        else {
            if (key == 'price')
                var values = strVal.split(',');
            else
                var values = strVal.split('-');

            if (-1 == values.indexOf(value)) {
                if (isSingle)
                    values = [value];
                else
                    values.push(value);
            }
            else {
                values = values.without(value);
            }

            params[key] = values.join('-');
        }

        categoryUrlParams = Object.toQueryString(params).gsub('%2B', '+');
    },

    sendRequest: function() {
        this.showLoading();

        var params = categoryUrlParams.parseQuery();

        if (!params['dir'])
        {
            categoryUrlParams += '&dir=' + 'desc';
        }

        new Ajax.Request(
                layerednavAjaxUrl + '?' + categoryUrlParams,
                {
                    method: 'get',
                    onSuccess: Layerednav.prototype.showProducts
                }
        );
    },

    init: function() {
        var items, i, j, n,
            classes = ['category', 'attribute', 'icon', 'price', 'clear', 'dt', 'clearAll'];

        for (j = 0; j < classes.length; ++j) {
            items = $('chestnut_layerednav_dl').select('.chestnut_layerednav_' + classes[j]);
            n = items.length;
            for (i = 0; i < n; ++i) {
                Event.observe(items[i], 'click', eval('this.' + classes[j] + 'Listener'));
            }
        }

        items = $('chestnut_layerednav_dl').select('.price-input');
        n = items.length;
        var btn = $('price_button_go');
        for (i = 0; i < n; ++i)
        {
            btn = $('price_button_go---' + items[i].value);
            if (Object.isElement(btn)) {
                Event.observe(btn, 'click', this.priceSubmitListener);
                Event.observe($('price_range_from---' + items[i].value), 'keypress', this.priceSubmitListener);
                Event.observe($('price_range_to---' + items[i].value), 'keypress', this.priceSubmitListener);
            }
        }
    },

    updateLinks: function(event, className, isSingle) {
        var link = Event.findElement(event, 'A'),
            selected = className + '_selected';

        link.toggleClassName(selected);

        //only one  price-range can be selected
        if (isSingle) {
            var items = $('chestnut_layerednav_dl').getElementsByClassName(className);
            var i, n = items.length;
            for (i = 0; i < n; ++i) {
                if (items[i].hasClassName(seleted) && items[i].id != link.id)
                    items[i].removeClassName(seleted);
            }
        }

        this.addParams(link.id.split('-')[0], link.id.split('-')[1], isSingle);

        this.sendRequest();

        Event.stop(event);
    },

    roundPrice: function(number) {
        number = parseFloat(number);
        if (isNaN(number))
            number = 0;

        return Math.round(number);
    },

    categoryListener: function(event) {
        var link = Event.findElement(event, 'A');
        var catId = link.id.split('-')[1];

        var reg = /cat-/;
        if (reg.test(link.id)) {
            Layerednav.prototype.addParams('cat', catId, 1);
            Layerednav.prototype.addParams('p', 1, 1); 
            Layerednav.prototype.sendRequest();
            Event.stop(event);
        }
    },

    attributeListener: function(event) {console.log(this);
        Layerednav.prototype.addParams('p', 1, 1);
        Layerednav.prototype.updateLinks(event, 'chestnut_layerednav_attribute', 0);
    },

    clearListener: function(event) {
        var link = Event.findElement(event, 'A'),
            varName = link.id.split('-')[0];

        Layerednav.prototype.addParams('p', 1, 1);
        Layerednav.prototype.addParams(varName, 'clear', 1);

        if ('price' == varName) {
            var from = $('adj-nav-price-from'),
                to = $('adj-nav-price-to');

            if (Object.isElement(from)) {
                from.value = from.name;
                to.value = to.name;
            }
        }

        Layerednav.prototype.sendRequest();

        Event.stop(event);
    },

    priceListener: function(event) {
        Layerednav.prototype.addParams('p', 1, 1);
        Layerednav.prototype.addParams(event, 'chestnut_layerednav_price', 1);
    },

    toolbarListener: function(event) {
        Layerednav.prototype.sendToolbarRequest(Event.findElement(event, 'A').href);
        Event.stop(event);
    },

    sendToolbarRequest: function(url) {
        var pos = url.indexOf('?');
        if (pos > -1) {
            categoryUrlParams = url.substring(pos + 1, url.length);
        }
        Layerednav.prototype.sendRequest();
    },

    toolbarInit: function() {
        var items = $('chestnut_layerednav_container').select('.pages a', '.view-mode a', '.sort-by a');
        var i, n = items.length;
        for (i = 0; i < n; ++i) {
            Event.observe(items[i], 'click', this.toolbarListener);
        }
    },

    dtListener: function(event) {
        var e = Event.findElement(event, 'DT');
        e.nextSiblings()[0].toggle();
        e.toggleClassName('chestnut_layerednav_dt_selected');
    },

    clearAllListener: function(event) {
        var params = categoryUrlParams.parseQuery();
        categoryUrlParams = 'clearall=true';
        if (params['q'])
        {
            categoryUrlParams += '&q=' + params['q'];
        }
        Layerednav.prototype.sendRequest();
        categoryUrlParams = "";
        Event.stop(event);
    },

    priceSubmitListener: function(event) {
        if (event.type == 'keypress' && 13 != event.keyCode)
            return;

        if (event.type == 'keypress') {
            var inpObj = Event.findElement(event, 'INPUT');
        } else {
            var inpObj = Event.findElement(event, 'BUTTON');
        }

        var sKey = inpObj.id.split('---')[1];
        var numFrom = this.roundPrice($('price_range_from---' + sKey).value),
            numTo = this.roundPrice($('price_range_to---' + sKey).value);

        if ((numFrom < 0.01 && numTo < 0.01) || numFrom < 0 || numTo < 0)
            return;

        Layerednav.prototype.addParams('p', 1, 1);
        Layerednav.prototype.addParams(sKey, numFrom + ',' + numTo, true);
        this.sendRequest();
    },

    createPriceSlider: function(width, from, to, min_price, max_price, sKey) {
        var price_slider = $('chestnut_layerednav_price_slider' + sKey);

        return new Control.Slider(price_slider.select('.handle'), price_slider, {
            range: $R(0, width),
            sliderValue: [from, to],
            restricted: true,
            onChange: function(values) {
                var f = Layerednav.prototype.calculateSliderPrice(width, from, to, min_price, max_price, values[0]),
                    t = Layerednav.prototype.calculateSliderPrice(width, from, to, min_price, max_price, values[1]);

                Layerednav.prototype.addParams(sKey, f + ',' + t, true);

                $('price_range_from' + sKey).update(f);
                $('price_range_to' + sKey).update(t);

                Layerednav.prototype.sendRequest();
            },
            onSlide: function(values) {
                $('price_range_from' + sKey).update(Layerednav.prototype.calculateSliderPrice(width, from, to, min_price, max_price, values[0]));
                $('price_range_to' + sKey).update(Layerednav.prototype.calculateSliderPrice(width, from, to, min_price, max_price, values[1]));
            }
        });
    },

    calculateSliderPrice: function(width, from, to, min, max, value) {
        var calculated = this.roundPrice(((max - min) * value / width) + min);
        return calculated;
    }
}