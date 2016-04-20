<?php


$thisfile_URL = "https://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$thisdir_URL  = substr($thisfile_URL, 0, strrpos($thisfile_URL, '/')).'/';
$thisfile_ABS = $_SERVER['SCRIPT_FILENAME'];
$thisdir_ABS  =  substr($thisfile_ABS, 0, strrpos($thisfile_ABS, '/')).'/';



$email_to_send_to = 'mlin@herbdoc.com'; //'eesquivias@herbdoc.com';


$name_of_survey = 'Survey';


$open_template         = $thisdir_ABS."templates/open.php";
$close_template        = $thisdir_ABS."templates/close.php";
$survey_heading_page   = $thisdir_ABS."templates/head.php";
$survey_center_page    = $thisdir_ABS."templates/center.php";
$survey_complete_page  = $thisdir_ABS."templates/done.php";


$charset = 'ISO-8859-1';

$question['0']['type'] = 'text';
$question['0']['desc4'] = 'First Name';
$question['0']['deft'] = 'First Name';
$question['0']['opts']['maxl'] = '50';
$question['0']['opts']['size'] = '30';

$question['1']['type'] = 'text';
$question['1']['desc4'] = 'Last Name';
$question['1']['deft'] = 'Last Name';
$question['1']['opts']['maxl'] = '50';
$question['1']['opts']['size'] = '30';

$question['2']['type'] = 'text';
$question['2']['desc4'] = 'Email';
$question['2']['deft'] = 'Email';
$question['2']['opts']['maxl'] = '50';
$question['2']['opts']['size'] = '30';

$question['3']['type'] = 'text';
$question['3']['desc4'] = 'Street 1';
$question['3']['deft'] = 'Street 1';
$question['3']['opts']['maxl'] = '50';
$question['3']['opts']['size'] = '30';

$question['4']['type'] = 'text';
$question['4']['desc4'] = 'Street 2';
$question['4']['deft'] = 'Street 2';
$question['4']['opts']['maxl'] = '50';
$question['4']['opts']['size'] = '30';

$question['5']['type'] = 'text';
$question['5']['desc4'] = 'City';
$question['5']['deft'] = 'City';
$question['5']['opts']['maxl'] = '50';
$question['5']['opts']['size'] = '30';

$question['6']['type'] = 'text';
$question['6']['desc4'] = 'State';
$question['6']['deft'] = 'State';
$question['6']['opts']['maxl'] = '50';
$question['6']['opts']['size'] = '30';

$question['7']['type'] = 'text';
$question['7']['desc4'] = 'Zip';
$question['7']['deft'] = 'Zip';
$question['7']['opts']['maxl'] = '50';
$question['7']['opts']['size'] = '30';

$question['8']['type'] = 'text';
$question['8']['desc4'] = 'Phone';
$question['8']['deft'] = 'Phone';
$question['8']['opts']['maxl'] = '50';
$question['8']['opts']['size'] = '30';

$question['9']['type'] = 'select';
$question['9']['desc'] = '<br /><br />';
$question['9']['deft'] = 'n';
$question['9']['desc2'] = 'Knowledge & Theory';
$question['9']['opts'][] = '--';
$question['9']['opts'][] = '1';
$question['9']['opts'][] = '2';
$question['9']['opts'][] = '3';
$question['9']['opts'][] = '4';
$question['9']['opts'][] = '5';
$question['9']['opts'][] = '6';
$question['10']['type'] = 'select';
$question['10']['deft'] = 'n';
$question['10']['desc2'] = 'Prestige & Power';
$question['10']['opts'][] = '--';
$question['10']['opts'][] = '1';
$question['10']['opts'][] = '2';
$question['10']['opts'][] = '3';
$question['10']['opts'][] = '4';
$question['10']['opts'][] = '5';
$question['10']['opts'][] = '6';
$question['11']['type'] = 'select';
$question['11']['deft'] = 'n';
$question['11']['desc2'] = 'Principle & Beliefs';
$question['11']['opts'][] = '--';
$question['11']['opts'][] = '1';
$question['11']['opts'][] = '2';
$question['11']['opts'][] = '3';
$question['11']['opts'][] = '4';
$question['11']['opts'][] = '5';
$question['11']['opts'][] = '6';
$question['12']['type'] = 'select';
$question['12']['deft'] = 'n';
$question['12']['desc2'] = 'Harmony & Unity';
$question['12']['opts'][] = '--';
$question['12']['opts'][] = '1';
$question['12']['opts'][] = '2';
$question['12']['opts'][] = '3';
$question['12']['opts'][] = '4';
$question['12']['opts'][] = '5';
$question['12']['opts'][] = '6';
$question['13']['type'] = 'select';
$question['13']['deft'] = 'n';
$question['13']['desc2'] = 'Efficiency & Productivity';
$question['13']['opts'][] = '--';
$question['13']['opts'][] = '1';
$question['13']['opts'][] = '2';
$question['13']['opts'][] = '3';
$question['13']['opts'][] = '4';
$question['13']['opts'][] = '5';
$question['13']['opts'][] = '6';
$question['14']['type'] = 'select';
$question['14']['deft'] = 'n';
$question['14']['desc2'] = 'Sympathetic & Selfless';
$question['14']['opts'][] = '--';
$question['14']['opts'][] = '1';
$question['14']['opts'][] = '2';
$question['14']['opts'][] = '3';
$question['14']['opts'][] = '4';
$question['14']['opts'][] = '5';
$question['14']['opts'][] = '6';
/* ******* */
$question['15']['desc'] = '<br /><br />';
$question['15']['type'] = 'select';
$question['15']['deft'] = 'n';
$question['15']['desc2'] = 'Being a leader';
$question['15']['opts'][] = '--';
$question['15']['opts'][] = '1';
$question['15']['opts'][] = '2';
$question['15']['opts'][] = '3';
$question['15']['opts'][] = '4';
$question['15']['opts'][] = '5';
$question['15']['opts'][] = '6';
$question['16']['type'] = 'select';
$question['16']['deft'] = 'n';
$question['16']['desc2'] = 'Protecting my beliefs';
$question['16']['opts'][] = '--';
$question['16']['opts'][] = '1';
$question['16']['opts'][] = '2';
$question['16']['opts'][] = '3';
$question['16']['opts'][] = '4';
$question['16']['opts'][] = '5';
$question['16']['opts'][] = '6';
$question['17']['type'] = 'select';
$question['17']['deft'] = 'n';
$question['17']['desc2'] = 'Appreciating beauty or nature';
$question['17']['opts'][] = '--';
$question['17']['opts'][] = '1';
$question['17']['opts'][] = '2';
$question['17']['opts'][] = '3';
$question['17']['opts'][] = '4';
$question['17']['opts'][] = '5';
$question['17']['opts'][] = '6';
$question['18']['type'] = 'select';
$question['18']['deft'] = 'n';
$question['18']['desc2'] = 'Maximizing my time';
$question['18']['opts'][] = '--';
$question['18']['opts'][] = '1';
$question['18']['opts'][] = '2';
$question['18']['opts'][] = '3';
$question['18']['opts'][] = '4';
$question['18']['opts'][] = '5';
$question['18']['opts'][] = '6';
$question['19']['type'] = 'select';
$question['19']['deft'] = 'n';
$question['19']['desc2'] = 'Serving others';
$question['19']['opts'][] = '--';
$question['19']['opts'][] = '1';
$question['19']['opts'][] = '2';
$question['19']['opts'][] = '3';
$question['19']['opts'][] = '4';
$question['19']['opts'][] = '5';
$question['19']['opts'][] = '6';
$question['20']['type'] = 'select';
$question['20']['deft'] = 'n';
$question['20']['desc2'] = 'Expanding my knowledge';
$question['20']['opts'][] = '--';
$question['20']['opts'][] = '1';
$question['20']['opts'][] = '2';
$question['20']['opts'][] = '3';
$question['20']['opts'][] = '4';
$question['20']['opts'][] = '5';
$question['20']['opts'][] = '6';

$question['21']['type'] = 'select';
$question['21']['deft'] = 'n';
$question['21']['desc'] = '<br /><br />';
$question['21']['desc2'] = 'Volunteer work';
$question['21']['opts'][] = '--';
$question['21']['opts'][] = '1';
$question['21']['opts'][] = '2';
$question['21']['opts'][] = '3';
$question['21']['opts'][] = '4';
$question['21']['opts'][] = '5';
$question['21']['opts'][] = '6';
$question['22']['type'] = 'select';
$question['22']['deft'] = 'n';
$question['22']['desc2'] = 'Studying new concepts';
$question['22']['opts'][] = '--';
$question['22']['opts'][] = '1';
$question['22']['opts'][] = '2';
$question['22']['opts'][] = '3';
$question['22']['opts'][] = '4';
$question['22']['opts'][] = '5';
$question['22']['opts'][] = '6';
$question['23']['type'] = 'select';
$question['23']['deft'] = 'n';
$question['23']['desc2'] = 'Coaching and organizing others';
$question['23']['opts'][] = '--';
$question['23']['opts'][] = '1';
$question['23']['opts'][] = '2';
$question['23']['opts'][] = '3';
$question['23']['opts'][] = '4';
$question['23']['opts'][] = '5';
$question['23']['opts'][] = '6';
$question['24']['type'] = 'select';
$question['24']['deft'] = 'n';
$question['24']['desc2'] = 'Investing/Spending money';
$question['24']['opts'][] = '--';
$question['24']['opts'][] = '1';
$question['24']['opts'][] = '2';
$question['24']['opts'][] = '3';
$question['24']['opts'][] = '4';
$question['24']['opts'][] = '5';
$question['24']['opts'][] = '6';
$question['25']['type'] = 'select';
$question['25']['deft'] = 'n';
$question['25']['desc2'] = 'Experiencing a performance';
$question['25']['opts'][] = '--';
$question['25']['opts'][] = '1';
$question['25']['opts'][] = '2';
$question['25']['opts'][] = '3';
$question['25']['opts'][] = '4';
$question['25']['opts'][] = '5';
$question['25']['opts'][] = '6';
$question['26']['type'] = 'select';
$question['26']['deft'] = 'n';
$question['26']['desc2'] = 'Discussing my views';
$question['26']['opts'][] = '--';
$question['26']['opts'][] = '1';
$question['26']['opts'][] = '2';
$question['26']['opts'][] = '3';
$question['26']['opts'][] = '4';
$question['26']['opts'][] = '5';
$question['26']['opts'][] = '6';

