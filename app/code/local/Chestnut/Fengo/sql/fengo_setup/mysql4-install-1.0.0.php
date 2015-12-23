<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
?>
<?php
$installer = $this;

$connection = $installer->getConnection();

$installer->startSetup();

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => 'FENGO Home Page',
    'root_template'     => 'one_column',
    'identifier'        => 'fengo-home-page',
    'content'           => <<<CONTENT
<div class="fengo-home1 fengo-home">
    <div class="banner-section clearfix">
        <div class="banner-left grid-full-below-768">
            <div class="banner-slider owlcarousel-slider singleItem navigation">
                <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-slider1.jpg'}}" alt="Sample slide1" /></a>
                    <div class="banner-img-text" style="border: 1px solid #fff; padding: 7% 0;">
                        <div class="c-ffcob c-fs40 c-fcf c-ttu clearfix" style="width: 82%; display: inline-block;">
                            <div class="seperator"></div>
                            <div class="content">exclusive</div>
                            <div class="seperator"></div>
                        </div>
                        <div class="c-ffro c-fs25 c-fcf c-ttu">discount codes &amp; offers</div>
                    </div>
                    <div style="position:absolute;bottom:20px;left: 41%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get Your Discount <em class="fa fa-angle-right"></em></a></div>
                </div>
                <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-slider2.jpg'}}" alt="Sample slide2" /></a>
                    <div class="banner-img-text">
                        <div class="c-ffco c-fs23 c-fcf c-ttu">secret</div>
                        <div class="c-ffcob c-fs100 c-fcf c-ttu" style="line-height: 60px; margin-top: 30px;">sale</div>
                        <div class="c-line-seperator" style="width: 10%; border-bottom: 1px solid #fff; height: 2px; display: inline-block; margin: 10px 0;"></div>
                        <div class="c-ffmeeb c-fs30 c-fcf c-ttu">up to 50% off</div>
                        <div class="c-ffrob c-fs19 c-fcf c-ttu">use code: Secret to get 2% off</div>
                    </div>
                    <div style="position:absolute;bottom:20px;left: 41%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get Your Discount <em class="fa fa-angle-right"></em></a></div>
                </div>
            </div>
            <div class="banner-left-bottom clearfix">
                <div class="banner-left-bottom-left grid-full-below-768">
                    <div class="banner-left-bottom-left-top c-hover c-hoveropacity">
                        <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-left-bottom-left-top.jpg'}}" alt="" /></a>
                            <div class="banner-img-text" style="width: 84%; top: 30%; left: 8%;">
                                <div class="c-ffmeb c-fs40 c-fcf c-ttu">jewelry</div>
                                <div class="c-ffrob c-fs23 c-fcf c-ttu">every third item is free!</div>
                            </div>
                            <div style="position:absolute;bottom:20px;left: 40%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Buy Now <em class="fa fa-angle-right"></em></a></div>
                        </div>
                    </div>
                    <div class="banner-left-bottom-left-bottom c-hover c-hoveropacity">
                        <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-left-bottom-left-bottom.jpg'}}" alt="" /></a>
                            <div class="banner-img-text" style="width: 84%; top: 30%; left: 8%;">
                                <div class="c-ffmeeb c-fs30 c-fcf c-ttu clearfix">
                                    <div class="seperator" style="width: 15%;"></div>
                                    <div class="content" style="width: 70%;">accessories</div>
                                    <div class="seperator" style="width: 15%;"></div>
                                </div>
                                <div class="c-ffro c-fs23 c-fcf c-ttu">Complete your style</div>
                            </div>
                            <div style="position:absolute;bottom:20px;left: 33%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get the Look <em class="fa fa-angle-right"></em></a></div>
                        </div>
                    </div>
                </div>
                <div class="banner-left-bottom-right grid-full-below-768">
                    <div class="banner-slider owlcarousel-slider singleItem pagination">
                        <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-left-bottom-right1.jpg'}}" alt="Sample Image" /></a>
                            <div class="banner-img-text" style="top: 35%;">
                                <div class="c-ffrob c-fs35 c-fcf c-ttu">lookbook</div>
                                <div class="c-ffcob c-fs18 c-fcf c-ttu clearfix" style="margin-bottom: 6px;">
                                    <div class="seperator" style="width: 25%; height: 11px;"></div>
                                    <div class="content" style="width: 50%; float: left;">men</div>
                                    <div class="seperator" style="width: 25%; height: 11px;"></div>
                                </div>
                                <div class="c-ffcob c-fs30 c-ttu" style="width: 90%; display: inline-block;">
                                    <div class="c-fcf grid12-6 no-gutter">Autumn</div>
                                    <div class="c-fcf grid12-6 no-gutter">2014</div>
                                </div>
                            </div>
                            <div style="position:absolute;bottom:60px;left: 33%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get the Look <em class="fa fa-angle-right"></em></a></div>
                        </div>
                        <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-left-bottom-right2.jpg'}}" alt="Sample Image" /></a>
                            <div class="banner-img-text" style="top: 35%;">
                                <div class="c-ffrob c-fs35 c-fcf c-ttu">lookbook</div>
                                <div class="c-ffcob c-fs18 c-fcf c-ttu clearfix" style="margin-bottom: 6px;">
                                    <div class="seperator" style="width: 25%; height: 11px;"></div>
                                    <div class="content" style="width: 50%; float: left;">women</div>
                                    <div class="seperator" style="width: 25%; height: 11px;"></div>
                                </div>
                                <div class="c-ffcob c-fs30 c-ttu" style="width: 90%; display: inline-block;">
                                    <div class="c-fcf grid12-6 no-gutter">Autumn</div>
                                    <div class="c-fcf grid12-6 no-gutter">2014</div>
                                </div>
                            </div>
                            <div style="position:absolute;bottom:60px;left: 33%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get the Look <em class="fa fa-angle-right"></em></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-right grid-full-below-768">
            <div class="banner-right-top c-hover c-hoveropacity">
                <div class="banner-item"><a href="{{store url=''}}aboutus"> <img src="{{media url='chestnut/fengo/homepage/banner-right-top.jpg'}}" alt="Sample Image" /></a>
                    <div class="banner-img-text" style="width: 88%; top: 8%; left: 6%;">
                        <div class="c-ffcob c-fs18 c-fc2f">the</div>
                        <div class="c-ffmeeb c-fs25 c-fc3 c-ttu clearfix">
                            <div class="seperator" style="width: 15%; border-color: #333; height: 25px;"></div>
                            <div class="content" style="width: 70%;">Hottest Styles</div>
                            <div class="seperator" style="width: 15%; border-color: #333; height: 25px;"></div>
                        </div>
                        <div class="c-ffrob c-fs20 c-fc2f c-ttu">Are Here</div>
                    </div>
                    <div style="position:absolute;bottom:20px;left: 38%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Watch Now <em class="fa fa-angle-right"></em></a></div>
                </div>
            </div>
            <div class="banner-right-bottom">
                <div class="banner-item"><iframe src="http://player.vimeo.com/video/28425601?title=0&amp;byline=0&amp;portrait=0" style="width:100%;border:none;" height="300"></iframe></div>
            </div>
        </div>
    </div>
    {{block type="fengo/home_tabs" }}
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => 'FENGO Home Page 2',
    'root_template'     => 'one_column',
    'identifier'        => 'fengo-home-page2',
    'content'           => <<<CONTENT
