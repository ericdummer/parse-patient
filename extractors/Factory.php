<?php
/**
 * Created by PhpStorm.
 * User: ericdummer
 * Date: 9/12/18
 * Time: 8:53 PM
 */


class Factory {
    /**
     * @param $type
     * @return jsonExtract|xmlExtract
     */
    static function getByType($type) {
        switch ($type) {
            case "json":
                return new jsonExtract();
                break;
            case "xml":
                return new xmlExtract();
                break;
        }
    }
}