<?php
class UrlHelper {
	public static function getPrefixLink($link) {
		$url = 'staging.reqrap.com/req/'.$link;
		$beautiful_url = str_replace('//', '/', $url);
		return 'http://'.$beautiful_url;
	}
}