<?php

namespace app\home\controller;

use think\facade\View;
use think\facade\Lang;
use think\facade\Db;

/**
 * ============================================================================
 * DSMall多用户商城
 * ============================================================================
 * 版权所有 2014-2028 长沙德尚网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.csdeshang.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * 控制器
 */
class Sellerpromotionwholesale extends BaseSeller {

    public function initialize() {
        parent::initialize(); // TODO: Change the autogenerated stub
        Lang::load(base_path() . 'home/lang/' . config('lang.default_lang') . '/sellerpromotionwholesale.lang.php');
        if (intval(config('ds_config.promotion_allow')) !== 1) {
            $this->error(lang('promotion_unavailable'), 'seller/index');
        }
    }

    public function index() {
        $wholesalequota_model = model('wholesalequota');
        $wholesale_model = model('wholesale');

        if (check_platform_store()) {
            View::assign('isPlatformStore', true);
        } else {
            $current_wholesale_quota = $wholesalequota_model->getWholesalequotaCurrent(session('store_id'));
            View::assign('current_wholesale_quota', $current_wholesale_quota);
        }

        $condition = array();
        $condition[] = array('store_id', '=', session('store_id'));
        if ((input('param.wholesale_name'))) {
            $condition[] = array('goods_name', 'like', '%' . input('param.wholesale_name') . '%');
        }
        if ((input('param.state'))) {
            $condition[] = array('wholesale_state', '=', intval(input('param.state')));
        }
        $wholesale_list = $wholesale_model->getWholesaleList($condition, 10, 'wholesale_state desc, wholesale_end_time desc');
        View::assign('wholesale_list', $wholesale_list);
        View::assign('show_page', $wholesale_model->page_info->render());
        View::assign('wholesale_state_array', $wholesale_model->getWholesaleStateArray());

        $this->setSellerCurMenu('Sellerpromotionwholesale');
        $this->setSellerCurItem('wholesale_list');
        return View::fetch($this->template_dir . 'index');
    }

    /**
     * 添加批发活动
     * */
    public function wholesale_add() {
        if (check_platform_store()) {
            View::assign('isPlatformStore', true);
        } else {
            View::assign('isPlatformStore', false);
            $wholesalequota_model = model('wholesalequota');
            $current_wholesale_quota = $wholesalequota_model->getWholesalequotaCurrent(session('store_id'));
            if (empty($current_wholesale_quota)) {
                if (intval(config('ds_config.promotion_wholesale_price')) != 0) {
                    $this->error(lang('wholesale_quota_current_error1'));
                } else {
                    $current_wholesale_quota = array('wholesalequota_starttime' => TIMESTAMP, 'wholesalequota_endtime' => TIMESTAMP + 86400 * 30); //没有套餐时，最多一个月
                }
            }
            View::assign('current_wholesale_quota', $current_wholesale_quota);
        }

        //输出导航
        $this->setSellerCurMenu('Sellerpromotionwholesale');
        $this->setSellerCurItem('wholesale_add');
        return View::fetch($this->template_dir . 'wholesale_add');
    }

