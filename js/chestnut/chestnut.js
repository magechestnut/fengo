jQuery(function($) {

	// Carousel Slider
	var owls = $(".owlcarousel-slider");
	var breakpoints = [[0, 1], [320, 1], [480, 1], [751, 3], [960, 3], [1263, 4]];
	owls.each(function() {
		var owl = jQuery(this);
		var navigation = (owl.hasClass('navigation')) ? true: false;
		var lazyLoad = (owl.hasClass('lazyLoad')) ? true: false;
		var singleItem = (owl.hasClass('singleItem')) ? true: false;
		var autoPlay = (owl.hasClass('autoPlay')) ? true: false;
		var pagination = (owl.hasClass('pagination')) ? true: false;
		var itemsCustom = (owl.hasClass('itemsCustom')) ? breakpoints: false;
		owl.owlCarousel({
			singleItem: singleItem,
			navigation: navigation,
			lazyLoad: lazyLoad,
			autoPlay: autoPlay,
			itemsCustom: itemsCustom,
			pagination: pagination,
			rewindNav: true,
			rewindSpeed: 600,
			transitionStyle: 'fade',
			navigationText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"]
		});
	});

	// Dropdown Menu
	var ddOpenTimeout;
	var ddMenuPosTimeout;
	var ddDelayIn = 200;
	var ddDelayOut = 0;
	$(".clickable-dropdown > .dropdown-toggle").click(function() {
		$(this).parent().addClass('open');
		$(this).parent().trigger('mouseenter');
	});
	$("body").on("mouseenter", ".dropdown", function() {
		var ddToggle = $(this).children('.dropdown-toggle');
		var ddMenu = $(this).children('.dropdown-menu');
		var ddWrapper = ddMenu.parent();
		
		ddMenu.css("left", "");
		ddMenu.css("right", "");
		
		clearTimeout(ddOpenTimeout);
		ddOpenTimeout = setTimeout(function() {
			ddWrapper.addClass('open');
		}, ddDelayIn);
		
		$(this).children('.dropdown-menu').stop(true, true).delay(ddDelayIn).fadeIn(0, "easeOutCubic");
		
		clearTimeout(ddMenuPosTimeout);
		ddMenuPosTimeout = setTimeout(function() {
			if (ddMenu.offset().left < 0)
			{
				var space = ddWrapper.offset().left;
				ddMenu.css("left", (-1)*space);
				ddMenu.css("right", "auto");
			}
		}, ddDelayIn);
	}).on("mouseleave", ".dropdown", function() {
		var ddMenu = $(this).children('.dropdown-menu');
		clearTimeout(ddOpenTimeout);
		ddMenu.stop(true, true).delay(ddDelayOut).fadeOut(0, "easeInCubic");
		if (ddMenu.is(":hidden"))
		{
			ddMenu.hide();
		}
		$(this).removeClass('open');
	});
	$("body").on("click", ".dropdown", function() {
		var $this = $(this);
		if ($this.hasClass('open')) {
			$this.trigger('mouseleave');
			$this.removeClass('open');
		} else {
			clearTimeout(ddOpenTimeout);
			ddOpenTimeout = setTimeout(function() {
				$this.addClass('open');
			}, ddDelayIn);
			$this.trigger('mouseenter');
		}
	});

	// Home page 4 Header Opener
	$('.header-opener').click(function() {
		$('.header-top-container').slideToggle('slow', function() {
			$(this).css('overflow', 'visible');
		});
		$(this).toggleClass('open');
	});

	var headerMatched = (typeof headerType != 'undefined') && ((headerType == 4) || (headerType == 3));
	var cSearch = $('.search-wrapper');
	var cSearchWrapper = cSearch.parent();
	var cTopLinks = $('.header ul.links li');
	enquire.register('screen and (max-width: 767px)', {
        match: function () {
        	if (headerMatched) {
	        	$('.chestnut-mobile').append(cSearch).append(cTopLinks);
	        	$('.chestnut-mobile').prependTo($('.header-main-container'));
	        	$('#chestnut-mobile').prependTo($('.header-main-container'));
	        }
        },
        unmatch: function () {
        	if (headerMatched) {
	        	var topLinksWrapper = $('.header ul.links');
	            cSearch.appendTo(cSearchWrapper);
	            cTopLinks.appendTo(topLinksWrapper);
	        	$('.chestnut-mobile').prependTo($('.nav-container .nav .egmenu'));
	        	$('#chestnut-mobile').prependTo($('.nav-container .nav .egmenu'));
	        }
        }
    }, true);

	var headerOpener = $('.header-opener');
    enquire.register('screen and (min-width: 768px) and (max-width: 959px)', {
    	match: function () {
    		if ($('#mobile-trigger').hasClass('active')) {
    			headerOpener.addClass('active');
    		}
			//updateLayout(true);
    	},
    	unmatch: function () {
			var hasActiveClass = headerOpener.hasClass('active');
    		if (hasActiveClass) {
    			headerOpener.removeClass('active');
    		}
    		//updateLayout(false);
    	}
    }, true);

    if ($('.main-container.col3-layout').length > 0) {
        enquire.register('screen and (max-width: 1279px)', {
            match: function () {
                var rightColumn = $('.col-right');
                var colWrapper = $('.col-wrapper');

                rightColumn.appendTo(colWrapper);
                rightColumn.css('float', 'left');
            },
            unmatch: function () {
                var rightColumn = $('.col-right');
                var main = $('.main');

                rightColumn.appendTo(main);
                rightColumn.css('float', 'right');
            }
        }, true);
    }

    var updateLayout = function(e) {
		var boxes = document.getElementsByClassName('level-top');
		var columns = boxes.length;
		var boxLength = 0;

		if (e) {
			for (var i = 0; i < columns; i++) {
				boxLength += boxes[i].clientWidth;
			}

			var parentWidth = boxes[0].parentElement.clientWidth;
			var space = (parentWidth - boxLength) / (columns - 1);

			for (var i = 1; i < columns; i++) {
				boxes[i].style.marginLeft = space + "px";
			}
		} else {
			for (var i = 1; i < columns; i++) {
				boxes[i].style.marginLeft = 'auto';
			}
		}
	};

	var winScrollTimeout;
    $(window).scroll(function(){
        
        clearTimeout(winScrollTimeout);
        winScrollTimeout = setTimeout(function() {
                                    
            if ($(this).scrollTop() > 100)
            {
                $('#scroll-to-top').children('.fa').fadeIn();
            }
            else
            {
                $('#scroll-to-top').children('.fa').fadeOut();
            }
        
        }, 500);
        
    });
    
    $('#scroll-to-top .fa').click(function(){
        $("html, body").animate({scrollTop: 0}, 600, "easeOutCubic");
        return false;
    });

    $('.cart .qty, .my-wishlist .qty').each(function(){
		var thisQty = $(this);
		
		var decreaseButton = thisQty.prev();
		decreaseButton.on('click', function(){
			if( !isNaN( thisQty.attr("value") ) && thisQty.attr("value") > 0 ){
			   	var el_val = parseFloat(thisQty.attr("value"))-1;
			   	thisQty.attr('value', el_val);
		    }
		});
		
		var increaseButton = $(this).next();
		increaseButton.on('click', function(){
			if( !isNaN(thisQty.attr("value"))){
			   	var el_val = parseFloat(thisQty.attr("value"))+1;
			   	thisQty.attr('value', el_val);
		    }
		});
	});

	$('.my-account input[type="text"], .my-account input[type="password"]').each(function() {
        if ($(this).val() !== '') {
            $("label[for='" + $(this).attr('id') + "']").hide();
        }
        $(this).focus(function() {
            $("label[for='" + $(this).attr('id') + "']").hide();
        });
        $(this).blur(function() {
            if ($(this).val() == '') {
                $("label[for='" + $(this).attr('id') + "']").show();
            }
        });
    });
	$('.my-account').find("label[for='region_id']").hide();
	$('.my-account').find("label[for='country']").hide();

    $("select").each(function() {
        var str = "";
        str = $(this).find(":selected").text();
        $(this).siblings(".selected-value").text(str);
    });
    $("select").change(function() {
        var str = "";
        str = $(this).find(":selected").text();
        $(this).siblings(".selected-value").text(str);
    });

    var getColumnCount = function() {
    	if (Modernizr.mq("screen and (min-width:768px) and (max-width:959px)")) {
    		return 2;
    	} else if (Modernizr.mq("screen and (max-width:767px)")) {
    		return 1;
    	} else {
    		return columnCount;
    	}
    }

    var getHomeColumnCount = function() {
        if (Modernizr.mq("screen and (min-width:768px) and (max-width:1279px)")) {
            return 3;
        } else if (Modernizr.mq("screen and (max-width:767px)")) {
            return 1;
        } else {
            return 4;
        }
    }

    var resizeGridHome = function() {
        $('.home-products-grid').each(function() {            
            var $grid = $(this);
            if ($grid.parents('.tab-pane').length) {
                if (!$grid.parents('.tab-pane').hasClass('active'))
                    return;
            }
            var colCount = getHomeColumnCount();
            $grid.find('.product-image img').imgpreload({
                all: function() {
                    var h = 0;
                    var index = 0;
                    var size = $grid.find('.item').length;
                    var items = new Array();
                    $grid.find('.item').each(function() {
                        index++;
                        $(this).css('height', 'auto');
                        if (h < $(this).innerHeight() + 12)
                            h = $(this).innerHeight() + 12;
                        if (index % colCount == 0 || index == size) {
                            items.push(this);
                            $.each(items, function(index, value) {
                                $(value).css({height: h+'px'});
                            });
                            h = 0;
                            items = new Array();
                        } else {
                            items.push(this);
                        }
                    })
                }
            });
        });
    };

    $('a[data-toggle="tab"]').click(function (e) {
        setTimeout(resizeGridHome, 50);
    });

    $('body').on('resizeGridHome', function() {
    	setTimeout(resizeGridHome, 50);
    });

	var resizeGrid = function(object, colCount) {
	    $(object).each(function() {		
	        var $grid = $(this);
	        $grid.find('.product-image img').imgpreload({
	            all: function() {
	                var h = 0;
	                var index = 0;
	                var size = $grid.find('.item').length;
	                var items = new Array();
	                $grid.find('.item').each(function() {
	                    index++;
	                    $(this).css('height', 'auto');
	                    if (h < $(this).innerHeight() + 12)
	                        h = $(this).innerHeight() + 12;
	                    if (index % colCount == 0 || index == size) {
	                        items.push(this);
	                        $.each(items, function(index, value) {
	                            $(value).css({height: h+'px'});
	                        });
	                        h = 0;
	                        items = new Array();
	                    } else {
	                        items.push(this);
	                    }
	                })
	            }
	        });
	    });
	};
	resizeGrid('.category-products .products-grid', getColumnCount());
	resizeGridHome();
	$(window).on('delayed-resize', function(e, resizeEvent) {
		resizeGrid('.category-products .products-grid', getColumnCount());
		resizeGridHome();
    });

    //$('#cm-wrapper').find('.cm-item-img').Lazy();
    $('#cm-wrapper').find('#cm-container > div.grid-container').each(function() {
    	var $this = $(this);
    	$this.find('.cm-item-img').imgpreload({
	        all: function() {
	            $this.fadeIn('slow');
	        }
	    });
    });

    var popupQuickView = function(e) {
    	e.preventDefault();
    	var $this = $(this);
        var url = $this.data('target');
        if (!url) url = $this.attr('href');

        $.magnificPopup.open({
            items: {
                src: url,
            },
            type: 'iframe',
            mainClass: 'c-quickview-container',
            preloader: true
        });
    }

    $('body').on('click', '.c-quickview', popupQuickView);
});