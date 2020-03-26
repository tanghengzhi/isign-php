<?php
# @Author: JokenLiu <Jason>
# @Date:   2015-01-28 15:18:18
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: example-read-01.php
# @Last modified by:   Jason
# @Last modified time: 2018-01-31 13:51:26
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



/**
 * Examples for how to use CFPropertyList
 * Read an XML PropertyList
 * @package plist
 * @subpackage plist.examples
 */
namespace CFPropertyList;

// just in case...
error_reporting( E_ALL );
ini_set( 'display_errors', 'on' );

/**
 * Require CFPropertyList
 */
require_once(__DIR__.'/../classes/CFPropertyList/CFPropertyList.php');


/*
 * create a new CFPropertyList instance which loads the sample.plist on construct.
 * since we know it's an XML file, we can skip format-determination
 */
// $plist = new CFPropertyList( __DIR__.'/sample.xml.plist', CFPropertyList::FORMAT_XML );
$file = '/upload/ipa/20180129/d0d4bd01df2af1ad3b342c856e307880.xml';
//$plist = new CFPropertyList( __DIR__.'/plist.xml', CFPropertyList::FORMAT_XML );
$plist = new CFPropertyList( __DIR__.'/../../'.$file, CFPropertyList::FORMAT_XML );

//$file = APP_ROOT . '/upload/ipa/20180129/d1531d8d69605e4b4834b7f482098388.xml';
/*
 * retrieve the array structure of sample.plist and dump to stdout
 */

echo '<pre>';
var_dump( $plist->toArray() );
echo '</pre>';

?>
