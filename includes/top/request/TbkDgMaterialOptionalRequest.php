<?php
/**
 * TOP API: taobao.tbk.dg.material.optional request
 * 
 * @author auto create
 * @since 1.0, 2021.03.16
 */
class TbkDgMaterialOptionalRequest
{
	/** 
	 * mm_xxx_xxx_12345678三段式的最后一段数字
	 **/
	private $adzoneId;
	
	/** 
	 * 商品筛选-后台类目ID。用,分割，最大10个，该ID可以通过taobao.itemcats.get接口获取到
	 **/
	private $cat;
	
	/** 
	 * 本地化业务入参-LBS信息-国标城市码，仅支持单个请求，请求饿了么卡券物料时，该字段必填。 （详细城市ID见：https://mo.m.taobao.com/page_2020010315120200508）
	 **/
	private $cityCode;
	
	/** 
	 * 智能匹配-设备号加密类型：MD5
	 **/
	private $deviceEncrypt;
	
	/** 
	 * 智能匹配-设备号类型：IMEI，或者IDFA，或者UTDID（UTDID不支持MD5加密），或者OAID
	 **/
	private $deviceType;
	
	/** 
	 * 智能匹配-设备号加密后的值（MD5加密需32位小写）
	 **/
	private $deviceValue;
	
	/** 
	 * 商品筛选-KA媒体淘客佣金比率上限。如：1234表示12.34%
	 **/
	private $endKaTkRate;
	
	/** 
	 * 商品筛选-折扣价范围上限。单位：元
	 **/
	private $endPrice;
	
	/** 
	 * 商品筛选-淘客佣金比率上限。如：1234表示12.34%
	 **/
	private $endTkRate;
	
	/** 
	 * 优惠券筛选-是否有优惠券。true表示该商品有优惠券，false或不设置表示不限
	 **/
	private $hasCoupon;
	
	/** 
	 * 商品筛选-好评率是否高于行业均值。True表示大于等于，false或不设置表示不限
	 **/
	private $includeGoodRate;
	
	/** 
	 * 商品筛选(特定媒体支持)-成交转化是否高于行业均值。True表示大于等于，false或不设置表示不限
	 **/
	private $includePayRate30;
	
	/** 
	 * 商品筛选(特定媒体支持)-退款率是否低于行业均值。True表示大于等于，false或不设置表示不限
	 **/
	private $includeRfdRate;
	
	/** 
	 * ip参数影响邮费获取，如果不传或者传入不准确，邮费无法精准提供
	 **/
	private $ip;
	
	/** 
	 * 商品筛选-是否海外商品。true表示属于海外商品，false或不设置表示不限
	 **/
	private $isOverseas;
	
	/** 
	 * 商品筛选-是否天猫商品。true表示属于天猫商品，false或不设置表示不限
	 **/
	private $isTmall;
	
	/** 
	 * 商品筛选-所在地
	 **/
	private $itemloc;
	
	/** 
	 * 本地化业务入参-LBS信息-纬度
	 **/
	private $latitude;
	
	/** 
	 * 锁佣结束时间
	 **/
	private $lockRateEndTime;
	
	/** 
	 * 锁佣开始时间
	 **/
	private $lockRateStartTime;
	
	/** 
	 * 本地化业务入参-LBS信息-经度
	 **/
	private $longitude;
	
	/** 
	 * 不传时默认物料id=2836；如果直接对消费者投放，可使用官方个性化算法优化的搜索物料id=17004
	 **/
	private $materialId;
	
	/** 
	 * 商品筛选-是否包邮。true表示包邮，false或不设置表示不限
	 **/
	private $needFreeShipment;
	
	/** 
	 * 商品筛选-是否加入消费者保障。true表示加入，false或不设置表示不限
	 **/
	private $needPrepay;
	
	/** 
	 * 商品筛选-牛皮癣程度。取值：1不限，2无，3轻微
	 **/
	private $npxLevel;
	
	/** 
	 * 第几页，默认：１
	 **/
	private $pageNo;
	
	/** 
	 * 本地化业务入参-分页唯一标识，非首页的请求必传，值为上一页返回结果中的page_result_key字段值
	 **/
	private $pageResultKey;
	
	/** 
	 * 页大小，默认20，1~100
	 **/
	private $pageSize;
	
	/** 
	 * 链接形式：1：PC，2：无线，默认：１
	 **/
	private $platform;
	
	/** 
	 * 商品筛选-查询词
	 **/
	private $q;
	
	/** 
	 * 渠道关系ID，仅适用于渠道推广场景
	 **/
	private $relationId;
	
	/** 
	 * 商家id，仅支持饿了么卡券商家ID，支持批量请求1-100以内，多个商家ID使用英文逗号分隔
	 **/
	private $sellerIds;
	
	/** 
	 * 排序_des（降序），排序_asc（升序），销量（total_sales），淘客佣金比率（tk_rate）， 累计推广量（tk_total_sales），总支出佣金（tk_total_commi），价格（price），匹配分（match）
	 **/
	private $sort;
	
