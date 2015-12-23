/**
 * 
 * Fengo
 * 
 */

var columnCount = 1;

/* Homepage Products Infinite Scroll */
var cscroll = cscroll || {};

(function($, cscroll) {

    "use strict";

    var cscrollButton = ".c-ias-more",
        cscrollLoader = ".c-ias-loader";

    $(cscrollLoader).each(function() {
        $(this).hide();
    });

    cscroll.load = function(container, item) {

        var url = $(container).find('a.next').attr('href');

        $(container).find(cscrollButton).hide();
        $(container).find(cscrollLoader).show();

        $.ajax({
            url: url,
            dataType: 'html',
            success: function(response) {
                cscroll.render(container, item, response);
                $('body').trigger('resizeGridHome');
                if (!response || ($(container, response).eq(0).find('a.next').length === 0)) {
                    $(container).find(cscrollButton).fadeOut();
                    $(container).find(cscrollLoader).fadeIn();
                    $(container).find(cscrollLoader).text("No more products to load!");
                    return;
                }
            },
            error: function(response) {
                $(container).find(cscrollLoader).text("Error! Try to refresh the page.");
            }
        });
    };

    cscroll.render = function(container, item, response) {
        var $responseContainer = $(container, response).eq(0);
        if (0 === $responseContainer.length) {
            $responseContainer = $(response).filter(container).eq(0);
        }

        $(container).find(cscrollButton).show();
        $(container).find(cscrollLoader).hide();

        if ($responseContainer) {
            $responseContainer.find(item).each(function() {
                $(this).insertAfter($(container).find(item).last());
            });
        }

        $(container).find('a.next').attr('href', $responseContainer.find('a.next').attr('href'));
    };

})(jQuery, cscroll);

(function($) {

    "use strict";

    var resizeTimer;
    $(window).resize(function (e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            $(window).trigger('delayed-resize', e);
        }, 250);
    });

})(jQuery);

/* Product Media Manager */
var cmediaManager = {
    cmediaThreshold: 20,
    zoomParams: {responsive: true},
    zoomElement: jQuery('#image'),
    zoomEnabled: Modernizr.mq("screen and (min-width:768px)"),
    cboxElement: jQuery('.product-image-colorbox'),
    cboxEnabled: Modernizr.mq("screen and (min-width:768px)"),

    destroyZoom: function() {
        jQuery('.zoomContainer').remove();
        jQuery.removeData(cmediaManager.zoomElement, 'elevateZoom');
    },

    destroyCBox: function() {
        if (cmediaManager.cboxElement) {
            cmediaManager.cboxElement.removeClass('colorbox cboxElement');
        }
    },

    createZoom: function() {
        if(!cmediaManager.zoomEnabled) {
            return;
        }

        if(cmediaManager.zoomElement.length <= 0) {
            return;
        }

        if(cmediaManager.zoomElement[0].naturalWidth && cmediaManager.zoomElement[0].naturalHeight) {
            var widthDiff = cmediaManager.zoomElement[0].naturalWidth - cmediaManager.zoomElement.width() - cmediaManager.cmediaThreshold;
            var heightDiff = cmediaManager.zoomElement[0].naturalHeight - cmediaManager.zoomElement.height() - cmediaManager.cmediaThreshold;

            if(widthDiff < 0 && heightDiff < 0) {
                return;
            }
        }

        cmediaManager.zoomElement.elevateZoom(cmediaManager.zoomParams);
    },

    createCBox: function() {
        if(!cmediaManager.cboxEnabled) {
            return;
        }

        if(cmediaManager.cboxElement.length <= 0) {
            return;
        }

        cmediaManager.cboxElement.colorbox();
    },

    swapImage: function(targetImage, zoomFlag) {
        if(cmediaManager.zoomElement && cmediaManager.cboxElement) {
            cmediaManager.cboxElement.attr('href', targetImage);
            cmediaManager.zoomElement.attr('src', targetImage);
        }

        if (zoomFlag) {
            cmediaManager.createZoom();
        }
    },

    initZoom: function() {
        enquire.register("screen and (min-width:768px)", {
            match : function() {
                cmediaManager.zoomEnabled = true;
                cmediaManager.createZoom();
            },
            unmatch : function() {
                cmediaManager.destroyZoom();
                cmediaManager.zoomEnabled = false;
            }
        });

        jQuery(window).on('delayed-resize', function(e, resizeEvent) {
            cmediaManager.destroyZoom();
            cmediaManager.createZoom();
        });
        
    },

    initCBox: function() {
        enquire.register("screen and (min-width:768px)", {
            match : function() {
                cmediaManager.cboxEnabled = true;
                cmediaManager.createCBox();
            },
            unmatch : function() {
                cmediaManager.destroyCBox();
                cmediaManager.cboxEnabled = false;
            }
        });

        jQuery(window).on('delayed-resize', function(e, resizeEvent) {
            cmediaManager.destroyCBox();
            cmediaManager.createCBox();
        });
    }
};

