<?php
/**
 * Razer Merchant Services OpenCart Plugin
 *
 * @package Payment Gateway
 * @author Razer Merchant Services Technical Team <technical@fiuu.com>
 * @version 2.0
 */

class ControllerExtensionPaymentMolpay extends Controller {
    public function index() {
        $data['button_confirm'] = $this->language->get('button_confirm');

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        // Use guest details if not logged in
        if (isset($this->session->data['guest'])) {
            $email = $this->session->data['guest']['email'];
            $telephone = $this->session->data['guest']['telephone'];
        } else {
            $email = $this->customer->getEmail();
            $telephone = $this->customer->getTelephone();
        }

        $js_ver = stripos($this->config->get('payment_molpay_type'), 'sandbox') !== false ? "latest" : "3.28";

        $data['action']      = $this->config->get('payment_molpay_type').'MOLPay/pay/'.$this->config->get('payment_molpay_mid').'/';
        $data['mid']         = $this->config->get('payment_molpay_mid');
        $data['amount']      = number_format($this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false), 2);
        $data['orderid']     = $this->session->data['order_id'];
        $data['bill_name']   = $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'];
        $data['bill_email']  = $email;
        $data['bill_mobile'] = $telephone;
        $data['country']     = $order_info['payment_iso_code_2'];
        $data['currency']    = $order_info['currency_code'];
        $data['js']          = $this->config->get('payment_molpay_type').'MOLPay/API/seamless/'.$js_ver.'/js/MOLPay_seamless.deco.js';

        if ($this->config->get('payment_molpay_extended_vcode') == "1") {
            $data['vcode'] = md5($data['amount'].$this->config->get('payment_molpay_mid').$data['orderid'].$this->config->get('payment_molpay_vkey').$data['currency']);
        } else {
            $data['vcode'] = md5($data['amount'].$this->config->get('payment_molpay_mid').$data['orderid'].$this->config->get('payment_molpay_vkey'));
        }

        // Load all channels from language file
        $this->load->language('extension/payment/molpay');
        $channel_list = $this->language->get('channel_list');

        $data['channel_labels'] = $channel_list;

        foreach ($channel_list as $key => $val) {
            $inGet = 'payment_molpay_'.$key.'_status';
            $data['channel_list'][$key] = $this->config->get($inGet);
        }

        // Group enabled channels by type for the payment UI
        $group_map = $this->language->get('channel_groups');
        $data['channel_groups'] = array();
        foreach ($group_map as $group_label => $keys) {
            $enabled = array();
            foreach ($keys as $key) {
                if (!empty($data['channel_list'][$key])) {
                    $enabled[] = array(
                        'key'   => $key,
                        'label' => isset($channel_list[$key]) ? $channel_list[$key] : $key
                    );
                }
            }
            if (!empty($enabled)) {
                $data['channel_groups'][$group_label] = $enabled;
            }
        }

        $products = $this->cart->getProducts();
        $data['prod_desc2'] = "";
        foreach ($products as $product) {
            $data['prod_desc2'] .= $product['name']." x ".$product['quantity']."\n";
        }

        $data['lang']      = $this->session->data['language'];
        $data['returnurl'] = $this->url->link('extension/payment/molpay/return_ipn', '', 'SSL');
        $data['cancelurl'] = $this->url->link('extension/payment/molpay/cancelOrder');

        $version_oc = substr(VERSION, 0, 3);

