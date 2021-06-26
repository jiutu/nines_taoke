<?php
/**
 * TOP API: taobao.tbk.sc.publisher.info.get request
 * 
 * @author auto create
 * @since 1.0, 2021.01.14
 */
class TbkScPublisherInfoGetRequest
{
	/** 
	 * 淘宝客外部用户标记，如自身系统账户ID；微信ID等
	 **/
	private $externalId;
	
	/** 
	 * 1-微信、2-微博、3-抖音、4-快手、5-QQ，0-其他；默认为0
	 **/
	private $externalType;
	
	/** 
	 * 类型，必选 1:渠道信息；2:会员信息
	 **/
	private $infoType;
	
	/** 
	 * 第几页
	 **/
	private $pageNo;
	
	/** 
	 * 每页大小
	 **/
	private $pageSize;
	
	/** 
	 * 备案的场景：common（通用备案），etao（一淘备案），minietao（一淘小程序备案），offlineShop（线下门店备案），offlinePerson（线下个人备案）。如不填默认common。查询会员信息只需填写common即可
	 **/
	private $relationApp;
	
	/** 
	 * 渠道独占 - 渠道关系ID
	 **/
	private $relationId;
	
	/** 
	 * 会员独占 - 会员运营ID
	 **/
	private $specialId;
	
	private $apiParas = array();
	
	public function setExternalId($externalId)
	{
		$this->externalId = $externalId;
		$this->apiParas["external_id"] = $externalId;
	}

	public function getExternalId()
	{
		return $this->externalId;
	}

	public function setExternalType($externalType)
	{
		$this->externalType = $externalType;
		$this->apiParas["external_type"] = $externalType;
	}

	public function getExternalType()
	{
		return $this->externalType;
	}

	public function setInfoType($infoType)
	{
		$this->infoType = $infoType;
		$this->apiParas["info_type"] = $infoType;
	}

	public function getInfoType()
	{
		return $this->infoType;
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

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function setRelationApp($relationApp)
	{
		$this->relationApp = $relationApp;
		$this->apiParas["relation_app"] = $relationApp;
	}

	public function getRelationApp()
	{
		return $this->relationApp;
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

	public function setSpecialId($specialId)
	{
		$this->specialId = $specialId;
		$this->apiParas["special_id"] = $specialId;
	}

	public function getSpecialId()
	{
		return $this->specialId;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.sc.publisher.info.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->infoType,"infoType");
		RequestCheckUtil::checkNotNull($this->relationApp,"relationApp");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