$question['27']['type'] = 'select';
$question['27']['deft'] = 'n';
$question['27']['desc'] = '<br /><br />';
$question['27']['desc2'] = 'Recognition';
$question['27']['opts'][] = '--';
$question['27']['opts'][] = '1';
$question['27']['opts'][] = '2';
$question['27']['opts'][] = '3';
$question['27']['opts'][] = '4';
$question['27']['opts'][] = '5';
$question['27']['opts'][] = '6';
$question['28']['type'] = 'select';
$question['28']['deft'] = 'n';
$question['28']['desc2'] = 'Continuing education';
$question['28']['opts'][] = '--';
$question['28']['opts'][] = '1';
$question['28']['opts'][] = '2';
$question['28']['opts'][] = '3';
$question['28']['opts'][] = '4';
$question['28']['opts'][] = '5';
$question['28']['opts'][] = '6';
$question['29']['type'] = 'select';
$question['29']['deft'] = 'n';
$question['29']['desc2'] = 'Traditional values';
$question['29']['opts'][] = '--';
$question['29']['opts'][] = '1';
$question['29']['opts'][] = '2';
$question['29']['opts'][] = '3';
$question['29']['opts'][] = '4';
$question['29']['opts'][] = '5';
$question['29']['opts'][] = '6';
$question['30']['type'] = 'select';
$question['30']['deft'] = 'n';
$question['30']['desc2'] = 'Assisting others';
$question['30']['opts'][] = '--';
$question['30']['opts'][] = '1';
$question['30']['opts'][] = '2';
$question['30']['opts'][] = '3';
$question['30']['opts'][] = '4';
$question['30']['opts'][] = '5';
$question['30']['opts'][] = '6';
$question['31']['type'] = 'select';
$question['31']['deft'] = 'n';
$question['31']['desc2'] = 'Increasing my personal assets';
$question['31']['opts'][] = '--';
$question['31']['opts'][] = '1';
$question['31']['opts'][] = '2';
$question['31']['opts'][] = '3';
$question['31']['opts'][] = '4';
$question['31']['opts'][] = '5';
$question['31']['opts'][] = '6';
$question['32']['type'] = 'select';
$question['32']['deft'] = 'n';
$question['32']['desc2'] = 'Self expression';
$question['32']['opts'][] = '--';
$question['32']['opts'][] = '1';
$question['32']['opts'][] = '2';
$question['32']['opts'][] = '3';
$question['32']['opts'][] = '4';
$question['32']['opts'][] = '5';
$question['32']['opts'][] = '6';

$question['33']['type'] = 'select';
$question['33']['deft'] = 'n';
$question['33']['desc'] = '<br /><br />';
$question['33']['desc2'] = 'Enjoying the experience';
$question['33']['opts'][] = '--';
$question['33']['opts'][] = '1';
$question['33']['opts'][] = '2';
$question['33']['opts'][] = '3';
$question['33']['opts'][] = '4';
$question['33']['opts'][] = '5';
$question['33']['opts'][] = '6';
$question['34']['type'] = 'select';
$question['34']['deft'] = 'n';
$question['34']['desc2'] = 'Researching new ideas';
$question['34']['opts'][] = '--';
$question['34']['opts'][] = '1';
$question['34']['opts'][] = '2';
$question['34']['opts'][] = '3';
$question['34']['opts'][] = '4';
$question['34']['opts'][] = '5';
$question['34']['opts'][] = '6';
$question['35']['type'] = 'select';
$question['35']['deft'] = 'n';
$question['35']['desc2'] = 'Growing a business';
$question['35']['opts'][] = '--';
$question['35']['opts'][] = '1';
$question['35']['opts'][] = '2';
$question['35']['opts'][] = '3';
$question['35']['opts'][] = '4';
$question['35']['opts'][] = '5';
$question['35']['opts'][] = '6';
$question['36']['type'] = 'select';
$question['36']['deft'] = 'n';
$question['36']['desc2'] = 'Leading others';
$question['36']['opts'][] = '--';
$question['36']['opts'][] = '1';
$question['36']['opts'][] = '2';
$question['36']['opts'][] = '3';
$question['36']['opts'][] = '4';
$question['36']['opts'][] = '5';
$question['36']['opts'][] = '6';
$question['37']['type'] = 'select';
$question['37']['deft'] = 'n';
$question['37']['desc2'] = 'Applying my principles';
$question['37']['opts'][] = '--';
$question['37']['opts'][] = '1';
$question['37']['opts'][] = '2';
$question['37']['opts'][] = '3';
$question['37']['opts'][] = '4';
$question['37']['opts'][] = '5';
$question['37']['opts'][] = '6';
$question['38']['type'] = 'select';
$question['38']['deft'] = 'n';
$question['38']['desc2'] = 'Promoting humanitarian efforts';
$question['38']['opts'][] = '--';
$question['38']['opts'][] = '1';
$question['38']['opts'][] = '2';
$question['38']['opts'][] = '3';
$question['38']['opts'][] = '4';
$question['38']['opts'][] = '5';
$question['38']['opts'][] = '6';

$question['39']['type'] = 'select';
$question['39']['deft'] = 'n';
$question['39']['desc'] = '<br /><br />';
$question['39']['desc2'] = 'Exploring my system for living';
$question['39']['opts'][] = '--';
$question['39']['opts'][] = '1';
$question['39']['opts'][] = '2';
$question['39']['opts'][] = '3';
$question['39']['opts'][] = '4';
$question['39']['opts'][] = '5';
$question['39']['opts'][] = '6';
$question['40']['type'] = 'select';
$question['40']['deft'] = 'n';
$question['40']['desc2'] = 'Helping groups in need';
$question['40']['opts'][] = '--';
$question['40']['opts'][] = '1';
$question['40']['opts'][] = '2';
$question['40']['opts'][] = '3';
$question['40']['opts'][] = '4';
$question['40']['opts'][] = '5';
$question['40']['opts'][] = '6';
$question['41']['type'] = 'select';
$question['41']['deft'] = 'n';
$question['41']['desc2'] = 'Leadership roles';
$question['41']['opts'][] = '--';
$question['41']['opts'][] = '1';
$question['41']['opts'][] = '2';
$question['41']['opts'][] = '3';
$question['41']['opts'][] = '4';
$question['41']['opts'][] = '5';
$question['41']['opts'][] = '6';
$question['42']['type'] = 'select';
$question['42']['deft'] = 'n';
$question['42']['desc2'] = 'Generating resources for the future';
$question['42']['opts'][] = '--';
$question['42']['opts'][] = '1';
$question['42']['opts'][] = '2';
$question['42']['opts'][] = '3';
$question['42']['opts'][] = '4';
$question['42']['opts'][] = '5';
$question['42']['opts'][] = '6';
$question['43']['type'] = 'select';
$question['43']['deft'] = 'n';
$question['43']['desc2'] = 'Additional education';
$question['43']['opts'][] = '--';
$question['43']['opts'][] = '1';
$question['43']['opts'][] = '2';
$question['43']['opts'][] = '3';
$question['43']['opts'][] = '4';
$question['43']['opts'][] = '5';
$question['43']['opts'][] = '6';
$question['44']['type'] = 'select';
$question['44']['deft'] = 'n';
$question['44']['desc2'] = 'Beautify my surroundings';
$question['44']['opts'][] = '--';
$question['44']['opts'][] = '1';
$question['44']['opts'][] = '2';
$question['44']['opts'][] = '3';
$question['44']['opts'][] = '4';
$question['44']['opts'][] = '5';
$question['44']['opts'][] = '6';


$question['45']['type'] = 'select';
$question['45']['deft'] = 'n';
$question['45']['desc'] = '<br /><br />';
$question['45']['desc2'] = 'Creating harmony and balance';
$question['45']['opts'][] = '--';
$question['45']['opts'][] = '1';
$question['45']['opts'][] = '2';
$question['45']['opts'][] = '3';
$question['45']['opts'][] = '4';
$question['45']['opts'][] = '5';
$question['45']['opts'][] = '6';
$question['46']['type'] = 'select';
$question['46']['deft'] = 'n';
$question['46']['desc2'] = 'Achieving position of recognition';
$question['46']['opts'][] = '--';
$question['46']['opts'][] = '1';
$question['46']['opts'][] = '2';
$question['46']['opts'][] = '3';
$question['46']['opts'][] = '4';
$question['46']['opts'][] = '5';
$question['46']['opts'][] = '6';
$question['47']['type'] = 'select';
$question['47']['deft'] = 'n';
$question['47']['desc2'] = 'Making a charitable contribution';
$question['47']['opts'][] = '--';
$question['47']['opts'][] = '1';
$question['47']['opts'][] = '2';
$question['47']['opts'][] = '3';
$question['47']['opts'][] = '4';
$question['47']['opts'][] = '5';
$question['47']['opts'][] = '6';
$question['48']['type'] = 'select';
$question['48']['deft'] = 'n';
$question['48']['desc2'] = 'Maximizing resources';
$question['48']['opts'][] = '--';
$question['48']['opts'][] = '1';
$question['48']['opts'][] = '2';
$question['48']['opts'][] = '3';
$question['48']['opts'][] = '4';
$question['48']['opts'][] = '5';
$question['48']['opts'][] = '6';
$question['49']['type'] = 'select';
$question['49']['deft'] = 'n';
$question['49']['desc2'] = 'Gaining knowledge';
$question['49']['opts'][] = '--';
$question['49']['opts'][] = '1';
$question['49']['opts'][] = '2';
$question['49']['opts'][] = '3';
$question['49']['opts'][] = '4';
$question['49']['opts'][] = '5';
$question['49']['opts'][] = '6';
$question['50']['type'] = 'select';
$question['50']['deft'] = 'n';
$question['50']['desc2'] = 'Supporting groups with similar beliefs';
$question['50']['opts'][] = '--';
$question['50']['opts'][] = '1';
$question['50']['opts'][] = '2';
$question['50']['opts'][] = '3';
$question['50']['opts'][] = '4';
$question['50']['opts'][] = '5';
$question['50']['opts'][] = '6';

