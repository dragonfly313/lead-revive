<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('websites')->delete();

        \DB::table('websites')->insert(
            array(
                0 =>
                    array(
                        'id' => 1,
                        'pro_name' => 'template-0',
                        'content' => '<title></title>

                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    
                        <meta name="format-detection" content="telephone=no">
                    
                        <!--[if (gte mso 9)|(IE)]>
                    
                        <xml>
                    
                          <o:OfficeDocumentSettings>
                    
                            <o:AllowPNG/>
                    
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                    
                          </o:OfficeDocumentSettings>
                    
                        </xml>
                    
                        <![endif]-->
                    
                        <style type="text/css">
                    
                          #outlook a {padding: 0}
                    
                          h1, h2, h3, h4, h5, h6, p {margin:0;padding:0;border:0;outline:0;font-weight:normal;font-size:100%;font-family:inherit;vertical-align:baseline}
                    
                          body,table,td,th {-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%}
                    
                          table,td,th { mso-table-lspace: 0pt; mso-table-rspace: 0pt}
                    
                          td,th{margin: 0;padding: 0;font-weight: normal}
                    
                          img {border: 0; line-height: 100%; outline: none; text-decoration: none}
                    
                          table {border-collapse: collapse !important;}
                    
                          body {height: 100% !important; margin: 0 auto !important; padding: 0 !important; width: 100% !important}
                    
                          .gmailfix {display:none;display:none!important;}
                    
                          a[x-apple-data-detectors] {color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important}
                    
                          .mobileLinks a {color:inherit !important; text-decoration:none !important} /* Wrap phone numbers, date, address with <span class="mobileLinks"> */
                    
                          u + .body .gmailfix {display: none !important}
                    
                          u + .body a {color: inherit;text-decoration: none;font-size: inherit;font-family: inherit;font-weight: inherit;line-height: inherit;} /* CHECK */\
                    
                    
                          .BKG_transparent {background-image: url(\'https://image.mail.salesforce.com/lib/fea31c727564047c74/m/2/BKG_hero_tile.png\') !important; background-repeat: repeat !important;}\
                    
                        </style>
                    
                        <style type="text/css">
                    
                          @-ms-viewport {width: device-width}
                    
                          span.MsoHyperlink {mso-style-priority:99;color:inherit;}
                    
                          span.MsoHyperlinkFollowed {mso-style-priority:99;color:inherit;}
                    
                        </style>
                    
                        <!--[if mso]>
                    
                        <style type="text/css">
                    
                          body, table, td, th, p, h1, h2, h3, h4, span {font-family: Helvetica, Arial, sans-serif !important}
                    
                          table {border-collapse:collapse !important}
                    
                          a {text-decoration:none !important}
                    
                          span.underline {text-decoration:underline !important}
                    
                          li {text-indent: -1em;} /* Normalise space between bullets and text */
                    
                          td.MS_CTAcolor {background-color:#0176d3 !important;}
                    
                          .o_h52 {height: 52px !important}
                    
                          <link href="#" rel="stylesheet">
                    
                        </style>
                    
                        <![endif]-->
                    
                        <style type="text/css">
                    
                          @media only screen and (max-width: 480px) {
                    
                          u + .body .center_iOS {min-width: 100vw}
                    
                          .w100pc {width: 100% !important}
                    
                          .w90pc {width: 90% !important}
                    
                          .w80pc {width: 80% !important}
                    
                          .w70pc {width:70% !important}
                    
                          .w60pc {width:60% !important}
                    
                          .w50pc {width:50% !important}
                    
                          .w10 {width:10px !important}
                    
                          .w64 {width:64px !important}
                    
                          .wauto {width: auto !important}
                    
                    
                          .h20 {height: 20px !important}
                    
                          .h44 {height: 44px !important}
                    
                          .h52 {height: 52px !important}
                    
                          .hauto {height: auto !important}
                    
                          .h200max {max-height: 200px !important}
                    
                    
                          .mobileHide {display: none !important}
                    
                          .mobileShow {display: block !important;max-height: none !important}
                    
                          .mobileShow_text {display: table-row !important;max-height: none !important}
                    
                          .mobileIMG {display: inline-block !important;}
                    
                          .block {display: block !important; width: 100% !important}
                    
                    
                          .aligncenter {text-align: center !important}
                    
                          .alignleft {text-align: left !important}
                    
                          .alignright {text-align: right !important}
                    
                          .alignmiddle {vertical-align: middle !important}
                    
                    
                          .f28 {font-size: 28px !important; line-height: 32px !important}
                    
                          .c_032d60 {color:#032d60 !important}
                    
                    
                          .BKG_hero {background-image: none !important; height: auto !important}
                    
                          .BKG_none {background-image:none !important; height:auto !important}
                    
                          .BKG_mob {background-size: 480px auto !important; height: auto !important}
                    
                          .BKG_webinar {background-size: 100% auto !important}
                    
                          .BKG_cover {background-size: cover !important}
                    
                          .BKG_clear {background-color: transparent !important}
                    
                          .BKG_00a1e0 {background-color:#00a1e0 !important}
                    
                          .BKG_ffffff {background-color: #430d71ffe !important}
                    
                          .BKG_fffffe {background-color: #430d71ffe !important}
                    
                          .BKG_009cdb {background-color:#009cdb !important}
                    
                          .BKG_e1e2 {background-image: url(\'http://image.mail.salesforce.com/lib/fe981c727564047b72/m/20/e1-e2_mob_BG_8x800.png\');background-repeat: repeat-x; background-position: bottom left;background-color: #430d71ffe}
                    
                    
                          .p_reset {padding-bottom: 0 !important;padding-left: 0 !important;padding-right: 0 !important;padding-top: 0 !important}
                    
                          .pb0 {padding-bottom:0 !important}
                    
                          .pb10 {padding-bottom:10px !important}
                    
                          .pb16 {padding-bottom:16px !important}
                    
                          .pb20 {padding-bottom:20px !important}
                    
                          .pb24 {padding-bottom:24px !important}
                    
                          .pb30 {padding-bottom:30px !important}
                    
                          .pb35 {padding-bottom:35px !important}
                    
                          .pb36 {padding-bottom:36px !important}
                    
                          .pb40 {padding-bottom:40px !important}
                    
                          .pl0 {padding-left:0 !important}
                    
                          .pl10 {padding-left:10px !important}
                    
                          .pl16 {padding-left:16px !important}
                    
                          .pl20 {padding-left:20px !important}
                    
                          .pr0 {padding-right:0 !important}
                    
                          .pr10 {padding-right:10px !important}
                    
                          .pr16 {padding-right:16px !important}
                    
                          .pr20 {padding-right:20px !important}
                    
                          .pt0 {padding-top:0 !important}
                    
                          .pt10 {padding-top:10px !important}
                    
                          .pt16 {padding-top:16px !important}
                    
                          .pt20 {padding-top:20px !important}
                    
                          .pt24 {padding-top:24px !important}
                    
                          .pt30 {padding-top:30px !important}
                    
                          .pt36 {padding-top:36px !important}
                    
                          .pt40 {padding-top:40px !important}
                    
                    
                          .mlr20 {margin: 0 20px 0 20px !important}
                    
                    
                          .CTA_mobile a {border: none !important}
                    
                          .CTA_mobileReverse {color:#0077bb !important;background-color: #430d71fff !important}
                    
                          .CTA_0176d3 a {background-color:#0176d3 !important; color: #430d71ffe !important; border-color:#0176d3 !important}
                    
                          }
                    
                          @media screen and (-webkit-min-device-pixel-ratio: 0), screen and (min--moz-device-pixel-ratio: 0) {
                    
                          .font_normal {font-weight: normal !important;}
                    
                          [class="x_font_normal"] {font-weight: bold !important}
                    
                          }
                    
                          @media only screen and (max-width: 390px) {
                    
                          .block320 {display: block !important}
                    
                          }
                    
                        </style>
                    
                        <style type="text/css">
                    
                          @media {
                    
                          @font-face{font-family:\'SalesforceSansBold\';src:url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.eot\');src:url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.eot?#iefix\') format(\'embedded-opentype\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.woff\') format(\'woff\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.woff2\') format(\'woff2\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.ttf\') format(\'truetype\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Bold.svg#SalesforceSansBold\')
                    
                          format(\'svg\');font-weight:normal;font-style:normal}
                    
                          @font-face{font-family:\'SalesforceSansRegular\';src:url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.eot\');src:url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.eot?#iefix\') format(\'embedded-opentype\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.woff\') format(\'woff\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.woff2\') format(\'woff2\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.ttf\')
                    
                          format(\'truetype\'),url(\'https://c1.sfdcstatic.com/etc/clientlibs/sfdc-aem-master/clientlibs_base/fonts/SalesforceSans-Regular.svg#SalesforceSansRegular\') format(\'svg\');font-weight:normal;font-style:normal}
                    
                          @font-face{font-family:\'ITC Avant Garde Demi\'; src:url(\'https://image.mail.salesforce.com/lib/fe981c727564047b72/m/24/ITCAvantGardePro-Demi-w.woff\') format(\'woff\'),url(\'https://image.mail.salesforce.com/lib/fe981c727564047b72/m/24/ITCAvantGardePro-Demi-w2.woff2\') format(\'woff2\'),url(\'https://image.mail.salesforce.com/lib/fe981c727564047b72/m/24/ITCAvantGardePro-Demi.ttf\') format(\'truetype\');font-weight:600;font-style:normal}                    
                          }                    
                        </style>                   
                    
                      
                    
                        <style>@media yahoo {.yahooHide {display: none !important}}</style>
                    
                        <!--Pre-header-->
                    
                        <div class="yahooHide" style="display:none;font-size:1px;color: #430d71fff;line-height:1px;font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;">How do we balance speed and quality with Slack?</div>
                    
                        <div lang="EN" role="article" aria-label="Efficient and personalized customer service">
                    
                    
                                <!--ASPEN - narrow-->
                    
                          <table role="presentation" width="100%" bgcolor="#fffffe" border="0" cellspacing="0" cellpadding="0" class="center_iOS">
                    
                            <tbody><tr>
                    
                              <td align="center" valign="top" style="padding-bottom:40px">
                    
                                <!--Primary offer content-->
                    
                                <table role="presentation" align="center" bgcolor="#fffffe" cellpadding="0" cellspacing="0" border="0" style="width:800px;border-top: 3px solid #009cdb" class="w100pc">
                    
                                  <!--Primary-->
                    
                                  <tbody><tr>
                    
                                    <td align="center" valign="bottom">
                    
                                      <table role="presentation" align="center" width="496" border="0" cellspacing="0" cellpadding="0" style="width:496px" class="w90pc">
                    
                                        <!--Logo-->
                    
                                        <tbody><tr>
                    
                                          <td align="center" valign="middle" style="padding-top:8px;padding-bottom:24px"><a href="http://click.mail.salesforce.com/?qs=1c07ee8ed981060a8b189a9abad7e3ba0de3771f8922885392494363b339e08afcfefd66adc0a2537796326e8f9dfee942a349fa17fbc190ef87935b96c34e9c" target="_blank" style="text-decoration:none"><img src="https://image.mail.salesforce.com/lib/fea31c727564047c74/m/3/SFDC_Logo_216x156_0d9dda.png" alt="Salesforce" height="52" style="font-family:Salesforce Sans, Arial, Helvetica, sans-serif; color:#0d9dda;font-size:16px;height:52px;display:block;border:none"></a></td>
                    
                                        </tr>
                    
                                        <!--end Logo-->
                    
                                        <tr>
                    
                                          <td align="center" valign="middle" style="font-family: \'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif;color:#181818;font-size:16px;line-height:24px;font-weight:normal">
                    
                                            <h1 style="font-family:\'ITC Avant Garde Demi\', Helvetica, Arial, sans-serif; color:#032d60;font-size:24px; mso-line-height-rule:exactly; line-height:32px;font-weight:600; margin:0 0 32px 0;"><a href="http://click.mail.salesforce.com/?qs=21ff3a8b9ca0610bf8b5ff8a1b4e398843269b5bb45b8130cba076569a1999c2782171c96949ae943deb7aee25e628a60c6bd996484552ea0b4638112d906d52" target="_blank" style="color:#032d60; text-decoration:none">Boost customer service with Slack</a></h1>
                    
                    
                                            <a href="http://click.mail.salesforce.com/?qs=11bc875ad5a133687a4c5ae91cf0470958ae3ce0bda76745ec9b9f29ca990ef5f71dbbe647da22f06231e2d29c161f581dd2500ec42b71ba2168ca0b7eb9eace" target="_blank"><img src="https://image.mail.salesforce.com/lib/fea31c727564047c74/m/1/a0U7y000003WfazEAC_SF436_Service-Cloud_Compact-Email_496x496.png" alt="" width="456" style="display: block; border: none; visibility: visible;" class="w90pc hauto" data-xblocker="passed"></a>
                    
                                          </td>
                    
                                        </tr>
                    
                                      </tbody></table>
                    
                                    </td>
                    
                                  </tr>
                    
                                  <tr>
                    
                                    <td align="center" style="padding-top:40px;padding-bottom:18px">
                    
                                      <!--CTA-->
                    
                                      <table role="presentation" border="0" cellspacing="0" cellpadding="0" align="center">
                    
                                        <tbody><tr>
                    
                                          <td align="center" style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; border-radius:4px;padding:0;white-space:nowrap" bgcolor="#0176d3"><a href="http://click.mail.salesforce.com/?qs=38989f1abf3610fbe63c1a5e68d45fb2126cede00e37f6921e2acf92b8ca9055fc90bc6f340cbd3e42b349eaa430cf1bbbe32605fd0de0960c4e77c53f99b354" target="_blank" style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; font-size:16px; line-height:18px; color: #430d71ffe; text-decoration:none;font-weight:normal;border-radius:4px; padding:12px 24px; display:inline-block; border:1px solid #0176d3;"><!--[if mso]>&nbsp;&nbsp;&nbsp;<![endif]-->Get the guide<!--[if mso]>&nbsp;&nbsp;&nbsp;<![endif]--></a></td>
                    
                                        </tr>
                    
                                      </tbody></table>
                    
                                    </td>
                    
                                  </tr>
                    
                                  <!--end Primary-->
                    
                    
                    
                    
                                  <!-- Copy before speakers or stats -->
                    
                                  <tr>
                    
                                    <td align="center" style="padding-top:18px">
                    
                                      <table role="presentation" align="center" width="496" border="0" cellspacing="0" cellpadding="0" style="width:496px" class="w90pc">
                    
                                        <tbody><tr>
                    
                                          <td align="center" style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif;color:#181818;font-size:16px;line-height:24px;font-weight:normal;">
                    
                    
                                            <p style="font-family: \'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color:#181818; font-size:16px;mso-line-height-rule: exactly;line-height:24px;margin: 0 0 16px 0;text-align: left">
                    
                    Customers expect fast and frictionless service. At Salesforce, we rely on Slack to meet and exceed our customers’ expectations. </p>
                    
                    <p style="font-family: \'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color:#181818; font-size:16px;mso-line-height-rule: exactly;line-height:24px;margin: 0 0 16px 0;text-align: left">
                    
                    Learn how our customer service teams use Slack to:</p>
                    
                    <ul style="padding: 0; Margin: 0 0 0 40px;text-align: left">
                    
                    <li style="Margin: 0 0 10px 0;">
                    
                    Spend less time toggling between systems</li>
                    
                    <li style="Margin: 0 0 10px 0;">
                    
                    Speed up ticket resolution times</li>
                    
                    <li style="Margin: 0 0 10px 0;">
                    
                    Collaborate effectively across teams</li>
                    
                    </ul>
                    
                    
                                          </td>
                    
                                        </tr>
                    
                                      </tbody></table>
                    
                                    </td>
                    
                                  </tr>
                    
                                  <tr>
                    
                                    <td align="center" style="padding-top:16px">
                    
                                     <!-- Update width 496/600 narrow/wide -->
                    
                                     <table role="presentation" align="center" width="496" border="0" cellspacing="0" cellpadding="0" style="width:496px" class="w90pc">
                    
                                      <tbody><tr>
                    
                                       <td align="center" style="font-family: \'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color:#181818; font-size:16px;line-height:24px;font-weight: normal">
                    
                                        <p style="font-family:\'SalesforceSansBold\', Helvetica, Arial, sans-serif; color:#032D60;font-size:16px;mso-line-height-rule:exactly;line-height:24px;text-align:left;font-weight:bold;margin:0 0 16px 0;" class="font_normal"><a href="http://click.mail.salesforce.com/?qs=e01ba042319de0302c886748a162c8a9764fff221ba1a262879df53b22bd5fd14c3918f86c498f05df5162c7afe36d98558e59a158173facc4a1f772f34ebad0" target="_blank" style="color:#032D60;text-decoration:none;border-bottom:1px solid #032D60;"><span class="underline">Get the guide</span></a></p>
                    
                                       </td>
                    
                                      </tr>
                    
                                     </tbody></table>
                    
                                    </td>
                    
                                  </tr>
                    
                    
                    
                                </tbody></table>
                    
                                <!--end Primary offer content-->
                    
                              </td>
                    
                            </tr>
                    
                          </tbody></table>
                    
                          <!--end ASPEN-->        
                    
                    
                    
                            <!-- Footer -->
                    
                            <table role="presentation" width="100%" bgcolor="#032d60" border="0" cellspacing="0" cellpadding="0" style="border-top:2px solid #032d60" class="center_iOS">
                    
                              <tbody><tr>
                    
                                <td align="center" valign="top">
                    
                                  <table role="presentation" align="center" cellpadding="0" cellspacing="0" border="0" style="width:648px" class="w100pc">
                    
                                    <tbody><tr>
                    
                                      <td align="center" valign="top" style="padding-top:30px; padding-bottom:40px">
                    
                                        <table role="presentation" width="496" border="0" align="center" cellpadding="0" cellspacing="0" style="width:496px" class="w90pc">
                    
                                          <tbody><tr>
                    
                                            <td align="left" valign="top" style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color: #430d71ffe;font-size: 11px; line-height:13px">
                    
                    
                                             <!--Copyright-->
                    
                                             <p style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color: #430d71ffe;font-size:11px;mso-line-height-rule:exactly;line-height:16px;font-weight: normal;margin:0;">© 2024 Salesforce, Inc. </p>
                    
                                             <!--Address-->
                    
                                              <p style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; color: #430d71ffe;font-size:11px;mso-line-height-rule:exactly;line-height:16px;font-weight: normal;margin:0;">
                    
                                               <span class="mobileLinks">Salesforce Tower, 415 Mission Street, 3rd Floor, San Francisco, CA 94105, United States</span><br>
                    
                                             <!--Contact info-->
                    
                    
                                                General Inquiries: 1-800-NO-SOFTWARE
                    
                                              </p>
                    
                                             <i style="letter-spacing:20px;mso-font-width:-100%;display:inline-block;width:50px;font-size:0px;mso-text-raise:16px;height:16px;"> </i>
                    
                                             <!--Social links-->
                    
                    
                                             <table role="presentation" cellpadding="0" cellspacing="0" border="0" class="w100pc">
                    
                                                <tbody><tr>
                    
                                                  <td align="center">
                    
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="w100pc">
                    
                                                      <tbody><tr>
                    
                                                        <td align="center" valign="middle" style="padding-right:20px" class="pr0"><a href="http://click.mail.salesforce.com/?qs=419f43c0b9a1c839ca83da555961490010161203822569be838c1dab1b35ac122a1a89550490ab547fcffe289a66c3546ce976cbe7e41f6d41ec7b0ac8713d98" target="_blank"><img src="https://image.mail.salesforce.com/lib/fe981c727564047b72/m/1/icon_FB_ff.png" style="display:block; font-family:Helvetica, Arial, sans-serif; font-size:10px; color: #430d71ffe; text-decoration: none;" alt="Facebook" border="0" width="30" height="30"></a></td>
                    
                                                        <td align="center" valign="middle" style="padding-right:20px" class="pr0"><a href="http://click.mail.salesforce.com/?qs=83f84df3fd4b817ba03c2274d41db7c6f918ae4d5ee102e7affc9ef872e6f9832ac243860d04c2e1484b57acd11f370327b9a9ccdfdc5b196b1625a037997d25" target="_blank"><img src="https://image.mail.salesforce.com/lib/fe981c727564047b72/m/1/icon_X_ff.png" style="display:block; font-family:Helvetica, Arial, sans-serif; font-size:10px; color: #430d71ffe; text-decoration: none;" alt="X" border="0" width="30" height="30"></a></td>
                    
                                                        <td align="center" valign="middle" style="padding-right:20px" class="pr0"><a href="http://click.mail.salesforce.com/?qs=f9efd0aeb7117a7692fade742b2b3d89aa93e944205c823157f229e13edbad1db3660c7524eb19927e7eaec055678f309453e3f00ace9f403c631c423a25df35" target="_blank"><img src="https://image.mail.salesforce.com/lib/fe981c727564047b72/m/1/icon_IN_ff.png" style="display:block; font-family:Helvetica, Arial, sans-serif; font-size:10px; color: #430d71ffe; text-decoration: none;" alt="Linkedin" border="0" width="30" height="30"></a></td>
                    
                                                        <td align="center" valign="middle" style="padding-right:20px" class="pr0"><a href="http://click.mail.salesforce.com/?qs=6e9b63947f5cabde0c47da5bbe6b2214a884ca387d8fff5608f7828a269cad4147b87d175cd6d6a94ab54d662ff68aa238d1d1b0aa3270737d0a53e43fb03963" target="_blank"><img src="https://image.mail.salesforce.com/lib/fe981c727564047b72/m/1/icon_IG_ff.png" style="display:block; font-family:Helvetica, Arial, sans-serif; font-size:10px; color: #430d71ffe; text-decoration: none;" alt="Instagram" border="0" width="30" height="30"></a></td>
                    
                                                        <td align="center" valign="middle"><a href="http://click.mail.salesforce.com/?qs=f821a24a1ddb58959848bb3dbc8136b4de2dc946c6f9fbefa533992eb2f3f420f2de6d52a07dacfe5f1efc7163bf951f0a59481890b7ff7df8eb1fa77615c167" target="_blank"><img src="https://image.mail.salesforce.com/lib/fe981c727564047b72/m/1/icon_YT_ff.png" style="display:block; font-family:Helvetica, Arial, sans-serif; font-size:10px; color: #430d71ffe; text-decoration: none;" alt="YouTube" border="0" width="30" height="30"></a></td>
                    
                                                      </tr>
                    
                                                    </tbody></table>
                    
                                                  </td>
                    
                                                </tr>
                    
                                              </tbody></table>
                    
                                             <i style="letter-spacing:20px;mso-font-width:-100%;display:inline-block;width:50px;font-size:0px;mso-text-raise:16px;height:16px;"> </i>
                    
                    
                    
                                             <!--end Social links-->
                    
                                             <!--Email sent to:-->
                    
                                              <p style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; font-size:11px;line-height:16px;color: #430d71ffe;font-weight:normal; margin:0; font-style:italic">This email was sent to <span class="mobileLinks">devmaster322@gmail.com</span></p>
                    
                                             <!--Unsub and privacy-->
                    
                                              <p style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; font-size:11px;line-height:16px;color: #430d71ffe;font-weight: normal; margin:0 0 16px 0;">
                    
                    
                                                    <a href="http://click.mail.salesforce.com/?qs=3b2588ade3b39c99a4cbbda12b7a4df7f0348fb25c2de7c918a73bc688e47d8c9338bda1bf0c9d6690d05f9e9178ff23f7aeb1c6c28520932e607ac58c16b9f8" target="_blank" style="color: #430d71ffe;text-decoration:none;border-bottom: 1px solid #fffffe"><span class="underline">Manage Preferences  or Unsubscribe</span></a> | <a href="http://click.mail.salesforce.com/?qs=1073dc074e9aa75d77b61096811c51158c309d2916fbec60b679261dd09af932b695315d27b12a2a5a3486cd2bd93a9cc60516bf1bc59e3b2a47c587fbcd86c0" target="_blank" style="color: #430d71ffe;text-decoration:none;border-bottom: 1px solid #fffffe;"><span class="underline">Privacy Statement</span></a>
                    
                    
                                               </p>
                    
                    
                                               <!--Marketing Cloud-->
                    
                                              <p style="font-family:\'SalesforceSansRegular\', Salesforce Sans, Helvetica, Arial, sans-serif; font-size:11px;line-height:16px;color: #430d71ffe;font-weight: normal; margin:0;">
                    
                                              Powered by <a href="http://click.mail.salesforce.com/?qs=73a46ac22ae39a4fe9ab8d63871f5434d135f1af215fb8ad3ac2963aa99269af75c96077e00cb557908885a82abaea99392dac0b047821a90231c6b1e02be29c" target="_blank" style="color: #430d71ffe;text-decoration:none;border-bottom: 1px solid #fffffe;"><span class="underline">Salesforce Marketing Cloud</span></a> </p>
                    
                    
                                            </td>
                    
                                          </tr>
                    
                                        </tbody></table>
                    
                                      </td>
                    
                                    </tr>
                    
                                  </tbody></table>
                    
                                </td>
                    
                              </tr>
                    
                            </tbody></table>
                    
                            <!-- end Footer -->
                    
                          </div>
                    
                          <div class="gmailfix" style="white-space:nowrap; font:15px courier; line-height:0;">
                    
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    
                          </div>
                    
                    
                    <img src="http://click.mail.salesforce.com/open.aspx?ffcb10-fe931777746c027f74-fe3316727463067c741177-fe981c727564047b72-ffcd16-fe1d1677776c0c7a7c1477-ff031770756207&amp;d=80115&amp;bmt=0" width="1" height="1" alt="">
                    
                    
                    
                    
                          <style data-ignore-inlining="">@media (prefers-color-scheme: dark) { #_t::before {content:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?rd&d=272887907\');}} @media (prefers-color-scheme: light) { #_t::before {content:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?rl&d=272887907\');}} @media print{ #_t {background-image:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?p&d=272887907\');}} div.OutlookMessageHeader {background-image:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?f&d=272887907\')} table.moz-email-headers-table {background-image:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?f&d=272887907\')} blockquote #_t {background-image:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?f&d=272887907\')} #MailContainerBody #_t {background-image:url(\'https://f5pi3anf.emltrk.com/v2/f5pi3anf?f&d=272887907\')}</style><div id="_t"></div>
                    
                    
                          <img src="https://f5pi3anf.emltrk.com/v2/f5pi3anf?d=272887907" width="1" height="1" border="0" alt="">
                    ','user_id'=>'0'
                    ),
            )
        );
    }
}
