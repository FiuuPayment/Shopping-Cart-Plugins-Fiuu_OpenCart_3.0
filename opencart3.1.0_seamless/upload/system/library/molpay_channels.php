<?php
/**
 * Single source of truth for Fiuu payment channel definitions.
 * Used by both admin and catalog language files via require_once.
 * To add a new channel: one entry only — key => array(label, group).
 */

// Group display order
$_molpay_group_order = array(
	'Card',
	'Card Installment',
	'Online Banking',
	'E-Wallet / QR',
	'Cash Payment',
	'Buy Now Pay Later',
);

// Master channel list: key => array(label, group)
$_molpay_channels = array(
	'crossborder'      => array('Credit Card / Debit Card (PayVision)',              'Card'),
	'creditAN'         => array('Credit Card / Debit Card',                          'Card'),
	'creditBI'         => array('Visa Installment (AmBank (M) Berhad)',             'Card Installment'),
	'creditBJ'         => array('Visa Installment (HSBC Bank Malaysia Berhad)',     'Card Installment'),
	'creditBK'         => array('Visa Installment (Standard Chartered Bank (Malaysia))', 'Card Installment'),
	'affinonline'      => array('Affin Bank(Affin Online)',                         'Online Banking'),
	'amb'              => array('Am Bank (Am Online)',                              'Online Banking'),
	'bankislam'        => array('Bank Islam',                                       'Online Banking'),
	'cimbclicks'       => array('CIMB Bank(CIMB Clicks)',                           'Online Banking'),
	'hlb'              => array('Hong Leong Bank(HLB Connect)',                     'Online Banking'),
	'maybank2u'        => array('Maybank(Maybank2u)',                               'Online Banking'),
	'pbb'              => array('PublicBank (PBB Online)',                          'Online Banking'),
	'rhb'              => array('RHB Bank(RHB Now)',                                'Online Banking'),
	'fpx_mb2u'         => array('FPX Maybank(Maybank2u)',                           'Online Banking'),
	'fpx_cimbclicks'   => array('FPX CIMB Bank(CIMB Clicks)',                       'Online Banking'),
	'fpx_abb'          => array('FPX Affin Bank Berhad',                            'Online Banking'),
	'fpx_abmb'         => array('FPX Alliance Bank (Alliance Online)',               'Online Banking'),
	'fpx_amb'          => array('FPX Am Bank (Am Online)',                          'Online Banking'),
	'fpx_bimb'         => array('FPX Bank Islam',                                   'Online Banking'),
	'fpx_bkrm'         => array('FPX Bank Kerjasama Rakyat Malaysia',               'Online Banking'),
	'fpx_bmmb'         => array('FPX Bank Muamalat',                                'Online Banking'),
	'fpx_bsn'          => array('FPX Bank Simpanan Nasional (myBSN)',                'Online Banking'),
	'fpx_hlb'          => array('FPX Hong Leong Bank(HLB Connect)',                 'Online Banking'),
	'fpx_hsbc'         => array('FPX Hongkong and Shanghai Banking Corporation',    'Online Banking'),
	'fpx_kfh'          => array('FPX Kuwait Finance House',                         'Online Banking'),
	'fpx_ocbc'         => array('FPX OCBC Bank',                                    'Online Banking'),
	'fpx_pbb'          => array('FPX PublicBank (PBB Online)',                      'Online Banking'),
	'fpx_rhb'          => array('FPX RHB Bank(RHB Now)',                            'Online Banking'),
	'fpx_scb'          => array('FPX Standard Chartered Bank',                      'Online Banking'),
	'fpx_uob'          => array('FPX United Overseas Bank (UOB)',                   'Online Banking'),
	'dragonpay'        => array('Dragonpay',                                        'Online Banking'),
	'paysbuy'          => array('PaysBuy',                                          'Online Banking'),
	'NGANLUONG'        => array('NGANLUONG',                                        'Online Banking'),
	'GUPOP'            => array('UnionPay',                                         'Online Banking'),
	'alipay'           => array('Alipay',                                           'E-Wallet / QR'),
	'BOOST'            => array('BOOST',                                            'E-Wallet / QR'),
	'GrabPay'          => array('GrabPay',                                          'E-Wallet / QR'),
	'MB2U_QRPay-Push'  => array('Maybank QRPay',                                   'E-Wallet / QR'),
	'ShopeePay'        => array('Shopee Pay',                                       'E-Wallet / QR'),
	'TNG-EWALLET'      => array('Touch \'N Go',                                    'E-Wallet / QR'),
	'WeChatPayMY'      => array('WeChat Pay MY',                                    'E-Wallet / QR'),
	'cash-711'         => array('7-Eleven(Razer Cash)',                             'Cash Payment'),
	'ATMVA'            => array('ATM Transfer via Permata Bank',                    'Cash Payment'),
	'Atome'            => array('Atome',                                            'Buy Now Pay Later'),
);

// Derive flat channel_list and grouped channel_groups from the master array above
$molpay_channel_list = array();
$_groups = array_fill_keys($_molpay_group_order, array());
foreach ($_molpay_channels as $key => $def) {
	$molpay_channel_list[$key] = $def[0];
	$_groups[$def[1]][]        = $key;
}
$molpay_channel_groups = array_filter($_groups);
unset($_molpay_group_order, $_molpay_channels, $_groups);
