<?php
/**
 * E2Pay Global Utama OpenCart Plugin
 * 
 * @package Payment Gateway
 * @author E2Pay Global Utama Technical Team <technical-sa@razer.com>
 * @version 3.0.8
 */
 
 // Versioning
$_['molpay_ptype'] = "OpenCart";
$_['molpay_pversion'] = "3.0.8";

// Heading
$_['heading_title']					= 'E2Pay Global Utama';

// Text
$_['text_payment']					= 'Payment';
$_['text_success']					= 'Success: You have modified E2Pay Global Utama account details!';
$_['text_edit']                     = 'Edit E2Pay Global Utama';
$_['text_molpay']	     			= '<a onclick="window.open(\'https://merchant.razer.com/\');" style="text-decoration:none;"><img src="view/image/payment/logo_E2Pay.png" alt="E2Pay Global Utama" title="E2Pay Global Utama" width="100px"/></a>';

// Entry
$_['entry_mid']						= 'E2Pay Global Utama Merchant ID';
$_['entry_vkey']					= 'E2Pay Global Utama Verify Key';
$_['entry_skey']					= 'E2Pay Global Utama Secret Key';
$_['entry_type']                    = 'E2Pay Global Utama Account Type';
$_['entry_order_status']			= 'Order Status';
$_['entry_completed_status']		= 'Completed Status';
$_['entry_pending_status']			= 'Pending Status';
$_['entry_failed_status']			= 'Failed Status';
$_['entry_geo_zone']				= 'Geo Zone';
$_['entry_status']					= 'Status';
$_['entry_sort_order']				= 'Sort Order';

// Channel
$_['channel_list']					= 	array(
											'e2Pay_DANA' 				=> 'Dana',
											'e2Pay_LINKAJA_APPLINK' 	=> 'LinkAja Applink',
											'e2Pay_SHOPEEPAY_JUMPAPP'	=> 'Shopeepay Jumpapp',
											'e2Pay_OVO'				    => 'OVO',
											'e2Pay_CIMB_OctoPay' 		=> 'CIMB OctoPay',
											'e2Pay_LINKAJA_QRIS' 		=> 'LinkAja Qris',
											'e2Pay_LINKAJA_WCO' 		=> 'LinkAja WCO',
											'e2Pay_CIMB_QRIS' 			=> 'CIMB Qris',
											'e2Pay_SHOPEEPAY_QRIS' 		=> 'ShopeePay Qris',
											'e2Pay_MBayar_QR' 			=> 'Mbayar QR',
											'e2Pay_MBayar_Auth' 		=> 'Mbayar Auth',
											'e2Pay_Alfamart' 			=> 'Alfamart',
											'e2Pay_GOPAY' 				=> 'GOPAY',
											'e2Pay_PERMATA_VA' 			=> 'Permata Virtual Account',
											'e2Pay_BNI_VA' 				=> 'BNI Virtual Account',
											'e2Pay_CIMB_VA' 			=> 'CIMB Virtual Account',
											'e2Pay_BCA_VA' 				=> 'BCA Virtual Account',
											'e2Pay_BRI_VA' 				=> 'BRI Virtual Account',
											'e2Pay_MANDIRI_VA' 			=> 'Mandiri Virtual Account',
											'e2Pay_CIMBOctoClicks_IB' 	=> 'CIMB Octo Clicks Internet Banking',
											'e2Pay_Kredivo_FN' 			=> 'Kredivo',
											'e2Pay_Indodana_FN' 		=> 'Indodana',
											'e2Pay_Indomaret' 			=> 'Indomaret',
											'e2Pay_DBankPro_IB' 		=> 'DBank Pro IB',
											'creditAO' 					=> 'CIMB NIAGA CC',
										);

// Help
$_['help_vkey']						= 'Please refer to your E2Pay Global Utama Merchant Profile for this key.';
$_['help_skey']						= 'Please refer to your E2Pay Global Utama Merchant Profile for this key.';
$_['help_type']                     = 'Please choose your account type (Sandbox/Production).';

// Error
$_['error_permission']				= 'Warning: You do not have permission to modify E2Pay Global Utama!';
$_['error_mid']						= '<b>E2Pay Global Utama Merchant ID</b> Required!';
$_['error_vkey']					= '<b>E2Pay Global Utama Verify Key</b> Required!';
$_['error_skey']					= '<b>E2Pay Global Utama Secret Key</b> Required!';
$_['error_settings']       			= 'E2Pay Global Utama merchant ID and verify key mismatch, contact support-sa@razer.com for assistance.';
$_['error_status']          		= 'Unable to connect E2Pay Global Utama API.';
