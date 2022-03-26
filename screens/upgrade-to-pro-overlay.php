<?php $m4ac_z9t8ek53n4 = !empty($m4ac_z9t8ek53n4) ? $m4ac_z9t8ek53n4 : false; ?>
<style>
<?php
if( ! $m4ac_z9t8ek53n4 ){ ?>
.mmsb-welcome {
	position: relative;
	max-height: 100vh;
	height: calc( 100vh - 32px );
}

.mmsb-welcome .inner-wrap {
	position: absolute;
	left: 50%;
	top: 40%;
	transform: translate(-50%, -40%);
	border-radius: 15px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
	border: 1px solid #ebebeb;
	overflow: hidden;
}

.mmsb-welcome .inner {
	width: 750px;
}

.mmsb-call-to-action{
	padding:30px;
}
<?php } else { ?>
.mmsb-welcome .header{
	margin: -1em -1em 0 -1em;
}
@media screen and (min-width: 700px) {
	.mmsb-welcome .header{
		margin: -2em -2em 0 -2em;
	}
}
.mmsb-lock-icon span{
	display:inline;
}
.mmsb-call-to-action{
	padding:30px 0;
}
<?php } ?>

.mmsb-welcome .header img {
	width: 30px;
}

.mmsb-welcome .logo {
	display: flex;
	align-items: center;
	cursor: default;
}

.mmsb-welcome .header {
	text-align: left;
	padding: 10px 15px;
	display: flex;
	align-items: center;
	border-bottom: 1px solid #ebebeb;
	box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 5px 0px;
	justify-content: space-between;
	position: relative;
}

.mmsb-welcome .header .title {
	margin: 0 0 0 10px;
	font-size: 14px;
	text-transform: uppercase;
	text-align:center;
	letter-spacing:1;

}

.mmsb-importing-wrap {
	display: none;
}

.mmsb-welcome .inner {
	vertical-align: middle;
	margin: 0 auto;
	display: inline-block;
	background: #fff;
	text-align: center;
}

.mmsb-welcome h1 {
	margin-top: 0;
	font-size: 2.4em;
	line-height:1.3;
	margin: 40px 10px;
	text-align:center;
	font-weight:800;
	padding:10px 30
}

.mmsb-welcome p {
	font-size: 16px;
	line-height: 1.4;
}

ul.memblist li:before { content:"\2713\0020";margin-right:10px; }
ul.memblist {
	list-style-type: none;
	text-align:left;
	font-size:16px;
	line-height:1.3;
}

.memb-cta {
	padding:20px 60px;
	font-size:21px;
	font-weight:700;
}

</style>

<div class="mmsb-menu-page-wrapper">
	<div id="mmsb-menu-page">
		<div class="mmsb-welcome">
			<div class="inner-wrap">
				<div class="inner">
					<div class="header">
						<span class="logo">
							<img src="http://m4ac2323.local/wp-content/plugins/mmsb/assets/images/logo.svg">
							<h3 class="title aligncenter"></h3>
						</span>
					</div>
					<div class="mmsb-lock-icon" style="margin:20px auto;">
						<span style="text-align:center; font-size:100px; color:#3a76a9;" class="dashicons dashicons-lock"></span>
					</div>
					<h1>Upgrade Your Memberium License to Pro to Unlock This Feature</h1>
					<p>You'll also be able to...</p>
					<div style="max-width:480px;margin:20px auto;">
						<ul class="memblist">
							<li> Sell Subscriptions With MemberiumPay</li>
							<li>Use Memberium on an Unlimited Number of Domain Names</li>
							<li>Level Up By Offering Group / Umbrella Accounts</li>
							<li>Get a Pro-Rated Upgrade Instantly</li>
						</ul>
						<div class="mmsb-call-to-action">
							<a class="btn button-primary memb-cta" target="_blank" href="https://memberium.com/faq/can-upgrade-memberium-subscription/#upgrade-bot">Upgrade Your Memberium Subscription to Unlock This Feature</a>
							<p>If you don't yet have an existing license, you can purchase any  <a target="_blank" href="https://memberium.com/pricing/">Pro license here</a> to start using this feature.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
