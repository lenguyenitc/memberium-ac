<?php 
/*
	Template Name: Contact us
*/
?>
<?php get_header(); ?>
<style>
</style>
<?php
 if(isset($_POST['submitted'])) {
    if(trim($_POST['first_name']) === '') {
        $FirstError = 'The field is required.';
        $hasError = true;
    } else {
        $first_name = trim($_POST['first_name']);
    }
    if(trim($_POST['last_name']) === '') {
        $LastError = 'The field is required.';
        $hasError = true;
    } else {
        $last_name = trim($_POST['last_name']);
    }
     if(trim($_POST['email']) === '')  {
        $EmailError = 'The field is required.';
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $EmailError = 'The e-mail address entered is invalid.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
 
    if(trim($_POST['sound_cloud']) === '') {
        $SoundError = 'The field is required.';
        $hasError = true;
    } else {
        $sound_cloud = trim($_POST['sound_cloud']);
    }

    if(trim($_POST['price']) === '') {
        $PriceError = 'The field is required.';
        $hasError = true;
    } else {
        $price = trim($_POST['price']);
    }

    if(trim($_POST['daw']) === '') {
        $DAWError = 'The field is required.';
        $hasError = true;
    } else {
        $daw = trim($_POST['daw']);
    }
    if(trim($_POST['language']) === '') {
        $DAWError = 'The field is required.';
        $hasError = true;
    } else {
        $language = trim($_POST['language']);
    }
 
    if(trim($_POST['message']) === '') {
        $commentError = 'The field is required.';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['message']));
        } else {
            $comments = trim($_POST['message']);
        }
    }
 
    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = 'Message from '.$name;
        $body = "First Name: $first_name \n\nLast Name: $last_name \n\nE-mail: $email \n\nLanguage: $language \n\nDAW: $daw \n\nSound Cloud: $sound_cloud \n\nMessage: $comments";
        $headers = 'From: '.$first_name.' '.$last_name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }
 
} ?>

<section id="pContact">

  <div class="banner"></div>
  <div style="height: 150px;margin-top: -198px;" id="samplepacks">
        <h2 style="border:none"><span style="background:transparent;"><?php the_title(); ?></span></h2>
    </div>

  <div  class="contact-wrap">
