Aydus_FeaturedProducts
Author: Matthew Valenti (matthew@aydus.com)

This extension/widget displays featured products as a category block (with all default category features).

To use: Create a featured category and add products.  Add the following to Custom Design -> Layout Update XML field.
Update the category_name parameter to match the category name.

Supports the following parameters:
template: phtml template to render products. uses catalog/product/list.phtml by default.
layout mode: list/grid
category name: name of featured category to display
category id: id of featured category to display
column count: number of columns phtml will render

<reference name="content">
	<block type="aydus_featuredproducts/featured" name="featuredProducts">
		 <action method="setData"><key>template</key><value>catalog/product/list.phtml</value></action>
		 <action method="setData"><key>mode</key><value>grid</value></action>
		 <action method="setData"><key>category_name</key><value>Featured</value></action>
		 <action method="setData"><key>column_count</key><value>5</value></action>
		 <!-- Add empty blocks to avoid template error in Magento  1.14.x -->
		 <block type="core/text_list" name="product_list.name.after" as="name.after" />
		 <block type="core/text_list" name="product_list.after" as="after" />
	</block>
</reference>

or wrap the featured products in a phtml parent block

<reference name="content">
    <block type="core/template" name="homeHotStyles" template="page/home/hot_styles.phtml">
        <block type="aydus_featuredproducts/featured" name="featuredProducts">
             <action method="setData"><key>template</key><value>catalog/product/list.phtml</value></action>
             <action method="setData"><key>mode</key><value>grid</value></action>
             <action method="setData"><key>category_name</key><value>Featured</value></action>
             <action method="setData"><key>column_count</key><value>5</value></action>
             <!-- Add empty blocks to avoid template error in Magento  1.14.x -->
             <block type="core/text_list" name="product_list.name.after" as="name.after" />
             <block type="core/text_list" name="product_list.after" as="after" />
        </block>
    </block>
</reference>