    /**
     * 保存添加的批发活动
     * */
    public function wholesale_save() {
        //验证输入
        $wholesale_if_mix = intval(input('param.wholesale_if_mix'));
        $goods_commonid = intval(input('param.goods_commonid'));
        $start_time = strtotime(input('post.start_time'));
        $end_time = strtotime(input('post.end_time'));

        $wholesale_json = explode(',', input('param.wholesale_json'));

        if (!$goods_commonid || empty($wholesale_json)) {
            ds_json_encode(10001, lang('param_error'));
        }
        if ($start_time >= $end_time) {
            ds_json_encode(10001, lang('greater_than_start_time'));
        }

        if (!check_platform_store()) {
            //获取当前套餐
            $wholesalequota_model = model('wholesalequota');
            $current_wholesale_quota = $wholesalequota_model->getWholesalequotaCurrent(session('store_id'));
            if (empty($current_wholesale_quota)) {
                if (intval(config('ds_config.promotion_wholesale_price')) != 0) {
                    ds_json_encode(10001, lang('please_buy_package_first'));
                } else {
                    $current_wholesale_quota = array('wholesalequota_starttime' => TIMESTAMP, 'wholesalequota_endtime' => TIMESTAMP + 86400 * 30); //没有套餐时，最多一个月
                }
            }
            $quota_start_time = intval($current_wholesale_quota['wholesalequota_starttime']);
            $quota_end_time = intval($current_wholesale_quota['wholesalequota_endtime']);
            if ($start_time < $quota_start_time) {
                ds_json_encode(10001, sprintf(lang('wholesale_add_start_time_explain'), date('Y-m-d', $current_wholesale_quota['wholesalequota_starttime'])));
            }
            if ($end_time > $quota_end_time) {
                ds_json_encode(10001, sprintf(lang('wholesale_add_end_time_explain'), date('Y-m-d', $current_wholesale_quota['wholesalequota_endtime'])));
            }
        }

        $goods_model = model('goods');
        $wholesale_model = model('wholesale');
        $wholesalegoods_model = model('wholesalegoods');
        Db::startTrans();
        try {
            $goodscommon_info = $goods_model->getGoodsCommonInfoByID($goods_commonid);
            if (!$goodscommon_info || $goodscommon_info['store_id'] != session('store_id') || $goodscommon_info['goods_verify'] != 1 || $goodscommon_info['goods_state'] != 1 || $goodscommon_info['goods_lock']) {
                throw new \think\Exception(lang('goods_not_exist'), 10006);
            }
            $param = array();
            $param['wholesalequota_id'] = isset($current_wholesale_quota['wholesalequota_id']) ? $current_wholesale_quota['wholesalequota_id'] : 0;
            $param['wholesale_starttime'] = $start_time;
            $param['wholesale_end_time'] = $end_time;
            $param['goods_commonid'] = $goods_commonid;
            $param['goods_name'] = $goodscommon_info['goods_name'];
            $param['wholesale_if_mix'] = $wholesale_if_mix;
            $param['store_id'] = session('store_id');
            $param['store_name'] = session('store_name');
            $param['member_id'] = session('member_id');
            $param['member_name'] = session('member_name');
            $wholesale_id = $wholesale_model->addWholesale($param);
            foreach ($wholesale_json as $val) {
                $wholesalegoods_data = $this->getWholesaleGoods($val);
                $wholesalegoods_data['wholesale_id'] = $wholesale_id;
                $wholesalegoods_data['wholesale_starttime'] = $start_time;
                $wholesalegoods_data['wholesale_end_time'] = $end_time;
                $wholesalegoods_model->addWholesalegoods($wholesalegoods_data);
            }
        } catch (\Exception $e) {
            Db::rollback();
            ds_json_encode(10001, $e->getMessage());
        }
        Db::commit();
        // 添加计划任务
        $this->addcron(array('exetime' => $end_time, 'exeid' => $wholesale_id, 'type' => 8), true);
        $this->recordSellerlog(lang('add_limited_time_discount_activity') . $goodscommon_info['goods_name'] . lang('activity_number') . $wholesale_id);
        ds_json_encode(10000, lang('ds_common_op_succ'));
    }

