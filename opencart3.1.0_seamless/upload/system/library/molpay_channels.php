<?php
/**
 * Single source of truth for Fiuu payment channel definitions.
 * Used by both admin and catalog language files via require_once.
 * Add new channels here only — no need to touch any other file.
 */

$molpay_channel_list = array(
	'affinonline'      => 'Affin Bank(Affin Online)',
	'amb'              => 'Am Bank (Am Online)',
	'bankislam'        => 'Bank Islam',
	'cimbclicks'       => 'CIMB Bank(CIMB Clicks)',
	'hlb'              => 'Hong Leong Bank(HLB Connect)',
	'maybank2u'        => 'Maybank(Maybank2u)',
	'pbb'              => 'PublicBank (PBB Online)',
	'rhb'              => 'RHB Bank(RHB Now)',
	'fpx_mb2u'         => 'FPX Maybank(Maybank2u)',
	'fpx_cimbclicks'   => 'FPX CIMB Bank(CIMB Clicks)',
	'fpx_abb'          => 'FPX Affin Bank Berhad',
	'fpx_abmb'         => 'FPX Alliance Bank (Alliance Online)',
	'fpx_amb'          => 'FPX Am Bank (Am Online)',
	'fpx_bimb'         => 'FPX Bank Islam',
	'fpx_bkrm'         => 'FPX Bank Kerjasama Rakyat Malaysia',
	'fpx_bmmb'         => 'FPX Bank Muamalat',
	'fpx_bsn'          => 'FPX Bank Simpanan Nasional (myBSN)',
	'fpx_hlb'          => 'FPX Hong Leong Bank(HLB Connect)',
	'fpx_hsbc'         => 'FPX Hongkong and Shanghai Banking Corporation',
	'fpx_kfh'          => 'FPX Kuwait Finance House',
	'fpx_ocbc'         => 'FPX OCBC Bank',
	'fpx_pbb'          => 'FPX PublicBank (PBB Online)',
	'fpx_rhb'          => 'FPX RHB Bank(RHB Now)',
	'fpx_scb'          => 'FPX Standard Chartered Bank',
	'fpx_uob'          => 'FPX United Overseas Bank (UOB)',
	'cash-711'         => '7-Eleven(Razer Cash)',
	'creditAN'         => 'Credit Card/ Debit Card',
	'ATMVA'            => 'ATM Transfer via Permata Bank',
	'dragonpay'        => 'Dragonpay',
	'paysbuy'          => 'PaysBuy',
	'NGANLUONG'        => 'NGANLUONG',
	'crossborder'      => 'Credit Card/ Debit Card (PayVision)',
	'BOOST'            => 'BOOST',
	'MB2U_QRPay-Push'  => 'Maybank QRPay',
	'GrabPay'          => 'GrabPay',
	'TNG-EWALLET'      => 'Touch \'N Go',
	'WeChatPayMY'      => 'WeChat Pay MY',
	'ShopeePay'        => 'Shopee Pay',
	'Atome'            => 'Atome',
	'GUPOP'            => 'UnionPay',
	'alipay'           => 'Alipay',
	'creditBI'         => 'Visa Installment (AmBank (M) Berhad)',
	'creditBJ'         => 'Visa Installment (HSBC Bank Malaysia Berhad)',
	'creditBK'         => 'Visa Installment (Standard Chartered Bank (Malaysia))',
);

$molpay_channel_groups = array(
	'Card'              => array('creditAN'),
	'Card Installment'  => array('creditBI', 'creditBJ', 'creditBK'),
	'Online Banking'    => array(
		'affinonline', 'amb', 'bankislam', 'cimbclicks', 'hlb', 'maybank2u', 'pbb', 'rhb',
		'fpx_mb2u', 'fpx_cimbclicks', 'fpx_abb', 'fpx_abmb', 'fpx_amb', 'fpx_bimb',
		'fpx_bkrm', 'fpx_bmmb', 'fpx_bsn', 'fpx_hlb', 'fpx_hsbc', 'fpx_kfh',
		'fpx_ocbc', 'fpx_pbb', 'fpx_rhb', 'fpx_scb', 'fpx_uob',
		'dragonpay', 'paysbuy', 'NGANLUONG', 'crossborder',
	),
	'E-Wallet / QR'     => array('alipay', 'BOOST', 'GrabPay', 'MB2U_QRPay-Push', 'ShopeePay', 'TNG-EWALLET', 'WeChatPayMY', 'GUPOP'),
	'Cash Payment'      => array('cash-711', 'ATMVA'),
	'Buy Now Pay Later' => array('Atome'),
);