<div class="fengo-home2 fengo-home">
    <div class="buy-theme">
        <h1>Fengo is a premium ecommerce theme</h1>
        <p>Quisque euismod pretium lacinia. Vivamus sollicitudin placerat tortor sit amet sagittis. Mauris ac ante porta, pellentesque lacus.</p>
    </div>
    <div class="theme-features clearfix">
        <div class="theme-features-left grid12-6 no-left-gutter grid-full-below-768">
            <div class="theme-features-left-top">
                <div class="feature-icon"><span class="screen">Responsive</span></div>
                <div>
                    <h2>Responsive Design</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus justo nec dolor adipiscing porttitor. Duis eu nibh at est laoreet suscipit. Morbi non orci ut lectus tempus feugiat sit amet id elit.</p>
                </div>
            </div>
            <div class="theme-features-left-bottom">
                <div class="feature-icon"><span class="graph">Powerful Admin</span></div>
                <div>
                    <h2>Powerful admin panel</h2>
                    <p>Vestibulum porttitor erat id gravida tincidunt. Ut vitae molestie elit. Cras commodo et lorem sit amet commodo. Praesent a ligula a est ultrices condimentum eu eget elementum ipsum orci.</p>
                </div>
            </div>
        </div>
        <div class="theme-features-right grid12-6 no-right-gutter grid-full-below-768">
            <div class="theme-features-right-top">
                <div class="feature-icon"><span class="retina">Retina Ready</span></div>
                <div>
                    <h2>Retina ready</h2>
                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam nec diam quis nisl iaculis suscipit. Nullam in lorem lorem. Donec vulputate, nibh eget faucibus lobortis.</p>
                </div>
            </div>
            <div class="theme-features-right-bottom">
                <div class="feature-icon"><span class="setting">Quality</span></div>
                <div>
                    <h2>Quality support</h2>
                    <p>Vivamus ut vulputate nibh, vel ornare massa. Vivamus nulla turpis, dapibus at tempor vitae, congue id sapien. Suspendisse potenti. Aenean feugiat condimentum massa nec commodo.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-container about-fengo-team">
        <div class="grid12-6 no-left-gutter grid-full-below-768">{{block type="cms/block" block_id="about_fengo_shop"}}</div>
        <div class="grid12-6 no-right-gutter grid-full-below-768">{{block type="cms/block" block_id="our_skills"}}</div>
    </div>
    {{block type="fengo/home_tabs" template="chestnut/home/tabs-home2.phtml"}}
    {{block type="testimonial/testimonial" template="chestnut/testimonial/testimonial_slider.phtml" style="style2"}}
    {{block type="blog/recent" template="chestnut/blog/recent.phtml"}}
    {{block type="chestnut_brands/brands" template="chestnut/brands/brand-slider.phtml" blockName="OUR BRANDS"}}
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => 'FENGO Home Page 3',
    'root_template'     => 'one_column',
    'identifier'        => 'fengo-home-page3',
    'content'           => <<<CONTENT
