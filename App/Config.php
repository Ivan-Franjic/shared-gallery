<?php

ini_set('display_errors', 1);


define("DS", DIRECTORY_SEPARATOR);
define("APP_ROOT", dirname(__FILE__, 2) . DS . "App" . DS);
//define("PUB", dirname(__FILE__, 1) . DS . "pub" . DS);
define("URL_ROOT", "http://localhost/shared-gallery/");

define("VIEW_PATH", APP_ROOT . "View" . DS);
define("INCLUDE_PATH", APP_ROOT . "View" . DS);
//define("ADMIN_INCLUDE_PATH", APP_ROOT . "View" . DS . "Admin" . DS . "Include" . DS);
define("RESOURCE_CSS_PATH", URL_ROOT . DS . "css" . DS);
//define("RESOURCE_JS_PATH", URL_ROOT . "js" . DS);
//define("RESOURCE_IMG_PATH", URL_ROOT . "images" . DS);
define("SITE_NAME", "Shared gallery");