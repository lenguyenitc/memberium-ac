<?php
/* Template Name: Thankyou Bundle Checkout*/
get_header();
global $wpdb, $post;
$post_id = get_the_ID();
$post_page = get_post(get_the_ID());
$post_content = $post_page->post_content;
$user_id = get_current_user_id();
// $WC_Order = wc_get_customer_last_order( $user_id );
// $order_id = $WC_Order->id;
//$entry_id = get_post_meta($order_id,'gform_entry_id',true);
$entry_id = '';
$payment_type = '';
$payment_method = '';
$payment_type = $_GET['payment_type'];
$entry_id = $_GET['entry_id'];
$payment_method = $_GET['payment_method'];

if ($payment_method == 'Paypal') {
  ?>
  <div class="cs_bundle_checkout_thankyou_page" id="append_thankyou_text">
      <p>Order successful! We are preparing your downloads...</p>
      <div id="myProgress">
        <div id="myBar">1%</div>
      </div>
  </div>
  <script type="text/javascript">
    jQuery(window).load(function(){
         //progress bar
             var i = 0;
             if (i == 0) {
              i = 1;
              var elem = document.getElementById("myBar");
              var width = 1;
              var id = setInterval(frame, 600);
              function frame() {
                if (width >= 100) {
                  clearInterval(id);
                  i = 0;
                } else {
                  width++;
                  elem.style.width = width + "%";
                  elem.innerHTML = width  + "%";
                }
              }
            }
            //eND progress bar
      var load = setTimeout(function() {
          var data = {
                  'action': 'get_gform_entry_order_id',
                  'entry_id': '<?php echo $_GET['entry_id']; ?>',
                  'post_id': '<?php echo $post_id; ?>',
                 };
          jQuery.ajax({
              type: 'post',
              url: '<?php echo admin_url('admin-ajax.php'); ?>',
              data: data,
              beforeSend: function(){
              },
               success: function(response){
                console.log(response,'test');
                jQuery('#append_thankyou_text').html('');
                jQuery('#append_thankyou_text').html(response);
               }
            });

      }, 60000);


   });
  </script>
   <style>
    #myProgress {
      width: 50%;
      background-color: #ddd;
      left: 0;
      right: 0;
      margin: 20px auto;
    }

    #myBar {
      width: 1%;
      height: 30px;
      background-color: #00c1a7;
      text-align: center;
      line-height: 30px;
      color: white;
    }
   </style>
  <?php
} else {
  ?>
  <div class="cs_bundle_checkout_thankyou_page" id="append_thankyou_text">
      <p>Loading please wait...</p>
      <div class="loading"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
  </div>
  <script type="text/javascript">
    jQuery(window).load(function(){
      var data = {
                  'action': 'get_gform_entry_order_id',
                  'entry_id': '<?php echo $_GET['entry_id']; ?>',
                  'post_id': '<?php echo $post_id; ?>',
                 };
    jQuery.ajax({
              type: 'post',
              url: '<?php echo admin_url('admin-ajax.php'); ?>',
              data: data,
              beforeSend: function(){

              },
               success: function(response){
                console.log(response,'test');
                jQuery('#append_thankyou_text').html('');
                jQuery('#append_thankyou_text').html(response);
               }
            });
   });
  </script>
  <?php
}

?>
<?php
$disable_license_text = get_post_meta($_GET['mypage_id'], 'csmultiplecheckout_disable_license_text', true); 
if (!empty($disable_license_text)) { ?>
  <style>
    .cs_bundle_checkout_thankyou_page h3 {
      display: none;
    }
  </style>
<?php } ?>
<style>
  @media only screen and (max-width: 767px){
    .cs_bundle_checkout_thankyou_page {
    padding: 100px 20px !important;
    }
   .cs_bundle_checkout_thankyou_page h2 {
      font-size: 28px !important;
   }

   .cs_bundle_checkout_thankyou_page h4 {
    font-size: 25px !important;
   }

   .cs_bundle_checkout_thankyou_page h3{
      font-size:18px;
      line-height:28px;
   }

   .cs_bundle_checkout_thankyou_page p{
      font-size:18px;
      line-height:26px;
   }

   a.bundle_download_redirect_btn{
     font-size:15px !important;
     padding:9px 27px!important;
     max-width:350px;
   }

}

.cs_bundle_checkout_thankyou_page#append_thankyou_text {
    color: #fff;
}
  .cs_bundle_checkout_thankyou_page h2 {
    text-transform: capitalize;
    font-size: 28px;
    font-weight: 700;
    line-height: 38px;
}

.cs_bundle_checkout_thankyou_page h3 {
    font-size: 20px;
    color: #fff;
}

.cs_bundle_checkout_thankyou_page p {
    font-size: 20px;
    line-height: 34px;
}

.cs_bundle_checkout_thankyou_page a.bundle_download_redirect_btn  {
    color: rgb(255, 255, 255);
    font-weight: 600;
    background-color: rgb(28, 186, 164);
    font-size: 16px;
    width: 100%;
    padding: 16px 35px!important;
    margin: 25px auto;
    max-width: 400px;
    font-family:'Gotham Bold', Arial, sans-serif;
    border-radius: 50px;
    box-shadow:inset 0 1px 0 rgba(255,255,255,0.2);
    border: 1px solid rgba(0,0,0,0.2);
}

 .cs_bundle_checkout_thankyou_page a.bundle_download_redirect_btn:hover{
     box-shadow: inset 0 2px 2px 0 rgba(255,255,255,0.22), 0 233px 233px 0 rgba(255,255,255,0.12) inset;
}

.cs_bundle_checkout_thankyou_page p{
  font-size:20px !important;
}
  .cs_bundle_checkout_thankyou_page .loading i.fa.fa-spinner.fa-pulse.fa-3x.fa-fw {
    top: 0 !important;
  }
  .cs_bundle_checkout_thankyou_page .loading {
    opacity: 1 !important;
    text-align: center;
    left: 0;
    right: 0;
  }
.cs_bundle_checkout_thankyou_page h4 {
  color: #fff;
  font-size: 28px;
  line-height: 38px;
  margin-bottom: 15px !important;
}
.cs_bundle_checkout_thankyou_page {
    width: 100%;
    text-align: center;
    padding: 100px 0;
    background: linear-gradient(93.3deg, rgba(24, 33, 122, 0) 21.81%, #01BFA6 110.69%), linear-gradient(105.48deg, #000000 0.44%, #848DEA 185.57%);
}
.cs_bundle_checkout_thankyou_page p {
    font-size: 16px;
}
.cs_bundle_checkout_thankyou_page p.bunlde_thnk_support_para{
  line-height:30px !important;
  font-size: 16px !important;
}
</style>
<?php
get_footer();
?>