Aydus_Redirector
Author: Jared Blalock (jared@aydus.com)
Date: 4/3/2013

This module is used to map legacy URLs to new ones with 301   
Observer for noRoute, parse CSV for potential redirects

NOTE: If loading from a legacy value from a custom attribute
ensure it is set to "Used in Product Listing" or Flat catalog/products
will not contain the value needed for lookups!

The CSV can be located under this modules etc folder as redirects.csv
 
ONE to ONE Mapping:
column 1: Previous Legacy URL Path
column 2: New Full URL Path

Product ID Mapping:
column 1: Previous Legacy URL Path
column 2: 'product'
column 3: Magento Product Entity ID
column 4: websiteID (optional default to 1)
column 5: storeID (optional default to 1)

Category ID Mapping:
column 1: Previous Legacy URL Path
column 2: 'category'
column 3: Magento Category Entity ID
column 4: websiteID (optional default to 1)
column 5: storeID (optional default to 1)

Regular Expression Mapping:
column 1: 'regex'
column 2: regular expression
column 3: 'category' or 'product'
column 4: Category or Product Legacy ID Attribute name for lookups

Regular Expression Search:
column 1: 'regex'
column 2: regular expression
column 3: 'search'

Example CSV Entries:
   
www.shop.com/product13,product,166,1,1
www.shop.com/category13,category,11,1,1
www.shop.com/old-url,www.myshop.com/htc-touch-diamond.html
regex,/p([0-9]+)./i,product,legacy_product_id
regex,/c([0-9]+)./i,category,legacy_cat_id
regex,/setadvancedsearch.asp\?what\=(.+).*$/i,search