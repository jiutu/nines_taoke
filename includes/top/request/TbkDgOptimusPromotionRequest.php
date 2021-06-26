<?php
/**
 * TOP API: taobao.tbk.dg.optimus.promotion request
 * 
 * @author auto create
 * @since 1.0, 2020.10.27
 */
class TbkDgOptimusPromotionRequest
{
	/** 
	 * mm_xxx_xxx_xxx的第3段数字
	 **/
	private $adzoneId;
	
	/** 
	 * 第几页，默认：1
	 **/
	private $pageNum;
	
	/** 
	 * 页大小，一次请求请限制在10以内
	 **/
	private $pageSize;
	
	/** 
	 * 官方提供的权益物料Id。有价券-37104、大额店铺券-37116，更多权益物料id敬请期待！
	 **/
	private $promotionId;
	
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

	public function setPageNum($pageNum)
	{
		$this->pageNum = $pageNum;
		$this->apiParas["page_num"] = $pageNum;
	}

	public function getPageNum()
	{
		return $this->pageNum;
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

	public function setPromotionId($promotionId)
	{
		$this->promotionId = $promotionId;
		$this->apiParas["promotion_id"] = $promotionId;
	}

	public function getPromotionId()
	{
		return $this->promotionId;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.dg.optimus.promotion";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->adzoneId,"adzoneId");
		RequestCheckUtil::checkMaxValue($this->pageSize,10,"pageSize");
		RequestCheckUtil::checkNotNull($this->promotionId,"promotionId");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
