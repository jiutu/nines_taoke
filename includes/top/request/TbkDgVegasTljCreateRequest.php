<?php
/**
 * TOP API: taobao.tbk.dg.vegas.tlj.create request
 * 
 * @author auto create
 * @since 1.0, 2021.03.05
 */
class TbkDgVegasTljCreateRequest
{
	/** 
	 * 妈妈广告位Id
	 **/
	private $adzoneId;
	
	/** 
	 * CPS佣金计划类型
	 **/
	private $campaignType;
	
	/** 
	 * 宝贝id
	 **/
	private $itemId;
	
	/** 
	 * 淘礼金名称，最大10个字符
	 **/
	private $name;
	
	/** 
	 * 单个淘礼金面额，支持两位小数，单位元
	 **/
	private $perFace;
	
	/** 
	 * 安全等级，0：适用于常规淘礼金投放场景；1：更高安全级别，适用于淘礼金面额偏大等安全性较高的淘礼金投放场景，可能导致更多用户拦截。security_switch为true，此字段不填写时，使用0作为默认安全级别。如果security_switch为false，不进行安全判断。
	 **/
	private $securityLevel;
	
	/** 
	 * 安全开关，若不进行安全校验，可能放大您的资损风险，请谨慎选择
	 **/
	private $securitySwitch;
	
	/** 
	 * 发放截止时间
	 **/
	private $sendEndTime;
	
	/** 
	 * 发放开始时间
	 **/
	private $sendStartTime;
	
	/** 
	 * 淘礼金总个数
	 **/
	private $totalNum;
	
	/** 
	 * 使用结束日期。如果是结束时间模式为相对时间，时间格式为1-7直接的整数, 例如，1（相对领取时间1天）； 如果是绝对时间，格式为yyyy-MM-dd，例如，2019-01-29，表示到2019-01-29 23:59:59结束
	 **/
	private $useEndTime;
	
	/** 
	 * 结束日期的模式,1:相对时间，2:绝对时间
	 **/
	private $useEndTimeMode;
	
	/** 
	 * 使用开始日期。相对时间，无需填写，以用户领取时间作为使用开始时间。绝对时间，格式 yyyy-MM-dd，例如，2019-01-29，表示从2019-01-29 00:00:00 开始
	 **/
	private $useStartTime;
	
	/** 
	 * 单用户累计中奖次数上限
	 **/
	private $userTotalWinNumLimit;
	
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

	public function setCampaignType($campaignType)
	{
		$this->campaignType = $campaignType;
		$this->apiParas["campaign_type"] = $campaignType;
	}

	public function getCampaignType()
	{
		return $this->campaignType;
	}

	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId()
	{
		return $this->itemId;
	}

	public function setName($name)
	{
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setPerFace($perFace)
	{
		$this->perFace = $perFace;
		$this->apiParas["per_face"] = $perFace;
	}

	public function getPerFace()
	{
		return $this->perFace;
	}

	public function setSecurityLevel($securityLevel)
	{
		$this->securityLevel = $securityLevel;
		$this->apiParas["security_level"] = $securityLevel;
	}

	public function getSecurityLevel()
	{
		return $this->securityLevel;
	}

	public function setSecuritySwitch($securitySwitch)
	{
		$this->securitySwitch = $securitySwitch;
		$this->apiParas["security_switch"] = $securitySwitch;
	}

	public function getSecuritySwitch()
	{
		return $this->securitySwitch;
	}

	public function setSendEndTime($sendEndTime)
	{
		$this->sendEndTime = $sendEndTime;
		$this->apiParas["send_end_time"] = $sendEndTime;
	}

	public function getSendEndTime()
	{
		return $this->sendEndTime;
	}

	public function setSendStartTime($sendStartTime)
	{
		$this->sendStartTime = $sendStartTime;
		$this->apiParas["send_start_time"] = $sendStartTime;
	}

	public function getSendStartTime()
	{
		return $this->sendStartTime;
	}

	public function setTotalNum($totalNum)
	{
		$this->totalNum = $totalNum;
		$this->apiParas["total_num"] = $totalNum;
	}

	public function getTotalNum()
	{
		return $this->totalNum;
	}

	public function setUseEndTime($useEndTime)
	{
		$this->useEndTime = $useEndTime;
		$this->apiParas["use_end_time"] = $useEndTime;
	}

	public function getUseEndTime()
	{
		return $this->useEndTime;
	}

	public function setUseEndTimeMode($useEndTimeMode)
	{
		$this->useEndTimeMode = $useEndTimeMode;
		$this->apiParas["use_end_time_mode"] = $useEndTimeMode;
	}

	public function getUseEndTimeMode()
	{
		return $this->useEndTimeMode;
	}

	public function setUseStartTime($useStartTime)
	{
		$this->useStartTime = $useStartTime;
		$this->apiParas["use_start_time"] = $useStartTime;
	}

	public function getUseStartTime()
	{
		return $this->useStartTime;
	}

	public function setUserTotalWinNumLimit($userTotalWinNumLimit)
	{
		$this->userTotalWinNumLimit = $userTotalWinNumLimit;
		$this->apiParas["user_total_win_num_limit"] = $userTotalWinNumLimit;
	}

	public function getUserTotalWinNumLimit()
	{
		return $this->userTotalWinNumLimit;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.dg.vegas.tlj.create";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->adzoneId,"adzoneId");
		RequestCheckUtil::checkNotNull($this->itemId,"itemId");
		RequestCheckUtil::checkNotNull($this->name,"name");
		RequestCheckUtil::checkNotNull($this->perFace,"perFace");
		RequestCheckUtil::checkNotNull($this->securitySwitch,"securitySwitch");
		RequestCheckUtil::checkNotNull($this->sendStartTime,"sendStartTime");
		RequestCheckUtil::checkNotNull($this->totalNum,"totalNum");
		RequestCheckUtil::checkNotNull($this->userTotalWinNumLimit,"userTotalWinNumLimit");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
