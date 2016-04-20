<?php

/**
 * Put project specific setup here. Structure setup code so that it can be run multiple times during project development.
 * To re-run this installer run the following mysql and refresh the website:
 * delete from core_resource where code = 'abp_init_setup'
 */
$installer = $this;
$installer->startSetup();
echo 'Init setup started ...<br/>';

/*
 * Set core_config_data.
 */
$config = new Mage_Core_Model_Config();
$config->saveConfig('design/package/name', 'abp', 'websites', 1);
$config->saveConfig('design/theme/default', 'master', 'websites', 1);
$config->saveConfig('design/header/logo_src', 'images/logo.png', 'default', 0);
$config->saveConfig('design/header/logo_src_small', 'images/mobile-logo.png', 'default', 0);
$config->saveConfig('design/header/welcome', '', 'default', 0);
$config->saveConfig('design/footer/copyright', 'Copyright &copy; 2014 American Botanical Pharmacy. All Rights Reserved.', 'default', 0);

// Disable module output for performance.
$config->saveConfig('advanced/modules_disable_output/Mage_Review', '1', 'default', 0);
$config->saveConfig('advanced/modules_disable_output/Mage_Tag', '1', 'default', 0);
$config->saveConfig('advanced/modules_disable_output/Mage_Poll', '1', 'default', 0);

// Increase session/admin timeouts for development. Set these back to default for production.
$config->saveConfig('admin/security/session_cookie_lifetime', '86400', 'default', 0); // default=900
$config->saveConfig('admin/security/lockout_threshold', '1440', 'default', 0); // default=30
$config->saveConfig('web/cookie/cookie_lifetime', '36000', 'default', 0); // default=3600

// SEO
$config->saveConfig('catalog/seo/product_use_categories', '0', 'default', 0);
$config->saveConfig('catalog/seo/product_canonical_tag', '1', 'default', 0);
$config->saveConfig('catalog/seo/category_canonical_tag', '1', 'default', 0);

// Default META
$config = ($config) ? $config : Mage::getModel("core/config");
$config->saveConfig('design/head/default_title', 'Alternative & Natural Healing for Powerful Health - Organic Herbs & Natural Remedies', 'default', 0);
$config->saveConfig('design/head/default_description', 'Dr. Richard Schulze has been creating powerful health naturally since 1979.  Through alternative healing and natural cures, American Botanical Pharmacy offers organic herbs, bowel detox, colon cleanse, constipation remedies, and other products to help you live a natural, healthy lifestyle.', 'default', 0);
$config->saveConfig('design/head/default_keywords', 'alternative healing, natural cures, dr. richard schulze, organic herbs, bowel detox, colon cleanse, constipation remedies', 'default', 0);

// Catalog
$config->saveConfig('cataloginventory/item_options/min_sale_qty', '1', 'default', 0);
$config->saveConfig('cataloginventory/options/display_product_stock_status', '0', 'default', 0);
$config->saveConfig('shipping/option/checkout_multiple', '0', 'default', 0);
$config->saveConfig('catalog/frontend/grid_per_page_values', '1000,2000,3000', 'default', 0);
$config->saveConfig('catalog/frontend/grid_per_page', '3000', 'default', 0);
$config->saveConfig('catalog/frontend/list_per_page_values', '1000,2000,3000', 'default', 0);
$config->saveConfig('catalog/frontend/list_per_page', '3000', 'default', 0);

// Project Specific
$config->saveConfig('sendfriend/email/enabled', '0', 'default', 0);

// Default product attribute 'Display Product Options In' = Product Info Column
$resource = Mage::getSingleton('core/resource');
$writeConnection = $resource->getConnection('core_write');
$table = $resource->getTableName('eav/attribute');
$query = "UPDATE {$table} SET default_value = 'container1' WHERE attribute_code = 'options_container'";
$writeConnection->query($query);

/*
 * Delete default Magento cms pages.
 */
$cmsPageNames = array(
    'about-magento-demo-store',
    'customer-service',
	'private-sales',
);
foreach ($cmsPageNames as $cmsPageName) {
    $cmsPage = Mage::getModel('cms/page')->load($cmsPageName);
    if ($cmsPage) {
        $cmsPage->delete();
    }
}

/*
 * Set home cms page.
 */
