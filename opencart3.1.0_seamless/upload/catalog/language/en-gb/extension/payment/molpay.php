<?php
/**
 * Razer Merchant Services OpenCart Plugin
 * 
 * @package Payment Gateway
 * @author Razer Merchant Services Technical Team <technical@fiuu.com>
 * @version 3.1.0
 */
 
// Text
$_['text_title'] = 'Razer Merchant Services';

// Channel
require_once __DIR__ . '/../../../../../system/library/molpay_channels.php';
$_['channel_list']   = $molpay_channel_list;
$_['channel_groups'] = $molpay_channel_groups;
