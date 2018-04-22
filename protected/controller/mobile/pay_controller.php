<?php
class pay_controller extends general_controller
{
    public function action_index()
    {
        $user_id = $this->is_logined();
        $order_model = new order_model();
        if($order = $order_model->find(array('order_id' => request('order_id'), 'user_id' => $user_id)))
        {
            $user_model = new user_model();
            $user_info  = $user_model->find(array('user_id'=>$user_id));
            $order['open_id'] = $user_info['open_id'];

            $order_goods_model = new order_goods_model();
            $goods_info  = $order_goods_model->find(array('order_id'=>$order['order_id']));
            $order['goods_name'] = $goods_info['goods_name'];

            $this->payment_list = vcache::instance()->payment_method_model('indexed_list');
            if(isset($this->payment_list[0]))
            {
                $wechat = $this->payment_list[0];
                $order_model->update(array('order_id' => $order['order_id']), array('payment_method' => 0));
                $order['payment_method'] = 0;
                $plugin = plugin::instance('payment', $wechat['pcode'], array($wechat['params']));
                $res = $plugin->create_pay_url($order);
                $this->jsConfig = $res;
            }
            $this->order = $order;
            $this->compiler('pay.html');
        }
        else
        {
            jump(url('mobile/main', '400'));
        }
    }
    
    public function action_return()
    {
        $pcode = request('pcode', '', 'get');
        $payment_model = new payment_method_model();
        if($payment = $payment_model->find(array('pcode' => $pcode, 'enable' => 1), null, 'params'))
        {
            $plugin = plugin::instance('payment', $pcode, array($payment['params']));
            if($plugin->response($_GET))
            {
                $this->status = 'success';
            }
            else
            {
                $this->status = 'error';
            }
            $this->message = $plugin->message;
            $this->order = $plugin->order;
            $this->compiler('pay_return.html');
        }
        else
        {
            jump(url('mobile/main', '400'));
        }
    }
}