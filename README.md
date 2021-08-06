## DSMall介绍
DSMall商城系统是基于ThinkPhp6.0+Vue开发的一套完善的B2B2C(多店铺商城)电商系统，DSMall商城系统能够快速积累客户、会员数据分析、智能转化客户、 有效提高销售、会员维护、网络营销的一款企业级应用，功能包含拼团、砍价、秒杀、优惠券、积分、分销、刮刮卡等功能，更适合企业二次开发


## 导航栏目
 [帮助手册](http://www.csdeshang.com/home/help/index/id/99.html)
 | [功能清单](http://www.csdeshang.com/home/dsmall/feature.html)
 | [官网地址](http://www.csdeshang.com)
 | [TP6开发手册](https://www.kancloud.cn/manual/thinkphp6_0/1037479)
 | [Vue.js手册](https://cn.vuejs.org/)


## QQ交流群
DSMall开源商城官方群:10235778  <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=c75ccf9e6f21a2a3eea7914be3131bc4a7a00abe08cd3aa57532349292e84ffe"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="DSMall开源商城官方群" title="DSMall开源商城官方群"></a>


## 演示Demo
| 演示角色  | 演示地址                                | 账号 | 账号 |
|-------|-------------------------------------|----|----|
| 后台PC端 | https://dsmall.csdeshang.com/admin/ |  dsmall  |  123456  |
| 用户PC端 | https://dsmall.csdeshang.com/ |  buyer  |  123456  |
| 商家PC端 | https://dsmall.csdeshang.com/home/sellerlogin/login.html |  seller  |  123456  |
| 用户手机端 | https://m.dsmall.csdeshang.com/ |  buyer  |  123456  |
| 商家手机端 | https://m.dsmall.csdeshang.com/home/sellerlogin |  seller  |  123456  |


## 技术评价
1. B/S架构
2. MVC编码架构，采用Thinkphp6.0框架
3. 支持Compser
4. 支持阿里云存储
5. 支持负载均衡
6. 支持Mysql读写分离
7. 支持Redis/Memcached
8. 支持Linux/Unix/Windows服务器，支持Apache/IIS/Nginx等


## 系统功能
1. 设置：站点设置、账号同步、上传设置、SEO设置、邮箱短信、支付方式(支付宝/微信/银联)、权限设置、快递公司、地区管理、数据备份、操作日志
2. 会员：会员管理、会员级别、经验值管理、会员通知、积分管理、预存款、聊天记录
3. 商品：商品分类、品牌管理、商品管理、类型管理、规格管理、空间管理
4. 店铺：店铺管理、店铺资金、店铺保证金、店铺等级、店铺分类、店铺动态、店铺帮助、自营店铺
5. 交易：实物订单、虚拟订单、退款管理、退货管理、订单结算、咨询管理、举报管理、评价管理、结算管理
6. 网站：文章分类、文章管理、会员协议、导航管理、广告管理、PC端装修、手机装修、友情链接、平台客服
7. 营销：分销管理、抢购管理、虚拟抢购管理、拼团管理、限时折扣、满即送、优惠套装、推荐展位、会员等级折扣、代金券管理、活动管理、兑换礼品、平台充值卡、吸粉红包、刮刮卡、幸运大抽奖、幸运砸金蛋、生肖翻翻看
8. 统计：行业分析、会员统计、店铺统计、销量统计、商品统计
9. 公众号：公众号配置、微信菜单、关键字回复、绑定列表、消息推送
10. 直播：直播设置、直播申请、直播聊天



## 相关依赖SDK安装
1. 多应用模式扩展  composer require topthink/think-multi-app
2. think-view      composer require topthink/think-view
3. think-captcha   composer require topthink/think-captcha
4. think-image     composer require topthink/think-image
5. thinkphp-jump   composer require liliuwei/thinkphp-jump
5. 阿里云OSS       composer require aliyuncs/oss-sdk-php   
  介绍地址：https://help.aliyun.com/document_detail/32099.html?spm=5176.87240.400427.47.eaLg1R
6. phpmailer       composer require phpmailer/phpmailer
7. 阿里云短信      composer require alibabacloud/client
8. 腾讯云短信      composer require qcloudsms/qcloudsms_php
9. 签名工具        composer require firebase/php-jwt
10. 腾讯云点播      composer require tencentcloud/tencentcloud-sdk-php
   安装tencentcloud  PHP 5.6.33 版本及以上。https://github.com/tencentcloud/tencentcloud-sdk-php
11. 进入GatewayWorker子目录安装 composer install
12. 安装GatewayClient  composer require workerman/gatewayclient



## 安装教程
1. 将源码解压到服务器空间
2. 域名应该指向到public目录，因为应用入口文件位于public/index.php。比如我的DSMALL项目在  D:\www\dsmall  域名应该指向到 D:\www\dsmall\public
3. 进行安装 http://域名/install/install.php
4. 后台地址：http://域名/index.php/admin
5. 前台地址：http://域名/index.php/home

如果还有什么不懂的到DSMALL论坛(http://www.csdeshang.com)进行提问，以及下载最新版本。


## APIDOC 生成API
apidoc -i application/api/controller -o public/apidoc/


## 更新日志
#### V6.0.8
免费版更新
1. 修复修改用户昵称页面顶部昵称显示不同步显示修改的问题
2. 修复后台同时上传后台LOGO和前端LOGO的时候，不生效的问题
3. 后台新增编辑  页面底部显示备案号，网安备信息
4. 修复商家后台 商品列表 快捷修改商品价格后 前端不同步显示的问题
5. 添加物流缺省值
6. 修复部分页面OSS图片显示的问题
7. 当前分销模式 从店铺后台可以独立设置分销比例 修改为 平台后台统一设置分销比例
8. 修复自提门店，删除门店按钮无效的问题
9. 修复会员头像无法上传的问题
10.修复生成个人推广海报的时候，获取不到会员头像的问题
11.修复商家端无法查看IM聊天内容的问题
12.修复商家端统计显示的问题
13.修复虚拟商品下单，选择代金券后商品总价显示不随代金券金额减少的问题

授权版更新
1. 虚拟下单页面新增显示预存款余额
2. 当前分销模式 从店铺后台可以独立设置分销比例 修改为 平台后台统一设置分销比例
3. 修复移动端自提门店，删除门店按钮无效的问题
4. 修复移动端会员头像无法上传的问题
5. 修复移动端生成个人推广海报的时候，获取不到会员头像的问题
6. 优化移动端点击返回按钮返回操作
7. 优化移动端子账号权限
8. 修复移动端分类图片不显示的问题

#### V6.0.7
免费版更新
1. 修复腾讯短信参数问题
2. 优化店铺后台，虚拟订单详情买家名称显示
3. 修复企业入驻上传图片报错的问题，且个人入驻付款页面新增显示付款金额明细和应付总金额
4. 聊天服务器改成workman
5. 修复设置了奖品但是中奖概率为0 造成其他中奖概率为100的无法中奖
6. 修改用户领取的红包放到充值卡余额
7. 删除线下门店模块，现虚拟兑换码前缀设置移动到店铺设置页面
8. 优化店铺统计页面
9. 修复微信快捷登录后，无法返回砍价页面的问题
10.修复后台更换会员默认头像不生效的问题
11.新增小程序组件直播错误提示
12.修复商品编辑页面选择了相册分类但是仍然上传到了默认相册的问题

授权版更新
1. 聊天服务器改成workman
2. 修复直播封面和直播背景图片 不能上传之后，点击 使用按钮无效的问题
3. 修复移动端没有设置物流公司时无法选择的问题
4. 修复选择货到付款时  还可以选择预存款的问题
5. 修复抢购活动页面，切换栏目后，再次点击切换没有数据的问题
6. 移动端首页导航新增抢购页面导航
7. 修复微信快捷登录后，无法返回砍价页面的问题
8. 优化门店中心，订单详情页面显示


#### V6.0.6
免费版更新
1. 新增小程序组件直播
2. 修复周边页面第二个店铺以后都无法显示商品的问题
3. 修复对比页面 对比商品的规格值不包含现有规格属性的时候会出错的问题
4. 修改打印发货单页面 印章图片的位置
5. 新增自提点功能
6. 修复后台咨询管理页面翻页按钮样式错乱的问题
7. 修复后台地区管理删除地区配送地区不同步的问题
8. 优化商品搜索
9. 订单列表的退货退款中加上链接
10.修复IM聊天时间显示的问题
11.修改全站图片可上传到OSS
12.修复抢购商品和普通商品一起结算时出错的问题
13.修复商家后台 账户组勾选权限不显示的问题
14.优化专题页面显示

授权版更新
1. 修复微博登录BUG
2. 优化手机端积分记录描述
3. 新增小程序组件直播
4. 手机端装修加上顶部搜索
5. 优化抢购列表页面
6. 新增自提点功能
7. 下单页面新增显示已优惠多少金额
8. 百度地图接口升级
9. 手机端新增显示会员等级折扣
10.修复手机端商品详情页面点击图片放大后返回上一页在点击其他商品进入商品详情页面会进入之前查看大图模式


#### V6.0.5
免费版更新
1. 新增批发功能
2. 修复后台关闭4个消息模板后，商家后台接受消息页面会报错的问题
3. 优化直播商品列表样式
4. 修复后台无法恢复备份的问题
5. 新增待付款订单可以预存款支付
6. 修复已退款成功的订单会出现在待评价页面

授权版更新
1. 修复已退款成功的订单会出现在待评价页面
2. 修复手机端文章列表页面无法翻页的问题
3. 优化商品详情页面没有视频就不显示视频按钮
4. 修复微信绑定已有用户出错的问题
5. 新增批发功能
6. 删除手机端店铺详情页面 无用的店铺背景图
7. 新增待付款订单可以预存款支付

#### V6.0.4 
免费版更新
1. 添加猜你喜欢功能
2. 优化分销会员功能
3. 修复后台管理员可以添加重复名称的问题
4. 添加商品主图视频功能
5. 修复后台店铺帮助 帮助内容列表不显示内容帮助类型的问题
6. 修复取消规格选中，隐藏不了规格名称的问题
7. 修复搜索页面默认排序不生效的问题
8. 修复后台限时折扣列表批量删除按钮无效的问题
9. 修复限时折扣活动结束，商品不解除锁定的问题
10. 优化评论显示
11. 后台自营店铺添加可以选择店铺分类
12. 优化注册会员页面
13. 新增阿里云直播
14. 修复直播审核页面没有设置直播商品会报错的问题

授权版更新
1. 修复手机端添加商品ID错误和图片说明尺寸不对的问题
2. 手机端规格市场价和重量取消必填项
3. 手机端商家入驻添加店铺分类必填项提示语
4. 添加商品主图视频
5. 添加猜你喜欢功能
6. 优化微信分享功能
7. 修复苹果手机无法使用微信登录的问题
8. 手机端添加商品锁定按钮
9. 修复未登录时购物车页面会卡住的问题
10. 新增阿里云直播
11. 优化手机端规格值设置

#### V6.0.3
免费版更新
1. PC端主播不在线也可以显示直播详情页
2. 优化推荐组合设置
3. 修复后台数据无法备份的问题
4. 新增如果商品正在直播则显示直播小图标
5. 修复首页楼层底部广告没有数据时，会显示侧边栏广告的问题
6. 修改现在不上传商品图片也可以添加商品
7. 优化拼团功能
8. 新增如果店铺有直播 则在店铺首页显示
9. 优化手机号登录
10. 优化页面可编辑功能
11. 店铺入驻新增可选入驻类型，（仅个人，仅企业，全部可选，全部关闭）
12. 修复添加后台管理员密码可以为空

授权版更新
1. 优化手机端快捷登录
2. 手机端登录去掉图片验证码
3. 优化页面
4. 优化入驻时的店铺定位
5. 新增手机端专题活动模块
6. 优化商品列表排序
7. 店铺入驻新增可选入驻类型，（仅个人，仅企业，全部可选，全部关闭）
8. 修复可编辑功能轮播图只显示最后一张图的问题

#### V6.0.2
免费版更新
1. 修复个人入驻报错的问题
2. 新增批量打印发货单和批量发货的功能
3. 修复微博登录和注册短信验证码不生效的问题
4. 修复后台一次不能添加多个会员等级的问题
5. 优化数据表索引
6. 优化举报类型
7. 新增后台LOGO可设置
8. 新增直播带货功能
9. 修复店铺登录 前端不显示昵称的问题
10. 修复API接口赠品数据

授权版更新
1. 会员中心显示昵称
2. 优化页面显示，用户中心，及下单页面的界面部分美化
3. 新增直播带货
4. 修改当满送的商品被删除或者下架之后，不显示满赠商品
5. 订单详情 新增店铺链接
6. 新增订单列表和订单详情显示赠品

#### V6.0.1
免费版更新
1. 修复验证码错误
2. 入驻营业执照日期添加长期，添加说明文字，结束日期不填则表示营业时间为长期
3. 优化后台商品列表显示
4. 语言项优化
5. 修复代金券套餐价格为0时，店铺添加完代金券后，在编辑代金券会提示没有购买套餐的问题
6. 修复拼团，砍价活动，商品被下架了，手机端还显示这个活动的问题
7. 修改用户未登录列表中暂时不显示加入购物车按钮

授权版更新
1. 修复APP支付返回不到商城的问题
2. 优化手机端发票商品，商品规格的选中
3. 修复手机端发布商品的时候商品描述不能添加图片的问题
4. 新增手机端头部title可在后台设置
5. 优化评论显示
6. 修复店铺首页不显示订单数量的问题
7. 店铺首页新增显示店铺地图的入口
8. 下单页面新增店铺链接
9. 下单页面新增显示预存款数额
10. 会员中心订单列表页面新增显示订单商品信息

#### V6.0.1
Thinkphp由TP5.0.24升级为TP6.0


#### V5.1.0
免费版更新
1. 修复微信扫码注册的账号WXINFO里面无法更新openid的问题
2. 修复获取提现账号名变量错误
3. 修复redis的问题
4. 修复银联支付的问题
5. 新增腾讯云短信
6. 修复经营类目只有二级时，下单会获取不到分类佣金的问题
7. 新增可视化编辑功能
8. 取消后台手机端默认广告的删除按钮
9. 平台后台文章、商品、店铺列表新增显示ID数据 以便广告设置添加对应ID
10. 新增商品重量 运费可选择按重量计费
11. 新增店铺商品排序
12. 修改平台后台支付配置说明文字

授权版更新
1. 修复注册会员验证码跨域报错
2. 修复微信码扫描
3. 删除绑定会员的邮箱验证
4. 手机端新增活动列表页面
5. 登录页面新增验证码验证
6. 提现列表去除微信提现账号
7. 修复支付跨域
8. 修复双域名无法跨域的问题
9. 新增可视化编辑功能
10. 购物车优化
11. 修正手机端商品有促销价格的时候切换规格会显示回正常价格而不是显示促销价的问题
12. 手机端新增店铺地图导航
13. 商品详情页面商品有多规格的时候优先弹出规格选择窗口
14. 修复浏览记录页面无法跳转商品的问题
15. 修复申诉内容不显示的问题
16. 修改添加商品规格的库存默认值

#### V5.0.8
免费版更新
1. 更新会员认证图片时限制字段
2. 下单时验证代金券金额
3. 新增店铺登录验证码
4. 新增后台 添加和编辑礼品页面  删除编辑器图片的成功提示
5. 修正后台退款详情页面 提交按钮显示
6. 修改前端 店铺首页和商品详情页面左侧店铺地图 使用经纬度定位，使定位更准确。
7. 修复店铺新增优惠套装，移除商品不会移除价格，导致新增优惠套装里面 没有商品也会添加成功，然后列表页面报错的问题。
8. 修改后台地区只能设置三级
9. 修复店铺 个人入驻的问题
10. 后台统计页面优化
11. 后台礼品兑换详情，详细地址显示三级地区
12. 修复积分兑换页面 兑换商品名称长度过长显示的问题
13. 修复店铺后台 订单结算页面导出EXCEL 按钮失效的问题
14. 修复会员折扣的问题
15. 当微信未结算资金不足时更换资金来源重试
16. 修复阿里云短信因为参数长度问题造成发送不成功
17. 修复发出红包数量会比实际总数量多一个
18. 修复统计，会员统计，会员规模分析，点击分页与分页箭头报错提示
19. 修复平台添加礼品时，不能有效的选择小时的时间
20. 修复虚拟商品下单会发送两次信息的问题。
21. 修复淘宝助手导入替换详情图片时，有些情况会出现运行超时的问题
22. 修复平台商品分类绑定类型，平台在商品类型设置的时候，并没有勾选品牌；商家在发布的商品的时候，却是可以调取所有品牌信息进行选择
23. 修复店铺后台 发货管理页面无法显示赠品商品图片的问题
24. 商品库存更新不放到缓存里，直接更新，用锁控制
25. 修复平台砍价活动，点击取消修改状态失败
26. 修复裁剪头像没验证图片地址的漏洞 

授权版更新
1. 修复手机端浏览商品没有浏览记录的问题
2. 新增分享海报
3. 修复签到开关按钮无效，关闭之后一样可以进行签到
4. 手机端未检查seller_name未填写的情况，导致审核失败
5. 修复规格显示问题  手机端自动跳转
6. 修复手机端商品下架 购物车依然可以选中下单的问题
7. 优化有些时候点击菜单后进入空白的问题
8. 修复当pc域名是一级域名造成的微信登录问题
9. 扩大重新定位的按钮
10. 修复手机端抢购页面的上下拉问题
11. 修复app支付完返回不了app的bug
12. 新增商品数量手动输入
13. 修复手机端拼团列表时间显示问题

#### V5.0.7
免费版更新
1. 修复第三方登录
2. 修复分销开关不生效
3. 修复微博API接口调用不了类的问题
4. 修改H5路径引用
5. 修复商家限时折扣 商品列表页面  商品名称带有单引号会报错 不显示商品列表
6. 支付宝SDK升级
7. 新增提现到支付宝、微信
8. 修复商家添加砍价活动时 变量名错误
9. 新增商品详情页面 限时折扣活动没有设置标题的默认标题
10. 修改商品规格促销  现一个商品多个规格 每个规格可参与各自的促销
11. 修复微博绑定nickname报错
12. 修改手机号注册的会员，在商品评分里面隐藏手机号会员名的中间4位号码
13. 新增提现额度范围设置
14. 删除重复的语言项
15. 修复商家导出订单出错
16. 新增意见反馈功能
17. 后台微信消息模板从微信模块移动到邮箱短信消息模块
18. 修复商家修改订单金额，获取的佣金是按原实际金额算
19. 修复退货详情页面上传凭证图片不显示的问题
20. 优化网站后台店铺动态评价-评价分数显示
21. 更新支付宝APP支付
22. 修复发送邮件时，html显示问题

授权版更新
1. 新增支付中间页面
2. 修复手机端商家入驻的时候 新增无用的经营类目的时候，后台审核页面会报错的BUG。
3. 优化手机端分销管理
4. 优化手机端组合营销功能（优惠套餐）显示
5. 新增兑换代金券页面，新增兑换所需积分值和一个兑换按钮。
6. 修复手机端定位不准的问题
7. 新增手机端店铺显示距离
8. 支付宝优化+提现到支付宝、微信
9. 手机端商品详情页面新增显示满送活动里的赠送商品
10. 新增会员资金相关页面和退款页面的整合页面。
11. 新增拼团列表、成团列表倒计时
12. 新增手机端用户反馈
13. 修复手机端验证码出错的问题
14. 修复订单预存款支付，支付密码填写错误提交后 就不会在弹出输入密码框
15. 新增商家自己拍的照片都大于2M，自己上传不了，如果上传图片大于2M，则后台可以选择裁切及压缩。
16. 新增手机端显示商品分销佣金
17. 修改商品详情页面库存显示。


#### V5.0.6
免费版更新 
1. 新增阿里云短信
2. 新增后台设置手机端访问PC端自动跳转
3. 新增售卖区域制定的区域不邮寄
4. 新增会员折扣设置小数
5. 修复百度地图BUG
6. 修复HTTPS网站使用微信登录无法生成二维码
7. 修复顺丰快递物流BUG
8. 修复后台管理权限BUG
9. 修复后台添加店铺增加经营类目
10.修复邮箱验证删除多余HOME_SITE_URL和转义
11.修改积分说明计算方式
12.修改添加分销商品语言项
13.去除自营店铺显示店铺等级
14. 去除商品编辑市场价必选项
15. 去除商城运单功能

授权版更新
1. 新增商家手机端上传商品
2. 新增会员支付密码
3. 新增售卖区域，就是制定的区域不邮寄
4. 新增商品详情骨架屏
5. 新增手机端店铺入驻
6. 修复手机端货到付款BUG
7. 修复没有规格值的的规格不显示
8. 修复推广链接注册不显示推荐员BUG
9. 修复IOS手机 商品详情页面和商品分类页面滑动卡顿的问题
10.去除注册邮箱必填


#### V5.0.5
免费版更新 
1. 修复非自营店铺的店铺动态页面报错的问题
2. 新增后台规格名称和规格分类搜索规格的功能
3. 新增规格库存编辑
4. 修复用户在未登录的情况下点击聊天没有反应的问题
5. 时间插件新增中文
6. 修复快递鸟key参数错误的问题
7. 修复系统发生的短信未记录到短信日志中，且未做限制
8. 修复支付宝、微信退款原账号 部分退款、不同店铺退款BUG
9. 新增虚拟代金券
10.修复只有一级分类时发布商品提示未绑定分类的bug
11.语言项重复替换
12.修复户收货地址的city_id和area_id错了
13.因为网站LOGO图过大会影响页面显示，所以限制网站LOGO图最大值为220X46

授权版更新
1. 修复手机端个人信息页面选择日期选项 选择完月份会比选择时少一个月和IOS系统不能选择日期的问题
2. 新增虚拟拼团功能
3. 修复手机端会员中心订单数量气泡不显示的问题
4. 修复手机端支付页面偶尔不出现支付列表的BUG

#### V5.0.4
免费版更新 
1. 修复手机端充值卡充值失败问题
2. 修复后台搜索举报类型
3. 商品列表，限时折扣以及抢购 图标优化
4. 新增用户首次访问显示悬浮窗
5. 去除重复语言项
6. 修复商品分类图片上传的限制
7. 修复运单模板
8. 更换快递查询接口
9. 新增结算订单显示结单日期
10.新增支付宝/微信订单款项原路退回。


授权版更新
1. 当未添加手机端商品详情时，自动显示PC端商品详细
2. 附近店铺显示已开启的店铺
3. 新增店铺详情信息



#### V5.0.3
免费版更新 
1. 优化分享图片功能
2. 单店铺新增门店模块，含子门店信息以及门店管理员
3. 优化淘宝CSV文件的商品的导入导出
4. 修复免运费功能缺陷
5. 支付方式优化，让显示更友好
6. 新增实名认证功能，后台开启用户需实名认证才能购买商品。
7. 未登录时加入失败的提示
8. 修复聊天中包含商品时的样式
9. 一系列细节优化，提高用户体验


授权版更新
1. 修复手机端不显示系统消息
2. 优化手机端筛选功能
3. 修复手机端禁止登录账户可正常登录
4. 修复当未添加手机端商品详情时，自动显示PC端商品详细



#### V5.0.1
免费版更新 
1. 新增可视化模板编辑
2. 新增淘宝导入导出，商品数据包下载和商品图片下载
3. 优化倒计时插件
4. 新增PC端砍价列表
5. 新增广告图加上链接类型
6. 优化推广二维码界面
7. 修复店铺中心店铺名过长的问题

授权版更新
1. 界面美化


#### V3.2.6
免费版更新 
1. 修复管理员权限菜单bug、美化列表页
2. 美化用户中心侧边栏界面
3. 新增整站推荐功能
4. 新增套餐设置为0元时，店铺可免费使用。
5. 修复html过滤后商品名称过长的提示
6. 新增后台编辑店铺排序
7. 修复店铺已关闭，店铺管理中心未有提示
8. 优化导航管理
9. 修复取消订单时间限制

授权版更新
1. 新增红包、大转盘、刮刮卡、砸金蛋、生肖翻翻看等平台活动
2. 新增砍价活动


#### V3.2.3
免费版更新 
1. 修复取消微信支付报错
2. 新增初始安装环境监测openssl扩展 以及 BCMath扩展
3. 新增部分API缓存
4. 修复店铺导航显示问题
5. 修复货号退款没有增加库存

授权版更新
1. 微信分享
2. 新增部分API缓存
3. 修复支付密码错误没提示
4. 手机端详情用原图（因为压缩图显示不完整）


#### V3.2.2
免费版更新 
1. 修复163邮箱乱码问题
2. 修复非自营店铺货到付款地区设置显示错误
3. 修复用户中心通过缓存删除单条浏览记录
4. 修复店铺导航显示问题
5. PC端买家中心/PC端卖家中心界面美化
6. 依据电商法行业规范新增单独的营业执照页
7. 修复微信支付必须开启微信扫码支付
8. 修复图片水印无法正常显示

授权版更新
1. 手机端新增充值卡记录功能
2. 新增签到赠送积分

#### V3.2.1
授权版更新（ThinkPHP+VUEJS）
1.新增H5端卖家管理
2.优化用户绑定手机流程
3.卖家账户/买家账户同步登录
4.新增手机端查找好友，及时聊天
5.新增举报商品
6.新增商品咨询

免费版更新 
1.优化用户绑定手机流程
2.卖家账户/买家账户同步登录
3.商品界面优化
4.新增发票管理
5.部分界面美化

#### V3.1.1
1. 新增管理快递公司
2. 优化重复语言包定义
3. 新增通联支付
4. 新增数据导入导出功能
5. 优化开店流程

#### V3.0.3
1. 新增分销市场功能
2. 微信扫码登录BUG修复
3. 优化闲置语言包以及收藏BUG
4. 店铺结算放入日执行任务中
5. 分销员调整上级的BUG

#### V3.0.1
1. 优化手机端分类页的体验
2. 后台登陆退出优化
3. 后台界面美化
4. 商家结算优化，管理后台可设置商家结算周期，以及商家可自行申请提现。

#### V2.5.7
1. 修复微信自动登录没有unionid时需要中断
2. 修复苹果手机小程序支付的小BUG
3. 修复语言包BUG
4. 修复SNS显示错位
5. 去除初始化数据的多余图片
6. 后台界面优化