var cqtyManager = cqtyManager || {};

(function($, cqtyManager) {

    "use strict";

    var qtyEl = '#qty';
    var qtyDownEl = '#qty_down_btn';

    cqtyManager.qtyDown = function() {
        var qty = $(qtyEl).val();
        if( qty == 2) {
            $(qtyDownEl).hide();
        }
        if( !isNaN( qty ) && qty > 0 ){
            $(qtyEl).val(--qty);
        }         
        return false;
    }

    cqtyManager.qtyUp = function() {
        var qty = $(qtyEl).val();
        if( !isNaN( qty )) {
            $(qtyEl).val(++qty);
        }
        $(qtyDownEl).show();
        return false;
    }

})(jQuery, cqtyManager);

(function($) {
    Function.prototype.debounce = function(threshold) {
        var callback = this;
        var timeout;
        return function() {
            var context = this, params = arguments;
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function() {
                callback.apply(context, params);
            }, threshold);
        };
    };

    $.fn.isOnScreen = function(x, y) {
        
        if(x == null || typeof x == 'undefined') x = 1;
        if(y == null || typeof y == 'undefined') y = 1;
        
        var win = $(window);
        
        var viewport = {
            top : win.scrollTop(),
            left : win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();
        
        var height = this.outerHeight();
        var width = this.outerWidth();
        
        if(!width || !height){
            return false;
        }
        
        var bounds = this.offset();
        bounds.right = bounds.left + width;
        bounds.bottom = bounds.top + height;
        
        var visible = (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        
        if(!visible){
            return false;   
        }
        
        var deltas = {
            top : Math.min(1, ( bounds.bottom - viewport.top ) / height),
            bottom : Math.min(1, ( viewport.bottom - bounds.top ) / height),
            left : Math.min(1, ( bounds.right - viewport.left ) / width),
            right : Math.min(1, ( viewport.right - bounds.left ) / width)
        };
        
        return deltas;
        
    };

    // var container = $('<div class="container">');
    // $(document.body).append(container);
    // for(var i = 0; i < 20; i++){
    //     var box = $('<div class="box">');
    //     container.append(box);
    //     if(i==13){
    //         box.attr('id', 'orange');   
    //     }
    // }

    // var tester = $('#orange');
    // var check = function(){
    //     var visible = tester.isOnScreen(0.5, 0.5);
    //     console.log(visible);
    // }
    // var debounced = check.debounce(50);
    // $(window).on('scroll', debounced);
})(jQuery);

jQuery(function($) {

    // $('#eg-loading-mask').find('img, span').each(function() {
    //     var $this = $(this);
    //     $this.css({'margin-left': (-1) * $this.width() / 2, 'margin-top': (-1) * $this.height() / 2});
    //     $this.fadeIn();
    // });
    $('#eg-loading-mask').on("contextmenu", function(e) {
        e.preventDefault();
    });
    var hideLoadingMask = function() {
        $('#eg-loading-mask').delay(2500).animate({opacity:0}, 1000, 'easeOutQuad', function(){
            $(this).remove();
            $('#root-wrapper').animate({opacity:'1'}, 1000);
        });
    }
    hideLoadingMask();
    // if (window.attachEvent) {
    //     window.attachEvent('onload', function () {
    //         hideLoadingMask();
    //     });
    // } else {
    //     if (window.onload) {
    //         var curronload = window.onload;
    //         var newonload = function () {
    //             curronload();
    //             hideLoadingMask();
    //         };
    //         window.onload = newonload;
    //     } else {
    //         window.onload = function () {
    //             hideLoadingMask();
    //         };
    //     }
    // }

    var qtyEl = $('#qty'); 
    var qty = qtyEl.val(); 
    if(qty < 2){
        $('#qty_down_btn').hide();
    }

});