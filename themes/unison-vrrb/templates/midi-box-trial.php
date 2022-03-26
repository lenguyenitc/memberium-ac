<?php
/*
 * Template Name: Midi Box Trail
 *
 * */

get_header('cart');
global $post;
$user_id = get_current_user_id();
if(!empty($user_id)){
    $users_subscriptions = wcs_get_users_subscriptions($user_id);
    if(!empty($users_subscriptions)){
        $url = '/my-account/downloads';
        echo '<script type="text/javascript">
           window.location = "/my-account/downloads"
      </script>';
        // foreach ($users_subscriptions as $subscription) {
        //     if ($subscription->has_status(array('active'))) {

        //     }
        // }
    }
}
$loop = new WP_Query(array(
    'post_type' => array('product', 'product_variation'),
    'posts_per_page' => -1)
);

$main_parent_id = '';
$trial_parent_id = '';

foreach($loop->posts as $loops){
    if($loops->post_name == 'midi-box-sub'){
        $main_parent_id = $loops->ID;
    }
    if ($loops->post_name == 'midi-box-sub-trial') {
        $trial_parent_id = $loops->ID; 
    }
}


?>

<style>
    html {
        margin-top: 0px !important;
    }
    .color-teal {
        color: rgb(45, 218, 191);
    }
    .desktop-nav .navbar.navbar-collapse,
    .mobile-nav .navbar.navbar-collapse {
        display: none;
    }
</style>

