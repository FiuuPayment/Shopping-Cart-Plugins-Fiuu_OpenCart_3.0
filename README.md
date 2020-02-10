# OpenCart3.0_Plugin
Razer Merchant Services OpenCart Shopping Cart Plugin v3.0

<img src="https://user-images.githubusercontent.com/38641542/74150431-e0217e80-4c44-11ea-9f73-a18c82975341.jpg">

Razer Merchant Services Seamless Integration plugin for OpenCart 3.0.x develop by Razer Merchant Services technical team.

Supported version
-----------------
New Update

- Opencart Seamless Plugin
- OpenCart version 3.x

Notes
-------------
MOLPay Sdn. Bhd. is not responsible for any problems that might arise from the use of this module. 
Use at your own risk. For any query or assistance, please email support-sa@razer.com

If you have existing plugin, please backup your Opencart folder first

Installations
-------------
1. Download from [opencart3.0_seamless_wAccType.zip](https://github.com/MOLPay/OpenCart3.0_Plugin/blob/master/opencart3.0_seamless_wAccType.zip) or clone this repository. Copy all the file and paste it at your opencart root directory.  
`<OpenCart_DIR>/admin/*`  
`<OpenCart_DIR>/catalog/*`

2. Login to OpenCart administration, click on extension menu and click on Payments submenu.

3. You will see list of payment method available on your OpenCart. Click on [Install] link for MOLPay Online Payment Gateway (Visa, MasterCard, Maybank2u, MEPS, FPX, etc) to install this module into your online store.  

4. After you’ve successfully install this module, you need to click on [Edit] link for MOLPay Payment Gateway option to configure this payment module in your OpenCart online store.

5. Fill in your MOLPay Merchant ID & MOLPay Verify Key into the respective fields.

6. Log in your merchant account at https://portal.molpay.com. Click Transaction > Transaction Settings > Endpoint setting.
  
  ``Return URL : http://xxxxxxxxxxxxxx/index.php?route=extension/payment/molpay/return_ipn``

  ``Notification URL : http://xxxxxxxxxxxxxx/index.php?route=extension/payment/molpay/notification_ipn``

  ``Callback URL : http://xxxxxxxxxxxxxx/index.php?route=extension/payment/molpay/callback_ipn`` 
  
  *Replace xxxxxxxxxxxxxx with your shoppingcart domain

7. Save the configuration and done.

Contribution
------------
You can contribute to this plugin by sending the pull request to this repository.

Issues
------------
Submit issue to this repository or email to our support-sa@razer.com

Support
-------
Merchant Technical Support / Customer Care : support-sa@razer.com <br>
Sales/Reseller Enquiry : sales-sa@razer.com <br>
Marketing Campaign : marketing-sa@razer.com <br>
Channel/Partner Enquiry : channel-sa@razer.com <br>
Media Contact : media-sa@razer.com <br>
R&D and Tech-related Suggestion : technical-sa@razer.com <br>
Abuse Reporting : abuse-sa@razer.com