    /**
     * 获取批发商品
     *
     * @param array $val
     * @param type $goods_commonid
     * @return array
     *
     */
    private function getWholesaleGoods($val) {
        $temp = explode('|', $val);
        $goods_id = $temp[0];
        $temp = explode('_', $temp[1]);
        $goods_model = model('goods');
        $goods_info = $goods_model->getGoodsInfoByID($goods_id);
        if ($goods_info && $goods_info['goods_verify'] == 1 && $goods_info['goods_state'] == 1) {
            if (empty($temp)) {
                throw new \think\Exception($goods_info['goods_name'] . lang('wholesale_price_empty'), 10006);
            }
            $wholesalegoods_price = array();
            foreach ($temp as $v) {
                $m_temp = explode('-', $v);
                $num = intval($m_temp[0]);
                $price = floatval($m_temp[1]);
                if ($num <= 0 || $price <= 0) {
                    throw new \think\Exception(lang('wholesale_set_error'), 10006);
                }
                $wholesalegoods_price[] = array(
                    'num' => $num,
                    'price' => $price,
                );
            }
            $wholesalegoods_price = $this->arraySort($wholesalegoods_price, 'num', 'asc');
            $wholesalegoods_price = array_values($wholesalegoods_price);
            for ($i = 0; $i < count($wholesalegoods_price); $i++) {
                if ($i < (count($wholesalegoods_price) - 1)) {
                    $wholesalegoods_price[$i]['num_text'] = $wholesalegoods_price[$i]['num'] . '-' . $wholesalegoods_price[$i + 1]['num'];
                } else {
                    $wholesalegoods_price[$i]['num_text'] = '≥' . $wholesalegoods_price[$i]['num'];
                }
                if ($i > 0) {
                    if ($wholesalegoods_price[$i]['price'] >= $wholesalegoods_price[$i - 1]['price']) {
                        throw new \think\Exception(lang('wholesale_set_error'), 10006);
                    }
                    if ($wholesalegoods_price[$i]['num'] == $wholesalegoods_price[$i - 1]['num']) {
                        throw new \think\Exception(lang('wholesale_set_error'), 10006);
                    }
                }
            }
            if ($wholesalegoods_price[0]['price'] > $goods_info['goods_price']) {
                throw new \think\Exception($goods_info['goods_name'] . lang('wholesale_price_error'), 10006);
            }
            $wholesalegoods_data = array(
                'goods_id' => $goods_info['goods_id'],
                'goods_commonid' => $goods_info['goods_commonid'],
                'store_id' => $goods_info['store_id'],
                'goods_name' => $goods_info['goods_name'],
                'goods_price' => $goods_info['goods_price'],
                'goods_image' => $goods_info['goods_image'],
                'wholesalegoods_price' => serialize($wholesalegoods_price),
            );
            return $wholesalegoods_data;
        } else {
            throw new \think\Exception(lang('goods_not_exist'), 10006);
        }
    }