Mage::getModel('cms/page')->load('home', 'identifier')
    ->setRootTemplate('one_column')
    ->setData('content', '
<div id="banners-container">{{widget type="bannerenhanced/main"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section1_title"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section1"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section2"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section3"}}</div>
    ')
    ->save();

/*
 * Update default cms pages.
 */
Mage::getModel('cms/page')->load('no-route', 'identifier')
        ->setRootTemplate('one_column')
        ->save();

/*
 * Create new cms pages.
 */
$cmsPagesData = array(
    array(
        'title'                 => 'Common Dosage Questions & Answers',
        'identifier'            => 'common-dosage-questions-answers',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<p>{{block type="core/template" template="aydus/cms/commondosage/page.phtml"}}</p>
         ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="banner">
    <block type="core/template" name="content_heading" template="aydus/cms/banner.phtml">
        <action method="setData"><name>content_heading</name><value>Common Dosage Q&#38;A</value></action>
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Dr Schulze',
        'identifier'            => 'dr-schulze',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div>{{block type="core/template" template="aydus/cms/drschulze/page.phtml"}}</div>
         ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="banner">
    <block type="core/template" name="content_heading" template="aydus/cms/banner.phtml">
        <action method="setData"><name>content_heading</name><value>Dr Schulze</value></action>
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Healthy Savings',
        'identifier'            => 'healthy-savings',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div class="cms-banner-container template2">{{widget type="enterprise_banner/widget_banner" display_mode="fixed" banner_ids="4" template="banner/widget/block.phtml" unique_id="4cfee01beac528a22718e624e0797de1"}}</div>
<div class="promotion-container">
<h2>Healthy Incentives</h2>
<p>Dr. Schulze\'s monthly special offers to make it easier for you and your family to Create Powerful Health Naturally</p>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="promotion1"}}</div>
</div>
        ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="content">
	<block type="aydus_featuredproducts/featured" name="featuredProducts1">
		 <action method="setData"><key>template</key><value>aydus/catalog/product/savings.phtml</value></action>
		 <action method="setData"><key>mode</key><value>grid</value></action>
		 <action method="setData"><key>category_id</key><value>93</value></action>
                 <action method="setData"><key>title</key><value>Buy 2 Get 1 Free</value></action>
                 <!-- Add empty blocks to avoid template error in Magento  1.14.x -->
		 <block type="core/text_list" name="product_list.name.after" as="name.after" />
		 <block type="core/text_list" name="product_list.after" as="after" />
	</block>
</reference>

<reference name="content">
	<block type="aydus_featuredproducts/featured" name="featuredProducts2">
		 <action method="setData"><key>template</key><value>aydus/catalog/product/savings.phtml</value></action>
		 <action method="setData"><key>mode</key><value>grid</value></action>
		 <action method="setData"><key>category_id</key><value>94</value></action>
                 <action method="setData"><key>title</key><value>50% Off</value></action>
                 <!-- Add empty blocks to avoid template error in Magento  1.14.x -->
		 <block type="core/text_list" name="product_list.name.after" as="name.after" />
		 <block type="core/text_list" name="product_list.after" as="after" />
	</block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Home',
        'identifier'            => 'home',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div id="banners-container">{{widget type="bannerenhanced/main"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section1"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section2"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section3"}}</div>
        ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Learn',
        'identifier'            => 'learn',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<p>{{block type="core/template" template="aydus/cms/learn/page.phtml"}}</p>
        ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="banner">
    <block type="core/template" name="content_heading" template="aydus/cms/banner.phtml">
        <action method="setData"><name>content_heading</name><value>Learn</value></action>
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),

    array(
        'title'                 => 'Store',
        'identifier'            => 'store',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div class="cms-banner-container template1">{{widget type="enterprise_banner/widget_banner" display_mode="fixed" banner_ids="3" template="banner/widget/block.phtml" unique_id="3cfee01beac528a22718e624e0797de1"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="store_section1_title"}}</div>
<div>{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="home_section1"}}</div>
<p>{{block type="core/template" template="aydus/cms/store/media.phtml"}}</p>
            ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="content">
    <block type="aydus_featuredproducts/featured" name="featuredProducts">
         <action method="setData"><key>template</key><value>aydus/catalog/product/carousel.phtml</value></action>
         <action method="setData"><key>mode</key><value>grid</value></action>
         <action method="setData"><key>category_id</key><value>3</value></action>
         <action method="setData"><key>column_count</key><value>15</value></action>
         <action method="setData"><key>title</key><value>Top Seasonal Picks</value></action>
         <!-- Add empty blocks to avoid template error in Magento  1.14.x -->
         <block type="core/text_list" name="product_list.name.after" as="name.after" />
         <block type="core/text_list" name="product_list.after" as="after" />
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Job Template',
        'identifier'            => 'job-template',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div>{{block type="core/template" template="aydus/cms/job/template.phtml"}}</div>
            ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="banner">
    <block type="core/template" name="content_heading" template="aydus/cms/banner.phtml">
        <action method="setData"><name>content_heading</name><value>Jobs At ABP</value></action>
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    ),
    array(
        'title'                 => 'Job Marketing Program Manager',
        'identifier'            => 'job-marketing-program-manager',
        'root_template'         => 'one_column',
        'content_heading'       => '',
        'content'               => '
<div>{{block type="core/template" template="aydus/cms/job/marketing-program-manager.phtml"}}</div>
            ',
        'meta_description'      => '',
        'meta_keywords'         => '',
        'layout_update_xml'     => '
<reference name="banner">
    <block type="core/template" name="content_heading" template="aydus/cms/banner.phtml">
        <action method="setData"><name>content_heading</name><value>Jobs At ABP</value></action>
    </block>
</reference>
        ',
        'under_version_control' => 0,
        'stores'                => array(0)
    )
);

foreach ($cmsPagesData as $cmsPageData) {
    $cmsPage = Mage::getModel('cms/page')->load($cmsPageData['identifier']);
    if (!$cmsPage->hasData())
    {
        Mage::getModel('cms/page')->setData($cmsPageData)->save();
    }
}

/*
 * Delete default Magento cms static blocks.
 */
$cmsBlockNames = array(
    'footer_menu'
);
foreach ($cmsBlockNames as $cmsBlockName) {
    $cmsBlock = Mage::getModel('cms/block')->load($cmsBlockName);
    if ($cmsBlock) {
        $cmsBlock->delete();
    }
}

/*
 * Create new cms blocks.
 */

$cmsBlocksData = array(
    array(
        'title' => 'Home Section1',
        'identifier' => 'home_section1',
        'content' => '
<div class="content section1">
<div class="article-container"><article class="article1">
<div class="column col1">
<h3><a href="{{store direct_url="foundational.html"}}">Foundational Products</a></h3>
<p>In his clinic, Dr. Schulze discovered that EVERY patient initially needed the same thing: More NUTRITION, to ELIMINATE more waste and to BOOST their immune system. No matter what their complaints were, these Foundational Formulas helped them ALL regain their health.</p>
<a class="read-more lightbox-text" href="#" data-identifier="home_section1_modal1">Read More &raquo;</a></div>
<div class="img-container"><img src="{{media url="wysiwyg/home/section1_article1.png"}}" alt="" /></div>
<div class="column col2">
<ul>
<li><a href="{{store direct_url="foundational/nutritional.html"}}">Nutrition &amp; Energy</a></li>
<li><a href="{{store direct_url="foundational/digestive-elimination.html"}}">Digestive &amp; Elimination</a></li>
<li><a href="{{store direct_url="foundational/immune.html"}}">Immune System Boosters</a></li>
<li><a href="{{store direct_url="foundational/jumpstart-your-health.html"}}">Starter Program</a></li>
</ul>
<div class="view-all"><a class="blink1" href="{{store direct_url="foundational.html"}}">VIEW ALL</a></div>
</div>
</article><article class="article2">
<div class="column col1">
<h3><a href="{{store direct_url="detox.html"}}">Detox &amp; Cleansing Programs</a></h3>
<p>Periodic cleansing and detoxification is one of the greatest ways to Create Powerful Health. These detox and cleansing programs have proven themselves effective in Dr. Schulze\'s clinic and in his customers\' homes for over 30 years!</p>
<a class="read-more lightbox-text" href="#" data-identifier="home_section1_modal2">Read More &raquo;</a></div>
<div class="img-container"><img src="{{media url="wysiwyg/home/section1_article2.png"}}" alt="" /></div>
<div class="column col2">
<ul>
<li><a href="{{store direct_url="detox/5-day-detox-programs.html"}}">5-Day Detox Programs</a></li>
<li><a href="{{store direct_url="detox/30-day-detox-program.html"}}">30-Day Detox</a></li>
<li><a href="{{store direct_url="detox/incurables-program.html"}}">Incurables Program</a></li>
<li><a href="{{store direct_url="detox/incurables-program.html"}}">Weight Management</a></li>
<li></li>
</ul>
<div class="view-all"><a class="blink1" href="{{store direct_url="detox.html"}}">VIEW ALL</a></div>
</div>
</article><article class="article3">
<div class="column col1">
<h3><a href="{{store direct_url="specific.html"}}">Specific Products</a></h3>
<p>From time to time in his clinical practice, Dr Schulze found that in addition to his Foundational Formulas, his patients needed more intense support for specific areas of the body. These Specific Formulas are the most powerfully effective products you can take to increase your health and vitality.</p>
<a class="read-more lightbox-text" href="#" data-identifier="home_section1_modal3">Read More &raquo;</a></div>
<div class="column col2">
<ul>
<li><a href="{{store direct_url="foundational/prevention.html"}}">Prevention</a></li>
<li><a href="{{store direct_url="foundational/detoxification.html"}}">Detoxification</a></li>
<li><a href="{{store direct_url="specific/cold-flu.html"}}">Cold &amp; Flu</a></li>
<li><a href="{{store direct_url="specific/circulation.html"}}">Circulation</a></li>
<li><a href="{{store direct_url="specific/nervine.html"}}">Nerve</a></li>
<li><a href="{{store direct_url="specific/female.html"}}">Female Only</a></li>
<li><a href="{{store direct_url="specific/male.html"}}">Male Only</a></li>
<li><a href="{{store direct_url="specific/eyes-mouth.html"}}">Eyes &amp; Mouth</a></li>
<li><a href="{{store direct_url="specific/external.html"}}">Topical</a></li>
</ul>
<div class="img-container"><img src="{{media url="wysiwyg/home/section1_article3.png"}}" alt="" /></div>
<div class="view-all"><a class="blink1" href="{{store direct_url="specific.html"}}">VIEW ALL</a></div>
</div>
</article></div>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Home Section2',
        'identifier' => 'home_section2',
        'content' => '
<div class="section2">
<h2>THE POWER OF OUR PRODUCTS</h2>
<h3>Learn About Dr. Schulze&rsquo;s Original Clinical Herbal Formulae</h3>
<div id="section-two-tabs">
<ul>
<li><a href="#section-two-1">DR. SCHULZE DIFFERENCE</a></li>
<li><a href="#section-two-2">SUPERFOOD STORY</a></li>
<li><a href="#section-two-3">TESTIMONIALS</a></li>
</ul>
<div id="section-two-1">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/106951187"><img src="{{media url="wysiwyg/home/section2_difference.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Dr. Schulze Difference</h3>
<p>To understand my herbal formulas, you must first understand me. After all, it is my life, my personal healing experiences, my wonderful patients and my clinical experience that created my values, the values that are now the core principles of this company. It is important that you know what is important to me, so you know exactly what you are purchasing.</p>
<a class="blink1">LEARN MORE</a></div>
</div>
<div id="section-two-2">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/107193655"><img src="{{media url="wysiwyg/home/section2_superfood.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Superfood Story</h3>
<p>Twenty-eight years ago, out of desperation, Dr. Schulze made his first crude batch of SuperFood for a terminally ill patient, in the kitchen of his clinic. The results were nothing short of miraculous. The patient beat the odds and completely recovered, and is still alive today. Over the last three decades, Dr. Schulze continued to make this formula for his patients and customers. This formula has not only brought the sick and dying back to life, but also gave everyone else the energy and vitality they needed to enjoy life more.</p>
<a class="blink1">LEARN MORE</a></div>
</div>
<div id="section-two-3">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/107193656"><img src="{{media url="wysiwyg/home/section2_testimonials.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Testimonials</h3>
<p>These are powerful healing results created by ordinary people who took responsibility for their health and have had extraordinary, empowering results, proving once again the power of natural healing and Dr. Schulze\'s formulas. Perhaps their path to healing is similar to yours, perhaps yours is completely different&mdash;for there are many paths to creating powerful health naturally, but there is usually one result: VIBRANCY and FREEDOM!</p>
<a class="blink1">LEARN MORE</a></div>
</div>
</div>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Home Section3',
        'identifier' => 'home_section3',
        'content' => '
<div class="section3">
<h2>A BRIEF INTRODUCTION</h2>
<h3>Meet the Foremost Authority on Natural Healing &amp; Herbal Medicine</h3>
<div id="section-three-tabs">
<ul>
<li><a href="#section-three-1">WELCOME</a></li>
<li><a href="#section-three-2">NATURAL HEALING</a></li>
<li><a href="#section-three-3">BLOG</a></li>
</ul>
<div id="section-three-1">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/106951187"><img src="{{media url="wysiwyg/home/section3_welcome.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Hello, I\'m Dr. Schulze</h3>
<p>My parents both had heart disease. They were under complete medical doctors\' care. They were allowed to smoke cigarettes, drink pots of coffee and excessive alcohol, consume outrageous amounts of sugar and live on a diet of almost pure animal fat, have a bowel movement once a week or less, never exercise, and were directed to take a dozen toxic, chemical pharmaceutical drugs to try and offset their toxic and lethal lifestyle. This medical program didn\'t work out for them...</p>
<a class="blink1">LEARN MORE</a></div>
</div>
<div id="section-three-2">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/106951187"><img src="{{media url="wysiwyg/home/section3_healing.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Natural Healing</h3>
<p>Question: What is Natural Healing? Click below to read Dr. Schulze\'s answer.</p>
<a class="blink1">LEARN MORE</a></div>
</div>
<div id="section-three-3">
<div class="image"><a class="lightbox-vimeo" href="https://vimeo.com/106951187"><img src="{{media url="wysiwyg/home/section3_blog.jpg"}}" alt="" /></a></div>
<div class="content">
<h3>Blog</h3>
<p>The mission of my BLOG is to illuminate and empower you with so much Natural Healing and Herbal Medicine Wisdom, Specifics, Remedies, Quick Fixes, Programs, Tools and general Know How, that whenever you need it, you\'ve got it. Every Wednesday, I post a new answer to one of your submitted questions or a new commentary on health and healing. And, I archive ALL of them, so you have an awesome LIBRARY of healing information right at your fingertips, anytime you need it. Plus, ALL of my BOOKS, CDs and DVDs are right on this site, too! You can READ any of my books, WATCH any of my DVDs or LISTEN to any of my CDs right on your computer, iPad or even your phone &ndash; anywhere you can get on the Internet! - Dr. Schulze</p>
<a class="blink1">LEARN MORE</a></div>
</div>
</div>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'MegaMenu-1-1',
        'identifier' => 'megamenu-1-1',
        'content' => '
<ul>
    <li><h5><a href="{{store direct_url="category"}}">Starter Kit</a></h5></li>
    <li><h5><a href="{{store direct_url="foundational/nutritional.html"}}">Nutrition & Energy</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Digestive & Elimination</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Immune System Boosters</a></h5></li>
    <li><a class="view-all" href="{{store direct_url="/foundational.html"}}">View All &raquo;</a></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'MegaMenu-1-2',
        'identifier' => 'megamenu-1-2',
        'content' => '
<ul>
    <li><h5><a href="{{store direct_url="category"}}">5-Day BOWEL Detox</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">5-Day LIVER Detox</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">5-Day KIDNEY Detox</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">30-Day Detox</a></h5></li>
    <li><h5><a href="{{store direct_url="detox/incurables-program.html"}}">Incurables Program</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Weight Management</a></h5></li>
    <li><a class="view-all" href="{{store direct_url="/detox.html"}}">View All &raquo;</a></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'MegaMenu-1-3',
        'identifier' => 'megamenu-1-3',
        'content' => '
<ul>
    <li><h5><a href="{{store direct_url="category"}}Prevention</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Detoxification</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Cold & Flu</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Circulation</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Nerve</a></h5></li>
    <li><h5><a href="{{store direct_url="/specific/female.html"}}">Female Only</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Male Only</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Eyes & Mouth</a></h5></li>
    <li><h5><a href="{{store direct_url="category"}}">Topical</a></h5></li>
    <li><a class="view-all" href="{{store direct_url="/specific.html"}}">View All &raquo;</a></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'MegaMenu-2-1',
        'identifier' => 'megamenu-2-1',
        'content' => '
<ul>
    <li><h5><a href="#">Our Difference</a></h5></li>
    <li><h5><a href="#">Frequently Asked Questions</a></h5></li>
    <li><h5><a href="#">QuickStart Directions</a></h5></li>
    <li><h5><a href="#">How To Use My Herbal Products</a></h5></li>
    <li><h5><a href="#">Dr. Schulze\'s Philosophy Of Health</a></h5></li>
    <li><h5><a href="#">Books, Audio, Video &amp; More</a></h5></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'MegaMenu-3-1',
        'identifier' => 'megamenu-3-1',
        'content' => '
<ul>
    <li><h5><a href="#">My Health Crusade</a></h5></li>
    <li><h5><a href="#">My Personal Healing Journey</a></h5></li>
    <li><h5><a href="#">Why My Formulas Are The Best</a></h5></li>
    <li><h5><a href="#">Dr. Schulze\'s Timeline</a></h5></li>
    <li><h5><a href="#">My Official BLOG</a></h5></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),

    array(
        'title' => 'MegaMenu Promos',
        'identifier' => 'megamenu_promo',
        'content' => '
<div class="img-container"><a href="#"><img src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) ?>wysiwyg/megamenu/promo1.jpg" alt="" title="" /></a></div>
<div class="img-container"><a href="#"><img src="<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) ?>wysiwyg/megamenu/promo2.jpg" alt="" title="" /></a></div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),

    array(
        'title' => 'Footer_Links1',
        'identifier' => 'footer_links1',
        'content' => '
<div class="links">
<h3>Products</h3>
<ul>
<li><a href="#">Foundational Products</a></li>
<li><a href="#">Clinical Programs</a></li>
<li><a href="#">Specific Products</a></li>
<li><a href="#">Healthy Incentives</a></li>
</ul>
</div>
<div class="links">
<h3>Learn</h3>
<ul>
<li><a href="#">About Natural Healing</a></li>
<li><a href="#">Free Books &amp; DVDs</a></li>
<li><a href="#">Real Stories</a></li>
<li><a href="#">Our Difference</a></li>
</ul>
</div>
<div class="links">
<h3>Dr. Schulze</h3>
<ul>
<li><a href="#">Biography</a></li>
<li><a href="http://herbdocblog.com/">Official BLOG</a></li>
<li><a href="#">Clinical Experience</a></li>
</ul>
</div>
<div class="links">
<h3>Customer Service</h3>
<ul>
<li><a href="#">Shipping</a></li>
<li><a href="#">Track Order</a></li>
<li><a href="#">Returns</a></li>
<li><a href="#">FAQ</a></li>
</ul>
</div>
<div class="links">
<h3>Company</h3>
<ul>
<li><a href="{{store direct_url="contacts"}}">Contact Us</a></li>
<li><a href="#">Store Location and Hours</a></li>
<li><a href="#">Privacy Policy</a></li>
<li><a href="#">Careers</a></li>
</ul>
</div>
            ',
            'is_active' => 1,
            'stores' => 0
    ),
    array(
        'title' => 'Footer Links2',
        'identifier' => 'footer_links2',
        'content' => '
        <h3>Shortcuts</h3>
<ul>
<li><a href="#">SuperFood Plus Powder</a></li>
<li><a href="#">SuperFood Plus Tablets</a></li>
<li><a href="#">SuperFood-100</a></li>
<li><a href="#">SuperFood Kids</a></li>
<li><a href="#">SuperFood Bars</a></li>
</ul>
<ul>
<li><a href="#">5-Day BOWEL Detox</a></li>
<li><a href="#">5-Day LIVER Detox</a></li>
<li><a href="#">5-Day KIDNEY Detox</a></li>
<li><a href="#">30-Day Detox Program</a></li>
<li><a href="#">24-Hr Bowel Detox</a></li>
</ul>
<ul>
<li><a href="#">Intestinal Formula #1</a></li>
<li><a href="#">Intestinal Formula #2</a></li>
<li><a href="#">Digestive Shot</a></li>
<li><a href="#">Bowel Shot</a></li>
<li><a href="#">HerbalMucil Plus</a></li>
</ul>
<ul>
<li><a href="#">Herbal Remedies</a></li>
<li><a href="#">Echinacea</a></li>
<li><a href="#">Cold &amp; Flu &ldquo;SHOT&rdquo;</a></li>
<li><a href="#">Eyes &amp; Mouth</a></li>
<li><a href="#">Heart Formula</a></li>
</ul>
<ul>
<li><a href="#">Super-C Plus</a></li>
<li><a href="#">Air Detox</a></li>
<li><a href="#">Female Formula</a></li>
<li><a href="#">Male Formula</a></li>
<li><a href="#">Vitality &ldquo;SHOT&rdquo;</a></li>
</ul>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Footer Links Company',
        'identifier' => 'footer_links_company',
        'content' => '
<div class="links">
<div class="block-title"><strong><span>Company</span></strong></div>
<ul>
<li><a href="{{store url=""}}about-magento-demo-store/">About Us</a></li>
<li><a href="{{store url=""}}contacts/">Contact Us</a></li>
<li><a href="{{store url=""}}customer-service/">Customer Service</a></li>
<li><a href="{{store url=""}}privacy-policy-cookie-restriction-mode/">Privacy Policy</a></li>
</ul>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Footer Seals',
        'identifier' => 'footer_seals',
        'content' => '
<p><a href="#"><img src="{{media url="wysiwyg/home/authorizenet.jpg"}}" alt="" /></a> <a href="#"><img src="{{media url="wysiwyg/home/siteluck.jpg"}}" alt="" /></a></p>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Category Menu Left Promo',
        'identifier' => 'category_menu_left_promo',
        'content' => '
<ul>
	<li><a href="#">INDEX OF AILMENTS</a></li>
</ul>
<div><a href="#"><img src="{{media url="wysiwyg/megamenu/promo1.jpg"}}" alt="" /></a></div>
<div><a href="#"><img src="{{media url="wysiwyg/megamenu/promo2.jpg"}}" alt="" /></a></div>
	',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Shopping Cart Shipping Message',
        'identifier' => 'shoppingcart_shipping_message',
        'content' => '
<h3>Shipping</h3>
<p>Your subtotal does not include sales tax or shipping. Sales tax applies for CA residents ONLY. Our shipping policy: Any package, any size, ships anywhere in the continental U.S. for $7.00 or LESS.</p>
    ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Checkout Success Quote',
        'identifier' => 'checkout_success_quote',
        'content' => '
<div class="quote">
    <p>Tomorrow is What You BELIEVE and DO Today!</p>
    <span>Dr. Richard Schulze</span>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Privacy Policy',
        'identifier' => 'privacy_policy',
        'content' => '
<h1>PRIVACY POLICY &amp; DISCLAIMER</h1>
<h2>Please read and scroll down to accept or decline</h2>
<p>Dr. Richard Schulze recognizes that personal decisions about creating powerful health are among the most important private decisions people can make. It is our purpose to protect the privacy that the community of people seeking natural healing expects. By entering this part of the web site, you are seeking and communicating about private issues regarding your health.</p>
<p>The health suggestions and opinions expressed by Dr. Richard Schulze in this website are based on his 30 years of clinical practice assisting thousands of patients to heal themselves.</p>
<p>Warning: his knowledge and experience are not necessarily shared, nor have they been evaluated or approved by the F.D.A., the A.M.A., or any other 3-lettered federal, state, local or private agency. With regard to any dietary substances discussed herein, we are required to state in accordance with DSHEA, the Dietary Health and Education Act of 1994, "These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure or prevent any disease."</p>
<p>Dr. Schulze discusses therapies and products that may have benefit which are not offered to diagnose or prescribe for medical or psychological conditions nor to claim to prevent, treat, mitigate or cure such conditions, nor to make recommendations for treatment of disease or to provide diagnosis, care, treatment or rehabilitation of individuals, or apply medical, mental health or human development principles.</p>
<p>Therefore, if you are ill, have any disease, are pregnant, or just improving your health, we are required to warn you to go to a medical doctor for medical advice, treatment and services.</p>
<p>Upon entering and/or purchasing from this site, you hereby agree to take full responsibility for yourself, your health and release, indemnify and hold harmless, Dr. Richard Schulze, American Botanical Pharmacy, Natural Healing Publications, their employees and heirs. You are entering a community for natural healing and seeking information and products based on those principles thereby granting a private license to the above to provide you the information herein.</p>
<p>All written material and images copyrighted 2008. Many people have been unscrupulous and misused Dr. Schulze\'s copyrighted material and images to mislead the public and sell them inferior products that may have made people sick or even die. Therefore, we are very serious about enforcing our copyright infringement policies to help protect the health and well-being of our customers.</p>
<p>If you agree with all of the above, and if you are acting as a private person without subterfuge or as a public agent, you may enter and/or purchase from this web site.</p>
<div class="button-container"><a class="accept blink1" href="#">I ACCEPT</a><a class="decline blink2" href="{{store url=""}}">I DECLINE</a></div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Promotion1',
        'identifier' => 'promotion1',
        'content' => '
<div class="promotion promotion1">
    <h3>FREE SHIPPING on all orders over $50</h3>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Email Signup',
        'identifier' => 'email_signup',
        'content' => '
<div id="email-signup-container">
    <div class="close top"></div>
    <div class="content">
        <p>Enter your email below for</p>
        <h1>A free SUPERFOOD PLUS sample packet</h1>
        <p>with any purchase</p>
        {{block type="newsletter/subscribe" template="newsletter/subscribe.phtml"}}
        <a href="#">Learn more about SuperFood</a>
    </div>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Home Section1 Title',
        'identifier' => 'home_section1_title',
        'content' => '
<div class="title section1">
<h2>A MIRACLE IN EVERY BOTTLE</h2>
<h1>Shop Dr. Schulze\'s Original Clinical Herbal Formulae</h1>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    ),
    array(
        'title' => 'Store Section1 Title',
        'identifier' => 'store_section1_title',
        'content' => '
<div class="title section1">
<h2>SHOP BY CATEGORY</h2>
<h1>Shop Dr. Schulze\'s Original Clinical Herbal Formulae</h1>
</div>
        ',
        'is_active' => 1,
        'stores' => 0
    )
);

foreach ($cmsBlocksData as $cmsBlockData) {
	$cmsBlock = Mage::getModel('cms/block')->load($cmsBlockData['identifier']);
	if (!$cmsBlock->hasData()) {
		Mage::getModel('cms/block')->setData($cmsBlockData)->save();
	}
}

/*
 * Create banners.
 */
$banners = array(
    array('content', 'Banner1', '
    <div class="content-container">
    <div class="image desktop" style="background-image: url({{media url="wysiwyg/banners/banner1.jpg"}})">
    <div class="image mobile" style="background-image: url({{media url="wysiwyg/banners/banner1mobile.jpg"}})">
    <div class="content template1">
    <div class="content-inner-tube">
    <h2>Health is <span>FREEDOM</span></h2>
    <p>Being HEALTHY gives you the FREEDOM to live your life the way you want, the ENERGY to do all of the things that you want to do, and the VITALITY to have all of the fun that you want to have...and to really, really enjoy your LIFE to your fullest potential!</p>
    <a class="read-more" href="#">Read More &raquo;</a>
    <div class="blink-container"><a class="blink" href="#">EXPLORE OUR PRODUCTS</a></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    '),
    array('content', 'Banner2', '
    <div class="content-container">
    <div class="image desktop" style="background-image: url({{media url="wysiwyg/banners/banner2.jpg"}})">
    <div class="image mobile" style="background-image: url({{media url="wysiwyg/banners/banner2mobile.jpg"}})">
    <div class="product-container"><img src="{{media url="wysiwyg/banners/banner2product.png"}}" alt="" /></div>
    <div class="content template2">
    <div class="content-inner-tube">
    <h2><span>REAL</span> Vitamin-C!</h2>
    <p>Nature\'s Berry, Herbal and Fruit<br/>Vitamin-C Complex with<br/>over 500% Vitamin-C Per Serving!</p>
    <a class="read-more" href="#">Read More &raquo;</a>
    <div class="blink-container"><a class="blink" href="#">Learn More</a></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    '),
    array('content', 'Banner3', '
    <div class="content-container">
    <div class="image desktop" style="background-image: url({{media url="wysiwyg/banners/banner3.jpg"}})">
    <div class="image mobile" style="background-image: url({{media url="wysiwyg/banners/banner3mobile.jpg"}})">
    <div class="product-container"><img src="{{media url="wysiwyg/banners/banner3product.png"}}" alt="" /></div>
    <div class="content template2">
    <div class="content-inner-tube">
    <h2>Get a <span>HEROIC</span> Dose!</h2>
    <p>Dr. Schulze\'s ultimate weapon to prevent,<br/>fight-off, and stop ANY cold or flu!</p>
    <a class="read-more" href="#">Read More &raquo;</a>
    <div class="blink-container"><a class="blink" href="#">Learn More</a></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    '),
    array('content', 'Store', '
    <div class="content-container">
        <div class="image desktop" style="background-image: url({{media url="wysiwyg/cms/store/banner.jpg"}})">
            <div class="image mobile" style="background-image: url({{media url="wysiwyg/cms/store/bannermobile.jpg"}})">
            <div class="product-container"><img src="{{media url="wysiwyg/cms/store/product.png"}}" alt="" /></div>
                <div class="promotion-container">
                    <a href="#"><img src="{{media url="wysiwyg/megamenu/promo1.jpg"}}" alt="" /></a>
	                <a href="#"><img src="{{media url="wysiwyg/megamenu/promo2.jpg"}}" alt="" /></a>
                </div>
                <div class="content">
                    <h2>New Super-C Plus</h2>
                    <p>Over 500% Vitamin-C COMPLEX per serving!<p>
                    <p>NO Ascorbic Acid</p>
                    <p>NO Extracted, Isolated or Synthetic Vitamins!</p>
                    <p>NO Gluten, NO Sugar!</p>
                    <div class="blink-container"><a class="blink" href="#">LEARN MORE</a></div>
                </div>
            </div>
        </div>
    </div>
    '),
    array('content', 'Healthy Savings', '
    <div class="content-container">
        <div class="image desktop" style="background-image: url({{media url="wysiwyg/cms/healthysavings/banner.jpg"}})">
            <div class="image mobile" style="background-image: url({{media url="wysiwyg/cms/healthysavings/bannermobile.jpg"}})">
                <div class="product-container"><img src="{{media url="wysiwyg/cms/healthysavings/product.png"}}" alt="" /></div>
                <div class="content">
                    <h2>Buy 2 Get 1 Free <span>Protect Formula</span></h2>
                    <a href="#">More Info &#187;</a>
                    <ul>
                        <li>Contains herbs used to PROTECT the heart, liver and brain</li>
                        <li>Contains the three most POWERFUL herbal antioxidants</li>
                        <li>Especially for people who are worried about their HEALTH</li>
                    </ul>
                    <p class="saving">Saving $36.00</p>
                    <p class="only">Only $72.00</p>
                    <div>{{block type="aydus_singleproduct/product" product_id="2" template="aydus/singleproduct/product.phtml"}}</div>
                </div>
            </div>
        </div>
    </div>
    '),
);

foreach ($banners as $sortOrder => $bannerData) {

    $banner = Mage::getModel('enterprise_banner/banner')->load($bannerData[1], 'name');

    if (!$banner->hasData()) {
        $banner->setName($bannerData[1])
            ->setIsEnabled(1)
            ->setTypes('enhanced')
            ->setStoreContents(array(0 => $bannerData[2]))
            ->save();
    }
}

// Attribute: type. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','type')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'type', array(
        'group'                      => 'General',
        'type'                       => 'int',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Type',
        'input'                      => 'select',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => false,
        'option' => array (
            'values' => array (
                0 => 'Capsules',
                1 => 'Packets',
                2 => 'Powder',
                3 => 'Tablets',
            ),
        ),
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: size. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','size')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'size', array(
        'group'                      => 'General',
        'type'                       => 'varchar',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Size',
        'input'                      => 'text',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => false
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: ingredients. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','ingredients')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'ingredients', array(
        'group'                      => 'General',
        'type'                       => 'text',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Ingredients',
        'input'                      => 'textarea',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => true
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: how_it_works. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','how_it_works')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'how_it_works', array(
        'group'                      => 'General',
        'type'                       => 'text',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'How It Works',
        'input'                      => 'textarea',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => true
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: why_you_need_it. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','why_you_need_it')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'why_you_need_it', array(
        'group'                      => 'General',
        'type'                       => 'text',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Why You Need It',
        'input'                      => 'textarea',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => true
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: vitamins. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','vitamins')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'vitamins', array(
        'group'                      => 'General',
        'type'                       => 'text',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Vitamins',
        'input'                      => 'textarea',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => true
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

// Attribute: testimonials. Add attribute to product entity.
if (null == Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','testimonials')->getId()) {

    $catalogInstaller = Mage::getResourceModel('catalog/setup', 'catalog_setup');
    $catalogInstaller->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'testimonials', array(
        'group'                      => 'General',
        'type'                       => 'text',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Testimonials',
        'input'                      => 'textarea',
        'class'                      => '',
        'source'                     => '',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => false,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => false,
        'used_in_product_listing'    => false,
        'unique'                     => false,
        'apply_to'                   => '',
        'wysiwyg_enabled'            => false,
        'is_html_allowed_on_front'   => true
    ));
    $attribute = new Mage_Eav_Model_Entity_Attribute();
}

echo 'Init setup complete.';
$installer->endSetup();