$question['51']['type'] = 'select';
$question['51']['deft'] = 'n';
$question['51']['desc'] = '<br /><br />';
$question['51']['desc2'] = 'Help for the homeless';
$question['51']['opts'][] = '--';
$question['51']['opts'][] = '1';
$question['51']['opts'][] = '2';
$question['51']['opts'][] = '3';
$question['51']['opts'][] = '4';
$question['51']['opts'][] = '5';
$question['51']['opts'][] = '6';
$question['52']['type'] = 'select';
$question['52']['deft'] = 'n';
$question['52']['desc2'] = 'Creating a winning strategy';
$question['52']['opts'][] = '--';
$question['52']['opts'][] = '1';
$question['52']['opts'][] = '2';
$question['52']['opts'][] = '3';
$question['52']['opts'][] = '4';
$question['52']['opts'][] = '5';
$question['52']['opts'][] = '6';
$question['53']['type'] = 'select';
$question['53']['deft'] = 'n';
$question['53']['desc2'] = 'Life long learning';
$question['53']['opts'][] = '--';
$question['53']['opts'][] = '1';
$question['53']['opts'][] = '2';
$question['53']['opts'][] = '3';
$question['53']['opts'][] = '4';
$question['53']['opts'][] = '5';
$question['53']['opts'][] = '6';
$question['54']['type'] = 'select';
$question['54']['deft'] = 'n';
$question['54']['desc2'] = 'Balance in all areas of life';
$question['54']['opts'][] = '--';
$question['54']['opts'][] = '1';
$question['54']['opts'][] = '2';
$question['54']['opts'][] = '3';
$question['54']['opts'][] = '4';
$question['54']['opts'][] = '5';
$question['54']['opts'][] = '6';
$question['55']['type'] = 'select';
$question['55']['deft'] = 'n';
$question['55']['desc2'] = 'Improving productivity';
$question['55']['opts'][] = '--';
$question['55']['opts'][] = '1';
$question['55']['opts'][] = '2';
$question['55']['opts'][] = '3';
$question['55']['opts'][] = '4';
$question['55']['opts'][] = '5';
$question['55']['opts'][] = '6';
$question['56']['type'] = 'select';
$question['56']['deft'] = 'n';
$question['56']['desc2'] = 'Living by principles';
$question['56']['opts'][] = '--';
$question['56']['opts'][] = '1';
$question['56']['opts'][] = '2';
$question['56']['opts'][] = '3';
$question['56']['opts'][] = '4';
$question['56']['opts'][] = '5';
$question['56']['opts'][] = '6';

$question['57']['type'] = 'select';
$question['57']['deft'] = 'n';
$question['57']['desc'] = '<br /><br />';
$question['57']['desc2'] = 'Humanitarian leader';
$question['57']['opts'][] = '--';
$question['57']['opts'][] = '1';
$question['57']['opts'][] = '2';
$question['57']['opts'][] = '3';
$question['57']['opts'][] = '4';
$question['57']['opts'][] = '5';
$question['57']['opts'][] = '6';
$question['58']['type'] = 'select';
$question['58']['deft'] = 'n';
$question['58']['desc2'] = 'Distinguished leader';
$question['58']['opts'][] = '--';
$question['58']['opts'][] = '1';
$question['58']['opts'][] = '2';
$question['58']['opts'][] = '3';
$question['58']['opts'][] = '4';
$question['58']['opts'][] = '5';
$question['58']['opts'][] = '6';
$question['59']['type'] = 'select';
$question['59']['deft'] = 'n';
$question['59']['desc2'] = 'Enterprising leader';
$question['59']['opts'][] = '--';
$question['59']['opts'][] = '1';
$question['59']['opts'][] = '2';
$question['59']['opts'][] = '3';
$question['59']['opts'][] = '4';
$question['59']['opts'][] = '5';
$question['59']['opts'][] = '6';
$question['60']['type'] = 'select';
$question['60']['deft'] = 'n';
$question['60']['desc2'] = 'Harmonious leader';
$question['60']['opts'][] = '--';
$question['60']['opts'][] = '1';
$question['60']['opts'][] = '2';
$question['60']['opts'][] = '3';
$question['60']['opts'][] = '4';
$question['60']['opts'][] = '5';
$question['60']['opts'][] = '6';
$question['61']['type'] = 'select';
$question['61']['deft'] = 'n';
$question['61']['desc2'] = 'Intellectual leader';
$question['61']['opts'][] = '--';
$question['61']['opts'][] = '1';
$question['61']['opts'][] = '2';
$question['61']['opts'][] = '3';
$question['61']['opts'][] = '4';
$question['61']['opts'][] = '5';
$question['61']['opts'][] = '6';
$question['62']['type'] = 'select';
$question['62']['deft'] = 'n';
$question['62']['desc2'] = 'Principled leader';
$question['62']['opts'][] = '--';
$question['62']['opts'][] = '1';
$question['62']['opts'][] = '2';
$question['62']['opts'][] = '3';
$question['62']['opts'][] = '4';
$question['62']['opts'][] = '5';
$question['62']['opts'][] = '6';

$question['63']['type'] = 'select';
$question['63']['deft'] = 'n';
$question['63']['desc'] = '<br /><br />';
$question['63']['desc2'] = 'Helping the sick and disadvantaged';
$question['63']['opts'][] = '--';
$question['63']['opts'][] = '1';
$question['63']['opts'][] = '2';
$question['63']['opts'][] = '3';
$question['63']['opts'][] = '4';
$question['63']['opts'][] = '5';
$question['63']['opts'][] = '6';
$question['64']['type'] = 'select';
$question['64']['deft'] = 'n';
$question['64']['desc2'] = 'Building a business';
$question['64']['opts'][] = '--';
$question['64']['opts'][] = '1';
$question['64']['opts'][] = '2';
$question['64']['opts'][] = '3';
$question['64']['opts'][] = '4';
$question['64']['opts'][] = '5';
$question['64']['opts'][] = '6';
$question['65']['type'] = 'select';
$question['65']['deft'] = 'n';
$question['65']['desc2'] = 'Building and following traditions';
$question['65']['opts'][] = '--';
$question['65']['opts'][] = '1';
$question['65']['opts'][] = '2';
$question['65']['opts'][] = '3';
$question['65']['opts'][] = '4';
$question['65']['opts'][] = '5';
$question['65']['opts'][] = '6';
$question['66']['type'] = 'select';
$question['66']['deft'] = 'n';
$question['66']['desc2'] = 'Creating an attractive environment';
$question['66']['opts'][] = '--';
$question['66']['opts'][] = '1';
$question['66']['opts'][] = '2';
$question['66']['opts'][] = '3';
$question['66']['opts'][] = '4';
$question['66']['opts'][] = '5';
$question['66']['opts'][] = '6';
$question['67']['type'] = 'select';
$question['67']['deft'] = 'n';
$question['67']['desc2'] = 'Developing educational resources';
$question['67']['opts'][] = '--';
$question['67']['opts'][] = '1';
$question['67']['opts'][] = '2';
$question['67']['opts'][] = '3';
$question['67']['opts'][] = '4';
$question['67']['opts'][] = '5';
$question['67']['opts'][] = '6';
$question['68']['type'] = 'select';
$question['68']['deft'] = 'n';
$question['68']['desc2'] = 'Building a winning team';
$question['68']['opts'][] = '--';
$question['68']['opts'][] = '1';
$question['68']['opts'][] = '2';
$question['68']['opts'][] = '3';
$question['68']['opts'][] = '4';
$question['68']['opts'][] = '5';
$question['68']['opts'][] = '6';

$question['69']['type'] = 'select';
$question['69']['deft'] = 'n';
$question['69']['desc'] = '<br /><br />';
$question['69']['desc2'] = 'Helping others';
$question['69']['opts'][] = '--';
$question['69']['opts'][] = '1';
$question['69']['opts'][] = '2';
$question['69']['opts'][] = '3';
$question['69']['opts'][] = '4';
$question['69']['opts'][] = '5';
$question['69']['opts'][] = '6';
$question['70']['type'] = 'select';
$question['70']['deft'] = 'n';
$question['70']['desc2'] = 'Advancing my position in life';
$question['70']['opts'][] = '--';
$question['70']['opts'][] = '1';
$question['70']['opts'][] = '2';
$question['70']['opts'][] = '3';
$question['70']['opts'][] = '4';
$question['70']['opts'][] = '5';
$question['70']['opts'][] = '6';
$question['71']['type'] = 'select';
$question['71']['deft'] = 'n';
$question['71']['desc2'] = 'Financial flexibility';
$question['71']['opts'][] = '--';
$question['71']['opts'][] = '1';
$question['71']['opts'][] = '2';
$question['71']['opts'][] = '3';
$question['71']['opts'][] = '4';
$question['71']['opts'][] = '5';
$question['71']['opts'][] = '6';
$question['72']['type'] = 'select';
$question['72']['deft'] = 'n';
$question['72']['desc2'] = 'Expanding my understanding';
$question['72']['opts'][] = '--';
$question['72']['opts'][] = '1';
$question['72']['opts'][] = '2';
$question['72']['opts'][] = '3';
$question['72']['opts'][] = '4';
$question['72']['opts'][] = '5';
$question['72']['opts'][] = '6';
$question['73']['type'] = 'select';
$question['73']['deft'] = 'n';
$question['73']['desc2'] = 'Artistic expression';
$question['73']['opts'][] = '--';
$question['73']['opts'][] = '1';
$question['73']['opts'][] = '2';
$question['73']['opts'][] = '3';
$question['73']['opts'][] = '4';
$question['73']['opts'][] = '5';
$question['73']['opts'][] = '6';
$question['74']['type'] = 'select';
$question['74']['deft'] = 'n';
$question['74']['desc2'] = 'Sharing my beliefs';
$question['74']['opts'][] = '--';
$question['74']['opts'][] = '1';
$question['74']['opts'][] = '2';
$question['74']['opts'][] = '3';
$question['74']['opts'][] = '4';
$question['74']['opts'][] = '5';
$question['74']['opts'][] = '6';