<!-- Main -->
<main class="flex-grow-1 midi-box-page custom1">
    <!-- SECTION ONE -->
    <section class="midi-box-section bg-white title-section pt-4">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-9 col-xxxl-8 mx-auto p-0 pl-lg-3 pr-lg-3">
                <div class="text-center text-dark">
                    <h4 class="text-dark pb-4">The <span class="color-teal"> Ultimate Shortcut </span>To Producing Hit Songs Every Single Month
                    </h4>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-11 mx-auto">
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/ncijjx0jht?videoFoam=true" title="MIDI Box VSL Full Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="100%" height="100%"></iframe></div></div>
                        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
                    </div>
                    <div class="pt-4 col-xxxl-11 pl-lg-1 pl-xl-1 pl-xxl-0 p-0 mx-auto">
                        <div class="row">
                            <div class="col-lg-6 offer-item" style="display: flex; flex-direction: row; text-align: left;">
                                <div class="mr-check">
                                    <i class="fa fa-check color-teal"></i>
                                </div>
                                <div>
                                        <span class="font-weight-bold">
                                    <span class="color-teal">Consistently Create Hit-Worthy Tracks</span> with up to 800 new & unique MIDI files every month
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-6 offer-item" style="display: flex; flex-direction: row; text-align: left;">
                                <div class="mr-check">
                                    <i class="fa fa-check  color-teal"></i>
                                </div>
                                <div>
                                    <span class="font-weight-bold">
                                        <span class="color-teal">Gain An Unfair Competitive Advantage</span> by getting insider access to never-before-released MIDI's every month
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 offer-item" style="display: flex; flex-direction: row; text-align: left; ">
                                <div class="mr-check">
                                    <i class="fa fa-check color-teal"></i>
                                </div>
                                <div>
                                        <span class="font-weight-bold">
                                            <span class="color-teal">Get Your Tracks Played On Repeat</span> with pro-level chord progressions, catchy melodies, groovy basslines & perfect drum kits
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-6 offer-item" style="display: flex; flex-direction: row; text-align: left;">
                                <div class="mr-check">
                                    <i class="fa fa-check color-teal"></i>
                                </div>
                                <div>
                                        <span class="font-weight-bold">
                                            <span class="color-teal">Eliminate Guesswork, Self doubt And Ovewhelm</span> from your creative process so you can just focus on producing great music.
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-6 offer-item" style="display: flex; flex-direction: row; text-align: left;">
                                <div class="mr-check">
                                    <i class="fa fa-check color-teal"></i>
                                </div>
                                <div>
                                        <span class="font-weight-bold">
                                            <span class="color-teal">Destroy 'Producer's Block' For Good</span> so you can get unstuck and skyrocket your track-finishing ability
                                        </span>
                                </div>
                            </div>

                            <div class="offer-item col-lg-6" style="display: flex; flex-direction: row; text-align: left; ">
                                <div class="mr-check">
                                    <i class="fa fa-check  color-teal"></i>
                                </div>
                                <div>
                                        <span class="font-weight-bold">
                                            <span class="color-teal">Custom-Curated For You</span> no need to waste hours searching, sifting or checking quality
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-xl-6 col-xxl-6 text-center mx-auto p-0">
                        <!-- BUTTON WHITE TEXT BLUE SHADOW-->
                        <a href="#midi-box-pricing" rel="noopener noreferrer">
                            <div class="text-center mx-auto bg-success button-green-glow">
                                    <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                <span class="font-weight-bold" style="font-size: 12px;color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION ONE -->
    <!-- SECTION TWO -->
    <section class="four-key-element pt-0 pb-0">
        <img src="<?php bloginfo('template_url') ?>/assets/images/Layer36White.png" class="img-fluid w-100 pt-0 mt-0" style="position: relative; top: -2px;">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10 col-xxxl-9 mx-auto p-0">
                <div class="row mx-auto">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 mx-auto p-0">
                        <div class="d-flex flex-column-reverse flex-lg-row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 mx-auto mt-3 mb-4 d-flex flex-column  pr-0">
                                <h4 class="d-inline-block">What Are The <b class=" color-teal">4 Key Elements</b> Of A Hit Song?</h4>
                                <p>You've <b class="color-teal">probably been told</b> that in order to produce a hit song....</p> 
                                <p>You need to <b class="color-teal">learn music theory, buy fancy studio gear,</b> spend years producing or use special mixing & mastering techniques.</p>
                                <p>But this <b class="color-teal">couldn't be further from the truth.</b></p>
                                <p>That's because while all these things can help, they're <b class="color-teal">less than 5% of the equation.</b></p> 
                                <p>And in reality, <b class="color-teal">producing a hit song</b> that gets millions of plays actually comes down to just <b class="color-teal">4 simple elements:</b></p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-5 mx-auto mt-3 mb-4 p-0 pl-lg-3 pr-lg-3">
                                <img class="img-fluid img-opacity" src="<?php bloginfo('template_url') ?>/assets/images/hot100.png" alt="Bilbord-hot 100">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 p-0 p-lg-3">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 my-3">
                                    <div class="newCard-box bg-opacity">
                                        <div class="row text-center">
                                            <div class="col p-0">
                                                <div class="col-xl-8 col-sm-6 col-md-8 pt-0 mx-auto">
                                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Piano_01.png" class="img-fluid" style='max-height: 200px' alt="Audio Piano">
                                                </div>
                                                <h5 class="pt-3">1. Chord Progression</h5>
                                                <p class="card-text text-center p1">Your <b class="color-teal">chord progression serves as the foundation</b> for your track... And if you build anything off a flawed foundation, it's setup for failure from the get-go. By <b class="color-teal">unique, memorable and proven chord progressions</b> – you guarantee your <b class="color-teal">unique, memorable and proven chord progressions</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 my-3">
                                    <div class="newCard-box bg-opacity">
                                        <div class="row text-center">
                                            <div class="col p-0">
                                                <div class="col-xl-8 col-sm-6 col-md-8 pt-0 mx-auto">
                                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Clef_01.png" class="img-fluid" style='max-height: 200px' alt="Audio Clef">
                                                </div>
                                                <h5 class="pt-3">2. Melody</h5>
                                                <p class="card-text text-center p1">After your chord progression is laid down, <b class="color-teal">you need a</b> <b class="color-teal">catchy, relatable melody.</b> The quality of your melody will will <b class="color-teal">make the difference</b> <b class="color-teal">between people deciding to turn off your track instantly</b>, listen to it once or listen to it several times. This is how you <b class="color-teal">get your songs viral.</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 my-3">
                                    <div class="newCard-box bg-opacity">
                                        <div class="row text-center">
                                            <div class="col p-0">
                                                <div class="col-xl-8 col-sm-6 col-md-8 pt-0 mx-auto">
                                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Subwoofer_01.png" class="img-fluid" style='max-height: 200px' alt="Audio Subwoofer">
                                                </div>
                                                <h5 class="mt-4">3. Bassline</h5>
                                                <p class="card-text text-center">After <b class="color-teal">capturing the attention and emotions</b> of your listeners with your chord progression and melody... You need to <b class="color-teal">get their bodies moving with your bassline.</b> If your bassline is good, you'll <b class="color-teal">keep them listening, engaged,</b> and you'll <b class="color-teal">make your music unforgettable.</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 my-3">
                                    <div class="newCard-box bg-opacity">
                                        <div class="row text-center">
                                            <div class="col p-0">
                                                <div class="col-xl-8 col-sm-8 col-md-8 pt-0 mx-auto">
                                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Tom_01.png" class="img-fluid" style='max-height: 200px ' alt="Audio Tom">
                                                </div>
                                                <h5 class="mt-4">4. Drum Groove</h5>
                                                <p class="card-text text-center p1">Finally, you'll need a <b class="color-teal">perfect drum groove to gel your track together and make it sound complete. </b> Getting your drum groove wrong can ruin your whole track... But if you <b class="color-teal">get it just right, along with the other 3 elements...</b> That's when your track has <b class="color-teal">everything it takes to become a big hit.</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION TWO -->
    <!-- SECTION THREE -->
    <section class="sky-rocket-section midi-box-section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10 col-xxxl-9 mx-auto">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 col-xl-6  mx-auto">
                            <div class="studio-img mx-auto"> </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 col-xl-6 mb-4 ml-5 mx-auto">
                            <h4 class="d-inline-block">If You Nail These 4 Elements, Your Chances Of <b class="color-teal">Making A Hit</b> Skyrocket...</h4>
                            <div class='text-white font-weight-bold'>
                                <p>To the point that <b class="color-teal">all the other things</b> most producers think are important – <b class="color-teal">don't matter at all.</b></p>
                                <p>That's why <b class="color-teal">so many hit songs don't have the best mixing</b>, sound design, or mastering...</p>
                                <p>But <b class="color-teal">because the chord progression, melody, bassline and drum groove</b> are so good – none of that stuff is necessary to get <b class="color-teal">millions of plays.</b></p>
                                <p>Which means, you can <b class="color-teal">bypass the steep learning curve</b> of the 'technical side' of music production...</p>
                                <p>By simply <b class="color-teal">laser-focussing on the highest leverage 'emotional side'.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="midi-box-section-top d-flex flex-column-reverse flex-lg-row text-white second-section-sky">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 ml-5 mx-auto">
                            <h4 class="d-inline-block">So, <b class=" color-teal">How Do You Create</b> These 4 Elements In Your Tracks?</h4>
                            <div>
                                <p>The problem is, you <b class="color-teal">can't just use any chord progressions, melodies, basslines and drum grooves...</b></p>
                                <p>Otherwise everyone would be producing hits left and right.</p>
                                <p>The secret is, your <b class="color-teal">chord progressions have to be unique</b> & memorable....</p>
                                <p>Your <b class="color-teal">melodies have to be addictively catchy</b> and trigger emotions...</p>
                                <p>Your <b class="color-teal">basslines have to get your listener up</b> and moving...</p>
                                <p>And your <b class="color-teal">drum grooves have to resonate</b>, relate and bring your track together like super glue.</p>
                                <p>But <b class="color-teal">without 'natural talent', advanced music theory knowledge</b>, or 10,000+ hours of music production experience...</p>
                                <p>Achieving these things consistently is <b class="color-teal">next to impossible.</b></p>
                                <p>So that's exactly <b class="color-teal">why we created MIDI Box.</b></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 col-xl-6  mx-auto text-center text-lg-right">
                            <img class="key-img" src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Cage_02sized.png" alt="Adio_Cage">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION THREE -->
    <!-- SECTION FOUR -->
    <section class="introducing-section midi-box-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-10 col-xxxl-8 mx-auto">
                    <div class=" text-center mx-auto">
                        <img class="img-fluid mobile-img" src="<?php bloginfo('template_url') ?>/assets/images/intro-hero.png">
                        <h3 class="text-left text-lg-center">Introducing The <span class="color-teal">World's First</span> (And Only) <span class="color-teal">Custom-Curated</span> Monthly <span class="color-teal">MIDI Subscription</span></h3>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11 col-xxl-8 col-xxxl-7 text-left text-lg-center mx-auto pt-4 text-white">
                            <h4 class="text-left text-lg-center">When you join <span class="color-teal">MIDI Box</span>, every month you'll receive an <span class="color-teal">Exclusive Collection</span> of <span class="color-teal">Never-Before-Released:</span></h4>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-12 text-center mx-auto intro-list p-0">
                                <div class="row">

                                    <div class="col-lg-6 p-0" style="display: flex; flex-direction: row; text-align: left; ">
                                        <div class="mr-3">
                                            <i class="fa fa-check color-teal"></i>
                                        </div>
                                        <div class=" receive-item">
                                                <span>
                                                    Hit-Worthy Melodies
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-0" style="display: flex; flex-direction: row; text-align: left; ">
                                        <div class="mr-3">
                                            <i class="fa fa-check color-teal"></i>
                                        </div>
                                        <div class=" receive-item">
                                                <span>
                                                    All in drag & drop MIDI format
                                                  
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-0" style="display: flex; flex-direction: row; text-align: left;">
                                        <div class="mr-3">
                                            <i class="fa fa-check color-teal"></i>
                                        </div>
                                        <div class=" receive-item">
                                                <span>
                                                    Memorable Chord progressions
                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-0" style="display: flex; flex-direction: row; text-align: left;">
                                        <div class="mr-3">
                                            <i class="fa fa-check color-teal"></i>
                                        </div>
                                        <div class=" receive-item">
                                                <span>
                                                    ​​​Perfect drum kits & groovy basslines 
                                                </span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-xs-12 col-sm-12 col-lg-5 col-xl-5 text-center mx-auto">
                            <img class="img-fluid desctop-img mt-2" src="<?php bloginfo('template_url') ?>/assets/images/intro-hero.png" class="Tier">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-7 col-xl-7 mx-auto text-white font-weight-bold ml-5">
                            <div>
                                <p>So you can <b class="color-teal">produce hit songs with consistency</b>, never run into a creative block again and become a top 1% producer. </p>
                                <p><b class="color-teal">And unlike other services...</b> There's <b>no wasting time searching</b> through thousands of scattered, unproven options.</p> 
                                <p>Everything in <b class="color-teal">MIDI Box is quality-checked, unique and brand new</b> every month.</p>
                                <p>Plus, since it's <b class="color-teal">all in MIDI format</b>, it's fully <b>flexible and customizable to your taste.</b></p> 
                                <p>You're <b class="color-teal">not locked into pre-made audio loops</b> or anything like that.</p> 
                                <p>Welcome to the <b class="color-teal">future of the MIDI game.</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BUTTON WHITE TEXT DARK SHADOW -->
            <div class="row pt-xl-3 pt-4">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mx-auto">
                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                        <div class="mx-auto text-center button-green-glow">
                                <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                            <span class="font-weight-bold" style="font-size:12px;line-height:12px;color: #8de6da;">Limited Time Special Launch Offer</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- END OF SECTION FOUR -->
    <!-- SECTION FIVE -->
    <section class="midi-box-section midi-works-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11 col-xl-11 col-xxl-11 col-xxxl-8 text-center mx-auto p-0">
                <h3>Here's How <b class="color-teal">MIDI Box </b>Works:</h3>
                <div class="text-center p-0">
                    <div class="newCard-box bg-opacity">
                        <div class="d-flex flex-column-reverse flex-lg-row text-center align-items-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0">
                                <h4>1. Get Your MIDI Box</h4>
                                <p class="card-text p1">Instantly get download access to the current month's Pro tier MIDI Box...</p>
                                <p class="card-text p1">Or whatever tier is best for you – in your Unison Account and email inbox.</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center mx-auto text-xxl-right ml-5 video p-0">
                                <video style="width: 100%; height: 100%; " autoplay="" loop="" muted="" playsinline="" src="<?php bloginfo('template_url') ?>/assets/videos/midi-box/MIDI+Box+Step+1+Video.mp4"></video>
                            </div>
                        </div>
                    </div>
                    <!-- <i class="fa fa-chevron-circle-down" style="font-size: 55px; color: rgb(28, 186, 164); position:absolute; z-index: 1; margin-top: -16px; left:0; right:0"></i> -->
                    <div class="newCard-box bg-opacity mt-4">
                        <div class="d-flex flex-column-reverse flex-lg-row text-center align-items-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0">
                                <h4>2. Drag & Drop / Customize</h4>
                                <p class="card-text p1">Drag & drop your new MIDI chord progressions, melodies, basslines and drum grooves straight into your project.</p>
                                <p class="card-text p1">You can either use them right out of the box or customize them to your taste.</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center mx-auto text-xxl-right ml-5 video p-0">
                                <video style="width: 100%; " autoplay="" loop="" muted="" playsinline="" src="<?php bloginfo('template_url') ?>/assets/videos/midi-box/MIDI+Box+Step+2+Video.mp4"></video>
                            </div>
                        </div>
                    </div>

                    <div class="newCard-box bg-opacity mt-4">
                        <div class="d-flex flex-column-reverse flex-lg-row text-center align-items-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0">
                                <h4>3. Produce Your Best Music</h4>
                                <p class="card-text p1">Whether you want to use your new tools to produce hit songs every month...</p>
                                <p class="card-text p1">Supercharge your music production output and workflow...</p>
                                <p class="card-text p1">Or just make music you can be proud to share with your friends and family...</p>
                                <p class="card-text p1">MIDI Box has you fully covered.</p>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center mx-auto text-xxl-right video  ml-5 p-0">
                                <video style="width: 100%;" autoplay="" loop="" muted="" playsinline="" src="<?php bloginfo('template_url') ?>/assets/videos/midi-box/MIDI+Box+Step+3+Video.mp4"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION FIVE -->
    <!-- PLAYER SECTION -->
    <section style="background: #222438" class="midi-box-section players-section">
        <!-- <img src="<?php bloginfo('template_url') ?>/assets/images/Layer36White.png" class="img-fluid w-100" style="position: absolute;"> -->
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-9 mx-auto p-0 pl-lg-3 pr-lg-3">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 col-xl-4 mx-auto">
                        <div class="pt-0 mt-0 demo-samples-title">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Speaker_01.png" class=" audio-speaker-img" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxxl-10 mt-0 demo-samples-container mx-auto">
                        <div class="pt-0 mt-0 demo-samples-title">
                            <h4 class="card-title title">Listen To The Demos Below To Experience The Quality Of <span class="color-teal">MIDI Box</span> For Yourself.</h4>
                            <p class="subtitle linear-subtitle">You can use everything with your own sounds</p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxxl-6 d-flex p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-5">
                            <div class="newCard-box bg-secondary-demo-samples">
                                <div class="d-flex justify-content-xxl-between flex-column-reverse align-items-xxl-start align-items-center flex-xxl-row">
                                    <div class="col-xxl-9 col-lg-12 col-md-8 col-sm-8 p-0 text-center text-xxl-left">
                                        <h4>MIDI Box Chord Progressions:</h4>
                                        <p style="color: #FFFFFF;">Access up to <b class="color-teal">200 memorable chord progressions</b> per month.</p>
                                    </div>

                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Piano_01.png" />

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >A Major</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/A+Major+Prog+01.mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >A Minor</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/A+Minor+Prog+10.mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >B Major</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/B+Major+Prog+02.mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Bb Minor</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/Bb+Minor+Prog+05.mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >C Minor</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/C+Minor+Prog+02.mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >D Major</span>
                                            </div>
                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/D+Major+Prog+01.mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >D Minor</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/D+Minor+Prog+03.mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >F Minor</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Chord+Progressions/F+Minor+Prog+08.mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxxl-6 d-flex p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-5">
                            <div class="newCard-box bg-secondary-demo-samples">
                                <div class="d-flex justify-content-xxl-between flex-column-reverse align-items-xxl-start align-items-center flex-xxl-row">
                                    <div class="col-xxl-9 col-lg-11 col-md-8 col-sm-8 p-0 text-center text-xxl-left">
                                        <h4>MIDI Box Melodies</h4>
                                        <p style="color: #FFFFFF;">Access up to <b class="color-teal">200 hit-worthy melodies</b> per month that get your tracks played on repeat.</p>
                                    </div>

                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Clef_01.png" />

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">

                                            <div class="py-3 text-center">
                                                <span >Caramel (Ebm - 80bpm)</span>
                                            </div>


                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Caramel+(Ebm+-+80bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">

                                            <div class="py-3 text-center">
                                                <span >Embers (Em - 130bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Embers+(Em+-+130bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Exhilaration (Fm - 128bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Exhilaration+(Fm+-+128bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Idolatry (C - 140bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Idolatry+(C+-+140+bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Island (Am - 100bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Island+(Am+-+100bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Organism (Gm - 125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Organism+(Gm+-+125bpm).mp3" ]') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Satirist (Gm - 160bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Satirist+(Gm+-+160bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Unreachable (B - 140bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Melodies/Unreachable+(B+-+140bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxxl-6 d-flex p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  pt-5">
                            <div class="newCard-box bg-secondary-demo-samples">
                                <div class="d-flex justify-content-xxl-between flex-column-reverse align-items-xxl-start align-items-center flex-xxl-row">
                                    <div class="col-xxl-9 col-lg-11 col-md-8 col-sm-8 p-0 text-center text-xxl-left">
                                        <h4>MIDI Box Basslines</h4>
                                        <p style="color: #FFFFFF;">Access up to <span class="color-teal">200 fat basslines</span> per month that get your listeners dancing.</p>
                                    </div>

                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Subwoofer_01.png" style="max-width: 70%; max-height: 150px;" />

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Badlands (Fm - 125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Badlands+(Fm+-+125bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Jibe (C - 100bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Jibe+(C+-+100bpm).mp3"]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Loose (Ebm - 90bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Loose+(Ebm+-+90bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Minutes (G#m - 125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Minutes+(G%23m+-+125bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Pathway (Dm - 125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Pathway+(Dm+-+125bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Pumpit (Cm - 125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Pumpit+(Cm+-+125bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Scatter (Bm - 150bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Scatter+(Bm+-+150bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Shook (Gm - 150bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Basslines/Shook+(Gm+-+150bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxxl-6 d-flex p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  pt-5 ">
                            <div class="newCard-box bg-secondary-demo-samples">
                                <div class="d-flex justify-content-xxl-between flex-column-reverse align-items-xxl-start align-items-center flex-xxl-row">
                                    <div class="col-xxl-9 col-lg-11 col-md-8 col-sm-8 p-0 text-center text-xxl-left">
                                        <h4>MIDI Box Drum Kits</h4>
                                        <p style="color: #FFFFFF;">Access up to <span class="color-teal">200 perfect drum kits</span> per month so you can make your music addictive.</p>
                                    </div>

                                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_Tom_01.png" style="max-width: 70%; max-height: 150px;" />

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Ancestors (130bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Ancestors+(130bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Bubbles (180bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Bubbles+(180bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Champagne (128bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Champagne+(128bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Geometric (125bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Geometric+(125bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Sol (100bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Sol+(100bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Stained (170bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Stained+(170bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Success (180bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Success+(180bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="media-wrapper player-text">
                                            <div class="py-3 text-center">
                                                <span >Thrashed (100bpm)</span>
                                            </div>

                                            <?php echo do_shortcode('[audio src="https://midibox.s3-us-west-1.amazonaws.com/Demos/Drum+Kits/Thrashed+(100bpm).mp3" ]') ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-3 demo-samples-container mx-auto">
                        <div class="my-3 demo-samples-title">
                            <h4 class="card-title produce-title">All The Tools You Need To Produce Hit Songs Every Month At Your Fingertips</h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-xl-7 col-xxl-7 text-center mx-auto p-0">
                            <!-- BUTTON WHITE TEXT BLUE SHADOW-->
                            <a href="#midi-box-pricing" rel="noopener noreferrer">
                                <div class="text-center mx-auto mt-4 bg-success p-3 button-green-glow">
                                        <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                    <span class="font-weight-bold" style="font-size: 12px;color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SECTION SIX -->
    <section class="bg-white video-section midi-box-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-9 col-xxxl-10 mx-auto text-center p-0">
                <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto justify-content-center p-0">
                    <div class="text-content">
                        <h4 class="text-dark font-weight-bold">Watch The <span class="color-teal"><u>Quick Video</u></span> Below To See <u>MIDI Box In Action:</u></h4>
                    </div>
                </div>

                <!-- VIDEO PLAYER -->

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-9 mx-auto p-0">
                    <!-- <video class="w-100 h-100" style="object-fit: initial" controls>
                        <source src="https://deals.unison.audio/868d1955-0117-45f4-bc0f-8c184fb0f30a" type="video/mp4">
                    </video> -->
                    <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0 !important;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/te7ef78lqq?videoFoam=true" title="MIDI Box Walkthrough Section Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="100%" height="100%"></iframe></div></div>
                        <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
                </div>


                <!-- BUTTON WHITE TEXT DARK SHADOW -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-xxxl-8 mx-auto">
                        <a href="#midi-box-pricing" rel="noopener noreferrer">
                            <div class="text-center mx-auto mt-5 p-3 button-green-glow">
                                    <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                <span class="font-weight-bold" style="font-size: 12px;color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION SIX -->
    <!-- SECTION SEVEN -->
    <section class="simple-section midi-box-section">
        <!-- <img src="<?php bloginfo('template_url') ?>/assets/images/Vector2_white.png" class="img-fluid w-100" style="position: absolute;"> -->
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-11 col-xxxl-9 mx-auto text-center">
                <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mx-auto">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/mesh_image.png" class="img-fluid col">
                            </p>
                        </div>
                    </div> -->
                <div class="row">
                    <div class="mx-auto mb-3">
                        <h4 class="title">But, Don't Let MIDI Box's Simplicity Fool You...</h4>
                        <p class="linear-subtitle">Here's Everything Going On Behind The Scenes:
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto mb-3 p-0">
                        <div style="height: auto;">
                            <div class="d-flex flex-column-reverse flex-lg-row align-items-center p-0" style="height: auto;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5 mx-auto text-left font-weight-bold p-0">
                                    <h4 class="subtitle">As You Probably Know, At Unison We're <span class="color-teal">Famous For Our MIDI Packs...</span></h4>
                                    <p>And <b class="color-teal">after selling over 150,000 copies</b> of the original Unison MIDI Chord Pack...</p>
                                    <p>We could no longer ignore the <b class="color-teal">hundreds of emails</b> we received every month...</p>
                                    <p>From producers asking <b class="color-teal">asking us to make a Unison MIDI subscription.</b></p>
                                    <p>So after a lot of thought, that's <b class="color-teal">exactly what we set out to do.</b></p>
                                    <p>We started off by <b class="color-teal">listening to thousands of hit songs to uncover the secrets</b> behind their making.</p>
                                    <p>And at first, it was <b class="color-teal">hard to find any repeating patterns</b> and common threads.</p>
                                    <p>But eventually, <b class="color-teal">everything came together</b> and we had a <b class="color-teal">lightbulb moment.</b></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-5 col-xl-5 col-xxl-5 offset-xxl-2 mx-auto p-0">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/midi-famous.png" style="border-radius: 5px;" class="img-fluid pt-4 pt-lg-0 w-100">
                                </div>
                            </div>
                            <div class="row align-items-center  pt-5" style="height: auto;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 pt-3 pb-3 mx-auto">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/midi-famous 2.png" class="img-fluid pt-lg-0">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5 offset-xl-2 text-left font-weight-bold  mx-auto">
                                    <h4 class="subtitle">We Realized It <br> <span class="color-teal">All Came Down</span> To Chord Progressions, Melodies, Drum Grooves And Basslines...</h4>
                                    <p>So after <b class="color-teal">discovering 4 necessary elements</b> to making hit songs – we created MIDI Box.</p>
                                    <p>A <b class="color-teal">custom curated collection</b> of pro-level chord progressions, catchy melodies, groovy basslines & perfect drum grooves...</p>
                                    <p>All in <b class="color-teal">MIDI format</b> and ready for you to <b>drag & drop</b> straight into your music...</p>
                                    <p><b class="color-teal">Skyrocketing your chances</b> of producing hit songs.</p>
                                    <p>With <b class="color-teal">brand new files</b> delivered to you <b>every single month...</b></p>
                                    <p>So you can <b class="color-teal">reach your true potential</b> as a producer and <b class="color-teal">make your best music</b> with consistency.</p>
                                </div>
                            </div>

                            <div class="row" style="height: auto;">
                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-xxxl-7 mx-auto">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center mx-auto bg-success button-green-glow">
                                                <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size: 12px;color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END OF SECTION SEVEN -->
    <!-- SECTION EIGHT -->
    <section class="midi-box-section ten-reasons-section text-dark" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 col-xxl-11 col-xxxl-9 mx-auto text-center p-0">
                <div class="text-content col-lg-10 mx-auto">
                    <h4 class="position-relative text-dark title title-desktop" style="z-index: 2;">10 More Reasons Why MIDI Box Is So Powerful...</h4>
                    <h4 class="position-relative text-dark title title-mobile" style="z-index: 2;">10 More Reasons Why MIDI Box Is<br> So Powerful...</h4>
                    <span class="bg-number" style="position: absolute; opacity: 0.6;font-weight: 900; font-size: 280px; transform: translate(-50%, -70%); color: #303133;; z-index: 1; letter-spacing: -10px; opacity: 0.1;">10</span>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0  d-flex flex-column mx-auto">
                            <h4 class="subtitle">1. Fully Customizable</h4>
                            <p>Unlike audio files, the beauty of <b class="color-teal">MIDI Box</b> is that it's <b>fully customizable</b> to your taste.</p> 
                            <p>And although all the chord progressions, melodies, bass lines & drum grooves...</p>
                            <p>Are perfected to <b class="color-teal">sound amazing right out of the box</b>...</p> 
                            <p>You can move the notes around, change up the drum rhythms and <b class="color-teal">really make them your own</b> if you like.</p>
                            <p>There are <b class="color-teal">no limits to the possibilities</b> you can create using the MIDI files you'll be getting every month.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                                <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/section-3-flow.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 pr-lg-5 mx-auto " style="align-self: flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_MagnifyingGlass_05_section3_trim.png" class="img-fluid w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0 pl-lg-5 d-flex mx-auto flex-column">
                            <h4 class="subtitle">2. No Endless Searching</h4>
                            <p>Other subscription services <b class="color-teal">thrive off prioritizing quantity over quality.</b></p> 
                            <p>So, instead of getting you caught up <b class="color-teal">searching through thousands of sounds</b>...</p>
                            <p>And hoping to find something that <b class="color-teal">actually sounds professional...</b></p> 
                            <p>With MIDI box, <b class="color-teal">everything is revised several times</b> and based upon <b class="color-teal">proven frameworks from hit songs</b>...</p>
                            <p>Saving you time and <b class="color-teal">allowing you to just focus on producing hit songs</b> with total confidence and ease.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                                <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left  p-0  d-flex flex-column mx-auto">
                            <h4 class="subtitle">3. Guaranteed Monthly Delivery</h4>
                            <p>Any top producer knows that <b class="color-teal">consistency is the key to success.</b></p> 
                            <p>That's because in today's world, the <b class="color-teal">attention spans of your listeners are lower than ever.</b></p>
                            <p>Which means <b class="color-teal">if you're not pumping out professional-sounding tracks every month, you'll fall behind</b> and become forgotten.</p> 
                            <p>With <b class="color-teal">MIDI Box</b>, you receive your MIDI files <b class="color-teal">every single month</b> without fail.</p> 
                            <p>This ensures you have <b class="color-teal">everything you need to consistently finish & release</b> high-quality music...</p>
                                <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                                <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/midi-famous 2.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 pr-lg-5 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_Folder_section3_trim.png" class="img-fluid w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0 pl-lg-5 d-flex flex-column mx-auto">
                            <h4 class='subtitle'>4. Perfectly Organized</h4>
                            <p>You know that <b class="color-teal">any little obstacle</b> in your creative process can <b class="color-teal">knock you out</b> of your <b class="color-teal">flow state...</b></p> 
                            <p>That's why <b class="color-teal">all the files in MIDI Box</b> are <b class="color-teal">perfectly organized</b> so you can <b class="color-teal">streamline your workflow.</b></p> 
                            <p>All the <b class="color-teal">chord progressions, melodies and basslines</b> are <b class="color-teal">key labeled and organized...</b></p> 
                            <p>And all the <b class="color-teal">drum kits</b> are accurately <b class="color-teal">labeled by element and BPM.</b></p>
                            <p>You <b class="color-teal">won't have to waste time</b> or do any guesswork to find what you want.</p> 
                            <p>Instead, you'll have <b class="color-teal">everything easily accessible</b> for instant use – right <b class="color-teal">at your fingertips.</b></p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left  p-0 d-flex flex-column mx-auto">
                            <h4 class="subtitle">5. 100% Royalty Free</h4>
                            <p>All the money you earn from music you make with <b class="color-teal">MIDI Box</b> is <b>yours to keep.</b></p> 
                            <p>You can use the MIDI files in <b class="color-teal">beats you sell online...</b></p> 
                            <p>Music you <b class="color-teal">release on Spotify, Apple Music, iTunes</b> etc...</p> 
                            <p>Scores you <b class="color-teal">license for film/tv</b>, or anything else.</p>
                            <p>What you do with MIDI Box <b class="color-teal">is up to you</b>, you can use it in your music however you please.</p> 
                            <p><b class="color-teal">So if you end up making a hit</b> with millions of plays, we'll never ask for a cut of your profits.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_BagsofMoney_01_section3_trim.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 pr-lg-5 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_MadeForAllGenres_section3_trim.png" class="img-fluid w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0 pl-lg-5 d-flex flex-column mx-auto">
                            <h4 class="subtitle">6. Made For All Genres</h4>
                            <p>The truth is, <b class="color-teal">not all chord progressions, melodies, basslines and drum grooves are created equal.</b></p> 
                            <p>Each genre has <b class="color-teal">unique frameworks</b> that need to be followed in order to <b class="color-teal">sound professional</b></p> 
                            <p>That's why we spent <b class="color-teal">the last 2 years uncovering the secrets</b> behind all these frameworks & packed them into <b class="color-teal">MIDI Box.</b></p>
                            <p>So, you can <b class="color-teal">instantly create chord progressions, melodies, basslines and drum grooves in 30 different genres</b> of music...</p>
                            <p>That are proven to <b class="color-teal">sound good with consistency.</b></p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br/>
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left  p-0 d-flex flex-column mx-auto">
                            <h4 class="subtitle">7. Use With Any Sound</h4>
                            <p>You can <b class="color-teal">play the chord progressions, melodies, basslines & drum grooves</b> in your <b class="color-teal">MIDI Box</b>...</p>
                            <p>With <b class="color-teal">all your favorite sounds</b>, presets & samples.</p> 
                            <p>You're <b class="color-teal">not limited to pre-determined sounds</b> like with audio loops.</p>
                            <p>That means you'll have <b class="color-teal">total freedom & control</b> to swap presets on the fly and try out different synths with <b class="color-teal">no limits.</b></p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                                <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 p-0 mx-auto" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Speaker 01_section3.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 pr-lg-5 mx-auto " style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_ABCBlocks_02_section3_trim.png" class="img-fluid w-100 h-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0 pl-lg-5 mx-auto  d-flex flex-column">
                            <h4 class="subtitle">8. Beginner Friendly</h4>
                            <p>We've <b class="color-teal">done all the hard work</b> for you already.</p> 
                            <p>So, whether you're a beginner, intermediate or advanced — using <b class="color-teal">MIDI Box</b> will be a <b class="color-teal">piece of cake</b> for you.</p>
                            <p>You <b class="color-teal">don't need to know music theory</b>, have a lot of time to produce or have any advanced technical skills.</p> 
                            <p>We've designed <b class="color-teal">MIDI Box</b> to be <b class="color-teal">so quick and easy to use</b>, even a kindergartener could do it.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left mx-auto p-0 d-flex flex-column">
                            <h4 class="subtitle">9. Completely Exclusive</h4>
                            <p>The MIDI files inside each month's <b class="color-teal">MIDI box</b> are <b class="color-teal">not available anywhere else</b>.</p>
                            <p>They are <b class="color-teal">made fresh for the current month</b>, so you can be sure you have an <b class="color-teal">unfair advantage</b> over 99% of other producers...</p>
                            <p>By getting <b class="color-teal">exclusive access to never-before-released</b>, up-to-date chord progressions, melodies, basslines & drum grooves.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 mx-auto p-0" style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_GoldKeyboard_section3_trim.png" class="img-fluid w-100">
                        </div>
                    </div>
                </div>

                <div class="newCard-box p-0">
                    <div class="d-flex flex-column  flex-lg-row p-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 pr-lg-5 mx-auto " style="align-self:flex-center;">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_WebContent_BurntContract_section3_trim.png" class="img-fluid w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left p-0 pl-lg-5 mx-auto d-flex flex-column">
                            <h4 class="subtitle">10. No Long Term Commitments</h4>
                            <p>After you <b class="color-teal">get MIDI Box today</b>, at any point in the future...</p> 
                            <p>You can <b class="color-teal">cancel, pause or renew your subscription with 1 click</b> from your Unison account – just like Netflix.</p>
                            <p>You <b class="color-teal">don't have to email support or talk to anyone</b> on the phone. <b class="color-teal">You're in control.</b></p> 
                            <p>And, there are <b class="color-teal">no long term contracts</b>, hidden fees or any weird stuff like that.</p>
                            <div class="row-ten">
                                <div class="col-sm-12 p-md-0">
                                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                                        <div class="text-center bg-success button-green-glow">
                                            <span class="font-weight-bold">START $1 TRIAL NOW</span><br />
                                            <span class="font-weight-bold" style="font-size:12px;color:#8de6da;line-height:12px">Limited Time Special Launch Offer</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- END OF SECTION EIGHT -->
    <!-- SECTION NINE -->
    <section class="how-much-cost-section midi-box-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10 col-xxxl-8 mx-auto text-center p-0">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto position-relative p-0">
                    <h4 class="font-weight-bolder title">Ok, So How Much Does It Cost?</h4>
                </div>
                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto position-relative p-0">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/Tier 3_MIDI Box.png" class="img-fluid w-75">
                    </div> -->
                <div class="newCard-box pt-0 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto p-0">
                    <div class="d-flex flex-column-reverse flex-lg-row pb-lg-5 pb-4 align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left font-weight-bolder p-0">
                            <h4 class="text-white subtitle">The Good News Is, <span class="color-teal">Any Producer Can Afford</span> MIDI Box...</h4>
                            <p class="card-text">But first, let’s just think about the <b class="color-teal">alternatives</b> you could try...</p>
                            <p class="card-text">You could get a <b class="color-teal">degree in music theory</b> to make MIDI Box's chord progressions, melodies, basslines & drum kits by yourself.</p>
                            <p class="card-text">But even at a low-tier school that would cost you <b class="color-teal">$19,500 and 4 years</b> of your time.</p>
                            <p class="card-text">Or, you could buy all the MIDI Packs on our site for <b class="color-teal">$1,620</b>.</p>
                            <p class="card-text">But they <b class="color-teal">won't be custom-curated, freshly made</b> for you every month or include exclusive basslines.</p>
                        </div>
                        <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-5 col-xl-5 offset-xl-1 mx-auto">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/midi-costs.svg" class="img-fluid img-cost-mobile">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-5 col-xl-5 offset-xl-2 mx-auto">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/midi-box-sudio-image-1 1.svg" class="img-fluid">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 offset-xl-1 text-left font-weight-bolder  ml-auto text-white">
                            <h4 class="subtitle">So, Considering The <span class="color-teal">$10,000+ That Goes
                                Into Creating</span> Each Month's MIDI Box...</h4>
                            <p class="card-text">The power it'll give you to <b class="color-teal">produce hit songs with ease and consistency</b>...</p>
                            <p class="card-text">Instantly create <b class="color-teal">radio-worthy</b> chord progressions, melodies, basslines & drum grooves...</p>
                            <p class="card-text">Get infinite <b class="color-teal">inspiration</b> at your fingertips...</p>
                            <p class="card-text">And absolutely <b class="color-teal">blow the minds</b> of your friends, family & fans...</p>
                            <p class="card-text">The value of the MIDI Box Pro tier is <b class="color-teal">$127/month.</b></p>
                            <p class="card-text">But don't worry...</p>
                            <p class="card-text">As a limited-time special launch offer — <b class="color-teal">today, you won’t have to pay anywhere near that.</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION NINE -->
    <!-- SECTION TEN -->
    <section class="five-exclusive midi-box-section" style="background-color:#0A1122;">
        <!-- <img src="<?php bloginfo('template_url') ?>/assets/images/Vector2_white.png" class="img-fluid w-100"> -->
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11 col-xl-11 col-xxl-11 col-xxxl-8 mx-auto text-center p-0">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-xl-9 mx-auto">
                        <h4 class="text-white title">Plus, Get <span class="color-teal"><u>5 Special Exclusive Launch Bonuses</u></span> when you order now</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 mx-auto">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/five special offer.svg" class="img-fluid title-img">
                    </div>
                </div>
                <div class="newCard-box bg-opacity font-weight-bold mb-1 position-relative">
                    <div class="d-flex flex-column-reverse flex-lg-row pb-0">
                        <div class="col-md-12 col-lg-7 text-left p-0 pl-lg-3 pr-lg-5">
                            <span class="p1 pb-3 text-violet">Bonus #1</span>
                            <h4>Unison Ultimate Keys & Leads Collection</h4>
                            <p class="font-weight-bold">Value: <span class="color-teal green-text font-weight-bold"> $97</span></p>
                            <p>In order to <b class="color-teal">make the most out of your MIDI Box</b> chord progressions & melodies...</p>
                            <p>You're going to want the <b class="color-teal">highest-quality, custom-made presets</b> to use them with.</p>
                            <p>That's why we designed the <b class="color-teal">Unison Ultimate Keys & Leads Collection.</b></p> 
                            <p>It's complete collection of <b class="color-teal">210 genre-specific</b> key & lead presets for our audience's 5 most-used synths — Serum, Omnisphere, Diva, Massive X & Sylenth1.</p>
                            <p>And, it's <b class="color-teal">specifically designed for Unison MIDI files.</b></p>
                        </div>
                        <div class="col-md-12 col-lg-5 pl-lg-5">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/ultimate-keys-leads-sized.jpg" style="border-radius: 5px;" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- <div class="color-teal position-absolute" style="left: 50%; transform: translate(-50%, -35%);">
                    <i class="fa fa-plus-circle" style="font-size: 60px;"></i>
                </div> -->

                <div class="newCard-box bg-opacity font-weight-bold mt-4 mb-1 position-relative">
                    <div class="d-flex flex-column flex-lg-row pb-0">
                        <div class="col-md-12 col-lg-5 pr-lg-5">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Unison_UltimateBassCollection.jpg" style="border-radius: 5px;" class="img-fluid">
                        </div>
                        <div class="col-md-12 col-lg-7 text-left p-0 pl-lg-5 pr-lg-3">
                            <span class="p1 pb-3 text-violet">Bonus #2</span>
                            <h4>Unison Ultimate Bass Collection</h4>
                            <p class="font-weight-bold">Value: <span class="color-teal green-text font-weight-bold"> $67</span></p>
                            <p>Next, to use the <b class="color-teal">MIDI Box basslines</b> to their full potential...</p>
                            <p>You'll want <b class="color-teal">professionally-designed bass presets</b> to plug & play to instantly have a pro sound.</p>
                            <p>That's why we designed the <b class="color-teal">Unison Ultimate Bass Collection</b>.</p> 
                            <p>It's complete collection of <b class="color-teal">105 genre-specific bass presets</b> for our audience's 5 most-used synths — Serum, Omnisphere, Diva, Massive X & Sylenth1.</p> 
                            <p>And, it's also <b class="color-teal">specifically designed for Unison MIDI files.</b></p>
                        </div>
                    </div>
                </div>

                <!-- <div class="color-teal position-absolute" style="left: 50%; transform: translate(-50%, -35%);">
                    <i class="fa fa-plus-circle" style="font-size: 60px;"></i>
                </div> -->

                <div class="newCard-box bg-opacity font-weight-bold mb-1 mt-4 position-relative">
                    <div class="d-flex flex-column-reverse flex-lg-row">
                        <div class="col-md-12 col-lg-7 text-left p-0 pl-lg-3 pr-lg-5">
                            <span class="p1 pb-3 text-violet">Bonus #3</span>
                            <h4>Unison Essential Drum Collection</h4>
                            <p class="font-weight-bold">VALUE: <span class="color-teal green-text font-weight-bold"> $67</span></p>
                            <p>To acheive the most <b class="color-teal">professional results with your MIDI Box drum kits...</b></p> 
                            <p>You'll need <b class="color-teal">professional-standard drum samples</b> to use them with.</p>
                            <p>In the <b class="color-teal">Unison Essential Drums Collection</b>, you'll get 379 unique genre-specific samples...</p>
                            <p>So you can instantly <b class="color-teal">start quickly and easily creating perfect drum loops.</b></p>
                        </div>
                        <div class="col-md-12 col-lg-5 pl-lg-5">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Essential Drum Collection Art (Full Size).jpg" style="border-radius: 5px;" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- <div class="color-teal position-absolute" style="left: 50%; transform: translate(-50%, -35%);">
                    <i class="fa fa-plus-circle" style="font-size: 60px;"></i>
                </div> -->

                <div class="newCard-box bg-opacity font-weight-bold mb-1 mt-4 position-relative">
                    <div class="d-flex flex-column flex-lg-row pb-0">
                        <div class="col-md-12 col-lg-5 pr-lg-5">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/midi-manipulation-masterclass.jpg" style="border-radius: 5px;" class="img-fluid">
                        </div>
                        <div class="col-md-12 col-lg-7 text-left p-0 pl-lg-5 pr-lg-3">
                            <span class="p1 pb-3 text-violet">Bonus #4 (Pro Tier Only)</span>
                            <h4>Unison MIDI Manipulation Masterclass</h4>
                            <p class="font-weight-bold">VALUE: <span class="color-teal green-text font-weight-bold"> $197</span></p>
                            <p>In this exclusive, in-depth masterclass, Sep will share his years of experience on <b class="color-teal">unique strategies of manipulating MIDI</b>.</p> 
                            <p>Using what you'll learn in this masterclass, you'll be able to <b class="color-teal">make the most of the MIDI files you get</b> in your MIDI Box.</p>
                            <p>Plus, you'll be able to <b class="color-teal">make your music sound infinitely more professional and take your MIDI game to the next level</b> by using the specific tricks.</p>
                        </div>
                    </div>
                </div>

                <!-- <div class="color-teal position-absolute" style="left: 50%; transform: translate(-50%, -35%);">
                    <i class="fa fa-plus-circle" style="font-size: 60px;"></i>
                </div> -->

                <div class="newCard-box bg-opacity font-weight-bold mb-1 mt-4 position-relative">
                    <div class="d-flex flex-column-reverse flex-lg-row">
                        <div class="col-md-12 col-lg-7 text-left p-0 pl-lg-3 pr-lg-5">
                            <span class="p1 pb-3 text-violet">Bonus #5 (Pro Tier Only)</span>
                            <h4>MIDI Box Advanced Implementation Training</h4>
                            <p class="font-weight-bold">Value: <span class="color-teal green-text font-weight-bold"> $127</span></p>
                            <p>Beyond what you <b class="color-teal">already know about MIDI Box...</b></p> 
                            <p>There's some <b class="color-teal">secret uses that</b> would simply be <b class="color-teal">too powerful to reveal to everyone.</b></p> 
                            <p>In the <b class="color-teal">MIDI Box Advanced Implementation Training</b>, Unison co-founder and <b class="color-teal">producer with 30+ million plays Sep...</b></p> 
                            <p>Will be <b class="color-teal">demonstrating in real time</b> how to <b class="color-teal">use MIDI Box to easily make hit songs</b> in several genres.</p>
                            <p> Also, he'll show you <b class="color-teal">3 special ways you can use MIDI Box</b> to skyrocket your music production results.</p>
                        </div>
                        <div class="col-md-12 col-lg-5 pl-lg-5">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_MIDIBoxAdvancedImplementationTraining.jpg" style="border-radius: 5px;" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- BUTTON WHITE TEXT DARK SHADOW -->
                <div class="row" style="height: auto;">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 mx-auto">
                        <a href="#midi-box-pricing" rel="noopener noreferrer">
                            <div class="text-center mx-auto bg-success p-3 button-green-glow mt-5">
                                <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                <span class="font-weight-bold" style="font-size: 12px;color:#8de6da;">Limited Time Special Launch Offer</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION TEN -->
    <!-- SECTION ELEVEN -->
    <section class="midi-box-section font-weight-bold calendar-section" style="background-color:#E14859;">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-11 col-xxxl-9 mx-auto text-cente p-0">
                <div class="clock-img text-center mb-3">
                    <img src="<?php bloginfo('template_url') ?>/assets/images/midi-box/Clock.png" class="mw-100">
                </div>
                <div class="font-weight-bold">
                    <h4 class="text-white title text-center text-lg-center">Time Is Of The Essence.</h4>
                </div>
                <div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10 col-xxxl-8 mx-auto p-0">
                        <h4 class="text-white subtitle text-center text-lg-center">The $1 Trial Is Only Available Until <br>Feb 18, 2022 at 11:59PM PST.</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-11 col-xl-10 col-xxl-10 col-xxxl-8 mx-auto p-0">
                    <div class="newCard-box p-0 text-white text-left text-content w-100">
                        <p class="card-text">So, if this page is still online...</p>
                        <p class="card-text">It means you can secure the MIDI Box Pro tier with all 5 bonuses for only $1...</p>
                        <p class="card-text">But, if you come back later...</p>
                        <p class="card-text">This special launch offer could already be gone.</p>
                        <p class="card-text">Don’t sleep on this opportunity — then suffer a hit of regret every time some other song outperforms yours and steals all your plays.</p>
                        <p class="card-text">Instead, choose your preferred tier below and lock in this epic deal now.</p>
                    </div>
                    <!-- <img src="<?php bloginfo('template_url') ?>/assets/images/calendar.svg"> -->
                </div>
            </div>
        </div>
    </section>
    <section class="midi-box-pricing midi-box-section" id="midi-box-pricing">
        <div class="container">
        <?php
            $subid = '';
            $subscriptions = wcs_get_users_subscriptions(get_current_user_id());
            foreach ($subscriptions as $subscription){
              if ($subscription->has_status(array('active'))) {
                 $subid = $subscription->get_id(); 
              }
            }
            if($subid != ''){ ?>
                
            <div class="text-white mx-auto">
                <h3 class="text-center col-xxxl-5 col-xxl-7 col-xl-8 col-lg-8 col-md-10  col-sm-11 col-xs-11 title p-0">You have already subscribed for MIDI Box subscription</h3>
                <p class="text-white mx-auto text-center" style="max-width:950px;">Thank you for Subscribing. You can download your purchases now via the link below, or from the Downloads tab located in your Account Dashboard.
                </p>
                <p style="text-align: center;"> 
                    <a href="/my-account/downloads" class="badge badge-pill-order-confirmation badge-success">Access downloads</a>
                </p>
            </div>

        </div> 
                
        <?php }else{ 
            $id_main = array();
            $id_trial = array();
            //$product_main = wc_get_product($main_parent_id);
            $product_trial = wc_get_product($trial_parent_id);
            $product_trial_ids = $product_trial->get_children();
			//print_r($product_trial_ids);
			//print_r($product_main_ids);
            foreach($product_trial_ids as $product_trial_id){
                $trial_variation = wc_get_product($product_trial_id); 
                $trial_variation_data = $trial_variation->get_data(); 
                if($trial_variation_data['attributes']['type'] == 'Lite'){
                    $id_trial['liteid'] = $product_trial_id;
                }if($trial_variation_data['attributes']['type'] == 'Plus'){
                    $id_trial['plusid'] = $product_trial_id;
                }if($trial_variation_data['attributes']['type'] == 'Pro'){
                    $id_trial['proid'] = $product_trial_id;
                } 
            }
            


        ?>
        <div class="text-white mx-auto">
            <h2 class="text-center col-xxxl-5 col-xxl-7 col-xl-8 col-lg-8 col-md-10  col-sm-11 col-xs-11 title p-0"><b>Select The Pro Plan,</b> Or Whatever Plan Works Best For You Below Now:</h2>
        </div>
        <div class="d-flex flex-column-reverse flex-lg-row col-xxxl-10 col-lg-12 col-md-10 col-sm-12 mx-auto p-0 align-items-top">
            <div class="col-lg-4 col-xs-12 mx-auto px-xl-3 px-lg-2 pb-0">
                <div class="m-0 card-green card-main">
                    <div class="card-main--inner text-center mt-0 pt-0">
                        <div class='img-box'>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Tier1 pricing.svg" alt="Tier 1" class="img-tier">
                        </div>
                        <h4 class="card-title m-0">Lite</h4>
                        <p class="card-subtitle font-weight-bold">Here's What You'll Get:</p>
                        <div class="bg-opacity text-white card-opacity">
                            <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12  align-items-top mb-title">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title'>200 MIDIs every month </h6>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title mt-title text-xxl-right'>$27/month Value</h6>
                                    </div>
                                </div>
                            </div>
                            <ul class="row justify-content-between m-0 p-0">
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left m-0 d-flex align-items-center"><i class="fa fa-circle"></i>48 Chord Progressions</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 p-0 mt-10">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center p-0">
                                        <i class="fa fa-circle"></i>48 Melodies</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex align-items-center m-0 p-0"> <i class="fa fa-circle"></i>48 Basslines</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center p-0"> <i class="fa fa-circle"></i>56 Drum Patterns</li>
                                </div>
                            </ul>
                        </div>
                        <?php
                        $type_of_bonus_lite = get_field('bonus_variation_products_light',$trial_parent_id);
                        $bonus_lite_total = get_field('bonus_value_lite',$trial_parent_id);
                        foreach($type_of_bonus_lite as $type_of_bonuse) {
                            $product = wc_get_product( $type_of_bonuse );
                            $dataproduct = $product->get_data();
                            $numbonus = explode(':', $dataproduct['name'])[0];
                            ?>

                            <div class="bg-opacity text-white card-img-text">
                                <div class="d-flex">
                                    <div class="left-part">
                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($type_of_bonuse)); ?> " class="img-fluid w-100 m-0 p-0" alt="Ultimate key"> 
                                    </div>
                                    <div class="right-part card-content">
                                        <h5 class="p-0 m-0"><?php echo $numbonus; ?></h5>
                                        <h6 class="text-white p-0 mt-title"><?php echo $dataproduct['name']; ?></h6>
                                        <p class="text-white font-weight-bold p-0 card-price"><?php echo '$'. $dataproduct['price']; ?> Value</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="bottom__content">
                            <p class="text-white font-weight-bold total">Total value:</p>
                            <p class="font-weight-bold total-price">$<?php echo $bonus_lite_total;?></p>
                            <p class="font-weight-bold limited">Limited Time Launch Offer:</p>
                            <!-- <div class="d-flex justify-content-center text-white mt-1 font-weight-bold align-items-top">
                                <p class="price-warning font-weight-bold"> <strike>$27</strike></p>
                                <p class="month font-weight-bold"><span class="big-price">$7</span>/month</p>
                            </div> -->
                            <p class="font-weight-bold text-white">$1 For 30 Days Then <span style="font-size:20px;color:#DA4A66;"><del>$27</del></span> $7/month</p>
                            <a href="/midi-box-lite-order-secure/?add-to-cart=<?php echo $id_trial['liteid']; ?>" rel="noopener noreferrer">
                                <div class="text-center mx-auto button-green-offshadow btn-get btn-get-dark">
                                    <span class="text-white font-weight-bold">START $1 TRIAL NOW</span><br />
                                    <span class="font-weight-bold" style="font-size: 12px; color:#8de6da; line-height: 12px">30-Day Money-Back Guarantee</span>
                                </div>
                            </a>
                            <p class="text-center take-risk">Try It Risk Free, No Commitments,<br> Cancel Anytime With 1 Click</p>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Group-941415.png" style="width: 60%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 mx-auto px-xl-3 px-lg-2 pb-0">
                <div class="card-main card-blue">
                    <div class="card-main--inner text-center mt-0 pt-0">
                        <div class='img-box'>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Tier2 pricing.svg" alt="Tier 2" class="img-tier">
                        </div>
                        <h4 class="card-title">Plus</h4>
                        <p class="text-white  font-weight-bold card-subtitle">Here's What You'll Get:</p>
                        <div class="opacity-card text-white card-opacity">
                            <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12  align-items-top mb-title">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title'>500 MIDIs every month </h6>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title text-xxl-right mt-title'>$67/month Value</h6>
                                    </div>
                                </div>
                            </div>
                            <ul class="row justify-content-between m-0 p-0" style="width: 100%; line-height: 14px;">
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left m-0 d-flex align-items-center"><i class="fa fa-circle"></i>120 Chord Progressions</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 p-0 mt-10">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center p-0">
                                        <i class="fa fa-circle"></i>120 Melodies</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex align-items-center m-0 p-0"> <i class="fa fa-circle"></i>120 Basslines</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center m-0 p-0"> <i class="fa fa-circle"></i>140 Drum Patterns</li>
                                </div>
                            </ul>

                        </div>
                        <?php

                        $type_of_bonus_plus = get_field('bonus_variation_products_plus',$trial_parent_id);
                        $bonus_plus_total = get_field('bonus_value_plus',$trial_parent_id);
                        foreach($type_of_bonus_plus as $type_of_bonuse) {
                            $product = wc_get_product( $type_of_bonuse );
                            $dataproduct = $product->get_data();
                            $numbonus = explode(':', $dataproduct['name'])[0];
                            ?>

                            <div class="opacity-card text-white card-img-text">
                                <div class="d-flex">
                                    <div class="left-part">
                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($type_of_bonuse)); ?> " class="img-fluid w-100 m-0 p-0" alt="Ultimate key">
                                    </div>
                                    <div class="right-part card-content">
                                        <h5 class="p-0 m-0"><?php echo $numbonus; ?></h5>
                                        <h6 class="text-white p-0 mt-title"><?php echo $dataproduct['name']; ?></h6>
                                        <p class="text-white font-weight-bold p-0 card-price"><?php echo '$'. $dataproduct['price']; ?> Value</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="bottom__content">
                            <p class="text-white font-weight-bold total">Total value:</p>
                            <p class="font-weight-bold total-price">$<?php echo $bonus_plus_total; ?></p>
                            <p class="font-weight-bold limited">Limited Time Launch Offer:</p>
                            <!-- <div class="d-flex justify-content-center text-white mt-1 font-weight-bold align-items-top">
                                <p class="price-warning font-weight-bold"> <strike>$67</strike></p>
                                <p class="month font-weight-bold"><span class="big-price">$17</span>/month</p>
                            </div> -->
                            <p class="font-weight-bold text-white">$1 For 30 Days Then <span style="font-size:20px;color:#DA4A66;"><del>$67</del></span> $17/month</p>
                            <a href="/midi-box-plus-order-secure/?add-to-cart=<?php echo $id_trial['plusid']; ?>" rel="noopener noreferrer">
                                <div class="text-center mx-auto button-green-offshadow btn-get btn-get-dark">
                                    <span class="text-white font-weight-bold">START $1 TRIAL NOW</span><br />
                                    <span class="font-weight-bold" style="font-size: 12px; color:#8de6da; line-height: 12px">30-Day Money-Back Guarantee</span>
                                </div>
                            </a>
                            <p class="text-center take-risk">Try It Risk Free, No Commitments,<br> Cancel Anytime With 1 Click</p>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Group-941415.png" style="width: 60%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 mx-auto px-xl-3 px-lg-2">
                <div class="mb-0 m-0 m-0 p-0 bg-white card-white h-100" style="border-radius: 10px">
                    <div class="card-main--inner text-center mt-0 card-main">
                        <div class='img-box'>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Tier 3 10.png" alt="Tier 1" class="img-tier">
                        </div>
                        <h4 class="text-gradient-bg card-title">Pro</h4>
                        <p class=" pt-0  font-weight-bold card-subtitle text-dark">Here's What You'll Get:</p>
                        <div class="bg-linear-blue card-opacity text-white">
                            <div class="col-12  align-items-top mb-title">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title'>1,000 MIDIs every month</h6>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-xs-12 text-left p-0 m-0">
                                        <h6 class='m-0 p-0 card-opacity-title mt-title text-xxl-right'>$127/month Value</h6>
                                    </div>
                                </div>
                            </div>
                            <ul class="row justify-content-between m-0 p-0 ">
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left m-0 d-flex align-items-center"><i class="fa fa-circle"></i>240 Chord Progressions</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 mt-10 p-0">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center p-0">
                                        <i class="fa fa-circle"></i>240 Melodies</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex align-items-center m-0 p-0"> <i class="fa fa-circle"></i>240 Basslines</li>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-xs-12 pr-0 mr-0 ml-0 pl-0 mt-10">
                                    <li class="text-white text-left d-flex justify-content-xxl-end align-items-center m-0 p-0"> <i class="fa fa-circle"></i>280 Drum Patterns</li>
                                </div>
                            </ul>

                        </div>
                        <?php
                        $type_of_bonus_pro = get_field('bonus_variation_products_pro',$trial_parent_id);
                        $bonus_pro_total = get_field('bonus_value_pro',$trial_parent_id);
                        foreach($type_of_bonus_pro as $type_of_bonuse) {
                            $product = wc_get_product( $type_of_bonuse );
                            $dataproduct = $product->get_data();
                            $numbonus = explode(':', $dataproduct['name'])[0];
                            ?>
                            <div class="bg-linear-blue text-white card-img-text">
                                <div class="d-flex">
                                    <div class="left-part">
                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($type_of_bonuse)); ?> " class="img-fluid w-100 m-0 p-0" alt="Ultimate key">
                                    </div>
                                    <div class="right-part card-content">
                                        <h5 class="p-0 m-0"><?php echo $numbonus; ?></h5>
                                        <h6 class="text-white p-0 mt-title"><?php echo $dataproduct['name']; ?></h6>
                                        <p class="text-white font-weight-bold p-0 card-price"><?php echo '$'. $dataproduct['price']; ?> Value</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="bottom__content">
                            <p class="font-weight-bold total" style="color: #4D4C4C;
                              ">Total value:</p>
                            <p class="font-weight-bold total-price">$<?php echo $bonus_pro_total; ?></p>
                            <p class="font-weight-bold limited">Limited Time Launch Offer:</p>
                            <!-- <div class="d-flex justify-content-center text-white mt-1 font-weight-bold align-items-top">
                                <p class="price-warning font-weight-bold"> <strike>$127</strike></p>
                                <p style="color: #4D4C4C;
                                  " class="month font-weight-bold"><span class='big-price'>$27</span>/month</p>
                            </div> -->
                            <p class="font-weight-bold">$1 For 30 Days Then <span style="font-size:20px;color:#DA4A66;"><del>$127</del></span> $27/month</p>
                            <a href="/midi-box-pro-order-secure/?add-to-cart=<?php echo $id_trial['proid']; ?>" rel="noopener noreferrer">
                                <div class="text-center mx-auto button-green-offshadow btn-get btn-get-dark">
                                    <span class="text-white font-weight-bold">START $1 TRIAL NOW</span><br />
                                    <span class="font-weight-bold" style="font-size: 12px; color:#8de6da; line-height: 12px">30-Day Money-Back Guarantee</span>
                                </div>
                            </a>
                            <p class="text-center take-risk">Try It Risk Free, No Commitments,<br> Cancel Anytime With 1 Click</p>
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Group-941415.png" style="width: 60%">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>

        </div>
        </div>
    </section>
    <!-- END OF SECTION TWELVE -->

    <!-- SECTION THIRTEEN -->
    <section class="font-weight-bold money-back midi-box-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 col-xxl-11 col-xxxl-8 mx-auto text-center p-0">
                <div class=" col-12 mobile-img">
                    <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_MoneyBackGuarantee_04_G.png" class="img-fluid">
                </div>
                <div class="text-content font-weight-bold">
                    <h4 class="text-white title">MIDI Box Comes With A <br><span class="color-teal">30-Day 100% Money-Back</span> Guarantee</h4>
                </div>
                <div class="newCard-box p-0 text-white text-left row ">
                    <div class="col-6 col-lg-5 col-xl-5 desctop-img text-center">
                        <img src="<?php bloginfo('template_url') ?>/assets/images/UnisonAudio_MoneyBackGuarantee_04_G.png" class="img-fluid">
                    </div>
                    <div class="col-6 col-lg-7 col-xl-7 col-xs-12 col-sm-12 col-md-12 mx-auto">
                        <h4 class="text-white subtitle">After Getting Your First MIDI Box Today, You Can Try It Out For A <span class="color-teal">Full 30 Days.</span></h4>
                        <p>Use it to make <b class="color-teal">radio-worthy</b> chord progressions, melodies, basslines & drum grooves...</p>
                        <p>Get <b class="color-teal">tons of inspiration</b> & <b class="color-teal">finish more music</b> in less time...</p>
                        <p>And then, if you’re not <b class="color-teal">absolutely blown away</b> with your results...</p>
                        <p>If at <b class="color-teal">anytime during your first month</b> you're unsatisfied...</p>
                        <p>Just <b class="color-teal">email our support team</b> at support@unison.audio.</p>
                        <p>We'll <b class="color-teal">happily refund you every cent</b> and make your subscription available to someone else.</p>
                        <p><b class="color-teal">No questions asked.</b> No weirdness. No hard feelings.</p>
                        <p>Plus, you can <b class="color-teal">keep all the bonuses</b> absolutely free.</p>
                        <p>You have <b class="color-teal">nothing to lose</b> and everything to gain.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION THIRTEEN -->

    <!-- SECTION FOURTEEN -->
    <section class="font-weight-bold ready-section midi-box-section" style="background-color:#111225;">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-9 col-xxxl-7 mx-auto text-center p-0">
                <!--
                    <div class="mb-5" style="background-image: url( '<?php bloginfo('template_url') ?>/assets/images/Layer 40.png'); background-size: contain; background-repeat: no-repeat; background-position: center;"> -->

                <!-- </div> -->
                <h4 class="text-white position-relative title">Are You <span class="color-teal">Ready?</span></h4>
                <!-- <div class="my-3"> -->
                <div class="newCard-box p-0">
                    <div class="d-flex flex-column-reverse flex-lg-row p-0 align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 mx-auto text-left font-weight-bold p-0">
                            <h4 class="subtitle">If You <span class="color-teal">Want</span> To:</h4>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto p-0 text-list">
                                <div class=" p-0" style="display: flex; flex-direction: row; text-align: left;">
                                    <div class="mr-3">
                                        <p>
                                            <i class="fa fa-check  color-teal"></i>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <p>
                                            Make <b class="color-teal">hit songs</b> using radio-worthy chord progressions, melodies, basslines & drum grooves
                                        </p>
                                    </div>
                                </div>
                                <div class=" p-0" style="display: flex; flex-direction: row; text-align: left;">
                                    <div class="mr-3">
                                        <p>
                                            <i class="fa fa-check  color-teal"></i>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <p>
                                            Consistently <b class="color-teal">finish more music</b> than you ever thought possible
                                        </p>
                                    </div>
                                </div>
                                <div class=" p-0" style="display: flex; flex-direction: row; text-align: left;">
                                    <div class="mr-3">
                                        <p>
                                            <i class="fa fa-check  color-teal"></i>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <p>
                                            Make music you can <b class="color-teal">actually be proud of</b>
                                        </p>
                                    </div>
                                </div>
                                <div class=" p-0" style="display: flex; flex-direction: row; text-align: left;">
                                    <div class="mr-3">
                                        <p>
                                            <i class="fa fa-check  color-teal"></i>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <p>
                                            Make a significant <b class="color-teal">positive impact</b> on people with your music
                                        </p>
                                    </div>
                                </div>
                                <div class=" p-0" style="display: flex; flex-direction: row; text-align: left;">
                                    <div class="mr-3">
                                        <p>
                                            <i class="fa fa-check  color-teal"></i>
                                        </p>
                                    </div>
                                    <div class="w-100">
                                        <p>
                                            Potentially even make a <b class="color-teal">full-time career</b> out of music production...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/hot100.png" class="img-fluid w-90">
                        </div>
                    </div>

                    <div class="row pt-0 pt-sm-5  align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/Tier 3.png" class="img-fluid pt-5 pt-lg-0 w-100">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto text-left font-weight-bold number-list">
                            <h4 class="subtitle">MIDI Box Is <span class="color-teal">For You</span> — And All That's Left To Do Is...</h4>
                            <div class=" p-0" style="display: flex; flex-direction: row; text-align: left; align-items: center">
                                <div class="circle d-flex flex-align-center justify-content-center">
                                    <p>
                                        <span>1.</span>
                                    </p>
                                </div>
                                <div class="col-9 p-0">
                                    <p >
                                        <b class="color-teal">Click</b> the "Get MIDI Box Now" button below.
                                    </p>
                                </div>
                            </div>
                            <div class=" p-0" style="display: flex; flex-direction: row; text-align: left; align-items: center">
                                <div class="circle d-flex flex-align-center justify-content-center">
                                    <p>
                                        <span>2.</span>
                                    </p>
                                </div>
                                <div class="col-9 p-0">
                                    <p>
                                        <b class="color-teal">Select</b> the pro tier, or whatever tier is best for you
                                    </p>
                                </div>
                            </div>
                            <div class=" p-0" style="display: flex; flex-direction: row; text-align: left; align-items: center">
                                <div class="circle d-flex flex-align-center justify-content-center">
                                    <p>
                                        <span>3.</span>
                                    </p>
                                </div>
                                <div class="col-9 p-0">
                                    <p>
                                        <b class="color-teal">Complete your order</b> on the next page.
                                    </p>
                                </div>
                            </div>
                            <div class=" p-0" style="display: flex; flex-direction: row; text-align: left; align-items: center">
                                <div class="circle d-flex flex-align-center justify-content-center" >
                                    <p>
                                        <span>4.</span>
                                    </p>
                                </div>
                                <div class="col-9 p-0">
                                    <p>
                                        <b class="color-teal">Instantly get access to your first MIDI box</b> in your Unison account & email inbox.
                                    </p>
                                </div>
                            </div>
                            <div class=" p-0" style="display: flex; flex-direction: row; text-align: left; align-items: center">
                                <div class="circle d-flex flex-align-center justify-content-center">
                                    <p>
                                        <span>5.</span>
                                    </p>
                                </div>
                                <div class="col-9 p-0">
                                    <p>
                                        <b class="color-teal">Download</b> your MIDI Box and unzip the folder.
                                    </p>
                                </div>
                            </div>
                            <p class="ready-p desktop-ready-p">And just like that, you'll be off to the races.<br> Ready to produce <b class="color-teal">hit songs</b> — while getting loads of inspiration. </p>
                            <p class="ready-p mobile-ready-p">And just like that, you'll be off to the races. Ready to produce <b class="color-teal">hit songs</b> — while getting loads of inspiration. </p>
                            <p class="ready-p ready-p2">Starting <b class="color-teal">just a few minutes</b> from now... The  <b class="color-teal">decision is yours. </b></p>
                        </div>
                    </div>

                    <!-- BUTTON WHITE TEXT DARK SHADOW -->
                    <div class="pt-5">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-xxxl-7 mx-auto">
                            <a href="#midi-box-pricing" rel="noopener noreferrer">
                                <div class="mx-auto text-center bg-success p-3 button-green-glow">
                                    <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                                    <span class="font-weight-bold" style="font-size: 12px; color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </section>
    <!-- END OF SECTION FOURTEEN -->
    <!-- SECTION FIFTEEN -->
    <section class="bg-white midi-asks-section midi-box-section text-dark">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-9 col-xxxl-8 mx-auto text-center p-0">
                <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto p-0 pl-lg-3 pr-lg-3">
                    <h4 class="text-dark title">Frequently Asked Questions</h4>
                    <div id="accordion" class="p-0 mt-4">
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseOne">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        1. How will MIDI Box be delivered to me and how quickly?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseOne" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>The download link for the current month's MIDI Box and all the bonuses will be sent to your email sent to your email address and enabled in your Unison account immediately after your purchase. Then, you'll receive
                                        each following month's MIDI Box in your Unison Account and will get an email notification.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseTwo">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        2. What DAWs is MIDI Box compatible with?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseTwo" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>MIDI Box is compatible with any DAW such as Ableton Live, FL Studio, Logic Pro, Pro Tools, Studio One, Cubase, Reason, Reaper, Cakewalk, Mixcraft, Bitwig GarageBand and all others. It's both Mac & PC compatible
                                        and no installation is required</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseThree">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        3. What are the difference between tiers?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseThree" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>The Pro tier will give you maximum results in the shortest time, as well as the best value with 800 unique MIDI files per month. The Plus tier gives you 400 MIDI files/month and Lite gives you 160. The ratio of
                                        chord progressions, melodies, basslines & drum kits remains the same. The Pro tier is clearly the smartest choice, but you can choose whatever tier works best for you.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseFour">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        4. Are the MIDI files royalty free?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseFour" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>Yes, all MIDI Box files you'll be getting every month are 100% royalty free & cleared for commercial use. This means you can use them in your music however you want and all the money you earn from music you create
                                        with MIDI Box files is yours for the keeping.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseFive">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        5. Does it matter what genre I produce?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseFive" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>The MIDI chord progressions, melodies, basslines & drum kits inside each month's MIDI box cover all 30 major genres of music. So whether you're into producing hip hop beats, house, R&B, pop, ambient, Lo-Fi, future
                                        bass, funk, jazz, classical, rock or anything else, you're good. Plus you get the unfair advantage over normal producers from being able to use elements from different genres you wouldn't normally think of to
                                        make your music unique and stand out.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseSix">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        6. Will MIDI Box be difficult to use?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseSix" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>MIDI Box is super simple and easy to use. Whether you're a beginner, intermediate or advanced, we've taken the hard work out of it for you and set you up for instant results. Just unzip the folder, drag & drop your
                                        MIDI files into your project, load up your favorite sounds and press play. From there you can customize everything if you'd like and have fun finishing & releasing professional-sounding music.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseSeven">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        7. How does cancelation work? Is it easy?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseSeven" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>Canceling your MIDI Box subscription is as easy as 1 click from your Unison account. No need to email support or talk to anyone on the phone. No weirdness or hidden terms. All you have to do is log into your Unison
                                        account, click cancel and you won't be charged again and will stop receiving new MIDI Boxes. And at any point if you change your mind, you can resume your subscription. The control is all in your hands. If you're
                                        not happy, we don't want your money.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseEight">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        8. Is each month's MIDI box brand new?
                                    </h5>
                                </div>
                                <div class="col-1  col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseEight" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>Yes, every month is never-before-released and exclusive to MIDI box members.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseNine">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        9. Can I use the MIDI files with any sounds?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseNine" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>Yes, the beauty of MIDI is that you're not limited like audio loops, where the sound of the patterns are pre-determined and unmodifiable. With MIDI Box, we give you the blueprint of proven chord progressions, melodies,
                                        basslines & drums, the sounds you use with them are up to you. You can use them with all your favorite samples, synths, VST's and more. That way you can really make them your own and feel limitless in the studio.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapseTen">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        10. Is MIDI Box cheating?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapseTen" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>Considering that the best producers in the world work smart, not hard... Any producer that thinks using MIDI Box is cheating likely has no impressive results to show for themselves. So, using MIDI Box is the biggest
                                        step you can take to save time and get massive results instantly. Producers who don't jump on board will get left behind and will be at a huge disadvantage.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapse11">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        11. What payment options are available?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapse11" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>We securely accept payments through all major credit cards. You'll choose your payment method after you click the button below, select the Pro tier (or whatever works best for you) and go to the next
                                        page. Your information is never shared. We respect your privacy.</p>
                                    <p>If at any point your subscription payment fails, your subscription will be paused and you won't receive a new MIDI Box until the payment goes through.</p>
                                </div>
                            </div>
                        </div>
                        <div class="acordion-item pointer mb-4">
                            <div class="row mx-auto rounded-xs acc-close align-items-center align-items-lg-top" aria-expanded="false" id="collapse-accordion" data-toggle="collapse" data-target="#collapse12">
                                <div class="col-11 col-xs-10 pl-0">
                                    <h5 class="accordion-header text-left">
                                        12. What if I'm unsatisfied with MIDI Box?
                                    </h5>
                                </div>
                                <div class="col-1 col-xs-2 text-white text-right">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/black arr down.png" id="btn-down">
                                    <img src="<?php bloginfo('template_url') ?>/assets/images/white arr up.png" id="btn-up">
                                </div>
                            </div>

                            <div id="collapse12" data-parent="#accordion" class="collapse">
                                <div class="text-left acc-open">
                                    <p>MIDI Box comes with a 30 Day, 100% Money Back Guarantee. That means if you change your mind about this decision at any point in the next month – all you need to do is email us at support@unison.audio and we’ll refund
                                    your initial payment and cancel your subscription for you. No questions asked. No weirdness. No hard feelings. Plus, you can keep all the bonuses absolutely free. You have nothing to lose and everything to gain.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6  col-xxl-7 col-xxxl-5 text-center mx-auto">
                            <div>
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Tier group midi3.svg" class="img-fluid w-100">
                            </div>
                        </div>
                    </div>
                    <!-- BUTTON WHITE TEXT DARK SHADOW -->
                    <a href="#midi-box-pricing" rel="noopener noreferrer">
                        <div class="col-md-6 col-sm-8 text-center mx-auto mt-5 button-green button-green-glow">
                            <span class="font-weight-bold text-white">START $1 TRIAL NOW</span><br />
                            <span class="font-weight-bold" style="font-size: 12px;color:#8de6da; line-height: 12px">Limited Time Special Launch Offer</span>
                        </div>
                    </a>
                    <img class="img-fluid images-line mobile-img" src="<?php bloginfo('template_url') ?>/assets/images/group icons.svg" alt="Image caption">
                    <img class="img-fluid images-line desctop-img" src="<?php bloginfo('template_url') ?>/assets/images/Daw-Icons-with-bitwig copy.png" alt="Image caption">
                </div>
            </div>
        </div>
    </section>
    <!-- END OF SECTION FIFTEEN -->
</main>
<script>
    jQuery(document).ready(function () {  $("audio").mediaelementplayer({
        success: function(mediaElement, domObject) {
            mediaElement.addEventListener('playing', function(index) {
                console.log("event triggered after play method");
                console.log(index)
                let player = document.querySelector(`#${index.detail.target.id}`)
                let container = player.closest('.mejs-mediaelement')
                let playText = player.closest('.player-text')
                console.log(playText)
                playText.style.color = "#1cbaa4"
                container.classList.add('play-blue')



            }, false);
            mediaElement.addEventListener('pause', function(index) {
                console.log("event triggered after pause method");
                let player = document.querySelector(`#${index.detail.target.id}`)
                let container = player.closest('.mejs-mediaelement')
                let playText = container.closest('.player-text')
                playText.style.color = "white"
                container.style.background="transparent !important"
                container.classList.remove('play-blue')

            }, false);
        }
    })})
</script>
<!-- Footer -->
<?php get_footer(); ?>