<div class="fengo-home3 fengo-home">
    <div class="banner-section grid-container">
        <div class="banner-left grid-full-below-768">
            <div class="owlcarousel-slider singleItem pagination">
                <div class="banner-item"><img src="{{media url='chestnut/fengo/homepage/ad1-slider1.jpg'}}" alt="Sample slide1" />
                    <div class="banner-img-text c-fcf c-fs40">
                        <div class="c-ffrb c-fcf c-fs25 c-ttu">Women</div>
                        <div class="c-ffmeb c-fcf c-fs45 c-ttu">lookbook</div>
                        <div class="fa fa-angle-down"></div>
                    </div>
                    <div style="position:absolute;bottom:55px;left: 35%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get the Look <em class="fa fa-angle-right"></em></a></div>
                </div>
                <div class="banner-item"><img src="{{media url='chestnut/fengo/homepage/ad1-slider2.jpg'}}" alt="Sample slide2" />
                    <div class="banner-img-text c-fcf c-fs40">
                        <div class="c-ffrb c-fcf c-fs25 c-ttu">Men</div>
                        <div class="c-ffmeb c-fcf c-fs45 c-ttu">lookbook</div>
                        <div class="fa fa-angle-down"></div>
                    </div>
                    <div style="position:absolute;bottom:55px;left: 35%;"><a href="#" class="c-ffmeb c-fcf c-fhc2 c-fs14 c-ttu">Get the Look <em class="fa fa-angle-right"></em></a></div>
                </div>
            </div>
        </div>
        <div class="banner-right grid-full-below-768">
            <div class="grid-container banner-right-top grid-full-below-768">
                <div class="banner-right-top-left grid-full-below-768 c-hover c-hoveropacity"><img src="{{media url='chestnut/fengo/homepage/ad1-top-left.jpg'}}" alt="" />
                    <div class="banner-img-text" style="top: 26%;">
                        <div class="c-ffrob c-fs35 c-fcf c-ttu">looking</div>
                        <div class="c-ffcob c-fs18 c-fcf clearfix" style="margin-bottom: 6px;">
                            <div class="seperator" style="width: 25%; height: 11px;"></div>
                            <div class="content" style="width: 50%; float: left;">for</div>
                            <div class="seperator" style="width: 25%; height: 11px;"></div>
                        </div>
                        <div class="c-fcf c-ffcob c-fs30 c-ttu">cool shoes?</div>
                        <a class="c-fcf c-ffmeb c-fs14 c-ttu" style="margin-top: 11%;" href="#">shop now <em class="fa fa-angle-right"></em></a></div>
                </div>
                <div class="banner-right-top-right grid-full-below-768 c-hover c-hoveropacity"><img src="{{media url='chestnut/fengo/homepage/ad1-top-right.jpg'}}" alt="" />
                    <div class="banner-img-text" style="top: 50%;">
                        <div class="c-ffmeeb c-fs30 c-fc3 c-ttu">jewelry</div>
                        <div class="c-fc3 c-ffrob c-fs25 c-ttu">Complete your style</div>
                        <a class="c-fc3 c-ffmeb c-fs14 c-ttu" href="#">watch now <em class="fa fa-angle-right"></em></a></div>
                </div>
            </div>
            <div class="grid-container banner-right-bottom grid-full-below-768">
                <div class="banner-right-bottom-left grid-full-below-768 c-hover c-hoveropacity"><img src="{{media url='chestnut/fengo/homepage/ad1-bottom-left.jpg'}}" alt="" />
                    <div class="banner-img-text" style="top: 13%; left: 4%; text-align: left;">
                        <div class="c-ffcob c-fs45 c-fc3 c-ttu" style="line-height: 40px;">exclusive</div>
                        <div class="c-fc3 c-ffrob c-fs20 c-ttu">discount codes &amp; offers</div>
                        <a class="c-fcf c-ffmeb c-fs14 c-ttu" style="margin-top: 27%;" href="#">get your discount <em class="fa fa-angle-right"></em></a></div>
                </div>
                <div class="banner-right-bottom-right grid-full-below-768"><iframe src="http://player.vimeo.com/video/28425601?title=0&amp;byline=0&amp;portrait=0" style="width:100%;border:none;" height="300"></iframe></div>
            </div>
        </div>
    </div>
    <div class="featured-products-list products-list clearfix">
        <div class="seperator seperator-left"></div>
        <div class="featured-title products-list-title">Featured Products</div>
        <div class="seperator seperator-right"></div>
        <div class="clearfix"></div>
        {{block type="chestnut_products/list_featured" template="chestnut/home/list-slider-home3.phtml" blockTitle="Featured Product"}}
    </div>
    <div class="grid-container about-fengo-team">
        <div class="grid12-6 no-left-gutter grid-full-below-768">{{block type="cms/block" block_id="about_fengo_shop"}}</div>
        <div class="grid12-6 no-right-gutter grid-full-below-768">{{block type="cms/block" block_id="from_the_blog"}}</div>
    </div>
    {{block type="testimonial/testimonial" template="chestnut/testimonial/testimonial_slider.phtml"}}
    <div class="special-products-list products-list clearfix">
        <div class="seperator seperator-left"></div>
        <div class="special-title products-list-title">Special Products</div>
        <div class="seperator seperator-right"></div>
        <div class="clearfix"></div>
        {{block type="chestnut_products/list_special" template="chestnut/home/list-slider-home3.phtml" blockTitle="Special Product"}}
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => 'FENGO Home Page 4',
    'root_template'     => 'one_column',
    'identifier'        => 'fengo-home-page4',
    'content'           => <<<CONTENT