$question['75']['type'] = 'select';
$question['75']['deft'] = 'n';
$question['75']['desc'] = '<br /><br />';
$question['75']['desc2'] = 'Proving new concepts';
$question['75']['opts'][] = '--';
$question['75']['opts'][] = '1';
$question['75']['opts'][] = '2';
$question['75']['opts'][] = '3';
$question['75']['opts'][] = '4';
$question['75']['opts'][] = '5';
$question['75']['opts'][] = '6';
$question['76']['type'] = 'select';
$question['76']['deft'] = 'n';
$question['76']['desc2'] = 'Experiencing the environment';
$question['76']['opts'][] = '--';
$question['76']['opts'][] = '1';
$question['76']['opts'][] = '2';
$question['76']['opts'][] = '3';
$question['76']['opts'][] = '4';
$question['76']['opts'][] = '5';
$question['76']['opts'][] = '6';
$question['77']['type'] = 'select';
$question['77']['deft'] = 'n';
$question['77']['desc2'] = 'Giving back to society';
$question['77']['opts'][] = '--';
$question['77']['opts'][] = '1';
$question['77']['opts'][] = '2';
$question['77']['opts'][] = '3';
$question['77']['opts'][] = '4';
$question['77']['opts'][] = '5';
$question['77']['opts'][] = '6';
$question['78']['type'] = 'select';
$question['78']['deft'] = 'n';
$question['78']['desc2'] = 'Return on my investment';
$question['78']['opts'][] = '--';
$question['78']['opts'][] = '1';
$question['78']['opts'][] = '2';
$question['78']['opts'][] = '3';
$question['78']['opts'][] = '4';
$question['78']['opts'][] = '5';
$question['78']['opts'][] = '6';
$question['79']['type'] = 'select';
$question['79']['deft'] = 'n';
$question['79']['desc2'] = 'Directing a group';
$question['79']['opts'][] = '--';
$question['79']['opts'][] = '1';
$question['79']['opts'][] = '2';
$question['79']['opts'][] = '3';
$question['79']['opts'][] = '4';
$question['79']['opts'][] = '5';
$question['79']['opts'][] = '6';
$question['80']['type'] = 'select';
$question['80']['deft'] = 'n';
$question['80']['desc2'] = 'Traditional activities';
$question['80']['opts'][] = '--';
$question['80']['opts'][] = '1';
$question['80']['opts'][] = '2';
$question['80']['opts'][] = '3';
$question['80']['opts'][] = '4';
$question['80']['opts'][] = '5';
$question['80']['opts'][] = '6';

/* Checkboxes */
$question['81']['instruct'] = '<br />
<p style="text-align:justify;">
<b>Final Section Instructions:</b>
<br />
<br />
Rank the phrase <b>MOST</b> like you as number 1. Continue ranking until the phrase <b>LEAST</b> like you is ranked number 4. When all four phrases are in the correct order please move to the next set of phrases. Repeat the process until complete.
<br />
<br />
While responding, keep your focus on the descriptions that apply to your behavior. Be ruthlessly honest with yourself! Go with your "gut" instinct-<br>do not over-analyze! You should take no more than 15 minutes to respond to the assessment and it must be completed in one uninterrupted sitting.
</p>

<hr style = "border: 0; background-color: #660000; color: #660000; height: 1px; width: 100%;">
<br />';


$question['81']['name'] = 'question1';
$question['81']['desc3'] = '1.';
$question['81']['type'] = 'radio';
$question['81']['desc4'] = 'Enthusiastic'; 
$question['81']['deft'] = 'n';
$question['81']['opts'][] = '--';
$question['81']['opts'][] = '1';
$question['81']['opts'][] = '2';
$question['81']['opts'][] = '3';
$question['81']['opts'][] = '4';

$question['82']['name'] = 'question1';
$question['82']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['82']['type'] = 'radio';
$question['82']['desc4'] = 'Contented, satisfied'; 
$question['82']['deft'] = 'n';
$question['82']['opts'][] = '--';
$question['82']['opts'][] = '1';
$question['82']['opts'][] = '2';
$question['82']['opts'][] = '3';
$question['82']['opts'][] = '4';

$question['83']['name'] = 'question1';
$question['83']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['83']['type'] = 'radio';
$question['83']['desc4'] = 'Positive, confident'; 
$question['83']['deft'] = 'n';
$question['83']['opts'][] = '--';
$question['83']['opts'][] = '1';
$question['83']['opts'][] = '2';
$question['83']['opts'][] = '3';
$question['83']['opts'][] = '4';

$question['84']['name'] = 'question1';
$question['84']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['84']['type'] = 'radio';
$question['84']['desc4'] = 'Peaceful, tranquil'; 
$question['84']['deft'] = 'n';
$question['84']['opts'][] = '--';
$question['84']['opts'][] = '1';
$question['84']['opts'][] = '2';
$question['84']['opts'][] = '3';
$question['84']['opts'][] = '4';


$question['85']['name'] = 'question2';
$question['85']['desc3'] = '2.';
$question['85']['type'] = 'radio';
$question['85']['desc4'] = 'Careful, calculating'; 
$question['85']['deft'] = 'n';
$question['85']['opts'][] = '--';
$question['85']['opts'][] = '1';
$question['85']['opts'][] = '2';
$question['85']['opts'][] = '3';
$question['85']['opts'][] = '4';

$question['86']['name'] = 'question2';
$question['86']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['86']['type'] = 'radio';
$question['86']['desc4'] = 'Bold, daring'; 
$question['86']['deft'] = 'n';
$question['86']['opts'][] = '--';
$question['86']['opts'][] = '1';
$question['86']['opts'][] = '2';
$question['86']['opts'][] = '3';
$question['86']['opts'][] = '4';

$question['87']['name'] = 'question2';
$question['87']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['87']['type'] = 'radio';
$question['87']['desc4'] = 'Supportive'; 
$question['87']['deft'] = 'n';
$question['87']['opts'][] = '--';
$question['87']['opts'][] = '1';
$question['87']['opts'][] = '2';
$question['87']['opts'][] = '3';
$question['87']['opts'][] = '4';

$question['88']['name'] = 'question2';
$question['88']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['88']['type'] = 'radio';
$question['88']['desc4'] = 'Charming, delightful'; 
$question['88']['deft'] = 'n';
$question['88']['opts'][] = '--';
$question['88']['opts'][] = '1';
$question['88']['opts'][] = '2';
$question['88']['opts'][] = '3';
$question['88']['opts'][] = '4';

$question['89']['name'] = 'question3';
$question['89']['desc3'] = '3.';
$question['89']['type'] = 'radio';
$question['89']['desc4'] = 'Expressive'; 
$question['89']['deft'] = 'n';
$question['89']['opts'][] = '--';
$question['89']['opts'][] = '1';
$question['89']['opts'][] = '2';
$question['89']['opts'][] = '3';
$question['89']['opts'][] = '4';

$question['90']['name'] = 'question3';
$question['90']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['90']['type'] = 'radio';
$question['90']['desc4'] = 'Daring, risk-taker'; 
$question['90']['deft'] = 'n';
$question['90']['opts'][] = '--';
$question['90']['opts'][] = '1';
$question['90']['opts'][] = '2';
$question['90']['opts'][] = '3';
$question['90']['opts'][] = '4';

$question['91']['name'] = 'question3';
$question['91']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['91']['type'] = 'radio';
$question['91']['desc4'] = 'Diplomatic, tactful'; 
$question['91']['deft'] = 'n';
$question['91']['opts'][] = '--';
$question['91']['opts'][] = '1';
$question['91']['opts'][] = '2';
$question['91']['opts'][] = '3';
$question['91']['opts'][] = '4';

$question['92']['name'] = 'question3';
$question['92']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['92']['type'] = 'radio';
$question['92']['desc4'] = 'Satisfied, content'; 
$question['92']['deft'] = 'n';
$question['92']['opts'][] = '--';
$question['92']['opts'][] = '1';
$question['92']['opts'][] = '2';
$question['92']['opts'][] = '3';
$question['92']['opts'][] = '4';

$question['93']['name'] = 'question4';
$question['93']['desc3'] = '4.';
$question['93']['type'] = 'radio';
$question['93']['desc4'] = 'Respectful, shows respect'; 
$question['93']['deft'] = 'n';
$question['93']['opts'][] = '--';
$question['93']['opts'][] = '1';
$question['93']['opts'][] = '2';
$question['93']['opts'][] = '3';
$question['93']['opts'][] = '4';

$question['94']['name'] = 'question4';
$question['94']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['94']['type'] = 'radio';
$question['94']['desc4'] = 'Pioneering, exploring, enterprising'; 
$question['94']['deft'] = 'n';
$question['94']['opts'][] = '--';
$question['94']['opts'][] = '1';
$question['94']['opts'][] = '2';
$question['94']['opts'][] = '3';
$question['94']['opts'][] = '4';

$question['95']['name'] = 'question4';
$question['95']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['95']['type'] = 'radio';
$question['95']['desc4'] = 'Optimistic'; 
$question['95']['deft'] = 'n';
$question['95']['opts'][] = '--';
$question['95']['opts'][] = '1';
$question['95']['opts'][] = '2';
$question['95']['opts'][] = '3';
$question['95']['opts'][] = '4';

$question['96']['name'] = 'question4';
$question['96']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['96']['type'] = 'radio';
$question['96']['desc4'] = 'Accommodating, willing to please, ready to help'; 
$question['96']['deft'] = 'n';
$question['96']['opts'][] = '--';
$question['96']['opts'][] = '1';
$question['96']['opts'][] = '2';
$question['96']['opts'][] = '3';
$question['96']['opts'][] = '4';

$question['97']['name'] = 'question5';
$question['97']['desc3'] = '5.';
$question['97']['type'] = 'radio';
$question['97']['desc4'] = 'Willing, agreeable'; 
$question['97']['deft'] = 'n';
$question['97']['opts'][] = '--';
$question['97']['opts'][] = '1';
$question['97']['opts'][] = '2';
$question['97']['opts'][] = '3';
$question['97']['opts'][] = '4';

$question['98']['name'] = 'question5';
$question['98']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['98']['type'] = 'radio';
$question['98']['desc4'] = 'Eager, impatient'; 
$question['98']['deft'] = 'n';
$question['98']['opts'][] = '--';
$question['98']['opts'][] = '1';
$question['98']['opts'][] = '2';
$question['98']['opts'][] = '3';
$question['98']['opts'][] = '4';

$question['99']['name'] = 'question5';
$question['99']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['99']['type'] = 'radio';
$question['99']['desc4'] = 'Methodical'; 
$question['99']['deft'] = 'n';
$question['99']['opts'][] = '--';
$question['99']['opts'][] = '1';
$question['99']['opts'][] = '2';
$question['99']['opts'][] = '3';
$question['99']['opts'][] = '4';

$question['100']['name'] = 'question5';
$question['100']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['100']['type'] = 'radio';
$question['100']['desc4'] = 'High-spirited, lively, enthusiastic'; 
$question['100']['deft'] = 'n';
$question['100']['opts'][] = '--';
$question['100']['opts'][] = '1';
$question['100']['opts'][] = '2';
$question['100']['opts'][] = '3';
$question['100']['opts'][] = '4';

$question['101']['name'] = 'question6';
$question['101']['desc3'] = '6.';
$question['101']['type'] = 'radio';
$question['101']['desc4'] = 'Logical'; 
$question['101']['deft'] = 'n';
$question['101']['opts'][] = '--';
$question['101']['opts'][] = '1';
$question['101']['opts'][] = '2';
$question['101']['opts'][] = '3';
$question['101']['opts'][] = '4';

