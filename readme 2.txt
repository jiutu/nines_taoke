=== 淘宝客（官方接口） ===
Contributors: jiutu
Tags: wordpress,淘宝客,淘客,优惠券,淘宝,聚划算,taobao,领劵,购物
Requires at least: 4.8
Tested up to: 5.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.aliluv.cn/liuyan
== Description ==

功能一:在一个新的页面中显示淘客商品(高额优惠券);
	  示例:[https://www.aliluv.cn/shop](https://www.aliluv.cn/shop)
功能二:通过文章标签获取淘客商品;
	  示例(文章内容底部):[https://www.aliluv.cn/199.html](https://www.aliluv.cn/199.html)
更多功能开发中...(有需求的功能可联系)

== Installation ==

1. 上传 `nines-taoke`目录 到 `/wp-content/plugins/` 目录或后台搜索Nines Taoke
2. 在后台插件菜单激活该插件
3. 后台`淘宝客配置`填写你的 `App Key` ,`App Secret` ,`Pid` 三个配置项以及新建一个新页面用来展示淘客商品
4. 其中pid参数必须是淘宝联盟->网站推广位  的pid(没有这个推广位的pid请申请),其它位置的pid将获取不到商品数据、详细教程请点击 `插件设置帮助`

== Screenshots ==

1. 前端首页展示截图
2. 搜索功能展示截图

== Frequently asked questions ==

1、如果在页面中显示(不是商品数据时)错误信息时:多半是App Key或者App Secret的原因,自行检查;
2、提示 “未能找到相关商品数据” 多半是Pid不属于 网站推广位 ;
3、演示地址:[https://www.aliluv.cn/shop](https://www.aliluv.cn/shop)
4、插件设置帮助:[https://www.aliluv.cn/18.html](https://www.aliluv.cn/18.html)

== Changelog ==
= 2.7.2 =
* 修复淘口令功能!

= 2.7.1 =
* *****

= 2.7.0 =
* 增加淘口令功能(淘口令,文本形式)

= 2.6.0 =
* 增加淘客短网址,更方便于推广、提供api接口!!

= 2.5.2 =
* 修复文章标签输出的商品列表显示错误问题

= 2.4.5 =
* 修复重构后分页错误问题

= 2.4.4 =
* 后台菜单页面优化

= 2.4.3 =
* 代码优化,重构

= 2.4.2 =
* 优化代码

= 2.4.1 =
* 修复受主题或插件的影响无法获取商品

= 2.4.0 =
* 新增通过文章内添加的关键词获取相关淘客商品信息.
* 支持设置文章是否显示商品开关
* 示例(见文章内容底部): [https://www.aliluv.cn/199.html](https://www.aliluv.cn/199.html)

= 2.3.1 =
* 新增默认显示商品分类

= 2.3.0 =
* 新增自定义商品栏目

= 2.2.6 =
* 修复字体大小

= 2.2.5 =
* 修复优惠券字体大小

= 2.2.4 =
* 修复优惠券样式

= 2.2.3 =
* 修复样式

= 2.2.2 =
* 全新界面，更多搜索推荐词（暂时只弄了三个推荐的、因为...懒!!!）
* 支持搜索商品
* 修复bug

= 2.1.0 =
* 修改淘宝客新接口(原接口官方已关闭)已无法再获取数据
* 新增`店铺评分`,`宝贝所在地`
* 修复bug

= 2.0.2 =
* 修正移动端顶部菜单显示问题

= 2.0.1 =
* 样式修改:防止与主题样式名称重叠

= 2.0 =
* 突进的一个2.0版本,此版本更新的内容很大!
* 全新的展示界面
* pc端将展示更多的分类信息
* 搜索功能,需要什么商品优惠券尽情搜索(手机端搜索功能没完善)
* 更多信息请看演示:[https://www.aliluv.cn/shop](https://www.aliluv.cn/shop)

= 1.0.1 =
* 更新后台设置页面的一些提交和帮助
= 1.0.0 =
* 最初版本发布

== Upgrade notice ==
暂无