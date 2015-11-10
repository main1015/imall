<?php
/**
 * @copyright (c) 2011 jooyea
 * @file sonline.php
 * @brief 在线客服插件,此插件是基于jquery的
 * @author chendeshan
 * @date 2013/7/15 0:29:17
 * @version 1.0.0
 */
class Sonline
{
	//插件路径
	public $path;

	/**
	 * 构造函数
	 * @param string $style 风格
	 */
	public function __construct($style = 'red')
	{
		$this->path = IUrl::creatUrl().'plugins/sonline/';

echo <<< OEF
	<link rel="stylesheet" href="{$this->path}style/{$style}.css" />
	<script type="text/javascript" src="{$this->path}js/jquery.Sonline.js"></script>
OEF;
	}

	/**
	 * 展示插件
	 * @param string $tel 电话号码
	 * @param string $qqSer 序列化的数据
	 */
	public function show($tel,$qqSer)
	{
		if(!$qqSer)
		{
			return null;
		}
		$qqArray = unserialize($qqSer);
		$tempArray = array();
		foreach($qqArray as $val)
		{
			$tempArray[] = $val['qq']."|".$val['name'];
		}
		if(!$tempArray)
		{
			return null;
		}
		$qqResult = join(',',$tempArray);

echo <<< OEF
<script type='text/javascript'>
$(function(){
	$().Sonline({
		"Position":"left",
		"Tel":"{$tel}",
		"Qqlist":"{$qqResult}"
	});
});
</script>
OEF;
	}

	/**
	 * @brief 展示qq联系代码
	 * @param string $qqNum QQ号码
	 */
	public static function qqShow($qqNum)
	{
		if(!$qqNum)
		{
			return;
		}
echo <<< OEF
	<a href="http://wpa.qq.com/msgrd?v=3&uin={$qqNum}&site=qq&menu=yes" target="_blank">
		<img border="0" alt="立即联系" src="http://wpa.qq.com/pa?p=2:{$qqNum}:41 &r=0.22914223582483828">
	</a>
OEF;
	}

    public static function sideBarQQ($qqSer){
        if(!$qqSer)
        {
            return null;
        }
        $qqArray = unserialize($qqSer);

        foreach($qqArray as $val)
        {
echo <<< OEF
    <li><a href="http://wpa.qq.com/msgrd?v=3&uin={$val['qq']}&site=qq&menu=yes" target="_blank" class="text">
        <s class="g-icon-qq1"></s><span>{$val['name']}</span>
    </a></li>
OEF;
        }
    }

	public static function showQQ($tel, $qqSer){
		if(!$qqSer)
		{
			return null;
		}
		$qqArray = unserialize($qqSer);

$div = <<< OEF
		<b>服务热线</b>
		<strong>{$tel}</strong>
OEF;

		foreach($qqArray as $val) {

			$div .= "<a class='service_kefu' href='http://wpa.qq.com/msgrd?v=3&uin={$val['qq']}&site=qq&menu=yes' target='_blank'>{$val['name']}</a>";
		}
		echo $div;
	}
}