        if ($version_oc == "2.3") {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/molpay.twig')) {
                return $this->load->view($this->config->get('config_template') . '/template/extension/payment/molpay.twig', $data);
            } else {
                return $this->load->view('extension/payment/molpay', $data);
            }
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/molpay')) {
                return $this->load->view($this->config->get('config_template') . '/template/extension/payment/molpay', $data);
            } else {
                return $this->load->view('default/template/extension/payment/molpay', $data);
            }
        }
    }

    // Cancel order when customer closes the credit card popup
    public function cancelOrder() {
        unset($this->session->data['language']);
        unset($this->session->data['order_id']);

        echo '<html>' . "\n";
        echo '<head>' . "\n";
        echo '  <meta http-equiv="Refresh" content="0; url=' . $this->url->link('checkout/failure') . '">' . "\n";
        echo '</head>' . "\n";
        echo '<body>' . "\n";
        echo '  <p>Loading... <a href="' . $this->url->link('checkout/failure') . '">link</a>!</p>' . "\n";
        echo '</body>' . "\n";
        echo '</html>' . "\n";
    }

    public function return_ipn() {
        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->request->post['orderid']);

        $vkey = $this->config->get('payment_molpay_skey');

        $_POST['treq'] = 1; // Signal to MOLPay IPN endpoint that this is a redirect return

        $tranID   = (isset($_POST['tranID'])   && !empty($_POST['tranID']))   ? $_POST['tranID']   : '';
        $orderid  = (isset($_POST['orderid'])  && !empty($_POST['orderid']))  ? $_POST['orderid']  : '';
        $status   = (isset($_POST['status'])   && !empty($_POST['status']))   ? $_POST['status']   : '';
        $domain   = (isset($_POST['domain'])   && !empty($_POST['domain']))   ? $_POST['domain']   : '';
        $amount   = (isset($_POST['amount'])   && !empty($_POST['amount']))   ? $_POST['amount']   : '';
        $currency = (isset($_POST['currency']) && !empty($_POST['currency'])) ? $_POST['currency'] : '';
        $appcode  = (isset($_POST['appcode'])  && !empty($_POST['appcode']))  ? $_POST['appcode']  : '';
        $paydate  = (isset($_POST['paydate'])  && !empty($_POST['paydate']))  ? $_POST['paydate']  : '';
        $skey     = (isset($_POST['skey'])     && !empty($_POST['skey']))     ? $_POST['skey']     : '';

        /***********************************************************
        * Backend acknowledge method for IPN (DO NOT MODIFY)
        ************************************************************/
        foreach ($_POST as $k => $v) {
            $postData[] = $k."=".$v;
        }
        $postdata = implode("&", $postData);
        $url      = $this->config->get('payment_molpay_type')."MOLPay/API/chkstat/returnipn.php";
        $ch       = curl_init();
        curl_setopt($ch, CURLOPT_POST,           1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     $postdata);
        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_HEADER,         1);
        curl_setopt($ch, CURLINFO_HEADER_OUT,    TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        /***********************************************************
        * End of Acknowledge method for IPN
        ************************************************************/

        $key0 = md5($tranID.$orderid.$status.$domain.$amount.$currency);
        $key1 = md5($paydate.$domain.$key0.$appcode.$vkey);

        if ($skey != $key1) {
            $status = -1;
        }

        $order_status_id = $this->config->get('config_order_status_id');
        if ($status == "00") {
            $order_status_id = $this->config->get('payment_molpay_completed_status_id');
        } elseif ($status == "22") {
            $order_status_id = $this->config->get('payment_molpay_pending_status_id');
        } else {
            $order_status_id = $this->config->get('payment_molpay_failed_status_id');
            unset($this->session->data['language']);
            unset($this->session->data['order_id']);
        }

        $param = "";
        foreach ($_POST as $kP => $vP) {
            $param .= $kP . "=" . $vP . "<br>";
        }

        $this->model_checkout_order->addOrderHistory($orderid, $order_status_id, $param);

        $successStatus = array('00', '22');
        if (in_array($status, $successStatus)) {
            echo '<html>' . "\n";
            echo '<head>' . "\n";
            echo '  <meta http-equiv="Refresh" content="0; url=' . $this->url->link('checkout/success') . '">' . "\n";
            echo '</head>' . "\n";
            echo '<body>' . "\n";
            echo '  <p>Please follow <a href="' . $this->url->link('checkout/success') . '">link</a>!</p>' . "\n";
            echo '</body>' . "\n";
            echo '</html>' . "\n";
        } else {
            echo '<html>' . "\n";
            echo '<head>' . "\n";
            echo '  <meta http-equiv="Refresh" content="0; url=' . $this->url->link('checkout/failure') . '">' . "\n";
            echo '</head>' . "\n";
            echo '<body>' . "\n";
            echo '  <p>Please follow <a href="' . $this->url->link('checkout/failure') . '">link</a>!</p>' . "\n";
            echo '</body>' . "\n";
            echo '</html>' . "\n";
        }

        exit();
    }

    /*****************************************************
    * Callback with IPN(Instant Payment Notification)
    ******************************************************/
    public function callback_ipn() {
        $this->load->model('checkout/order');

        $vkey = $this->config->get('payment_molpay_skey');

        $nbcb     = (isset($_POST['nbcb'])     && !empty($_POST['nbcb']))     ? $_POST['nbcb']     : '';
        $tranID   = (isset($_POST['tranID'])   && !empty($_POST['tranID']))   ? $_POST['tranID']   : '';
        $orderid  = (isset($_POST['orderid'])  && !empty($_POST['orderid']))  ? $_POST['orderid']  : '';
        $status   = (isset($_POST['status'])   && !empty($_POST['status']))   ? $_POST['status']   : '';
        $domain   = (isset($_POST['domain'])   && !empty($_POST['domain']))   ? $_POST['domain']   : '';
        $amount   = (isset($_POST['amount'])   && !empty($_POST['amount']))   ? $_POST['amount']   : '';
        $currency = (isset($_POST['currency']) && !empty($_POST['currency'])) ? $_POST['currency'] : '';
        $appcode  = (isset($_POST['appcode'])  && !empty($_POST['appcode']))  ? $_POST['appcode']  : '';
        $paydate  = (isset($_POST['paydate'])  && !empty($_POST['paydate']))  ? $_POST['paydate']  : '';
        $skey     = (isset($_POST['skey'])     && !empty($_POST['skey']))     ? $_POST['skey']     : '';

        $key0 = md5($tranID.$orderid.$status.$domain.$amount.$currency);
        $key1 = md5($paydate.$domain.$key0.$appcode.$vkey);

        if ($skey != $key1) {
            $status = -1;
        }

        if ($nbcb == 1) { // nbcb=1: backend callback from MOLPay
            echo "CBTOKEN:MPSTATOK";
            $order_info = $this->model_checkout_order->getOrder($this->request->post['orderid']);

            $order_status_id = $this->config->get('config_order_status_id');

            if ($status == "00") {
                $order_status_id = $this->config->get('payment_molpay_completed_status_id');
            } elseif ($status == "22") {
                $order_status_id = $this->config->get('payment_molpay_pending_status_id');
            } else {
                $order_status_id = $this->config->get('payment_molpay_failed_status_id');
            }

            $param = "";
            foreach ($_POST as $kP => $vP) {
                $param .= $kP . "=" . $vP . "<br>";
            }

            $this->model_checkout_order->addOrderHistory($orderid, $order_status_id, $param);
        }
    }

    /*****************************************************
    * Notification with IPN(Instant Payment Notification)
    ******************************************************/
    public function notification_ipn() {
        $this->load->model('checkout/order');

        $vkey = $this->config->get('payment_molpay_skey');

        $nbcb     = (isset($_POST['nbcb'])     && !empty($_POST['nbcb']))     ? $_POST['nbcb']     : '';
        $tranID   = (isset($_POST['tranID'])   && !empty($_POST['tranID']))   ? $_POST['tranID']   : '';
        $orderid  = (isset($_POST['orderid'])  && !empty($_POST['orderid']))  ? $_POST['orderid']  : '';
        $status   = (isset($_POST['status'])   && !empty($_POST['status']))   ? $_POST['status']   : '';
        $domain   = (isset($_POST['domain'])   && !empty($_POST['domain']))   ? $_POST['domain']   : '';
        $amount   = (isset($_POST['amount'])   && !empty($_POST['amount']))   ? $_POST['amount']   : '';
        $currency = (isset($_POST['currency']) && !empty($_POST['currency'])) ? $_POST['currency'] : '';
        $appcode  = (isset($_POST['appcode'])  && !empty($_POST['appcode']))  ? $_POST['appcode']  : '';
        $paydate  = (isset($_POST['paydate'])  && !empty($_POST['paydate']))  ? $_POST['paydate']  : '';
        $skey     = (isset($_POST['skey'])     && !empty($_POST['skey']))     ? $_POST['skey']     : '';

        $key0 = md5($tranID.$orderid.$status.$domain.$amount.$currency);
        $key1 = md5($paydate.$domain.$key0.$appcode.$vkey);

        if ($skey != $key1) {
            $status = -1;
        }

        if ($nbcb == 2) { // nbcb=2: notification callback from MOLPay
            echo "CBTOKEN:MPSTATOK";
            $order_info = $this->model_checkout_order->getOrder($this->request->post['orderid']);

            $order_status_id = $this->config->get('config_order_status_id');

            if ($status == "00") {
                $order_status_id = $this->config->get('payment_molpay_completed_status_id');
            } elseif ($status == "22") {
                $order_status_id = $this->config->get('payment_molpay_pending_status_id');
            } else {
                $order_status_id = $this->config->get('payment_molpay_failed_status_id');
            }

            $param = "";
            foreach ($_POST as $kP => $vP) {
                $param .= $kP . "=" . $vP . "<br>";
            }

            if (!$order_info['order_status_id']) {
                $this->model_checkout_order->addOrderHistory($orderid, $order_status_id, $param);
            } else {
                $this->model_checkout_order->addOrderHistory($orderid, $order_status_id, $param);
            }
        }
    }
}