$question['102']['name'] = 'question6';
$question['102']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['102']['type'] = 'radio';
$question['102']['desc4'] = 'Obedient, will do as told, dutiful'; 
$question['102']['deft'] = 'n';
$question['102']['opts'][] = '--';
$question['102']['opts'][] = '1';
$question['102']['opts'][] = '2';
$question['102']['opts'][] = '3';
$question['102']['opts'][] = '4';

$question['103']['name'] = 'question6';
$question['103']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['103']['type'] = 'radio';
$question['103']['desc4'] = 'Unconquerable, determined'; 
$question['103']['deft'] = 'n';
$question['103']['opts'][] = '--';
$question['103']['opts'][] = '1';
$question['103']['opts'][] = '2';
$question['103']['opts'][] = '3';
$question['103']['opts'][] = '4';

$question['104']['name'] = 'question6';
$question['104']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['104']['type'] = 'radio';
$question['104']['desc4'] = 'Playful, frisky, full of fun'; 
$question['104']['deft'] = 'n';
$question['104']['opts'][] = '--';
$question['104']['opts'][] = '1';
$question['104']['opts'][] = '2';
$question['104']['opts'][] = '3';
$question['104']['opts'][] = '4';

$question['105']['name'] = 'question7';
$question['105']['desc3'] = '7.';
$question['105']['type'] = 'radio';
$question['105']['desc4'] = 'Adventurous, willing to take chances'; 
$question['105']['deft'] = 'n';
$question['105']['opts'][] = '--';
$question['105']['opts'][] = '1';
$question['105']['opts'][] = '2';
$question['105']['opts'][] = '3';
$question['105']['opts'][] = '4';

$question['106']['name'] = 'question7';
$question['106']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['106']['type'] = 'radio';
$question['106']['desc4'] = 'Analytical'; 
$question['106']['deft'] = 'n';
$question['106']['opts'][] = '--';
$question['106']['opts'][] = '1';
$question['106']['opts'][] = '2';
$question['106']['opts'][] = '3';
$question['106']['opts'][] = '4';

$question['107']['name'] = 'question7';
$question['107']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['107']['type'] = 'radio';
$question['107']['desc4'] = 'Cordial, warm, friendly'; 
$question['107']['deft'] = 'n';
$question['107']['opts'][] = '--';
$question['107']['opts'][] = '1';
$question['107']['opts'][] = '2';
$question['107']['opts'][] = '3';
$question['107']['opts'][] = '4';

$question['108']['name'] = 'question7';
$question['108']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['108']['type'] = 'radio';
$question['108']['desc4'] = 'Moderate, avoids extremes'; 
$question['108']['deft'] = 'n';
$question['108']['opts'][] = '--';
$question['108']['opts'][] = '1';
$question['108']['opts'][] = '2';
$question['108']['opts'][] = '3';
$question['108']['opts'][] = '4';

$question['109']['name'] = 'question8';
$question['109']['desc3'] = '8.';
$question['109']['type'] = 'radio';
$question['109']['desc4'] = 'Good mixer, likes being with others'; 
$question['109']['deft'] = 'n';
$question['109']['opts'][] = '--';
$question['109']['opts'][] = '1';
$question['109']['opts'][] = '2';
$question['109']['opts'][] = '3';
$question['109']['opts'][] = '4';

$question['110']['name'] = 'question8';
$question['110']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['110']['type'] = 'radio';
$question['110']['desc4'] = 'Structured'; 
$question['110']['deft'] = 'n';
$question['110']['opts'][] = '--';
$question['110']['opts'][] = '1';
$question['110']['opts'][] = '2';
$question['110']['opts'][] = '3';
$question['110']['opts'][] = '4';

$question['111']['name'] = 'question8';
$question['111']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['111']['type'] = 'radio';
$question['111']['desc4'] = 'Vigorous, energetic'; 
$question['111']['deft'] = 'n';
$question['111']['opts'][] = '--';
$question['111']['opts'][] = '1';
$question['111']['opts'][] = '2';
$question['111']['opts'][] = '3';
$question['111']['opts'][] = '4';

$question['112']['name'] = 'question8';
$question['112']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['112']['type'] = 'radio';
$question['112']['desc4'] = 'Lenient, tolerant of others\' actions'; 
$question['112']['deft'] = 'n';
$question['112']['opts'][] = '--';
$question['112']['opts'][] = '1';
$question['112']['opts'][] = '2';
$question['112']['opts'][] = '3';
$question['112']['opts'][] = '4';

$question['113']['name'] = 'question9';
$question['113']['desc3'] = '9.';
$question['113']['type'] = 'radio';
$question['113']['desc4'] = 'Competitive, seeking to win'; 
$question['113']['deft'] = 'n';
$question['113']['opts'][] = '--';
$question['113']['opts'][] = '1';
$question['113']['opts'][] = '2';
$question['113']['opts'][] = '3';
$question['113']['opts'][] = '4';

$question['114']['name'] = 'question9';
$question['114']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['114']['type'] = 'radio';
$question['114']['desc4'] = 'Considerate, caring, thoughtful'; 
$question['114']['deft'] = 'n';
$question['114']['opts'][] = '--';
$question['114']['opts'][] = '1';
$question['114']['opts'][] = '2';
$question['114']['opts'][] = '3';
$question['114']['opts'][] = '4';

$question['115']['name'] = 'question9';
$question['115']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['115']['type'] = 'radio';
$question['115']['desc4'] = 'Outgoing, fun-loving, socially striving'; 
$question['115']['deft'] = 'n';
$question['115']['opts'][] = '--';
$question['115']['opts'][] = '1';
$question['115']['opts'][] = '2';
$question['115']['opts'][] = '3';
$question['115']['opts'][] = '4';

$question['116']['name'] = 'question9';
$question['116']['desc3'] = '&nbsp;&nbsp;&nbsp;';
$question['116']['type'] = 'radio';
$question['116']['desc4'] = 'Harmonious, agreeable'; 
$question['116']['deft'] = 'n';
$question['116']['opts'][] = '--';
$question['116']['opts'][] = '1';
$question['116']['opts'][] = '2';
$question['116']['opts'][] = '3';
$question['116']['opts'][] = '4';

$question['117']['name'] = 'question10';
$question['117']['desc3'] = '10.';
$question['117']['type'] = 'radio';
$question['117']['desc4'] = 'Aggressive, challenger, takes action'; 
$question['117']['deft'] = 'n';
$question['117']['opts'][] = '--';
$question['117']['opts'][] = '1';
$question['117']['opts'][] = '2';
$question['117']['opts'][] = '3';
$question['117']['opts'][] = '4';

$question['118']['name'] = 'question10';
$question['118']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['118']['type'] = 'radio';
$question['118']['desc4'] = 'Life of the party, outgoing, entertaining'; 
$question['118']['deft'] = 'n';
$question['118']['opts'][] = '--';
$question['118']['opts'][] = '1';
$question['118']['opts'][] = '2';
$question['118']['opts'][] = '3';
$question['118']['opts'][] = '4';

$question['119']['name'] = 'question10';
$question['119']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['119']['type'] = 'radio';
$question['119']['desc4'] = 'Easy mark, easily taken advantage of'; 
$question['119']['deft'] = 'n';
$question['119']['opts'][] = '--';
$question['119']['opts'][] = '1';
$question['119']['opts'][] = '2';
$question['119']['opts'][] = '3';
$question['119']['opts'][] = '4';

$question['120']['name'] = 'question10';
$question['120']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['120']['type'] = 'radio';
$question['120']['desc4'] = 'Fearful, afraid'; 
$question['120']['deft'] = 'n';
$question['120']['opts'][] = '--';
$question['120']['opts'][] = '1';
$question['120']['opts'][] = '2';
$question['120']['opts'][] = '3';
$question['120']['opts'][] = '4';

$question['121']['name'] = 'question11';
$question['121']['desc3'] = '11.';
$question['121']['type'] = 'radio';
$question['121']['desc4'] = 'Stimulating'; 
$question['121']['deft'] = 'n';
$question['121']['opts'][] = '--';
$question['121']['opts'][] = '1';
$question['121']['opts'][] = '2';
$question['121']['opts'][] = '3';
$question['121']['opts'][] = '4';

$question['122']['name'] = 'question11';
$question['122']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['122']['type'] = 'radio';
$question['122']['desc4'] = 'Sympathetic, compassionate, understanding'; 
$question['122']['deft'] = 'n';
$question['122']['opts'][] = '--';
$question['122']['opts'][] = '1';
$question['122']['opts'][] = '2';
$question['122']['opts'][] = '3';
$question['122']['opts'][] = '4';

$question['123']['name'] = 'question11';
$question['123']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['123']['type'] = 'radio';
$question['123']['desc4'] = 'Tolerant'; 
$question['123']['deft'] = 'n';
$question['123']['opts'][] = '--';
$question['123']['opts'][] = '1';
$question['123']['opts'][] = '2';
$question['123']['opts'][] = '3';
$question['123']['opts'][] = '4';

$question['124']['name'] = 'question11';
$question['124']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['124']['type'] = 'radio';
$question['124']['desc4'] = 'Aggressive'; 
$question['124']['deft'] = 'n';
$question['124']['opts'][] = '--';
$question['124']['opts'][] = '1';
$question['124']['opts'][] = '2';
$question['124']['opts'][] = '3';
$question['124']['opts'][] = '4';

$question['125']['name'] = 'question12';
$question['125']['desc3'] = '12.';
$question['125']['type'] = 'radio';
$question['125']['desc4'] = 'Talkative, chatty'; 
$question['125']['deft'] = 'n';
$question['125']['opts'][] = '--';
$question['125']['opts'][] = '1';
$question['125']['opts'][] = '2';
$question['125']['opts'][] = '3';
$question['125']['opts'][] = '4';

$question['126']['name'] = 'question12';
$question['126']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['126']['type'] = 'radio';
$question['126']['desc4'] = 'Controlled, restrained'; 
$question['126']['deft'] = 'n';
$question['126']['opts'][] = '--';
$question['126']['opts'][] = '1';
$question['126']['opts'][] = '2';
$question['126']['opts'][] = '3';
$question['126']['opts'][] = '4';

$question['127']['name'] = 'question12';
$question['127']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['127']['type'] = 'radio';
$question['127']['desc4'] = 'Conventional, doing it the usual way, customary'; 
$question['127']['deft'] = 'n';
$question['127']['opts'][] = '--';
$question['127']['opts'][] = '1';
$question['127']['opts'][] = '2';
$question['127']['opts'][] = '3';
$question['127']['opts'][] = '4';

