<?php
/**
 * File: File.php
 * User: zacharydubois
 * Date: 2016-04-11
 * Time: 09:51
 * Project: Fluid-MC-Stats
 */

namespace fmcs;


class File {
    /**
     * Read File
     *
     * Reads file using file_get_contents. Before reading, it will check permissions for ability to read and throw if
     * false.
     *
     * @param string $file
     * @return string
     * @throws Exception
     */
    public static function read(string $file) {
        // Make the path absolute to storage.
        $file = STORAGE . $file;

        if (!is_readable($file)) {
            throw new Exception("Could not read file (check permissions): " . $file, 2);
        }

        // Get the file contents
        $status = file_get_contents($file);

        if ($status === false) {
            throw new Exception("Error reading file (false): " . $file, 3);
        }

        // Return them.
        return $file;
    }

    /**
     * @param string $file
     * @param string $payload
     * @return false|int
     * @throws Exception
     */
    public static function write(string $file, string $payload) {
        // Make the path absolute to storage.
        $file = STORAGE . $file;

        // Check permissions if file exists.
        if (!is_readable($file) && !is_writable($file) && file_exists($file)) {
            throw new Exception("Could not write file (check permissions): " . $file, 4);
        }

        // Check directory permissions if file does not.
        if (!is_readable(dirname($file)) && !is_writable(dirname($file)) && !file_exists($file)) {
            throw new Exception("Could not write file (check permissions): " . $file, 4);
        }

        // Get the file contents
        $status = file_put_contents($file, $payload);

        if ($status === false) {
            throw new Exception("Error writing file (false): " . $file, 5);
        }

        // Return bytes.
        return $status;
    }
}