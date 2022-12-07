<?php
/**
 *  SplFileInfo
 *  SplFileObject
 *  SplTempFileObject
 */
namespace helpers\file;

use \SplFileObject;
class FileHandler 
{
    /**
     * NOTE TO SELF
     * 
     * file — Reads entire file contents into an array of lines.
     * file_get_contents — Reads entire file contents into a string.
     * fopen — Opens a file handle that can be manipulated with other library functions, but does no reading or writing itself.
     * 
     */

    // USEFUL mode for fopen

    // 'r' 	Open for reading only; place the file pointer at the beginning of the file.

    // 'r+' Open for reading and writing; place the file pointer at the beginning of the file.

    // 'w' 	Open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. 
            // If the file does not exist, attempt to create it.

    // 'w+' Open for reading and writing; otherwise it has the same behavior as 'w'.
    
    // 'a' 	Open for writing only; place the file pointer at the end of the file. 
            // If the file does not exist, attempt to create it. In this mode, fseek() has no effect, writes are always appended.

    // 'a+' Open for reading and writing; place the file pointer at the end of the file. 
            // If the file does not exist, attempt to create it. 
            // In this mode, fseek() only affects the reading position, writes are always appended.

    // 'c' 	Open the file for writing only. If the file does not exist, it is created. 
            // If it exists, it is neither truncated (as opposed to 'w'), nor the call to this function fails (as is the case with 'x'). 
            // The file pointer is positioned on the beginning of the file. 
            // This may be useful if it's desired to get an advisory lock (see flock()) before attempting to modify the file, 
            // as using 'w' could truncate the file before the lock was obtained (if truncation is desired, 
            // ftruncate() can be used after the lock is requested).

    // 'c+' Open the file for reading and writing; otherwise it has the same behavior as 'c'.

    public static function openFile($filepath, $mode)
    {
        return @fopen($filepath, $mode);
    }

    /**
     * Read a file
     */
    public static function readFile($filepath)
    {
        $mode = 'r';
        $file = self::openFile($filepath, $mode);
        return $file;
    }

    /**
     * Read and Write a file
     * When using this make sure that file DIR is existing
     * it will attempt to create a file if it does not exists
     * if file exists it will be cleared
     */
    public static function writeFile($filepath)
    {
        $mode = 'w+';
        $file = self::openFile($filepath, $mode);
        return $file;
    }
    
    /**
     * Read and Write a file
     * it will attempt to create a file if it does not exists
     */
    public static function appendFile($filepath)
    {
        $mode = 'a+';
        $file = self::openFile($filepath, $mode);
        return $file;
    }

    public static function getAbsolutePath($path) {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes);
    }

}