$question['128']['name'] = 'question12';
$question['128']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['128']['type'] = 'radio';
$question['128']['desc4'] = 'Decisive, certain, firm in making a decision'; 
$question['128']['deft'] = 'n';
$question['128']['opts'][] = '--';
$question['128']['opts'][] = '1';
$question['128']['opts'][] = '2';
$question['128']['opts'][] = '3';
$question['128']['opts'][] = '4';

$question['129']['name'] = 'question13';
$question['129']['desc3'] = '13.';
$question['129']['type'] = 'radio';
$question['129']['desc4'] = 'Well-disciplined, self-controlled'; 
$question['129']['deft'] = 'n';
$question['129']['opts'][] = '--';
$question['129']['opts'][] = '1';
$question['129']['opts'][] = '2';
$question['129']['opts'][] = '3';
$question['129']['opts'][] = '4';

$question['130']['name'] = 'question13';
$question['130']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['130']['type'] = 'radio';
$question['130']['desc4'] = 'Generous, willing to share'; 
$question['130']['deft'] = 'n';
$question['130']['opts'][] = '--';
$question['130']['opts'][] = '1';
$question['130']['opts'][] = '2';
$question['130']['opts'][] = '3';
$question['130']['opts'][] = '4';

$question['131']['name'] = 'question13';
$question['131']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['131']['type'] = 'radio';
$question['131']['desc4'] = 'Animated, uses gestures for expression'; 
$question['131']['deft'] = 'n';
$question['131']['opts'][] = '--';
$question['131']['opts'][] = '1';
$question['131']['opts'][] = '2';
$question['131']['opts'][] = '3';
$question['131']['opts'][] = '4';

$question['132']['name'] = 'question13';
$question['132']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['132']['type'] = 'radio';
$question['132']['desc4'] = 'Persistent, unrelenting, refuses to quit'; 
$question['132']['deft'] = 'n';
$question['132']['opts'][] = '--';
$question['132']['opts'][] = '1';
$question['132']['opts'][] = '2';
$question['132']['opts'][] = '3';
$question['132']['opts'][] = '4';

$question['133']['name'] = 'question14';
$question['133']['desc3'] = '14.';
$question['133']['type'] = 'radio';
$question['133']['desc4'] = 'Sociable, enjoys the company of others'; 
$question['133']['deft'] = 'n';
$question['133']['opts'][] = '--';
$question['133']['opts'][] = '1';
$question['133']['opts'][] = '2';
$question['133']['opts'][] = '3';
$question['133']['opts'][] = '4';

$question['134']['name'] = 'question14';
$question['134']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['134']['type'] = 'radio';
$question['134']['desc4'] = 'Patient, steady, deliberate'; 
$question['134']['deft'] = 'n';
$question['134']['opts'][] = '--';
$question['134']['opts'][] = '1';
$question['134']['opts'][] = '2';
$question['134']['opts'][] = '3';
$question['134']['opts'][] = '4';

$question['135']['name'] = 'question14';
$question['135']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['135']['type'] = 'radio';
$question['135']['desc4'] = 'Self-reliant, independent'; 
$question['135']['deft'] = 'n';
$question['135']['opts'][] = '--';
$question['135']['opts'][] = '1';
$question['135']['opts'][] = '2';
$question['135']['opts'][] = '3';
$question['135']['opts'][] = '4';

$question['136']['name'] = 'question14';
$question['136']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['136']['type'] = 'radio';
$question['136']['desc4'] = 'Soft-spoken, mild, reserved'; 
$question['136']['deft'] = 'n';
$question['136']['opts'][] = '--';
$question['136']['opts'][] = '1';
$question['136']['opts'][] = '2';
$question['136']['opts'][] = '3';
$question['136']['opts'][] = '4';

$question['137']['name'] = 'question15';
$question['137']['desc3'] = '15.';
$question['137']['type'] = 'radio';
$question['137']['desc4'] = 'Gentle, kindly'; 
$question['137']['deft'] = 'n';
$question['137']['opts'][] = '--';
$question['137']['opts'][] = '1';
$question['137']['opts'][] = '2';
$question['137']['opts'][] = '3';
$question['137']['opts'][] = '4';

$question['138']['name'] = 'question15';
$question['138']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['138']['type'] = 'radio';
$question['138']['desc4'] = 'Persuasive, convincing'; 
$question['138']['deft'] = 'n';
$question['138']['opts'][] = '--';
$question['138']['opts'][] = '1';
$question['138']['opts'][] = '2';
$question['138']['opts'][] = '3';
$question['138']['opts'][] = '4';

$question['139']['name'] = 'question15';
$question['139']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['139']['type'] = 'radio';
$question['139']['desc4'] = 'Humble, reserved, modest'; 
$question['139']['deft'] = 'n';
$question['139']['opts'][] = '--';
$question['139']['opts'][] = '1';
$question['139']['opts'][] = '2';
$question['139']['opts'][] = '3';
$question['139']['opts'][] = '4';

$question['140']['name'] = 'question15';
$question['140']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['140']['type'] = 'radio';
$question['140']['desc4'] = 'Magnetic, attracts others'; 
$question['140']['deft'] = 'n';
$question['140']['opts'][] = '--';
$question['140']['opts'][] = '1';
$question['140']['opts'][] = '2';
$question['140']['opts'][] = '3';
$question['140']['opts'][] = '4';

$question['141']['name'] = 'question16';
$question['141']['desc3'] = '16.';
$question['141']['type'] = 'radio';
$question['141']['desc4'] = 'Captivating'; 
$question['141']['deft'] = 'n';
$question['141']['opts'][] = '--';
$question['141']['opts'][] = '1';
$question['141']['opts'][] = '2';
$question['141']['opts'][] = '3';
$question['141']['opts'][] = '4';

$question['142']['name'] = 'question16';
$question['142']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['142']['type'] = 'radio';
$question['142']['desc4'] = 'Kind, willing to give or help'; 
$question['142']['deft'] = 'n';
$question['142']['opts'][] = '--';
$question['142']['opts'][] = '1';
$question['142']['opts'][] = '2';
$question['142']['opts'][] = '3';
$question['142']['opts'][] = '4';

$question['143']['name'] = 'question16';
$question['143']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['143']['type'] = 'radio';
$question['143']['desc4'] = 'Resigned, gives in'; 
$question['143']['deft'] = 'n';
$question['143']['opts'][] = '--';
$question['143']['opts'][] = '1';
$question['143']['opts'][] = '2';
$question['143']['opts'][] = '3';
$question['143']['opts'][] = '4';

$question['144']['name'] = 'question16';
$question['144']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['144']['type'] = 'radio';
$question['144']['desc4'] = 'Force of character, powerful'; 
$question['144']['deft'] = 'n';
$question['144']['opts'][] = '--';
$question['144']['opts'][] = '1';
$question['144']['opts'][] = '2';
$question['144']['opts'][] = '3';
$question['144']['opts'][] = '4';

$question['145']['name'] = 'question17';
$question['145']['desc3'] = '17.';
$question['145']['type'] = 'radio';
$question['145']['desc4'] = 'Companionable, easy to be with'; 
$question['145']['deft'] = 'n';
$question['145']['opts'][] = '--';
$question['145']['opts'][] = '1';
$question['145']['opts'][] = '2';
$question['145']['opts'][] = '3';
$question['145']['opts'][] = '4';

$question['146']['name'] = 'question17';
$question['146']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['146']['type'] = 'radio';
$question['146']['desc4'] = 'Easygoing'; 
$question['146']['deft'] = 'n';
$question['146']['opts'][] = '--';
$question['146']['opts'][] = '1';
$question['146']['opts'][] = '2';
$question['146']['opts'][] = '3';
$question['146']['opts'][] = '4';

$question['147']['name'] = 'question17';
$question['147']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['147']['type'] = 'radio';
$question['147']['desc4'] = 'Outspoken, speaks freely and boldly'; 
$question['147']['deft'] = 'n';
$question['147']['opts'][] = '--';
$question['147']['opts'][] = '1';
$question['147']['opts'][] = '2';
$question['147']['opts'][] = '3';
$question['147']['opts'][] = '4';

$question['148']['name'] = 'question17';
$question['148']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['148']['type'] = 'radio';
$question['148']['desc4'] = 'Restrained, reserved, controlled'; 
$question['148']['deft'] = 'n';
$question['148']['opts'][] = '--';
$question['148']['opts'][] = '1';
$question['148']['opts'][] = '2';
$question['148']['opts'][] = '3';
$question['148']['opts'][] = '4';

$question['149']['name'] = 'question18';
$question['149']['desc3'] = '18.';
$question['149']['type'] = 'radio';
$question['149']['desc4'] = 'Factual'; 
$question['149']['deft'] = 'n';
$question['149']['opts'][] = '--';
$question['149']['opts'][] = '1';
$question['149']['opts'][] = '2';
$question['149']['opts'][] = '3';
$question['149']['opts'][] = '4';

$question['150']['name'] = 'question18';
$question['150']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['150']['type'] = 'radio';
$question['150']['desc4'] = 'Obliging, helpful'; 
$question['150']['deft'] = 'n';
$question['150']['opts'][] = '--';
$question['150']['opts'][] = '1';
$question['150']['opts'][] = '2';
$question['150']['opts'][] = '3';
$question['150']['opts'][] = '4';

$question['151']['name'] = 'question18';
$question['151']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['151']['type'] = 'radio';
$question['151']['desc4'] = 'Willpower, strong-willed'; 
$question['151']['deft'] = 'n';
$question['151']['opts'][] = '--';
$question['151']['opts'][] = '1';
$question['151']['opts'][] = '2';
$question['151']['opts'][] = '3';
$question['151']['opts'][] = '4';

$question['152']['name'] = 'question18';
$question['152']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['152']['type'] = 'radio';
$question['152']['desc4'] = 'Cheerful, joyful'; 
$question['152']['deft'] = 'n';
$question['152']['opts'][] = '--';
$question['152']['opts'][] = '1';
$question['152']['opts'][] = '2';
$question['152']['opts'][] = '3';
$question['152']['opts'][] = '4';

$question['153']['name'] = 'question19';
$question['153']['desc3'] = '19.';
$question['153']['type'] = 'radio';
$question['153']['desc4'] = 'Attractive, charming, attracts others'; 
$question['153']['deft'] = 'n';
$question['153']['opts'][] = '--';
$question['153']['opts'][] = '1';
$question['153']['opts'][] = '2';
$question['153']['opts'][] = '3';
$question['153']['opts'][] = '4';