    /**
     * 多维数组排序（多用于文件数组数据）
     *
     * @param array $array
     * @param array $cols
     * @return array
     *
     */
    private function arraySort($array, $keys, $sort = 'asc') {
        $newArr = $valArr = array();
        foreach ($array as $key => $value) {
            $valArr[$key] = $value[$keys];
        }
        ($sort == 'asc') ? asort($valArr) : arsort($valArr);
        reset($valArr);
        foreach ($valArr as $key => $value) {
            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }

    /**
     * 编辑批发活动
     * */
    public function wholesale_edit() {
        if (check_platform_store()) {
            View::assign('isPlatformStore', true);
        } else {
            View::assign('isPlatformStore', false);
        }
        $wholesale_model = model('wholesale');

        $wholesale_info = $wholesale_model->getWholesaleInfoByID(input('param.wholesale_id'));
        if (empty($wholesale_info) || !$wholesale_info['editable']) {
            $this->error(lang('param_error'));
        }

        View::assign('wholesale_info', $wholesale_info);

        //获取批发商品列表
        $goods_model = model('goods');
        $condition = array();
        $condition[] = array('goods_commonid', '=', $wholesale_info['goods_commonid']);
        $goods_list = $goods_model->getGoodsOnlineList($condition);

        $wholesalegoods_model = model('wholesalegoods');

        $wholesalegoods_list = array();
        foreach ($goods_list as $key => $val) {
            $val['goods_image'] = goods_thumb($val, 240);
            $condition = array();
            $condition[] = array('wholesale_id', '=', $wholesale_info['wholesale_id']);
            $condition[] = array('goods_id', '=', $val['goods_id']);
            $wholesalegoods_info = $wholesalegoods_model->getWholesalegoodsInfo($condition);
            if (!$wholesalegoods_info) {
                $val['inactive'] = 1;
            } else {
                $val['wholesale_info'] = unserialize($wholesalegoods_info['wholesalegoods_price']);
                $val['goods_lock'] = 0;
            }

            $wholesalegoods_list[] = $val;
        }
        View::assign('wholesalegoods_list', json_encode($wholesalegoods_list));
        //输出导航
        $this->setSellerCurMenu('Sellerpromotionwholesale');
        $this->setSellerCurItem('wholesale_edit');
        return View::fetch($this->template_dir . 'wholesale_add');
    }

    /**
     * 编辑保存批发活动
     * */
    public function wholesale_edit_save() {
        $wholesale_id = input('param.wholesale_id');
        $wholesale_model = model('wholesale');
        $wholesalegoods_model = model('wholesalegoods');

        $wholesale_if_mix = intval(input('param.wholesale_if_mix'));
        $wholesale_json = explode(',', input('param.wholesale_json'));

        if (!$wholesale_id || empty($wholesale_json)) {
            ds_json_encode(10001, lang('param_error'));
        }

        $wholesale_info = $wholesale_model->getWholesaleInfoByID($wholesale_id);
        if (empty($wholesale_info) || !$wholesale_info['editable']) {
            $this->error(lang('param_error'));
        }

        Db::startTrans();
        try {
            //生成活动
            $param = array();
            $param['wholesale_if_mix'] = $wholesale_if_mix;
            $wholesale_model->editWholesale($param, array(array('wholesale_id', '=', $wholesale_id)));

            $goods_ids = array();

            foreach ($wholesale_json as $val) {
                $wholesalegoods_data = $this->getWholesaleGoods($val);
                $goods_ids[] = $wholesalegoods_data['goods_id'];

                $wholesalegoods_info = $wholesalegoods_model->getWholesalegoodsInfo(array(array('wholesale_id', '=', $wholesale_id), array('goods_id', '=', $wholesalegoods_data['goods_id'])));
                if ($wholesalegoods_info) {
                    $wholesalegoods_model->editWholesalegoods($wholesalegoods_data, array(array('wholesalegoods_id', '=', $wholesalegoods_info['wholesalegoods_id'])));
                } else {
                    $wholesalegoods_data['wholesale_id'] = $wholesale_id;
                    $wholesalegoods_data['wholesale_starttime'] = $wholesale_info['wholesale_starttime'];
                    $wholesalegoods_data['wholesale_end_time'] = $wholesale_info['wholesale_end_time'];
                    $wholesalegoods_model->addWholesalegoods($wholesalegoods_data);
                }
            }
            $wholesalegoods_ids = Db::name('wholesalegoods')->where(array(array('wholesale_id', '=', $wholesale_id), array('goods_id', 'not in', $goods_ids)))->column('wholesalegoods_id');
            if (!empty($wholesalegoods_ids)) {
                $wholesalegoods_model->delWholesalegoods(array(array('wholesalegoods_id', 'in', $wholesalegoods_ids)));
            }
        } catch (\Exception $e) {
            Db::rollback();
            ds_json_encode(10001, $e->getMessage());
        }
        Db::commit();

        $this->recordSellerlog(lang('edit_limited_time_discount_activity') . $wholesale_info['goods_name'] . lang('activity_number') . $wholesale_id);
        ds_json_encode(10000, lang('ds_common_op_succ'));
    }

    /**
     * 批发活动删除
     * */
    public function wholesale_del() {
        $wholesale_id = intval(input('param.wholesale_id'));

        $wholesale_model = model('wholesale');

        $data = array();
        $data['result'] = true;

        $wholesale_info = $wholesale_model->getWholesaleInfoByID($wholesale_id, session('store_id'));
        if (!$wholesale_info) {
            ds_json_encode(10001, lang('param_error'));
        }

        $result = $wholesale_model->delWholesale(array('wholesale_id' => $wholesale_id));

        if ($result) {
            $this->recordSellerlog(lang('delete_limited_time_discount_activity') . $wholesale_info['goods_name'] . lang('activity_number') . $wholesale_id);
            ds_json_encode(10000, lang('ds_common_op_succ'));
        } else {
            ds_json_encode(10001, lang('ds_common_op_fail'));
        }
    }

    /**
     * 批发套餐购买
     * */
    public function wholesale_quota_add() {
        //输出导航
        $this->setSellerCurMenu('Sellerpromotionwholesale');
        $this->setSellerCurItem('wholesale_quota_add');
        return View::fetch($this->template_dir . 'wholesale_quota_add');
    }

    /**
     * 批发套餐购买保存
     * */
    public function wholesale_quota_add_save() {
        if (intval(config('ds_config.promotion_wholesale_price')) == 0) {
            ds_json_encode(10001, lang('param_error'));
        }
        $wholesale_quota_quantity = intval(input('post.wholesale_quota_quantity'));

        if ($wholesale_quota_quantity <= 0 || $wholesale_quota_quantity > 12) {
            ds_json_encode(10001, lang('wholesale_quota_quantity_error'));
        }

        //获取当前价格
        $current_price = intval(config('ds_config.promotion_wholesale_price'));

        //获取该用户已有套餐
        $wholesalequota_model = model('wholesalequota');
        $current_wholesale_quota = $wholesalequota_model->getWholesalequotaCurrent(session('store_id'));
        $wholesale_add_time = 86400 * 30 * $wholesale_quota_quantity;
        if (empty($current_wholesale_quota)) {
            //生成套餐
            $param = array();
            $param['member_id'] = session('member_id');
            $param['member_name'] = session('member_name');
            $param['store_id'] = session('store_id');
            $param['store_name'] = session('store_name');
            $param['wholesalequota_starttime'] = TIMESTAMP;
            $param['wholesalequota_endtime'] = TIMESTAMP + $wholesale_add_time;
            $wholesalequota_model->addWholesalequota($param);
        } else {
            $param = array();
            $param['wholesalequota_endtime'] = Db::raw('wholesalequota_endtime+' . $wholesale_add_time);
            $wholesalequota_model->editWholesalequota($param, array('wholesalequota_id' => $current_wholesale_quota['wholesalequota_id']));
        }

        //记录店铺费用
        $this->recordStorecost($current_price * $wholesale_quota_quantity, lang('buy_limited_time_discount'));

        $this->recordSellerlog(lang('buy') . $wholesale_quota_quantity . lang('limited_time_discount_package') . $current_price . lang('ds_yuan'));

        ds_json_encode(10000, lang('wholesale_quota_add_success'));
    }

    /**
     * 选择活动商品
     * */
    public function goods_select() {
        $goods_model = model('goods');
        $condition = array();
        $condition[] = array('goods.store_id', '=', session('store_id'));
        $condition[] = array('goods.goods_name', 'like', '%' . input('param.goods_name') . '%');
        $goods_list = $goods_model->getGoodsListForPromotion($condition, 'goods.goods_id,goods.goods_commonid,goods.goods_name,goods.goods_image,goods.goods_price', 10, 'wholesale');

        View::assign('goods_list', $goods_list);
        View::assign('show_page', $goods_model->page_info->render());
        echo View::fetch($this->template_dir . 'goods_select');
    }

    public function goods_info() {
        $goods_commonid = intval(input('param.goods_commonid'));

        $data = array();
        $data['result'] = true;

        $goods_model = model('goods');

        $condition = array();
        $condition[] = array('goods_commonid', '=', $goods_commonid);
        $goods_list = $goods_model->getGoodsOnlineList($condition);

        if (empty($goods_list)) {
            $data['result'] = false;
            $data['message'] = lang('param_error');
            echo json_encode($data);
            die;
        }

        foreach ($goods_list as $key => $val) {
            $goods_list[$key]['goods_image'] = goods_thumb($val, 240);
        }
        $data['goods_list'] = $goods_list;
        echo json_encode($data);
        die;
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $name 当前导航的name
     * @param array $array 附加菜单
     * @return
     */
    protected function getSellerItemList() {
        $menu_array = array(
            array(
                'name' => 'wholesale_list', 'text' => lang('promotion_active_list'),
                'url' => (string) url('Sellerpromotionwholesale/index')
            ),
        );
        switch (request()->action()) {
            case 'wholesale_add':
                $menu_array[] = array(
                    'name' => 'wholesale_add', 'text' => lang('promotion_join_active'),
                    'url' => (string) url('Sellerpromotionwholesale/wholesale_add')
                );
                break;
            case 'wholesale_edit':
                $menu_array[] = array(
                    'name' => 'wholesale_edit', 'text' => lang('editing_activity'), 'url' => 'javascript:;'
                );
                break;
            case 'wholesale_quota_add':
                $menu_array[] = array(
                    'name' => 'wholesale_quota_add', 'text' => lang('promotion_buy_product'),
                    'url' => (string) url('Sellerpromotionwholesale/wholesale_quota_add')
                );
                break;
            case 'wholesale_manage':
                $menu_array[] = array(
                    'name' => 'wholesale_manage', 'text' => lang('promotion_goods_manage'),
                    'url' => (string) url('Sellerpromotionwholesale/wholesale_manage', ['wholesale_id' => input('param.wholesale_id')])
                );
                break;
        }
        return $menu_array;
    }

}
