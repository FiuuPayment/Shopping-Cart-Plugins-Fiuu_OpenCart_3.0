<?php
/**
 * Razer Merchant Services OpenCart Plugin
 *
 * @package Payment Gateway
 * @author Razer Merchant Services Technical Team <technical-sa@razer.com>
 * @version 3.0.8
 */

class ControllerExtensionPaymentMolpay extends Controller {
        private $error = array();

        public function index() {

                $this->load->language('extension/payment/molpay');


                $this->document->setTitle($this->language->get('heading_title'));

                $this->load->model('setting/setting');

                if (($this->request->server['REQUEST_METHOD'] == 'POST') &&
                $this->validate()) {
                        // echo "<pre>";print_r($this->request->post);exit;

                        $this->model_setting_setting->editSetting('payment_molpay', $this->request->post);

                        $this->session->data['success'] = $this->language->get('text_success');

                        // $this->response->redirect($this->url->link('extension/extension',
                        // 'user_token=' .
                        // $this->session->data['user_token'] .
                        // '&type=payment', true));

                        $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
                }


                $data['heading_title'] = $this->language->get('heading_title');

                $data['text_edit'] = $this->language->get('text_edit');
                $data['text_enabled'] = $this->language->get('text_enabled');
                $data['text_disabled'] = $this->language->get('text_disabled');
                $data['text_all_zones'] = $this->language->get('text_all_zones');
                $data['text_yes'] = $this->language->get('text_yes');
                $data['text_no'] = $this->language->get('text_no');

                $data['entry_mid'] = $this->language->get('entry_mid');
                $data['entry_vkey'] = $this->language->get('entry_vkey');
                $data['entry_skey'] = $this->language->get('entry_skey');
                $data['entry_type'] = $this->language->get('entry_type');
                $data['entry_order_status'] = $this->language->get('entry_order_status');
                $data['entry_completed_status'] = $this->language->get('entry_completed_status');
                $data['entry_pending_status'] = $this->language->get('entry_pending_status');
                $data['entry_failed_status'] = $this->language->get('entry_failed_status');
                $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
                $data['entry_status'] = $this->language->get('entry_status');
                $data['entry_sort_order'] = $this->language->get('entry_sort_order');
                $data['molpay_url'] = parse_url (HTTP_SERVER);

                //Load all channel language file.
                $data['channel_list'] = $this->language->get('channel_list');

                $data['help_vkey'] = $this->language->get('help_vkey');
                $data['help_skey'] = $this->language->get('help_skey');
                $data['help_type'] = $this->language->get('help_type');

                $data['button_save'] = $this->language->get('button_save');
                $data['button_cancel'] = $this->language->get('button_cancel');

                if (isset($this->error['warning'])) {
                        $data['error_warning'] = $this->error['warning'];
                } else {
                        $data['error_warning'] = '';
                }

                if (isset($this->error['mid'])) {
                        $data['error_mid'] = $this->error['mid'];
                } else {
                        $data['error_mid'] = '';
                }

                if (isset($this->error['vkey'])) {
                        $data['error_vkey'] = $this->error['vkey'];
                } else {
                        $data['error_vkey'] = '';
                }

                if (isset($this->error['skey'])) {
                        $data['error_skey'] = $this->error['skey'];
                } else {
                        $data['error_skey'] = '';
                }
                
                if (isset($this->error['type'])) {
                        $data['error_type'] = $this->error['type'];
                } else {
                        $data['error_type'] = '';
                }

                $data['breadcrumbs'] = array();

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('text_home'), 
						'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
                );

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('text_extension'),
                        // 'href' => $this->url->link('extension/extension',
                        // 'user_token=' .
                        // $this->session->data['user_token'] .
                        // '&type=payment', true)
                        'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
                );

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('heading_title'),
                        'href' => $this->url->link('extension/payment/molpay', 'user_token=' . $this->session->data['user_token'], true)
                );

                $data['action'] = $this->url->link('extension/payment/molpay', 'user_token=' . $this->session->data['user_token'], true);

                // $data['cancel'] = $this->url->link('extension/extension',
                // 'user_token=' . $this->session->data['user_token'] .
                // '&type=payment', true);
                $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

                if (isset($this->request->post['payment_molpay_mid'])) {
                        $data['payment_molpay_mid'] = $this->request->post['payment_molpay_mid'];
                } else {
                        $data['payment_molpay_mid'] = $this->config->get('payment_molpay_mid');
                }
                if (isset($this->request->post['payment_molpay_vkey'])) {
                        $data['payment_molpay_vkey'] = $this->request->post['payment_molpay_vkey'];
                } else {
                        $data['payment_molpay_vkey'] = $this->config->get('payment_molpay_vkey');
                }

                if (isset($this->request->post['payment_molpay_skey'])) {
                        $data['payment_molpay_skey'] = $this->request->post['payment_molpay_skey'];
                } else {
                        $data['payment_molpay_skey'] = $this->config->get('payment_molpay_skey');
                }

                if (isset($this->request->post['payment_molpay_type'])) {
                        $data['payment_molpay_type'] = $this->request->post['payment_molpay_type'];
                } else {
                        $data['payment_molpay_type'] = $this->config->get('payment_molpay_type');
                }

                if
                (isset($this->request->post['payment_molpay_order_status_id'])) {
                        $data['payment_molpay_order_status_id'] = $this->request->post['payment_molpay_order_status_id'];
                } else {
                        $data['payment_molpay_order_status_id'] = $this->config->get('payment_molpay_order_status_id');
                }

                if
                (isset($this->request->post['payment_molpay_completed_status_id'])) {
                        $data['payment_molpay_completed_status_id'] = $this->request->post['payment_molpay_completed_status_id'];
                } else {
                        $data['payment_molpay_completed_status_id'] = $this->config->get('payment_molpay_completed_status_id');
                }

                if
                (isset($this->request->post['payment_molpay_pending_status_id'])) {
                        $data['payment_molpay_pending_status_id'] = $this->request->post['payment_molpay_pending_status_id'];
                } else {
                        $data['payment_molpay_pending_status_id'] = $this->config->get('payment_molpay_pending_status_id');
                }

                if
                (isset($this->request->post['payment_molpay_failed_status_id'])) {
                        $data['payment_molpay_failed_status_id'] = $this->request->post['payment_molpay_failed_status_id'];
                } else {
                        $data['payment_molpay_failed_status_id'] = $this->config->get('payment_molpay_failed_status_id');
                }

                $this->load->model('localisation/order_status');

                $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

                if
                (isset($this->request->post['payment_molpay_geo_zone_id'])) {
                        $data['payment_molpay_geo_zone_id'] = $this->request->post['payment_molpay_geo_zone_id'];
                } else {
                        $data['payment_molpay_geo_zone_id'] = $this->config->get('payment_molpay_geo_zone_id');
                }
                $this->load->model('localisation/geo_zone');

                $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

                if (isset($this->request->post['payment_molpay_status'])) {
                        $data['payment_molpay_status'] = $this->request->post['payment_molpay_status'];
                } else {
                        $data['payment_molpay_status'] = $this->config->get('payment_molpay_status');
                }

                if
                (isset($this->request->post['payment_molpay_sort_order'])) {
                        $data['payment_molpay_sort_order'] = $this->request->post['payment_molpay_sort_order'];
                } else {
                        $data['payment_molpay_sort_order'] = $this->config->get('payment_molpay_sort_order');
                }

                //Load the data into variable

                foreach($data['channel_list'] as $key=>$val)
                {
                        if
                        (isset($this->request->post['payment_molpay_'.$key.'_status']))
                        {
                                $data['payment_molpay_'.$key.'_status'] = $this->request->post['payment_molpay_'.$key.'_status'];
                                $data['statx'][$key] = $this->request->post['payment_molpay_'.$key.'_status'];
                        }
                        else
                        {
                                $data['payment_molpay_'.$key.'_status'] = $this->config->get('payment_molpay_'.$key.'_status');
                                $data['statx'][$key] = $this->config->get('payment_molpay_'.$key.'_status');
                        }
                }

                $data['header'] = $this->load->controller('common/header');
                $data['column_left'] = $this->load->controller('common/column_left');
                $data['footer'] = $this->load->controller('common/footer');


                $this->response->setOutput($this->load->view('extension/payment/molpay',
                $data));
        }

        protected function validate() {
                if (!$this->user->hasPermission('modify', 'extension/payment/molpay')) {
                        $this->error['warning'] = $this->language->get('error_permission');
                }

                if (!$this->request->post['payment_molpay_mid']) {
                        $this->error['mid'] = $this->language->get('error_mid');
                }

                if (!$this->request->post['payment_molpay_vkey']) {
                        $this->error['vkey'] = $this->language->get('error_vkey');
                }
                
                if (!$this->request->post['payment_molpay_skey']) {
                        $this->error['skey'] = $this->language->get('error_skey');
                }

                if (!$this->request->post['payment_molpay_type']) {
                        $this->error['type'] = $this->language->get('error_type');
                }
                return !$this->error;
        }


}