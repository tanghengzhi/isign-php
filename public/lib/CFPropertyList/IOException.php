<?php
# @Author: JokenLiu <Jason>
# @Date:   2015-01-28 15:18:18
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: IOException.php
# @Last modified by:   Jason
# @Last modified time: 2018-01-29 19:43:48
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



/**
 * CFPropertyList
 * {@link http://developer.apple.com/documentation/Darwin/Reference/ManPages/man5/plist.5.html Property Lists}
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 * @version $Id$
 */
 // namespace CFPropertyList;
 namespace app\portal\controller;

/**
 * Basic Input / Output Exception
 * @author Rodney Rehm <rodney.rehm@medialize.de>
 * @author Christian Kruse <cjk@wwwtech.de>
 * @package plist
 */
class IOException extends \Exception {
  /**
   * Flag telling the File could not be found
   */
  const NOT_FOUND = 1;

  /**
   * Flag telling the File is not readable
   */
  const NOT_READABLE = 2;

  /**
   * Flag telling the File is not writable
   */
  const NOT_WRITABLE = 3;

  /**
   * Flag telling there was a read error
   */
  const READ_ERROR = 4;

  /**
   * Flag telling there was a read error
   */
  const WRITE_ERROR = 5;

  /**
   * Create new IOException
   * @param string $path Source of the problem
   * @param integer $type Type of the problem
   */
  public function __construct($path, $type=null) {
    parent::__construct( $path, $type );
  }

  /**
   * Create new FileNotFound-Exception
   * @param string $path Source of the problem
   * @return IOException new FileNotFound-Exception
   */
  public static function notFound($path) {
    return new IOException( $path, self::NOT_FOUND );
  }

  /**
   * Create new FileNotReadable-Exception
   * @param string $path Source of the problem
   * @return IOException new FileNotReadable-Exception
   */
  public static function notReadable($path) {
    return new IOException( $path, self::NOT_READABLE );
  }

  /**
   * Create new FileNotWritable-Exception
   * @param string $path Source of the problem
   * @return IOException new FileNotWritable-Exception
   */
  public static function notWritable($path) {
    return new IOException( $path, self::NOT_WRITABLE );
  }

  /**
   * Create new ReadError-Exception
   * @param string $path Source of the problem
   * @return IOException new ReadError-Exception
   */
  public static function readError($path) {
    return new IOException( $path, self::READ_ERROR );
  }

  /**
   * Create new WriteError-Exception
   * @param string $path Source of the problem
   * @return IOException new WriteError-Exception
   */
  public static function writeError($path) {
    return new IOException( $path, self::WRITE_ERROR );
  }
}
