<?php
$root = $_SERVER['DOCUMENT_ROOT'];
set_include_path($root);
require "vendor/autoload.php";
include_once "modules/autoload.php";

use \AubyTube\ControllerV2\Core as CV2;
use \AubyTube\TemplateManager;

CV2::registerStateVariable($at);
TemplateManager::registerGlobalState($at);

require "router.php";