<div class="fengo-home4 fengo-home">
    <div id="cm-wrapper">
        <div id="cm-container" class="cm-container clearfix">
            <div class="grid-container" style="display:none;">
                <div class="cm-item w1 grid-full-below-1280">
                    <div class="owlcarousel-slider navigation singleItem grid-full-below-1280 c-hovereffect">
                        <div class="cm-slider-item"><img class="home4-1 cm-item-img item" src="{{media url='wysiwyg/chestnut/fengo/home/home4-1.jpg'}}" alt="" />
                            <div class="cm-img-text">
                                <div class="c-ffcob c-fs40 c-fcf c-ttu c-tac">exclusive</div>
                                <div class="c-ffrob c-fs35 c-fcf c-ttu">discount codes &amp; offers</div>
                                <div class="c-fs15 c-fcf hide-below-768" style="line-height:18px;">Suspendisse sollicitudin purus et turpis fringilla, euvolutpat nisi imperdiet. Nullam vitae dignissim,cursus tortor eget, eleifend nunc. In hac habitasse platea dictumst. Proin consequat eleifend malesuada.</div>
                                <div class="c-ffmeb c-fs14 c-fcf c-ttu" style="margin-top: 11px;">
                                    <div class="button c-hs1" style="width: 39%; border: 2px solid #fff; display: inline-block; cursor: pointer; line-height: 32px;" onclick="setLocation('#');">Get Your Discount</div>
                                </div>
                            </div>
                        </div>
                        <div class="cm-slider-item"><img class="home4-1-1 cm-item-img item" src="{{media url='wysiwyg/chestnut/fengo/home/home4-1-1.jpg'}}" alt="" />
                            <div class="cm-img-text" style="top:13%">
                                <div class="c-ffco c-fs30 c-fcf c-ttu">secret</div>
                                <div class="c-ffcob c-fs130 c-fcf c-ttu" style="line-height: 110px;">sale</div>
                                <hr style="width: 18%;text-align: center;display: inline-block;height: 1px;">
                                <div class="c-ffmeeb c-fs40 c-fcf c-ttu">up to 50% off</div>
                                <div class="c-ffrob c-fs25 c-fcf c-ttu">use code: Secret to get 2% off</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cm-item w2 grid-full-below-1280">
                    <div class="cm-item w2-1 grid-full-below-768">
                        <div class="owlcarousel-slider singleItem autoPlay pagination c-hovereffect">
                            <div class="item">
                                <img class="home4-2 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-2-1.jpg'}}" alt="" />
                                <div class="cm-img-text" style="top: 30%;">
                                    <div class="c-ffrob c-fs35 c-fcf c-ttu">lookbook</div>
                                    <div class="c-ffcob c-fs18 c-fcf clearfix" style="margin-bottom: 6px;">
                                        <div class="seperator" style="width: 25%; height: 13px; border-bottom: 1px solid #fff; float: left;"></div>
                                        <div class="content" style="width: 50%; float: left;">men</div>
                                        <div class="seperator" style="width: 25%; height: 13px; border-bottom: 1px solid #fff; float: left;"></div>
                                    </div>
                                    <div class="c-ffcob c-fs30 c-ttu" style="width: 72%; line-height: 28px; display: inline-block; margin: 10px 0;">
                                        <div class="c-fcf grid12-7 no-gutter">Winter</div>
                                        <div class="c-fcf grid12-5 no-gutter">2014</div>
                                    </div>
                                    <div class="c-ffmeb c-fs14 c-fcf c-ttu" style="margin-top: 6px;">
                                        <div class="button c-hs1" style="width: 52%; border: 2px solid #fff; display: inline-block; cursor: pointer; line-height: 32px;" onclick="setLocation('#');">Get the Look</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img class="home4-2 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-2.jpg'}}" alt="" />
                                <div class="cm-img-text" style="top: 30%;">
                                    <div class="c-ffrob c-fs35 c-fc19 c-ttu">lookbook</div>
                                    <div class="c-ffcob c-fs18 c-fc2 clearfix" style="margin-bottom: 6px;">
                                        <div class="seperator" style="width: 25%; height: 13px; border-bottom: 1px solid #5e5e5e; float: left;"></div>
                                        <div class="content" style="width: 50%; float: left;">women</div>
                                        <div class="seperator" style="width: 25%; height: 13px; border-bottom: 1px solid #5e5e5e; float: left;"></div>
                                    </div>
                                    <div class="c-ffcob c-fs30 c-ttu" style="width: 72%; line-height: 28px; display: inline-block; margin: 10px 0;">
                                        <div class="c-fcef c-bc25 grid12-7 no-gutter">Winter</div>
                                        <div class="c-fc25 grid12-5 no-gutter">2014</div>
                                    </div>
                                    <div class="c-ffmeb c-fs14 c-fc2 c-ttu" style="margin-top: 6px;">
                                        <div class="button c-hs2" style="width: 52%; border: 2px solid #222; display: inline-block; cursor: pointer; line-height: 32px;" onclick="setLocation('#');">Get the Look</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-item w2-2 grid-full-below-768">
                        <div class="clearfix"></div>
                        <div class="grid-full-below-768 c-hovereffect"><img class="home4-3 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-3.jpg'}}" alt="" /></div>
                        <div class="grid-full-below-768" style="position: relative;"><img class="home4-11 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-11.jpg'}}" alt="" />
                            <div class="cm-img-text" style="width: 100%; top: 20%; left: 0%; line-height: 26px;">
                                <div class="c-ffmeeb c-fs25 c-fc3 c-ttu">everyday</div>
                                <div class="c-ffrob c-fs22 c-fc4 c-ttu">free shipping on orders $100+</div>
                                <div class="c-fc6 c-fs15 hide-below-768" style="line-height: 14px;margin-top: 9px;">Quisque ut ipsum neque hendrerit commodo convallis.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-container" style="display:none;">
                <div class="cm-item w3 grid-full-below-1280">
                    <div class="cm-item w3-1 grid-full-below-768 c-hovereffect"><img class="home4-4-1 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-4-1.jpg'}}" alt="" /></div>
                    <div class="cm-item w3-2 grid-full-below-768"><img class="home4-4-2 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-4-2.jpg'}}" alt="" />
                        <div class="cm-img-text" style="width: 80%; top: 20%; left: 10%;">
                            <div class="c-ffmeeb c-fs30 c-fc3 c-ttu">clothing</div>
                            <div class="c-ffrob c-fs33 c-fc4 c-ttu">men's fashion</div>
                            <div class="c-fc6 c-fs15" style="margin:20px 0;">Aenean magna enim, consequat vel nibh a, lacinia nenatis quam. Cras dictum libero eu semper gravida. Ut consequat, dolor id mollis faucibus, enim libero ullamcorper ligula, rutrum dapibus nulla augue eu est. Nulla facilisi. Quisque ultrices gravida interdum. Praesent augue tortor, molestie ipsum sit amet, etiam augue nibh venenatis vulputate justo.</div>
                            <div class="c-ffmeb c-fs14 c-fc2 c-ttu" style="margin-top: 11px;">
                                <div class="button c-hs2" style="width: 38%; border: 2px solid #222; display: inline-block; cursor: pointer; line-height: 32px;" onclick="setLocation('#');">Shop Now</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cm-item w4 grid-full-below-1280">
                    <div class="clearfix"></div>
                    <div class="grid-full-below-768 c-hovereffect" style="position: relative;"><img class="home4-5 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-5.jpg'}}" alt="" />
                        <div class="cm-img-text fengo-kids" style="width: 64%; top: 25%; left: 18%;">
                            <div class="c-ffmeeb c-fs25 c-fcf c-ttu">Fengo kids</div>
                            <div class="c-ffrob c-fs27 c-fcf c-ttu">Buy more - pay less</div>
                            <div class="c-fcf c-fs15 hide-below-768" style="line-height:18px;">Suspendisse sollicitudin purus et turpis fringilla, eu volutpat nisi imperdiet. Nullam vitae sem dignissim,cursus tortor eget, eleifend nunc. Mauris varius quam ligula vitae.</div>
                            <div class="c-ffmeb c-fs14 c-fcf c-ttu" style="margin-top: 11px;">
                                <div class="button c-hs1" style="width: 36%; border: 2px solid #fff; display: inline-block; cursor: pointer; line-height: 32px;" onclick="setLocation('#');">Get the Look</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-full-below-768">
                        <div class="cm-item w4-1 grid-full-below-768" style="position: relative;"><img class="home4-9 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-9.jpg'}}" alt="" />
                            <div class="cm-img-text" style="width: 80%; top: 20%; left: 10%;">
                                <div class="c-facebook"></div>
                                <div class="c-ffmeeb c-fs20 c-fcf c-ttu" style="line-height: 25px;">Connect with us on facebook</div>
                                <div class="c-fs15 c-fcf" style="margin-top: 6px;line-height: 18px;">Morbi tempus blandit felis, eu mattis eros convallis ltrices. Morbi a tincidunt turpis.</div>
                            </div>
                        </div>
                        <div class="cm-item w4-2 grid-full-below-768" style="position: relative;"><img class="home4-10 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-10.jpg'}}" alt="" />
                            <div class="cm-img-text" style="width: 64%; top: 30%; left: 18%;">
                                <div class="c-twitter"></div>
                                <div class="c-ffmeeb c-fs20 c-fcf c-ttu" style="line-height: 25px;">Follow us on Twitter</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-container" style="display:none;">
                <div class="cm-item w5 grid-full-below-1280">
                    <div class="clearfix"></div>
                    <div class="grid-full-below-768 c-hovereffect"><img class="home4-6 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-6.jpg'}}" alt="" />
                        <div class="cm-img-text" style="width: 76%; top: 20%; left: 12%; line-height: 26px;">
                            <div class="c-ffmeeb c-fs20 c-fcf c-ttu" style="margin-bottom: 6px;">Join the community</div>
                            <div class="c-ffrob c-fs22 c-fcf c-ttu">stay up-to-date with the latest offers and new arrivals.</div>
                            {{block type="newsletter/subscribe" template="newsletter/subscribe-home4.phtml"}}
                        </div>
                    </div>
                    <div class="grid-full-below-768" style="position: relative;"><img class="home4-12 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-12.jpg'}}" alt="" />
                        <div class="cm-img-text" style="width: 64%; top: 28%; left: 18%;">
                            <div class="c-pinterest"></div>
                            <div class="c-ffmeeb c-fs20 c-fcf c-ttu" style="line-height: 25px;">Join us on pinterest</div>
                        </div>
                    </div>
                </div>
                <div class="cm-item w6 grid-full-below-1280">
                    <div class="cm-item w6-1 grid-full-below-768">
                        <div class="clearfix"></div>
                        <div class="grid-full-below-768 c-hovereffect"><img class="home4-7 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-7.jpg'}}" alt="" /></div>
                        <div class="grid-full-below-768" style="position: relative;"><img class="home4-13 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-13.jpg'}}" alt="" />
                            <div class="cm-img-text" style="width: 100%; top: 20%; left: 0%; line-height: 26px;">
                                <div class="c-ffmeeb c-fs25 c-fc3 c-ttu">exclusive</div>
                                <div class="c-ffrob c-fs22 c-fc4 c-ttu">discount codes &amp; offers</div>
                                <div class="c-fc6 c-fs15 hide-below-768" style="line-height: 14px;margin-top: 8px;">Suspendisse faucibus augue quis arcu mollis cursus.</div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-item w6-2 grid-full-below-768">
                        <div class="clearfix"></div>
                        <div class="grid-full-below-768" style="position: relative;"><img class="home4-14 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-14.jpg'}}" alt="" />
                            <div class="cm-img-text" style="width: 100%; top: 20%; left: 0%; line-height: 26px;">
                                <div class="c-ffmeeb c-fs25 c-fc3 c-ttu">jewelry</div>
                                <div class="c-ffrob c-fs22 c-fc4 c-ttu">every third item is free!</div>
                                <div class="c-fc6 c-fs15 hide-below-768" style="line-height: 14px;margin-top: 8px;">Ut consequat, dolor id mollis faucibus, enim libero ullamcorp.</div>
                            </div>
                        </div>
                        <div class="grid-full-below-768 c-hovereffect"><img class="home4-8 cm-item-img" src="{{media url='wysiwyg/chestnut/fengo/home/home4-8.jpg'}}" alt="" /></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$installer->run("
    delete from {$installer->getTable('cms/page')} where (`identifier` = 'no-route');
");

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => '404 Not Found',
    'root_template'     => 'one_column',
    'identifier'        => 'no-route',
    'content'           => <<<CONTENT
<div class="no-route-container">
    <div class="page-title">
        <h1>_ERROR 404_</h1>
    </div>
    <div class="page-content">
        <h2>Oops, this page was lost in time.</h2>
        <div>the page, post or content in general you are looking for no longer exists. perhaps youcan return back to the site&rsquo;s <a href="{{store url=''}}">homepage</a> and see if you can find what you are looking for.Or, you can try finding it with another search.</div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/page'), array(
    'title'             => 'About Us',
    'root_template'     => 'one_column',
    'identifier'        => 'aboutus',
    'content'           => <<<CONTENT
<div class="owlcarousel-slider singleItem autoPlay">
    <div class="slider-1"><img src="{{media url="chestnut/fengo/aboutus/about-us-1.jpg"}}" alt="" /></div>
    <div class="slider-2"><img src="{{media url="chestnut/fengo/aboutus/about-us-2.jpg"}}" alt="" /></div>
    <div class="slider-2"><img src="{{media url="chestnut/fengo/aboutus/about-us-3.jpg"}}" alt="" /></div>
</div>
<div class="cms-about-us">
    <div class="buy-theme">
        <h1>Fengo is a premium ecommerce theme</h1>
        <p>Quisque euismod pretium lacinia. Vivamus sollicitudin placerat tortor sit amet sagittis. Mauris ac ante porta, pellentesque lacus.</p>
    </div>
    <div class="theme-features clearfix">
        <div class="theme-features-left grid12-6 no-left-gutter grid-full-below-768">
            <div class="theme-features-left-top">
                <div class="feature-icon"><span class="screen">Responsive</span></div>
                <div>
                    <h2>Responsive Design</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus justo nec dolor adipiscing porttitor. Duis eu nibh at est laoreet suscipit. Morbi non orci ut lectus tempus feugiat sit amet id elit.</p>
                </div>
            </div>
            <div class="theme-features-left-bottom">
                <div class="feature-icon"><span class="graph">Powerful Admin</span></div>
                <div>
                    <h2>Powerful admin panel</h2>
                    <p>Vestibulum porttitor erat id gravida tincidunt. Ut vitae molestie elit. Cras commodo et lorem sit amet commodo. Praesent a ligula a est ultrices condimentum eu eget elementum ipsum orci.</p>
                </div>
            </div>
        </div>
        <div class="theme-features-right grid12-6 no-right-gutter grid-full-below-768">
            <div class="theme-features-right-top">
                <div class="feature-icon"><span class="retina">Retina Ready</span></div>
                <div>
                    <h2>Retina ready</h2>
                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam nec diam quis nisl iaculis suscipit. Nullam in lorem lorem. Donec vulputate, nibh eget faucibus lobortis.</p>
                </div>
            </div>
            <div class="theme-features-right-bottom">
                <div class="feature-icon"><span class="setting">Quality</span></div>
                <div>
                    <h2>Quality support</h2>
                    <p>Vivamus ut vulputate nibh, vel ornare massa. Vivamus nulla turpis, dapibus at tempor vitae, congue id sapien. Suspendisse potenti. Aenean feugiat condimentum massa nec commodo.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-container about-fengo-team">
        <div class="grid12-6 no-left-gutter grid-full-below-768">{{block type="cms/block" block_id="about_fengo_shop"}}</div>
        <div class="grid12-6 no-right-gutter grid-full-below-768">{{block type="cms/block" block_id="our_skills"}}</div>
    </div>
    {{block type="chestnut_brands/brands" template="chestnut/brands/brand-slider.phtml" blockName="OUR PARTNERS"}}
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/page_store'), array(
    'page_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Footer bottom right - social links',
    'identifier'        => 'block_footer_bottom_right',
    'content'           => <<<CONTENT
<div class="social-links">
    <a href="#" title="Join us on Facebook">
        <span class="fa fa-facebook"></span>
    </a>
    <a href="#" title="Follow Chestnut on Twitter">
        <span class="fa fa-twitter"></span>
    </a>
    <a href="#" title="Follow our RSS Feed">
        <span class="fa fa-rss"></span>
    </a>
    <a href="#" title="Delicious">
        <span class="fa fa-delicious"></span>
    </a>
    <a href="#" title="LinkedIn">
        <span class="fa fa-linkedin"></span>
    </a>
    <a href="#" title="Flickr">
        <span class="fa fa-flickr"></span>
    </a>
    <a href="#" title="Skype">
        <span class="fa fa-skype"></span>
    </a>
    <a href="#" title="Email">
        <span class="fa fa-envelope"></span>
    </a>
    <a href="#" title="Email">
        <span class="fa fa-instagram"></span>
    </a>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Footer payment',
    'identifier'        => 'block_footer_bottom_left',
    'content'           => <<<CONTENT
<img title="Sample image with payment methods" src="{{media url="wysiwyg/chestnut/fengo/custom/payment.png}}" alt="Payment methods" />
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'About Fengo Shop',
    'identifier'        => 'block_footer_main_col1_row1_type1',
    'content'           => <<<CONTENT
