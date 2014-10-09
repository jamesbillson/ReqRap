<?php
class UrlHelper {
	public static function getPrefixLink($link) {
		$url = Yii::app()->params['server'].'/req/'.$link;
		$beautiful_url = str_replace('//', '/', $url);
		return 'http://'.$beautiful_url;
	}
}