$question['154']['name'] = 'question19';
$question['154']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['154']['type'] = 'radio';
$question['154']['desc4'] = 'Systematic'; 
$question['154']['deft'] = 'n';
$question['154']['opts'][] = '--';
$question['154']['opts'][] = '1';
$question['154']['opts'][] = '2';
$question['154']['opts'][] = '3';
$question['154']['opts'][] = '4';

$question['155']['name'] = 'question19';
$question['155']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['155']['type'] = 'radio';
$question['155']['desc4'] = 'Stubborn, unyielding'; 
$question['155']['deft'] = 'n';
$question['155']['opts'][] = '--';
$question['155']['opts'][] = '1';
$question['155']['opts'][] = '2';
$question['155']['opts'][] = '3';
$question['155']['opts'][] = '4';

$question['156']['name'] = 'question19';
$question['156']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['156']['type'] = 'radio';
$question['156']['desc4'] = 'Pleasing'; 
$question['156']['deft'] = 'n';
$question['156']['opts'][] = '--';
$question['156']['opts'][] = '1';
$question['156']['opts'][] = '2';
$question['156']['opts'][] = '3';
$question['156']['opts'][] = '4';

$question['157']['name'] = 'question20';
$question['157']['desc3'] = '20.';
$question['157']['type'] = 'radio';
$question['157']['desc4'] = 'Restless, unable to rest or relax'; 
$question['157']['deft'] = 'n';
$question['157']['opts'][] = '--';
$question['157']['opts'][] = '1';
$question['157']['opts'][] = '2';
$question['157']['opts'][] = '3';
$question['157']['opts'][] = '4';

$question['158']['name'] = 'question20';
$question['158']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['158']['type'] = 'radio';
$question['158']['desc4'] = 'Neighborly, friendly'; 
$question['158']['deft'] = 'n';
$question['158']['opts'][] = '--';
$question['158']['opts'][] = '1';
$question['158']['opts'][] = '2';
$question['158']['opts'][] = '3';
$question['158']['opts'][] = '4';

$question['159']['name'] = 'question20';
$question['159']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['159']['type'] = 'radio';
$question['159']['desc4'] = 'Popular, liked by many or most people'; 
$question['159']['deft'] = 'n';
$question['159']['opts'][] = '--';
$question['159']['opts'][] = '1';
$question['159']['opts'][] = '2';
$question['159']['opts'][] = '3';
$question['159']['opts'][] = '4';

$question['160']['name'] = 'question20';
$question['160']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['160']['type'] = 'radio';
$question['160']['desc4'] = 'Orderly, neat'; 
$question['160']['deft'] = 'n';
$question['160']['opts'][] = '--';
$question['160']['opts'][] = '1';
$question['160']['opts'][] = '2';
$question['160']['opts'][] = '3';
$question['160']['opts'][] = '4';

$question['161']['name'] = 'question21';
$question['161']['desc3'] = '21.';
$question['161']['type'] = 'radio';
$question['161']['desc4'] = 'Challenging, assertive'; 
$question['161']['deft'] = 'n';
$question['161']['opts'][] = '--';
$question['161']['opts'][] = '1';
$question['161']['opts'][] = '2';
$question['161']['opts'][] = '3';
$question['161']['opts'][] = '4';

$question['162']['name'] = 'question21';
$question['162']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['162']['type'] = 'radio';
$question['162']['desc4'] = 'Critical thinker'; 
$question['162']['deft'] = 'n';
$question['162']['opts'][] = '--';
$question['162']['opts'][] = '1';
$question['162']['opts'][] = '2';
$question['162']['opts'][] = '3';
$question['162']['opts'][] = '4';

$question['163']['name'] = 'question21';
$question['163']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['163']['type'] = 'radio';
$question['163']['desc4'] = 'Casual, laid-back'; 
$question['163']['deft'] = 'n';
$question['163']['opts'][] = '--';
$question['163']['opts'][] = '1';
$question['163']['opts'][] = '2';
$question['163']['opts'][] = '3';
$question['163']['opts'][] = '4';

$question['164']['name'] = 'question21';
$question['164']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['164']['type'] = 'radio';
$question['164']['desc4'] = 'Light-hearted, carefree'; 
$question['164']['deft'] = 'n';
$question['164']['opts'][] = '--';
$question['164']['opts'][] = '1';
$question['164']['opts'][] = '2';
$question['164']['opts'][] = '3';
$question['164']['opts'][] = '4';

$question['165']['name'] = 'question22';
$question['165']['desc3'] = '22.';
$question['165']['type'] = 'radio';
$question['165']['desc4'] = 'Brave, unafraid, courageous '; 
$question['165']['deft'] = 'n';
$question['165']['opts'][] = '--';
$question['165']['opts'][] = '1';
$question['165']['opts'][] = '2';
$question['165']['opts'][] = '3';
$question['165']['opts'][] = '4';

$question['166']['name'] = 'question22';
$question['166']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['166']['type'] = 'radio';
$question['166']['desc4'] = 'Inspiring, motivating'; 
$question['166']['deft'] = 'n';
$question['166']['opts'][] = '--';
$question['166']['opts'][] = '1';
$question['166']['opts'][] = '2';
$question['166']['opts'][] = '3';
$question['166']['opts'][] = '4';

$question['167']['name'] = 'question22';
$question['167']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['167']['type'] = 'radio';
$question['167']['desc4'] = 'Avoid confrontation'; 
$question['167']['deft'] = 'n';
$question['167']['opts'][] = '--';
$question['167']['opts'][] = '1';
$question['167']['opts'][] = '2';
$question['167']['opts'][] = '3';
$question['167']['opts'][] = '4';

$question['168']['name'] = 'question22';
$question['168']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['168']['type'] = 'radio';
$question['168']['desc4'] = 'Quiet, composed'; 
$question['168']['deft'] = 'n';
$question['168']['opts'][] = '--';
$question['168']['opts'][] = '1';
$question['168']['opts'][] = '2';
$question['168']['opts'][] = '3';
$question['168']['opts'][] = '4';

$question['169']['name'] = 'question23';
$question['169']['desc3'] = '23.';
$question['169']['type'] = 'radio';
$question['169']['desc4'] = 'Cautious, wary, careful'; 
$question['169']['deft'] = 'n';
$question['169']['opts'][] = '--';
$question['169']['opts'][] = '1';
$question['169']['opts'][] = '2';
$question['169']['opts'][] = '3';
$question['169']['opts'][] = '4';

$question['170']['name'] = 'question23';
$question['170']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['170']['type'] = 'radio';
$question['170']['desc4'] = 'Determined, decided, unwavering, stand firm'; 
$question['170']['deft'] = 'n';
$question['170']['opts'][] = '--';
$question['170']['opts'][] = '1';
$question['170']['opts'][] = '2';
$question['170']['opts'][] = '3';
$question['170']['opts'][] = '4';

$question['171']['name'] = 'question23';
$question['171']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['171']['type'] = 'radio';
$question['171']['desc4'] = 'Convincing, assuring'; 
$question['171']['deft'] = 'n';
$question['171']['opts'][] = '--';
$question['171']['opts'][] = '1';
$question['171']['opts'][] = '2';
$question['171']['opts'][] = '3';
$question['171']['opts'][] = '4';

$question['172']['name'] = 'question23';
$question['172']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['172']['type'] = 'radio';
$question['172']['desc4'] = 'Good-natured, pleasant'; 
$question['172']['deft'] = 'n';
$question['172']['opts'][] = '--';
$question['172']['opts'][] = '1';
$question['172']['opts'][] = '2';
$question['172']['opts'][] = '3';
$question['172']['opts'][] = '4';

$question['173']['name'] = 'question24';
$question['173']['desc3'] = '24.';
$question['173']['type'] = 'radio';
$question['173']['desc4'] = 'Jovial, joking'; 
$question['173']['deft'] = 'n';
$question['173']['opts'][] = '--';
$question['173']['opts'][] = '1';
$question['173']['opts'][] = '2';
$question['173']['opts'][] = '3';
$question['173']['opts'][] = '4';

$question['174']['name'] = 'question24';
$question['174']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['174']['type'] = 'radio';
$question['174']['desc4'] = 'Organized'; 
$question['174']['deft'] = 'n';
$question['174']['opts'][] = '--';
$question['174']['opts'][] = '1';
$question['174']['opts'][] = '2';
$question['174']['opts'][] = '3';
$question['174']['opts'][] = '4';

$question['175']['name'] = 'question24';
$question['175']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['175']['type'] = 'radio';
$question['175']['desc4'] = 'Nervy, gutsy, brazen'; 
$question['175']['deft'] = 'n';
$question['175']['opts'][] = '--';
$question['175']['opts'][] = '1';
$question['175']['opts'][] = '2';
$question['175']['opts'][] = '3';
$question['175']['opts'][] = '4';