<div id="about_fengo_shop" class="cms-block about-us">
    <h6 class="cms-block-title">ABOUT FENGO SHOP</h6>
    <div class="cms-block-content"><img src="{{media url="wysiwyg/chestnut/fengo/images/about-fengo-shop.png"}}" alt="Fengo Shop" />
        <p>Morbi pretium odio in dapibus varius. Integer sagittis, tellus ac venenatis venenatis, ipsum ligula auctor lectus, suscipit velit quam quis turpis. Fusce scelerisque aliquet commodo. Sed lobortis laoreet risus vitae tincidunt. Ut consectetur nec purus in egestas.<br /><br /> <a class="go" href="{{store url=''}}aboutus">READ MORE <em class="fa fa-angle-right"></em></a></p><div class="clearfix"></div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'From the Blog',
    'identifier'        => 'from_the_blog',
    'content'           => <<<CONTENT
{{block type="blog/blog" name="blog.slider" template="chestnut/blog/blog_slider.phtml"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'From the Blog',
    'identifier'        => 'block_footer_main_col1_row2_type1',
    'content'           => <<<CONTENT
{{block type="blog/blog" name="blog.slider" template="chestnut/blog/blog_slider.phtml"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Quick Contact',
    'identifier'        => 'block_footer_main_col1_row3_type1',
    'content'           => <<<CONTENT
<div id="quick_contact" class="cms-block">
    <h6 class="cms-block-title">Quick Contact</h6>
    <div class="cms-block-content">{{block type="core/template" form_action="/contacts/index/post" name="quickcontactForm" template="contacts/quick.phtml"}}</div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Newsletter',
    'identifier'        => 'block_footer_main_col1_row4_type1',
    'content'           => <<<CONTENT
<div id="subscribe" class="cms-block">
    <div class="cms-block-content">{{block type="newsletter/subscribe" name="newsletter" template="newsletter/subscribe.phtml"}}</div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Most Favorite',
    'identifier'        => 'block_footer_main_col2_row1_type1',
    'content'           => <<<CONTENT
{{block type="chestnut_products/list_mostviewed" }}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Twitter',
    'identifier'        => 'block_footer_main_col2_row2_type1',
    'content'           => <<<CONTENT
{{block type="core/template" name="twitterfeed" template="chestnut/twitterfeed/twitterfeed.phtml" block_name="Twitter"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Facebook',
    'identifier'        => 'block_footer_main_col2_row3_type1',
    'content'           => <<<CONTENT
{{block type="fengo/social_facebookfans" name="facebook" template="chestnut/facebook/facebookfans.phtml"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Information',
    'identifier'        => 'block_footer_main_col3_row1_type1',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">Information</h6>
    <div class="cms-block-content">
        <div class="information first">
            <p><a href="#">New products</a></p>
        </div>
        <div class="information">
            <p><a href="#">Top sellers</a></p>
        </div>
        <div class="information">
            <p><a href="#">Special products</a></p>
        </div>
        <div class="information">
            <p><a href="#">Manufacturers</a></p>
        </div>
        <div class="information">
            <p><a href="#">Suppliers</a></p>
        </div>
        <div class="information last">
            <p><a href="#">Our stores</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'My Account',
    'identifier'        => 'block_footer_main_col3_row2_type1',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">My Account</h6>
    <div class="cms-block-content">
        <div class="my-account first">
            <p><a href="{{store url=''}}customer/account">My account</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/account/edit">Personal information</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/address/new">Addresses</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/account">Discount</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}sales/order/history">Orders history</a></p>
        </div>
        <div class="my-account last">
            <p><a href="{{store url=''}}customer/account">Your Vouchors</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Customer Service',
    'identifier'        => 'block_footer_main_col3_row3_type1',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">Customer Service</h6>
    <div class="cms-block-content">
        <div class="customer-sevice first">
            <p><a href="{{store url=''}}contacts">Help &amp; Contact</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Shipping &amp; taxes</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Return policy</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Careers</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Affiliates</a></p>
        </div>
        <div class="customer-sevice last">
            <p><a href="#">Legal Notice</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Contact Info',
    'identifier'        => 'block_footer_main_col3_row4_type1',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">Contact Info</h6>
    <div class="cms-block-content">
        <div class="contact-info first">
            <p>Vigo Shop Ltd</p>
        </div>
        <div class="contact-info">
            <p>United Kingdom</p>
        </div>
        <div class="contact-info">
            <p>London 02587</p>
        </div>
        <div class="contact-info">
            <p>Oxford Street 48/188</p>
        </div>
        <div class="contact-info">
            <p>Working days: Mon. - Sun.</p>
        </div>
        <div class="contact-info last">
            <p>Working hours: 9 AM - 8 PM</p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Customer Service',
    'identifier'        => 'block_footer_main_col1_row1_type2',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">Customer Service</h6>
    <div class="cms-block-content">
        <div class="customer-sevice first">
            <p><a href="{{store url=''}}contacts">Help &amp; Contact</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Shipping &amp; taxes</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Return policy</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Careers</a></p>
        </div>
        <div class="customer-sevice">
            <p><a href="#">Affiliates</a></p>
        </div>
        <div class="customer-sevice last">
            <p><a href="#">Legal Notice</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Information',
    'identifier'        => 'block_footer_main_col2_row1_type2',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">Information</h6>
    <div class="cms-block-content">
        <div class="information first">
            <p><a href="#">New products</a></p>
        </div>
        <div class="information">
            <p><a href="#">Top sellers</a></p>
        </div>
        <div class="information">
            <p><a href="#">Special products</a></p>
        </div>
        <div class="information">
            <p><a href="#">Manufacturers</a></p>
        </div>
        <div class="information">
            <p><a href="#">Suppliers</a></p>
        </div>
        <div class="information last">
            <p><a href="#">Our stores</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'My Account',
    'identifier'        => 'block_footer_main_col3_row1_type2',
    'content'           => <<<CONTENT
<div class="cms-block">
    <h6 class="cms-block-title">My Account</h6>
    <div class="cms-block-content">
        <div class="my-account first">
            <p><a href="{{store url=''}}customer/account">My account</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/account/edit">Personal information</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/address/new">Addresses</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}customer/account">Discount</a></p>
        </div>
        <div class="my-account">
            <p><a href="{{store url=''}}sales/order/history">Orders history</a></p>
        </div>
        <div class="my-account last">
            <p><a href="{{store url=''}}customer/account">Your Vouchors</a></p>
        </div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Facebook',
    'identifier'        => 'block_footer_main_col4_row1_type2',
    'content'           => <<<CONTENT
{{block type="fengo/social_facebookfans" name="facebook" template="chestnut/facebook/facebookfans.phtml"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Home slide 1',
    'identifier'        => 'block_slide1',
    'content'           => <<<CONTENT
<a href="#"> <img src="{{media url='wysiwyg/chestnut/fengo/slideshow/home-slide01.jpg'}}" alt="Sample slide" /></a>
<div class="caption slider1">
    <div class="c-ffcob c-fs30 c-fc5" style="margin-bottom: 6px;">Check Your</div>
    <div class="c-ffmeeb c-fs100 c-fcf" style="line-height: 80%;">AUTUMN</div>
    <div class="c-ffmeeb c-fs100 c-fcf" style="line-height: 80%;">STYLE</div>
    <div class="c-ffrob c-fs35 c-fc4c" style="line-height: 80%;">ALL THE TRENDS YOU NEED</div>
    <div class="c-ffrob c-fs35 c-fc4c" style="line-height: 80%;">THIS SEASON</div>
    <div class="c-ffmeb c-fs14" style="margin-top: 20px;"><a href="#">READ IT NOW <em class="fa fa-angle-right"></em></a></div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Home slide 2',
    'identifier'        => 'block_slide2',
    'content'           => <<<CONTENT
<a href="#"> <img src="{{media url='wysiwyg/chestnut/fengo/slideshow/home-slide02.jpg'}}" alt="Sample slide" /></a>
<div class="caption slider2">
    <div class="c-ffmeeb c-fs84 c-fcf clearfix" style="margin-bottom: 20px; line-height: 80%;">
        <div class="seperator">&nbsp;</div>
        <div class="content">You Pay Less</div>
        <div class="seperator">&nbsp;</div>
    </div>
    <div class="c-ffrob c-fs43 c-fcf" style="margin-bottom: 20px;">Everyone Else Pays Attention.</div>
    <div class="c-ffcob c-fs13 c-fcf hide-below-768" style="margin-bottom: 6px;">Vivamus lacinia urna lorem, eget laoreet mauris lobortis quis. Aliquam augue tortor, aliquet nec tempor a, dapibus vitae nunc. Maecenas vitae purus molestie, tempus sem quis, varius tortor.</div>
    <div class="c-ffmeb c-fs14" style="margin-top: 20px;"><a class="c-fcf" href="#">Get Your Discount <em class="fa fa-angle-right"></em></a></div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Home slide 3',
    'identifier'        => 'block_slide3',
    'content'           => <<<CONTENT
<a href="#"> <img src="{{media url='wysiwyg/chestnut/fengo/slideshow/home-slide03.jpg'}}" alt="Sample slide" /></a>
<div class="caption slider3">
    <div class="c-ffrob c-fs50 c-fc7" style="margin-bottom: 15px;">The</div>
    <div class="c-ffmeeb c-fs209 c-fc37" style="margin-bottom: 10px; line-height: 80%;">Sale</div>
    <div class="c-ffrob c-fs69 c-fca7c5bd" style="padding: 3px 0; border: 1px solid #a7c5bd; border-width: 3px 0; margin-bottom: 15px;">Final Reduction</div>
    <div class="c-fs50 c-fc37">Up To 70% Off</div>
    <div class="c-ffmeeb c-fs28 c-fc6">All Sale Items</div>
    <div class="c-ffmeb c-fs14" style="margin-top: 20px;"><a href="#">Shop Now <em class="fa fa-angle-right"></em></a></div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Fengo Slogan',
    'identifier'        => 'block_slogan',
    'content'           => <<<CONTENT
<span class="slogan-left grid12-4 no-left-gutter">DO YOU HAVE ANY QUESTION? CALL: (248) 147 348</span> <span class="slogan-center grid12-4">FREE WORLDWIDE DELIVERY ON ALL ORDERS</span> <span class="slogan-right grid12-4 no-right-gutter">GET 20% OFF WHEN YOU SPEND OVER $200</span>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Most Favorite',
    'identifier'        => 'block_footer_top_col1_row1_type2',
    'content'           => <<<CONTENT
{{block type="chestnut_products/list_mostviewed" template="chestnut/home/most-viewed-new.phtml" }}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Twitter',
    'identifier'        => 'block_footer_top_col2_row1_type2',
    'content'           => <<<CONTENT
{{block type="core/template" name="twitterfeed" template="chestnut/twitterfeed/twitterfeed.phtml" block_name="Twitter"}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Quick Contact',
    'identifier'        => 'block_footer_top_col3_row1_type2',
    'content'           => <<<CONTENT
<div id="quick_contact" class="cms-block">
    <h6 class="cms-block-title">Quick Contact</h6>
    <div class="cms-block-content">{{block type="core/template" form_action="/contacts/index/post" name="quickcontactForm" template="contacts/quick.phtml"}}</div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Left sidebar top',
    'identifier'        => 'block_left_top',
    'content'           => <<<CONTENT
<div class="block">
    <div class="block-title"><strong><span>Custom Block (top)</span></strong></div>
    <div class="block-content sample-block">
        <p>Custom CMS block displayed at the top of the left sidebar. Put your own content here.</p>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Left sidebar bottom',
    'identifier'        => 'block_left_bottom',
    'content'           => <<<CONTENT
<div class="block">
    <div class="block-title"><strong><span>Custom Block (bottom)</span></strong></div>
    <div class="block-content sample-block">
        <p>Custom CMS block displayed in the left sidebar below the other blocks. Put your own content here. There are many similar content placeholders across the store. All editable from admin panel.</p>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Right sidebar top',
    'identifier'        => 'block_right_top',
    'content'           => <<<CONTENT
<div class="block">
    <div class="block-title"><strong><span>Custom Block (top)</span></strong></div>
    <div class="block-content sample-block">
        <p>Custom CMS block displayed at the top of the right sidebar. Put your own content here: text, HTML, images - whatever you like. There are many similar content placeholders across the store. All editable from admin panel.</p>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Right sidebar bottom',
    'identifier'        => 'block_right_bottom',
    'content'           => <<<CONTENT
<div class="block">
    <div class="block-title"><strong><span>Custom Block (bottom)</span></strong></div>
    <div class="block-content sample-block">
        <p>Custom CMS block displayed at the bottom of the right sidebar. There are many similar content placeholders across the store.</p>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'About Fengo Shop',
    'identifier'        => 'about_fengo_shop',
    'content'           => <<<CONTENT
<div id="about_fengo_shop" class="cms-block about-us">
    <h3 class="about-title cms-block-title">ABOUT FENGO SHOP</h3>
    <div class="cms-block-content"><img src="{{media url="wysiwyg/chestnut/fengo/images/about-fengo-shop.png"}}" alt="Fengo Shop" />
        <p>Morbi pretium odio in dapibus varius. Integer sagittis, tellus ac venenatis venenatis, ipsum ligula auctor lectus, suscipit velit quam quis turpis. Fusce scelerisque aliquet commodo. Sed lobortis laoreet risus vitae tincidunt. Ut consectetur nec purus in egestas. Metus turpis, aliquet et neque vitae, venenatis imperdiet erat. Maecenas volutpat orci urna, nec hendrerit sem scelerisque ut. Aliquam vehicula justo eget.<br /><br /> <a class="go" href="{{store url=''}}aboutus">READ MORE <span class="fa fa-angle-right"></span></a></p><div class="clearfix"></div>
    </div>
</div>
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$connection->insert($installer->getTable('cms/block'), array(
    'title'             => 'Our Skills',
    'identifier'        => 'our_skills',
    'content'           => <<<CONTENT
{{block type="core/template" template="chestnut/home/our-skills.phtml" wordpressData="85" photoshopData="73" html/cssData="92" illustrationData="69" logo_designData="87" blockTitle="Our Skills}}
CONTENT
    ,
    'creation_time'     => now(),
    'update_time'       => now(),
));
$connection->insert($installer->getTable('cms/block_store'), array(
    'block_id'   => $connection->lastInsertId(),
    'store_id'  => 0
));

$installer->endSetup();