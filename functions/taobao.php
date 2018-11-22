<?php 

function nines_taoke_shop_get($q = '', $page = 1)
{
	$sysParams["app_key"] = get_option('nines_taoke_key');
	// $sysParams["app_secret"] = get_option('tk_secret');
	$sysParams["v"] = "2.0";
	$sysParams["format"] = "json";
	$sysParams["sign_method"] = "md5";
	$sysParams["method"] = "taobao.tbk.dg.item.coupon.get";
	$sysParams["timestamp"] = date("Y-m-d H:i:s", time());
	$sysParams["partner_id"] = "1.0";
	$apiParams['adzone_id'] = nines_taoke_get_pid(get_option('nines_taoke_pid'));
	$apiParams['q'] = $q;
	$apiParams['page_no'] = $page;
	$apiParams['page_size'] = 20;
	$sysParams['sign'] = nines_taoke_get_generateSign(array_merge($apiParams, $sysParams), get_option('nines_taoke_secret'));
	$requestUrl = "https://eco.taobao.com/router/rest?";
	foreach ($sysParams as $sysParamKey => $sysParamValue) {
		$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
	}
	$requestUrl = substr($requestUrl, 0, -1);
	$resp = nines_taoke_get_curl($requestUrl, $apiParams);
	$respObject = json_decode($resp);
	if (empty($respObject->tbk_dg_item_coupon_get_response)) {
		return json_encode([ 'states' => false,'msg' => nines_taoke_output_error($respObject->error_response->msg)]);
	}
	if (empty($respObject->tbk_dg_item_coupon_get_response->results)) {
		return json_encode([ 'states' => false,'msg' => '未能找到相关商品数据']);
	}

	$data = $respObject->tbk_dg_item_coupon_get_response->results->tbk_coupon;
	foreach ($data as $key => $val) {
		$data[$key]->final_price = $data[$key]->zk_final_price - nines_taoke_price($data[$key]->coupon_info);
		$data[$key]->pict_url = str_replace("http","https",$data[$key]->pict_url);
	}
	return json_encode(['states' => true, 'msg' =>'Success', 'data' => $data]);
}

function nines_taoke_get_paging($page = 1, $q = ''){
	if (empty($page) || $page < 0 && $page != '0') {
		$xia = 1;
		$shang = $page + 1;
		if ($page < 0) {
			$shang = 2;
		}
	} else {
		$xia = $page - 1;
		$shang = $page + 1;
	}
	if ($xia == '0' || $xia == '1') {
		$xia = 1;
	}
	$xia = ($q != '') ? '?q=' . $q . '&page=' . $xia : '?page=' . $xia;
	$shang = ($q != '') ? '?q=' . $q . '&page=' . $shang : '?page=' . $shang;
	return [$xia, $shang];
	}


function nines_taoke_output_error($msg)
{		
	switch ($msg)
	{
		case 'Invalid app Key':
		$code = 'App Key有误,请检查';
		break;
		case 'Invalid signature':
		$code =  "无效的签名,多半是App Secret引起的,请检查";
		break;
		default:
		$code = '发生未知错误,请检查或联系作者';
	}
	return $code;
}

function nines_taoke_price($price)
{
	$price = explode('减', $price);
	$price = explode('元', $price[1]);
	return $price[0];
}

function nines_taoke_get_curl($url, $post = 0, $header = 0, $referer = 0, $cookie = 0, $ua = 0, $nobaody = 0)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$klsf[] = "Accept:*";
	$klsf[] = "Accept-Encoding:gzip,deflate,sdch";
	$klsf[] = "Accept-Language:zh-CN,zh;q=0.8";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $klsf);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if ($header) {
		curl_setopt($ch, CURLOPT_HEADER, true);
	}
	if ($cookie) {
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if ($referer) {
		if ($referer == 1) {
			curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
		} else {
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if ($ua) {
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	} else {
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
	}
	if ($nobaody) {
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;

}

function nines_taoke_get_generateSign($params, $secret)
{
	ksort($params);
	$stringToBeSigned = $secret;
	foreach ($params as $k => $v) {
		if ("@" != substr($v, 0, 1)) {
			$stringToBeSigned .= "$k$v";
		}
	}
	unset($k, $v);
	$stringToBeSigned .= $secret;
	return strtoupper(md5($stringToBeSigned));
}

function nines_taoke_get_pid($pid = false)
{
	$res = explode('_', $pid);
	if (count($res) < 4) {
		return false;
	}
	return $res[3];
}

?>