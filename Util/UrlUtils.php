<?php

include_once "Config/config.php";


class UrlUtils
{
	function __construct()
	{
	}
	
	static function getControllerUrl($controller)
	{
		global $APP_URL;
		return $APP_URL.$controller."/";
	}
}
