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
$installer->run("DELETE FROM `{$this->getTable('cms/page')}` WHERE `identifier` = 'fengo-home-page2';");

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
                <div class="feature-icon"><span class="screen"><span class="fa fa-desktop">&nbsp;</span></span></div>
                <div>
                    <h2>Responsive Design</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus justo nec dolor adipiscing porttitor. Duis eu nibh at est laoreet suscipit. Morbi non orci ut lectus tempus feugiat sit amet id elit.</p>
                </div>
            </div>
            <div class="theme-features-left-bottom">
                <div class="feature-icon"><span class="graph"><span class="fa fa-line-chart">&nbsp;</span></span></div>
                <div>
                    <h2>Powerful admin panel</h2>
                    <p>Vestibulum porttitor erat id gravida tincidunt. Ut vitae molestie elit. Cras commodo et lorem sit amet commodo. Praesent a ligula a est ultrices condimentum eu eget elementum ipsum orci.</p>
                </div>
            </div>
        </div>
        <div class="theme-features-right grid12-6 no-right-gutter grid-full-below-768">
            <div class="theme-features-right-top">
                <div class="feature-icon"><span class="retina"><span class="fa fa-eye">&nbsp;</span></span></div>
                <div>
                    <h2>Retina ready</h2>
                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam nec diam quis nisl iaculis suscipit. Nullam in lorem lorem. Donec vulputate, nibh eget faucibus lobortis.</p>
                </div>
            </div>
            <div class="theme-features-right-bottom">
                <div class="feature-icon"><span class="setting"><span class="fa fa-users">&nbsp;</span></span></div>
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

$installer->endSetup();