	/** 
	 * 会员运营ID
	 **/
	private $specialId;
	
	/** 
	 * 商品筛选(特定媒体支持)-店铺dsr评分。筛选大于等于当前设置的店铺dsr评分的商品0-50000之间
	 **/
	private $startDsr;
	
	/** 
	 * 商品筛选-KA媒体淘客佣金比率下限。如：1234表示12.34%
	 **/
	private $startKaTkRate;
	
	/** 
	 * 商品筛选-折扣价范围下限。单位：元
	 **/
	private $startPrice;
	
	/** 
	 * 商品筛选-淘客佣金比率下限。如：1234表示12.34%
	 **/
	private $startTkRate;
	
	/** 
	 * 人群ID，仅适用于物料评估场景material_id=41377
	 **/
	private $ucrowdId;
	
	/** 
	 * 物料评估-商品列表
	 **/
	private $ucrowdRankItems;
	
	private $apiParas = array();
	
	public function setAdzoneId($adzoneId)
	{
		$this->adzoneId = $adzoneId;
		$this->apiParas["adzone_id"] = $adzoneId;
	}

	public function getAdzoneId()
	{
		return $this->adzoneId;
	}

	public function setCat($cat)
	{
		$this->cat = $cat;
		$this->apiParas["cat"] = $cat;
	}

	public function getCat()
	{
		return $this->cat;
	}

	public function setCityCode($cityCode)
	{
		$this->cityCode = $cityCode;
		$this->apiParas["city_code"] = $cityCode;
	}

	public function getCityCode()
	{
		return $this->cityCode;
	}

	public function setDeviceEncrypt($deviceEncrypt)
	{
		$this->deviceEncrypt = $deviceEncrypt;
		$this->apiParas["device_encrypt"] = $deviceEncrypt;
	}

	public function getDeviceEncrypt()
	{
		return $this->deviceEncrypt;
	}

	public function setDeviceType($deviceType)
	{
		$this->deviceType = $deviceType;
		$this->apiParas["device_type"] = $deviceType;
	}

	public function getDeviceType()
	{
		return $this->deviceType;
	}

	public function setDeviceValue($deviceValue)
	{
		$this->deviceValue = $deviceValue;
		$this->apiParas["device_value"] = $deviceValue;
	}

	public function getDeviceValue()
	{
		return $this->deviceValue;
	}

	public function setEndKaTkRate($endKaTkRate)
	{
		$this->endKaTkRate = $endKaTkRate;
		$this->apiParas["end_ka_tk_rate"] = $endKaTkRate;
	}

	public function getEndKaTkRate()
	{
		return $this->endKaTkRate;
	}

	public function setEndPrice($endPrice)
	{
		$this->endPrice = $endPrice;
		$this->apiParas["end_price"] = $endPrice;
	}

	public function getEndPrice()
	{
		return $this->endPrice;
	}

	public function setEndTkRate($endTkRate)
	{
		$this->endTkRate = $endTkRate;
		$this->apiParas["end_tk_rate"] = $endTkRate;
	}

	public function getEndTkRate()
	{
		return $this->endTkRate;
	}

	public function setHasCoupon($hasCoupon)
	{
		$this->hasCoupon = $hasCoupon;
		$this->apiParas["has_coupon"] = $hasCoupon;
	}

	public function getHasCoupon()
	{
		return $this->hasCoupon;
	}

	public function setIncludeGoodRate($includeGoodRate)
	{
		$this->includeGoodRate = $includeGoodRate;
		$this->apiParas["include_good_rate"] = $includeGoodRate;
	}

	public function getIncludeGoodRate()
	{
		return $this->includeGoodRate;
	}

	public function setIncludePayRate30($includePayRate30)
	{
		$this->includePayRate30 = $includePayRate30;
		$this->apiParas["include_pay_rate_30"] = $includePayRate30;
	}

	public function getIncludePayRate30()
	{
		return $this->includePayRate30;
	}

	public function setIncludeRfdRate($includeRfdRate)
	{
		$this->includeRfdRate = $includeRfdRate;
		$this->apiParas["include_rfd_rate"] = $includeRfdRate;
	}

	public function getIncludeRfdRate()
	{
		return $this->includeRfdRate;
	}

	public function setIp($ip)
	{
		$this->ip = $ip;
		$this->apiParas["ip"] = $ip;
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function setIsOverseas($isOverseas)
	{
		$this->isOverseas = $isOverseas;
		$this->apiParas["is_overseas"] = $isOverseas;
	}

	public function getIsOverseas()
	{
		return $this->isOverseas;
	}

	public function setIsTmall($isTmall)
	{
		$this->isTmall = $isTmall;
		$this->apiParas["is_tmall"] = $isTmall;
	}

	public function getIsTmall()
	{
		return $this->isTmall;
	}

	public function setItemloc($itemloc)
	{
		$this->itemloc = $itemloc;
		$this->apiParas["itemloc"] = $itemloc;
	}

	public function getItemloc()
	{
		return $this->itemloc;
	}

	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
		$this->apiParas["latitude"] = $latitude;
	}