$question['176']['name'] = 'question24';
$question['176']['desc3'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$question['176']['type'] = 'radio';
$question['176']['desc4'] = 'Even-tempered, calm, not easily excited'; 
$question['176']['deft'] = 'n';
$question['176']['opts'][] = '--';
$question['176']['opts'][] = '1';
$question['176']['opts'][] = '2';
$question['176']['opts'][] = '3';
$question['176']['opts'][] = '4';

/*
$hidden[''] = "-";
$hidden[''] = "-";
*/

$button_text     = 'Send it!';

# -------------------------------------------------------------------
function my_remove_slashes($st) {
  if (get_magic_quotes_gpc()) { return stripslashes($st); }
  else { return $st; }
}

function security_filter($st) {
   $attribs = 'javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|'.
              'onmousemove|onmouseout|onkeypress|onkeydown|onkeyup';

   $st = my_remove_slashes($st);
   $st = stripslashes(preg_replace("/$attribs/i", 'forbidden', $st));
   $st = strip_tags($st);
   $st = htmlentities($st);
   return $st;
}
# -------------------------------------------------------------------

if (!(empty($open_template))) { include($open_template); }

if (isset($_POST['button'])) {
   foreach ($_POST as $key => $value) {
     if ($key != 'button' || $key == 0) {
        if (preg_match('/^hidden_(.*)/i',$key)) {
           $value = security_filter($value);
           $key = trim(strstr($key,'_'),'_');
           
           if (isset($hidden[$key])) { 
               $hidden_data[$key] = $value; 
           }
        }
        else {
           if (isset($question[$key])) {
               $value = security_filter($value);
               if ($question[$key]['type'] == 'checkbox') { $value = $value; }
               $results[$key] = $value;
           }
        }
        
     }
   }

   # Now that the responses are processed, prepare the email.

   /*
$msg  = "----------------- User Info -----------------\n\n";
   $msg .= "Sent from: ".$_SERVER['REMOTE_HOST']." [".$_SERVER['REMOTE_ADDR']."] \n";
   $msg .= "Coming from (referer): ".$_SERVER['HTTP_REFERER']."\n";
   $msg .= "Using (user agent): ".$_SERVER['HTTP_USER_AGENT']."\n\n";
   $msg .= "---------------------------------------------\n\n";
*/

   
$msg  = "----------------- Survey Response -----------------\n\n";
   $msg .= "Style Insights\nQUESTIONNAIRE \n";
   $msg .= "---------------------------------------------\n\n";

   
 
   if (isset($question)) {
      $lineflag = FALSE;
      $questionnumber = '';
      foreach ($results as $key => $value) {
         if ($lineflag == FALSE) { 
              $msg .= "----------------- Questions -----------------\n\n";
              $lineflag = TRUE;
         }
         /* $msg .= "\n\n"; */
         
         if ($question[$key]['desc'] != "") $msg .= "\n\n" . $question[$key]['desc'] . "";
         if ($question[$key]['name'] != "" && $question[$key]['name'] != $questionnumber) {
                $msg .= "\n\n" . $question[$key]['name'] . "";
                $questionnumber = $question[$key]['name'];
         }
         
         
         $msg .= "\n       " . $value . " - " . $question[$key]['desc4'] . $question[$key]['desc2'] ."";
         
         /* $msg .= "Response: ". $value . "\n\n"; */
         
      }
      $msg .= "\n---------------------------------------------\n";
   }
   
   //$msg .= "\n";

   if (isset($hidden_data)) {
      $lineflag = FALSE;
      foreach ($hidden_data as $key => $value) {
         if ($lineflag == FALSE) { 
              $msg .= "---------------- Hidden vars ----------------\n\n";
              $lineflag = TRUE;
         }
         $msg .= $key ." - ". $value ."\n";
      }
      $msg .= "\n---------------------------------------------\n";
   }
   
   /*
if (isset($question)) {
      $lineflag = FALSE;
      if ($question[$key]['type'] == 'checkbox') {
      foreach ($results as $key => $value) {
         if ($lineflag == FALSE) { 
              $msg .= "---------------- CheckBox vars ----------------\n\n";
              $lineflag = TRUE;
         }
         $msg .= $name ." - ". $value ."\n";
      }
      $msg .= "\n---------------------------------------------\n";
    }
   }
*/

   # Prep and send email.
   $headers  = "Return-Path: $email_to_send_to\r\n";
   $headers .= "CC: ccalub@herbdoc.com\r\n";
   $headers .= "From: $name_of_survey < $email_to_send_to >\r\n";
   $headers .= "Content-type: text/plain; charset=$charset\r\n";
   mail($email_to_send_to, $name_of_survey . " mailer", $msg, $headers);
   
   $headers = "Return-Path: $email_to_send_to\r\n";
   $headers .= "From: $name_of_survey <$email_to_sent_to\r\n";
   $headers .= "Content-type: text/plain; charset=$charset\r\n";
   $msg2 = "Hello " . $_REQUEST["0"] . ",\r\n\r\nThank you for your interest in Dr Schulze's Amerian Botanical Pharmacy.\r\n\r\nWe have received both parts of your application, making the process complete.\r\n\r\nWe strive to respond to every applicant within 2-3 weeks.\r\n\r\nSincerely,\r\nHuman Resources";
   mail($_REQUEST[2], $name_of_survey . " Completed", $msg2, $headers);

   # Include template file.
   if (!(empty($survey_complete_page))) { include($survey_complete_page); }
}

else {

     if (!(empty($survey_heading_page))) { include($survey_heading_page); }

     print "<form action=\"$thisfile_URL\" method=\"POST\" id=\"survey\" onSubmit=\"return errorchecking();\"> \n";

     foreach ($question as $key => $value) {
     
        if ($key == 9) {
                echo "<br><br><span style='font-weight: bold;'><p>In the following survey you will see 12 groups of statements, each with six items for you to consider. In each group, rank the six items as follows; the statement you most identify with is 1, the statement you least identify with is 6. While responding, keep your focus on:</p>
                <p>
&bull; What you use to guide your life decisions<br />
&bull; Things that are important to you<br />
&bull; Things that motivate you
</p>
<p>It is essential you complete this survey in one uninterrupted sitting. It should take no more
than 15 minutes to complete.</p></span>";
      }
         $type = strtolower($question[$key]['type']);
         $desc = $question[$key]['desc'];
         $desc2 = $question[$key]['desc2'];
         $desc3 = $question[$key]['desc3'];
         $desc4 = $question[$key]['desc4'];
         $deft = $question[$key]['deft'];
         $opts = $question[$key]['opts'];
         /* $opts_val = $question[$key]['opts_val']; */
         $name = $question[$key]['name'];
         $instruct = $question[$key]['instruct'];

         /* print $desc."\n"; */
         
         /*
if ($type == "checkbox") {
              if (strtolower($deft) == 'y') { $box_value = "1"; $CHECKED = ' CHECKED'; }
                 else { $box_value = "0"; $CHECKED = ''; }
              print "<input type=\"checkbox\" name=\"$key\" value=\"$box_value\"$CHECKED>\n<br />";
         }
*/

                if ($type == "checkbox") {
                print $instruct;
                        $i = 1;
            $j++;
            /* print $desc2; */
            print "<span class=\"desc2\">$desc3</span><div style=\"display:inline;\" id=\"" . $j ."\">";
         foreach ($opts as $opt_key => $opt_value) {
              if (strtolower($deft) == 'y') { $box_value = "1"; $CHECKED = 'CHECKED'; }
                 else { $box_value = "0"; $CHECKED = ''; }
              print "<input type=\"checkbox\" name=\"$key\" id=\"$name\" value=\"$opt_value\"$CHECKED> $opt_value \n";
              $i++;
            }
            print "<span class=\"desc\">" . $desc4."</span><br /><br />";
                print "</div>";
                $count = $j;
                if ($count % 4 == 0)
                        {
                                print "<div class=\"gap\"></div>";
                        }
         }
         
         

/*
         if ($type == "radio") {
            print $instruct;
            $i = 1;
            $j++;
            print "<span class=\"desc2\">$desc3</span><div style=\"display:inline;\" id=\"" . $j ."\">";
            foreach ($opts as $opt_key => $opt_value) {
                if ($deft == $i) { $CHECKED = " checked=\"checked\""; } 
                   else { $CHECKED = ''; }

                print "<input type=\"RADIO\" name=\"$key\" class=\"$name\" value=\"$opt_value\"$CHECKED>  $opt_value";
                $i++;
            }
            print "<span class=\"desc\">" . $desc4."</span><br /><br />";
                print "</div>";
                $count = $j;
                if ($count % 4 == 0)
                        {
                                print "<div class=\"gap\"></div>";
                        }
         }
*/

         if ($type == "radio") {
             print $instruct;
                 $questiongroup = intval((intval($key)-1)/4);
                 if ($desc3 != "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" && $desc3 != "&nbsp;&nbsp;&nbsp;") {print "<div class=\"desc\">" . $desc3 . "</div>";} else {print "<div class = \"desc\"></div>";}
             print "<div class=\"group\">";
             print "<select class=\"s$questiongroup\" name=\"$key\" style=\"margin-left: 25px;\">";


             $i = 1;
           
             foreach ($opts as $opt_key => $opt_value) {
             
                 if ($deft == $i) { $CHECKED = ' SELECTED'; } 
                     else { $CHECKED = ''; }
                     print "<option value=\"$opt_value\"$CHECKED>$opt_value</option>";
                 $i++;
             
             }

             print "</select><span class=\"desc2\">" . $desc4 ."</span>";
             print "</div>";
             }

        /*
 if ($type == "select") {
             print "<br />\n";
             print "<select name=\"$key\">\n";

             $i = 1;
             foreach ($opts as $opt_key => $opt_value) {
                 if ($deft == $i) { $CHECKED = ' SELECTED'; } 
                     else { $CHECKED = ''; }
                     print "<option value=\"$opt_value\"$CHECKED>$opt_value</option>\n";
                 $i++;
             }
             print "</select><br />\n";
         }
         */
         
         if ($type == "select") {
                 $questiongroup = intval((intval($key)-1)/6);
             print "<div class=\"desc\">" . $desc . "</div>";
             print "<div class=\"group\">";
             print "<select class=\"s$questiongroup\" name=\"$key\" style=\"margin-left: 25px;\">";

             $i = 1;
           
             foreach ($opts as $opt_key => $opt_value) {
             
                 if ($deft == $i) { $CHECKED = ' SELECTED'; } 
                     else { $CHECKED = ''; }
                     print "<option value=\"$opt_value\"$CHECKED>$opt_value</option>";
                 $i++;
             
             }
             print "</select><span class=\"desc2\">" . $desc2 ."</span>";
             print "</div>";
             }
                        //print "</div>";


         if ($type == "text") {
             print "<br />\n";
             $size = $opts['size'];
             $maxl = $opts['maxl'];
             print "<input maxlength=\"$maxl\" size=\"$size\" name=\"$key\" value=\"$deft\" onFocus=\"this.select();\"><br />\n";
         }

         if ($type == "textarea") {
             print "<br />\n";
             $colz = $opts['cols'];
             $rowz = $opts['rows'];
             print "<textarea name=\"$key\" rows=\"$rowz\" cols=\"$colz\">$deft</textarea><br />\n";
         }

       # Spacing between survey questions -----------

       /* print "<br />\n"; */

       # --------------------------------------------

     }

     /*
foreach ($hidden as $key => $value) {
        print "<input type=\"hidden\" name=\"hidden_$key\" value=\"$value\">\n";
     }
*/
         print "<br><br>Thank you for completing the assessment.<br><br>";
     print "<input type=\"submit\" name=\"button\" value=\"$button_text\">\n";
     //print " &nbsp; -- &nbsp; \n";
     //print " &nbsp; &nbsp; &nbsp; \n";
     //print "<INPUT TYPE=\"reset\" VALUE=\"Clear\">\n";
     print "</form>";
     print "<br><hr style = \"border: 0; background-color: #660000; color: #660000; height: 1px; width: 100%;\">";
     
}

if (!(empty($close_template))) { include($close_template); }
?>