<?php if(isset($emailSent) && $emailSent == true) { ?>
         <div class="contact_message">Thank you for your message. It has been sent.</div>
   <?php } else { ?>
         <?php if(isset($hasError) || isset($captchaError)) { ?>

         <?php } ?>
    <ul class="tab-contain js-tab--contact">
      <li class="selected"><span>Business Inquiries</span></li>
    </ul>
    <div class="contain js-contain--contact">
      <div class="business show" style="display: block; opacity: 1;">
        <p><img src="<?php bloginfo('template_url') ?>/images/i-business.png"></p>
        <p>For Business Inquiries, please email us at <a href="mailto:inquiries@unison.audio">inquiries@unison.audio</a></p>
      </div>
      <!-- <div class="application" style="display: none;">   
        <form class="frmContact" action="<?php the_permalink(); ?>" method="POST">
        <div class="form">
          <div class="ctr"><p>Get started by filling out the information below</p></div>
          <div class="ctr">
            <p><input  name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>" placeholder="First name" type="text"></p>
            <?php if($FirstError != '') { ?>
            <div class="errors"><?=$FirstError;?></div>
            <?php } ?>
            <p><input name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>" placeholder="Last name" type="text"></p>
            <?php if($LastError != '') { ?>
            <div class="errors"><?=$LastError;?></div>
            <?php } ?>
          </div>

          <div class="ctr">
            <p><input name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder="Email Address" type="text"></p>
            <?php if($EmailError != '') { ?>
            <div class="errors"><?=$EmailError;?></div>
            <?php } ?>
            <p><input name="language" value="<?php if(isset($_POST['language'])) echo $_POST['language'];?>" placeholder="Language" type="text"></p>
            <?php if($LngError != '') { ?>
            <div class="errors"><?=$LngError;?></div>
            <?php } ?>

          </div>

          <div class="ctr">
            <div class="dropdown locations">
              <select class="default-usage-select" placeholder="Country" name="location">
                <option class="option1"  id="93" value="Afghanistan">Country</option>
                <option class="option1"  id="93" value="Afghanistan">Afghanistan</option>
                <option class="option1"  id="355" value="Albania">Albania</option>
                <option class="option1"  id="213" value="Algeria">Algeria</option>
                <option class="option1"  id="1684" value="American Samoa">American Samoa</option>
                <option class="option1"  id="376" value="Andorra">Andorra</option>
                <option class="option1"  id="244" value="Angola">Angola</option>
                <option class="option1"  id="1264" value="Anguilla">Anguilla</option>
                <option class="option1"  id="1268" value="Antigua And Barbuda">Antigua And Barbuda</option>
                <option class="option1"  id="54" value="Argentina">Argentina</option>
                <option class="option1"  id="374" value="Armenia">Armenia</option>
                <option class="option1"  id="297" value="Aruba">Aruba</option>
                <option class="option1"  id="61" value="Australia">Australia</option>
                <option class="option1"  id="43" value="Austria">Austria</option>
                <option class="option1"  id="994" value="Azerbaijan">Azerbaijan</option>
                <option class="option1"  id="1242" value="Bahamas The">Bahamas The</option>
                <option class="option1"  id="973" value="Bahrain">Bahrain</option>
                <option class="option1"  id="880" value="Bangladesh">Bangladesh</option>
                <option class="option1"  id="1246" value="Barbados">Barbados</option>
                <option class="option1"  id="375" value="Belarus">Belarus</option>
                <option class="option1"  id="32" value="Belgium">Belgium</option>
                <option class="option1"  id="501" value="Belize">Belize</option>
                <option class="option1"  id="229" value="Benin">Benin</option>
                <option class="option1"  id="1441" value="Bermuda">Bermuda</option>
                <option class="option1"  id="975" value="Bhutan">Bhutan</option>
                <option class="option1"  id="591" value="Bolivia">Bolivia</option>
                <option class="option1"  id="387" value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option class="option1"  id="267" value="Botswana">Botswana</option>
                <option class="option1"  id="55" value="Brazil">Brazil</option>
                <option class="option1"  id="246" value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option class="option1"  id="673" value="Brunei">Brunei</option>
                <option class="option1"  id="359" value="Bulgaria">Bulgaria</option>
                <option class="option1"  id="226" value="Burkina Faso">Burkina Faso</option>
                <option class="option1"  id="257" value="Burundi">Burundi</option>
                <option class="option1"  id="855" value="Cambodia">Cambodia</option>
                <option class="option1"  id="237" value="Cameroon">Cameroon</option>
                <option class="option1"  id="1" value="Canada">Canada</option>
                <option class="option1"  id="238" value="Cape Verde">Cape Verde</option>
                <option class="option1"  id="1345" value="Cayman Islands">Cayman Islands</option>
                <option class="option1"  id="236" value="Central African Republic">Central African Republic</option>
                <option class="option1"  id="235" value="Chad">Chad</option>
                <option class="option1"  id="56" value="Chile">Chile</option>
                <option class="option1"  id="86" value="China">China</option>
                <option class="option1"  id="61" value="Christmas Island">Christmas Island</option>
                <option class="option1"  id="672" value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option class="option1"  id="57" value="Colombia">Colombia</option>
                <option class="option1"  id="269" value="Comoros">Comoros</option>
                <option class="option1"  id="242" value="Congo">Congo</option>
                <option class="option1"  id="242" value="Congo The Democratic Republic Of The">Congo The Democratic Republic Of The</option>
                <option class="option1"  id="682" value="Cook Islands">Cook Islands</option>
                <option class="option1"  id="506" value="Costa Rica">Costa Rica</option>
                <option class="option1"  id="225" value="Cote D'Ivoire (Ivory Coast)">Cote D'Ivoire (Ivory Coast)</option>
                <option class="option1"  id="385" value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                <option class="option1"  id="53" value="Cuba">Cuba</option>
                <option class="option1"  id="357" value="Cyprus">Cyprus</option>
                <option class="option1"  id="420" value="Czech Republic">Czech Republic</option>
                <option class="option1"  id="45" value="Denmark">Denmark</option>
                <option class="option1"  id="253" value="Djibouti">Djibouti</option>
                <option class="option1"  id="1767" value="Dominica">Dominica</option>
                <option class="option1"  id="1809" value="Dominican Republic">Dominican Republic</option>
                <option class="option1"  id="593" value="Ecuador">Ecuador</option>
                <option class="option1"  id="20" value="Egypt">Egypt</option>
                <option class="option1"  id="503" value="El Salvador">El Salvador</option>
                <option class="option1"  id="240" value="Equatorial Guinea">Equatorial Guinea</option>
                <option class="option1"  id="291" value="Eritrea">Eritrea</option>
                <option class="option1"  id="372" value="Estonia">Estonia</option>
                <option class="option1"  id="251" value="Ethiopia">Ethiopia</option>
                <option class="option1"  id="500" value="Falkland Islands">Falkland Islands</option>
                <option class="option1"  id="298" value="Faroe Islands">Faroe Islands</option>
                <option class="option1"  id="679" value="Fiji Islands">Fiji Islands</option>
                <option class="option1"  id="358" value="Finland">Finland</option>
                <option class="option1"  id="33" value="France">France</option>
                <option class="option1"  id="594" value="French Guiana">French Guiana</option>
                <option class="option1"  id="689" value="French Polynesia">French Polynesia</option>
                <option class="option1"  id="241" value="Gabon">Gabon</option>
                <option class="option1"  id="220" value="Gambia The">Gambia The</option>
                <option class="option1"  id="995" value="Georgia">Georgia</option>
                <option class="option1"  id="49" value="Germany">Germany</option>
                <option class="option1"  id="233" value="Ghana">Ghana</option>
                <option class="option1"  id="350" value="Gibraltar">Gibraltar</option>
                <option class="option1"  id="30" value="Greece">Greece</option>
                <option class="option1"  id="299" value="Greenland">Greenland</option>
                <option class="option1"  id="1473" value="Grenada">Grenada</option>
                <option class="option1"  id="590" value="Guadeloupe">Guadeloupe</option>
                <option class="option1"  id="1671" value="Guam">Guam</option>
                <option class="option1"  id="502" value="Guatemala">Guatemala</option>
                <option class="option1"  id="224" value="Guinea">Guinea</option>
                <option class="option1"  id="245" value="Guinea-Bissau">Guinea-Bissau</option>
                <option class="option1"  id="592" value="Guyana">Guyana</option>
                <option class="option1"  id="509" value="Haiti">Haiti</option>
                <option class="option1"  id="504" value="Honduras">Honduras</option>
                <option class="option1"  id="852" value="Hong Kong S.A.R">Hong Kong S.A.R.</option>
                <option class="option1"  id="36" value="Hungary">Hungary</option>
                <option class="option1"  id="354" value="Iceland">Iceland</option>
                <option class="option1"  id="91" value="India">India</option>
                <option class="option1"  id="62" value="Indonesia">Indonesia</option>
                <option class="option1"  id="98" value="Iran">Iran</option>
                <option class="option1"  id="964" value="Iraq">Iraq</option>
                <option class="option1"  id="353" value="Ireland">Ireland</option>
                <option class="option1"  id="972" value="Israel">Israel</option>
                <option class="option1"  id="39" value="Italy">Italy</option>
                <option class="option1"  id="1876" value="Jamaica">Jamaica</option>
                <option class="option1"  id="81" value="Japan">Japan</option>
                <option class="option1"  id="962" value="Jordan">Jordan</option>
                <option class="option1"  id="7" value="Kazakhstan">Kazakhstan</option>
                <option class="option1"  id="254" value="Kenya">Kenya</option>
                <option class="option1"  id="686" value="Kiribati">Kiribati</option>
                <option class="option1"  id="850" value="Korea North">Korea North</option>
                <option class="option1"  id="82" value="Korea South">Korea South</option>
                <option class="option1"  id="965" value="Kuwait">Kuwait</option>
                <option class="option1"  id="996" value="Kyrgyzstan">Kyrgyzstan</option>
                <option class="option1"  id="856" value="Laos">Laos</option>
                <option class="option1"  id="371" value="Latvia">Latvia</option>
                <option class="option1"  id="961" value="Lebanon">Lebanon</option>
                <option class="option1"  id="266" value="Lesotho">Lesotho</option>
                <option class="option1"  id="231" value="Liberia">Liberia</option>
                <option class="option1"  id="218" value="Libya">Libya</option>
                <option class="option1"  id="423" value="Liechtenstein">Liechtenstein</option>
                <option class="option1"  id="370" value="Lithuania">Lithuania</option>
                <option class="option1"  id="352" value="Luxembourg">Luxembourg</option>
                <option class="option1"  id="853" value="Macau S.A.R">Macau S.A.R.</option>
                <option class="option1"  id="389" value="Macedonia">Macedonia</option>
                <option class="option1"  id="261" value="Madagascar">Madagascar</option>
                <option class="option1"  id="265" value="Malawi">Malawi</option>
                <option class="option1"  id="60" value="Malaysia">Malaysia</option>
                <option class="option1"  id="960" value="Maldives">Maldives</option>
                <option class="option1"  id="223" value="Mali">Mali</option>
                <option class="option1"  id="356" value="Malta">Malta</option>
                <option class="option1"  id="692" value="Marshall Islands">Marshall Islands</option>
                <option class="option1"  id="596" value="Martinique">Martinique</option>
                <option class="option1"  id="222" value="Mauritania">Mauritania</option>
                <option class="option1"  id="230" value="Mauritius">Mauritius</option>
                <option class="option1"  id="269" value="Mayotte">Mayotte</option>
                <option class="option1"  id="52" value="Mexico">Mexico</option>
                <option class="option1"  id="691" value="Micronesia">Micronesia</option>
                <option class="option1"  id="373" value="Moldova">Moldova</option>
                <option class="option1"  id="377" value="Monaco">Monaco</option>
                <option class="option1"  id="976" value="Mongolia">Mongolia</option>
                <option class="option1"  id="1664" value="Montserrat">Montserrat</option>
                <option class="option1"  id="212" value="Morocco">Morocco</option>
                <option class="option1"  id="258" value="Mozambique">Mozambique</option>
                <option class="option1"  id="95" value="Myanmar">Myanmar</option>
                <option class="option1"  id="264" value="Namibia">Namibia</option>
                <option class="option1"  id="674" value="Nauru">Nauru</option>
                <option class="option1"  id="977" value="Nepal">Nepal</option>
                <option class="option1"  id="599" value=">Netherlands Antilles">Netherlands Antilles</option>
                <option class="option1"  id="31" value="Netherlands The">Netherlands The</option>
                <option class="option1"  id="687" value="New Caledonia">New Caledonia</option>
                <option class="option1"  id="64" value=">New Zealand">New Zealand</option>
                <option class="option1"  id="505" value="Nicaragua">Nicaragua</option>
                <option class="option1"  id="227" value="Niger">Niger</option>
                <option class="option1"  id="234" value="Nigeria">Nigeria</option>
                <option class="option1"  id="683" value="Niue">Niue</option>
                <option class="option1"  id="672" value="Norfolk Island">Norfolk Island</option>
                <option class="option1"  id="1670" value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option class="option1"  id="47" value="Norway">Norway</option>
                <option class="option1"  id="968" value="Oman">Oman</option>
                <option class="option1"  id="92" value="Pakistan">Pakistan</option>
                <option class="option1"  id="680" value="Palau">Palau</option>
                <option class="option1"  id="970" value="Palestinian Territory Occupied">Palestinian Territory Occupied</option>
                <option class="option1"  id="507" value="Panama">Panama</option>
                <option class="option1"  id="675" value=">Papua new Guinea">Papua new Guinea</option>
                <option class="option1"  id="595" value="Paraguay">Paraguay</option>
                <option class="option1"  id="51" value="Peru">Peru</option>
                <option class="option1"  id="63" value="Philippines">Philippines</option>
                <option class="option1"  id="48" value="Poland">Poland</option>
                <option class="option1"  id="351" value="Portugal">Portugal</option>
                <option class="option1"  id="1787" value="Puerto Rico">Puerto Rico</option>
                <option class="option1"  id="974" value="Qatar">Qatar</option>
                <option class="option1"  id="262" value="Reunion">Reunion</option>
                <option class="option1"  id="40" value="Romania">Romania</option>
                <option class="option1"  id="70" value="Russia">Russia</option>
                <option class="option1"  id="250" value="Rwanda">Rwanda</option>
                <option class="option1"  id="290" value="Saint Helena">Saint Helena</option>
                <option class="option1"  id="1869" value=">Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                <option class="option1"  id="1758" value="Saint Lucia">Saint Lucia</option>
                <option class="option1"  id="508" value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option class="option1"  id="1784" value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                <option class="option1"  id="684" value="Samoa">Samoa</option>
                <option class="option1"  id="378" value="San Marino">San Marino</option>
                <option class="option1"  id="239" value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option class="option1"  id="966" value="Saudi Arabia">Saudi Arabia</option>
                <option class="option1"  id="221" value="Senegal">Senegal</option>
                <option class="option1"  id="248" value="Seychelles">Seychelles</option>
                <option class="option1"  id="232" value="Sierra Leone">Sierra Leone</option>
                <option class="option1"  id="65" value="Singapore">Singapore</option>
                <option class="option1"  id="421" value="Slovakia">Slovakia</option>
                <option class="option1"  id="386" value="Slovenia">Slovenia</option>
                <option class="option1"  id="677" value="Solomon Islands">Solomon Islands</option>
                <option class="option1"  id="252" value="Somalia">Somalia</option>
                <option class="option1"  id="27" value="South Africa">South Africa</option>
                <option class="option1"  id="34" value="Spain">Spain</option>
                <option class="option1"  id="94" value="Sri Lanka">Sri Lanka</option>
                <option class="option1"  id="249" value="Sudan">Sudan</option>
                <option class="option1"  id="597" value="Suriname">Suriname</option>
                <option class="option1"  id="47" value="Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>
                <option class="option1"  id="268" value="Swaziland">Swaziland</option>
                <option class="option1"  id="46" value="Sweden">Sweden</option>
                <option class="option1"  id="41" value="Switzerland">Switzerland</option>
                <option class="option1"  id="963" value="Syria">Syria</option>
                <option class="option1"  id="886" value="Taiwan">Taiwan</option>
                <option class="option1"  id="992" value="Tajikistan">Tajikistan</option>
                <option class="option1"  id="255" value="Tanzania">Tanzania</option>
                <option class="option1"  id="66" value="Thailand">Thailand</option>
                <option class="option1"  id="228" value="Togo">Togo</option>
                <option class="option1"  id="690" value="Tokelau">Tokelau</option>
                <option class="option1"  id="676" value="Tonga">Tonga</option>
                <option class="option1"  id="1868" value=">Trinidad And Tobago">Trinidad And Tobago</option>
                <option class="option1"  id="216" value="Tunisia">Tunisia</option>
                <option class="option1"  id="90" value="Turkey">Turkey</option>
                <option class="option1"  id="7370" value="Turkmenistan">Turkmenistan</option>
                <option class="option1"  id="1649" value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                <option class="option1"  id="688" value="Tuvalu">Tuvalu</option>
                <option class="option1"  id="256" value="Uganda">Uganda</option>
                <option class="option1"  id="380" value="Ukraine">Ukraine</option>
                <option class="option1"  id="971" value="United Arab Emirates">United Arab Emirates</option>
                <option class="option1"  id="44" value="United Kingdom">United Kingdom</option>
                <option class="option1"  id="1" value="United States">United States</option>
                <option class="option1"  id="598" value="Uruguay">Uruguay</option>
                <option class="option1"  id="998" value="Uzbekistan">Uzbekistan</option>
                <option class="option1"  id="678" value="Vanuatu">Vanuatu</option>
                <option class="option1"  id="39" value=">Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                <option class="option1"  id="58" value="Venezuela">Venezuela</option>
                <option class="option1"  id="84" value="Vietnam">Vietnam</option>
                <option class="option1"  id="1284" value="Virgin Islands (British">Virgin Islands (British)</option>
                <option class="option1"  id="1340" value="Virgin Islands (US)">Virgin Islands (US)</option>
                <option class="option1"  id="681" value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                <option class="option1"  id="212" value="Western Sahara">Western Sahara</option>
                <option class="option1"  id="967" value="Yemen">Yemen</option>
                <option class="option1"  id="260" value="Zambia">Zambia</option>
                <option class="option1"  id="263" value="Zimbabwe">Zimbabwe</option>
            </select>
            </div>
            <p><input name="daw" value="<?php if(isset($_POST['daw'])) echo $_POST['daw'];?>" placeholder="DAW" type="text"></p>
            <?php if($DAWError != '') { ?>
            <div class="errors"><?=$DAWError;?></div>
            <?php } ?>
          </div>

          <div class="ctr">
            <p><input name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price'];?>" class="js-number" placeholder="Desired Price Per Hour" type="text"></p>
            <?php if($PriceError != '') { ?>
            <div class="errors"><?=$PriceError;?></div>
            <?php } ?>
            <p><input name="sound_cloud" value="<?php if(isset($_POST['sound_cloud'])) echo $_POST['sound_cloud'];?>" placeholder="SoundCloud Link" type="text"></p>
            <?php if($SoundError != '') { ?>
            <div class="errors"><?=$SoundError;?></div>
            <?php } ?>
          </div>

          

          <div class="ctr">
            <textarea name="message" placeholder="Comments"></textarea>
            <?php if($commentError != '') { ?>
            <div class="errors"><?=$commentError;?></div>
            <?php } ?>
          </div>

          <div class="ctr">
            <input value="Send" class="btn js-btn-contact" type="submit">
            <button type="contsubmit" class="btn">Send</button>
<input type="hidden" name="submitted" id="submitted" value="true" />
          </div>


          <div class="dropdown">
            <select class="default-usage-select" id="" name="" onChange="">
              <option class="option1"  value="newest">Country</option>
            </select>
          </div> 
        </div>
        </form>
        <?php } ?>
      </div> -->
    </div>
  </div>
</section>
<?php get_footer(); ?>