	public function getLatitude()
	{
		return $this->latitude;
	}

	public function setLockRateEndTime($lockRateEndTime)
	{
		$this->lockRateEndTime = $lockRateEndTime;
		$this->apiParas["lock_rate_end_time"] = $lockRateEndTime;
	}

	public function getLockRateEndTime()
	{
		return $this->lockRateEndTime;
	}

	public function setLockRateStartTime($lockRateStartTime)
	{
		$this->lockRateStartTime = $lockRateStartTime;
		$this->apiParas["lock_rate_start_time"] = $lockRateStartTime;
	}

	public function getLockRateStartTime()
	{
		return $this->lockRateStartTime;
	}

	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
		$this->apiParas["longitude"] = $longitude;
	}

	public function getLongitude()
	{
		return $this->longitude;
	}

	public function setMaterialId($materialId)
	{
		$this->materialId = $materialId;
		$this->apiParas["material_id"] = $materialId;
	}

	public function getMaterialId()
	{
		return $this->materialId;
	}

	public function setNeedFreeShipment($needFreeShipment)
	{
		$this->needFreeShipment = $needFreeShipment;
		$this->apiParas["need_free_shipment"] = $needFreeShipment;
	}

	public function getNeedFreeShipment()
	{
		return $this->needFreeShipment;
	}

	public function setNeedPrepay($needPrepay)
	{
		$this->needPrepay = $needPrepay;
		$this->apiParas["need_prepay"] = $needPrepay;
	}

	public function getNeedPrepay()
	{
		return $this->needPrepay;
	}

	public function setNpxLevel($npxLevel)
	{
		$this->npxLevel = $npxLevel;
		$this->apiParas["npx_level"] = $npxLevel;
	}

	public function getNpxLevel()
	{
		return $this->npxLevel;
	}

	public function setPageNo($pageNo)
	{
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo()
	{
		return $this->pageNo;
	}

	public function setPageResultKey($pageResultKey)
	{
		$this->pageResultKey = $pageResultKey;
		$this->apiParas["page_result_key"] = $pageResultKey;
	}

	public function getPageResultKey()
	{
		return $this->pageResultKey;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function setPlatform($platform)
	{
		$this->platform = $platform;
		$this->apiParas["platform"] = $platform;
	}

	public function getPlatform()
	{
		return $this->platform;
	}

	public function setQ($q)
	{
		$this->q = $q;
		$this->apiParas["q"] = $q;
	}

	public function getQ()
	{
		return $this->q;
	}

	public function setRelationId($relationId)
	{
		$this->relationId = $relationId;
		$this->apiParas["relation_id"] = $relationId;
	}

	public function getRelationId()
	{
		return $this->relationId;
	}

	public function setSellerIds($sellerIds)
	{
		$this->sellerIds = $sellerIds;
		$this->apiParas["seller_ids"] = $sellerIds;
	}

	public function getSellerIds()
	{
		return $this->sellerIds;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
		$this->apiParas["sort"] = $sort;
	}

	public function getSort()
	{
		return $this->sort;
	}

	public function setSpecialId($specialId)
	{
		$this->specialId = $specialId;
		$this->apiParas["special_id"] = $specialId;
	}

	public function getSpecialId()
	{
		return $this->specialId;
	}

	public function setStartDsr($startDsr)
	{
		$this->startDsr = $startDsr;
		$this->apiParas["start_dsr"] = $startDsr;
	}

	public function getStartDsr()
	{
		return $this->startDsr;
	}

	public function setStartKaTkRate($startKaTkRate)
	{
		$this->startKaTkRate = $startKaTkRate;
		$this->apiParas["start_ka_tk_rate"] = $startKaTkRate;
	}

	public function getStartKaTkRate()
	{
		return $this->startKaTkRate;
	}

	public function setStartPrice($startPrice)
	{
		$this->startPrice = $startPrice;
		$this->apiParas["start_price"] = $startPrice;
	}

	public function getStartPrice()
	{
		return $this->startPrice;
	}

	public function setStartTkRate($startTkRate)
	{
		$this->startTkRate = $startTkRate;
		$this->apiParas["start_tk_rate"] = $startTkRate;
	}

	public function getStartTkRate()
	{
		return $this->startTkRate;
	}

	public function setUcrowdId($ucrowdId)
	{
		$this->ucrowdId = $ucrowdId;
		$this->apiParas["ucrowd_id"] = $ucrowdId;
	}

	public function getUcrowdId()
	{
		return $this->ucrowdId;
	}

	public function setUcrowdRankItems($ucrowdRankItems)
	{
		$this->ucrowdRankItems = $ucrowdRankItems;
		$this->apiParas["ucrowd_rank_items"] = $ucrowdRankItems;
	}

	public function getUcrowdRankItems()
	{
		return $this->ucrowdRankItems;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.dg.material.optional";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->adzoneId,"adzoneId");
		RequestCheckUtil::checkMaxValue($this->startDsr,50000,"startDsr");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
