<?php
require_once("mvc/base/Library.php");
class VH {
    static function getRequest() {
        return \MVC\Base\RequestRegistry::getRequest();
    }
}
?>