var trackcmp_email = ac_tracking_params.email;
var trackcmp = document.createElement("script");
trackcmp.async = true;
trackcmp.type = 'text/javascript';
trackcmp.src = '//trackcmp.net/visit?actid=' + ac_tracking_params.tracking_id + '&e=' + encodeURIComponent( trackcmp_email ) + '&r=' + encodeURIComponent( document.referrer )+'&u='+encodeURIComponent( window.location.href );
var trackcmp_s = document.getElementsByTagName("script");
if (trackcmp_s.length) {
	trackcmp_s[0].parentNode.appendChild(trackcmp);
} else {
	var trackcmp_h = document.getElementsByTagName("head");
	trackcmp_h.length && trackcmp_h[0].appendChild(trackcmp);
}
