<?php
/*
 * Template Name: Drum Monkey V2
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
}
.bg-secondary-black {
    background-color: rgb(37, 37, 37) !important;
}
.bg-white {
    background-color: rgb(255, 255, 255) !important;
}
.bg-yellow {
    background: var(--yellow-color);
}
.bg-red {
    background: rgb(234, 78, 59);
}
.yellow-text {
    color: var(--yellow-color);
}
.red-text {
    color: rgb(236, 60, 23);
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
    color: var(--yellow-color);
    font-weight: 500;
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
    background: var(--gray-color);
}

/* Get Drum Monkey */
.get-drum-monkey {
    padding-top: 30px;
    padding-bottom: 20px;
    outline: none;
    background: rgb(29, 29, 29);
    background-repeat: no-repeat;
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
    color: var(--yellow-color);
}
.get-drum-monkey ul.list-point {
    padding: 0px 20px;
}
.get-drum-monkey ul.list-point li {
    font-size: 20px;
    padding-left: 2em;
    margin-bottom: 12px;
    color: rgb(255, 255, 255);
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
}
/* End Get Drum Monkey */

/* Introducing Drum Monkey */
.introducing-drum-monkey .heading-sec .hdng {
    color: var(--black-color);
    font-size: 28px;
    margin-bottom: 15px !important;
}
.video-wrapper{
    width: 77% !important;
    margin-left: auto !important;
    margin-right: auto !important;
}
.introducing-drum-monkey .introducing-video-sec {
    /* max-width: 825px; */
    width: 100%;
    margin: 35px auto 0;
}
.introducing-drum-monkey .introducing-video-sec video {
    -webkit-box-shadow: -2px 0px 20px 0px rgba(0, 0, 0, 0.37);
    box-shadow: -2px 0px 20px 0px rgba(0, 0, 0, 0.37);
}
.introducing-drum-monkey .introducing-content {
    margin-top: 45px;
    font-size: 30px;
    color: var(--black-color);
    line-height: 1.2;
    font-weight: 600;
}
.introducing-drum-monkey .introducing-content b {
    color: var(--red-color);
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
    background: var(--gray-color);
    border-radius: 5px;
    padding: 30px;
}
.bg-red.with-drum-monkey .drum-categories-sec .drum-category-content,
.bg-yellow.with-drum-monkey .drum-categories-sec .drum-category-content {
    background: rgb(255, 255, 255);
}
.with-drum-monkey .drum-categories-sec .drum-category-image {
    background: #1f1f1f;
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
    background-color: rgb(251, 241, 134);
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
    color: var(--yellow-color);
    font-weight: 500;
}
.bg-red.with-drum-monkey .category-content p b,
.bg-yellow.with-drum-monkey .category-content p b {
    color: rgb(236, 60, 23);
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
    box-shadow: 0px 4px 22px 0px rgb(250 82 82 / 55%) !important;
    border-radius: 5px;
    color: rgb(255, 255, 255);
    font-weight: 600;
    background-color: rgb(249, 48, 3);
    font-size: 28px;
}
.btn-design a.elButton:hover {
    background-color: #f90303 !important;
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
    background-color: rgb(32, 32, 32);
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
    background-color: #fb3932 !important;
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
    padding: 29px 60px 160px;
    background-color: rgb(251, 240, 107);
    margin-top: 0px;
    width: auto;
    margin-left: 0px;
    margin-right: 0px;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.generate-drum-wrap .content-box .title-wrapper {
    margin-top: 125px;
}
.generate-drum-wrap .content-box .title-wrapper h3 {
    font-size: 32px;
    color: rgb(64, 64, 64);
    line-height: 1.2em;
    padding: 5px;
}
.generate-drum-wrap .content-box .des-wrapper p {
    font-size: 20px;
    color: rgb(64, 64, 64);
    line-height: 1.3em;
    font-weight: 400;
}
.generate-drum-wrap .video-box {
    -webkit-box-shadow: -2px 0px 20px 0px rgb(0 0 0 / 37%);
    box-shadow: -2px 0px 20px 0px rgb(0 0 0 / 37%);
    margin: 0px 10px;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Time Essence */
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
    color: rgb(250, 235, 57);
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
    background: #878787;
    margin-bottom: 40px;
}
.payment-wrap.right {
    background: #242424;
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
    color: rgb(250, 235, 57);
    margin-left: -2em;
}
.payment-options-inner span.h3.small {
    font-size: 75%;
    color: #242424;
}
.payment-options-inner .column-inner {
    padding: 25px 20px 30px;
    background-color: rgb(233, 233, 233);
    -webkit-box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
    -moz-box-shadow: 0 1px 5px rgba(0,0,0,0.2);
    box-shadow: 0 1px 5px rgb(0 0 0 / 20%);
    border-radius: 5px;
}
.payment-options-inner .column-inner.bg-yellow {
    background: var(--yellow-color);
}
.payment-options-inner .column-inner .title-box h3,
.payment-options-inner .column-inner .title-box h4 {
    text-align: center;
    font-size: 28px;
    color: rgb(36, 36, 36);
    line-height: 1.2em;
    padding: 5px 0px;
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
    color: rgb(236, 60, 23);
    line-height: 1.2em;
    margin-top: 0.5rem !important;
}
.payment-options-inner .payment-price h3 {
    font-size: 24px;
    color: rgb(36, 36, 36);
    line-height: 1.2em;
}
.payment-options-inner .payment-price h3 span {
    color: rgb(209, 72, 65);
}
.payment-options-inner .money-back {
    text-align: center;
    color: rgb(36, 36, 36);
    font-size: 12px;
    line-height: 1.3em;
    font-weight: 500;
}
.payment-options .btn-design a.elButton {
    display: block;
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
    color: rgb(236, 60, 23);
    font-weight: 500;
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
    color: rgb(250, 235, 57);
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
    background: #fb3932;
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
.facebook-testimonial {
    background-image: linear-gradient(#3b5a97, #2b3d5e);
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
section.faq-sec img {
    opacity: inherit;
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
        background-size: cover !important;
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
    .introducing-drum-monkey .heading-sec img {
        width: 290px;
    }
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
    /*header {
        margin-top: 42px;
    }*/
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

<!-- <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script> -->

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
<section class="get-drum-monkey page-sec bgCover100" style="background-image:url(<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Banana-Background-Reduced-.png); ">
    <div class="container">
        <div class="get-drum-monkey-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                        <h1 class="heading d-none-770">
                            "The <strong>New Way</strong> To Produce Addictive Tracks <br />
                            <u>In 30 Genres</u> &amp; Get <u>Infinite Inspiration</u>"
                        </h1>
                        <h1 class="heading d-block-770">
                            "The <strong>New Way</strong> To <br/>Produce Addictive<br/> Tracks
                            <u>In 30 Genres</u> &amp;<br/> Get <u>Infinite Inspiration</u>"
                        </h1>
                    </div>
                    <div class="video-sec">
                        <div class="video-sec-wrapper">
                            <?php if(wp_is_mobile()){
                                ?>
                                <div class="wistia_responsive_padding" style="background-image:url(<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/drum-monkey-top-bg.webp);background-size: contain;padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/t3pk9w1c5f?videoFoam=true" title="Unison Drum Monkey Video Final BF" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="100%" height="100%"></iframe></div></div>
                                <?php
                            }else{
                                ?>
                                <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/t3pk9w1c5f?videoFoam=true" title="Unison Drum Monkey Video Final BF" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="100%" height="100%"></iframe></div></div>
                                <?php
                            } ?>
                            
                            <!-- <script src="https://fast.wistia.com/embed/medias/t3pk9w1c5f.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_t3pk9w1c5f videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/t3pk9w1c5f/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-point">
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Instantly Generate Unlimited, Perfect</b>&nbsp;<b>Drum Loops</b> in 30 genres of music
                        </li>
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Create Addictive Tracks&nbsp;</b>by generating proven, professional-quality drum loops on demand
                        </li>
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Master Your Workflow &amp; Creative Process</b> to finish double the music in half the time<br>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-point">
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Have Infinite Inspiration At Your Fingertips</b> so you never run into a creative block again
                        </li>
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Push Your Music Beyond Human Limits </b>by accessing the power of cutting edge algorithms
                        </li>
                        <li>
                            <i contenteditable="false" class="fa fa-fw fa-check"></i><b>Gain A Huge Unfair Competitive Advantage</b> so you can finally get the plays you deserve
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="actions-btn">
                        <a href="https://unison.audio/drum-monkey-order-secure" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" style="color: rgb(255, 255, 255); font-weight: 600; background-color: rgb(249, 48, 3); font-size: 27px;" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                    </div> -->
                    <div class="actions-btn btn-design text-center">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="supported-daws text-center">
                        <h3 class="hdng">Supported DAWs:</h3>
                        <div class="supported-logos d-none-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Daw-Icons-with-bitwig.png" class="mw-100" alt="" width="800" tabindex="0">
                        </div>
                        <div class="supported-logos d-block-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/DAW-Icons-Mobile-2.png" class="mw-100" alt="" width="280" tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- End Get Drum Monkey -->

<!-- Introducing Drum Monkey -->
<section class="bg-yellow page-sec introducing-drum-monkey">
    <div class="container">
        <div class="introducing-drum-monkey-inner text-center">
            <div class="heading-sec">
                <h3 class="hdng">Introducing:</h3>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Monkey-Logo.png" class="mw-100" alt="" width="450" tabindex="0">
            </div>
            <div class="video-wrapper">
                <div class="introducing-video-sec">
                    <video width="100%" autoplay="" loop="" muted="" playsinline="" src="https://dnnp2imjk0usi.cloudfront.net/Landing+Page+ScreenCaps/Top+Section/Top+Section+(Full+Screen).mp4"></video>
                </div>
            </div>
            <div class="introducing-content d-none-700">
                The <b>World's First</b> (And Only) Drum Loop Generator That's<div><b>Genre-Specific</b> &amp; Actually Sounds Good <b>93% Of The Time</b> </div>
            </div>
            <div class="introducing-content d-block-700">
                The <b>World's First</b> (And Only) Drum Loop Generator That's <b>Genre-Specific</b> &amp; Actually Sounds Good <b>93% Of The Time</b>
            </div>
        </div>
    </div>
</section> <!-- End Introducing Drum Monkey -->

<!-- With Drum Monkey -->
<section class="with-drum-monkey page-sec bg-primary-black to-be-able pt-4">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-4 pt-2">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Explosion.png" class="elIMG ximg imgRoundCorners noborder imgOpacity1" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading">With Drum Monkey <span class="yellow-text">You'll Be Able To...</span></h2>
            </div>
            <div class="drum-categories-sec mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                Instantly Generate<br/>
                                <span class="yellow-text">Perfect Drum Loops</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0" style="margin-top:-45px;"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Explosion+1+GIF+(Black).gif" class="mw-100" width="375" alt="" tabindex="0"></figure>
                                <figure class="mb-0" style="margin-top:-70px;"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Grid-Image.png" class="mw-100" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>Drum loops are <b>the foundation</b> for any hit song.</p>
                                <p>That's why <b>Billboard #1</b> <b>songs</b> like 'Blinding Lights' by The Weeknd, 'Mood' by 24kGoldn ft. iann dior Or 'Smells Like Teen Spirit' by Nirvana....</p>
                                <p>Have drum loops that<b> 'hook you in'</b> and make you <b>listen on repeat.</b></p>
                                <p>With <b>Drum Monkey</b>, you'll be able to amaze your listeners with <b>custom-generated</b>, perfect drum loops.</p>
                                <p>From basic, to complex to insanely advanced — you'll have <b>unlimited possibilities</b> at your fingertips.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Explosion+1+GIF+(Black).gif" class="mw-100" alt="" tabindex="0"></figure>
                            <figure class="mb-0 mt-4 figure-2"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Grid-Image.png" class="mw-100" alt="" tabindex="0"></figure>
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
                                Make Your Tracks<br/>
                                <span class="yellow-text">Addictive</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Explosion+2+GIF+(Black).gif" class="mw-100" width="375" alt=""  tabindex="0"></figure>
                            </div>
                            <div class="category-content mt-sm-0">
                                <p>Your song's drum loop can be the <b>determining factor</b> for whether a listener will skip it or play it on repeat.</p>
                                <p>In order for your drum loops to be <b>professional-quality...</b> They need to <b>use the right elements</b>, be <b>relatable</b>, have <b>hard-hitting power </b>among other things.</p>
                                <p>With <b>Drum Monkey</b>, you'll be able to <b>hook your listeners</b> with custom generated drum loops that follow <b>proven patterns from hit songs</b> and have all <b>these criteria built-in.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Explosion+2+GIF+(Black).gif" class="mw-100" alt="" tabindex="0"></figure>
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
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Idea-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>If you've ever <b>hit a brick wall</b> half way into a song, you know how frustrating producer's block is.</p>
                                <p>With <b>Drum Monkey</b>, you'll be able to randomly <b>generate unlimited</b> pro-quality drum loops instantly...</p>
                                <p>So, you can <b>never run out of ideas</b>, deal with producer's block, or aimlessly stare at a blank DAW again.</p>
                                <p>And, you'll get the inspiration you need to<b> complete your unfinished projects</b> so you can finally release them.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Idea-750x750-.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
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
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Diving-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>If you want to achieve any level of success as a producer, <b>consistently finishing music</b> is essential.</p>
                                <p>That's because without finishing music, you won't be able to <b>master the entire production process</b> or actually get your music out to the world.</p>
                                <p>With <b>Drum Monkey</b> you'll have the ability to <b>generate the groundwork</b> for your songs in seconds to maximize your output.</p>
                                <p>Say goodbye to spending hours tweaking your drum elements and <b>start working smart</b> to finish music lighting-fast.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Diving-750x750-.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
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
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Infinite-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>With <b>over 305,802 producers</b> downloading a DAW every single day... competition is at an <b>all time high in 2021</b>&nbsp;— making it tough to break through.</p>
                                <p>With <b>Drum Monkey</b>, you'll have the <b>unique ability</b> to instantly generate addictive drum loops.</p>
                                <p>So, you can get miles ahead of other producers and gain a <b>massive competitive edge</b> and be set up for success.</p>
                                <p>Even producers with years of experience and expensive studio gear won't be able to keep up with your <b>insane output</b>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Infinite-750x750-.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
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
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Billboard-750x750-.png" class="mw-100" width="225" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>In today's busy world, people's <b>attention spans are shorter</b> than ever before.</p>
                                <p>If you want to get any recognition in 2021, your music needs to <b>impact people on a primal level</b> to hook them.</p>
                                <p>With <b>Drum Monkey</b>, you'll be able to <b>instantly generate</b> perfect drum loops on demand.</p>
                                <p>So, instead of your friends &amp; family talking over your demos, they'll be begging to <b>hear more of your music.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Billboard-750x750-.png" class="mw-100" alt="" width="350" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End With Drum Monkey -->

<!-- Drum Loops Section -->
<section class="drum-loop-wrap page-sec bg-secondary-black instantly-generate">
    <div class="container">
        <div class="drum-loop-inner">
            <div class="section-heading text-center">
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Explosion.png" class="elIMG ximg imgRoundCorners" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading d-none-770">Instantly Generate Perfect Drum Loops <br>In <span class="yellow-text">30 Different Genres</span></h2>
                <h2 class="heading d-block-770">Instantly Generate <br>Perfect Drum Loops In <br><span class="yellow-text">30 Different Genres</span></h2>
                <h3 class="sub-heading mt-2">All The Demos Below Were Generated By <span class="red-text">Drum Monkey...</span><br>With <span class="red-text">Just 1 Click</span> Of A Button:</h3>
            </div>
            <div class="demo-drum-inner mt-4 py-4 px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="audio_wrap h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Ambient-Downtempo-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Ambient & <span class="yellow-text">Downtempo</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+1+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+1+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+1+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+2+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+2+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+2+(110BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+3+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+3+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+3+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+4+(105BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+4+(105BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ambient+%26+Downtempo+Demo+4+(105BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Big-Room-Progressive-House-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Big Room & <span class="yellow-text">Progressive House</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+1+(128BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+1+(128BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+1+(128BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+2+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+2+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+2+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+3+(128BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+3+(128BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+3+(128BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                    <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+4+(128BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+4+(128BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Big+Room+%26+Progressive+House+Demo+4+(128BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Country-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Country</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+1+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+1+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+1+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+2+(80BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+2+(80BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+2+(80BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+3+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+3+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+3+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+4+(70BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+4+(70BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Country+Demo+4+(70BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Dancehall-Afrobeats-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Dancehall & <span class="yellow-text">Afrobeats</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+1+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+1+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+1+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+2+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+2+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+2+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+3+(100+BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+3+(100+BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+3+(100+BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+4+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+4+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dancehall+%26+Afrobeats+Demo+4+(95BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Disco-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Disco</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+1+(125BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+1+(125BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+1+(125BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+2+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+2+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+2+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+3+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+3+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+3+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+4+(128BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+4+(128BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Disco+Demo+4+(128BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Bass-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Drum & <span class="yellow-text">Bass</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+1+(170BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+1+(170BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+1+(170BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+2+(170+BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+2+(170+BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+2+(170+BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+3+(160BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+3+(160BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+3+(160BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+4+(170BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+4+(170BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Drum+%26+Bass+Demo+4+(170BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Dubstep-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Dubstep</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+1+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+1+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+1+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+2+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+2+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+2+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+3+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+3+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+3+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+4+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+4+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Dubstep+Demo+4+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Ethnic-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Ethnic</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+1+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+1+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+1+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+2+(70BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+2+(70BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+2+(70BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+3+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+3+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+3+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+4+(105BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+4+(105BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Ethnic+Demo+4+(105BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Folk-Indie-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Folk & <span class="yellow-text">Indie</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+1+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+1+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+1+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+2+(105BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+2+(105BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+2+(105BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+3+(80BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+3+(80BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+3+(80BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+4+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+4+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Folk+%26+Indie+Demo+4+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Funk-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Funk</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+1+(105BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+1+(105BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+1+(105BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+2+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+2+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+2+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+3+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+3+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+3+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+4+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+4+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Funk+Demo+4+(110BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Future-Bass-Melodic-Trap-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Future Bass & <span class="yellow-text">Melodic Trap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+1+(145BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+1+(145BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+1+(145BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+2+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+2+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+2+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+3+(145BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+3+(145BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+3+(145BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+4+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+4+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Future+Bass+%26+Melodic+Trap+Demo+4+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Gospel-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Gospel</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+1+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+1+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+1+(110BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+2+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+2+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+2+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+3+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+3+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+3+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+4+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+4+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Gospel+Demo+4+(110BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Hip-Hop-Rap-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Hip Hop & <span class="yellow-text">Rap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+1+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+1+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+1+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+2+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+2+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+2+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+3+(125BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+3+(125BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+3+(125BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+4+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+4+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Hip+Hop+%26+Rap+Demo+4+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/House-Deep-House-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>House & <span class="yellow-text">Deep House</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+1+(124BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+1+(124BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+1+(124BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+2+(124BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+2+(124BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+2+(124BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+3+(126BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+3+(126BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+3+(126BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+4+(128BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+4+(128BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/House+%26+Deep+House+Demo+4+(128BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Jazz-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Jazz</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+1+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+1+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+1+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+2+(160BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+2+(160BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+2+(160BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+3+(145BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+3+(145BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+3+(145BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+4+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+4+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Jazz+Demo+4+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Latin-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Latin</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+1+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+1+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+1+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+2+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+2+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+2+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+3+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+3+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+3+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+4+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+4+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Latin+Demo+4+(100BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Lo-Fi-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Lo-Fi</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+1+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+1+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+1+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+2+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+2+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+2+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+3+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+3+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+3+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+4+(80BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+4+(80BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Lo-Fi+Demo+4+(80BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Neo-Soul-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Neo-Soul</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+1+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+1+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+1+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+2+(75BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+2+(75BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+2+(75BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+3+(105BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+3+(105BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+3+(105BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+4+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+4+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Neo-Soul+Demo+4+(90BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Pop-Future-Pop-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Pop & <span class="yellow-text">Future Pop</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+1+(119BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+1+(119BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+1+(119BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+2+(115BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+2+(115BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+2+(115BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+3+(111BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+3+(111BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+3+(111BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+4+(98BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+4+(98BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Pop+%26+Future+Pop+Demo+4+(98BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/R-B-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">R&B</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+1+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+1+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+1+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+2+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+2+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+2+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+3+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+3+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+3+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+4+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+4+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/R%26B+Demo+4+(130BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Reggae-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Reggae</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+1+(85BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+1+(85BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+1+(85BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+2+(77BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+2+(77BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+2+(77BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+3+(85BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+3+(85BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+3+(85BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+4+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+4+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggae+Demo+4+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Reggaeton-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Reggaeton</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+1+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+1+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+1+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+2+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+2+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+2+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+3+(95BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+3+(95BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+3+(95BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+4+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+4+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Reggaeton+Demo+4+(100BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Rock-Metal-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Rock & <span class="yellow-text">Metal</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+1+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+1+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+1+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+2+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+2+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+2+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+3+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+3+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+3+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+4+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+4+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Rock+%26+Metal+Demo+4+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Soul-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Soul</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+1+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+1+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+1+(110BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+2+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+2+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+2+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+3+(90BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+3+(90BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+3+(90BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+4+(80BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+4+(80BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Soul+Demo+4+(80BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Synthwave-Synth-Pop-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Synthwave & <span class="yellow-text">Synth-Pop</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+1+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+1+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+1+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+2+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+2+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+2+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+3+(100BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+3+(100BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+3+(100BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+4+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+4+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Synthwave+%26+Synth-Pop+Demo+4+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Techno-Melodic-Techno-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Techno & <span class="yellow-text">Melodic Techno</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+1+(132BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+1+(132BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+1+(132BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+2+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+2+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+2+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+3+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+3+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+3+(130BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+4+(132BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+4+(132BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Techno+%26+Melodic+Techno+Demo+4+(132BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Trance-Psytrance-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>Trance & <span class="yellow-text">Psy-Trance</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+1+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+1+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+1+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+2+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+2+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+2+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+3+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+3+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+3+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+4+(135BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+4+(135BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trance+%26+Psytrance+Demo+4+(135BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Trap-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">Trap</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+1+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+1+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+1+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+2+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+2+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+2+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+3+(150BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+3+(150BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+3+(150BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+4+(130BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+4+(130BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/Trap+Demo+4+(130BPM).mp3"][/audio]'); ?>
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
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/UK-Drill-UK-Grime-350x350-.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3>UK Drill & <span class="yellow-text">UK Grime</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+1+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+1+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+1+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+2+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+2+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+2+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+3+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+3+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+3+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+4+(140BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+4+(140BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/UK+Drill+%26+UK+Grime+Demo+4+(140BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="audio_wrap audio_wrap_right h-100">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/loop1.png" class="elIMG ximg imgRoundCorners imgOpacity1 noShadow" alt="" width="250" tabindex="0">
                            </div>
                            <div class="title-box">
                                <h3><span class="yellow-text">???</span></h3>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 1:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+1+(110BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+1+(110BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+1+(110BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 2:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+2+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+2+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+2+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 3:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+3+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+3+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+3+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                            <div class="loop-box">
                                <h4>Demo Drum Loop 4:</h4>
                                <div class="audio">
                                <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+4+(120BPM).mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+4+(120BPM).mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Demos/%3F%3F%3F+Demo+4+(120BPM).mp3"][/audio]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-heading text-center">
                        <h3 class="bottom-heading p-3">Unlimited, Perfect Drum Patterns <span class="yellow-text">At Your Fingertips...</span></h3>
                    </div>
                    <div class="actions-btn btn-design text-center p-0 mt-4">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Loops Section -->

<!-- Quick Watch Section -->
<section class="watch-quick-video page-sec bg-white bg-image-corner" style="background-image: url(<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Cover.png);">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center w-full-770">
                <h2 class="heading h-black">Watch The <span class="red-text">Quick Video</span> Below To See <span class="red-text">Drum Monkey In Action:</span></h2>
            </div>
            <div class="video-sec">
                <div class="video-sec-wrapper">
                    <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><iframe src="https://fast.wistia.net/embed/iframe/jdl4x2m5r7?videoFoam=true" title="Unison Drum Monkey Walkthrough Section BF Video" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="100%" height="100%"></iframe></div></div>
                    <!-- <script src="https://fast.wistia.com/embed/medias/jdl4x2m5r7.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_jdl4x2m5r7 videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/jdl4x2m5r7/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div> -->
  
                </div>
            </div>
            <div class="actions-btn btn-design text-center p-0">
                <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
            </div>
        </div>
    </div>                            
</section>
<!-- End Quick Watch Section -->

<!-- Facebook Testimonial -->
<section class="facebook-testimonial page-sec pt-2">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">
                <figure class="mb-1">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Facebook-Monkey-Smaller-.png"  class="mw-100" alt="" width="350" tabindex="0">
                </figure>
                <h2 class="heading">What Members Of Our Private Facebook Group Are Saying...</h2>
            </div>
            <div class="facebook-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/11.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/15.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/16.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/21.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/19.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/9.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/5.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/14.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/21-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/17.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/13.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/4.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/3.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/22.png" class="mw-100" alt="" tabindex="0">
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
<section class="generate-drum-loop page-sec bg-yellow">
    <div class="container">
        <div class="generate-drum-inner">
            <div class="section-heading text-center mb-5">
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/123-Explosion-Updated-v2-2.png" class="mw-100" alt="" width="350" tabindex="0">
                </figure>
                <h2 class="heading h-black d-none-770">Generating Perfect Drum Loops <br>Is As <span class="red-text">Easy As 1-2-3</span></h2>
                <h2 class="heading h-black d-block-770">Generating Perfect Drum Loops Is As <span class="red-text">Easy As 1-2-3</span></h2>
            </div>
            <div class="generate-drum-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="red-text">1.</span> Select</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Select your preferred genre and length.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+Selector/Genre+Selector+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="generate-drum-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="red-text">2.</span> Generate</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Press the button to instantly generate a perfect drum loop.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Generate/Generate+(Full+Screen).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="generate-drum-wrap mb-0">
                <div class="row">
                    <div class="col-md-5">
                        <div class="content-box">
                            <div class="title-wrapper">
                                <h3><span class="red-text">3.</span> Drag & Drop</h3>
                            </div>
                            <div class="des-wrapper">
                                <p>Drag & drop your new drum loop straight into your project in either audio or MIDI format — or export it for later.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop/Drag+%26+Drop+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
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
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Explosion-.png" class="mw-100" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading text-transform-unset">But, Don't Let <span class="yellow-text">Drum Monkey'</span>s Simplicity Fool You... </h2>
                <h3 class="sub-heading mt-2">Here's Everything Going On <span class="red-text">Behind The Scenes:</span></h3>
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                                At Unison, It Took Us Over 1 Year To
                                <span class="yellow-text">Finally Perfect</span> Drum Monkey
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Billboard-750x750-1.png" class="mw-100" width="225" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>To make it, we obsessively analyzed successful songs <b>in 30 genres of music.</b></p>
                                <p>Found the <b>common threads & patterns </b>between them...</p>
                                <p>And <b>started experimenting </b>with different algorithms.</p>
                                <p>At first, the generated drum loops <b>sounded terrible.</b></p>
                                <p>But, over time we <b>refined and refined</b> — tweaking the algorithms and making further advancements.</p>
                                <p>And finally, <b>after 5,500+ hours and 1 million dollars of development...</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Billboard-750x750-.png" class="mw-100" width="375" alt="" tabindex="0"></figure>
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
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Searching-Right-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>It's <b>so complex </b>it would take a full day to explain.</p>
                                <p>But, in plain english...</p>
                                <p>It combines <b>7,500+ proven genre-specific </b>MIDI drum patterns...</p>
                                <p>And <b>3,000+ drum samples </b>modelled off successful songs...</p>
                                <p>With brand new, <b>cutting edge machine learning...</b></p>
                                <p>And, <b>Unison-exclusive "drum-pattern recognition" </b>algorithms...</p>
                                <p>To create <b>genre-specific </b>drum loops that actually <b>sound good 93% </b>of the time.</p>
                                <p>We've done all the hard work for you — all you have to do is <b>press the button.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Searching-Right-750x750-.png" class="mw-100" width="375" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey Behind The Scenes-->

<!-- Drum Monkey Powerful Scenes -->
<section class="with-drum-monkey page-sec bg-red why-reason">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/14-ex.png" class="mw-100" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading">14 More Reasons Why <span class="yellow-text">Drum Monkey Is So Powerful...</span></h2>
            </div>
            <div class="drum-categories-sec drum-categories-inner mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">1.</span> Genre-Specific
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+Selector/Genre+Selector+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>The truth is, <b>not all drum loops are created equal.</b></p>
                                <p>Each genre has <b>unique frameworks </b>that need to be followed.</p>
                                <p>That's why we spent <b>the last year </b>uncovering the secrets behind all these frameworks & packed them into <b>Drum Monkey's powerful algorithm.</b> </p>
                                <p>So, you can instantly generate drum loops in 30 different genres of music that are proven to <b>sound good with consistency.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Genre+Selector/Genre+Selector+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">2.</span> Or, Invent Your Own
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Idea-750x750-2.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>Why was Old Town road by Lil Nas X <b>so successful?</b></p>
                                <p>Simple. It managed to <b>combine 2 completely different genres </b>into something totally new.</p>
                                <p>To help you exploit this phenomenon, we've specifically created the <b>secret "???" genre </b>which fuses all 30 genres together.</p>
                                <p>So, with <b>Drum Monkey </b>you can either stick to proven frameworks in each genre, or go wild and invent your own.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Idea-750x750-2.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">3.</span> The Perfect Algorithm
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Searching-Left-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p><b>Drum Monkey's </b>creation engine is built from 7,500+ <b>proven genre-specific drum patterns.</b></p>
                                <p>Plus, cutting edge machine learning and <b>Unison-exclusive "drum-pattern recognition" </b>algorithms.</p>
                                <p>In plain english, this perfect algorithm <b>reliably exploits </b>the common characteristics of hit drum loops in 30 genres.</p>
                                <p>So, you can confidently and instantly generate drum loops that <b>actually sound good 93% of the time.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Searching-Left-750x750-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">4.</span> 3,000+ Sample <br>Factory Library
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/3k+Samples/3k+Samples+(Full+Screen).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p><b>Drum Monkey </b>is loaded with <b>3,000+ unique, professional, radio-quality samples.</b></p>
                                <p>So you can either instantly <b>generate perfect drum loops </b> with the <b>proven, genre-specific samples...</b></p>
                                <p>Use your <b>favorite samples </b>that you <b>already know and love..</b></p>
                                <p>Or <b>combine them together </b>to create <b>infinite possibilities.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/3k+Samples/3k+Samples+(Full+Screen).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">5.</span> Built-In Piano Roll
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Built-In+Piano+Roll/Built-In+Piano+Roll+(Full+Screen).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>Although most of the drum loops you generate will <b>sound amazing </b>off the bat...</p>
                                <p>You might want to tweak some of the elements to <b>customize them </b>to your exact taste.</p>
                                <p>Using <b>Drum Monkeys's </b>fully-loaded, built-in piano roll — you'll be able to <b>edit to your hearts desire.</b></p>
                                <p>Plus, there's <b>velocity adjustment, swing and humanization parameters </b>allowing for <b>complete flexibility.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Built-In+Piano+Roll/Built-In+Piano+Roll+(Full+Screen).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">6.</span> Built-In Saturator
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Saturator/Saturator+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>Not only does <b>Drum Monkey</b> generate <b>infinite perfect genre-specific drum loops...</b></p>
                                <p>But it also comes with an <b>industry-grade saturator</b> to <b>fatten your sound</b> and make your drums hit super hard.</p>
                                <p>We built this saturator <b>specifically for drums</b> so it <b>preserves the transients and nature</b> of the samples.</p>
                                <p>All you have to do is <b>click and drag the "Banana" icon</b> and watch your drums <b>increase in thickness, power and punch.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Saturator/Saturator+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">7.</span> ADSR Envelope Shaper/Panning
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/ADSR/ADSR+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>With <b>Drum Monkey</b>, you're guaranteed to generate <b>impressive, dynamic drum loops.</b></p>
                                <p>But you also have the <b>option to individually customize</b> each sample...</p>
                                <p>To your <b>desired punchyness, tightness or placement</b> in the stereo field.</p>
                                <p>This lets you <b>shape your drum loops</b> to your exact preference before you <b>drag &amp; drop or export them.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/ADSR/ADSR+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">8.</span> Groove Saver
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Preset+Saver/Preset+Saver+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>With <b>trillions of generation possibilities</b>, you'll probably want to<b> save some of the loops</b> you create for later use.</p>
                                <p>And that's what you can do with the <b>groove saver.</b></p>
                                <p>You can<b> store your favorite loops</b> into your <b>own user bank as presets</b> with a <b>single click...</b></p>
                                <p>Including your <b>full drum patterns</b> with <b>all MIDI and samples</b> so you can use them <b>at any time.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Preset+Saver/Preset+Saver+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">9.</span> Drag &amp; Drop/Export
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop/Drag+%26+Drop+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>We've optimized <b>Drum Monkey</b>&nbsp;for <b>maximum speed</b> and <b>efficiency.</b></p>
                                <p>So, as soon as you've generated a drum loop that <b>you're loving</b>...</p>
                                <p>Easily drag &amp; drop it straight into your project to <b>use right away</b> — or export it for later.</p>
                                <p>Plus, you can do this in <b>both audio and MIDI format</b> giving you <b>total control.</b></p>
                                <p>Whether you're getting a song started, finished or stocking up on inspiration, <b>Drum Monkey's</b> got you covered.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Drag+%26+Drop/Drag+%26+Drop+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">10.</span> Use With Any Samples
                            </h3>
                            <div class="d-block-769 text-center">
                                <div class="video-box mt-3">
                                    <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Any+Sample/Any+Sample+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                                </div>
                            </div>
                            <div class="category-content">
                                <p>Not only does Drum Monkey come with a <b>3,000+ pro-quality sample factory library...</b></p>
                                <p>You can <b>drag &amp; drop</b> all your own <b>favorite samples</b> onto the <b>drum pads</b> and use them for generation.</p>
                                <p>So, you can playback your <b>new drum loops</b> with the sounds you already love.</p>
                                <p>That means you'll have <b>total freedom &amp; control</b> to swap samples on the fly and try out different options with no limits.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="video-box">
                            <video src="https://unisonlandingpagevideos.s3.us-east-2.amazonaws.com/Landing+Page+ScreenCaps/Any+Sample/Any+Sample+(Zoomed).mp4" width="100%" height="100%" autoplay loop muted playsinline></video>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">11.</span> 100% Royalty Free
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Money-Bag-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>All the money you earn from music you make with <b>Drum Monkey</b> is <b>yours to keep.</b></p>
                                <p>That's because<b> you own all the drum loops</b> you generate and can use them in your music however you please.</p>
                                <p>So,<b> if you end up making a hit</b> with millions of plays we'll never ask for a cut of your profits.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Money-Bag-750x750-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">12.</span> No Filler Or Fluff
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/No-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>Other plugins <b>overwhelm</b> you with tons of unnecessary functions.</p>
                                <p>So, instead of getting you <b>caught up in clicking 20 buttons</b> to do what you want...</p>
                                <p>We've refined <b>Drum Monkey</b>&nbsp;to <b>deliver you results</b> in the easiest, fastest and most effective way.</p>
                                <p>Simply choose your genre, length and <b>click the button.</b> That's it.</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/No-750x750-.png" class="mw-100" width="350" alt=""  tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">13.</span> Beginner Friendly
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Beginner-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>We've <b>done all the hard work</b>&nbsp;for you already.</p>
                                <p>So, whether you're a beginner, intermediate or advanced — using <b>Drum Monkey</b> will be a <b>piece of cake</b> for you.</p>
                                <p>You <b>don't need to have years of production experience</b>, have a lot of time to produce or have any advanced technical skills.</p>
                                <p>We've designed <font color="#2ddabf"><b>Drum Monkey</b></font>&nbsp;to be <b>so quick and easy to use</b>, even a kindergartener could do it.&nbsp;</p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Beginner-750x750-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(238, 113, 98);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content h-100">
                            <h3>
                                <span class="red-text">14.</span> A Blast To Use
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Monkey_animation_2_1x1_1_Color_.gif" class="mw-100" width="500" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content mt-sm-0">
                                <p>We believe <b>making music should be fun</b>, so why not the plugins you use too?</p>
                                <p>So, instead of using plugins that look like they are from '02... we invite you to join the <b>next generation</b> of plugins.</p>
                                <p>With the entertaining, randomized animations &amp; engaging UI — you'll <b>never get bored</b> of <b>Drum Monkey.</b></p>
                                <div class="actions-btn btn-design text-center p-0 mt-4">
                                    <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Drum-Monkey_animation_2_1x1_1_Color_.gif" class="mw-100" width="550" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey Powerful Scenes-->

<!-- Facebook Testimonial -->
<section class="facebook-testimonial page-sec pt-2">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">
                <figure class="mb-1">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Facebook-Monkey-Smaller-.png"  class="mw-100" alt="" width="350" tabindex="0">
                </figure>
                <h2 class="heading">Some More Private Facebook Group Comments...</h2>
            </div>
            <div class="facebook-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/6-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/16-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/9-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/13-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/4-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/5-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/7-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/8-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/12-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/11-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/18-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/2-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/14-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/17-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/3-Comment-.png" class="mw-100" alt="" tabindex="0">
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
<section class="with-drum-monkey page-sec bg-yellow how-much-cost pt-3">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-1">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Money-explosion.png" class="elIMG ximg imgRoundCorners noborder imgOpacity1" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading h-black" style="color:rgb(64, 64, 64);">Ok, So How Much Does It Cost?</h2>
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                                Just To Be Upfront, <br>Drum Monkey <span class="red-text">Isn't Cheap</span>
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Money-Bag-750x750-1.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>So let’s just think about the <b>alternatives </b>you could try...</p>
                                <p>You could study the <b>biggest hit songs </b>and create <b>millions of drum loops </b>yourself...</p>
                                <p>Which <b>would take years </b>and give you <b>no guarantee </b>of making something that's at a <b>professional level...</b></p>
                                <p>Or, you could buy all the MIDI drum packs and sample packs on our site for <b>$1,349.</b></p>
                                <p>But they <b>won't be custom-made </b>exclusively for you, be unlimited, give you nearly <b>as much inspiration...</b></p>
                                <p>And you'd <b>still have to put together </b>the drum loops <b>on your own.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Money-Bag-750x750-1.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="section-divider">
                    <span style="background:rgb(255, 248, 167);"></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>
                            So, Considering The <span class="red-text">5,500+ Hours</span><br>And <span class="red-text">1 Million+ Dollars</span> It Costed <br>To Create It...
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Thinking-750x750-.png" class="mw-100" width="225" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>The power it'll give you to instantly <b>generate perfect drum loops...</b></p>
                                <p>Get infinite <b>inspiration </b>at your fingertips...</p>
                                <p>And absolutely <b>blow the minds </b>of your friends & listeners...</p>
                                <p>The regular price of Drum Monkey is <b>$397.</b></p>
                                <p>But don't worry...</p>
                                <p>As a limited-time offer — <b>today, you won’t have to pay that.</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Thinking-750x750-.png" class="mw-100" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey How Much -->

<!-- Drum Monkey Exclusive Bonuses -->
<section class="with-drum-monkey page-sec bg-primary-black exclusive-bonus">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-5">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/3D-Bonuses-Reduced-Size-.png" class="mw-100" alt="" width="900" tabindex="0">
                </figure>
                <h2 class="heading">Plus, Get <span class="yellow-text">5 Free Exclusive Bonuses</span></h2>
                <h3 class="sub-heading mt-2">When You Choose The <span class="red-text">Single Pay Option</span></h3>
            </div>
            <div class="drum-categories-sec drum-categories-inner mw-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #1</h4>
                            <h3>
                                Unison MIDI Chord, Melody &amp; Bassline Collection
                            </h3>
                            <h5 class="red-text">($127 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus01.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">    
                                <p>When you get <b>Drum Monkey </b>today, you're going to want <b>high-quality, genre-specific </b>MIDI files to complete the arrangement of your tracks.</p>
                                <p>That's why we've designed the <b>Unison MIDI Chord, Melody & Bassline Collection.</b></p>
                                <p>It's complete collection of <b>450 unique MIDI files </b>that you can drag & drop straight into your projects...</p>
                                <p>And instantly create <b>pro-sounding chord progressions, melodies and basslines.</b></p>
                                <h6>Chords, Melodies & Bassline Demos:</h6>
                                <div class="loop-box">
                                    <div class="audio">
                                        <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Chord+Progression+Demo.mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Chord+Progression+Demo.mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Chord+Progression+Demo.mp3"][/audio]'); ?>
                                    </div>
                                    <div class="audio">
                                        <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Melody+Demo.mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Melody+Demo.mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Melody+Demo.mp3"][/audio]'); ?>
                                    </div>
                                    <div class="audio">
                                        <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Bassline+Demo.mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Bassline+Demo.mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/MIDI+Bassline+Demo.mp3"][/audio]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus01.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #2</h4>
                            <h3>Unison Bass Loop Pack</h3>
                            <h5 class="red-text">($97 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus02.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>To go along with your <b>perfectly generated, genre-specific drum loops...</b></p>
                                <p>You're going to want the<b> fattest bass loops</b> to use with them.</p>
                                <p>And that's exactly what you'll get inside the<b> Unison Bass Loop Pack.</b></p>
                                <p>Just drag in these <b>60 crazy bass loops</b> into your project and instantly <b>get your listeners dancing</b> to your music.</p>
                                <h6>Play Demo:</h6>
                                <div class="loop-box">
                                    <div class="audio">
                                        <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Bass+Loop+Pack+Demo.mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Bass+Loop+Pack+Demo.mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Bass+Loop+Pack+Demo.mp3"][/audio]'); ?>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus02.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #3</h4>
                            <h3>Unison Melody Loop Pack</h3>
                            <h5 class="red-text">($97 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus03.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">                                    
                                <p>Melodies are what <b>get stuck in your listeners' heads</b> and get them to like and share your music.</p>
                                <p>So that's why we're giving you the<b> Unison Melody Loop Pack.</b></p>
                                <p>Inside you'll get <b>60 hit-worthy melodies</b> from our <b>unreleased</b> sample packs...</p>
                                <p>That you can <b>drag &amp; drop </b>right into your tracks and take your generated drum loops to <b>the next level.</b></p>
                                <h6>Play Demo:</h6>
                                <div class="loop-box">
                                    <div class="audio">
                                        <?php echo do_shortcode('[audio mp3="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Melody+Loop+Pack+Demo.mp3" wav="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Melody+Loop+Pack+Demo.mp3" ogg="https://unisondrummonkey.s3.amazonaws.com/Bonus+Demos/Unison+Melody+Loop+Pack+Demo.mp3"][/audio]'); ?>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus03.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row row-reverse">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #4</h4>
                            <h3>Drum Monkey Advanced Implementation Training</h3>
                            <h5 class="red-text">($147 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus04.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p><b>Beyond</b> <b>what you already know</b> about <b>Drum Monkey</b>...</p>
                                <p>There's some <b>secret uses</b> that would simply be too powerful to reveal to everyone.</p>
                                <p>In the <b>Drum Monkey Advanced Implementation</b> <b>Training</b>, Unison co-founder and producer with 30+ million plays Sep...</p>
                                <p>Will be demonstrating in real time how to use <b>Drum Monkey</b> to <b>easily make pro-sounding tracks</b>&nbsp;in several genres.</p>
                                <p>Also, he'll show you <b>3 special ways</b> you can use <b>Drum Monkey</b> (one of them can make producers a lot of money.)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus04.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
                <div class="section-divider">
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="drum-category-content">
                            <h4 class="yellow-text">Bonus #5</h4>
                            <h3>Drum Monkey Private Facebook Group Access</h3>
                            <h5 class="red-text">($197 Value)</h5>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus05.png" class="mw-100" width="300" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">                                
                                <p>When you get <b>Drum Monkey,</b> you'll be <b>joining a private Facebook community</b> of motivated and ambitious producers just like you.</p>
                                <p>In this group, <b>you'll be able to:</b></p>
                                <ul>
                                    <li>Ask <b>production related questions</b> &amp; share ideas with each other</li>
                                    <li>Get <b>specific feedback</b> on songs you're working on</li>
                                    <li>Find potential <b>collaborations</b></li>
                                    <li>Share contacts /&nbsp;<b>build your network</b></li>
                                    <li>And have a <b>supportive community</b> who truly wants to see you succeed</li>
                                </ul>
                                <p>This group brings everything together to create a <b>complete package of everything you could possibly need to succeed</b> as a producer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none-769">
                        <figure class="mb-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bonus-img/Bonus05.png" class="mw-100" alt="" tabindex="0"></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drum Monkey Exclusive Bonuses -->

<!-- Payment Options -->
<section class="payment-options page-sec" id="scroll-Yes">
    <div class="container">
        <div class="payment-options-inner">
            <div class="section-heading text-center">
                <h2 class="heading mb-5">Select One Of The Payment Options Below Now:</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="column-inner h-100">
                        <div class="title-box text-center">
                            <div class="img-box">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/DM-3D.png" class="mw-100" width="130">
                            </div>
                            <h3>Rent-To-Own</h3>
                            <h4>Here's <span class="red-text">What You'll Get:</span></h4>
                        </div>
                        <div class="payment-wrap left">
                            <div class="category-content">
                                <ul class="list-point">
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drum Monkey License + Lifetime Updates <span class="yellow-text">($397 Value)</span>
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Instantly Generate Perfect Drum Loops In 30 Genres
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Get Infinite Inspiration On Demand
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 3,000+ Sample Factory Library – Or Use Your Own
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Built-In Saturator & Piano Roll
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> ADSR Envelope Shaper, Panning & Groove Saver
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drag & Drop Or Export Audio & MIDI
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Works With Both Mac, PC & All Major DAWs
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 60-Day Money-Back Guarantee
                                    </li>
                                </ul>
                            </div>                            
                        </div>
                        <div class="payment-price text-center">
                            <h4 class="red-text">Total Value:</h4>
                            <h3>$397</h3>
                            <h4 class="red-text mt-3 mb-1">Today Only:</h4>
                            <h3>$14.99 <span class="h3 small">x 22 months</span></h3>
                        </div>
                        <div class="actions-btn btn-design text-center p-0 my-3">
                            <a href="https://app.unison.audio/cart/add/0-11-75-79" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">Rent-To-Own | Pause Or Cancel Anytime</span></a>
                        </div>
                        <p class="money-back">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</p>
                        <div class="payment-methd text-center mt-2">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/credit-paypal.png" class="mw-100" alt="" width="250" tabindex="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="column-inner bg-yellow h-100">
                        <div class="title-box text-center">
                            <div class="img-box">                                
                                <?php if(wp_is_mobile()){
                                    ?>
                                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/DM-Bonuses-Mobile-.png" class="mw-100" width="150">                                    
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/DM-Bonuses.png" class="mw-100" width="450">
                                    <?php
                                }?>
                            </div>
                            <h3>1 Single Payment <span class="red-text respnosive-block">(Save $30)</span></h3>
                            <h4>Here's <span class="red-text">What You'll Get:</span></h4>
                        </div>
                        <div class="payment-wrap right">
                            <div class="category-content">
                                <ul class="list-point">
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drum Monkey License + Lifetime Updates <span class="yellow-text">($397 Value)</span>
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Instantly Generate Perfect Drum Loops In 30 Genres
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Get Infinite Inspiration On Demand
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 3,000+ Sample Factory Library – Or Use Your Own
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Built-In Saturator & Piano Roll
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> ADSR Envelope Shaper, Panning & Groove Saver
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Drag & Drop Or Export Audio & MIDI
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> Works With Both Mac, PC & All Major DAWs
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-check"></i> 60-Day Money-Back Guarantee
                                    </li>
                                    <li><i contenteditable="false" class="fa fa-fw fa-plus"></i> 5 Free Exclusive Bonuses <span class="yellow-text">($665 Value)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-price text-center">
                            <h4 class="red-text">Total Value:</h4>
                            <h3>$1,062</h3>
                            <h4 class="red-text mt-3 mb-1">Today Only:</h4>
                            <h3>1 Single Payment Of <span><del>$397</del></span> $297</h3>
                        </div>
                        <div class="actions-btn btn-design text-center p-0 my-3">
                            <a href="https://unison.audio/drum-monkey-order-secure/" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                        </div>
                        <p class="money-back">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</p>
                        <div class="payment-methd text-center mt-2">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/credit-paypal.png" class="mw-100" alt="" width="250" tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Payment Options -->

<!-- Fully Protected -->
<section class="fully-protected page-sec bg-yellow">
    <div class="container">
        <div class="fully-protected-inner">
            <div class="section-heading text-center">
                <h2 class="heading h-black">Plus, You're <span class="red-text">Fully Protected</span> By Our<br/>
                60-Day <span class="red-text">100% Money-Back Guarantee</span></h2>
                <figure class="mt-3 mb-3">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Back-Monkey.png" class="mw-100" alt="" width="520" tabindex="0">
                </figure>                
            </div>
            <div class="content-wrap width-sm-100">
                <h3 class="mb-3 text-center">After getting Drum Monkey today, you can Try It Out For A <span class="red-text">Full 60 Days.</span></h3>
                <p>Use it to make <b>tons of perfect</b>&nbsp;drum loops...</p>
                <p>Get <b>inspiration</b> &amp; finish more music...</p>
                <p>And then, if you’re not <b>absolutely blown away</b> with your results...</p>
                <p>Just <b>email our support team</b>&nbsp;at support@unison.audio.</p>
                <p>We'll <b>happily refund you every cent</b> and make your license available to someone else.</p>
                <p><b>No questions asked.</b> No weirdness. No hard feelings.</p>
                <p>Plus, you can <b>keep all the bonuses</b> absolutely free.</p>
                <p>You have <b>nothing to lose</b> and everything to gain.</p>
            </div>
            <div class="actions-btn btn-design text-center p-0 pt-2 mt-4">
                <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">60-Day Money-Back Guarantee</span></a>
            </div>
        </div>
    </div>
</section>
<!-- End Fully Protected -->

<!-- Facebook Testimonial -->
<section class="facebook-testimonial page-sec pt-2">
    <div class="container">
        <div class="watch-video-inner">
            <div class="section-heading text-center mb-4 mb-md-5">
                <figure class="mb-1">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Facebook-Monkey-Smaller-.png"  class="mw-100" alt="" width="350" tabindex="0">
                </figure>
                <h2 class="heading">What Other Producers Are Saying...</h2>
            </div>
            <div class="facebook-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/24.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/24-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/22-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/27-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/23.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/23-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/21-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/25-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner-column">
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/25.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/19-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/20-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>
                            <div class="testimonial-item">
                                <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/26-Comment-.png" class="mw-100" alt="" tabindex="0">
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
</section>
<!-- End Facebook Testimonial -->

<!-- Are You Ready? -->
<section class="with-drum-monkey page-sec bg-primary-black are-you-ready">
    <div class="container">
        <div class="with-drum-monkey-inner">
            <div class="section-heading text-center">
                <figure class="mb-4">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Explosion.png" class="elIMG ximg imgRoundCorners noborder imgOpacity1" alt="" width="225" tabindex="0">
                </figure>
                <h2 class="heading">Are You <span class="yellow-text">Ready?</span></h2>                
            </div>
            <div class="drum-categories-sec drum-categories-inner width-sm-100 are-you-ready">
                <div class="row">
                    <div class="col-md-7">
                        <div class="drum-category-content h-100">
                            <h3>If You <span class="yellow-text">Want</span> To:</h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Infinite-750x750-.png" class="mw-100" width="250" alt="" width="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <ul class="list-point">
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i> Make <span class="yellow-text">addictive tracks</span>&nbsp;using perfect drum loops
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i> Consistently <span class="yellow-text">finish more music</span> than you ever thought possible
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i> Make music you can <span class="yellow-text">actually be proud of</span>
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i> Make a significant <span class="yellow-text">positive impact</span> on people with your music
                                    </li>
                                    <li>
                                        <i contenteditable="false" class="fa fa-fw fa-check"></i> Potentially even make a <span class="yellow-text">full-time career</span> out of music production...
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Infinite-750x750-.png" width="350" alt="" tabindex="0"></figure>
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
                                Drum Monkey is <span class="yellow-text">for you</span> —<br/>
                                And All That's Left To Do Is...
                            </h3>
                            <div class="d-block-769 text-center">
                                <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Strength-750x750-.png"  class="mw-100" width="250" alt="" tabindex="0"></figure>
                            </div>
                            <div class="category-content">
                                <p>1.<span class="yellow-text"> Click</span> the "Get Drum Monkey Now" button below.</p>
                                <p>2.<span class="yellow-text"> Select</span> your preferred payment option.</p>
                                <p>3.<span class="yellow-text"> Complete your order</span> on the next page.</p>
                                <p>4.<span class="yellow-text"> Instantly get emailed</span> your Drum Monkey license.</p>
                                <p>5.<span class="yellow-text"> Download</span> the installer and activate your copy.</p>
                                <p>And just like that, you'll be <span class="yellow-text">off to the races.</span></p>
                                <p>Ready to <span class="yellow-text">instantly generate perfect</span> drum loops — While getting loads of inspiration.</p>
                                <p>Starting <span class="yellow-text">just a few minutes</span> from now...</p>
                                <p>The <span class="yellow-text">decision is yours.</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none-769">
                        <div class="drum-category-image">
                            <figure class="mb-0"><img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Strength-750x750-.png" width="350" alt="" tabindex="0"></figure>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions-btn btn-design text-center">
                            <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Are You Ready? -->

<!-- FAQ -->
<section class="faq-sec page-sec bg-white bg-image-corner" style="background-image: url(<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Monkey-Head-Cover.png);">
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
                                <span class="yellow-text">1.</span> How will Drum Monkey be delivered to me and how quickly?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-1" class="collapse" aria-labelledby="heading-1">
                        <div class="card-body">
                            <p>Your installer download link, Activation Code and bonus download links will be <b>sent to your email address and enabled in your Unison account immediately after your purchase.</b> The private Facebook group link and details will also be sent to your email and mentioned in your account.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-2">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                <span class="yellow-text">2.</span> Do I get lifetime access to everything?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2">
                        <div class="card-body">
                            <p>Yes, when you secure your Drum Monkey license today...<br /> <b>You'll get 100% lifetime access to everything.</b> Plus, you'll get all future Drum Monkey updates for free. That means you won't have to pay extra for new features we may add.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-3">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                <span class="yellow-text">3.</span> What DAWs is Drum Monkey compatible with?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-3" class="collapse" aria-labelledby="heading-3">
                        <div class="card-body">
                            <p>After completing your order, you'll get installer downloads for both Mac & PC, as well as an Activation Code. <b>All you need to do is run the installer, open up your DAW, load up Drum Monkey, click "Activate", enter in your Activation Code and you're good to go. The whole process takes less than 60 seconds.</b> You can authorize Drum Monkey with your single Activation Code on<b> up to 2 machines you own simultaneously.</b></p>
                            <p>Plus, Drum Monkey is <b>protected by PACE Fusion Technology</b> which is the most secure license management method available. That means <b>the plugin code is protected at the highest level</b> and all producers who purchase can have peace of mind that their investment is protected and rock-solid.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-4">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                <span class="yellow-text">4.</span> How does authorization work for Drum Monkey?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4">
                        <div class="card-body">
                            <p>After completing your order, you'll get installer downloads for both Mac &amp; PC, as well as an Activation Code. <b>All you need to do is run the installer, open up your DAW, load up Drum Monkey, click "Activate", enter in your Activation Code and you're good to go. The whole process takes less than 60 seconds. </b>You can authorize Drum Monkey with your single Activation Code on <b>up to 2 machines you own simultaneously.</b></p>
                            <p>Plus, Drum Monkey is <b>protected by PACE Fusion Technology</b> which has not been compromised since its existence 20 years ago. That means <b>no one will be able to crack it</b> and all producers who purchase can have peace of mind that their investment is protected and rock-solid.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-5">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                <span class="yellow-text">5.</span> Are the drum loops I generate royalty free?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-5" class="collapse" aria-labelledby="heading-5">
                        <div class="card-body">
                            <p><b>Yes, any Drum Loops you generate with Drum Monkey are 100% royalty free &amp; cleared for commercial use.</b> You can use them in your music however you want and all the money you earn from music created with Drum Monkey is yours for the keeping. The only restriction is you can't sell loops using the factory samples as standalone products/sample packs. <b>Any loops you create using all your own samples you can sell however you want.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-6">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                <span class="yellow-text">6.</span> How big is the included factory sample library?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-6" class="collapse" aria-labelledby="heading-6">
                        <div class="card-body">
                            <p>The included factory sample library consists of <b>3,000+ unique, professional-quality samples. </b>They were made by <b>world-class producers and a grammy-award winning drummer </b>so you can be sure everything is of <b>hit-standard.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-7">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                                <span class="yellow-text">7.</span> Can I use Drum Monkey with my own samples?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-7" class="collapse" aria-labelledby="heading-7">
                        <div class="card-body">
                            <p><b>Yes, this is a feature that hundreds of producers requested</b>, so we listened and implemented it. On top of the <b>included 3,000+ professional factory sample library</b>, you can <b>also generate perfect drum loops using your own samples.</b> Just <b>drag your desired samples onto the drum pads</b> and they'll be good to go.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-8">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                <span class="yellow-text">8.</span> Will Drum Monkey be difficult to use?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-8" class="collapse" aria-labelledby="heading-8">
                        <div class="card-body">
                            <p>Drum Monkey is <b>super simple and easy to use.</b>&nbsp;Whether you're a <b>beginner, intermediate or advanced</b>,&nbsp;we've taken the hard work out of it for you and set you up for<b> instant results.</b> Just<b> </b>install the plugin, choose your genre/length and<b> click the generate button.</b> From there you can <b>customize everything </b>if you'd like,<b> drag &amp; drop into your project</b> and <b>have fun finishing &amp; releasing&nbsp;professional-sounding tracks.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-9">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-9" aria-expanded="false" aria-controls="collapse-9">
                                <span class="yellow-text">9.</span> Does it matter what genre I produce?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-9" class="collapse" aria-labelledby="heading-9">
                        <div class="card-body">
                            <p><b>Drum Monkey generates perfect drum loops in the 30 major genres of music.</b> So whether you're into producing <b>hip hop beats, house, R&amp;B, pop, ambient, Lo-Fi, future bass, funk, jazz, classical, rock or anything else, you're good.</b> Plus you get the <b>unfair advantage over normal producers</b> from being able to use elements from different genres you wouldn't normally think of to <b>make your music unique and stand out.</b></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-10">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-10" aria-expanded="false" aria-controls="collapse-10">
                                <span class="yellow-text">10.</span> Is using Drum Monkey cheating?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-10" class="collapse" aria-labelledby="heading-10">
                        <div class="card-body">
                            <p>Considering that the<b> best producers in the world work smart, not hard...</b> Any producer that thinks using this game-changing plugin is cheating likely has no impressive results to show for themselves. <b>So, using Drum Monkey is the biggest step you can take to save time and get massive results instantly. </b>Producers who don't jump on board will get left behind and will be at a huge disadvantage.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-11">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-11" aria-expanded="false" aria-controls="collapse-11">
                                <span class="yellow-text">11.</span> What payment options are available?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-11" class="collapse" aria-labelledby="heading-11">
                        <div class="card-body">
                            <p>We securely accept payments through <b>all major credit cards and PayPal.</b> You can pay for Drum Monkey with <b>one single payment or rent-to-own</b> after you click the button below and go to the next page. Your information is safe and secure and we respect your privacy.</p>
                            <p>Although you <b>save an additional $30 with the single-pay option,</b> if you choose rent-to-own, you pay only $14.99 today, followed by 21 more monthly payments of $14.99, totalling $329.78. If at any point a payment fails, your license will be paused and Drum Monkey will stop functioning until the payment goes through. You can also <b>pause or cancel your rent-to-own plan yourself with 1 click</b> from your account.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-12">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-12" aria-expanded="false" aria-controls="collapse-12">
                                <span class="yellow-text">12.</span> What if I'm unsatisfied with Drum Monkey?
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-12" class="collapse" aria-labelledby="heading-12">
                        <div class="card-body">
                            <p>Drum Monkey comes with a <b>60 Day, 100% Money Back Guarantee. </b>That means if you change your mind about this decision at any point in the next 2 months – all you need to do is email us at support@unison.audio and we’ll refund your purchase. No questions asked. No weirdness. No hard feelings. Plus, you can keep all the bonuses absolutely free. <b>You have nothing to lose and everything to gain.</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row center-img">
                <div class="col-md-12">
                    <figure class="mb-0 text-center">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Explosion+2+GIF+(Yellow).gif" class="mw-100" alt="" tabindex="0">
                    </figure>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions-btn btn-design text-center pb-2 pt-0">
                        <a href="#scroll-Yes" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elButtonTxtColor1 elButtonCorner5 elBTN_b_1 elButtonNoShadow elBtnVP_00 elBtnHP_40 no-button-effect elButtonFluid" rel="noopener noreferrer" id="undefined-248-238-404-339-520-806"><span class="elButtonMain">GET DRUM MONKEY NOW</span><span class="elButtonSub">For $100 Off + 5 Free Bonuses</span></a>
                    </div>
                    <span class="d-block text-center" style="font-size:12px;font-weight:500;">Try It Risk-Free | 60-Day 100% Money-Back Guarantee</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="logo-image text-center mt-4">
                        <div class="d-none-770">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/Daw-Icons-with-bitwig.png" class="mw-100" alt="" width="800" tabindex="0">
                        </div>                    
                        <div class="d-block-770 mobile-img">
                            <img src="<?php echo get_bloginfo('template_url'); ?>/images/drum-monkey/DAW-Icons-Mobile-2.png" class="mw-100" alt="" width="280" tabindex="0">
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