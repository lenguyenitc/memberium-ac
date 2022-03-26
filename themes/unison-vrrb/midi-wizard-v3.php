<?php
/*
 * Template Name: Midi Wizard V3
 *
 * */
get_header('landingpages');
?>

<style>
.black_friday {
    max-width: 180px;
    object-fit: contain;
    width: 100%;
    margin-left: auto;
}

.bf-logo-wrap {
    display: flex;
    margin-left: auto;
    padding-right: 20px;
}
    
/* Common Css */
:root {
    --yellow-color: #faeb39;
    --black-color: #404040;
    --gray-color: #242424;
    --red-color: #ec3c17;
    --white-color: rgb(255, 255, 255);
    --light-gray-color: rgba(0, 0, 0, 0.2);
}

.page-sec .container {
    max-width: 1170px;
    width: 100%;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}
.bg-primary-black {
    background-color: rgb(29, 29, 29) !important;
    background-image: linear-gradient(#2c2c31, #414149);
}
.bg-secondary-black {
    background-color: rgb(37, 37, 37) !important;
}
.bg-white {
    background-color: rgb(255, 255, 255) !important;
}
.bg-yellow {
    background: rgb(1, 199, 180);
}
section.bg-yellow.page-sec.introducing-drum-monkey {
    background-image: linear-gradient(to right, #47475c, #1b1b1e);
}
.bg-red {
    background: rgb(234, 78, 59);
}
.yellow-text {
    color: rgb(1, 199, 180); 
}
.yellow-text-light{
    color: rgb(63, 240, 212);
}
.red-text {
    color: rgb(250, 57, 57);
}
.white-text {
    color: rgb(255, 255, 255);
}
.purple-text {
    color: rgb(131, 146, 255);
}
.black-text{
    color: rgb(45, 45, 45);
}
.d-block-770,
.d-block-700,
.d-block-769 {
    display: none;
}
.text-transform-unset{
    text-transform: unset !important;
}
header {
    margin-top: 26px;
}
.desktop-nav {
    padding: 10px 0px;
}
.desktop-nav .container {
    width: 1170px;
    max-width: 100%;
    margin-right: auto;
    margin-left: auto;
}
.desktop-nav .d-flex > div:nth-child(3),
.desktop-nav .navbar {
    display: none;
}
.desktop-nav .d-flex.justify-content-between {
    display: block !important;
    padding: 0px 25px;
}
.desktop-nav a.navbar-brand {
    margin-left: 0px !important;
}
.mobile-nav .row >div:nth-child(2) {
    display: none;
}
.sticky-bar {
    background-color: rgba(254, 28, 45, 0.95);
    padding: 5px 0px;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
}
.sticky-bar.fixed-bar {
    position: fixed;
    z-index: 99;
}
.sticky-bar p {
    font-size: 14px;
    color: rgb(255, 255, 255);
    /* font-family: 'Gotham Bold', Arial, sans-serif; */
    line-height: normal;
}
.sticky-bar p b {
    color: rgb(255, 255, 255);
}
.bg-image-corner {
    background-size: 100% auto !important;
    -webkit-background-size: 100% auto !important;
    background-repeat: no-repeat !important;
    background-position-y: -3px;
}
ul.list-point li b {
    color: rgb(1, 199, 180);
    font-weight: 700;
}
.section-padding {
    padding: 35px 0;
}
.section-heading h2.heading {
    font-size: 34px;
    line-height: 1.2em;
}
.section-heading h2.heading.h-black {
    color: rgb(36, 36, 36);
}
.generate-drum-loop .section-heading h2.heading.h-black {
    color: rgb(255, 255, 255);
}
.section-heading h3.sub-heading {
    font-size: 24px;
    line-height: 1.2em;
}
.section-heading h3.bottom-heading {
    font-size: 32px;
    color: rgb(255, 255, 255);
    line-height: 1.2em;
}
.video-sec {
    /* max-width: 780px; */
    max-width: 70%;
    width: 100%;
    margin: 30px auto 45px;
}

/* img-fluid   */
.img-fluid {
    width: 100%;
}

/* .embed-responsive-16by9::before {
    padding-top: 0px !important; 
} */

/* Section Divider */
.section-divider {
    padding: 30px 0;
}
.section-divider span {
    display: block;
    max-width: 76%;
    margin: 0 auto;
    width: 100%;
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
}

/* Get Drum Monkey */
.get-drum-monkey {
    padding-top: 30px;
    padding-bottom: 20px;
    outline: none;
    background: rgb(255, 255, 255);
    background-repeat: no-repeat;
}
.get-drum-monkey-inner h1{
    color: rgb(45, 45, 45);
}
.bgCover100 {
    background-size: 100% auto !important;
    -webkit-background-size: 100% auto !important;
    background-repeat: no-repeat !important;
}
.get-drum-monkey .section-heading {
    width: 90%;
    margin: 0 auto;
    padding: 0px 30px;
}
.get-drum-monkey .section-heading .heading {
    font-size: 35px;
    line-height: 1.2;
}
.get-drum-monkey .section-heading .heading strong {
    color: rgb(1, 199, 180);
}
.get-drum-monkey ul.list-point {
    padding: 0px 20px;
}
.get-drum-monkey ul{
    font-weight: 500    ;
}
.get-drum-monkey ul.list-point li {
    font-size: 19px;
    padding-left: 2em;
    margin-bottom: 12px;
    color: rgb(45, 45, 45);
    position: relative;
}
.get-drum-monkey ul.list-point li i {
    position: absolute;
    left: 0;
    top: 5px;
}
.get-drum-monkey .actions-btn {
    padding: 35px 10px 20px 10px;
    text-align: center;
}
/*
.get-drum-monkey .actions-btn a.elButton {
    display: inline-block;
    padding: 9px 40px;
    -webkit-box-shadow: 0px 4px 22px 0px rgb(250, 82, 82, 0.55) !important;
    box-shadow: 0px 4px 22px 0px rgb(250, 82, 82, 0.55) !important;
    border-radius: 5px;
}
.get-drum-monkey .actions-btn a.elButton:hover {
    background-color: #f90303 !important;
}
*/
.get-drum-monkey .actions-btn a>* {
    display: block;
}
.get-drum-monkey .actions-btn a .elButtonSub {
    font-size: 14px;
    opacity: 0.7;
}

/* Supported DAWs: */
.get-drum-monkey .supported-daws {
    padding: 10px 0 35px 0;
}
.get-drum-monkey .supported-daws .hdng {
    padding: 10px 0 15px 0;
    color: #000;
}
/* End Get Drum Monkey */

/* Introducing Drum Monkey */
.introducing-drum-monkey .heading-sec .hdng {
    font-size: 28px;
    /*margin-bottom: 15px !important;*/
}
.video-wrapper{
    width: 77% !important;
    margin-left: auto !important;
    margin-right: auto !important;
}
.introducing-drum-monkey .introducing-video-sec {
    /* max-width: 825px; */
    width: 100%;
    margin: 25px auto 0;
}
.introducing-drum-monkey .introducing-video-sec video {
    -webkit-box-shadow: -2px 0px 20px 0px rgba(0, 0, 0, 0.37);
    box-shadow: -2px 0px 20px 0px rgba(0, 0, 0, 0.37);
}
.introducing-drum-monkey .introducing-content {
    margin-top: 45px;
    font-size: 30px;
    color: var(--white-color);
    line-height: 1.2;
    font-weight: 600;
}
.introducing-drum-monkey .introducing-content b {
    color: rgb(125, 139, 241);
}
/* End Introducing Drum Monkey */

/* With Drum Monkey */
.with-drum-monkey .drum-categories-sec {
    max-width: 90%;
    width: 100%;
    margin: 0 auto;
    margin-top: 45px;
}
.with-drum-monkey .img-graph {
    margin-top: -100px;
}
.with-drum-monkey .drum-categories-sec .drum-category-content {
    background: var(--light-gray-color);
    border-radius: 5px;
    padding: 30px;
}
.bg-red.with-drum-monkey .drum-categories-sec .drum-category-content,
.bg-yellow.with-drum-monkey .drum-categories-sec .drum-category-content {
    background: rgb(255, 255, 255);
}
.with-drum-monkey .drum-categories-sec .drum-category-image {
    background: rgba(0, 0, 0, 0.11);
    border-radius: 5px;
    padding: 0 10px 10px;
    display: flex;
    flex-direction: column;
    height: 100%;
    align-items: center;
    justify-content: center;
}
.bg-red.with-drum-monkey .drum-categories-sec .drum-category-image {
    background-color: rgb(238, 113, 98);
}
.bg-yellow.with-drum-monkey .drum-categories-sec .drum-category-image {
    background-color: rgba(255, 255, 255, 0.11);
}
.with-drum-monkey .drum-category-content h3 {
    font-size: 32px;
    text-align: center;
    line-height: 1.2em;
}
.with-drum-monkey .drum-category-content h4 {
    text-align: center;
    font-size: 24px;
    line-height: 1.2em;
}
.with-drum-monkey .drum-category-content h5 {
    text-align: center;
    font-size: 22px;
    line-height: 1.2em;
}
.with-drum-monkey .drum-category-content h6 {
    text-align: center;
    font-size: 16px;
    line-height: 1.8;
}
.bg-red .drum-categories-inner .drum-category-content h3,
.bg-yellow .drum-categories-inner .drum-category-content h3 {
    color: rgb(36, 36, 36);
}
.drum-categories-inner .drum-category-content h3 {
    font-size: 28px;
}
.why-reason .drum-categories-inner .drum-category-content h3 {
    font-size: 32px;
}
.why-reason .btn-design a.elButton {
    display: block;
}
/* .with-drum-monkey .drum-category-content h3>* {
    display: block;
} */
.with-drum-monkey .category-content {
    margin-top: 20px;
    color: #fff;
}
.with-drum-monkey .category-content p {
    font-size: 20px;
    line-height: 1.3em;
    font-weight: 400;
}
.with-drum-monkey .category-content p span {
    font-weight: 500;
}
.bg-red.with-drum-monkey .category-content p,
.bg-yellow.with-drum-monkey .category-content p {
    color: rgb(36, 36, 36);
}
.with-drum-monkey .category-content p:not(:last-child) {
    margin-bottom: 1.5rem;
}
.with-drum-monkey .category-content p b {
    color: rgb(1, 199, 180);
    font-weight: 500;
}
.bg-red.with-drum-monkey .category-content p b,
.bg-yellow.with-drum-monkey .category-content p b {
    color: rgb(28, 186, 164);
}
.with-drum-monkey .category-content .loop-box {
    margin-top: 5px;
}
.with-drum-monkey .category-content .loop-box .audio {
    padding: 15px;
}
.with-drum-monkey .category-content .loop-box .mejs-audio .mejs-controls {
    font-family: 'Gotham Medium Regular', Arial, sans-serif;
    background-color: #fb3932 !important;
    border-radius: 5px !important;
    padding: 0 10px !important;
}
.mejs-controls:not([style*="display: none"]) {
    background: rgba(255,0,0,.7);
    background: -webkit-linear-gradient(transparent,rgba(0,0,0,.35)) !important;
    background: linear-gradient(transparent,rgba(0,0,0,.35)) !important;
}
section.drum-loop-wrap.instantly-generate {
    background-color: rgb(34, 35, 56);
}
section.drum-loop-wrap.page-sec.instantly-generate h3.sub-heading {
    font-weight: 500 !important;
}
section.payment-options{
    background-image: linear-gradient(to right, #242a2a, #0cb1b0);
    padding: 2.5rem 0 4rem 0;
}
.bg-dark-purple{
    background-color: rgb(34, 35, 56);
}
.bg-light-purple{
    background-color: rgb(91, 126, 210);
}
/* End With Drum Monkey */

/* Buttons Css */
.btn-design {
    padding: 35px 10px 20px 10px;
}
.btn-design.my-3 {
    margin-top: 0.5rem!important;
}
.btn-design a.elButton {
    display: inline-block;
    padding: 9px 40px;
    -webkit-box-shadow: 0px 4px 22px 0px rgb(250 82 82 / 55%) !important;
    box-shadow: 0px 2px 11px 0px rgb(118,140,234) !important;
    border-radius: 5px;
    color: rgb(255, 255, 255);
    font-weight: 600;
    background-color: rgb(28, 186, 164);
    font-size: 28px;
}
.btn-design a.elButton:hover {
    background-color: #2DDABF !important;
}
.btn-design a>* {
    display: block;
}
.btn-design a .elButtonSub {
    font-size: 14px;
    opacity: 0.7;
}

/* Demo Drum Css */
.demo-drum-inner {
    width: 90%;
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
}
.demo-drum-inner .audio_wrap {
    padding: 0px 10px 20px;
    background-color: rgba(0, 0, 0, 0.2);
}
.demo-drum-inner .img-box {
    text-align: center;
}
.demo-drum-inner .img-box img {
    max-width: 100%;
}
.demo-drum-inner .title-box {
    margin-bottom: 20px;
}
.demo-drum-inner .title-box h3 {
    text-align: center;
    color: rgb(255, 255, 255);
    font-size: 26px;
}
.demo-drum-inner .loop-box h4 {
    text-align: center;
    color: rgb(255, 255, 255);
    font-size: 16px;
    line-height: 1.8;
}
.demo-drum-inner .loop-box .audio {
    padding: 10px;
}
.demo-drum-inner .loop-box .mejs-audio {
    width: 100%;
    text-align: center;
    position: relative;
}
.demo-drum-inner .loop-box .mejs-audio .mejs-controls {
    font-family: 'Gotham Medium Regular', Arial, sans-serif;
    background-color: #7086e0 !important;
    border-radius: 5px !important;
    padding: 0 10px !important;
}
.loop-box .mejs-audio .mejs-controls .mejs-volume-button {
    display: block !important;
}
.loop-box .mejs-controls a.mejs-horizontal-volume-slider {
    display: block !important;
}
.loop-box .mejs-time span {
    font-family: 'Gotham', Arial, sans-serif;
    font-weight: 700;
}
.midi-box-page .mejs-time .mejs-time-buffering, 
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
.loop-box .mejs-controls .mejs-time-rail .mejs-time-current {
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
.loop-box .mejs-controls .mejs-time-rail .mejs__time-handle-content {
    border: 4px solid rgba(255,255,255,0.9) !important;
    /* display: block !important; */
    background: rgba(255,255,255,0.9) !important; 
    /* border-radius: 50% !important; */
}
.midi-box-page .mejs-time-handle, .mejs-time-handle-content {
    display: block !important;
    border-radius: 50% !important;
}

.watch-quick-video .section-heading {
    width: 60%;
    margin: 0 auto;
    padding: 0px 35px;
}

/* Generating Perfect Drum Css */
.generate-drum-wrap {
    width: 95%;
    max-width: 100%;
    margin: 0px auto;
    margin-bottom: 40px;
}
.generate-drum-wrap .content-box {
    padding: 29px 60px 100px;
    background-color: rgba(0, 0, 0, 0.11);
    margin-top: 0px;
    width: auto;
    margin-left: 0px;
    margin-right: 0px;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.generate-drum-wrap .content-box .title-wrapper {
    margin-top: 100px;
}
.generate-drum-wrap .content-box .title-wrapper h3 {
    font-size: 32px;
    color: rgb(255, 255, 255);
    line-height: 1.2em;
    padding: 5px;
}
.generate-drum-wrap .content-box .des-wrapper p {
    font-size: 20px;
    color: rgb(255, 255, 255);
    line-height: 1.3em;
    font-weight: 400;
}
.generate-drum-wrap .video-box {
    -webkit-box-shadow: -2px 0px 20px 0px rgb(0 0 0 / 37%);
    box-shadow: -2px 0px 20px 0px rgb(0 0 0 / 37%);
    margin: 0px 10px;
    display: flex;
    flex-direction: column;
    /*height: 100%;*/
}

/* Time Essence */
.time-essence {
    background: #FF4140;
}
.time-essence .content-wrap {
    width: 70%;
    max-width: 100%;
    margin: 0 auto;
    margin-top: 30px;
}
.time-essence .content-wrap p {
    text-align: left;
    font-size: 20px;
    color: rgb(255, 255, 255);
    margin-bottom: 32px;
    font-weight: 400;
}
.time-essence .content-wrap p b {
    color: rgb(255, 255, 255);
    font-weight: 500;
}

/* Payment Option */

.payment-options .mb-5 {
    margin-bottom: 2rem!important;
}
.payment-wrap.left, .payment-wrap.right {
    border-radius: 5px;
    padding-top: 15px;
    padding-left: 40px;
    padding-right: 30px;
    padding-bottom: 8px;    
}
.payment-wrap.left {
    background: #2d2f43;
    margin-bottom: 40px;
}
.payment-wrap.right {
    background: linear-gradient(to right, #848cea, #18bdaa);
}
.payment-wrap .category-content ul.list-point{
    margin-bottom: 0.5rem;
}
.payment-wrap .category-content li{
    color: rgb(255, 255, 255);
    font-weight: 700;
    font-size: 16px;
        padding-bottom: 2px;
    margin-bottom: 2px;
}
.payment-wrap .category-content li i {
    color: rgb(1, 199, 180);
    margin-left: -1.5em;
}
.payment-options-inner span.h3.small {
    font-size: 75%;
    color: #fff;
    font-size: 16px;
}
.payment-options-inner .column-inner {
    padding: 25px 20px 30px;
    background-color: rgba(35, 34, 44, 0.86);
    border-color: rgb(56, 57, 86);
    -webkit-box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
    -moz-box-shadow: 0 1px 5px rgba(0,0,0,0.2);
    box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
    border-radius: 5px;
}
.payment-options-inner .column-inner.bg-white {
    background: rgb(255, 255, 255);
}
.payment-options-inner .column-inner .title-box h3,
.payment-options-inner .column-inner .title-box h4 {
    text-align: center;
    font-size: 28px;
    color: rgb(125, 139, 241);
    line-height: 1.2em;
    padding: 4px 0px;
}
.payment-options-inner .column-inner .title-box h4 {
    font-size: 22px;
    padding: 0px;
}
.payment-options-inner .payment-wrap {
    margin-top: 10px;
}
.payment-options-inner .payment-wrap .payment-item {
    display: flex;
    align-items: center;
    background-color: #878787;
    margin-bottom: 5px;
    border-radius: 5px;
    padding: 8px;
}
.payment-options-inner .bg-yellow .payment-wrap .payment-item {
    background-color: #242424;
}
.payment-options-inner .payment-wrap .payment-item .img-box {
    flex: 0 0 20%;
    max-width: 20%;
}
.payment-options-inner .payment-wrap .payment-item:first-child .img-box {
    flex: 0 0 30%;
    max-width: 30%;
}
.payment-options-inner .payment-wrap .payment-item .content-box {
    flex: 0 0 80%;
    max-width: 80%;
    padding: 0px 10px;
}
.payment-options-inner .payment-wrap .payment-item:first-child .content-box {
    flex: 0 0 70%;
    max-width: 70%;
}
.payment-options-inner .payment-wrap .payment-item .content-box h3 {
    color: rgb(255, 255, 255);
    font-size: 20px;
    padding: 0px;
    /* margin-top: 10px !important; */
    margin-bottom: 6px !important;
    line-height: 1.1;
}
.payment-options-inner .payment-wrap .payment-item .content-box h3 span {
    text-decoration: underline;
}
.payment-options-inner .payment-wrap .payment-item .content-box p {
    font-size: 16px;
    color: rgb(250, 235, 57);
    line-height: 1;
    font-weight: 600;
}
.payment-options-inner .payment-price {
    margin-top: 15px;
}
.payment-options-inner .payment-price h4 {
    font-size: 20px;
    /*color: rgb(236, 60, 23);*/
    line-height: 1.2em;
    margin-top: 0.5rem !important;
}
.payment-options-inner .payment-price h3 {
    font-size: 24px;
    line-height: 1.2em;
}
.payment-options-inner .payment-price h3 span {
    color: rgb(209, 72, 65);
}
.payment-options-inner .money-back {
    text-align: center;
    font-size: 12px;
    line-height: 1.3em;
    font-weight: 500;
}
.payment-options-inner .left .money-back{
    color: rgb(255, 255, 255);
}
.payment-options-inner .right .money-back{
    color: rgb(36, 36, 36);
}
.payment-options .btn-design a.elButton {
    display: block;
}

section.more-testimonials {
    background-color: rgb(34, 35, 56);
}
.more-testimonials .testimonial-content .wistia_responsive_padding {
    margin-bottom: 14px;
}
.more-testimonials .testimonial-item span.yellow-text {
    font-size: 14px;
    font-weight: 500;
    color: rgb(45, 218, 191);
}

.bg-primary-gray {
    background-color: rgb(36, 36, 36);
}
.wizard.testimonial-content img {
    border-radius: 50% !important;
    width: 130px;
}
.wizard.testimonial-content .inner-column {
    background-color: rgba(0, 0, 0, 0.11);
    padding: 25px;
}

.wizard.testimonial-content .elHeadline {
    padding-top: 12px;
    padding-bottom: 12px;
}

.testimonial-content .testimonial-item h3 {
    font-size: 24px;
    font-weight: 700;
    margin-top: 18px;
}
.testimonial-content .testimonial-item .text-center {
    margin-top: 15px;
}

.fully-protected .content-wrap {
    width: 70%;
    max-width: 100%;
    background-color: rgb(255, 255, 255);
    margin: 0 auto;
    margin-top: 24px;
    padding: 35px;
    border-radius: 5px;
}
.fully-protected .content-wrap h3 {
    font-size: 28px;
    color: rgb(36, 36, 36);
    line-height: 1.2em;
    text-transform: capitalize;
    margin-top: 15px;
}
.fully-protected .content-wrap p {
    font-size: 20px;
    color: rgb(36, 36, 36);
    line-height: 1.4em;
    margin-bottom: 24px;
    font-weight: 400;
}
.fully-protected .content-wrap p:last-child{
    margin-bottom: 0;
}
.fully-protected .content-wrap p b {
    color: rgb(28, 186, 164);
    font-weight: 500;
}
.are-you-ready .btn-design {
    padding: 57px 10px 0 10px;
}
.are-you-ready .list-point {
    margin-bottom: 10px;
    margin-top: 15px;
}
.are-you-ready .list-point li {
    font-size: 20px;
    padding-bottom: 6px;
    list-style-type: none;
    margin-bottom: 6px;
    padding-left: 2em;
    font-weight: 400;
}
.are-you-ready .list-point li span {
    font-weight: 500;
}
.are-you-ready .list-point li i {
    color: rgb(63, 240, 212);
    margin-left: -2em;
    margin-right: 0.71428571em;
}
.exclusive-bonus.with-drum-monkey .category-content ul {
    padding-left: 18px;
}
.exclusive-bonus.with-drum-monkey .category-content ul li {
    font-size: 20px;
    line-height: 1.3em;
    font-weight: 400;
    list-style: disc;
}
.exclusive-bonus.with-drum-monkey .category-content ul li b {
    font-weight: 500;
    color: rgb(250, 235, 57);
}
.with-drum-monkey.exclusive-bonus .drum-categories-sec figure {
    margin-top: -2px;
    padding: 0px 35px;
}

/* Accordion */
.custom-accordion {
    width: 75%;
    max-width: 100%;
    margin: 0 auto;
    margin-top: 30px;
}
.custom-accordion>.card {
    border: none;
}
.custom-accordion>.card:not(:first-child) {
    margin-top: 20px;
}
header{
    margin-top: 0;
}
.custom-accordion .card-header {
    padding: 0;
    background: rgb(125, 139, 241);
    border-radius: 5px !important;
}
.custom-accordion .card-header h2 {
    text-transform: unset;
}
.custom-accordion .card-header button {
    position: relative;
    padding: 15px 40px 15px 15px;
    border: 0;
    border-radius: 0;
    text-decoration: none;
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    width: 100%;
    background: transparent;
    line-height: normal;
    text-transform: unset;
}
.custom-accordion .card-header button:focus {
    box-shadow: none;
}
.custom-accordion .card-header button:after {
    content: "+";
    position: absolute;
    top: 50%;
    right: 18px;
    font-size: 26px;
    line-height: 0;
}
.custom-accordion .card-header button[aria-expanded="true"]:after {
    content: "-";        
    font-size: 26px;
}
.custom-accordion .card-body {
    margin-top: 15px;
    padding: 15px;
    width: 100%;
}
.custom-accordion .card-body p {
    font-size: 20px;
    line-height: 1.8;
    color: rgb(36, 36, 36);
    font-weight: 400;
}
.custom-accordion .card-body p b {
    color: rgb(36, 36, 36);
    font-weight: 500;
}

/* Facebook Testimonial */
.facebook-testimonial.first{
    background-image: linear-gradient(to right, #357bf8, #f46171);
}
.facebook-testimonial.second {
    background-color: rgb(255, 255, 255) !important;
}
.facebook-testimonial.second .section-heading {
    background-image: linear-gradient(to right, #357bf8, #f46171);
    padding-top: 21px;
    padding-bottom: 20px;
    border-radius: 15px;
}
.facebook-testimonial .facebook-content {
    padding: 30px 10px 20px;
    margin: 15px auto 0px;
    background-color: rgb(255, 255, 255);
    width: 100%;
    max-width: 100%;
    border-radius: 10px;
}
.facebook-testimonial .facebook-content .row {
    margin-right: 0px;
    margin-left: 0px;
}
.facebook-testimonial .facebook-content .inner-column {
    padding: 0 10px;
}
.facebook-testimonial .facebook-content .testimonial-item:not(:last-child) {
    margin-bottom: 10px;
}

.time-essence .section-heading h3.sub-heading {
    font-size: 28px;
}

.faq-sec .center-img {
    width: 50%;
    max-width: 100%;
    margin: 0 auto;
}
.facebook-testimonial.second .show_on_mobile, .how-much-cost .show_on_mobile, .behind-scene .show_on_mobile{
    display: none;
}


/* ********* */
.figure-2 {
    margin-top: -115px !important;
}
a.navbar-brand img{
    width:135px !important;
    height:auto !important;
}

/* Min Width */
@media(min-width:770px) {
    .with-drum-monkey .drum-categories-sec .row.row-reverse {
        flex-direction: row-reverse;
    }
}
@media only screen and (min-width: 0px) and (max-width: 770px) {
    .generate-drum-loop .section-heading {
        padding: 0px 25px;
    }
}
/* Max Width */
@media(max-width:1170px) {
    .page-sec .container {
        max-width: 100%;
    }
    .generate-drum-wrap .content-box {
        padding-left: 20px;
        padding-right: 20px;
    }
    .figure-2 {
        margin-top: -100px !important;
    }
}

@media only screen and (max-width: 1024px) {
    .demo-drum-inner .title-box h3 {        
        font-size: 24px;
    }
    .watch-quick-video .section-heading {
        width: 65%;
    }
    .facebook-testimonial .watch-video-inner .section-heading figure img {
        width: 280px;
    }
    .btn-design a.elButton{
        font-size: 24px;
    }
}

@media only screen and (max-width: 770px) {

    .with-drum-monkey .category-content.mt-sm-0 {
        margin-top: 0px;
    }
    .desktop-nav .d-flex.justify-content-between {
        padding: 0px 10px;
    }
    .mobile-nav .row {
        justify-content: center !important;
    }
    .video-wrapper {
        width: 100% !important;
    }
    .width-sm-100 {
        width: 100% !important;
        max-width: 100% !important;
    }
    .d-none-770 {
        display: none;
    }
    .d-block-770 {
        display: block;
    }
    .w-full-770 {
        width: 100% !important;
        max-width: 100% !important;
    }
    .video-sec {
        max-width: 100%;
        width: 100%;
        margin: 20px 0px;
    }
    .btn-design a.elButton {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 20px;
    }
    .get-drum-monkey .section-heading {
        width: 100%;
        margin: 0 auto;
        padding: 0px;
    }
    .get-drum-monkey .actions-btn {
        padding: 8px 0px;
    }
    .demo-drum-inner {
        width: 100%;
    }
    .get-drum-monkey .section-heading .heading {
        font-size: 24px;
    }
    .get-drum-monkey .row>[class^="col-"] {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .get-drum-monkey ul.list-point {
        padding: 0px;
    }
    .section-heading figure img {
        width: 225px;
    }
    .bgCover100 {
        background-size: 100% auto !important;
        -webkit-background-size: 100% auto !important;
        background-repeat: no-repeat !important;
        background-position: top !important;
    }
    .bg-image-corner {
        background-size: cover !important;
        -webkit-background-size: cover !important;
        background-repeat: repeat repeat !important;
        background-position: center center;
    }
    .watch-quick-video .section-heading {
        width: 100%;
        padding: 0px 20px;
    }
    .how-much-cost .section-heading figure img {
        width: 155px;
    }
    .why-reason .section-heading figure img,
    .behind-scene .section-heading figure img,
    .to-be-able .section-heading figure img,
    .instantly-generate .section-heading figure img,
    .are-you-ready .section-heading figure img {
        width: 175px;
    }
    /*.introducing-drum-monkey .heading-sec img {
        width: 290px;
    }*/
    .facebook-testimonial .section-heading img {
        width: 225px;
    }
    .generate-drum-loop .section-heading {
        padding: 0px;
    }
    .exclusive-bonus .section-heading img {
        width: 100%;
    }
    .fully-protected .section-heading figure img {
        width: 520px;
    }
    .faq-sec .logo-image .mobile-img {
        margin-top: 40px;
    }
    .faq-sec .center-img {
        width: 100%;
    }
}
@media only screen and (max-width: 700px) {
    .d-none-700 {
        display: none;
    }
    .d-block-700 {
        display: block;
    }
    .get-drum-monkey ul.list-point {
        padding: 0px;
    }
    .get-drum-monkey ul.list-point li {
        font-size: 18px;
    }
    .with-drum-monkey .drum-category-content h3 {
        font-size: 22px;
    }
    .with-drum-monkey .category-content p {
        font-size: 18px;
    }
    .demo-drum-inner .title-box h3 {
        font-size: 22px;
    }
    .section-heading h2.heading {
        font-size: 22px;
    }
    .section-heading h3.sub-heading {
        font-size: 20px;
    }
    .section-heading h3.bottom-heading {
        font-size: 22px;
    }
    .generate-drum-wrap .content-box .title-wrapper h3 {
        font-size: 22px;
    }
    .generate-drum-wrap .content-box .des-wrapper p {
        font-size: 18px;
    }
    .introducing-drum-monkey .introducing-content {
        font-size: 21px;
    }
    .time-essence .section-heading h3.sub-heading {
        font-size: 22px;
    }
    .time-essence .content-wrap p {
        font-size: 18px;
    }
    .payment-options-inner .column-inner .title-box h3, 
    .payment-options-inner .column-inner .title-box h4 {
        font-size: 24px;
    }
    .payment-options-inner .payment-price h3 {
        font-size: 20px;
    }
    .fully-protected .content-wrap h3 {
        font-size: 22px;
    }
    .fully-protected .content-wrap p {
        font-size: 18px;
    }
    .custom-accordion .card-header button,
    .custom-accordion .card-body p {
        font-size: 18px;
    }
    .exclusive-bonus.with-drum-monkey .category-content ul li {
        font-size: 18px;
    }
    .why-reason .drum-categories-inner .drum-category-content h3 {
        font-size: 22px;
    }
    .with-drum-monkey .drum-category-content h4,
    .with-drum-monkey .drum-category-content h5 {
        font-size: 18px;
    }
}

@media only screen and (max-width: 769px) {
     

    .row>[class^="col-"] {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .copyright .col-auto {
        flex: auto;
    }
    .col-lg-3.text-center.socials {
        flex: auto;
    }
    .d-none-769 {
        display: none;
     }
    .d-block-769 {
        display: block;
    }    
    .with-drum-monkey .drum-categories-sec{
        margin-top: 25px;
    }
    .with-drum-monkey .drum-categories-sec .drum-category-content {
        padding: 30px 10px;
    }
    .demo-drum-inner .audio_wrap.audio_wrap_right {
        margin-top: 20px;
    }
    .generate-drum-wrap {
        width: 100%;
        margin-bottom: 20px;
    }
    .generate-drum-wrap .content-box {
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        justify-content: center;
    }
    .generate-drum-wrap .content-box .title-wrapper {
        margin-top: 0px;
    }
    .generate-drum-wrap .video-box {
        margin: 20px 0px;
        height: auto;
    }
    .with-drum-monkey.exclusive-bonus .drum-categories-sec figure {
        margin-top: 20px;
        padding: 0px;
    }
    .payment-options-inner .payment-wrap .payment-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
    .payment-options-inner .payment-wrap .payment-item .img-box,
    .payment-options-inner .payment-wrap .payment-item:first-child .img-box,
    .payment-options-inner .payment-wrap .payment-item .content-box,
    .payment-options-inner .payment-wrap .payment-item:first-child .content-box {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .payment-options-inner .column-inner.bg-yellow {
        margin-top: 20px;
    }
    .payment-options-inner .payment-wrap .payment-item .content-box h3 {
        font-size: 18px;
        margin-top: 10px !important;
    }    
}
@media(max-width:767px) {

    .are-you-ready .list-point li{
        font-size: 18px;
    }
    .facebook-testimonial.second .show_on_mobile, .how-much-cost .show_on_mobile, .behind-scene .show_on_mobile{
        display: block !important;
    }
    .facebook-testimonial.second .show_on_desktop, .how-much-cost .show_on_desktop, .behind-scene .show_on_desktop{
        display: none !important;
    }
    /*header {
        margin-top: 42px;
    }*/
    section.drum-loop-wrap.instantly-generate .demo-drum-inner.pb-4 {
        padding-bottom: 2.5rem !important;
    }
    section.facebook-testimonial.second {
        padding-top: 0 !important;
    }

    section.facebook-testimonial.second .container {
        padding: 0;
    }

    section.facebook-testimonial.second .section-heading.text-center {
        border-radius: unset;
    }
    .payment-wrap.left, .payment-wrap.right {
        padding-left: 50px;
        padding-right: 18px;
    }
    .payment-wrap.left {
        margin-bottom: 0px;
    }
}
@media(max-width:567px) {
    .section-heading h2.heading span {
        padding: 0px;
    }
}

@media(max-width:414px) {
    .fully-protected .fully-protected-inner .section-heading .heading > br {
        display: none;
    }
    .sticky-bar p {
        font-size: 13px;
    }
}

@media(max-width:369px) {
    .btn-design a.elButton {
        font-size: 16px;
    }
}
@media (max-width:448px) {
    .bf-logo-wrap {
        display: flex;
        margin-left: 0;
        justify-content: space-between;
        padding-right: 0;
    }
}

</style>

<script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

<!-- Sticky Bar -->
<!-- <div class="sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center"><b>Important: Only 3500 Licenses Available. Secure Yours Before They Sell Out.</b></p>
            </div>
        </div>
    </div>
</div>
 --><!-- End Sticky Bar -->

<!-- Get Drum Monkey -->
<section class="get-drum-monkey page-sec bgCover100" style="background-image:url(<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-Top-Section-Tinypng-.png); ">
    <div class="container">
        <div class="get-drum-monkey-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                        <h1 class="heading d-none-770">
                            "The <strong>Magic Way</strong> To Produce Hit Songs <br />
                            In<u> 30 Genres</u> &amp; Get <u>Infinite Inspiration</u>"
                        </h1>
                        <h1 class="heading d-block-770">
                            "The <strong>Magic Way</strong> To<br/> Produce Hit Songs<br/>
                            In<u> 30 Genres</u> &amp; Get<br/> <u>Infinite Inspiration</u>"
                        </h1>
                    </div>
                    <div class="video-sec">
                        <div class="video-sec-wrapper">
                            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/yyibgt20md?videoFoam=true" title="MIDI Wizard VSL 4 Bonuses 2021 Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%"></iframe></div></div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-point">
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Instantly Generate Unlimited, Hit-Worthy</b> chord progressions & melodies in 30 genres of music
                        </li>
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Supercharge Your Workflow & Creative Process </b>to finish double the music in half the time
                        </li>
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Gain A Huge Unfair Competitive Advantage</b> so you can finally get the plays you deserve<br>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-point">
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Have Infinite Inspiration At Your Fingertips</b> so you never run into a creative block again
                        </li>
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Fuse Together Different Genres </b>to find your unique sound and stand out from the crowd
                        </li>
                        <li><i contenteditable="false" class="fa fa-fw fa-check"></i><b>Push Your Music Beyond Human Limits</b> by accessing the power of cutting edge algorithms
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="actions-btn btn-design text-center">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="supported-daws text-center">
                        <h3 class="hdng">Supported DAWs:</h3>
                        <div class="supported-logos d-none-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Daw-Icons-with-bitwig.png" class="mw-100" alt="" width="800" tabindex="0">
                        </div>
                        <div class="supported-logos d-block-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/DAW-Icons-Mobile-2.png" class="mw-100" alt="" width="280" tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- End Get Drum Monkey -->

<!-- Introducing Drum Monkey -->
<section class="bg-yellow page-sec introducing-drum-monkey pt-5">
    <div class="container">
        <div class="introducing-drum-monkey-inner text-center">
            <div class="heading-sec">
                <h3 class="hdng">Introducing:</h3>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Midi-Wizard-Logo-Main.png" class="mw-100" alt="" width="500" tabindex="0">
            </div>
            <div class="video-wrapper">
                <div class="introducing-video-sec">
                    <video width="100%" autoplay="" loop="" muted="" playsinline="" src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Top+Section.mp4"></video>
                </div>
            </div>
            <div class="introducing-content d-none-700">
                The <b>World's First</b> (And Only) Chord Progression & Melody Generator <div>That's<b> Genre-Specific</b> &amp; Actually Sounds Good <b>93% Of The Time</b> </div>
            </div>
            <div class="introducing-content d-block-700">
                The <b>World's First</b> (And Only) Chord Progression & Melody Generator That's <b>Genre-Specific</b> &amp; Actually Sounds Good <b>93% Of The Time</b>
            </div>
        </div>
    </div>
</section> <!-- End Introducing Drum Monkey -->

<!-- With Drum Monkey -->
<section class="with-drum-monkey page-sec bg-primary-black to-be-able pt-5">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <!-- <figure class="mb-4 pt-2">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Explosion.png" class="elIMG ximg imgRoundCorners noborder imgOpacity1" alt="" width="225" tabindex="0">
                </figure> -->
                <h2 class="heading">With MIDI Wizard <span class="yellow-text">You'll Be Able To...</span></h2>
            </div>
            <div class="drum-categories-sec mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Instantly Generate<br/>
                                <span class="yellow-text">Crazy Chord Progressions</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0" style="margin-top:-45px;"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_1_1X1_alpha-no-shadow.gif" class="mw-100" width="375" alt="" tabindex="0"></figure>                               
                            </div>
                            <div class="category-content">
                                <p>Chord progressions are <b>the foundation</b> for any hit song.</p>
                                <p>That's why <b>Billboard #1</b> <b>songs</b> like "The Box" "God's Plan" and "Thank U, Next" are founded upon on a single, great chord progression.</p>
                                <p>With<b> MIDI Wizard</b>, you'll be able to captivate your listeners with <b>custom-generated</b>, beautiful chord progressions.</p>
                                <p>From basic, to complex to insanely advanced — you'll have <b>unlimited possibilities </b>at your fingertips.</p>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_1_1X1_alpha-no-shadow.gif" class="mw-100" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Instantly Generate<br/>
                                <span class="yellow-text">Mind-Blowing Melodies</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_2_1X1_alpha-no-shadow.gif" class="mw-100" width="375" alt=""  tabindex="0"></figure>
                            </div>
                            <div class="category-content mt-sm-0">
                                <p>Your song's melody can be the <b>determining factor</b> for whether a listener will skip it or play it on repeat.</p>
                                <p>In order for your melodies to be radio worthy... They need to <b>trigger emotion,</b> be memorable, have call and response among other things.</p>
                                <p>With <b>MIDI Wizard, </b>you'll be able to <b>hook your listeners </b> with custom generated melodies that follow proven patterns from hit songs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_2_1X1_alpha-no-shadow.gif" class="mw-100" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Get Infinite Inspiration<br>
                                <span class="yellow-text">On Demand</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/8.-Inspired---Idea-Right.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>If you've ever <b>hit a brick wall</b> half way into a song you know how frustrating producer's block is.</p>
                                <p>With <b>MIDI Wizard, </b>you'll be able to <b>randomly generate</b> unlimited pro-level chord progressions & melodies instantly...</p>
                                <p>So, you can <b>never run out of ideas</b>, deal with producer's block, or aimlessly stare at a blank DAW again.</p>
                                <p>And, you'll get the inspiration you need to<b> complete your unfinished projects</b> so you can finally release them.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/8.-Inspired---Idea-Right.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Finish Your Music<br>
                                <span class="yellow-text">In Record Time</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/10.-Running-Fast-Right.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>If you want to achieve any level of success as a producer, <b>consistently finishing music is essential.</b></p>
                                <p>That's because without finishing music, you won't be able to <b>master the entire production process</b> or actually get your music out to the world.</p>
                                <p>With <b>MIDI Wizard</b> you'll have the ability to <b>generate the foundation</b> for your songs in seconds to maximize your output.</p>
                                <p>Say goodbye to spending hours chord progressions & melodies and <b>start working smart</b> to finish music lighting-fast.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/10.-Running-Fast-Right.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Gain An Unfair<br>
                                <span class="yellow-text">Competitive Edge</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/9.-Sneaky-Right.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>With <b>over 305,802 producers</b> downloading a DAW every single day... competition is at an <b>all time high in 2021</b>&nbsp;— making it tough to break through.</p>
                                <p>With <b>MIDI Wizard</b>, you'll have the <b>unique ability</b> to instantly generate beautiful chord progressions and pro-level melodies.</p>
                                <p>So, you can get miles ahead of other producers and gain a <b>massive competitive edge</b> and be set up for success.</p>
                                <p>Even producers with years of experience and expensive studio gear won't be able to keep up with your <b>insane output</b>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/9.-Sneaky-Right.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Get Your Music The<br>
                                <span class="yellow-text">Attention It Deserves</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/11.-Strong-Proud-Right.png" class="mw-100" width="225" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>In today's busy world, people's <b>attention spans are shorter</b> than ever before.</p>
                                <p>If you want to get any recognition in 2021, your music needs to <b>impact people on a primal level</b> to hook them.</p>
                                <p>With <b>MIDI Wizard</b>, you'll be able to <b>instantly generate</b> captivating chord progressions and catchy melodies.</p>
                                <p>So, instead of your friends &amp; family talking over your demos, they'll be begging to <b>hear more of your music.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/11.-Strong-Proud-Right.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End With MIDI Wizard -->

<!-- Drum Loops Section -->
<section class="drum-loop-wrap page-sec instantly-generate pt-4">
    <div class="container">
        <div class="drum-loop-inner">
            <div class="section-heading text-center">
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Speaker-MW.png" class="elIMG ximg imgRoundCorners" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading d-none-770"><span class="yellow-text">Instantly Generate Radio-Worthy </span>Chord Progressions<br/> & Melodies In <u>30 Different Genres</u></h2>
                <h2 class="heading d-block-770">Instantly Generate Radio-Worthy Chord Progressions <br>& Melodies In <span class="yellow-text">30 Different Genres</span></h2>
                <h3 class="sub-heading mt-2">All The Demos Below Were Generated With <span class="purple-text">MIDI Wizard...</span><br>With <span class="purple-text">Just 1 Click</span> Of A Button:</h3>
            </div>
            <div class="demo-drum-inner mt-4 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Ambient_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Ambient & <span class="yellow-text">Downtempo</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ambient.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ambient.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ambient.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ambient.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ambient.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ambient.mp3"][/audio]'); ?>
                                </div>
                            </div>        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/BigRoom_Progressive_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Big Room &<span class="yellow-text"> Progressive House</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Big+Room+%26+Progressive+House.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Big+Room+%26+Progressive+House.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Big+Room+%26+Progressive+House.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Big+Room+%26+Progressive+House.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Big+Room+%26+Progressive+House.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Big+Room+%26+Progressive+House.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Cinematic-Orchestral.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Cinematic &<span class="yellow-text"> Orchestral</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Cinematic+%26+Orchestral.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Cinematic+%26+Orchestral.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Cinematic+%26+Orchestral.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Cinematic+%26+Orchestral.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Cinematic+%26+Orchestral.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Cinematic+%26+Orchestral.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Classical_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Classical</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Classical.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Classical.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Classical.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Classical.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Classical.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Classical.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Country.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Country</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Country.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Country.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Country.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Country.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Country.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Country.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Dancehall-Afrobeats.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Dancehall & <span class="yellow-text">Afrobeats</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dancehall+%26+Afrobeats.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dancehall+%26+Afrobeats.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dancehall+%26+Afrobeats.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dancehall+%26+Afrobeats.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dancehall+%26+Afrobeats.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dancehall+%26+Afrobeats.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Disco_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Disco</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Disco.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Disco.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Disco.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Disco.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Disco.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Disco.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Dubstep-DnB_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Dubstep &<span class="yellow-text"> DnB</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dubstep+%26+DnB.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dubstep+%26+DnB.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Dubstep+%26+DnB.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dubstep+%26+DnB.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dubstep+%26+DnB.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Dubstep+%26+DnB.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Ethnic.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Ethnic</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ethnic.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ethnic.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Ethnic.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ethnic.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ethnic.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Ethnic.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Folk_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Folk &<span class="yellow-text"> Indie</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Folk+%26+Indie.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Folk+%26+Indie.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Folk+%26+Indie.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Folk.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Folk.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Folk.mp3"][/audio]'); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Funk_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Funk</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Funk.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Funk.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Funk.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Funk.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Funk.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Funk.mp3"][/audio]'); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/FutureBass_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Future Bass &<span class="yellow-text"> Melodic Trap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Future+Bass+%26+Melodic+Trap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Future+Bass+%26+Melodic+Trap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Future+Bass+%26+Melodic+Trap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Future+Bass+%26+Melodic+Trap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Future+Bass+%26+Melodic+Trap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Future+Bass+%26+Melodic+Trap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Gospel_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Gospel</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Gospel.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Gospel.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Gospel.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Gospel.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Gospel.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Gospel.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Hardstyle.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Hardstyle & <span class="yellow-text">Hardcore</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hardstyle+%26+Hardcore.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hardstyle+%26+Hardcore.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hardstyle+%26+Hardcore.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hardstyle+%26+Hardcore.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hardstyle+%26+Hardcore.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hardstyle+%26+Hardcore.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/HipHopRap_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Hip Hop &<span class="yellow-text"> Rap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hip+Hop+%26+Rap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hip+Hop+%26+Rap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Hip+Hop+%26+Rap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hip+Hop+%26+Rap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hip+Hop+%26+Rap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Hip+Hop+%26+Rap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/House_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>House &<span class="yellow-text"> Deep House</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+House.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+House.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+House.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+House.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+House.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+House.mp3"][/audio]'); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Jazz_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Jazz</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Jazz.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Jazz.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Jazz.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Jazz.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Jazz.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Jazz.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Latin_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Latin &<span class="yellow-text"> Reggaeton</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Latin.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Latin.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Latin.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Latin.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Latin.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Latin.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/LoFi.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Lo-Fi</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Lo-Fi.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Lo-Fi.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Lo-Fi.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Lo-Fi.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Lo-Fi.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Lo-Fi.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/NeoSoul_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Neo-Soul</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Neo-Soul.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Neo-Soul.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Neo-Soul.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Neo-Soul.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Neo-Soul.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Neo-Soul.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Pop_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Pop &<span class="yellow-text"> Future-Pop</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Pop+%26+Future-Pop.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Pop+%26+Future-Pop.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Pop+%26+Future-Pop.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Pop+%26+Future+Pop.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Pop+%26+Future+Pop.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Pop+%26+Future+Pop.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/R-B_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">R&B</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+R%26B.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+R%26B.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+R%26B.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+R%26B.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+R%26B.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+R%26B.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Reggae_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Reggae</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Reggae.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Reggae.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Reggae.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Reggae.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Reggae.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Reggae.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Rock_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Rock & <span class="yellow-text">Metal</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Rock+%26+Metal.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Rock+%26+Metal.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Rock+%26+Metal.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Rock+%26+Metal.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Rock+%26+Metal.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Rock+%26+Metal.mp3"][/audio]'); ?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Soul_Alpha_SHadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Soul</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Soul.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Soul.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Soul.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Soul.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Soul.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Soul.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Synthwave.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Synthwave &<span class="yellow-text"> Synth-Pop</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Synthwave+%26+Synth-Pop.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Synthwave+%26+Synth-Pop.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Synthwave+%26+Synth-Pop.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Synthwave+%26+Synth-Pop.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Synthwave+%26+Synth-Pop.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Synthwave+%26+Synth-Pop.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Techno_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Techno & <span class="yellow-text">Melodic Techno</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Techno.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Techno.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Techno.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Techno.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Techno.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Techno.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Trance_Alpha_Shadow.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Trance &<span class="yellow-text"> Psy-Trance</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trance+%26+Psytrance.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trance+%26+Psytrance.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trance+%26+Psytrance.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trance+%26+Psytrance.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trance+%26+Psytrance.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trance+%26+Psytrance.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Trap.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Trap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+Trap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trap.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trap.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+Trap.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/UK-Drill.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>UK Drill &<span class="yellow-text"> UK Grime</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+UK+Drill+%26+UK+Grime.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+UK+Drill+%26+UK+Grime.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+UK+Drill+%26+UK+Grime.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+UK+Drill+%26+UK+Grime.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+UK+Drill+%26+UK+Grime.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+UK+Drill+%26+UK+Grime.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>                
                </div>
            </div>
            <div class="demo-drum-inner pt-0 pb-4 px-0">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/HYBRID_Alpha_Shadow-2-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">???</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Chord Progression:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+%3F%3F%3F.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+%3F%3F%3F.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Chords+-+%3F%3F%3F.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo MIDI Wizard Melody:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+%3F%3F%3F.mp3" wav="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+%3F%3F%3F.mp3" ogg="https://unisonmidiwizard.s3.us-west-1.amazonaws.com/Audio+Demos/Unison+-+MIDI+Wizard+-+Leads+-+%3F%3F%3F.mp3"][/audio]'); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-heading text-center">
                        <h3 class="bottom-heading p-3">Unlimited, Mind-Blowing Chord Progressions<br/>& Melodies <span class="yellow-text">At Your Fingertips...</span></h3>
                    </div>
                    <div class="actions-btn btn-design text-center p-0 mt-4">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI Wizard NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Loops Section -->

<!-- Quick Watch Section -->
<section class="watch-quick-video page-sec bg-white bg-image-corner" style="background-image: url(<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MW-Head.png);">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center w-full-770">
                <h2 class="heading h-black">Watch The <span class="yellow-text">Quick Video</span> Below To See <span class="yellow-text">MIDI Wizard In Action:</span></h2>
            </div>
            <div class="video-sec">
                <div class="video-sec-wrapper">
                    <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/0snqdvx2gn?videoFoam=true" title="MIDI Wizard Demo Section Full Halloween Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen width="100%" height="100%"></iframe></div></div>                      
                    <!-- <script src="https://fast.wistia.com/embed/medias/0snqdvx2gn.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_0snqdvx2gn videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/0snqdvx2gn/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div> -->
  
                </div>
            </div>
            <div class="actions-btn btn-design text-center p-0">
                <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI Wizard NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
            </div>
        </div>
    </div>                            
</section>
<!-- End Quick Watch Section -->

<!-- Facebook Testimonial -->
<section class="facebook-testimonial first page-sec pt-5">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">                
                <h2 class="heading">What Members Of Our Private Facebook Group Are<br/> Saying...</h2>
            </div>
            <div class="facebook-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-2.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/kyle-stevens.jpg" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/2.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-16.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/5.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-4.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Charlie.jpg" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-19.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-12.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-13.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/1.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-8.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-14.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-FB-Test-6.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
</section>
<!-- End Facebook Testimonial -->

<!-- Generating Perfect Drum Loops Section -->
<section class="generate-drum-loop page-sec bg-dark-purple">
    <div class="container">
        <div class="generate-drum-inner">
            <div class="section-heading text-center mb-5">                
                <h2 class="heading h-black d-none-770">Generating Radio-Worthy Chord Progressions <br>& Melodies Is <span class="yellow-text">As Easy As 1-2-3</span></h2>
                <h2 class="heading h-black d-block-770">Generating Radio-Worthy Chord Progressions & Melodies Is <span class="yellow-text">Easy As 1-2-3</span></h2>
            </div>
            <div class="generate-drum-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="yellow-text">1.</span> Select</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Select your preferred genre, key, style, length & octave.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="generate-drum-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="yellow-text">2.</span> Generate</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Press the button to instantly generate a hit-quality chord progression or melody.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Generate.mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="generate-drum-wrap mb-0">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="yellow-text">3.</span> Drag & Drop</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Drag & drop your new chord progression or melody straight into your project — or export it for later.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
</section>
<!-- End Generating Perfect Drum Loops Section -->

<!-- Drum Monkey Behind The Scenes -->
<section class="with-drum-monkey page-sec behind-scene bg-primary-black">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">                
                <h2 class="heading text-transform-unset">But, Don't Let <span class="yellow-text">MIDI Wizard's</span> Simplicity Fool You... </h2>
                <h3 class="sub-heading mt-2">Here's Everything Going On <span class="purple-text">Behind The Scenes:</span></h3>
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3 class="show_on_desktop">At Unison, It Took Us Over 1.5 Years<br/>To 
                                <span class="yellow-text">Finally Perfect</span> MIDI Wizard
                            </h3>
                            <h3 class="show_on_mobile">At Unison, It Took Us Over 1.5 <br/>Years To 
                                <span class="yellow-text">Finally Perfect</span> MIDI <br/>Wizard
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Discovery-Skinny-.png" class="mw-100" width="225" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>To make it, we obsessively analyzed successful songs <b>in over 30 genres of music</b>.</p>
                                <p>Found the <b>common threads & patterns </b>between them...</p>
                                <p>And <b>started experimenting </b>with different algorithms.</p>
                                <p>At first, the generated chord progressions & melodies <b>sounded terrible.</b></p>
                                <p>But, over time we <b>refined and refined</b> — tweaking the algorithms and making further advancements.</p>
                                <p>And finally, <b>after 5,500+ hours and 1 million dollars of development...</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Discovery-Skinny-.png" class="mw-100" width="375" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider"><span></span></div>
                <div class="row row-reverse">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                                We
                                <span class="yellow-text">Cracked The Code</span> — Coming Up With The *Perfect* Algorithm
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Idea-Skinny-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>It's <b>so complex </b>it would take a full day to explain.</p>
                                <p>But, in plain english...</p>
                                <p>It combines <b>42,000+ proven genre-specific </b>MIDI files modelled off successful songs...</p>
                                
                                <p>With brand new, <b>cutting edge machine learning</b>...</p>
                                <p>And, <b>Unison-exclusive "note-pattern recognition" </b>algorithms...</p>
                                <p>To create <b>genre-specific </b>chord progressions & melodies that actually <b>sound good 93% </b>of the time.</p>
                                <p>We've done all the hard work for you — all you have to do is <b>press the button.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Idea-Skinny-.png" class="mw-100" width="375" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End MIDI Wizard Behind The Scenes-->

<!-- Drum Monkey Powerful Scenes -->
<section class="with-drum-monkey page-sec bg-yellow why-reason">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">                
                <h2 class="heading">10 More Reasons Why <span class="white-text">MIDI Wizard Is So Powerful...</span></h2>
            </div>
            <div class="drum-categories-sec drum-categories-inner mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">1.</span> Genre-Specific
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>The truth is, <b>not all chord progressions & melodies are created equal.</b></p>
                                <p>Each genre has <b>unique frameworks </b>that need to be followed.</p>
                                <p>That's why we spent <b>the last 1.5 years </b>uncovering the secrets behind all these frameworks & packed them into <b>MIDI Wizard's powerful algorithm</b>.</p>
                                <p>So, you can instantly generate chord progressions & melodies in 30 different genres of music that are proven to <b>sound good with consistency</b>.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">2.</span> Or, Invent Your Own
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/3.-Thinking-Centre.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>Why was Old Town road by Lil Nas X <b>so successful?</b></p>
                                <p>Simple. It managed to <b>combine 2 completely different genres </b>into something totally new.</p>
                                <p>To help you exploit this phenomenon, we've specifically created the <b>secret "???" genre </b>which fuses all 30 genres together.</p>
                                <p>So, with <b>MIDI Wizard </b>you can either stick to proven frameworks in each genre, or go wild and invent your own.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI Wizard NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/3.-Thinking-Centre.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">3.</span> The Perfect Algorithm
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/13.-Discovery-Left.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p><b>MIDI Wizard's </b>creation engine is built from 42,000+ <b>proven genre-specific chords & melodies.</b></p>
                                <p>Plus, cutting edge machine learning and <b>Unison-exclusive "note-pattern recognition" </b>algorithms.</p>
                                <p>In plain english, this perfect algorithm <b>reliably exploits </b>the common characteristics of hit chord progressions & melodies in 30 genres.</p>
                                <p>So, you can confidently and instantly generate chord progressions & melodies that <b>actually sound good 93% of the time.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/13.-Discovery-Left.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">4.</span> Built-In Piano Roll
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Grid+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>Although most of the chord progressions & melodies you generate will <b>sound amazing </b>off the bat...</b></p>
                                <p>You might want to tweak some of the notes to <b>customize them </b> to your exact taste.</p>
                                <p>Using <b>MIDI Wizard's </b>fully-loaded, built-in piano roll — you'll be able to <b>edit to your hearts desire.</b></p>
                                <p>Plus, there's scale highlighting to make sure you <b>never use a wrong note</b> again or go through any trial & error.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Grid+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">5.</span> Drag & Drop/Export
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>We've optimized <b>MIDI Wizard</b> for <b>maximum speed</b> and efficiency.</p>
                                <p>So, as soon as you've generated a chord progression or melody that <b>you're loving</b>...</p>
                                <p>Easily drag & drop it straight into your project to <b>use right away</b> — or export it for later.</p>
                                <p>Whether you're getting a song started, finished or stocking up on inspiration, <b>MIDI Wizard's</b> got you covered.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop+(Final).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">6.</span> Use With Any Sound
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/15.-Thumbs-Up-Right.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>No cheap stock sounds here — <b>MIDI Wizard</b> hooks up to <b>all your favorite</b> synth & instrument VSTs.</b></p>
                                <p>So, you can playback your <b>new chord progressions & melodies</b> with the sounds you already love.</p>
                                <p>That means you'll have <b>total freedom & control</b> to swap presets on the fly and try out different synths with no limits.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/15.-Thumbs-Up-Right.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">7.</span> 100% Royalty Free
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/2.-Money-Bags-Left.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>All the money you earn from music you make with <b>MIDI Wizard</b> is <b>yours to keep.</b></p>
                                <p>That's because <b>you own all the MIDI files</b> you generate and can use them in your music however you please.</p>
                                <p>So, <b>if you end up making a hit</b> with millions of plays we'll never ask for a cut of your profits.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/2.-Money-Bags-Left.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">8.</span> No Filler Or Fluff
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/12.-X-Position-Right.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>Other plugins <b>overwhelm</b> you with tons of unnecessary functions.</p>
                                <p>So, instead of getting you <b>caught up in clicking 20 buttons</b> to do what you want...</b></p>
                                <p>We've refined <b>MIDI Wizard</b> to <b>deliver you results</b> in the easiest, fastest and most effective way.</p>
                                <p>Simply choose your key, genre, chord progression/melody and <b>click the button.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/12.-X-Position-Right.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">9.</span> Beginner Friendly
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/15.-Thumbs-Up-Left.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>We've <b>done all the hard work</b> for you already.</p>
                                <p>So, whether you're a beginner, intermediate or advanced — using <b>MIDI Wizard</b> will be a <b>piece of cake</b> for you.</p>
                                <p><b>You don't need to know music theory,</b> have a lot of time to produce or have any advanced technical skills.</p>
                                <p>We've designed <b>MIDI Wizard</b> to be <b>so quick and easy to use,</b> even a kindergartener could do it.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/15.-Thumbs-Up-Left.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.2);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="yellow-text">10.</span> A Blast To Use
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_1_1X1_alpha-no-shadow.gif" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>We believe <b>making music should be fun,</b> so why not the plugins you use too?</p>
                                <p>So, instead of using plugins that look like they are from '02... we invite you to join the <b>next generation</b> of plugins.</p>
                                <p>With the entertaining, randomized animations & engaging UI — you'll <b>never get bored</b> of <b>MIDI Wizard.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_1_1X1_alpha-no-shadow.gif" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>              
                
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey Powerful Scenes-->

<!-- Facebook Testimonial -->
<section class="facebook-testimonial second page-sec pt-5">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center">                
                <h2 class="heading show_on_desktop">Some More Private Facebook Group <br/>Comments...</h2>
                <h2 class="heading show_on_mobile">Some More Private Facebook <br/>Group Comments...</h2>
            </div>
            <div class="facebook-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/8.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/3.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/7.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/11.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/6.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/10.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/9.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/4.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/12.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
</section>
<!-- End Facebook Testimonial -->

<!-- Drum Monkey How Much -->
<section class="with-drum-monkey page-sec bg-primary-black how-much-cost pt-5">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">                
                <h2 class="heading h-white">Ok, So How Much <span class="yellow-text">Does It Cost?</span></h2>
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                                Just To Be Upfront, <br>MIDI Wizard <span class="red-text">Isn't Cheap</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Money-Bags-Skinny-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>So let’s just think about the <b>alternatives </b>you could try...</p>
                                <p>You could get a <b>degree in music theory </b>to make MIDI Wizard's chord progressions & melodies by yourself.</p>
                                <p>But even at a low-tier school that would cost you <b>$19,500 and 4 years </b>of your time. </p>
                                <p>Or, you could buy all the MIDI Chord & Melody Packs on our site for <b>$2,211.</b></p>
                                <p>But they <b>won't be custom-made </b>exclusively for you, be unlimited or give you nearly as much inspiration. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Money-Bags-Skinny-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgba(255, 255, 255, 0.1);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3 class="show_on_desktop">
                            So, Considering The <span class="red-text">2,000+ Hours</span><br>& <span class="red-text">Hundreds Of Thousands</span> Dollars It Costed To Create It...
                            </h3>
                            <h3 class="show_on_mobile">
                            So, Considering The<br/> <span class="red-text">2,000+ Hours</span> & <span class="red-text">Hundreds<br> Of Thousands</span> Dollars<br> It Costed To Create It...
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/3.-Thinking-Centre.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>The power it'll give you to instantly <b>generate radio-worthy</b> chord progressions & melodies...</p>
                                <p>Get infinite <b>inspiration </b>at your fingertips...</p>
                                <p>And absolutely <b>blow the minds </b>of your friends & listeners...</p>
                                <p>The regular price of MIDI Wizard is <b>$497.</b></p>
                                <p>But don't worry.</p>
                                <p>As a special offer — <b>today you won’t pay that.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Thinking-Skinny-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey How Much -->

<!-- Drum Monkey Exclusive Bonuses -->
<section class="with-drum-monkey page-sec bg-dark-purple exclusive-bonus">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-5">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/launch-bonus.png" class="mw-100" alt="" width="900" tabindex="0">
                </figure>
                <h2 class="heading">Plus, Get <span class="yellow-text">4 Free Exclusive Bonuses</span></h2>
                <h3 class="sub-heading mt-2">(When You Choose The <span class="purple-text">Single Pay Option</span>)</h3>
            </div>
            <div class="drum-categories-sec drum-categories-inner mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #1</h4>
                            <h3>
                               Unison Ultimate Keys &amp; Leads Collection
                            </h3>
                            <h5 class="purple-text">($97 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Ultimate-Keys-3D-.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">    
                                <p>When you get <b>MIDI Wizard </b>today, you're going to want <b>high-quality, genre-specific </b>sounds to use it with.</p>
                                <p>So, can use the <b>right sounds for the right purpose.</b></p>
                                <p>Luckily, we've thought that through already and designed the <b>Unison Ultimate Keys & Leads Collection. </b></p>
                                <p>It's complete collection of <b>210 genre-specific</b> key & lead presets for our audience's 5 most-used synths — Serum, Omnisphere, Diva, Massive X & Sylenth1.</p>
                                <p>And, it's<b> specifically designed for MIDI Wizard</b> and not sold anywhere else.</p>
                                <p>All the <b>sounds in the demo audios near the top of the page are included </b>as presets in this collection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Ultimate-Keys-3D-.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #2</h4>
                            <h3>MIDI Wizard Advanced<br> Implementation Training</br></h3>
                            <h5 class="purple-text">($147 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Advanced-Implementation-3D-.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p><b>Beyond what you already know </b>about<b> MIDI Wizard...</b></p>
                                <p>There's some<b> secret uses</b> that would simply be too powerful to reveal to everyone.</p>
                                <p>In the <b> MIDI Wizard Advanced Implementation Training,</b> Unison co-founder and producer with 30+ million plays Sep...</p>
                                <p>Will be demonstrating in real time how to use</b> MIDI Wizard <b>to</b> <b> easily make pro-sounding songs</b> in several genres. </p> 
                                <p>Also, he'll show you<b> 3 special ways</b> you can use<b> MIDI Wizard </b>(one of them can make producers a lot of money.)</p>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Advanced-Implementation-3D-.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #3</h4>
                            <h3>Unison MIDI Manipulation Masterclass</h3>
                            <h5 class="purple-text">($197 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/MIDI-Manipulation-3D-.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">                                    
                                <p>In this exclusive, in-depth masterclass, Sep will share his years of experience on <b> unique strategies of manipulating MIDI.</b></p>
                                <p>Using what you'll learn in this masterclass, you'll be able to<b> make the most of the MIDI files you generate</b>using<b> MIDI Wizard.</b></p>
                                <p>Plus, you'll be able to <b> make your music sound infinitely more professional and take your MIDI game to the next level</b> by using the specific tricks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/MIDI-Manipulation-3D-.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #4</h4>
                            <h3>MIDI Wizard Private Facebook Group Access</h3>
                            <h5 class="purple-text">($247 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Facebook-Group-3D-.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>When you get<b> MIDI Wizard, </b>you'll be <b>joining a private Facebook community</b> of motivated and ambitious producers just like you.</p>
                                <p>In this group, <b>you'll be able to:</b> </p>
                                <p>• Ask <b>production related questions </b>& share ideas with each other
                                <br>• Get <b>specific feedback </b>on songs you're working on
                                <br>• Find potential <b>collaborations </b>
                                <br>• Share contacts / <b>build your network</b>
                                <br>• And have a <b>supportive community </b>who truly wants to see you succeed
                                <p>This group brings everything together to create a <b>complete package of everything you could possibly need to succeed </b>as a producer.</p>
                                </p>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/midi-wizard/Facebook-Group-3D-.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey Exclusive Bonuses -->

<!-- Time Essence -->
<section class="time-essence page-sec">  
    <div class="container">
        <div class="time-essence-inner">
            <div class="section-heading text-center">
                <h2 class="heading">Time Is Of The Essence.</h2>
                <figure class="mt-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Running-Clock.png" class="mw-100" alt="" width="250" tabindex="0">
                </figure>
                <h3 class="sub-heading mt-2">The Huge $150 Discount & 4 Exclusive Bonuses<br/> Are Only Available For A Very Limited Time.</h3>
            </div>
            <div class="content-wrap width-sm-100">
                <p>So, if this page is <b>still online...</b></p>
				<p>It means that there is <b>still some time left...</b></p>
				<p>But, if you <b>come back later...</b></p>
				<p>This rare deal could <b>already be over.</b></p>
				<p><b>Don’t sleep on this opportunity — </b>then suffer a hit of regret every time some other song outperforms yours and steals all your plays.</p>
				<p>Instead, choose your preferred payment option below and <b>secure your very own license now.</b></p>
            </div>
        </div>
    </div>
</section>
<!-- End Time Essence -->

<!-- Payment Options -->
<section class="payment-options page-sec" id="scroll-Yes">
    <div class="container">
        <div class="payment-options-inner">
            <div class="section-heading text-center">
                <h2 class="heading mb-5">Select One Of The Payment Options Below Now:</h2>
            </div>
            <div class="row">
                <div class="col-md-6 left">
                    <div class="column-inner h-100">
                        <div class="title-box text-center">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wizard-final-box-sized-cropped.png" class="mw-100" width="130">
                            </div>
                            <h3>Rent-To-Own</h3>
                            <h4><span class="white-text">Here's What You'll Get:</span></h4>
                        </div>
                        <div class="payment-wrap left">
                            <div class="category-content">
                                <ul class="list-point">
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> MIDI Wizard License + Lifetime Updates <span class="yellow-text">($497 Value)</span>
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Instantly Generate Hit-Worthy Chord Progressions & Melodies In 30 Genres
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Get Infinite Inspiration On Demand
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Built-In Piano Roll
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Use With Any Sounds
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drag & Drop Or Export For Later
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Works With Both Mac, PC & All Major DAWs
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 60-Day Money-Back Guarantee
                                    </li>                                    
                                </ul>
                            </div>                            
                        </div>
                        <div class="payment-price text-center">
                            <h4 class="white-text">Total Value:</h4>
                            <h3 class="red-text">$497</h3>
                            <h4 class="yellow-text mt-3 mb-1">Today Only:</h4>
                            <h3><span><del>$19.99</del></span> $9.99 <span class="h3 small"> then $19.99 x 21 months</span></h3>
                        </div>
                        <div class="actions-btn btn-design text-center p-0 my-3">
                            <a href="https://app.unison.audio/cart/add/G-73-51-81?promo=s7r8c1r5t0" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">Rent-To-Own | Pause Or Cancel Anytime</span></a>
                        </div>
                        <p class="money-back">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</p>
                        <div class="payment-methd text-center mt-2">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/credit-paypal.png" class="mw-100" alt="" width="250" tabindex="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="column-inner bg-white h-100">
                        <div class="title-box text-center">
                            <div class="img-box">                                
                                <?php if(wp_is_mobile()){
                                    ?>
                                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MW-Bonuses-Mobile-.png" class="mw-100" width="150">                                    
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MW-Bonuses.png" class="mw-100" width="380">
                                    <?php
                                }?>
                            </div>
                            <h3><span class="yellow-text">1 Single Payment (Save $80)</span></h3>
                            <h4><span class="black-text">Here's What You'll Get:</span></h4>
                        </div>
                        <div class="payment-wrap right">
                            <div class="category-content">
                                <ul class="list-point">
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> MIDI Wizard License + Lifetime Updates <span class="yellow-text-light">($497 Value)</span>
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Instantly Generate Hit-Worthy Chord Progressions & Melodies In 30 Genres
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Get Infinite Inspiration On Demand
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Built-In Piano Roll
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Use With Any Sounds
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drag & Drop Or Export For Later
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Works With Both Mac, PC & All Major DAWs
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 60-Day Money-Back Guarantee
                                    </li>                                    
                                    <li><i contenteditable="false" class="fa fa-fw fa-plus"></i> 4 Free Exclusive Bonuses <span class="yellow-text-light">($688 Value)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-price text-center">
                            <h4 class="black-text">Total Value:</h4>
                            <h3 class="red-text">$1,185</h3>
                            <h4 class="yellow-text mt-3 mb-1">Today Only:</h4>
                            <h3 class="black-text">1 Single Payment Of <span><del>$497</del></span> $347</h3>
                        </div>
                        <div class="actions-btn btn-design text-center p-0 my-3">
                            <a href="https://unison.audio/mw-special-777-order-secure" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">For $150 Off + 4 Free Bonuses</span></a>
                        </div>
                        <p class="money-back">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</p>
                        <div class="payment-methd text-center mt-2">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/credit-paypal.png" class="mw-100" alt="" width="250" tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Payment Options -->

<!-- client testimonials -->
<section class="wizard-testimonials bg-primary-gray">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">    
            <h2 class="heading">What Other Producers Are Saying...</h2>
            </div>
            <div class="wizard testimonial-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                                
                                <div class="text-center">
                                    <img src="https://dev.unison.audio/wp-content/themes/unison-vrrb/images/midi-wizard/dominick-profile-2.jpg" class="mw-100" alt="" tabindex="0">
                                    <div class="ne elHeadline hsSize1 lh5 elMargin0 elBGStyle0 hsTextShadow0 mfs_17 lh3" data-bold="inherit" style="text-align: center; color: rgb(255, 255, 255); font-size: 18px;" data-gramm="false" contenteditable="false"><i>"I would hit a brick wall when writing music, and struggle to find decent chords for a bridge or a catchy hook melody. I really appreciate MIDI Wizard and how it not only suggests brilliant chord combinations depending on the selected genre, it also casts tasteful melodies that instantly fit in my songs. I would say go for this plugin if you want to speed up your workflow tenfold and put a spell on any writer's block you have. This thing works great. Thanks Unison!”</i></div>
                                    <h3>Dominick Wolczko</h3>
                                    <span class="yellow-text">Producer from Vashon, USA</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                                
                                <div class="text-center">
                                    <img src="https://dev.unison.audio/wp-content/themes/unison-vrrb/images/midi-wizard/Niklas-profile.jpg" class="mw-100" alt="" tabindex="0">
                                    <div class="ne elHeadline hsSize1 lh5 elMargin0 elBGStyle0 hsTextShadow0 mfs_17 lh3" data-bold="inherit" style="text-align: center; color: rgb(255, 255, 255); font-size: 18px;" data-gramm="false" contenteditable="false"><i>“In my latest production I got stuck due to lack of inspiration. I had a groovy beat and a funky bassline but needed a nice chord progression and melody for my favorite synth. MIDI Wizard came to my immediate rescue. Just a few clicks and I found what I was looking for. I can really recommend this software as a deep source for ideas and inspiration.”</i></div>
                                    <h3>Niklas Nyqvist</h3>
                                    <span class="yellow-text">Producer from Vasa, Finland</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                                
                                <div class="text-center">
                                    <img src="https://dev.unison.audio/wp-content/themes/unison-vrrb/images/midi-wizard/dave-profile.jpg" class="mw-100" alt="" tabindex="0">
                                    <div class="ne elHeadline hsSize1 lh5 elMargin0 elBGStyle0 hsTextShadow0 mfs_17 lh3" data-bold="inherit" style="text-align: center; color: rgb(255, 255, 255); font-size: 18px;" data-gramm="false" contenteditable="false"><i>"My biggest challenge producing music has always been the fact that I cannot read or write music. When it comes to producing, music theory has always been something that held me back but not anymore with the Unison MIDI Wizard since I can tell it what key my song is in and get instant chord progressions and melodies and go from there, I’ve been finishing songs a lot easier with the Unison MIDI Wizard as well, plus it’s really easy and fun to use.”</i></div>
                                    <h3>Dave Turgeon</h3>
                                    <span class="yellow-text">Producer from Orlando, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- client testimonials end -->

<!-- Fully Protected -->
<section class="fully-protected page-sec bg-light-purple">
    <div class="container">
        <div class="fully-protected-inner">
            <div class="section-heading text-center">
                <h2 class="heading h-white">Plus, You're Fully Protected By Our <br/>
                60-Day 100% Money-Back Guarantee</h2>
                <figure class="mt-3 mb-3">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Money-Back-Wizard.png" class="mw-100" alt="" width="400" tabindex="0">
                </figure>                
            </div>
            <div class="content-wrap width-sm-100">
                <h3 class="mb-3 text-center">After Getting MIDI Wizard Today, You Can Try It Out For A <span class="yellow-text">Full 60 Days.</span></h3>
                <p>Use it to make <b>tons of radio-worthy</b> chord progressions & melodies...</p>
                <p>Get <b>inspiration</b> & finish more music...</p>
                <p>And then, if you’re not <b>absolutely blown away </b> with your results...</p>
                <p>Just <b>email our support team </b>at support@unison.audio.</p>
                <p>We'll <b>happily refund you every cent</b> and make your license available to someone else.</p>
                <p><b>No questions asked. </b>No weirdness. No hard feelings.</p>
                <p>Plus, you can <b>keep all the bonuses</b> absolutely free.</p>
                <p>You have <b>nothing to lose</b> and everything to gain.</p>
            </div>
            <div class="actions-btn btn-design text-center p-0 pt-2 mt-4">
                <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">60-Day Money-Back Guarantee</span></a>
            </div>
        </div>
    </div>
</section>
<!-- End Fully Protected -->

<!-- What Other Producers Are Saying -->
<section class="more-testimonials">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">    
            <h2 class="heading">What Other Producers Are Saying...</h2>
            </div>
            <div class="testimonial-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                                
                                <div class="text-center">
                                    <script src="https://fast.wistia.com/embed/medias/370dadiu5h.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><span class="wistia_embed wistia_async_370dadiu5h popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span></div></div>
                                    <h3>Carlo Pappano</h3>
                                    <span class="yellow-text">Producer from Newport Beach, USA</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                                
                                <div class="text-center">
                                    <script src="https://fast.wistia.com/embed/medias/91iopakbl8.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><span class="wistia_embed wistia_async_91iopakbl8 popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span></div></div>
                                    <h3>Dominick Wolczko</h3>
                                    <span class="yellow-text">Producer from Vashon, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">                            
                                <div class="text-center">
                                    <script src="https://fast.wistia.com/embed/medias/re5cyecq7w.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><span class="wistia_embed wistia_async_re5cyecq7w popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span></div></div>
                                    <h3>Sean Vasey</h3>
                                    <span class="yellow-text">Producer from West Des Moines, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions-btn btn-design text-center p-0 pt-2 mt-4">
                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">60-Day Money-Back Guarantee</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- What Other Producers Are Saying End -->

<!-- Are You Ready? -->
<section class="with-drum-monkey page-sec bg-primary-black are-you-ready pt-5">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">                
                <h2 class="heading">Are You <span class="yellow-text">Ready?</span></h2>                
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100 are-you-ready">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>If You <span class="yellow-text">Want</span> To:</h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/11.-Strong-Proud-Right.png" class="mw-100" width="250" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <ul class="list-point">
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i>Make <span class="yellow-text">hit songs</span> using radio-worthy chords & progressions
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i>Consistently <span class="yellow-text">finish more music</span> than you ever thought possible
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i>Make music you can <span class="yellow-text">actually be proud of</span>
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i>Make a significant <span class="yellow-text">positive impact</span> on people with your music
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i>Potentially even make a <span class="yellow-text">full-time career</span> out of music production...
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Strong-Skinny-Left.png" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                                MIDI Wizard Is <span class="yellow-text">For You</span> —<br/>
                               And All That's Left To Do Is...
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/15.-Thumbs-Up-Right.png"  class="mw-100" width="250" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>1. <span class="yellow-text">Click </span>the "Get MIDI Wizard Now" button below.</p>
                                <p>2. <span class="yellow-text">Select </span>your preferred payment option.</p>
                                <p>3. <span class="yellow-text">Complete your order </span>on the next page.</p>
                                <p>4. <span class="yellow-text">Instantly get emailed </span> your MIDI Wizard license.</p>
                                <p>5. <span class="yellow-text">Download</span> the installer and activate your copy.</p>
                                <p>And just like that, you'll be <span class="yellow-text">off to the races.</span></p>
                                <p>Ready to <span class="yellow-text">instantly generate radio-quality </span>chord progressions & melodies — While getting loads of inspiration.</p>
                                <p>Starting <span class="yellow-text">just a few minutes </span>from now...</p>
                                <p>The <span class="yellow-text">decision is yours.</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Thumbs-Up-Skinny-.png" width="350" alt="" tabindex="0"></figure>y
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions-btn btn-design text-center">
                            <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">60-Day Money-Back Guarantee</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Are You Ready? -->

<!-- FAQ -->
<section class="faq-sec page-sec bg-white bg-image-corner" style="background-image: url(<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MW-Head.png);">
    <div class="container">
        <div class="faq-sec-inner">
            <div class="section-heading text-center">
                <h2 class="heading h-black">Frequently Asked Questions...</h2>            
            </div>
            <div class="accordion custom-accordion width-sm-100" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="heading-1">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                                <span class="white-text">1.</span> How will MIDI Wizard be delivered to me and how quickly?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-1" class="collapse" aria-labelledby="heading-1">
                        <div class="card-body">
                            <p>Your installer download link, Activation Code and bonus download links will be <b>sent to your email address and enabled in your Unison account immediately after your purchase.</b> The private Facebook group link will also be sent to your email and mentioned in your account.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-2">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                <span class="white-text">2.</span> Do I get lifetime access to everything?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2">
                        <div class="card-body">
                            <p>Yes, when you get MIDI Wizard today, <b>you'll get 100% lifetime access to everything.</b> Plus, you'll get all future MIDI Wizard updates for free. That means you won't have to pay extra for new genres we may add or other new features..</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-3">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                <span class="white-text">3.</span> What DAWs is MIDI Wizard compatible with?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-3" class="collapse" aria-labelledby="heading-3">
                        <div class="card-body">
                            <p>MIDI Wizard is compatible with <b>Ableton Live, FL Studio, Logic Pro, Pro Tools, Studio One, Cubase, Reason, Reaper, Cakewalk, Mixcraft & Bitwig Studio on both Mac & PC.</b> Other DAWs are not supported as they do not have MIDI routing capability. Please do not purchase MIDI Wizard unless you use one of the DAW's listed.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-4">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                <span class="white-text">4.</span> How does authorization work for MIDI Wizard?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4">
                        <div class="card-body">
                            <p>After completing your order, you'll get installer downloads for both Mac & PC, as well as an Activation Code. <b>All you need to do is run the installer, open up your DAW, load up MIDI Wizard, click "Activate", enter in your Activation Code and you're good to go. The whole process takes less than 60 seconds. </b>You can authorize MIDI Wizard with your single Activation Code on <b>up to 2 machines you own simultaneously.</b></p>
                            <br/>
                            <p>Plus, MIDI Wizard is <b>protected by PACE Fusion Technology</b> which is the most secure license management method available. That means <b>the plugin code is protected at the highest level</b> and all producers who purchase can have peace of mind that their investment is protected and rock-solid.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-5">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                <span class="white-text">5.</span> Are the chord progressions & melodies I generate royalty free?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-5" class="collapse" aria-labelledby="heading-5">
                        <div class="card-body">
                            <p><b>Yes, any MIDI files you generate with MIDI Wizard are yours to own, 100% royalty free & cleared for commercial use. </b> You can use them in your music however you want and all the money you earn from music created with MIDI Wizard is yours for the keeping.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-6">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                <span class="white-text">6.</span> Will MIDI Wizard be difficult to use?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-6" class="collapse" aria-labelledby="heading-6">
                        <div class="card-body">
                            <p>MIDI Wizard is <b>super simple and easy to use. </b>Whether you're a <b>beginner, intermediate or advancedb </b>we've taken the hard work out of it for you and set you up for <b>instant results.</b>Just install the plugin, choose your key/genre/length and<b>click the generate button. </b>From there you can customize everything if you'd like, <b>drag & drop into your project and have fun finishing & releasing hit songs.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-7">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                                <span class="white-text">7.</span> Does it matter what genre I produce?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-7" class="collapse" aria-labelledby="heading-7">
                        <div class="card-body">
                            <p><b>MIDI Wizard generates hit-worthy chord progressions & melodies in the 30 major genres of music. </b>So whether you're into producing <b>hip hop beats, house, R&B, pop, ambient, Lo-Fi, future bass, funk, jazz, classical, rock or anything else, you're good. </b>Plus you get the <b>unfair advantage over normal producers </b>from being able to use elements from different genres you wouldn't normally think of to <b> make your music unique and stand out.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-8">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                <span class="white-text">8.</span> Is using the MIDI Wizard cheating?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-8" class="collapse" aria-labelledby="heading-8">
                        <div class="card-body">
                            <p>Considering that the <b>best producers in the world work smart, not hard... </b>Any producer that thinks using this game-changing plugin is cheating likely has no impressive results to show for themselves. <b>So, using MIDI Wizard is the biggest step you can take to save time and get massive results instantly. </b>Producers who don't jump on board will get left behind and will be at a huge disadvantage.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-9">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-9" aria-expanded="false" aria-controls="collapse-9">
                                <span class="white-text">9.</span> What payment options are there?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-9" class="collapse" aria-labelledby="heading-9">
                        <div class="card-body">
							<p>We securely accept payments through <b>all major credit cards and PayPal.</b> You can pay for MIDI Wizard with <b>one single payment or rent-to-own after</b> you click the button below and go to the next page. Your information is safe and secure and we respect your privacy.</p><br/>
                            <p>Although you <b>save an additional $80 with the single-pay option, </b>if you choose rent-to-own, you pay only $9.99 today, followed by 21 monthly payments of $19.99, totalling $429.78. If at any point a payment fails, your license will be paused and MIDI Wizard will stop functioning until the payment goes through. You can also <b>pause, cancel or pay off your rent-to-own plan yourself with 1 click</b> from your account.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-10">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-10" aria-expanded="false" aria-controls="collapse-10">
                                <span class="white-text">10.</span> What if I'm unsatisfied with MIDI Wizard?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-10" class="collapse" aria-labelledby="heading-10">
                        <div class="card-body">
                            <p>MIDI Wizard comes with a <b>60 Day, 100% Money Back Guarantee. </b>That means if you change your mind about this decision at any point in the next 2 months – all you need to do is email us at support@unison.audio and we’ll refund your purchase. No questions asked. No weirdness. No hard feelings. Plus, you can keep all the bonuses absolutely free. <b>You have nothing to lose and everything to gain.</b></p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row center-img">
                <div class="col-md-12">
                    <figure class="mb-0 text-center">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/MIDI-Wiz_Hit_1_1X1_alpha-no-shadow.gif" class="mw-100" alt="" tabindex="0">
                    </figure>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions-btn btn-design text-center pb-2 pt-0">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET MIDI WIZARD NOW</span><span class="elButtonSub">60-Day Money-Back Guarantee</span></a>
                    </div>
                    <span class="d-block text-center" style="font-size:12px;font-weight:500;">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="logo-image text-center mt-4">
                        <div class="d-none-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/Daw-Icons-with-bitwig.png" class="mw-100" alt="" width="800" tabindex="0">
                        </div>                    
                        <div class="d-block-770 mobile-img">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/midi-wizard/DAW-Icons-Mobile-2.png" class="mw-100" alt="" width="280" tabindex="0">
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ -->

<script>
    $(document).ready(function(){
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
            //>=, not <=
            if (scroll >= 10) {
                $(".sticky-bar").addClass("fixed-bar");
            } else {
                $(".sticky-bar").removeClass("fixed-bar");
            }
        });
});
</script>

<?php
get_footer(); ?>