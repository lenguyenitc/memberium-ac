<?php
/*
 * Template Name: Midi chord pack special v3
 *
 * */
get_header('landingpages');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">

<style>
/* Common Css */
:root {
    --color-white: #ffffff;
    --color-white-light: rgba(255, 255, 255, 0.8);
    --color-black: #000000;
    --color-black-light: rgb(29, 30, 29);
    --text-green: rgb(45, 218, 191);
    --family-gotham-regular: 'Gotham Book Regular', sans-serif;
    --family-gotham-bold: 'Gotham Bold', Arial, sans-serif;
}
html {
  scroll-behavior: smooth;
  margin-top: 0 !important;
}
body.bg-dark header,
footer.bg-dark {
    display: none;
}

/* Custom Classes */
.page-container {
    max-width: 1170px;
    width: 100%;
    margin: 0 auto;
}
.midi-chord-pack .p-10 {
    padding: 0px 10px;
}
.bg-cover {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
.text-green {
    color: var(--text-green);
}
.family-gotham-regular {
    font-family: var(--family-gotham-regular);
}
.family-gotham-bold {
    font-family: var(--family-gotham-bold);
}
.bg-black-light {
    background: var(--color-black-light);
}
.page-section {
    padding: 45px 0px;
}
.d-block-770 {
    display: none;
}
.midi-chord-pack ul {
    margin: 0px;
}
.midi-chord-pack .section-heading h1 {
    font-size: 34px;
    line-height: 1.3em;
}
.midi-chord-pack .section-heading h3.title {
    font-size: 34px;
    line-height: 1.3em;
}
.midi-chord-pack p {
    color: var(--color-white-light);
    font-size: 18px;
}
.midi-chord-pack p b {
    color: var(--color-white);
}
.btn-design a.elButton {
    display: block;
    width: 100%;
    padding: 10px 40px;
    -webkit-box-shadow: 0px 5px 10px 0px rgb(28,186,164) !important;
    -moz-box-shadow: 0px 5px 10px 0px rgb(28,186,164) !important;
    box-shadow: 0px 5px 10px 0px rgb(28,186,164) !important;
    border-radius: 3px;
    border: 0px;
    color: rgb(255, 255, 255);
    font-size: 28px;
    font-weight: 600;
    text-align: center;
    background-color: rgb(28, 186, 164);
    text-decoration: none;
    cursor: pointer;
}
.btn-design a.elButton:hover {
    background-color: #2DDABF;
}
.btn-design a > * {
    display: block;
}
.btn-design a .elButtonSub {
    font-size: 14px;
    opacity: 0.7;
}

/* Main Css Start */
.top-msg {
    background-color: rgba(228, 59, 44, 0.95);
    padding: 5px 0px;
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    z-index: 99;
}
.top-msg p {
    color: rgb(255, 255, 255);
    font-size: 14px;
    line-height: 16px;
    font-weight: 700;
}
.midi-header {
    padding: 10px 0px;
    background-color: rgb(24, 24, 24);
    border-bottom: 1px solid rgb(45, 45, 45);
    margin-top: 26px;
}
.midi-header .header__inner {
    padding: 0px 25px;
    align-items: center;
}
.midi-header .header__inner > div {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0px 10px;
}
.midi-header .header__inner .midi-menu ul {
    display: flex;
    justify-content: end;
    margin: 0px;
}
.midi-header .header__inner .midi-menu ul li:not(:last-child) {
    margin-right: 25px;
}
.midi-header .header__inner .midi-menu ul li a {
    color: rgb(255, 255, 255);
    font-size: 14px;
    font-family: 'Gotham Bold', Arial, sans-serif;
    opacity: .8;
    font-weight: 600;
    cursor: pointer;
}
.midi-header .header__inner .midi-menu ul li a:hover {
    text-decoration: underline;
}
.drag-drop-midi {
    background-repeat: no-repeat !important;
    background-size: 100% auto !important;
    background: rgb(27, 27, 27);
    padding-top: 30px;
}
.drag-drop-midi .drag-drop__inner {
    max-width: 92%;
    margin: 0px auto;
}
.drag-drop-midi h4 {
    font-size: 18px;
    letter-spacing: 1px;
    line-height: 1.3em;
    text-transform: inherit;
    margin-top: -10px !important;
    margin-bottom: 2px !important;
}
.drag-drop-midi h3 {
    font-size: 22px;
    line-height: 1.3em;
    margin: 3px 0px 12px !important;
}
.drag-drop-midi .midi-chord-video {
    max-width: 75%;
    margin: 0 auto;
    margin-bottom: 20px;
    padding: 0px 15px;
}
.drag-drop-midi .drag-drop__list {
    width: 85%;
    max-width: 100%;
    margin: 0 auto;
}
.drag-drop-midi .list-point {
    margin-bottom: 10px;
}
.drag-drop-midi .list-point li {
    font-size: 18px;
    color: var(--color-white-light);
    padding-bottom: 6px;
    margin-bottom: 6px;
    padding-left: 2em;
    position: relative;
}
.drag-drop-midi .list-point li b {
    color: var(--color-white);
}
.drag-drop-midi .list-point li i {
    position: absolute;
    left: 0;
    top: 5px;
    color: var(--text-green);
}
.drag-drop-midi .actions-btn {
    width: 42%;
    max-width: 100%;
    margin: 0px auto;
    padding: 5px 0px 40px 0px;
}
.drag-drop-midi .worked-with-daws h5 {
    font-size: 12px;
    font-weight: 500;
}
.drag-drop-midi .worked-logos-sec {
    width: 80%;
    margin: 0 auto;
    padding: 15px 0px 40px 0px;
}
.midi-leftRight {
    padding: 30px 0px 50px;
}
.midi-leftRight__box {
    display: flex;
    border-radius: 5px;
}
.midi-leftRight__box.purple {
    background-image: linear-gradient(#1d1134, #621a62);
}
.midi-leftRight__box.green {
    background-image: linear-gradient(#072d28, #1dbaa4);
}
.midi-leftRight__box.grey {
    background-image: linear-gradient(#747474, #c6c6c6);
}
.midi-leftRight__box > div {
    flex: 0 0 50%;
    max-width: 50%;
}
.midi-leftRight__box .content__part {
    padding: 5px 25px 35px;
    background-color: rgb(36, 36, 36);
}
.midi-leftRight__box .content__part h3 {
    font-size: 33px !important;
    margin-top: 25px !important;
    margin-bottom: 15px !important;
}
.midi-leftRight__box .img__part {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.midi-leftRight__box .img__part img {
    max-width: 400px;
}
.midi-leftRight__box .content__part .list-option {
    margin-top: 15px;
    margin-bottom: 15px;
}
.midi-leftRight__box .content__part .list-option li {
    font-size: 18px;
    color: var(--color-white);
    padding-bottom: 6px;
    list-style-type: none;
    margin-bottom: 6px;
    padding-left: 2em;
    letter-spacing: -0.1px;
    position: relative;
}
.midi-leftRight__box .content__part .list-option li b {
    color: var(--color-white);
}
.midi-leftRight__box .content__part .list-option li i {
    position: absolute;
    left: 0;
    top: 5px;
    color: rgb(228, 59, 44);
}
.midi-leftRight__box .content__part .list-option li i.fa-check {
    color: var(--text-green);
}
.midi-leftRight__box .content__part .text-box p:not(:last-child) {
    margin-bottom: 25px;
}
.midi-whatPros {
    padding: 35px 0px 45px;
}
.midi-whatPros .page-container {
    max-width: 80%;
}
.midi-whatPros .section-heading {
    padding: 0px 20px;
}
.midi-whatPros .midi-chord__row {
    display: flex;
    margin-top: 20px;
}
.midi-whatPros .midi-chord__row > div {
    flex: 0 0 33.33333333%;
    width: 33.33333333%;
}
.midi-chord__card .midi-chord__cardInner {
    padding: 25px 15px 20px;
    background-color: rgb(26, 26, 26);
    margin: 5px 10px 0px 0px;
    border-radius: 5px;
    height: 100%;
}
.midi-chord__card p {
    color: rgb(255, 255, 255);
    font-size: 17px;
    text-align: center;
}
.midi-chord__card .midi__card_foot {
    display: flex;
    margin-top: 25px;
}
.midi-chord__card .midi__card_foot .img-box {
    flex: 0 0 30%;
    width: 30%;
}
.midi-chord__card .midi__card_foot .img-box img {
    max-width: 100%;
    -webkit-box-shadow: 0 2px 5px 2px rgb(0 0 0 / 30%);
    -moz-box-shadow: 0 2px 5px 2px rgba(0,0,0,0.3);
    box-shadow: 0 2px 5px 2px rgb(0 0 0 / 30%);
    border-radius: 50%;
}
.midi-chord__card .midi__card_foot .text-box {
    flex: 0 0 70%;
    width: 70%;
    padding: 0px 10px;
}
.midi-chord__card .midi__card_foot .text-box h3 {
    font-size: 24px;
    margin: 10px 0px 6px !important;
}
.midi-chord__card .midi__card_foot .text-box p {
    text-align: left;
    font-size: 14px;
    line-height: 20px;
    /* font-family: 'Gotham Medium Regular', Arial, sans-serif; */
    font-weight: 600;
}
.midi-chord-pack.midi-progression {
    padding: 35px 0px 55px;
}
.midi-progression .section-heading {
    padding: 0px 20px;
}
.midi-progression .midi-progression-flex {
    width: 97%;
    max-width: 100%;
    margin: 30px auto 0px;
    background-color: rgb(36, 36, 36);
}
.midi-progression .midi-progression-flex .col-left {
    flex: 0 0 58.33333333%;
    width: 58.33333333%;
    padding: 15px 30px 25px;
    border-radius: 5px 0px 0px 5px
}
.midi-progression .midi-progression-flex .section-heading {
    padding: 0px;
}
.midi-progression .midi-progression-flex .section-heading h3.title {
    margin-top: 20px !important;
    margin-bottom: 15px !important;
}
.midi-progression .midi-progression-flex .col-left p:not(:last-child) {
    margin-bottom: 25px;
}
.midi-progression .midi-progression-flex .col-right {
    flex: 0 0 41.66666667%;
    width: 41.66666667%;
}
.midi-progression .midi-progression-flex .squares {
    width: 472px;
    height: 460px;
    overflow: hidden;
}
.midi-progression .midi-progression-flex .audiosqs {
    width: 472px;
    height: 92px;
    background-size: 100% 100%;
    border-style: solid;
    border-width: 0px;
    border-color: #eee;
    float: left;
}
.midi-progression .midi-progression-flex .audiosqs:hover {
    filter: brightness(130%);
}
#sq1 {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Play-1.png');
}
#sq2 {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/play-2.png');
}
#sq3 {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/PLAY-3.png');
}
#sq4 {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/PLAY-4.png');
}
#sq5 {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/PLAY-5.png');
}
.sq1-swap {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Pause-1.png')!important;
}
.sq2-swap {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Pause-2.png')!important;
}
.sq3-swap {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Pause-3.png') !important;
}
.sq4-swap {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Pause-4.png') !important;
}
.sq5-swap {
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Pause-5.png')  !important;
}
.midi-chord-pack.midi-easy-step {
    padding: 35px 0px 45px;
    background-color: rgb(29, 30, 29);
}
.midi-easy-step .section-heading {
    padding: 0px 20px;
    padding-bottom: 30px !important;
}
.midi-easy-step .midi-easyStep-flex {
    width: 90%;
    max-width: 100%;
    margin: 0 auto;
    background-color: rgb(26, 26, 26);
    border-radius: 5px;
    margin-bottom: 20px;
}
.midi-easy-step .content-box {
    flex: 0 0 41.66666667%;
    max-width: 41.66666667%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 10px;
}
.midi-easy-step .video-box  {
    flex: 0 0 58.33333333%;
    max-width: 58.33333333%;
    padding: 0 10px;
}
.midi-easy-step .content-box .section-heading {
    padding-bottom: 10px !important;
}
.midi-easy-step .midi-easyStep-notify {
    width: 90%;
    max-width: 100%;
    margin: 0 auto;
    padding: 5px 10px;
}
.midi-easy-step .midi-easyStep-notify p {
    color: rgb(184, 184, 184);
    font-size: 11px;
    text-align: right;
}
.midi-chord-pack.midi-what-will-get {
    padding: 35px 0px 45px;
}
.midi-what-will-get .section-heading {
    padding: 0px 20px;
    padding-bottom: 30px !important;
}
.midi-what-will-get .midi-willGet-flex {
    width: 95%;
    max-width: 100%;
    margin: 0 auto;
    background-image: linear-gradient(#747474, #c6c6c6);
    border-radius: 5px;
}
.midi-what-will-get .midi-willGet-flex .audio-box {
    flex: 0 0 41.66666667%;
    max-width: 41.66666667%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0px 10px;
    /* box-sizing: content-box; */
}
.midi-what-will-get .midi-willGet-flex .audio-box .audio {
    width: 100%;
}
.midi-what-will-get .midi-willGet-flex .content-box {
    flex: 0 0 58.33333333%;
    max-width: 58.33333333%;
    padding: 30px 30px 15px;
    background-color: rgb(36, 36, 36);
}
.midi-what-will-get .midi-willGet-flex .content-box .list-options li {
    padding-bottom: 6px;
    list-style-type: none;
    margin-bottom: 6px;
    padding-left: 2em;
    font-size: 18px;
    color: var(--color-white);
    position: relative;
}
.midi-what-will-get .midi-willGet-flex .content-box .list-options li i {
    position: absolute;
    left: 0;
    top: 5px;
    color: var(--color-white);
}
.midi-what-will-get .midi-willGet-flex .content-box .list-options li b {
    color: rgb(45, 218, 191);
}
.midi-what-will-get .midi-willGet-flex .audio-box p {
    margin: 33px 0px 10px;
    font-size: 12px;
    color: var(--color-black);
    font-weight: 500;
    line-height: 17px;
}
.midi-willGet-flex .audio-box .mejs-container {
    background-color: #1cbaa4 !important;
    border-radius: 5px !important;
}
.midi-willGet-flex .audio-box .mejs-controls {
    font-family: 'Gotham Medium Regular', Arial, sans-serif;
    background-color: #1cbaa4;
    background: -webkit-linear-gradient(transparent, rgba(0,0,0,0.35)) !important;
    background: linear-gradient(transparent, rgba(0,0,0,0.35)) !important;
    border-radius: 5px !important;
    padding: 0 10px !important;
}
.midi-willGet-flex .audio-box .mejs-controls .mejs-volume-button {
    display: block !important;
}
.midi-willGet-flex .audio-box .mejs-controls a.mejs-horizontal-volume-slider {
    display: block !important;
}
.midi-willGet-flex .audio-box .mejs-time span {
    font-family: 'Gotham', Arial, sans-serif;
    font-weight: 700;
}
.midi-willGet-flex .audio-box .mejs-time .mejs-time-buffering, 
.mejs-time-current, .mejs-time-float, 
.mejs-time-float-corner, 
.mejs-time-float-current, 
.mejs-time-hovered, 
.mejs-time-loaded, 
.mejs-time-marker, 
.mejs-time-total {
    height: 10px !important;
    border-radius: 2px !important;
}
.mejs-controls .mejs-time-rail .mejs-time-loaded {
    background: rgba(255,255,255,0.3) !important;
}
.midi-willGet-flex .audio-box .mejs-controls .mejs-time-rail .mejs-time-current {
    height: 10px !important;
    border-radius: 2px !important;
    background: rgba(255,255,255,0.9) !important;
}
.mejs-time-float {
    display: none !important;
}
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total, 
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
    border-radius: 2px !important;
}
.mejs-horizontal-volume-total {
    background: rgba(50,50,50,0.8) !important;
}
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
    background: rgba(255,255,255,0.8) !important;
}
.mejs__time-rail .mejs__time-handle-content:active, 
.mejs__time-rail .mejs__time-handle-content:focus, 
.mejs__time-rail:hover .mejs__time-handle-content {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}
.midi-willGet-flex .audio-box .mejs-controls .mejs-time-rail .mejs__time-handle-content {
    border: 4px solid rgba(255,255,255,0.9) !important;
    /* display: block !important; */
    background: rgba(255,255,255,0.9) !important; 
    /* border-radius: 50% !important; */
}
.midi-willGet-flex .audio-box .mejs-time-handle, .mejs-time-handle-content {
    display: block !important;
    border-radius: 50% !important;
}
.midi-what-will-get .actions-btn {
    width: 45%;
    max-width: 100%;
    margin: 55px auto 20px;
    padding: 0px 20px;
}
.midi-chord-pack.midi-exclusive-bonus {
    padding: 30px 0px 50px;
}
.midi-exclusive-bonus .section-image {
    padding: 20px;
}
.midi-exclusive-bonus .section-image img {
    max-width: 100%;
    margin: 0 auto;
}
.midi-exclusive-bonus .section-heading {
    padding: 10px 20px;
}
.midi-exclusiveBonus_box {
    margin: 20px auto 0px;
    border-radius: 5px;
}
.midi-exclusiveBonus_box.gray {
    background-image: linear-gradient(#d3dfed, #304155);
}
.midi-exclusiveBonus_box.green {
    background-image: linear-gradient(#1dbaa3, #061e1a);
}
.midi-exclusiveBonus_box.orange {
    background-image: linear-gradient(#f87f3e, #6e2001);
}
.midi-exclusiveBonus_box .content__part {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 35px 25px 35px;
    background-color: rgb(26, 26, 26);
    text-align: center;
}
.midi-exclusiveBonus_box .img__part {
    flex: 0 0 50%;
    max-width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.midi-exclusiveBonus_box .img__part img {
    max-width: 225px;
}
.midi-exclusiveBonus_box .content__part h4 {
    font-size: 18px;
}
.midi-exclusiveBonus_box .content__part .section-heading {
    padding: 0px;
    margin-bottom: 3px;
}
.midi-exclusiveBonus_box .content__part .section-heading h3.title {
    font-size: 32px;
}
.midi-exclusiveBonus_box .content__part p {
    margin-top: 15px;
}
.midi-chord-pack.get-bonus-now {
    padding: 20px 0px 40px;
    background-image: linear-gradient(to right, #161619, #414149);
}
.get-bonus-now .section-heading {
    padding: 20px;
}
.get-bonus-now .get-bonusNow_inner .image-box {
    padding: 5px 20px 0px;
    text-align: center;
}
.get-bonus-now .get-bonusNow_inner .image-box img {
    margin: 0 auto;
}
.get-bonus-now .get-bonusNow_inner .content-box {
    width: 50%;
    max-width: 100%;
    margin: 0px auto;
    padding: 15px 20px 20px;
    text-align: center;
}
.get-bonus-now .get-bonusNow_inner .content-box h3 {
    margin: 10px 0px 15px !important;
    font-family: 'Gotham Bold', Arial, sans-serif;
    font-weight: 600 !important;
    font-size: 18px;
    color: rgb(255, 255, 255);
    letter-spacing: 3px;
}
.get-bonus-now .get-bonusNow_inner .content-box p {
    color: rgb(255, 255, 255);
    font-size: 14px;
    margin: 15px 0px 10px !important;
}
.get-bonus-now .get-bonusNow__flex {
    padding: 30px 15px 15px;
    margin: 10px 0px 0px;
    background-color: rgb(26, 26, 26);
    border-radius: 5px;
}
.get-bonus-now .get-bonusNow__flex .img-bx {
    flex: 0 0 58.33333333%;
    width: 58.33333333%;
    padding: 0px 10px;
}
.get-bonus-now .get-bonusNow__flex .list-bx {
    flex: 0 0 41.66666667%;
    width: 41.66666667%;
    padding: 0px 10px;
}
.get-bonus-now .get-bonusNow__flex .list-bx ul {
    margin-bottom: 10px;
}
.get-bonus-now .get-bonusNow__flex .list-bx ul li {
    padding-bottom: 6px;
    list-style-type: none;
    margin-bottom: 6px;
    padding-left: 2em;
    font-size: 15px;
    color: rgb(255, 255, 255);
    position: relative;
    font-weight: 600;
}
.get-bonus-now .get-bonusNow__flex .list-bx ul li i {
    position: absolute;
    left: 0;
    top: 5px;
    color: rgb(1, 199, 180);
}
.midi-chord-pack.midi-lifetime-guarantee {
    padding: 30px 0px 50px;
}
.midi-lifetime-guarantee .midi-moneyBack_inner {
    margin-top: 25px;
    background-image: linear-gradient(#ffd88b, #734f02);
    border-radius: 5px;
}
.midi-lifetime-guarantee .midi-moneyBack_inner .column-left {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.midi-lifetime-guarantee .midi-moneyBack_inner .column-right {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 30px 25px 35px;
    background-color: rgb(36, 36, 36);
}
.midi-lifetime-guarantee .midi-moneyBack_inner .column-right .text-box {
    margin-top: 10px;
}
.midi-lifetime-guarantee .midi-moneyBack_inner .column-right .text-box h4 {
    margin-bottom: 25px !important;
    font-size: 18px;
    text-transform: inherit;
}
.midi-lifetime-guarantee .midi-moneyBack_inner .column-right .text-box p:not(:last-child) {
    margin-bottom: 25px !important;
}
.midi-lifetime-guarantee .actions-btn {
    width: 50%;
    max-width: 100%;
    margin: 45px auto 0px;
    padding: 0px 10px 20px;
}
.midi-chord-pack.midi-other-producer-video {
    padding: 35px 0px 50px;
}
.midi-other-producer-video .page-container__inner {
    max-width: 80%;
}
.midi-other-producer-video .section-heading {
    padding: 0px 20px 20px;
}
.midi-other-producer-video .midi-proVideo__card {
    flex: 0 0 33.33333333%;
    width: 33.33333333%;
    padding: 15px 15px 20px;
    background-color: rgb(26, 26, 26);
    margin-right: 10px;
    border-radius: 5px;
}
.midi-other-producer-video .info-box {
    margin-top: 20px;
    text-align: center;
}
.midi-other-producer-video .info-box p {
    color: rgb(255, 255, 255);
    font-size: 17px;
}
.midi-other-producer-video .info-box h3 {
    margin: 15px 0px 5px !important;
    font-size: 24px;
    color: rgb(28, 186, 164);
    line-height: 26px;
}
.midi-other-producer-video .actions-btn {
    width: 50%;
    max-width: 100%;
    margin: 0px auto;
    margin: 40px auto 0px;
    padding: 0px 20px 20px;
}
.midi-chord-pack.midi-chord-faqs {
    padding: 20px 0px 40px;
}
.midi-chord-faqs .section-heading {
    padding: 20px;
}
.midi-chord-faqs .midi-chord-faqs__inner {
    width: 80%;
    max-width: 100%;
    margin: 0px auto;
    padding: 10px 20px 25px;
}
.midi-chord-faqs .custom-accordion .card {
    margin-bottom: 10px;
    background: 0px;
}
.midi-chord-faqs .custom-accordion .card .card-header {
    padding: 0px;
}
.midi-chord-faqs .custom-accordion .card button {
    width: 100%;
    border: 0px;
    font-size: 18px;
    padding: 18px;
    background-color: #01c7b4;
    color: #fff;
    border-radius: 5px;
    line-height: inherit;
    font-weight: 600;
    font-family: 'Gotham Bold', Arial, sans-serif;
    text-transform: inherit;
    transition: 0.4s;
}
.midi-chord-faqs .custom-accordion .card button.collapsed {
    background-color: #eee;
    color: #444;
}
.midi-chord-faqs .custom-accordion .card button:hover {
    background-color: #01c7b4;
    color: #fff;
}
.midi-chord-faqs .custom-accordion .card .card-body {
    /* font-family: 'Gotham Book Regular', Arial, sans-serif; */
    font-size: 18px;
    padding: 18px 18px 28px !important;
    border-radius: 5px;
    background-color: #242424;
    margin-top: 10px;
    width: 100%;
}
.midi-chord-faqs .custom-accordion .card .card-body p {
    color: #f9f9f9;
}
.midi-chord-faqs .custom-accordion .card .card-body p:not(:last-child) {
    margin-bottom: 28px;
}
.midi-chord-faqs .actions-btn {
    width: 50%;
    max-width: 100%;
    margin: 0px auto;
    padding: 10px 20px 30px;
}
.midi-chord-pack.midi-benefits {
    padding: 25px 0px 20px;
}
.midi-benefits .midi-benefits_inner {
    padding: 0px 10px;
}
.midi-benefits .midi-benefits_inner > div {
    padding: 0px 10px;
    flex: 0 0 50%;
    max-width: 50%;
    display: flex;
}
.midi-benefits .midi-benefits_inner div .img-bx {
    flex: 0 0 20%;
    max-width: 20%;
}
.midi-benefits .midi-benefits_inner .midi-benefits__box .text-bx {
    flex: 0 0 80%;
    max-width: 80%;
    padding: 0px 10px;
}
.midi-benefits .midi-benefits_inner .midi-benefits__box .text-bx h3 {
    font-size: 22px;
    color: rgb(255, 255, 255);
    margin: 10px 0px 6px !important;
    line-height: 1.1;
}
.midi-benefits .midi-benefits_inner .midi-benefits__box .text-bx p {
    font-size: 15px;
    color: rgb(255, 255, 255);
    line-height: 1.42857143;
}
.midi-chord-pack.midi-chord-copyright {
    padding: 5px 0px 15px;
}
.midi-chord-copyright .midi-copyright_row {
    padding: 0px 10px;
    text-align: center;
}
.midi-chord-copyright .midi__divider {
    padding: 10px 0px;
}
.midi-chord-copyright .midi__divider .line {
    height: 1px;
    background: rgb(47, 47, 47);
}
.midi-chord-copyright .midi-copyright_row p {
    margin: 10px 0px 5px;
    font-size: 14px;
    color: rgb(255, 255, 255);
    line-height: normal;
    opacity: .8;
}
.security__links ul {
    display: flex;
    justify-content: center;
}
.security__links ul li {
    color: rgb(238, 238, 238);
    font-size: 14px;
    opacity: .8;
    margin-right: 6px;
}
.security__links ul li a {
    color: rgb(238, 238, 238);
    font-size: 14px;
}
.security__links ul li a:hover {
    text-decoration: underline;
}
.midi-popup-overlay {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-color: rgba(28, 186, 164, 0.3);
    opacity: 1;
    display: none;
    z-index: 222;
}
.midi-popup-overlay.open {
    display: block;
}
.midi-popup {
    position: fixed;
    top: -800px;
    left: 50%;
    transform: translate(-50%, 0px);
    border-radius: 15px;
    max-width: 720px;
    width: 100%;
    background-color: rgb(24, 24, 24);
    opacity: 0;
    visibility: hidden;
    padding: 35px 0px;
    margin-top: 95px;
    z-index: 333;
    transition: all 0.3s ease-in-out;
}
.midi-popup.open {
    opacity: 1;
    visibility: visible;
    top: 0px;
}
.midi-popup .midi-popup__inner {
    padding: 0px 20px;
}
.midi-popup .midi-popup_row {
    padding: 10px 20px;
}
.midi-popup .midi-popup__inner .progress {
    overflow: hidden;
    height: 35px;
    line-height: 36px;
    font-size: 14px;
    border-radius: 0px;
    margin-bottom: 20px;
    background-color: rgb(245, 245, 245);
    box-shadow: rgb(0 0 0 / 10%) 0px 1px 2px inset;
}
.midi-popup .midi-popup__inner .progress .progress-bar {
    background-color: rgb(28, 186, 164);
    width: 66%;
    line-height: 36px;
    height: 35px;
    font-size: 14px;
    color: rgb(255, 255, 255);
    text-align: center;
    box-shadow: rgb(0 0 0 / 15%) 0px -1px 0px inset;
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 40px 40px;
    animation: 2s linear 0s infinite reverse none running progress-bar-stripes;
}
@-webkit-keyframes progress-bar-stripes {
    from {
        background-position: 40px 0;
    }
    to {
        background-position: 0 0;
    }
}
.midi-popup .midi-popup__inner h3 {
    text-align: center;
    font-size: 26px;
    color: rgb(255, 255, 255);
    margin-bottom: 20px !important;
    line-height: 1.3em;
}
.midi-popup .field__box .input_field {
    position: relative;
    width: 100%;
    font-size: 18px;
    font-weight: 500;
    line-height: 25px;
    border-radius: 5px;
    padding: 12px 50px 12px 18px;
    background-color: rgb(255, 255, 255);
    background-image: url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/email2.png');
    background-repeat: no-repeat;
    background-position: 97% center;
    border: 1px solid rgba(0, 0, 0, 0.2);
    box-shadow: rgb(130 137 150 / 23%) 0px 1px 2px inset, rgb(255 255 255 / 95%) 0px 1px 0px !important;
    outline: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.midi-popup .field__box .input_field::placeholder {
    color: rgb(116 116 116);
}
.midi-popup .midi-popup_btn_row {
    width: 65%;
    max-width: 100%;
    margin: 0 auto;
    padding: 0px 20px 10px;
}
.midi-popup .midi-popup_btn_row .actions-btn {
    margin: 15px 0px;
}
.midi-popup .midi-popup_btn_row .btn-design a.elButton {
    font-size: 32px;
}
.midi-popup .midi-popup_btn_row p {
    text-align: center;
    font-size: 12px;
    color: rgb(184, 184, 184);
    line-height: normal;
    font-weight: 500;
}
.midi-popup .midi-popup__close {
    position: absolute;
    right: -20px;
    top: -20px;
    cursor: pointer;
}
.midi-popup .midi-popup__loader {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    border-radius: 5px;
    display: none;
}
.midi-popup .midi-popup__loader img {
    width: 35px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Media Css */
@media only screen and (min-width: 769px) {
    .midi-leftRight__box:not(:last-child) {
        margin-bottom: 25px;
    }
    .midi-leftRight__box:nth-child(even) {
        flex-direction: row-reverse;
    }
}

@media (max-width: 1170px) {
    .midi-whatPros .page-container,
    .midi-other-producer-video .page-container__inner {
        max-width: 100%;
    }
    .midi-progression .midi-progression-flex .col-left {
        padding: 15px 20px 25px;
    }
}

@media only screen and (max-width: 770px) {
    .midi-chord-pack .p-10 {
        padding: 0px 5px;
    }
    .p-md-770 {
        padding-left: 15px;
        padding-right: 15px;
    }
    .d-none-770 {
        display: none;
    }
    .d-block-770 {
        display: block;
    }
    .w-full-770 {
        max-width: 100% !important;
        width: 100% !important;
    }
    .flex-direction-column-770 {
        flex-direction: column;
    }
    .midi-chord-pack .row > [class^="col-"] {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .midi-chord-pack .section-heading h1 {
        font-size: 24px;
    }
    .midi-header .header__inner {
        padding: 0px 15px;
    }
    .midi-header .header__inner > div {
        text-align: center;
        padding: 0px;
    }
    .midi-header .header__inner .midi-menu ul {
        justify-content: center;
        margin-top: 10px;
    }
    .drag-drop-midi {
        padding-top: 15px;
    }
    .drag-drop-midi h4 {
        font-size: 14px;
        margin-top: 0px !important;
    }
    .drag-drop-midi h3 {
        font-size: 20px;
    }
    .drag-drop-midi .midi-chord-video {
        padding: 0px;
    }
    .drag-drop-midi .list-point {
        margin-bottom: 0px;
    }
    .drag-drop-midi .list-point li {
        font-size: 17px;
    }
    .drag-drop-midi .worked-logos-sec {
        padding: 15px 15px 35px;
    }
    .midi-leftRight {
        padding: 0px;
    }
    .midi-leftRight__box {
        padding: 0px 5px 15px;
        border-radius: 0px;
    }
    .midi-leftRight__box.purple {
        background-image: linear-gradient(#621a62, #1d1134);
    }
    .midi-leftRight__box.green {
        background-image: linear-gradient(#1dbaa4, #072d28);
    }
    .midi-leftRight__box.grey {
        background-image: linear-gradient(#c6c6c6, #747474);
    }
    .midi-leftRight__box .content__part {
        order: 2;
        padding: 5px 15px 35px;
        border-radius: 5px;
    }
    .midi-leftRight__box .img__part {
        padding: 20px 15px;
    }
    .midi-leftRight__box .img__part img {
        max-width: 280px;
    }
    .midi-leftRight__box .content__part .list-option li {
        font-size: 17px;
    }
    .midi-whatPros {
        padding: 35px 0px 10px;
    }
    .midi-whatPros .section-heading {
        padding: 0px 15px;
    }
    .midi-whatPros .midi-chord__row {
        padding: 0px 5px;
    }
    .midi-whatPros.midi-other-producer {
        padding: 35px 0px 20px;
    }
    .midi-chord__card:not(:last-child) {
        margin-bottom: 20px;
    }
    .midi-chord__card .midi-chord__cardInner {
        padding: 30px 15px 20px;
        margin: 5px 0px 0px;
        display: flex;
        flex-direction: column;
    }
    .midi-chord__card .midi-chord__cardInner > p {
        order: 2;
        margin-top: 15px;
    }
    .midi-chord__card .midi__card_foot {
        margin-top: 0px;
        text-align: center;
    }
    .midi-chord__card .midi__card_foot .text-box {
        padding: 0px;
    }
    .midi-chord__card .midi__card_foot .text-box p {
        text-align: center;
    }
    .midi-chord-pack.midi-progression {
        padding: 0px;
    }
    .midi-progression .section-heading {
        padding: 0px 15px;
    }
    .midi-progression .midi-progression-flex {
        background: 0px;
    }
    .midi-progression .midi-progression-flex .col-left {
        order: 2;
        padding: 30px 15px 20px;
    }
    .midi-progression .section-heading.text-center {
        background-color: rgb(26, 26, 26);
        padding-bottom: 20px;
    }
    .midi-progression .section-heading .title-img {
        padding-top: 40px;
        padding-bottom: 25px;
    }
    .midi-progression-flex .section-heading h3.title {
        text-align: center;
        font-size: 28px;
    }
    .midi-progression .midi-progression-flex .col-left p {
        font-size: 15px;
    }
    .midi-progression .midi-progression-flex .col-left p:not(:last-child) {
        margin-bottom: 21px;
    }
    .midi-progression .midi-progression-flex .squares {
        width: 341px;
        height: 335px;
        margin: 0 auto;
        padding: 0px 15px;
    }
    .midi-progression .midi-progression-flex .audiosqs {
        width: 341px;
        height: 67px;
    }
    .midi-chord-pack.midi-easy-step {
        background-color: rgb(26, 26, 26);
    }
    .midi-easy-step .section-heading {
        padding: 0px 15px;
        padding-bottom: 30px !important;
    }
    .midi-easy-step .midi-easyStep-flex:nth-child(odd) {
        background-color: rgb(32, 32, 32);
    }
    .midi-easy-step .midi-easyStep-flex {
        padding: 20px 5px 20px;
        margin-bottom: 0px;
    }
    .midi-easy-step .video-box {
        padding: 20px 10px 0px;
    }
    .midi-easy-step .midi-easyStep-notify p {
        text-align: center;
    }
    .midi-chord-pack.midi-what-will-get {
        padding: 35px 0px 25px;
    }
    .midi-what-will-get .section-heading {
        padding: 0px 15px;
        padding-bottom: 30px !important;
    }
    .midi-what-will-get .midi-willGet-flex {
        background-image: linear-gradient(#c6c6c6, #747474);
        padding: 0px 5px 15px;
    }
    .midi-what-will-get .midi-willGet-flex .img-box img {
        max-width: 275px !important;
        padding-top: 40px;
    }
    .midi-what-will-get .midi-willGet-flex .content-box {
        padding: 30px 10px 15px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .midi-what-will-get .actions-btn {
        margin: 15px auto 0px;
        padding: 20px 15px 10px;
    }
    .midi-chord-pack.midi-exclusive-bonus {
        padding: 30px 0px 0px;
    }
    .midi-exclusive-bonus .section-image {
        padding: 20px 15px;
    }
    .midi-exclusive-bonus .midi-exclusiveBonus_inner {
        margin-top: 30px;
    }
    .midi-exclusiveBonus_box {
        border-radius: 0px;
        margin: 0px;
        padding: 0px 5px 15px;
    }
    .midi-exclusiveBonus_box .content__part {
        order: 2;
        margin-top: 20px;
        padding: 35px 10px 35px;
        border-radius: 5px;
    }
    .midi-exclusiveBonus_box .img__part {
        padding: 35px 10px 20px;
    }
    .midi-chord-pack.get-bonus-now {
        padding: 15px 0px 20px;
    }
    .midi-chord-pack.midi-lifetime-guarantee {
        padding: 0px 0px 15px;
    }
    .midi-lifetime-guarantee .midi-moneyBack_inner {
        margin-top: 0px;
        padding: 0px 5px 15px;
    }
    .midi-lifetime-guarantee .midi-moneyBack_inner .column-left {
        padding: 45px 10px 30px;
    }
    .midi-lifetime-guarantee .midi-moneyBack_inner .column-left img {
        max-width: 250px !important;
    }
    .midi-lifetime-guarantee .midi-moneyBack_inner .column-right {
        border-radius: 5px;
        padding: 30px 10px 35px;
    }
    .midi-lifetime-guarantee .actions-btn {
        margin: 25px auto 0px;
        padding: 0px 15px 20px;
    }
    .midi-chord-pack.midi-other-producer-video {
        padding: 35px 0px 25px;
    }
    .midi-other-producer-video .midi-producerVideo_row {
        padding: 0px 5px 20px;
        margin: 10px 0px 0px;
    }
    .midi-other-producer-video .midi-proVideo__card {
        padding: 15px 10px 25px;
        margin-right: 0px;
    }
    .midi-other-producer-video .midi-proVideo__card:not(:last-child) {
        margin-bottom: 20px;
    }
    .midi-other-producer-video .actions-btn {
        margin: 10px auto 0px;
        padding: 0px 15px 20px;
    }
    .midi-chord-pack.midi-chord-faqs {
        padding: 20px 0px 10px;
    }
    .midi-chord-faqs .section-heading {
        padding: 20px 15px;
    }
    .midi-chord-faqs .midi-chord-faqs__inner {
        padding: 10px 15px 25px;
    }
    .midi-chord-faqs .actions-btn {
        padding: 10px 15px 30px;
    }
    .midi-chord-pack.get-bonus-now.get-bonus-now-v2 {
        background: 0px;
    }
    .get-bonus-now.get-bonus-now-v2 .section-heading {
        padding: 0px 15px;
    }
    .get-bonus-now .get-bonusNow__flex {
        padding: 20px 5px 0px;
        margin: 0px;
        background: 0;
    }
    .get-bonus-now .get-bonusNow__flex .img-bx {
        padding: 0px;
        margin: 25px 0px 20px;
    }
    .get-bonus-now .get-bonusNow__flex .list-bx {
        padding: 0px 10px;
    }
    .get-bonus-now.get-bonus-now-v2 .get-bonusNow_inner .content-box {
        padding-top: 0px;
    }
    .midi-chord-pack.midi-benefits {
        padding: 10px 5px 20px;
    }
    .midi-benefits .midi-benefits_inner > div,
    .midi-benefits .midi-benefits_inner .midi-benefits__box .text-bx {
        padding: 0px;
        text-align: center;
    }
    .midi-benefits .midi-benefits_inner .midi-benefits__box:first-child {
        margin-bottom: 40px;
    }
    .midi-benefits .midi-benefits_inner .midi-benefits__box .text-bx p {
        font-size: 14px;
    }
    .midi-benefits .midi-benefits_inner .midi-benefits__box .actions-btn {
        margin-top: 35px;
    }
    .midi-chord-faqs .custom-accordion .card .card-body p {
        font-size: 18px;
    }
    .midi-popup {
        width: 98%;
        max-width: 100%;
        min-width: 320px;
    }
    .midi-popup .midi-popup__inner {
        padding: 0px;
    }
    .midi-popup .midi-popup_row {
        padding: 10px 15px;
    }
    .midi-popup .midi-popup_btn_row {
        padding: 0px 15px 10px;
    }
    .midi-popup .midi-popup_btn_row .btn-design a.elButton {
        padding: 10px 15px;
    }
    .midi-popup .midi-popup__close {
        right: -10px;
        top: -20px;
    }
}

@media only screen and (max-width: 700px) {
    .top-msg p,
    .midi-header .header__inner .midi-menu ul li a {
        font-size: 12px;
    }
    .midi-header .header__inner .midi-menu ul li:not(:last-child) {
        margin-right: 21px;
    }
    .midi-chord-pack .section-heading h3.title,
    .midi-popup .midi-popup_btn_row .btn-design a.elButton {
        font-size: 28px;
    }
    .midi-chord-pack p,
    .midi-progression .midi-progression-flex .col-left p,
    .get-bonus-now .get-bonusNow_inner .content-box h3,
    .midi-what-will-get .midi-willGet-flex .content-box .list-options li,
    .get-bonus-now.get-bonus-now-v2 .get-bonusNow__flex .list-bx ul li {
        font-size: 17px;
    }
    .drag-drop-midi h3 {
        font-size: 14px;
    }
    .midi-leftRight__box .content__part h3 {
        font-size: 28px !important;
    }
    .midi-progression .midi-progression-flex .col-left p:not(:last-child) {
        margin-bottom: 25px;
    }
    .midi-exclusiveBonus_box .content__part .section-heading h3.title {
        font-size: 22px;
    }
    .midi-popup .midi-popup__inner h3 {
        font-size: 20px;
    }
    .midi-popup .field__box .input_field {
        font-size: 15px;
    }
}
</style>

<script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

<!-- Top Msg -->
<div class="top-msg">
    <div class="page-container">
        <p class="text-center">Important: 60% Off & Free Bonuses Expiring Soon</p>
    </div>
</div>
<!-- End Top Msg -->

<!-- header -->
<div class="midi-header">
    <div class="page-container">
        <div class="header__inner d-flex flex-direction-column-770">
            <div class="midi-logo w-full-770">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/adasdasdasdasdasdasda.png" alt="" width="155">
            </div>
            <div class="midi-menu w-full-770">
                <ul>
                    <li><a href="https://deals.unison.audio/reviews-midi-chord-pack" target="_blank">Reviews</a></li>
                    <li><a href="#midi-demos">Demos</a></li>
                    <li><a href="#midi-features">Features</a></li>
                    <li><a href="#midi-faqs">FAQ</a></li>
                    <li><a id="openMidiPopup" class='openMidiPopup'> Get Pack</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End header -->

<!-- Drag & Drop MIDI Files -->
<div class="midi-chord-pack drag-drop-midi pb-0" style="background-image:url('<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/bg-3.png'); ">
    <div class="page-container p-md-770">
        <div class="drag-drop__inner w-full-770">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                        <h4 class="text-green"><i>Over 50,802 copies sold...</i></h4>
                        <h1 class="heading d-none-770">
                            “Instantly Create <u>Pro-Level</u> Chords & Progressions <br>With <u>Over 1,200</u> Drag & Drop MIDI Files”
                        </h1>
                        <h1 class="heading d-block-770">
                            “Instantly Create <u>Pro-Level</u> <br>Chords & Progressions <br>With <u>Over 1,200</u> Drag <br>& Drop MIDI Files”
                        </h1>
                        <h3 class="text-green d-none-770">No Music Theory, Guesswork Or Trial & Error Needed.</h3>
                        <h3 class="text-green d-block-770">No Music Theory, Guesswork <br>Or Trial & Error Needed.</h3>
                    </div>
                    <div class="midi-chord-video w-full-770">
                        <div class="video-sec-wrapper">
                            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                                <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                                    <iframe src="https://fast.wistia.net/embed/iframe/lljfc4o9vk?videoFoam=true" title="MIDI Wizard VSL 4 Bonuses 2021 Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%">
                                    </iframe>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="drag-drop__list w-full-770">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-point">
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Make <b>perfect-sounding, sophisticated chords</b> without spending years learning music theory</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Experiment with advanced chords so you can <b>make your music stand out</b> out from the rest</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Create a <b>diverse range of emotions</b> in your music using specific chords & progressions</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-point">
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>​Get <b>instant inspiration</b> from 1,200+ MIDI chords & progressions</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Use <b>proven, time-tested chord progressions</b> to increase your chances of making a hit</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span><b>Streamline your workflow</b> and creative process so you can finish music faster</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                    
                <div class="actions-btn btn-design text-center w-full-770">
                    <a class="elButton openMidiPopup"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="worked-with-daws text-center">
                    <h5>WHO WE'VE WORKED WITH:</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="worked-logos-sec w-full-770">
        <div class="worked-logos--inner text-center">
            <div class="worked-with-logo d-none-770">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Artist-Logos-Desktop-.png" class="mw-100" alt="">
            </div>
            <div class="worked-with-logo d-block-770">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Mobile-Logos.png" class="mw-100" alt="">
            </div>
        </div>
    </div>
</div>
<!-- End Drag & Drop MIDI Files -->

<!-- Left Right Section -->
<div class="midi-chord-pack midi-leftRight">
    <div class="page-container">
        <div class="midi-leftRight__inner">
            <div class="midi-leftRight__box purple flex-direction-column-770">
                <div class="content__part w-full-770">
                    <div class="section-heading text-center">
                        <h3 class="title">What's The <u>#1 Secret</u> To Making A <span class="text-green">Hit Song?</span></h3>
                    </div>
                    <p>Most producers <b>think</b> it's:</p>
                    <ul class="list-option">
                        <li>
                            <i class="fa fa-times"></i>
                            Fancy <b>studio equipment</b>
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            Special <b>mixing & mastering</b> techniques
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            Or spending <b>tons of time</b> producing
                        </li>
                    </ul>
                    <div class="text-box">
                        <p>But the <b>real secret</b> to making a hit song is having a single, <b>pro-level chord progression.</b>.</p>
                        <p>That's why if you think about <b>billboard chart hits</b> like:</p>
                        <p><b>“The Box”</b> by Roddy Ricch, <b>“God’s Plan”</b> by Drake, <b>"Thank U, Next"</b> by Ariana Grande, <b>"Wake Me Up"</b> by Avicii, or <b>"Smells Like Teen Spirit"</b> by Nirvana...</p>
                        <p>The <b>chord progression</b> gets <b>stuck in your head</b> after a single listen. Which means <b>without </b> a pro-level chord progression, your chances of making a hit are <b>slim to none</b>.</p>
                    </div>                   
                </div>
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/hot100.png" alt="">
                </div>
            </div>
            <div class="midi-leftRight__box green flex-direction-column-770">
                <div class="content__part w-full-770">
                    <div class="section-heading text-center">
                        <h3 class="title">So <span class="text-green">How Do You</span> Make Pro-Level Chord Progressions?</h3>
                    </div>
                    <p>The problem is, most of us producers don't have <b>years of music theory experience</b> or the <b>natural ability</b> to whip up crazy chord progressions on the spot.</p>
                    <br>
                    <p>And, up until now there were only <b>2 options:</b></p>
                    <ul class="list-option">
                        <li>
                            <i class="fa fa-times"></i>
                            1. Watch endless amounts of <b>YouTube tutorials</b> with scattered information and no guarantee of results
                        </li>
                        <li>
                            <i class="fa fa-times"></i>
                            2. Go to <b>music school</b> and spend a boatload of money & time to learn how to do it from scratch
                        </li>
                    </ul>
                    <div class="text-box">
                        <p>Knowing this, we knew there had to be a <b>better way.</b></p>
                        <p>A way that <b>didn’t require</b> any extra time, guesswork or thousands of dollars.</p>
                        <p>And, after <b>hundreds of hours</b> experimenting… A <b>hefty chunk</b> of development costs… And extracting knowledge from a <b>music theory master</b>… That's exactly what we made here at <b>Unison.</b></p>
                    </div>                   
                </div>
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Money-Bag.png" alt="">
                </div>
            </div>
            <div class="midi-leftRight__box grey flex-direction-column-770">
                <div class="content__part w-full-770">
                    <div class="section-heading text-center">
                        <h3 class="title">Introducing: <br>The <span class="text-green">Unison MIDI Chord Pack</span></h3>
                    </div>
                    <p>It’s the <b>world’s first and only</b> tool that allows any producer, regardless of music theory experience to create <b>pro-level chords & progressions instantly.</b></p>
                    <br>
                    <p>And these are <b>chords & progressions</b> that:</p>
                    <ul class="list-option">
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <b>Blow the minds</b> of your listeners
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            Leave your friends & family <b>speechless</b>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            And finally <b>get your music noticed</b> in the industry
                        </li>
                    </ul>
                    <div class="text-box">
                        <p>Ultimately getting you <b>more plays… more professional-sounding music...</b> and <b>boosting your chances</b> of making a hit song.</p>
                        <p>With it, you'll <b>quickly & easily</b> select from <b>over 1,200 MIDI files</b> available at your fingertips...</p>
                        <p><b>Drag & drop them straight into your project</b> and create pro-level chords & progressions instantly.</p>
                    </div>                   
                </div>
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Chord-Pack-3D-.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Left Right Section -->

<!-- What Pros Are Saying -->
<div class="midi-chord-pack midi-whatPros bg-black-light">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">What <span class="text-green">Pros</span> Are Saying...</h3>
        </div>
        <div class="midi-chord__row flex-direction-column-770">
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"Wow, this is <b>pretty damn awesome</b>. Basically, what you've got is an <b>infinite source of chords</b> to play around with."</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/hyperbits.png" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">Hyperbits</h3> 
                        <p>47k fans. Tracks signed to Sony/Atlantic/Warner Records</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"<b>This pack is huge! </b>So many different styles of chords to <b>get the inspiration flowing</b>. Great job Unison!"</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/J-Trick-Pic.jpg" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">J-Trick</h3> 
                        <p>87k fans. Tracks signed to Dim Mak/Hexagon/Panda Funk</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"<b>This pack is ridiculously useful</b> especially for producers like myself who don't have a music theory background."</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Gill-Chang-Message.jpg" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">Gill Chang</h3> 
                        <p>Over 30m total plays. Tracks featured on ChillNation/ Proximity/Otodayo Records</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
        </div>
    </div>
</div>
<!-- End What Pros Are Saying -->

<!-- MIDI Chords & Progressions -->
<div class="midi-chord-pack midi-progression" id="midi-demos">
    <div class="page-container">
        <div class="section-heading text-center">
            <div class="title-img d-block-770">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/MC-2.png" alt="" width="150">
            </div>
            <h3 class="title">Hear Some Of The <span class="text-green">MIDI Chords & Progressions</span> Below...</h3>
        </div>
        <div class="midi-progression-flex d-flex flex-direction-column-770 w-full-770">
            <div class="col-left w-full-770">
                <div class="section-heading">
                    <h3 class="title">Play The Demos <span class="text-green">For Yourself</span></h3>
                </div>
                <p>Use the Unison MIDI Chord Pack to instantly create chords & progressions from <b>simple, to complex, to ultra-advanced.</b></p>
                <p>Say goodbye to overwhelming <b>music theory</b> and frustrating <b>trial & error...</b></p>
                <p>Now you can have <b>every fundamental chord & progression</b> in any key right at your fingertips for <b>instant use.</b></p>
                <p>We've <b>done all the hard work</b> for you already.</p>
                <p><b>Click to the right</b> to hear some of the chords & progressions <b>inside the Unison MIDI Chord Pack</b> for yourself.</p>
            </div>
            <div class="col-right w-full-770">
                <audio id="myAudio1" src="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Triads.mp3" preload="auto"> </audio>
                <audio id="myAudio2" src="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Extended+Chords.mp3" preload="auto"> </audio>
                <audio id="myAudio3" src="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Borrowed+%26+Modal+Chords.mp3" preload="auto"> </audio>
                <audio id="myAudio4" src="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Diatonic+Progressions.mp3" preload="auto"> </audio>
                <audio id="myAudio5" src="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Advanced+Progressions.mp3" preload="auto"> </audio>
                <div class="squares">
                    <div class="audiosqs" id="sq1" onclick="togglePlay(1)"></div>
                    <div class="audiosqs" id="sq2" onclick="togglePlay(2)"></div>
                    <div class="audiosqs" id="sq3" onclick="togglePlay(3)"></div>
                    <div class="audiosqs" id="sq4" onclick="togglePlay(4)"></div>
                    <div class="audiosqs" id="sq5" onclick="togglePlay(5)"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End MIDI Chords & Progressions -->

<!-- Pro-Level Easy Step -->
<div class="midi-chord-pack midi-easy-step">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">Creating <span class="text-green">Pro-Level</span> Chord Progressions Is As <span class="text-green">Easy As 1-2-3...</span></h3>
        </div>
        <div class="midi-easyStep__wrap">
            <div class="midi-easyStep-flex d-flex flex-direction-column-770 w-full-770">
                <div class="content-box w-full-770">
                    <div class="section-heading">
                        <h3 class="title"><span class="text-green">1.</span> Select Key</h3>
                    </div>
                    <p>Start by selecting <b>one of the 12 keys</b> of music.</p>
                </div>
                <div class="video-box w-full-770">
                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/MIDI%2BChord%2BPack%2BStep%2B1.mp4" width="100%" height="100%" autoplay loop muted playsinline>
                    </video>
                </div>
            </div>
            <div class="midi-easyStep-flex d-flex flex-direction-column-770 w-full-770">
                <div class="content-box w-full-770">
                    <div class="section-heading">
                        <h3 class="title"><span class="text-green">2.</span> Choose Chords</h3>
                    </div>
                    <p>Next choose from <b>over 1,200</b> individual chords & full progressions.</p>
                </div>
                <div class="video-box w-full-770">
                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/MIDI%2BChord%2BPack%2BStep%2B1_1.mp4" width="100%" height="100%" autoplay loop muted playsinline>
                    </video>
                </div>
            </div>
            <div class="midi-easyStep-flex d-flex flex-direction-column-770 w-full-770 mb-0">
                <div class="content-box w-full-770">
                    <div class="section-heading">
                        <h3 class="title"><span class="text-green">3.</span> Drag & Drop</h3>
                    </div>
                    <p>Drag & drop them <b>straight into your project</b> and play with your favorite instrument.</p>
                </div>
                <div class="video-box w-full-770">
                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/MIDI%2BChord%2BPack%2BStep%2B1_2.mp4" width="100%" height="100%" autoplay loop muted playsinline>
                    </video>
                </div>
            </div>
        </div>
        <div class="midi-easyStep-notify w-full-770">
            <p>*Ableton is used for these demonstrations but the Unison MIDI Chord Pack works with all DAWs.</p>
        </div>
    </div>
</div>
<!-- End Pro-Level Easy Step -->

<!-- What You'll Get -->
<div class="midi-chord-pack midi-what-will-get" id="midi-features">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">Here's <span class="text-green">What You'll Get</span> Inside The Unison MIDI Chord Pack:</h3>
        </div>
        <div class="midi-will-get__inner">
            <div class="midi-willGet-flex d-flex flex-direction-column-770 w-full-770">
                <div class="audio-box w-full-770">
                    <div class="img-box">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Chord-Pack-3D-.png" alt="" class="mw-100" width="375">
                    </div>
                    <p>Listen To Songs Created With Chords & Progressions<br>From The Unison MIDI Chord Pack Below:</p>
                    <div class="audio">
                        <?php echo do_shortcode('[audio mp3="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Long+Demo.mp3" 
                        wav="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Long+Demo.mp3" 
                        ogg="https://unisonsoundbanks.s3-us-west-1.amazonaws.com/MIDI+Chord+Pack+Demos/MIDI+Chord+Pack+Long+Demo.mp3"][/audio]'); ?>
                    </div>
                </div>
                <div class="content-box w-full-770">
                    <div class="content-box__inner">
                        <ul class="list-options">
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​<b>1,200+ Total MIDI Files</b> (have all the fundamental chords & progressions in existence right at your fingertips)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​​<b>​Individual Chords & Full Progressions</b> (chain your own chords together or use the proven chord progressions)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span><b>Drag & Drop Ready</b> (we've done all the hard work for you)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span><b>Key Labeled & Organized</b> (no wasting time sifting through folders or doing guesswork to find what you want)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span><b>​15 Page In-Depth Walkthrough PDF</b> (uncover tips & tricks on basic music theory and how to best use the pack)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​<b>​​​100% Royalty Free</b> (all money you earn from music you make with the Unison MIDI Chord Pack is yours to keep)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​<b>Made For All Genres Of Music</b> (the files inside the Unison MIDI Chord Pack is essential to all pro-level music)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​<b>​Usable With Any Sound</b> (you can play all the chords & progressions with your favorite instruments & synths)</span>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-check"></i>
                                <span>​<b>Compatible With All DAWs</b> (plus both Mac & PC)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="actions-btn btn-design text-center w-full-770">
                <a id="openMidiPopup" class="elButton openMidiPopup"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
            </div>
        </div>
    </div>
</div>
<!-- End What You'll Get -->

<!-- Free Exclusive Bonuses -->
<div class="midi-chord-pack midi-exclusive-bonus bg-black-light">
    <div class="page-container">
        <div class="section-image text-center">
            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/3D-Bonus-Bundle.png" alt="" class="d-none-770" width="600">
            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/3D-Bonus-Bundle.png" alt="" class="d-block-770" width="325">
        </div>
        <div class="section-heading text-center">
            <h3 class="title">Plus, Get <span class="text-green">3 Free Exclusive Bonuses</span> When You Order Now...</h3>
        </div>
        <div class="midi-exclusiveBonus_inner">
            <div class="midi-exclusiveBonus_box gray d-flex flex-direction-column-770">
                <div class="content__part w-full-770">
                    <h4 class="text-green">Bonus #1</h4>   
                    <div class="section-heading text-center">
                        <h3 class="title">Unison Theory Blueprint</h3>
                    </div>            
                    <h4 class="text-green">$47 Value</h4>
                    <p>In this <b>54 page guide</b> you'll discover why and when particular types of chords are used, how to write harmonies and melodies, and also <b>key concepts</b> you need to know to write captivating melodies for any genre of music.</p>             
                </div>   
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Unison-Theory-Bluepront-3D-.png" alt="">
                </div>                         
            </div>
            <div class="midi-exclusiveBonus_box green d-flex flex-direction-column-770">
                <div class="content__part w-full-770">
                    <h4 class="text-green">Bonus #2</h4>   
                    <div class="section-heading text-center">
                        <h3 class="title">Unison MIDI Secrets PDF</h3>
                    </div>            
                    <h4 class="text-green">$27 Value</h4>
                    <p>Use 25 of our <b>best MIDI secrets</b> to take your MIDI game to the next level. With the easily to implement tips in this PDF, you'll be equipped to <b>make the most</b> of your chords while using the Unison MIDI Chord Pack and create amazing songs.</p>             
                </div>   
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Unison-MIDI-Secrets-3D-.png" alt="">
                </div>                         
            </div>
            <div class="midi-exclusiveBonus_box orange d-flex flex-direction-column-770">
                <div class="content__part w-full-770">
                    <h4 class="text-green">Bonus #3</h4>   
                    <div class="section-heading text-center">
                        <h3 class="title">Unison Loop Pack</h3>
                    </div>            
                    <h4 class="text-green">$67 Value</h4>
                    <p>In this pack you'll find <b>200 fully-loaded drum loops</b> that you can use with chords from the Unison MIDI Chord Pack to <b>quickly start a song</b> in any genre. All the individual layers (kicks/claps/snares/etc) are included - <b>711 WAV files</b> total.</p>             
                </div>   
                <div class="img__part w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Unison-Loop-Pack-3D-.png" alt="">
                </div>                         
            </div>
        </div>
    </div>
</div>
<!-- End Free Exclusive Bonuses -->

<!-- Get The Unison MIDI Chord Pack -->
<div class="midi-chord-pack get-bonus-now">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">Get The Unison MIDI Chord Pack <br> For <span class="text-green">60% Off + Bonuses Now</span></h3>
        </div>
        <div class="get-bonusNow_inner">
            <div class="image-box">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/MC-Checkout-2.png" width="800" class="mw-100 d-none-770" alt="">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Mobile-Pricing-Table.png" width="290" class="mw-100 d-block-770" alt="">
            </div>
            <div class="content-box w-full-770">
                <h3>UNISON MIDI CHORD PACK + BONUSES</h3>
                <div class="actions-btn btn-design text-center">
                    <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
                </div>
                <p>Try It Risk-Free | 100% Lifetime Money-Back Guarantee</p>
                <div class="pay_by">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/credit-paypal.png" width="250" class="mw-100" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Get The Unison MIDI Chord Pack -->

<!-- What Other Producers Are Saying -->
<div class="midi-chord-pack midi-whatPros midi-other-producer bg-black-light">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">What <span class="text-green">Other Producers</span> Are Saying...</h3>
        </div>
        <div class="midi-chord__row flex-direction-column-770">
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"<b>Great tool for inspiration.</b> The Unison MIDI Chord Pack makes it easier than ever to build great sounding chord progressions. <b>Definitely will be a go-to</b> when I’m feeling writer’s block."</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Christian.jpg" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">Christian C.</h3> 
                        <p>DJ/Producer <br>Los Angeles, USA</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"This <b>Unison MIDI Chord Pack is a monster! </b> There’s a ton of individual chords & many progressions that <b>get you going right away.</b> It really allows you to focus on finding chords that connect & match how you feel, <b>making the process really smooth.</b>."</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Ash-Pandher.jpg" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">Ash Pandher</h3> 
                        <p>DJ/Producer <br>Vancouver, Canada</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
            <div class="midi-chord__card w-full-770">
                <div class="midi-chord__cardInner">
                    <p><i>"<b>Really impressed</b> by the amount of time and effort that went into making this pack. The chords and progressions make it easy for me to <b>speed up my workflow</b> and make sure I use the correct notes. Big ups to Unison on this one!"</i></p>
                    <div class="midi__card_foot flex-direction-column-770">
                    <div class="img-box w-full-770">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Cas-Felicella.jpg" alt="" width="100">
                    </div>
                    <div class="text-box w-full-770">
                        <h3 class="text-green">Cas Felicella</h3> 
                        <p>DJ/Producer <br>Toronto, Canada</p>                 
                    </div>
                    </div> 
                </div>                        
            </div>
        </div>
    </div>
</div>
<!-- End What Other Producers Are Saying -->

<!-- Money-Back Guarantee -->
<div class="midi-chord-pack midi-lifetime-guarantee">
    <div class="page-container">
        <div class="midi-moneyBack_inner d-flex flex-direction-column-770">
            <div class="column-left w-full-770">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Money-Back-750-.png" class="mw-100" alt="Money - Designed by pch.vector / Freepik" width="300">
            </div>
            <div class="column-right w-full-770">
                <div class="section-heading text-center">
                    <h3 class="title">Lifetime 100% <br><span class="text-green">Money-Back Guarantee</span></h3>
                </div>
                <div class="text-box">
                    <h4>Here’s the deal...</h4>
                    <p>We’re so confident you’ll love the Unison MIDI Chord Pack that you can <b>try it out for as long as you want.</b></p>
                    <p>If you’re not happy with the results you get, just email support@unison.audio and we’ll give you <b>100% of your money back.</b> No questions asked.</p>
                    <p>Plus, you can keep <b>all the bonuses absolutely free.</b> You have nothing to lose and everything to gain.</p>
                </div>
            </div>
        </div>
        <div class="actions-btn btn-design text-center w-full-770">
            <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
        </div>
    </div>
</div>
<!-- End Money-Back Guarantee -->

<!-- What Other Producers Are Saying Video -->
<div class="midi-chord-pack midi-other-producer-video bg-black-light">
    <div class="page-container page-container__inner">
        <div class="section-heading text-center">
            <h3 class="title">What <span class="text-green">Other Producers</span> Are Saying...</h3>
        </div>
        <div class="midi-producerVideo_row d-flex flex-direction-column-770">
            <div class="midi-proVideo__card w-full-770">
                <div class="midi-proVideo__inner">
                    <div class="video-bx">
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                                <iframe src="https://fast.wistia.net/embed/iframe/10izqyi3qo?autoplay=0&wmode=transparent" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="info-box">
                        <p><i>"Now I can <b>focus on the emotion</b> and how chord progressions make me feel. <b>Not worrying about music theory</b> or how to play them. This pack is such a useful thing to have on your computer."</i></p>
                        <h3 class="text-green">Adam Pollard</h3> 
                        <h4>Producer - London, UK</h4>                 
                    </div>
                </div>                        
            </div>
            <div class="midi-proVideo__card w-full-770">
                <div class="midi-proVideo__inner">
                    <div class="video-bx">
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                                <iframe src="https://fast.wistia.net/embed/iframe/hbqi09m5wc?autoplay=0&wmode=transparent" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="info-box">
                        <p><i>"If you’re <b>struggling with chord progressions,</b> don’t know music theory or if you’re just stuck, this is what you need. This pack will help you <b>make the chords you’ve never been able to.</b>"</i></p>
                        <h3 class="text-green">Jay Eskar</h3> 
                        <h4>Producer - San Diego, USA</h4>                 
                    </div>
                </div>                        
            </div>
            <div class="midi-proVideo__card w-full-770">
                <div class="midi-proVideo__inner">
                    <div class="video-bx">
                        <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                                <iframe src="https://fast.wistia.net/embed/iframe/uitbwyl4rl?autoplay=0&wmode=transparent" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="info-box">
                        <p><i>"If you’re looking to <b>make beats faster</b> or be more time efficient, you just <b>drag the chords in and you’re good to go.</b> I find this MIDI pack super useful and I’m sure you’ll find it useful too."</i></p>
                        <h3 class="text-green">Ocean Lawrence</h3> 
                        <h4>Producer - London, UK</h4>                 
                    </div>
                </div>                        
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="actions-btn btn-design text-center w-full-770">
            <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
        </div>
    </div>
</div>
<!-- End What Other Producers Are Saying Video -->

<!-- Faqs -->
<div class="midi-chord-pack midi-chord-faqs" id="midi-faqs">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">Frequently Asked Questions...</h3>
        </div>
        <div class="midi-chord-faqs__inner w-full-770">
            <div class="accordion custom-accordion width-sm-100" id="midi-faqs">
                <div class="card">
                    <div class="card-header" id="heading-1">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-1">
                                1. Do I need special software to use the Unison MIDI Chord Pack?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-1" class="collapse" aria-labelledby="heading-1">
                        <div class="card-body">
                            <p>Nope. All you need is your DAW such as Ableton, FL Studio, Logic Pro, Studio One, Pro Tools, Cubase, Reason, Reaper, Garage Band, Cakewalk, Mixcraft & all others.</p>
                            <p>The MIDI files work with and are playable by any virtual software instrument such as Serum, Massive, Sylenth1, Kontakt & all others. It's both Mac & PC compatible and no installation is required.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-2">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-2">
                                2. Are the MIDI files in the Unison MIDI Chord Pack royalty free?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2">
                        <div class="card-body">
                            <p>Yes, all the MIDI files in the Unison MIDI Chord Pack are 100% royalty free and cleared for commercial use. You can use them in your music however you want.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-3">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-3">
                                3. How will the Unison MIDI Chord Pack be delivered to me and how quickly?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-3" class="collapse" aria-labelledby="heading-3">
                        <div class="card-body">
                            <p>The download link for the Unison MIDI Chord Pack and all the bonuses will be sent to your email address immediately after your purchase.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-4">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-4">
                                4. How long will the discount and bonuses be available for?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4">
                        <div class="card-body">
                            <p>We can't keep this offer available for much longer. Why? Because it simply wouldn't be fair to the producers who paid full price. If you wait, you may miss out. Secure your copy and take advantage of the 60% off discount and 3 free bonuses while you still can.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-5">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-5">
                                5. What payment options are available?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-5" class="collapse" aria-labelledby="heading-5">
                        <div class="card-body">
                            <p>We securely accept payments through all major credit cards and PayPal. Your information is never stored or shared. We respect your privacy.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-6">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-6">
                                6. What if I'm unsatisfied with the Unison MIDI Chord Pack?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-6" class="collapse" aria-labelledby="heading-6">
                        <div class="card-body">
                            <p>Here's the deal. We're so confident you'll love the Unison MIDI Chord Pack that you can try it out for as long as you want.</p>
                            <p>If you're not happy with the results you get, just email support@unison.audio and we'll give you 100% of your money back. No questions asked.</p>
                            <p>Plus, you can keep all the bonuses absolutely free. You have nothing to lose and everything to gain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions-btn btn-design text-center w-full-770">
            <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
        </div>
    </div>
</div>
<!-- End Faqs -->

<!-- Get The Unison MIDI Chord Pack -->
<div class="midi-chord-pack get-bonus-now get-bonus-now-v2">
    <div class="page-container">
        <div class="section-heading text-center">
            <h3 class="title">Get The Unison MIDI Chord Pack <br> For <span class="text-green">60% Off + Bonuses Now</span></h3>
        </div>
        <div class="get-bonusNow_inner">
            <div class="get-bonusNow__flex d-flex flex-direction-column-770">
                <div class="img-bx w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/MC-Checkout-2.png" class="mw-100 d-none-770" alt="">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Mobile-Pricing-Table.png" width="290" class="mw-100 d-block-770 m-auto" alt="">
                </div>                    
                <div class="list-bx w-full-770">
                    <ul>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Instantly Create Pro-Level Chords & Progressions</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Get Instant Inspiration</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>1,200+ Drag & Drop MIDI Files</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Key Labeled & Organized</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>100% Royalty-Free</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Use With Any Sound</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Compatible With All DAWs</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>Works With Both Mac & PC</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>15 Page Walkthrough PDF</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>60% Off Discount</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>3 Free Exclusive Bonuses</span>
                        </li>
                        <li>
                            <i class="fa fa-fw fa-check"></i>
                            <span>​Lifetime Money-Back Guarantee</span>
                        </li>
                    </ul>
                </div>                    
            </div>
            <div class="content-box w-full-770">
                <h3>UNISON MIDI CHORD PACK + BONUSES</h3>
                <div class="actions-btn btn-design text-center">
                    <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
                </div>
                <p>Try It Risk-Free | 100% Lifetime Money-Back Guarantee</p>
                <div class="pay_by">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/credit-paypal.png" width="250" class="mw-100" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Get The Unison MIDI Chord Pack -->

<!-- MIDI Chord Pack Benefits -->
<div class="midi-chord-pack midi-benefits">
    <div class="page-container">
        <div class="midi-benefits_inner d-flex flex-direction-column-770">
            <div class="midi-benefits__box flex-direction-column-770 w-full-770">
                <div class="img-bx w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Money-Back-250-.png" width="125" class="mw-100" alt="">
                </div>
                <div class="text-bx w-full-770">
                    <h3>Lifetime Money-Back Guarantee</h3>
                    <p>We’re so confident you’ll love the Unison MIDI Chord Pack that you can try it as long as you want. If you’re not happy with the results, just email support@unison.audio and get 100% of your money back - No questions asked. Plus, you can keep all the bonuses absolutely free.</p>
                </div>
            </div>
            <div class="midi-benefits__box flex-direction-column-770 w-full-770">
                <div class="img-bx w-full-770">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/Secure-250-.png" width="125" class="mw-100" alt="">
                </div>
                <div class="text-bx w-full-770">
                    <h3>Secure Payment</h3>
                    <p>We securely accept payments through all major credit cards and PayPal. Your payment information is never stored and is safely encrypted with 256-bit SSL technology.</p>
                </div>
                <div class="actions-btn btn-design text-center d-block-770">
                    <a href="https://unison.audio/securecheckout/mcp-special" class="elButton"><span class="elButtonMain">GET THE PACK</span><span class="elButtonSub">for 60% Off Now</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End MIDI Chord Pack Benefits -->

<!-- MIDI Chord Pack Copyright -->
<div class="midi-chord-pack midi-chord-copyright">
    <div class="page-container">
        <div class="midi-copyright_row">
            <div class="midi__divider"><div class="line"></div></div>
            <p><b>© 2022 Unison.audio</b></p>
            <div class="security__links">
                <ul>
                    <li><a href="/terms-of-use/">Terms of Use</a></li>
                    <li>|</li>
                    <li><a href="/privacy-policy/">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End MIDI Chord Pack Copyright -->

<!-- Popup -->
<div class="midi-popup-overlay"></div>
<div class="midi-popup" id="midi-popup">
    <div class="midi-popup__inner">
        <form id='popupformunq'>
            <div class="midi-popup_row">
                <div class="progress">
                    <div class="progress-bar">Almost Complete...</div>
                </div>
                <h3>Claim Your Copy Of The <br> Unison MIDI Chord Pack Now</h3>
                <div class="field__box">
                    <input type="email" class="input_field" id="emailPopUpfld" placeholder="Enter Your Email Address Here...">
                </div>
            </div>
            <div class="midi-popup_btn_row w-full-770">
                <div class="actions-btn btn-design text-center">
                    <a class="elButton"><span class="elButtonMain" id="elButtonMainPopUp">GET THE PACK <i class="fas fa-angle-double-right"></i></span></a>
                </div>
                <p>Your information is secure and will not be shared.</p>
            </div>
        </form>
    </div>
    <div class="midi-popup__close"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/closemodal.png" alt="close-icon"></div>
    <div class="midi-popup__loader"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-chord-pack/midi-popup-loader.gif" alt="loader"></div>
</div>

<script>
    $(document).ready(function(){
        
        // Open Popup Js...
        $('.openMidiPopup').on('click', function(){
            $('.midi-popup-overlay, .midi-popup').addClass('open');
        });
        $('.midi-popup-overlay, .midi-popup__close').on('click', function(){
            $('.midi-popup-overlay, .midi-popup').removeClass('open');
        });

        // Checkout Js...
        $('#elButtonMainPopUp').on('click', function(){
            $('.midi-popup__loader').css('display','block');
            var mmail = $('#emailPopUpfld').val()
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            if(!regex.test(mmail)) 
            {
                $('.midi-popup__loader').css('display','none');
                jQuery('.notification-error').remove();
                jQuery('#popupformunq').append('<p class="notification-error" style="color: red;text-align: center;">Please enter valid email address.</p>');
                return false;
            }

            if(mmail == '')
            {
                $('.midi-popup__loader').css('display','none');
                jQuery('.notification-error').remove();
                jQuery('#popupformunq').append('<p class="notification-error" style="color:red;text-align:center;">Please enter valid email address.</p>');
                return false;
            }

            var data = 
            {
                'action': 'activaCamp',
                'sub_id': mmail
            };
            var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
            $.post(ajaxurl, data, function(response){
                if(response == 'success'){
                    $('.midi-popup__loader').css('display','none');
                    window.location.href = "https://unison.audio/securecheckout/mcp-special?billing_email="+mmail;
                }
                else{
                    $('.midi-popup__loader').css('display','none');
                    jQuery('.notification-error').remove();
                    jQuery('#popupformunq').append('<p class="notification-error" style="color:red;text-align:center;">This e-mail is already registered.</p>');
                }
            });
        });

    })

    // Audio Play And Pause...
    var myAudio1 = document.getElementById("myAudio1");
    var myAudio2 = document.getElementById("myAudio2");
    var myAudio3 = document.getElementById("myAudio3");
    var myAudio4 = document.getElementById("myAudio4");
    var myAudio5 = document.getElementById("myAudio5");
    var sq1 = document.getElementById("sq1");
    var sq2 = document.getElementById("sq2");
    var sq3 = document.getElementById("sq3");
    var sq4 = document.getElementById("sq4");
    var sq5 = document.getElementById("sq5");
    var audiosqs = document.getElementById("audiosqs");
    var isPlaying = 0;
    function togglePlay(x) {
      if(x == 1){
        if(isPlaying == 1){
          myAudio1.pause();
          isPlaying = 0;
          sq1.style.borderColor = "";
          sq1.classList.remove("sq1-swap");
        }
        else {
          // Pause Others
          myAudio2.pause();
          myAudio3.pause();
          myAudio4.pause();
          myAudio5.pause();
          // Play
          myAudio1.currentTime = 0;
          myAudio1.play();
          isPlaying = 1;
          sq1.style.borderColor = "#01c7b4";
          sq2.style.borderColor = "";
          sq3.style.borderColor = "";
          sq4.style.borderColor = "";
          sq5.style.borderColor = "";
          sq1.classList.add("sq1-swap");
        }
        sq2.classList.remove("sq2-swap");
        sq3.classList.remove("sq3-swap");
        sq4.classList.remove("sq4-swap");
        sq5.classList.remove("sq5-swap");
      }
      if(x == 2){
        if(isPlaying == 2){
          myAudio2.pause();
          isPlaying = 0;
          sq2.style.borderColor = "";
          sq2.classList.remove("sq2-swap");
        }
        else {
          // Pause Others
          myAudio1.pause();
          myAudio3.pause();
          myAudio4.pause();
          myAudio5.pause();
          // Play
          myAudio2.currentTime = 0;
          myAudio2.play();
          isPlaying = 2;
          sq1.style.borderColor = "";
          sq2.style.borderColor = "#01c7b4";
          sq3.style.borderColor = "";
          sq4.style.borderColor = "";
          sq5.style.borderColor = "";
          sq2.classList.add("sq2-swap");
        }
        sq1.classList.remove("sq1-swap");
        sq3.classList.remove("sq3-swap");
        sq4.classList.remove("sq4-swap");
        sq5.classList.remove("sq5-swap");
      }
      if(x == 3){
        if(isPlaying == 3){
          myAudio3.pause();
          isPlaying = 0;
          sq3.style.borderColor = "";
          sq3.classList.remove("sq3-swap");
        }
        else {
          // Pause Others
          myAudio1.pause();
          myAudio2.pause();
          myAudio4.pause();
          myAudio5.pause();
          // Play
          myAudio3.currentTime = 0;
          myAudio3.play();
          isPlaying = 3;
          sq1.style.borderColor = "";
          sq2.style.borderColor = "";
          sq3.style.borderColor = "#01c7b4";
          sq4.style.borderColor = "";
          sq5.style.borderColor = "";
          sq3.classList.add("sq3-swap");
        }
        sq2.classList.remove("sq2-swap");
        sq1.classList.remove("sq1-swap");
        sq4.classList.remove("sq4-swap");
        sq5.classList.remove("sq5-swap");
      }
      if(x == 4){
        if(isPlaying == 4){
          myAudio4.pause();
          isPlaying = 0;
          sq4.style.borderColor = "";
          sq4.classList.remove("sq4-swap");
        }
        else {
          // Pause Others
          myAudio1.pause();
          myAudio2.pause();
          myAudio3.pause();
          myAudio5.pause();
          // Play
          myAudio4.currentTime = 0;
          myAudio4.play();
          isPlaying = 4;
          sq1.style.borderColor = "";
          sq2.style.borderColor = "";
          sq3.style.borderColor = "";
          sq4.style.borderColor = "#01c7b4";
          sq5.style.borderColor = "";
          sq4.classList.add("sq4-swap");
        }
        sq2.classList.remove("sq2-swap");
        sq3.classList.remove("sq3-swap");
        sq1.classList.remove("sq1-swap");
        sq5.classList.remove("sq5-swap");
      }
      if(x == 5){
        if(isPlaying == 5){
          myAudio5.pause();
          isPlaying = 0;
          sq5.style.borderColor = "";
          sq5.classList.remove("sq5-swap");
        }
        else {
          // Pause Others
          myAudio1.pause();
          myAudio2.pause();
          myAudio3.pause();
          myAudio4.pause();
          // Play
          myAudio5.currentTime = 0;
          myAudio5.play();
          isPlaying = 5;
          sq1.style.borderColor = "";
          sq2.style.borderColor = "";
          sq3.style.borderColor = "";
          sq4.style.borderColor = "";
          sq5.style.borderColor = "#01c7b4";
          sq5.classList.add("sq5-swap");
        }
        sq2.classList.remove("sq2-swap");
        sq3.classList.remove("sq3-swap");
        sq4.classList.remove("sq4-swap");
        sq1.classList.remove("sq1-swap");
      }
    };

</script>

<?php get_footer(); ?>