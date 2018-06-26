<?php
/**
 * Created by PhpStorm.
 * User: udesh
 * Date: 6/23/18
 * Time: 1:40 PM
 */
namespace framework\util;

class DBUtils {
    public static function getAssocArray($result) {
        $items = array();
        if ($result) {
            if ($result->num_rows > 0)
                while ($row = $result->fetch_assoc())
                    $items[] = $row;
            return $items;
        } else return false;
    }
}