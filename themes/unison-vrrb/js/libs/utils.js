var Utils=function(){"use strict";var n=null,t=null,i=function(){for(var n,t=3,i=document.createElement("div"),e=i.getElementsByTagName("i");i.innerHTML="<!--[if gt IE "+ ++t+"]><i></i><![endif]-->",e[0];);return t>4?t:n}();return{isTouch:function(){return _.isNull(n)&&(n="ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch),n},isOldie:function(){return _.isNull(t)&&(t=9>i),t}}}();