<?php

class ErrorController {

    static function display($message) {
        require(VIEW . 'errorView.php');
    }

}
