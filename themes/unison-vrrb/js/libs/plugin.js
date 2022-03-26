function whichTransitionEvent() {
    var t, e = document.createElement("fakeelement"), i = {
        transition: "transitionend",
        OTransition: "oTransitionEnd",
        MozTransition: "transitionend",
        WebkitTransition: "webkitTransitionEnd"
    };
    for (t in i) if (void 0 !== e.style[t]) return i[t]
}

function whichAnimationEvent() {
    var t, e = document.createElement("fakeelement"), i = {
        animation: "animationend",
        OAnimation: "oAnimationEnd",
        MozAnimation: "animationend",
        WebkitAnimation: "webkitAnimationEnd"
    };
    for (t in i) if (void 0 !== e.style[t]) return i[t]
}

function trace(t) {
    var e = $("#log").html();
    (null === e || "undefined" === e) && ($("body").append('<div id="log"></div>'), $("#log").draggable()), $("#log").prepend("<p>" + traceId + ". " + t + "</p>"), traceId++
}

function animateBounce(t) {
    $(t).velocity({
        translateY: "-1.5rem",
        rotateZ: "-10deg"
    }, 100, "easeOut").velocity({rotateZ: "8deg"}, 150).velocity({translateY: "0", rotateZ: "0"}, 600, "easeOutBounce")
}

function debounce(t, e, i) {
    var s;
    return function () {
        var n = this, o = arguments, a = function () {
            s = null, i || t.apply(n, o)
        }, r = i && !s;
        clearTimeout(s), s = setTimeout(a, e), r && t.apply(n, o)
    }
}

function getDocumentSize(t) {
    var e, i, s, n;
    return window.innerHeight && window.scrollMaxY ? (e = window.innerWidth + window.scrollMaxX, i = window.innerHeight + window.scrollMaxY) : document.body.scrollHeight > document.body.offsetHeight ? (e = document.body.scrollWidth, i = document.body.scrollHeight) : (e = document.body.offsetWidth, i = document.body.offsetHeight), self.innerHeight ? (s = document.documentElement.clientWidth ? document.documentElement.clientWidth : self.innerWidth, n = self.innerHeight) : document.documentElement && document.documentElement.clientHeight ? (s = document.documentElement.clientWidth, n = document.documentElement.clientHeight) : document.body && (s = document.body.clientWidth, n = document.body.clientHeight), n > i ? pageHeight = n : pageHeight = i, s > e ? pageWidth = e : pageWidth = s, arrayPageSize = new Array(pageWidth, pageHeight, s, n), arrayPageSize[t]
}

function onHideSelectOptionHandler() {
    $(".custom-option").each(function () {
        $(this).is(":hidden") || hideComboBox(this)
    })
}

function showHideOptions(t) {
    t.stopPropagation();
    var e = $(this).find(".custom-option");
    "none" == $(e).css("display") ? (showComboBox(e), $(".custom-option").each(function () {
        $(this).is(e) || $(this).is(":hidden") || hideComboBox(this)
    })) : hideComboBox(e)
}

function hideComboBox(t) {
    $(t).stop(!0, !0).animate({opacity: 0}, "fast", function () {
        $(t).css({display: "none"})
    })
}

function showComboBox(t) {
    $(t).css({display: "block", opacity: 0}), $(t).stop(!0, !0).animate({opacity: 1}, "fast")
}

function onSelectOptionHandler(t) {
    t.stopPropagation();
    var e = $(this).parent().parent();
    hideComboBox(e), e = $(e).parent();
    var i = $(this).html(), s = $(this).attr("id");
    $(e).find(".cs-value").attr("value", s), $(e).find("a.text span").html(i);
    var n = $(e).find(".cs-callback").attr("value");
    if (n) {
        var o = {text: i, value: s};
        window[n](o)
    }
}

String.prototype.trim = function () {
    return this.replace(/^s+|s+$/g, "")
};
var traceId = 0;
!function (t) {
    t.QueryString = function (t) {
        if ("" == t) return {};
        for (var e = {}, i = 0; i < t.length; ++i) {
            var s = t[i].split("=");
            2 == s.length && (e[s[0]] = decodeURIComponent(s[1].replace(/\+/g, " ")))
        }
        return e
    }(window.location.search.substr(1).split("&"))
}(jQuery), function () {
    for (var t = 0, e = ["ms", "moz", "webkit", "o"], i = 0; i < e.length && !window.requestAnimationFrame; ++i) window.requestAnimationFrame = window[e[i] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[e[i] + "CancelAnimationFrame"] || window[e[i] + "CancelRequestAnimationFrame"];
    window.requestAnimationFrame || (window.requestAnimationFrame = function (e, i) {
        var s = (new Date).getTime(), n = Math.max(0, 16 - (s - t)), o = window.setTimeout(function () {
            e(s + n)
        }, n);
        return t = s + n, o
    }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function (t) {
        clearTimeout(t)
    })
}(), function (t) {
    function e(e) {
        this.input = e, "password" == e.attr("type") && this.handlePassword(), t(e[0].form).submit(function () {
            e.hasClass("placeholder") && e[0].value == e.attr("placeholder") && (e[0].value = "")
        })
    }

    e.prototype = {
        show: function (t) {
            if ("" === this.input[0].value || t && this.valueIsPlaceholder()) {
                if (this.isPassword) try {
                    this.input[0].setAttribute("type", "text")
                } catch (e) {
                    this.input.before(this.fakePassword.show()).hide()
                }
                this.input.addClass("placeholder"), this.input[0].value = this.input.attr("placeholder")
            }
        }, hide: function () {
            if (this.valueIsPlaceholder() && this.input.hasClass("placeholder") && (this.input.removeClass("placeholder"), this.input[0].value = "", this.isPassword)) {
                try {
                    this.input[0].setAttribute("type", "password")
                } catch (t) {
                }
                this.input.show(), this.input[0].focus()
            }
        }, valueIsPlaceholder: function () {
            return this.input[0].value == this.input.attr("placeholder")
        }, handlePassword: function () {
            var e = this.input;
            if (e.attr("realType", "password"), this.isPassword = !0, t.browser.msie && e[0].outerHTML) {
                var i = t(e[0].outerHTML.replace(/type=(['"])?password\1/gi, "type=$1text$1"));
                this.fakePassword = i.val(e.attr("placeholder")).addClass("placeholder").focus(function () {
                    e.trigger("focus"), t(this).hide()
                }), t(e[0].form).submit(function () {
                    i.remove(), e.show()
                })
            }
        }
    };
    var i = !!("placeholder" in document.createElement("input"));
    t.fn.placeholder = function () {
        return i ? this : this.each(function () {
            var i = t(this), s = new e(i);
            s.show(!0), i.focus(function () {
                s.hide()
            }), i.blur(function () {
                s.show(!1)
            }), t.browser.msie && (t(window).load(function () {
                i.val() && i.removeClass("placeholder"), s.show(!0)
            }), i.focus(function () {
                if ("" == this.value) {
                    var t = this.createTextRange();
                    t.collapse(!0), t.moveStart("character", 0), t.select()
                }
            }))
        })
    }
}(jQuery), function (t, e) {
    jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
        def: "easeOutQuad", swing: function (e, i, s, n, o) {
            return t.easing[t.easing.def](e, i, s, n, o)
        }, easeInQuad: function (t, e, i, s, n) {
            return s * (e /= n) * e + i
        }, easeOutQuad: function (t, e, i, s, n) {
            return -s * (e /= n) * (e - 2) + i
        }, easeInOutQuad: function (t, e, i, s, n) {
            return (e /= n / 2) < 1 ? s / 2 * e * e + i : -s / 2 * (--e * (e - 2) - 1) + i
        }, easeInCubic: function (t, e, i, s, n) {
            return s * (e /= n) * e * e + i
        }, easeOutCubic: function (t, e, i, s, n) {
            return s * ((e = e / n - 1) * e * e + 1) + i
        }, easeInOutCubic: function (t, e, i, s, n) {
            return (e /= n / 2) < 1 ? s / 2 * e * e * e + i : s / 2 * ((e -= 2) * e * e + 2) + i
        }, easeInQuart: function (t, e, i, s, n) {
            return s * (e /= n) * e * e * e + i
        }, easeOutQuart: function (t, e, i, s, n) {
            return -s * ((e = e / n - 1) * e * e * e - 1) + i
        }, easeInOutQuart: function (t, e, i, s, n) {
            return (e /= n / 2) < 1 ? s / 2 * e * e * e * e + i : -s / 2 * ((e -= 2) * e * e * e - 2) + i
        }, easeInQuint: function (t, e, i, s, n) {
            return s * (e /= n) * e * e * e * e + i
        }, easeOutQuint: function (t, e, i, s, n) {
            return s * ((e = e / n - 1) * e * e * e * e + 1) + i
        }, easeInOutQuint: function (t, e, i, s, n) {
            return (e /= n / 2) < 1 ? s / 2 * e * e * e * e * e + i : s / 2 * ((e -= 2) * e * e * e * e + 2) + i
        }, easeInSine: function (t, e, i, s, n) {
            return -s * Math.cos(e / n * (Math.PI / 2)) + s + i
        }, easeOutSine: function (t, e, i, s, n) {
            return s * Math.sin(e / n * (Math.PI / 2)) + i
        }, easeInOutSine: function (t, e, i, s, n) {
            return -s / 2 * (Math.cos(Math.PI * e / n) - 1) + i
        }, easeInExpo: function (t, e, i, s, n) {
            return 0 == e ? i : s * Math.pow(2, 10 * (e / n - 1)) + i
        }, easeOutExpo: function (t, e, i, s, n) {
            return e == n ? i + s : s * (-Math.pow(2, -10 * e / n) + 1) + i
        }, easeInOutExpo: function (t, e, i, s, n) {
            return 0 == e ? i : e == n ? i + s : (e /= n / 2) < 1 ? s / 2 * Math.pow(2, 10 * (e - 1)) + i : s / 2 * (-Math.pow(2, -10 * --e) + 2) + i
        }, easeInCirc: function (t, e, i, s, n) {
            return -s * (Math.sqrt(1 - (e /= n) * e) - 1) + i
        }, easeOutCirc: function (t, e, i, s, n) {
            return s * Math.sqrt(1 - (e = e / n - 1) * e) + i
        }, easeInOutCirc: function (t, e, i, s, n) {
            return (e /= n / 2) < 1 ? -s / 2 * (Math.sqrt(1 - e * e) - 1) + i : s / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + i
        }, easeInElastic: function (t, e, i, s, n) {
            var o = 1.70158, a = 0, r = s;
            if (0 == e) return i;
            if (1 == (e /= n)) return i + s;
            if (a || (a = .3 * n), r < Math.abs(s)) {
                r = s;
                var o = a / 4
            } else var o = a / (2 * Math.PI) * Math.asin(s / r);
            return -(r * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * n - o) * (2 * Math.PI) / a)) + i
        }, easeOutElastic: function (t, e, i, s, n) {
            var o = 1.70158, a = 0, r = s;
            if (0 == e) return i;
            if (1 == (e /= n)) return i + s;
            if (a || (a = .3 * n), r < Math.abs(s)) {
                r = s;
                var o = a / 4
            } else var o = a / (2 * Math.PI) * Math.asin(s / r);
            return r * Math.pow(2, -10 * e) * Math.sin((e * n - o) * (2 * Math.PI) / a) + s + i
        }, easeInOutElastic: function (t, e, i, s, n) {
            var o = 1.70158, a = 0, r = s;
            if (0 == e) return i;
            if (2 == (e /= n / 2)) return i + s;
            if (a || (a = n * (.3 * 1.5)), r < Math.abs(s)) {
                r = s;
                var o = a / 4
            } else var o = a / (2 * Math.PI) * Math.asin(s / r);
            return 1 > e ? -.5 * (r * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * n - o) * (2 * Math.PI) / a)) + i : r * Math.pow(2, -10 * (e -= 1)) * Math.sin((e * n - o) * (2 * Math.PI) / a) * .5 + s + i
        }, easeInBack: function (t, i, s, n, o, a) {
            return a == e && (a = 1.70158), n * (i /= o) * i * ((a + 1) * i - a) + s
        }, easeOutBack: function (t, i, s, n, o, a) {
            return a == e && (a = 1.70158), n * ((i = i / o - 1) * i * ((a + 1) * i + a) + 1) + s
        }, easeInOutBack: function (t, i, s, n, o, a) {
            return a == e && (a = 1.70158), (i /= o / 2) < 1 ? n / 2 * (i * i * (((a *= 1.525) + 1) * i - a)) + s : n / 2 * ((i -= 2) * i * (((a *= 1.525) + 1) * i + a) + 2) + s
        }, easeInBounce: function (t, e, i, s, n) {
            return s - jQuery.easing.easeOutBounce(t, n - e, 0, s, n) + i
        }, easeOutBounce: function (t, e, i, s, n) {
            return (e /= n) < 1 / 2.75 ? s * (7.5625 * e * e) + i : 2 / 2.75 > e ? s * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + i : 2.5 / 2.75 > e ? s * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + i : s * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + i
        }, easeInOutBounce: function (t, e, i, s, n) {
            return n / 2 > e ? .5 * jQuery.easing.easeInBounce(t, 2 * e, 0, s, n) + i : .5 * jQuery.easing.easeOutBounce(t, 2 * e - n, 0, s, n) + .5 * s + i
        }
    })
}(jQuery), function () {
    "use strict";

    function t() {
    }

    function e(t, e) {
        for (var i = t.length; i--;) if (t[i].listener === e) return i;
        return -1
    }

    var i = t.prototype;
    i.getListeners = function (t) {
        var e, i, s = this._getEvents();
        if ("object" == typeof t) {
            e = {};
            for (i in s) s.hasOwnProperty(i) && t.test(i) && (e[i] = s[i])
        } else e = s[t] || (s[t] = []);
        return e
    }, i.flattenListeners = function (t) {
        var e, i = [];
        for (e = 0; t.length > e; e += 1) i.push(t[e].listener);
        return i
    }, i.getListenersAsObject = function (t) {
        var e, i = this.getListeners(t);
        return i instanceof Array && (e = {}, e[t] = i), e || i
    }, i.addListener = function (t, i) {
        var s, n = this.getListenersAsObject(t), o = "object" == typeof i;
        for (s in n) n.hasOwnProperty(s) && -1 === e(n[s], i) && n[s].push(o ? i : {listener: i, once: !1});
        return this
    }, i.on = i.addListener, i.addOnceListener = function (t, e) {
        return this.addListener(t, {listener: e, once: !0})
    }, i.once = i.addOnceListener, i.defineEvent = function (t) {
        return this.getListeners(t), this
    }, i.defineEvents = function (t) {
        for (var e = 0; t.length > e; e += 1) this.defineEvent(t[e]);
        return this
    }, i.removeListener = function (t, i) {
        var s, n, o = this.getListenersAsObject(t);
        for (n in o) o.hasOwnProperty(n) && (s = e(o[n], i), -1 !== s && o[n].splice(s, 1));
        return this
    }, i.off = i.removeListener, i.addListeners = function (t, e) {
        return this.manipulateListeners(!1, t, e)
    }, i.removeListeners = function (t, e) {
        return this.manipulateListeners(!0, t, e)
    }, i.manipulateListeners = function (t, e, i) {
        var s, n, o = t ? this.removeListener : this.addListener, a = t ? this.removeListeners : this.addListeners;
        if ("object" != typeof e || e instanceof RegExp) for (s = i.length; s--;) o.call(this, e, i[s]); else for (s in e) e.hasOwnProperty(s) && (n = e[s]) && ("function" == typeof n ? o.call(this, s, n) : a.call(this, s, n));
        return this
    }, i.removeEvent = function (t) {
        var e, i = typeof t, s = this._getEvents();
        if ("string" === i) delete s[t]; else if ("object" === i) for (e in s) s.hasOwnProperty(e) && t.test(e) && delete s[e]; else delete this._events;
        return this
    }, i.emitEvent = function (t, e) {
        var i, s, n, o, a = this.getListenersAsObject(t);
        for (n in a) if (a.hasOwnProperty(n)) for (s = a[n].length; s--;) i = a[n][s], o = i.listener.apply(this, e || []), (o === this._getOnceReturnValue() || i.once === !0) && this.removeListener(t, a[n][s].listener);
        return this
    }, i.trigger = i.emitEvent, i.emit = function (t) {
        var e = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(t, e)
    }, i.setOnceReturnValue = function (t) {
        return this._onceReturnValue = t, this
    }, i._getOnceReturnValue = function () {
        return this.hasOwnProperty("_onceReturnValue") ? this._onceReturnValue : !0
    }, i._getEvents = function () {
        return this._events || (this._events = {})
    }, "function" == typeof define && define.amd ? define(function () {
        return t
    }) : "undefined" != typeof module && module.exports ? module.exports = t : this.EventEmitter = t
}.call(this), function (t) {
    "use strict";
    var e = document.documentElement, i = function () {
    };
    e.addEventListener ? i = function (t, e, i) {
        t.addEventListener(e, i, !1)
    } : e.attachEvent && (i = function (e, i, s) {
        e[i + s] = s.handleEvent ? function () {
            var e = t.event;
            e.target = e.target || e.srcElement, s.handleEvent.call(s, e)
        } : function () {
            var i = t.event;
            i.target = i.target || i.srcElement, s.call(e, i)
        }, e.attachEvent("on" + i, e[i + s])
    });
    var s = function () {
    };
    e.removeEventListener ? s = function (t, e, i) {
        t.removeEventListener(e, i, !1)
    } : e.detachEvent && (s = function (t, e, i) {
        t.detachEvent("on" + e, t[e + i]);
        try {
            delete t[e + i]
        } catch (s) {
            t[e + i] = void 0
        }
    });
    var n = {bind: i, unbind: s};
    "function" == typeof define && define.amd ? define(n) : t.eventie = n
}(this), function (t) {
    "use strict";

    function e(t, e) {
        for (var i in e) t[i] = e[i];
        return t
    }

    function i(t) {
        return "[object Array]" === l.call(t)
    }

    function s(t) {
        var e = [];
        if (i(t)) e = t; else if ("number" == typeof t.length) for (var s = 0, n = t.length; n > s; s++) e.push(t[s]); else e.push(t);
        return e
    }

    function n(t, i) {
        function n(t, i, a) {
            if (!(this instanceof n)) return new n(t, i);
            "string" == typeof t && (t = document.querySelectorAll(t)), this.elements = s(t), this.options = e({}, this.options), "function" == typeof i ? a = i : e(this.options, i), a && this.on("always", a), this.getImages(), o && (this.jqDeferred = new o.Deferred);
            var r = this;
            setTimeout(function () {
                r.check()
            })
        }

        function l(t) {
            this.img = t
        }

        n.prototype = new t, n.prototype.options = {}, n.prototype.getImages = function () {
            this.images = [];
            for (var t = 0, e = this.elements.length; e > t; t++) {
                var i = this.elements[t];
                "IMG" === i.nodeName && this.addImage(i);
                for (var s = i.querySelectorAll("img"), n = 0, o = s.length; o > n; n++) {
                    var a = s[n];
                    this.addImage(a)
                }
            }
        }, n.prototype.addImage = function (t) {
            var e = new l(t);
            this.images.push(e)
        }, n.prototype.check = function () {
            function t(t, n) {
                return e.options.debug && r && a.log("confirm", t, n), e.progress(t), i++, i === s && e.complete(), !0
            }

            var e = this, i = 0, s = this.images.length;
            if (this.hasAnyBroken = !1, !s) return void this.complete();
            for (var n = 0; s > n; n++) {
                var o = this.images[n];
                o.on("confirm", t), o.check()
            }
        }, n.prototype.progress = function (t) {
            this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded;
            var e = this;
            setTimeout(function () {
                e.emit("progress", e, t), e.jqDeferred && e.jqDeferred.notify(e, t)
            })
        }, n.prototype.complete = function () {
            var t = this.hasAnyBroken ? "fail" : "done";
            this.isComplete = !0;
            var e = this;
            setTimeout(function () {
                if (e.emit(t, e), e.emit("always", e), e.jqDeferred) {
                    var i = e.hasAnyBroken ? "reject" : "resolve";
                    e.jqDeferred[i](e)
                }
            })
        }, o && (o.fn.imagesLoaded = function (t, e) {
            var i = new n(this, t, e);
            return i.jqDeferred.promise(o(this))
        });
        var h = {};
        return l.prototype = new t, l.prototype.check = function () {
            var t = h[this.img.src];
            if (t) return void this.useCached(t);
            if (h[this.img.src] = this, this.img.complete && void 0 !== this.img.naturalWidth) return void this.confirm(0 !== this.img.naturalWidth, "naturalWidth");
            var e = this.proxyImage = new Image;
            i.bind(e, "load", this), i.bind(e, "error", this), e.src = this.img.src
        }, l.prototype.useCached = function (t) {
            if (t.isConfirmed) this.confirm(t.isLoaded, "cached was confirmed"); else {
                var e = this;
                t.on("confirm", function (t) {
                    return e.confirm(t.isLoaded, "cache emitted confirmed"), !0
                })
            }
        }, l.prototype.confirm = function (t, e) {
            this.isConfirmed = !0, this.isLoaded = t, this.emit("confirm", this, e)
        }, l.prototype.handleEvent = function (t) {
            var e = "on" + t.type;
            this[e] && this[e](t)
        }, l.prototype.onload = function () {
            this.confirm(!0, "onload"), this.unbindProxyEvents()
        }, l.prototype.onerror = function () {
            this.confirm(!1, "onerror"), this.unbindProxyEvents()
        }, l.prototype.unbindProxyEvents = function () {
            i.unbind(this.proxyImage, "load", this), i.unbind(this.proxyImage, "error", this)
        }, n
    }

    var o = t.jQuery, a = t.console, r = void 0 !== a, l = Object.prototype.toString;
    "function" == typeof define && define.amd ? define(["eventEmitter/EventEmitter", "eventie/eventie"], n) : t.imagesLoaded = n(t.EventEmitter, t.eventie)
}(window), function (t) {
    function e(e, i) {
        var s = t(window).height(), n = t(document).width();
        s -= t("nav").height(), t(e, i).each(function () {
            var e = t(this).attr("height"), i = t(this).attr("width"), o = n, a = n / i * e, r = (a - s) / 2 * -1,
                l = 0;
            if (s > a) var o = s / e * i, a = s, r = 0, l = (o - n) / 2 * -1;
            t(this).css({
                visibility: "visible",
                height: a + "px",
                width: o + "px",
                marginLeft: l + "px",
                marginTop: r + "px",
                display: "block"
            })
        })
    }

    var i = "", s = {selector: "img", fillOnResize: !0, defaultCss: !0};
    t.fn.fullscreenBackground = function (n) {
        n && t.extend(s, n), this.each(function () {
            i = this, 1 == s.defaultCss && (t("html,body").css({
                width: "100%",
                height: "100%"
            }), t(i).css({
                width: "100%",
                overflow: "hidden",
                position: "absolute",
                top: t("nav").height(),
                left: "0px",
                zIndex: 1
            }));
            var n = t(window).width();
            1 == s.fillOnResize && t(window).resize(function () {
                n = t(window).width(), t(i).css({top: t("nav").height()}), e(s.selector, i)
            }), e(s.selector, i)
        })
    }
}(jQuery), function (t) {
    function e(t) {
        var e = t.data("_ARS_data");
        return e || (e = {rotateUnits: "deg", scale: 1, rotate: 0}, t.data("_ARS_data", e)), e
    }

    function i(t, e) {
        t.css("transform", "rotate(" + e.rotate + e.rotateUnits + ") scale(" + e.scale + "," + e.scale + ")"), t.css("-webkit-transform", "rotate(" + e.rotate + e.rotateUnits + ") scale(" + e.scale + "," + e.scale + ")"), t.css("-moz-transform", "rotate(" + e.rotate + e.rotateUnits + ") scale(" + e.scale + "," + e.scale + ")")
    }

    t.fn.rotate = function (s) {
        var n, o = t(this), a = e(o);
        return "undefined" == typeof s ? a.rotate + a.rotateUnits : (n = s.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/), n && (n[3] && (a.rotateUnits = n[3]), a.rotate = n[1], i(o, a)), this)
    }, t.fn.scale = function (s) {
        var n = t(this), o = e(n);
        return "undefined" == typeof s ? o.scale : (o.scale = s, i(n, o), this)
    };
    var s = t.fx.prototype.cur;
    t.fx.prototype.cur = function () {
        return "rotate" == this.prop ? parseFloat(t(this.elem).rotate()) : "scale" == this.prop ? parseFloat(t(this.elem).scale()) : s.apply(this, arguments)
    }, t.fx.step.rotate = function (i) {
        var s = e(t(i.elem));
        t(i.elem).rotate(i.now + s.rotateUnits)
    }, t.fx.step.scale = function (e) {
        t(e.elem).scale(e.now)
    };
    var n = t.fn.animate;
    t.fn.animate = function (i) {
        if ("undefined" != typeof i.rotate) {
            var s, o, a = i.rotate.toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            a && a[5] && (s = t(this), o = e(s), o.rotateUnits = a[5]), i.rotate = a[1]
        }
        return n.apply(this, arguments)
    }
}(jQuery), function (t, e, i) {
    function s(i, s, n) {
        var o = e.createElement(i);
        return s && (o.id = Z + s), n && (o.style.cssText = n), t(o)
    }

    function n(t) {
        var e = k.length, i = (L + t) % e;
        return 0 > i ? e + i : i
    }

    function o(t, e) {
        return Math.round((/%/.test(t) ? ("x" === e ? r() : l()) / 100 : 1) * parseInt(t, 10))
    }

    function a(t) {
        return H.photo || /\.(gif|png|jp(e|g|eg)|bmp|ico)((#|\?).*)?$/i.test(t)
    }

    function r() {
        return i.innerWidth || C.width()
    }

    function l() {
        return i.innerHeight || C.height()
    }

    function h() {
        var e, i = t.data(Y, K);
        null == i ? (H = t.extend({}, Q), console && console.log && console.log("Error: cboxElement missing settings object")) : H = t.extend({}, i);
        for (e in H) t.isFunction(H[e]) && "on" !== e.slice(0, 2) && (H[e] = H[e].call(Y));
        H.rel = H.rel || Y.rel || "nofollow", H.href = H.href || t(Y).attr("href"), H.title = H.title || Y.title, "string" == typeof H.href && (H.href = t.trim(H.href))
    }

    function c(e, i) {
        t.event.trigger(e), i && i.call(Y)
    }

    function u() {
        var t, e, i, s = Z + "Slideshow_", n = "click." + Z;
        H.slideshow && k[1] ? (e = function () {
            M.text(H.slideshowStop).unbind(n).bind(et, function () {
                (H.loop || k[L + 1]) && (t = setTimeout($.next, H.slideshowSpeed))
            }).bind(tt, function () {
                clearTimeout(t)
            }).one(n + " " + it, i), g.removeClass(s + "off").addClass(s + "on"), t = setTimeout($.next, H.slideshowSpeed)
        }, i = function () {
            clearTimeout(t), M.text(H.slideshowStart).unbind([et, tt, it, n].join(" ")).one(n, function () {
                $.next(), e()
            }), g.removeClass(s + "on").addClass(s + "off")
        }, H.slideshowAuto ? e() : i()) : g.removeClass(s + "off " + s + "on")
    }

    function d(e) {
        X || (Y = e, h(), k = t(Y), L = 0, "nofollow" !== H.rel && (k = t("." + G).filter(function () {
            var e, i = t.data(this, K);
            return i && (e = i.rel || this.rel), e === H.rel
        }), L = k.index(Y), -1 === L && (k = k.add(Y), L = k.length - 1)), V || (V = B = !0, g.show(), H.returnFocus && t(Y).blur().one(st, function () {
            t(this).focus()
        }), m.css({
            opacity: +H.opacity,
            cursor: H.overlayClose ? "pointer" : "auto"
        }).show(), H.w = o(H.initialWidth, "x"), H.h = o(H.initialHeight, "y"), $.position(), at && C.bind("resize." + rt + " scroll." + rt, function () {
            m.css({width: r(), height: l(), top: C.scrollTop(), left: C.scrollLeft()})
        }).trigger("resize." + rt), c(J, H.onOpen), z.add(I).hide(), E.html(H.close).show()), $.load(!0))
    }

    function p() {
        !g && e.body && (U = !1, C = t(i), g = s(lt).attr({
            id: K,
            "class": ot ? Z + (at ? "IE6" : "IE") : ""
        }).hide(), m = s(lt, "Overlay", at ? "position:absolute" : "").hide(), T = s(lt, "LoadingOverlay").add(s(lt, "LoadingGraphic")), v = s(lt, "Wrapper"), b = s(lt, "Content").append(D = s(lt, "LoadedContent", "width:0; height:0; overflow:hidden"), I = s(lt, "Title"), S = s(lt, "Current"), A = s(lt, "Next"), O = s(lt, "Previous"), M = s(lt, "Slideshow").bind(J, u), E = s(lt, "Close")), v.append(s(lt).append(s(lt, "TopLeft"), y = s(lt, "TopCenter"), s(lt, "TopRight")), s(lt, !1, "clear:left").append(_ = s(lt, "MiddleLeft"), b, w = s(lt, "MiddleRight")), s(lt, !1, "clear:left").append(s(lt, "BottomLeft"), x = s(lt, "BottomCenter"), s(lt, "BottomRight"))).find("div div").css({"float": "left"}), P = s(lt, !1, "position:absolute; width:9999px; visibility:hidden; display:none"), z = A.add(O).add(S).add(M), t(e.body).append(m, g.append(v, P)))
    }

    function f() {
        return g ? (U || (U = !0, N = y.height() + x.height() + b.outerHeight(!0) - b.height(), j = _.width() + w.width() + b.outerWidth(!0) - b.width(), W = D.outerHeight(!0), F = D.outerWidth(!0), g.css({
            "padding-bottom": N,
            "padding-right": j
        }), A.click(function () {
            $.next()
        }), O.click(function () {
            $.prev()
        }), E.click(function () {
            $.close()
        }), m.click(function () {
            H.overlayClose && $.close()
        }), t(e).bind("keydown." + Z, function (t) {
            var e = t.keyCode;
            V && H.escKey && 27 === e && (t.preventDefault(), $.close()), V && H.arrowKey && k[1] && (37 === e ? (t.preventDefault(), O.click()) : 39 === e && (t.preventDefault(), A.click()))
        }), t("." + G, e).live("click", function (t) {
            t.which > 1 || t.shiftKey || t.altKey || t.metaKey || (t.preventDefault(), d(this))
        })), !0) : !1
    }

    var m, g, v, b, y, _, w, x, k, C, D, P, T, I, S, M, A, O, E, z, H, N, j, W, F, Y, L, R, V, B, X, q, $, U, Q = {
            transition: "elastic",
            speed: 300,
            width: !1,
            initialWidth: "600",
            innerWidth: !1,
            maxWidth: !1,
            height: !1,
            initialHeight: "450",
            innerHeight: !1,
            maxHeight: !1,
            scalePhotos: !0,
            scrolling: !0,
            inline: !1,
            html: !1,
            iframe: !1,
            fastIframe: !0,
            photo: !1,
            href: !1,
            title: !1,
            rel: !1,
            opacity: .9,
            preloading: !0,
            current: "image {current} of {total}",
            previous: "previous",
            next: "next",
            close: "close",
            xhrError: "This content failed to load.",
            imgError: "This image failed to load.",
            open: !1,
            returnFocus: !0,
            reposition: !0,
            loop: !0,
            slideshow: !1,
            slideshowAuto: !0,
            slideshowSpeed: 2500,
            slideshowStart: "start slideshow",
            slideshowStop: "stop slideshow",
            onOpen: !1,
            onLoad: !1,
            onComplete: !1,
            onCleanup: !1,
            onClosed: !1,
            overlayClose: !0,
            escKey: !0,
            arrowKey: !0,
            top: !1,
            bottom: !1,
            left: !1,
            right: !1,
            fixed: !1,
            data: void 0
        }, K = "colorbox", Z = "cbox", G = Z + "Element", J = Z + "_open", tt = Z + "_load", et = Z + "_complete",
        it = Z + "_cleanup", st = Z + "_closed", nt = Z + "_purge", ot = !t.support.opacity && !t.support.style,
        at = ot && !i.XMLHttpRequest, rt = Z + "_IE6", lt = "div";
    t.colorbox || (t(p), $ = t.fn[K] = t[K] = function (e, i) {
        var s = this;
        if (e = e || {}, p(), f()) {
            if (!s[0]) {
                if (s.selector) return s;
                s = t("<a/>"), e.open = !0
            }
            i && (e.onComplete = i), s.each(function () {
                t.data(this, K, t.extend({}, t.data(this, K) || Q, e))
            }).addClass(G), (t.isFunction(e.open) && e.open.call(s) || e.open) && d(s[0])
        }
        return s
    }, $.position = function (t, e) {
        function i(t) {
            y[0].style.width = x[0].style.width = b[0].style.width = t.style.width, b[0].style.height = _[0].style.height = w[0].style.height = t.style.height
        }

        var s, n, a, h = 0, c = 0, u = g.offset();
        C.unbind("resize." + Z), g.css({
            top: -9e4,
            left: -9e4
        }), n = C.scrollTop(), a = C.scrollLeft(), H.fixed && !at ? (u.top -= n, u.left -= a, g.css({position: "fixed"})) : (h = n, c = a, g.css({position: "absolute"})), c += H.right !== !1 ? Math.max(r() - H.w - F - j - o(H.right, "x"), 0) : H.left !== !1 ? o(H.left, "x") : Math.round(Math.max(r() - H.w - F - j, 0) / 2), h += H.bottom !== !1 ? Math.max(l() - H.h - W - N - o(H.bottom, "y"), 0) : H.top !== !1 ? o(H.top, "y") : Math.round(Math.max(l() - H.h - W - N, 0) / 2), g.css({
            top: u.top,
            left: u.left
        }), t = g.width() === H.w + F && g.height() === H.h + W ? 0 : t || 0, v[0].style.width = v[0].style.height = "9999px", s = {
            width: H.w + F,
            height: H.h + W,
            top: h,
            left: c
        }, 0 === t && g.css(s), g.dequeue().animate(s, {
            duration: t, complete: function () {
                i(this), B = !1, v[0].style.width = H.w + F + j + "px", v[0].style.height = H.h + W + N + "px", H.reposition && setTimeout(function () {
                    C.bind("resize." + Z, $.position)
                }, 1), e && e()
            }, step: function () {
                i(this)
            }
        })
    }, $.resize = function (t) {
        V && (t = t || {}, t.width && (H.w = o(t.width, "x") - F - j), t.innerWidth && (H.w = o(t.innerWidth, "x")), D.css({width: H.w}), t.height && (H.h = o(t.height, "y") - W - N), t.innerHeight && (H.h = o(t.innerHeight, "y")), !t.innerHeight && !t.height && (D.css({height: "auto"}), H.h = D.height()), D.css({height: H.h}), $.position("none" === H.transition ? 0 : H.speed))
    }, $.prep = function (e) {
        function i() {
            return H.w = H.w || D.width(), H.w = H.mw && H.mw < H.w ? H.mw : H.w, H.w
        }

        function o() {
            return H.h = H.h || D.height(), H.h = H.mh && H.mh < H.h ? H.mh : H.h, H.h
        }

        if (V) {
            var r, l = "none" === H.transition ? 0 : H.speed;
            D.remove(), D = s(lt, "LoadedContent").append(e), D.hide().appendTo(P.show()).css({
                width: i(),
                overflow: H.scrolling ? "auto" : "hidden"
            }).css({height: o()}).prependTo(b), P.hide(), t(R).css({"float": "none"}), at && t("select").not(g.find("select")).filter(function () {
                return "hidden" !== this.style.visibility
            }).css({visibility: "hidden"}).one(it, function () {
                this.style.visibility = "inherit"
            }), r = function () {
                function e() {
                    ot && g[0].style.removeAttribute("filter")
                }

                var i, o, r, h, u, d, p, f = k.length, m = "frameBorder", v = "allowTransparency";
                if (V) {
                    if (h = function () {
                        clearTimeout(q), T.detach().hide(), c(et, H.onComplete)
                    }, ot && R && D.fadeIn(100), I.html(H.title).add(D).show(), f > 1) {
                        if ("string" == typeof H.current && S.html(H.current.replace("{current}", L + 1).replace("{total}", f)).show(), A[H.loop || f - 1 > L ? "show" : "hide"]().html(H.next), O[H.loop || L ? "show" : "hide"]().html(H.previous), H.slideshow && M.show(), H.preloading) for (i = [n(-1), n(1)]; o = k[i.pop()];) p = t.data(o, K), p && p.href ? (u = p.href, t.isFunction(u) && (u = u.call(o))) : u = o.href, a(u) && (d = new Image, d.src = u)
                    } else z.hide();
                    H.iframe ? (r = s("iframe")[0], m in r && (r[m] = 0), v in r && (r[v] = "true"), r.name = Z + +new Date, H.fastIframe ? h() : t(r).one("load", h), r.src = H.href, H.scrolling || (r.scrolling = "no"), t(r).addClass(Z + "Iframe").appendTo(D).one(nt, function () {
                        r.src = "//about:blank"
                    })) : h(), "fade" === H.transition ? g.fadeTo(l, 1, e) : e()
                }
            }, "fade" === H.transition ? g.fadeTo(l, 0, function () {
                $.position(0, r)
            }) : $.position(l, r)
        }
    }, $.load = function (e) {
        var i, n, r = $.prep;
        B = !0, R = !1, Y = k[L], e || h(), c(nt), c(tt, H.onLoad), H.h = H.height ? o(H.height, "y") - W - N : H.innerHeight && o(H.innerHeight, "y"), H.w = H.width ? o(H.width, "x") - F - j : H.innerWidth && o(H.innerWidth, "x"), H.mw = H.w, H.mh = H.h, H.maxWidth && (H.mw = o(H.maxWidth, "x") - F - j, H.mw = H.w && H.w < H.mw ? H.w : H.mw), H.maxHeight && (H.mh = o(H.maxHeight, "y") - W - N, H.mh = H.h && H.h < H.mh ? H.h : H.mh), i = H.href, q = setTimeout(function () {
            T.show().appendTo(b)
        }, 100), H.inline ? (s(lt).hide().insertBefore(t(i)[0]).one(nt, function () {
            t(this).replaceWith(D.children())
        }), r(t(i))) : H.iframe ? r(" ") : H.html ? r(H.html) : a(i) ? (t(R = new Image).addClass(Z + "Photo").error(function () {
            H.title = !1, r(s(lt, "Error").html(H.imgError))
        }).load(function () {
            var t;
            R.onload = null, H.scalePhotos && (n = function () {
                R.height -= R.height * t, R.width -= R.width * t
            }, H.mw && R.width > H.mw && (t = (R.width - H.mw) / R.width, n()), H.mh && R.height > H.mh && (t = (R.height - H.mh) / R.height, n())), H.h && (R.style.marginTop = Math.max(H.h - R.height, 0) / 2 + "px"), k[1] && (H.loop || k[L + 1]) && (R.style.cursor = "pointer", R.onclick = function () {
                $.next()
            }), ot && (R.style.msInterpolationMode = "bicubic"), setTimeout(function () {
                r(R)
            }, 1)
        }), setTimeout(function () {
            R.src = i
        }, 1)) : i && P.load(i, H.data, function (e, i, n) {
            r("error" === i ? s(lt, "Error").html(H.xhrError) : t(this).contents())
        })
    }, $.next = function () {
        !B && k[1] && (H.loop || k[L + 1]) && (L = n(1), $.load())
    }, $.prev = function () {
        !B && k[1] && (H.loop || L) && (L = n(-1), $.load())
    }, $.close = function () {
        V && !X && (X = !0, V = !1, c(it, H.onCleanup), C.unbind("." + Z + " ." + rt), m.fadeTo(200, 0), g.stop().fadeTo(300, 0, function () {
            g.add(m).css({opacity: 1, cursor: "auto"}).hide(), c(nt), D.remove(), setTimeout(function () {
                X = !1, c(st, H.onClosed)
            }, 1)
        }))
    }, $.remove = function () {
        t([]).add(g).add(m).remove(), g = null, t("." + G).removeData(K).removeClass(G).die()
    }, $.element = function () {
        return t(Y)
    }, $.settings = Q)
}(jQuery, document, this), function (t) {
    function e(e, i) {
        function s() {
            return c.update(), o(), c
        }

        function n() {
            var t = y.toLowerCase();
            g.obj.css(b, _ / f.ratio), p.obj.css(b, -_), x.start = g.obj.offset()[b], f.obj.css(t, m[i.axis]), m.obj.css(t, m[i.axis]), g.obj.css(t, g[i.axis])
        }

        function o() {
            k ? d.obj[0].ontouchstart = function (t) {
                1 === t.touches.length && (a(t.touches[0]), t.stopPropagation())
            } : (g.obj.bind("mousedown", a), m.obj.bind("mouseup", l)), i.scroll && window.addEventListener ? (u[0].addEventListener("DOMMouseScroll", r, !1), u[0].addEventListener("mousewheel", r, !1)) : i.scroll && (u[0].onmousewheel = r)
        }

        function a(e) {
            t("body").addClass("g-noSelect");
            var i = parseInt(g.obj.css(b), 10);
            x.start = v ? e.pageX : e.pageY, w.start = "auto" == i ? 0 : i, k ? (document.ontouchmove = function (t) {
                t.preventDefault(), l(t.touches[0])
            }, document.ontouchend = h) : (t(document).bind("mousemove", l), t(document).bind("mouseup", h), g.obj.bind("mouseup", h))
        }

        function r(e) {
            if (p.ratio < 1) {
                var s = e || window.event, n = s.wheelDelta ? s.wheelDelta / 120 : -s.detail / 3;
                _ -= n * i.wheel, _ = Math.min(p[i.axis] - d[i.axis], Math.max(0, _)), g.obj.css(b, _ / f.ratio), p.obj.stop().animate({top: -_}, 750, "easeOutQuart"), (i.lockscroll || _ !== p[i.axis] - d[i.axis] && 0 !== _) && (s = t.event.fix(s), s.preventDefault())
            }
        }

        function l(t) {
            p.ratio < 1 && (i.invertscroll && k ? w.now = Math.min(m[i.axis] - g[i.axis], Math.max(0, w.start + (x.start - (v ? t.pageX : t.pageY)))) : w.now = Math.min(m[i.axis] - g[i.axis], Math.max(0, w.start + ((v ? t.pageX : t.pageY) - x.start))), _ = w.now * f.ratio, p.obj.css(b, -_), g.obj.css(b, w.now))
        }

        function h() {
            t("body").removeClass("g-noSelect"), t(document).unbind("mousemove", l), t(document).unbind("mouseup", h), g.obj.unbind("mouseup", h), document.ontouchmove = document.ontouchend = null
        }

        e.each(function () {
            $(this).removeClass("scroll").addClass("scrolled").wrapInner('<div class="g-viewport"><div class="g-overview"></div></div>').prepend('<div class="g-scrollbar"><div class="g-track"><div class="g-thumb"><div class="g-end"></div></div></div></div>')
        });
        var c = this, u = e, d = {obj: t(".g-viewport", e)}, p = {obj: t(".g-overview", e)},
            f = {obj: t(".g-scrollbar", e)}, m = {obj: t(".g-track", f.obj)}, g = {obj: t(".g-thumb", f.obj)},
            v = "x" === i.axis, b = v ? "left" : "top", y = v ? "Width" : "Height", _ = 0, w = {start: 0, now: 0},
            x = {}, k = "ontouchstart" in document.documentElement;
        return this.update = function (t) {
            d[i.axis] = d.obj[0]["offset" + y], p[i.axis] = p.obj[0]["scroll" + y], p.ratio = d[i.axis] / p[i.axis], f.obj.toggleClass("g-disable", p.ratio >= 1), m[i.axis] = "auto" === i.size ? d[i.axis] : i.size, g[i.axis] = Math.min(m[i.axis], Math.max(0, "auto" === i.sizethumb ? m[i.axis] * p.ratio : i.sizethumb)), f.ratio = "auto" === i.sizethumb ? p[i.axis] / m[i.axis] : (p[i.axis] - d[i.axis]) / (m[i.axis] - g[i.axis]), _ = "relative" === t && p.ratio <= 1 ? Math.min(p[i.axis] - d[i.axis], Math.max(0, _)) : 0, _ = "bottom" === t && p.ratio <= 1 ? p[i.axis] - d[i.axis] : isNaN(parseInt(t, 10)) ? _ : parseInt(t, 10), n()
        }, s()
    }

    t.tiny = t.tiny || {}, t.tiny.scrollbar = {
        options: {
            axis: "y",
            wheel: 40,
            scroll: !0,
            lockscroll: !0,
            size: "auto",
            sizethumb: "auto",
            invertscroll: !1
        }
    }, t.fn.tinyscrollbar = function (i) {
        var s = t.extend({}, t.tiny.scrollbar.options, i);
        return this.each(function () {
            t(this).data("tsb", new e(t(this), s))
        }), this
    }, t.fn.tinyscrollbar_update = function (e) {
        return t(this).data("tsb").update(e)
    }
}(jQuery), !function (t) {
    t.fn.jAlert = function (e) {
        var i = this, s = ["default", "green", "red", "black", "blue", "yellow"],
            n = ["xsm", "sm", "md", "lg", "xlg", "full"], o = ["white", "black"], a = [], r = ["animated"], l = [];
        if (i.length > 1) return i.each(function () {
            t(this).jAlert(i.options)
        }), this;
        if (i.options = t.extend({}, t.fn.jAlert.defaults, e), i.instance = !1, "confirm" == i.options.type && (i.options.content || (i.options.content = i.options.confirmQuestion), i.options.btns = [{
            text: i.options.confirmBtnText,
            theme: "green",
            "class": "confirmBtn",
            closeAlert: !0,
            onClick: i.options.onConfirm
        }, {
            text: i.options.denyBtnText,
            theme: "red",
            "class": "denyBtn",
            closeAlert: !0,
            onClick: i.options.onDeny
        }], i.options.autofocus = i.options.confirmAutofocus), -1 == t.inArray(i.options.theme, s)) return console.log("jAlert Config Error: Invalid theme selection."), !1;
        if (r.push("ja_" + i.options.theme), !i.options.id) {
            var h = Date.now().toString() + Math.floor(1e5 * Math.random());
            i.options.id = "ja_" + h
        }
        if (i.options["class"] && r.push(i.options["class"]), i.options.classes && r.push(i.options.classes), i.options.title || r.push("ja_noTitle"), i.options.size && ("string" == typeof i.options.size && -1 == t.inArray(i.options.size, n) || "object" == typeof i.options.size && ("undefined" == typeof i.options.size.width || "undefined" == typeof i.options.size.height))) return console.log("jAlert Config Error: Invalid size selection (try a preset or make sure you're including height and width in your size object)."), !1;
        if (i.options.size ? "object" == typeof i.options.size ? (a.push("width: " + i.options.size.width + ";"), a.push("height: " + i.options.size.height + ";")) : r.push("ja_" + i.options.size) : r.push("ja_sm"), -1 == t.inArray(i.options.backgroundColor, o)) return console.log("jAlert Config Error: Invalid background color selection."), !1;
        l.push("ja_wrap_" + i.options.backgroundColor), ("object" == typeof i.options.btns || "array" == typeof i.options.btns || i.options.autofocus) && (i.options.closeOnClick = !1), i.options.onOpen = [i.options.onOpen];
        var c = "onload='$.fn.jAlert.mediaLoaded($(this))'", u = "<div class='ja_loader'>Loading...</div>";
        i.options.image ? (i.options.content = "<div class='ja_media_wrap'>" + u + "<img src='" + i.options.image + "' class='ja_img' " + c + "'", i.options.imageWidth && (i.options.content += " style='width: " + i.options.imageWidth + "'"),
            i.options.content += "></div>") : i.options.video ? (i.options.content = "<div class='ja_media_wrap'>" + u + "<div class='ja_video'></div></div>", i.options.onOpen.unshift(function (e) {
            var i = document.createElement("iframe");
            i.src = e.options.video, i.addEventListener ? i.addEventListener("load", function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }, !0) : i.attachEvent ? i.attachEvent("onload", function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }) : i.onload = function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }, e.find(".ja_video").append(i)
        })) : i.options.iframe ? (i.options.iframeHeight || (i.options.iframeHeight = .9 * t(window).height() + "px"), i.options.content = "<div class='ja_media_wrap'>" + u + "</div>", i.options.onOpen.unshift(function (e) {
            var i = document.createElement("iframe");
            i.src = e.options.iframe, i.height = e.options.iframeHeight, i.className = "ja_iframe", i.addEventListener ? i.addEventListener("load", function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }, !0) : i.attachEvent ? i.attachEvent("onload", function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }) : i.onload = function () {
                t.fn.jAlert.mediaLoaded(t(this))
            }, e.find(".ja_media_wrap").append(i)
        })) : i.options.ajax && (i.options.content = "<div class='ja_media_wrap'>" + u + "</div>", onAjaxCallbacks = i.options.onOpen, i.options.onOpen = [function (e) {
            t.ajax(e.options.ajax, {
                async: !0, complete: function (i) {
                    e.find(".ja_media_wrap").replaceWith(i.responseText), t.each(onAjaxCallbacks, function (t, i) {
                        i(e)
                    })
                }, error: function (t) {
                    e.options.onAjaxFail(e, "Error getting content: Code: " + t.status + " : Msg: " + t.statusText)
                }
            })
        }]), i.centerAlert = function () {
            var e = t(window).height(), s = i.instance.height(), n = e - s, o = n / 2;
            o > 200 && (o -= 100), 0 >= o && (o = 0), i.instance.css("margin-top", o + "px"), t("body").css("overflow", "hidden"), n > 5 ? i.instance.parents(".ja_wrap").css("position", "fixed") : (i.instance.parents(".ja_wrap").css("position", "absolute"), t("html, body").animate({scrollTop: o - 50}, 200))
        };
        var d = function (t, e) {
            "hide" == t ? e.removeClass(i.options.showAnimation).addClass(i.options.hideAnimation) : (e.centerAlert(), e.addClass(i.options.showAnimation).removeClass(i.options.hideAnimation).show())
        }, p = function (e) {
            if ("undefined" == typeof e.href && (e.href = ""), "undefined" == typeof e["class"] && (e["class"] = ""), e["class"] += "undefined" == typeof e.theme ? " ja_btn_default" : " ja_btn_" + e.theme, "undefined" == typeof e.text && (e.text = ""), "undefined" == typeof e.id) {
                var i = Date.now().toString() + Math.floor(1e5 * Math.random());
                e.id = "ja_btn_" + i
            }
            return "undefined" == typeof e.target && (e.target = "_self"), "undefined" == typeof e.closeAlert && (e.closeAlert = !0), t("body").on("click", "#" + e.id, function (i) {
                var s = t(this);
                e.closeAlert && s.parents(".jAlert").closeAlert();
                var n = !0;
                return "function" == typeof e.onClick && (n = e.onClick(i, s)), !n || e.closeAlert ? (i.preventDefault(), !1) : n
            }), "<a href='" + e.href + "' id='" + e.id + "' target='" + e.target + "' class='ja_btn " + e["class"] + "'>" + e.text + "</a> "
        };
        i.closeAlert = function (e, s) {
            var n = t(this);
            return 0 != e && (e = !0), n.length && (n.unbind("DOMSubtreeModified"), d("hide", n), window.setTimeout(function () {
                var o = n.parents(".ja_wrap");
                e ? o.remove() : o.hide(), "function" == typeof s ? s(n) : "function" == typeof i.options.onClose && i.options.onClose(n), t(".jAlert").length > 0 ? t(".jAlert:last").centerAlert() : t("body").css("overflow", "auto")
            }, i.options.animationTimeout)), this
        }, i.showAlert = function (e, s, n, o) {
            var a = t(this);
            0 != e && (e = !0), s !== !1 && (s = !0), e && t(".jAlert:visible").closeAlert(s);
            var r = a.parents(".ja_wrap");
            t("body").append(r), d("show", a), "function" == typeof o && (i.options.onClose = o), window.setTimeout(function () {
                "function" == typeof n && n(a)
            }, i.options.animationTimeout)
        };
        var f = function (e) {
            var s = "";
            s += '<div class="ja_wrap ' + l.join(" ") + '"><div class="jAlert ' + r.join(" ") + '" style="' + a.join(" ") + '" id="' + i.options.id + '"><div>', i.options.closeBtn && (s += "<div class='closejAlert ja_close", i.options.closeBtnAlt && (s += " ja_close_alt"), s += "'>X</div>"), i.options.title && (s += "<div class='ja_title'><div>" + i.options.title + "</div></div>"), s += '<div class="ja_body">' + e, i.options.btns && (s += '<div class="ja_btn_wrap ', i.options.btnBackground && (s += "optBack"), s += '">'), "object" == typeof i.options.btns[0] ? t.each(i.options.btns, function (t, e) {
                "object" == typeof e && (s += p(e))
            }) : "object" == typeof i.options.btns ? s += p(i.options.btns) : i.options.btns && console.log("jAlert Config Error: Incorrect value for btns (must be object or array of objects): " + i.options.btns), i.options.btns && (s += "</div>"), s += "</div></div></div></div>";
            var n = t(s);
            return i.options.replaceOtherAlerts && t(".jAlert:visible").closeAlert(), t("body").append(n), i.instance = t("#" + i.options.id), d("show", i.instance), i.options.closeBtn && i.instance.on("click", ".closejAlert", function (e) {
                return e.preventDefault(), t(this).parents(".jAlert").closeAlert(), !1
            }), i.options.closeOnClick && (t(document).off("mouseup", t.fn.jAlert.onMouseUp), t(document).on("mouseup", t.fn.jAlert.onMouseUp)), i.options.closeOnEsc && (t(document).off("keydown", t.fn.jAlert.onEscKeyDown), t(document).on("keydown", t.fn.jAlert.onEscKeyDown)), i.options.onOpen && t.each(i.options.onOpen, function (t, e) {
                e(i.instance)
            }), i.options.autofocus && i.instance.find(i.options.autofocus).focus(), i.instance.bind("DOMSubtreeModified", function () {
                i.instance.centerAlert()
            }), i.instance
        };
        return i.initialize = function () {
            return i.options.content || i.options.image || i.options.video || i.options.iframe || i.options.ajax ? (i.options.content || (i.options.content = ""), f(i.options.content)) : (console.log("jAlert potential error: No content defined"), f(""))
        }, i.initialize(), i
    }, t.fn.jAlert.defaults = {
        title: !1,
        content: !1,
        image: !1,
        imageWidth: "auto",
        video: !1,
        ajax: !1,
        onAjaxFail: function (t, e) {
            t.closeAlert(), errorAlert(e)
        },
        iframe: !1,
        iframeHeight: !1,
        "class": "",
        classes: "",
        id: !1,
        showAnimation: "fadeInUp",
        hideAnimation: "fadeOutDown",
        animationTimeout: 600,
        theme: "default",
        backgroundColor: "black",
        size: !1,
        replaceOtherAlerts: !1,
        closeOnClick: !1,
        closeOnEsc: !0,
        closeBtn: !0,
        closeBtnAlt: !1,
        btns: !1,
        btnBackground: !0,
        autofocus: !1,
        onOpen: function () {
            return !1
        },
        onClose: function () {
            return !1
        },
        type: "modal",
        confirmQuestion: "Are you sure?",
        confirmBtnText: "Yes",
        denyBtnText: "No",
        confirmAutofocus: ".confirmBtn",
        onConfirm: function (t) {
            return t.preventDefault(), console.log("confirmed"), !1
        },
        onDeny: function (t) {
            return t.preventDefault(), !1
        }
    }, t.fn.jAlert.onMouseUp = function () {
        var e = t(".jAlert:visible:last");
        e.options.closeOnClick && e.closeAlert()
    }, t.fn.jAlert.onEscKeyDown = function (e) {
        if (27 === e.keyCode) {
            var i = t(".jAlert:visible:last");
            i.options.closeOnEsc && i.closeAlert()
        }
    }, t.jAlert = function (e) {
        return t.fn.jAlert(e)
    }, t.fn.alertOnClick = function (e) {
        t(this).on("click", function (i) {
            return i.preventDefault(), t.jAlert(e), !1
        })
    }, t.alertOnClick = function (e, i) {
        t("body").on("click", e, function (e) {
            return e.preventDefault(), t.jAlert(i), !1
        })
    };
    var e;
    t(window).resize(function () {
        window.clearTimeout(e), e = window.setTimeout(function () {
            t(".jAlert:visible").each(function () {
                t(this).centerAlert()
            })
        }, 200)
    }), t.fn.jAlert.mediaLoaded = function (t) {
        var e = t.parents(".ja_media_wrap"), i = e.find(".ja_video");
        e.find(".ja_loader").remove(), i.length > 0 ? i.fadeIn("fast") : t.fadeIn("fast"), t.parents(".jAlert").centerAlert()
    }
}(jQuery), rUtils = {}, rUtils.initComboBox = function () {
    $(".custom-select").each(function (t) {
        var e = $(this).find(".cs-value"), i = $(this).find("a.text span");
        $(e).attr("rel", $(i).html())
    }), $(".custom-select").live("click", showHideOptions), $(".custom-option li").live("click", onSelectOptionHandler), $("body").bind("click", onHideSelectOptionHandler), $('.custom-option li[selected="selected"]').click()
}, rUtils.resetComboBox = function () {
    $(".cs-value").attr("value", ""), $(".custom-select").each(function (t) {
        var e = $(this).find(".cs-value"), i = $(this).find("a.text span");
        $(i).html($(e).attr("rel"))
    })
};
var checkboxHeight = "25", radioHeight = "25", selectWidth = "190";
document.write('<style type="text/css">input.styled { display: none; } select.styled { position: relative; width: ' + selectWidth + "px; opacity: 0; filter: alpha(opacity=0); z-index: 5; } .disabled { opacity: 0.5; filter: alpha(opacity=50); }</style>");
var Custom = {
    init: function () {
        var t, e, i, s = document.getElementsByTagName("input"), n = Array();
        for (a = 0; a < s.length; a++) "checkbox" != s[a].type && "radio" != s[a].type || "styled" != s[a].className || (n[a] = document.createElement("span"), n[a].className = s[a].type, 1 == s[a].checked && ("checkbox" == s[a].type ? (position = "0 -" + 2 * checkboxHeight + "px", n[a].style.backgroundPosition = position) : (position = "0 -" + 2 * radioHeight + "px", n[a].style.backgroundPosition = position)), s[a].parentNode.insertBefore(n[a], s[a]), s[a].onchange = Custom.clear, s[a].getAttribute("disabled") ? n[a].className = n[a].className += " disabled" : (n[a].onmousedown = Custom.pushed, n[a].onmouseup = Custom.check));
        for (s = document.getElementsByTagName("select"), a = 0; a < s.length; a++) if ("styled" == s[a].className) {
            for (e = s[a].getElementsByTagName("option"), i = e[0].childNodes[0].nodeValue, t = document.createTextNode(i), b = 0; b < e.length; b++) 1 == e[b].selected && (t = document.createTextNode(e[b].childNodes[0].nodeValue));
            n[a] = document.createElement("span"), n[a].className = "select", n[a].id = "select" + s[a].name, n[a].appendChild(t), s[a].parentNode.insertBefore(n[a], s[a]), s[a].getAttribute("disabled") ? s[a].previousSibling.className = s[a].previousSibling.className += " disabled" : s[a].onchange = Custom.choose
        }
        document.onmouseup = Custom.clear
    }, pushed: function () {
        element = this.nextSibling, element.disabled || (1 == element.checked && "checkbox" == element.type ? this.style.backgroundPosition = "0 -" + 3 * checkboxHeight + "px" : 1 == element.checked && "radio" == element.type ? this.style.backgroundPosition = "0 -" + 3 * radioHeight + "px" : 1 != element.checked && "checkbox" == element.type ? this.style.backgroundPosition = "0 -" + checkboxHeight + "px" : this.style.backgroundPosition = "0 -" + radioHeight + "px")
    }, check: function () {
        if (element = this.nextSibling, !element.disabled) {
            if (1 == element.checked && "checkbox" == element.type) this.style.backgroundPosition = "0 0", element.checked = !1; else {
                if ("checkbox" == element.type) this.style.backgroundPosition = "0 -" + 2 * checkboxHeight + "px"; else for (this.style.backgroundPosition = "0 -" + 2 * radioHeight + "px", group = this.nextSibling.name, inputs = document.getElementsByTagName("input"), a = 0; a < inputs.length; a++) inputs[a].name == group && inputs[a] != this.nextSibling && (inputs[a].previousSibling.style.backgroundPosition = "0 0");
                element.checked = !0
            }
            "function" == typeof checkboxChange && checkboxChange(this.nextSibling), "function" == typeof checkValue && radioChange(this.nextSibling)
        }
    }, clear: function () {
        inputs = document.getElementsByTagName("input");
        for (var t = 0; t < inputs.length; t++) inputs[t].previousSibling && inputs[t].previousSibling.style && ("checkbox" == inputs[t].type && 1 == inputs[t].checked && "styled" == inputs[t].className ? inputs[t].previousSibling.style.backgroundPosition = "0 -" + 2 * checkboxHeight + "px" : "checkbox" == inputs[t].type && "styled" == inputs[t].className ? inputs[t].previousSibling.style.backgroundPosition = "0 0" : "radio" == inputs[t].type && 1 == inputs[t].checked && "styled" == inputs[t].className ? inputs[t].previousSibling.style.backgroundPosition = "0 -" + 2 * radioHeight + "px" : "radio" == inputs[t].type && "styled" == inputs[t].className && (inputs[t].previousSibling.style.backgroundPosition = "0 0"))
    }, choose: function () {
        for (option = this.getElementsByTagName("option"), d = 0; d < option.length; d++) 1 == option[d].selected && (document.getElementById("select" + this.name).childNodes[0].nodeValue = option[d].childNodes[0].nodeValue)
    }
};
window.onload = Custom.init, !function (t) {
    function e(t) {
        var e = t.length, s = i.type(t);
        return "function" === s || i.isWindow(t) ? !1 : 1 === t.nodeType && e ? !0 : "array" === s || 0 === e || "number" == typeof e && e > 0 && e - 1 in t
    }

    if (!t.jQuery) {
        var i = function (t, e) {
            return new i.fn.init(t, e)
        };
        i.isWindow = function (t) {
            return null != t && t == t.window
        }, i.type = function (t) {
            return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? n[a.call(t)] || "object" : typeof t
        }, i.isArray = Array.isArray || function (t) {
            return "array" === i.type(t)
        }, i.isPlainObject = function (t) {
            var e;
            if (!t || "object" !== i.type(t) || t.nodeType || i.isWindow(t)) return !1;
            try {
                if (t.constructor && !o.call(t, "constructor") && !o.call(t.constructor.prototype, "isPrototypeOf")) return !1
            } catch (s) {
                return !1
            }
            for (e in t) ;
            return void 0 === e || o.call(t, e)
        }, i.each = function (t, i, s) {
            var n, o = 0, a = t.length, r = e(t);
            if (s) {
                if (r) for (; a > o && (n = i.apply(t[o], s), n !== !1); o++) ; else for (o in t) if (n = i.apply(t[o], s), n === !1) break
            } else if (r) for (; a > o && (n = i.call(t[o], o, t[o]), n !== !1); o++) ; else for (o in t) if (n = i.call(t[o], o, t[o]), n === !1) break;
            return t
        }, i.data = function (t, e, n) {
            if (void 0 === n) {
                var o = t[i.expando], a = o && s[o];
                if (void 0 === e) return a;
                if (a && e in a) return a[e]
            } else if (void 0 !== e) {
                var o = t[i.expando] || (t[i.expando] = ++i.uuid);
                return s[o] = s[o] || {}, s[o][e] = n, n
            }
        }, i.removeData = function (t, e) {
            var n = t[i.expando], o = n && s[n];
            o && i.each(e, function (t, e) {
                delete o[e]
            })
        }, i.extend = function () {
            var t, e, s, n, o, a, r = arguments[0] || {}, l = 1, h = arguments.length, c = !1;
            for ("boolean" == typeof r && (c = r, r = arguments[l] || {}, l++), "object" != typeof r && "function" !== i.type(r) && (r = {}), l === h && (r = this, l--); h > l; l++) if (null != (o = arguments[l])) for (n in o) t = r[n], s = o[n], r !== s && (c && s && (i.isPlainObject(s) || (e = i.isArray(s))) ? (e ? (e = !1, a = t && i.isArray(t) ? t : []) : a = t && i.isPlainObject(t) ? t : {}, r[n] = i.extend(c, a, s)) : void 0 !== s && (r[n] = s));
            return r
        }, i.queue = function (t, s, n) {
            function o(t, i) {
                var s = i || [];
                return null != t && (e(Object(t)) ? !function (t, e) {
                    for (var i = +e.length, s = 0, n = t.length; i > s;) t[n++] = e[s++];
                    if (i !== i) for (; void 0 !== e[s];) t[n++] = e[s++];
                    return t.length = n, t
                }(s, "string" == typeof t ? [t] : t) : [].push.call(s, t)), s
            }

            if (t) {
                s = (s || "fx") + "queue";
                var a = i.data(t, s);
                return n ? (!a || i.isArray(n) ? a = i.data(t, s, o(n)) : a.push(n), a) : a || []
            }
        }, i.dequeue = function (t, e) {
            i.each(t.nodeType ? [t] : t, function (t, s) {
                e = e || "fx";
                var n = i.queue(s, e), o = n.shift();
                "inprogress" === o && (o = n.shift()), o && ("fx" === e && n.unshift("inprogress"), o.call(s, function () {
                    i.dequeue(s, e)
                }))
            })
        }, i.fn = i.prototype = {
            init: function (t) {
                if (t.nodeType) return this[0] = t, this;
                throw new Error("Not a DOM node.")
            }, offset: function () {
                var e = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : {top: 0, left: 0};
                return {
                    top: e.top + (t.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0),
                    left: e.left + (t.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0)
                }
            }, position: function () {
                function t() {
                    for (var t = this.offsetParent || document; t && "html" === !t.nodeType.toLowerCase && "static" === t.style.position;) t = t.offsetParent;
                    return t || document
                }

                var e = this[0], t = t.apply(e), s = this.offset(),
                    n = /^(?:body|html)$/i.test(t.nodeName) ? {top: 0, left: 0} : i(t).offset();
                return s.top -= parseFloat(e.style.marginTop) || 0, s.left -= parseFloat(e.style.marginLeft) || 0, t.style && (n.top += parseFloat(t.style.borderTopWidth) || 0, n.left += parseFloat(t.style.borderLeftWidth) || 0), {
                    top: s.top - n.top,
                    left: s.left - n.left
                }
            }
        };
        var s = {};
        i.expando = "velocity" + (new Date).getTime(), i.uuid = 0;
        for (var n = {}, o = n.hasOwnProperty, a = n.toString, r = "Boolean Number String Function Array Date RegExp Object Error".split(" "), l = 0; l < r.length; l++) n["[object " + r[l] + "]"] = r[l].toLowerCase();
        i.fn.init.prototype = i.fn, t.Velocity = {Utilities: i}
    }
}(window), function (t) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : t()
}(function () {
    return function (t, e, i, s) {
        function n(t) {
            for (var e = -1, i = t ? t.length : 0, s = []; ++e < i;) {
                var n = t[e];
                n && s.push(n)
            }
            return s
        }

        function o(t) {
            return m.isWrapped(t) ? t = [].slice.call(t) : m.isNode(t) && (t = [t]), t
        }

        function a(t) {
            var e = d.data(t, "velocity");
            return null === e ? s : e
        }

        function r(t) {
            return function (e) {
                return Math.round(e * t) * (1 / t)
            }
        }

        function l(t, i, s, n) {
            function o(t, e) {
                return 1 - 3 * e + 3 * t
            }

            function a(t, e) {
                return 3 * e - 6 * t
            }

            function r(t) {
                return 3 * t
            }

            function l(t, e, i) {
                return ((o(e, i) * t + a(e, i)) * t + r(e)) * t
            }

            function h(t, e, i) {
                return 3 * o(e, i) * t * t + 2 * a(e, i) * t + r(e)
            }

            function c(e, i) {
                for (var n = 0; m > n; ++n) {
                    var o = h(i, t, s);
                    if (0 === o) return i;
                    var a = l(i, t, s) - e;
                    i -= a / o
                }
                return i
            }

            function u() {
                for (var e = 0; y > e; ++e) k[e] = l(e * _, t, s)
            }

            function d(e, i, n) {
                var o, a, r = 0;
                do a = i + (n - i) / 2, o = l(a, t, s) - e, o > 0 ? n = a : i = a; while (Math.abs(o) > v && ++r < b);
                return a
            }

            function p(e) {
                for (var i = 0, n = 1, o = y - 1; n != o && k[n] <= e; ++n) i += _;
                --n;
                var a = (e - k[n]) / (k[n + 1] - k[n]), r = i + a * _, l = h(r, t, s);
                return l >= g ? c(e, r) : 0 == l ? r : d(e, i, i + _)
            }

            function f() {
                C = !0, (t != i || s != n) && u()
            }

            var m = 4, g = .001, v = 1e-7, b = 10, y = 11, _ = 1 / (y - 1), w = "Float32Array" in e;
            if (4 !== arguments.length) return !1;
            for (var x = 0; 4 > x; ++x) if ("number" != typeof arguments[x] || isNaN(arguments[x]) || !isFinite(arguments[x])) return !1;
            t = Math.min(t, 1), s = Math.min(s, 1), t = Math.max(t, 0), s = Math.max(s, 0);
            var k = w ? new Float32Array(y) : new Array(y), C = !1, D = function (e) {
                return C || f(), t === i && s === n ? e : 0 === e ? 0 : 1 === e ? 1 : l(p(e), i, n)
            };
            D.getControlPoints = function () {
                return [{x: t, y: i}, {x: s, y: n}]
            };
            var P = "generateBezier(" + [t, i, s, n] + ")";
            return D.toString = function () {
                return P
            }, D
        }

        function h(t, e) {
            var i = t;
            return m.isString(t) ? y.Easings[t] || (i = !1) : i = m.isArray(t) && 1 === t.length ? r.apply(null, t) : m.isArray(t) && 2 === t.length ? _.apply(null, t.concat([e])) : m.isArray(t) && 4 === t.length ? l.apply(null, t) : !1, i === !1 && (i = y.Easings[y.defaults.easing] ? y.defaults.easing : b), i
        }

        function c(t) {
            if (t) {
                var e = (new Date).getTime(), i = y.State.calls.length;
                i > 1e4 && (y.State.calls = n(y.State.calls));
                for (var o = 0; i > o; o++) if (y.State.calls[o]) {
                    var r = y.State.calls[o], l = r[0], h = r[2], p = r[3], f = !!p, g = null;
                    p || (p = y.State.calls[o][3] = e - 16);
                    for (var v = Math.min((e - p) / h.duration, 1), b = 0, _ = l.length; _ > b; b++) {
                        var x = l[b], C = x.element;
                        if (a(C)) {
                            var D = !1;
                            if (h.display !== s && null !== h.display && "none" !== h.display) {
                                if ("flex" === h.display) {
                                    var P = ["-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex"];
                                    d.each(P, function (t, e) {
                                        w.setPropertyValue(C, "display", e)
                                    })
                                }
                                w.setPropertyValue(C, "display", h.display)
                            }
                            h.visibility !== s && "hidden" !== h.visibility && w.setPropertyValue(C, "visibility", h.visibility);
                            for (var T in x) if ("element" !== T) {
                                var I, S = x[T], M = m.isString(S.easing) ? y.Easings[S.easing] : S.easing;
                                if (1 === v) I = S.endValue; else {
                                    var A = S.endValue - S.startValue;
                                    if (I = S.startValue + A * M(v, h, A), !f && I === S.currentValue) continue
                                }
                                if (S.currentValue = I, "tween" === T) g = I; else {
                                    if (w.Hooks.registered[T]) {
                                        var O = w.Hooks.getRoot(T), E = a(C).rootPropertyValueCache[O];
                                        E && (S.rootPropertyValue = E)
                                    }
                                    var z = w.setPropertyValue(C, T, S.currentValue + (0 === parseFloat(I) ? "" : S.unitType), S.rootPropertyValue, S.scrollData);
                                    w.Hooks.registered[T] && (a(C).rootPropertyValueCache[O] = w.Normalizations.registered[O] ? w.Normalizations.registered[O]("extract", null, z[1]) : z[1]), "transform" === z[0] && (D = !0)
                                }
                            }
                            h.mobileHA && a(C).transformCache.translate3d === s && (a(C).transformCache.translate3d = "(0px, 0px, 0px)", D = !0), D && w.flushTransformCache(C)
                        }
                    }
                    h.display !== s && "none" !== h.display && (y.State.calls[o][2].display = !1), h.visibility !== s && "hidden" !== h.visibility && (y.State.calls[o][2].visibility = !1), h.progress && h.progress.call(r[1], r[1], v, Math.max(0, p + h.duration - e), p, g), 1 === v && u(o)
                }
            }
            y.State.isTicking && k(c)
        }

        function u(t, e) {
            if (!y.State.calls[t]) return !1;
            for (var i = y.State.calls[t][0], n = y.State.calls[t][1], o = y.State.calls[t][2], r = y.State.calls[t][4], l = !1, h = 0, c = i.length; c > h; h++) {
                var u = i[h].element;
                if (e || o.loop || ("none" === o.display && w.setPropertyValue(u, "display", o.display), "hidden" === o.visibility && w.setPropertyValue(u, "visibility", o.visibility)), o.loop !== !0 && (d.queue(u)[1] === s || !/\.velocityQueueEntryFlag/i.test(d.queue(u)[1])) && a(u)) {
                    a(u).isAnimating = !1, a(u).rootPropertyValueCache = {};
                    var p = !1;
                    d.each(w.Lists.transforms3D, function (t, e) {
                        var i = /^scale/.test(e) ? 1 : 0, n = a(u).transformCache[e];
                        a(u).transformCache[e] !== s && new RegExp("^\\(" + i + "[^.]").test(n) && (p = !0, delete a(u).transformCache[e])
                    }), o.mobileHA && (p = !0, delete a(u).transformCache.translate3d), p && w.flushTransformCache(u), w.Values.removeClass(u, "velocity-animating")
                }
                if (!e && o.complete && !o.loop && h === c - 1) try {
                    o.complete.call(n, n)
                } catch (f) {
                    setTimeout(function () {
                        throw f
                    }, 1)
                }
                r && o.loop !== !0 && r(n), a(u) && o.loop === !0 && !e && (d.each(a(u).tweensContainer, function (t, e) {
                    /^rotate/.test(t) && 360 === parseFloat(e.endValue) && (e.endValue = 0, e.startValue = 360), /^backgroundPosition/.test(t) && 100 === parseFloat(e.endValue) && "%" === e.unitType && (e.endValue = 0, e.startValue = 100)
                }), y(u, "reverse", {loop: !0, delay: o.delay})), o.queue !== !1 && d.dequeue(u, o.queue)
            }
            y.State.calls[t] = !1;
            for (var m = 0, g = y.State.calls.length; g > m; m++) if (y.State.calls[m] !== !1) {
                l = !0;
                break
            }
            l === !1 && (y.State.isTicking = !1, delete y.State.calls, y.State.calls = [])
        }

        var d, p = function () {
            if (i.documentMode) return i.documentMode;
            for (var t = 7; t > 4; t--) {
                var e = i.createElement("div");
                if (e.innerHTML = "<!--[if IE " + t + "]><span></span><![endif]-->", e.getElementsByTagName("span").length) return e = null, t
            }
            return s
        }(), f = function () {
            var t = 0;
            return e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || function (e) {
                var i, s = (new Date).getTime();
                return i = Math.max(0, 16 - (s - t)), t = s + i, setTimeout(function () {
                    e(s + i)
                }, i)
            }
        }(), m = {
            isString: function (t) {
                return "string" == typeof t
            }, isArray: Array.isArray || function (t) {
                return "[object Array]" === Object.prototype.toString.call(t)
            }, isFunction: function (t) {
                return "[object Function]" === Object.prototype.toString.call(t)
            }, isNode: function (t) {
                return t && t.nodeType
            }, isNodeList: function (t) {
                return "object" == typeof t && /^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(t)) && t.length !== s && (0 === t.length || "object" == typeof t[0] && t[0].nodeType > 0)
            }, isWrapped: function (t) {
                return t && (t.jquery || e.Zepto && e.Zepto.zepto.isZ(t))
            }, isSVG: function (t) {
                return e.SVGElement && t instanceof e.SVGElement
            }, isEmptyObject: function (t) {
                for (var e in t) return !1;
                return !0
            }
        }, g = !1;
        if (t.fn && t.fn.jquery ? (d = t, g = !0) : d = e.Velocity.Utilities, 8 >= p && !g) throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
        if (7 >= p) return void (jQuery.fn.velocity = jQuery.fn.animate);
        var v = 400, b = "swing", y = {
            State: {
                isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                isAndroid: /Android/i.test(navigator.userAgent),
                isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
                isChrome: e.chrome,
                isFirefox: /Firefox/i.test(navigator.userAgent),
                prefixElement: i.createElement("div"),
                prefixMatches: {},
                scrollAnchor: null,
                scrollPropertyLeft: null,
                scrollPropertyTop: null,
                isTicking: !1,
                calls: []
            },
            CSS: {},
            Utilities: d,
            Redirects: {},
            Easings: {},
            Promise: e.Promise,
            defaults: {
                queue: "",
                duration: v,
                easing: b,
                begin: s,
                complete: s,
                progress: s,
                display: s,
                visibility: s,
                loop: !1,
                delay: !1,
                mobileHA: !0,
                _cacheValues: !0
            },
            init: function (t) {
                d.data(t, "velocity", {
                    isSVG: m.isSVG(t),
                    isAnimating: !1,
                    computedStyle: null,
                    tweensContainer: null,
                    rootPropertyValueCache: {},
                    transformCache: {}
                })
            },
            hook: null,
            mock: !1,
            version: {major: 1, minor: 2, patch: 2},
            debug: !1
        };
        e.pageYOffset !== s ? (y.State.scrollAnchor = e, y.State.scrollPropertyLeft = "pageXOffset", y.State.scrollPropertyTop = "pageYOffset") : (y.State.scrollAnchor = i.documentElement || i.body.parentNode || i.body, y.State.scrollPropertyLeft = "scrollLeft", y.State.scrollPropertyTop = "scrollTop");
        var _ = function () {
            function t(t) {
                return -t.tension * t.x - t.friction * t.v
            }

            function e(e, i, s) {
                var n = {x: e.x + s.dx * i, v: e.v + s.dv * i, tension: e.tension, friction: e.friction};
                return {dx: n.v, dv: t(n)}
            }

            function i(i, s) {
                var n = {dx: i.v, dv: t(i)}, o = e(i, .5 * s, n), a = e(i, .5 * s, o), r = e(i, s, a),
                    l = 1 / 6 * (n.dx + 2 * (o.dx + a.dx) + r.dx), h = 1 / 6 * (n.dv + 2 * (o.dv + a.dv) + r.dv);
                return i.x = i.x + l * s, i.v = i.v + h * s, i
            }

            return function s(t, e, n) {
                var o, a, r, l = {x: -1, v: 0, tension: null, friction: null}, h = [0], c = 0, u = 1e-4, d = .016;
                for (t = parseFloat(t) || 500, e = parseFloat(e) || 20, n = n || null, l.tension = t, l.friction = e, o = null !== n, o ? (c = s(t, e), a = c / n * d) : a = d; r = i(r || l, a), h.push(1 + r.x), c += 16, Math.abs(r.x) > u && Math.abs(r.v) > u;) ;
                return o ? function (t) {
                    return h[t * (h.length - 1) | 0]
                } : c
            }
        }();
        y.Easings = {
            linear: function (t) {
                return t
            }, swing: function (t) {
                return .5 - Math.cos(t * Math.PI) / 2
            }, spring: function (t) {
                return 1 - Math.cos(4.5 * t * Math.PI) * Math.exp(6 * -t)
            }
        }, d.each([["ease", [.25, .1, .25, 1]], ["ease-in", [.42, 0, 1, 1]], ["ease-out", [0, 0, .58, 1]], ["ease-in-out", [.42, 0, .58, 1]], ["easeInSine", [.47, 0, .745, .715]], ["easeOutSine", [.39, .575, .565, 1]], ["easeInOutSine", [.445, .05, .55, .95]], ["easeInQuad", [.55, .085, .68, .53]], ["easeOutQuad", [.25, .46, .45, .94]], ["easeInOutQuad", [.455, .03, .515, .955]], ["easeInCubic", [.55, .055, .675, .19]], ["easeOutCubic", [.215, .61, .355, 1]], ["easeInOutCubic", [.645, .045, .355, 1]], ["easeInQuart", [.895, .03, .685, .22]], ["easeOutQuart", [.165, .84, .44, 1]], ["easeInOutQuart", [.77, 0, .175, 1]], ["easeInQuint", [.755, .05, .855, .06]], ["easeOutQuint", [.23, 1, .32, 1]], ["easeInOutQuint", [.86, 0, .07, 1]], ["easeInExpo", [.95, .05, .795, .035]], ["easeOutExpo", [.19, 1, .22, 1]], ["easeInOutExpo", [1, 0, 0, 1]], ["easeInCirc", [.6, .04, .98, .335]], ["easeOutCirc", [.075, .82, .165, 1]], ["easeInOutCirc", [.785, .135, .15, .86]]], function (t, e) {
            y.Easings[e[0]] = l.apply(null, e[1])
        });
        var w = y.CSS = {
            RegEx: {
                isHex: /^#([A-f\d]{3}){1,2}$/i,
                valueUnwrap: /^[A-z]+\((.*)\)$/i,
                wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi
            },
            Lists: {
                colors: ["fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor"],
                transformsBase: ["translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ"],
                transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"]
            },
            Hooks: {
                templates: {
                    textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                    boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                    clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                    backgroundPosition: ["X Y", "0% 0%"],
                    transformOrigin: ["X Y Z", "50% 50% 0px"],
                    perspectiveOrigin: ["X Y", "50% 50%"]
                }, registered: {}, register: function () {
                    for (var t = 0; t < w.Lists.colors.length; t++) {
                        var e = "color" === w.Lists.colors[t] ? "0 0 0 1" : "255 255 255 1";
                        w.Hooks.templates[w.Lists.colors[t]] = ["Red Green Blue Alpha", e]
                    }
                    var i, s, n;
                    if (p) for (i in w.Hooks.templates) {
                        s = w.Hooks.templates[i], n = s[0].split(" ");
                        var o = s[1].match(w.RegEx.valueSplit);
                        "Color" === n[0] && (n.push(n.shift()), o.push(o.shift()), w.Hooks.templates[i] = [n.join(" "), o.join(" ")])
                    }
                    for (i in w.Hooks.templates) {
                        s = w.Hooks.templates[i], n = s[0].split(" ");
                        for (var t in n) {
                            var a = i + n[t], r = t;
                            w.Hooks.registered[a] = [i, r]
                        }
                    }
                }, getRoot: function (t) {
                    var e = w.Hooks.registered[t];
                    return e ? e[0] : t
                }, cleanRootPropertyValue: function (t, e) {
                    return w.RegEx.valueUnwrap.test(e) && (e = e.match(w.RegEx.valueUnwrap)[1]), w.Values.isCSSNullValue(e) && (e = w.Hooks.templates[t][1]), e
                }, extractValue: function (t, e) {
                    var i = w.Hooks.registered[t];
                    if (i) {
                        var s = i[0], n = i[1];
                        return e = w.Hooks.cleanRootPropertyValue(s, e), e.toString().match(w.RegEx.valueSplit)[n]
                    }
                    return e
                }, injectValue: function (t, e, i) {
                    var s = w.Hooks.registered[t];
                    if (s) {
                        var n, o, a = s[0], r = s[1];
                        return i = w.Hooks.cleanRootPropertyValue(a, i), n = i.toString().match(w.RegEx.valueSplit), n[r] = e, o = n.join(" ")
                    }
                    return i
                }
            },
            Normalizations: {
                registered: {
                    clip: function (t, e, i) {
                        switch (t) {
                            case"name":
                                return "clip";
                            case"extract":
                                var s;
                                return w.RegEx.wrappedValueAlreadyExtracted.test(i) ? s = i : (s = i.toString().match(w.RegEx.valueUnwrap), s = s ? s[1].replace(/,(\s+)?/g, " ") : i), s;
                            case"inject":
                                return "rect(" + i + ")"
                        }
                    }, blur: function (t, e, i) {
                        switch (t) {
                            case"name":
                                return y.State.isFirefox ? "filter" : "-webkit-filter";
                            case"extract":
                                var s = parseFloat(i);
                                if (!s && 0 !== s) {
                                    var n = i.toString().match(/blur\(([0-9]+[A-z]+)\)/i);
                                    s = n ? n[1] : 0
                                }
                                return s;
                            case"inject":
                                return parseFloat(i) ? "blur(" + i + ")" : "none"
                        }
                    }, opacity: function (t, e, i) {
                        if (8 >= p) switch (t) {
                            case"name":
                                return "filter";
                            case"extract":
                                var s = i.toString().match(/alpha\(opacity=(.*)\)/i);
                                return i = s ? s[1] / 100 : 1;
                            case"inject":
                                return e.style.zoom = 1, parseFloat(i) >= 1 ? "" : "alpha(opacity=" + parseInt(100 * parseFloat(i), 10) + ")"
                        } else switch (t) {
                            case"name":
                                return "opacity";
                            case"extract":
                                return i;
                            case"inject":
                                return i
                        }
                    }
                }, register: function () {
                    9 >= p || y.State.isGingerbread || (w.Lists.transformsBase = w.Lists.transformsBase.concat(w.Lists.transforms3D));
                    for (var t = 0; t < w.Lists.transformsBase.length; t++) !function () {
                        var e = w.Lists.transformsBase[t];
                        w.Normalizations.registered[e] = function (t, i, n) {
                            switch (t) {
                                case"name":
                                    return "transform";
                                case"extract":
                                    return a(i) === s || a(i).transformCache[e] === s ? /^scale/i.test(e) ? 1 : 0 : a(i).transformCache[e].replace(/[()]/g, "");
                                case"inject":
                                    var o = !1;
                                    switch (e.substr(0, e.length - 1)) {
                                        case"translate":
                                            o = !/(%|px|em|rem|vw|vh|\d)$/i.test(n);
                                            break;
                                        case"scal":
                                        case"scale":
                                            y.State.isAndroid && a(i).transformCache[e] === s && 1 > n && (n = 1), o = !/(\d)$/i.test(n);
                                            break;
                                        case"skew":
                                            o = !/(deg|\d)$/i.test(n);
                                            break;
                                        case"rotate":
                                            o = !/(deg|\d)$/i.test(n)
                                    }
                                    return o || (a(i).transformCache[e] = "(" + n + ")"), a(i).transformCache[e]
                            }
                        }
                    }();
                    for (var t = 0; t < w.Lists.colors.length; t++) !function () {
                        var e = w.Lists.colors[t];
                        w.Normalizations.registered[e] = function (t, i, n) {
                            switch (t) {
                                case"name":
                                    return e;
                                case"extract":
                                    var o;
                                    if (w.RegEx.wrappedValueAlreadyExtracted.test(n)) o = n; else {
                                        var a, r = {
                                            black: "rgb(0, 0, 0)",
                                            blue: "rgb(0, 0, 255)",
                                            gray: "rgb(128, 128, 128)",
                                            green: "rgb(0, 128, 0)",
                                            red: "rgb(255, 0, 0)",
                                            white: "rgb(255, 255, 255)"
                                        };
                                        /^[A-z]+$/i.test(n) ? a = r[n] !== s ? r[n] : r.black : w.RegEx.isHex.test(n) ? a = "rgb(" + w.Values.hexToRgb(n).join(" ") + ")" : /^rgba?\(/i.test(n) || (a = r.black), o = (a || n).toString().match(w.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")
                                    }
                                    return 8 >= p || 3 !== o.split(" ").length || (o += " 1"), o;
                                case"inject":
                                    return 8 >= p ? 4 === n.split(" ").length && (n = n.split(/\s+/).slice(0, 3).join(" ")) : 3 === n.split(" ").length && (n += " 1"), (8 >= p ? "rgb" : "rgba") + "(" + n.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")"
                            }
                        }
                    }()
                }
            },
            Names: {
                camelCase: function (t) {
                    return t.replace(/-(\w)/g, function (t, e) {
                        return e.toUpperCase()
                    })
                }, SVGAttribute: function (t) {
                    var e = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                    return (p || y.State.isAndroid && !y.State.isChrome) && (e += "|transform"), new RegExp("^(" + e + ")$", "i").test(t)
                }, prefixCheck: function (t) {
                    if (y.State.prefixMatches[t]) return [y.State.prefixMatches[t], !0];
                    for (var e = ["", "Webkit", "Moz", "ms", "O"], i = 0, s = e.length; s > i; i++) {
                        var n;
                        if (n = 0 === i ? t : e[i] + t.replace(/^\w/, function (t) {
                            return t.toUpperCase()
                        }), m.isString(y.State.prefixElement.style[n])) return y.State.prefixMatches[t] = n, [n, !0]
                    }
                    return [t, !1]
                }
            },
            Values: {
                hexToRgb: function (t) {
                    var e, i = /^#?([a-f\d])([a-f\d])([a-f\d])$/i, s = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;
                    return t = t.replace(i, function (t, e, i, s) {
                        return e + e + i + i + s + s
                    }), e = s.exec(t), e ? [parseInt(e[1], 16), parseInt(e[2], 16), parseInt(e[3], 16)] : [0, 0, 0]
                }, isCSSNullValue: function (t) {
                    return 0 == t || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(t)
                }, getUnitType: function (t) {
                    return /^(rotate|skew)/i.test(t) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(t) ? "" : "px"
                }, getDisplayType: function (t) {
                    var e = t && t.tagName.toString().toLowerCase();
                    return /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(e) ? "inline" : /^(li)$/i.test(e) ? "list-item" : /^(tr)$/i.test(e) ? "table-row" : /^(table)$/i.test(e) ? "table" : /^(tbody)$/i.test(e) ? "table-row-group" : "block"
                }, addClass: function (t, e) {
                    t.classList ? t.classList.add(e) : t.className += (t.className.length ? " " : "") + e
                }, removeClass: function (t, e) {
                    t.classList ? t.classList.remove(e) : t.className = t.className.toString().replace(new RegExp("(^|\\s)" + e.split(" ").join("|") + "(\\s|$)", "gi"), " ")
                }
            },
            getPropertyValue: function (t, i, n, o) {
                function r(t, i) {
                    function n() {
                        h && w.setPropertyValue(t, "display", "none")
                    }

                    var l = 0;
                    if (8 >= p) l = d.css(t, i); else {
                        var h = !1;
                        if (/^(width|height)$/.test(i) && 0 === w.getPropertyValue(t, "display") && (h = !0, w.setPropertyValue(t, "display", w.Values.getDisplayType(t))), !o) {
                            if ("height" === i && "border-box" !== w.getPropertyValue(t, "boxSizing").toString().toLowerCase()) {
                                var c = t.offsetHeight - (parseFloat(w.getPropertyValue(t, "borderTopWidth")) || 0) - (parseFloat(w.getPropertyValue(t, "borderBottomWidth")) || 0) - (parseFloat(w.getPropertyValue(t, "paddingTop")) || 0) - (parseFloat(w.getPropertyValue(t, "paddingBottom")) || 0);
                                return n(), c
                            }
                            if ("width" === i && "border-box" !== w.getPropertyValue(t, "boxSizing").toString().toLowerCase()) {
                                var u = t.offsetWidth - (parseFloat(w.getPropertyValue(t, "borderLeftWidth")) || 0) - (parseFloat(w.getPropertyValue(t, "borderRightWidth")) || 0) - (parseFloat(w.getPropertyValue(t, "paddingLeft")) || 0) - (parseFloat(w.getPropertyValue(t, "paddingRight")) || 0);
                                return n(), u
                            }
                        }
                        var f;
                        f = a(t) === s ? e.getComputedStyle(t, null) : a(t).computedStyle ? a(t).computedStyle : a(t).computedStyle = e.getComputedStyle(t, null), "borderColor" === i && (i = "borderTopColor"), l = 9 === p && "filter" === i ? f.getPropertyValue(i) : f[i], ("" === l || null === l) && (l = t.style[i]), n()
                    }
                    if ("auto" === l && /^(top|right|bottom|left)$/i.test(i)) {
                        var m = r(t, "position");
                        ("fixed" === m || "absolute" === m && /top|left/i.test(i)) && (l = d(t).position()[i] + "px")
                    }
                    return l
                }

                var l;
                if (w.Hooks.registered[i]) {
                    var h = i, c = w.Hooks.getRoot(h);
                    n === s && (n = w.getPropertyValue(t, w.Names.prefixCheck(c)[0])), w.Normalizations.registered[c] && (n = w.Normalizations.registered[c]("extract", t, n)), l = w.Hooks.extractValue(h, n)
                } else if (w.Normalizations.registered[i]) {
                    var u, f;
                    u = w.Normalizations.registered[i]("name", t),
                    "transform" !== u && (f = r(t, w.Names.prefixCheck(u)[0]), w.Values.isCSSNullValue(f) && w.Hooks.templates[i] && (f = w.Hooks.templates[i][1])), l = w.Normalizations.registered[i]("extract", t, f)
                }
                if (!/^[\d-]/.test(l)) if (a(t) && a(t).isSVG && w.Names.SVGAttribute(i)) if (/^(height|width)$/i.test(i)) try {
                    l = t.getBBox()[i]
                } catch (m) {
                    l = 0
                } else l = t.getAttribute(i); else l = r(t, w.Names.prefixCheck(i)[0]);
                return w.Values.isCSSNullValue(l) && (l = 0), y.debug >= 2 && console.log("Get " + i + ": " + l), l
            },
            setPropertyValue: function (t, i, s, n, o) {
                var r = i;
                if ("scroll" === i) o.container ? o.container["scroll" + o.direction] = s : "Left" === o.direction ? e.scrollTo(s, o.alternateValue) : e.scrollTo(o.alternateValue, s); else if (w.Normalizations.registered[i] && "transform" === w.Normalizations.registered[i]("name", t)) w.Normalizations.registered[i]("inject", t, s), r = "transform", s = a(t).transformCache[i]; else {
                    if (w.Hooks.registered[i]) {
                        var l = i, h = w.Hooks.getRoot(i);
                        n = n || w.getPropertyValue(t, h), s = w.Hooks.injectValue(l, s, n), i = h
                    }
                    if (w.Normalizations.registered[i] && (s = w.Normalizations.registered[i]("inject", t, s), i = w.Normalizations.registered[i]("name", t)), r = w.Names.prefixCheck(i)[0], 8 >= p) try {
                        t.style[r] = s
                    } catch (c) {
                        y.debug && console.log("Browser does not support [" + s + "] for [" + r + "]")
                    } else a(t) && a(t).isSVG && w.Names.SVGAttribute(i) ? t.setAttribute(i, s) : t.style[r] = s;
                    y.debug >= 2 && console.log("Set " + i + " (" + r + "): " + s)
                }
                return [r, s]
            },
            flushTransformCache: function (t) {
                function e(e) {
                    return parseFloat(w.getPropertyValue(t, e))
                }

                var i = "";
                if ((p || y.State.isAndroid && !y.State.isChrome) && a(t).isSVG) {
                    var s = {
                        translate: [e("translateX"), e("translateY")],
                        skewX: [e("skewX")],
                        skewY: [e("skewY")],
                        scale: 1 !== e("scale") ? [e("scale"), e("scale")] : [e("scaleX"), e("scaleY")],
                        rotate: [e("rotateZ"), 0, 0]
                    };
                    d.each(a(t).transformCache, function (t) {
                        /^translate/i.test(t) ? t = "translate" : /^scale/i.test(t) ? t = "scale" : /^rotate/i.test(t) && (t = "rotate"), s[t] && (i += t + "(" + s[t].join(" ") + ") ", delete s[t])
                    })
                } else {
                    var n, o;
                    d.each(a(t).transformCache, function (e) {
                        return n = a(t).transformCache[e], "transformPerspective" === e ? (o = n, !0) : (9 === p && "rotateZ" === e && (e = "rotate"), void (i += e + n + " "))
                    }), o && (i = "perspective" + o + " " + i)
                }
                w.setPropertyValue(t, "transform", i)
            }
        };
        w.Hooks.register(), w.Normalizations.register(), y.hook = function (t, e, i) {
            var n = s;
            return t = o(t), d.each(t, function (t, o) {
                if (a(o) === s && y.init(o), i === s) n === s && (n = y.CSS.getPropertyValue(o, e)); else {
                    var r = y.CSS.setPropertyValue(o, e, i);
                    "transform" === r[0] && y.CSS.flushTransformCache(o), n = r
                }
            }), n
        };
        var x = function () {
            function t() {
                return r ? T.promise || null : l
            }

            function n() {
                function t(t) {
                    function u(t, e) {
                        var i = s, n = s, a = s;
                        return m.isArray(t) ? (i = t[0], !m.isArray(t[1]) && /^[\d-]/.test(t[1]) || m.isFunction(t[1]) || w.RegEx.isHex.test(t[1]) ? a = t[1] : (m.isString(t[1]) && !w.RegEx.isHex.test(t[1]) || m.isArray(t[1])) && (n = e ? t[1] : h(t[1], r.duration), t[2] !== s && (a = t[2]))) : i = t, e || (n = n || r.easing), m.isFunction(i) && (i = i.call(o, C, k)), m.isFunction(a) && (a = a.call(o, C, k)), [i || 0, n, a]
                    }

                    function p(t, e) {
                        var i, s;
                        return s = (e || "0").toString().toLowerCase().replace(/[%A-z]+$/, function (t) {
                            return i = t, ""
                        }), i || (i = w.Values.getUnitType(t)), [s, i]
                    }

                    function v() {
                        var t = {
                                myParent: o.parentNode || i.body,
                                position: w.getPropertyValue(o, "position"),
                                fontSize: w.getPropertyValue(o, "fontSize")
                            }, s = t.position === z.lastPosition && t.myParent === z.lastParent,
                            n = t.fontSize === z.lastFontSize;
                        z.lastParent = t.myParent, z.lastPosition = t.position, z.lastFontSize = t.fontSize;
                        var r = 100, l = {};
                        if (n && s) l.emToPx = z.lastEmToPx, l.percentToPxWidth = z.lastPercentToPxWidth, l.percentToPxHeight = z.lastPercentToPxHeight; else {
                            var h = a(o).isSVG ? i.createElementNS("http://www.w3.org/2000/svg", "rect") : i.createElement("div");
                            y.init(h), t.myParent.appendChild(h), d.each(["overflow", "overflowX", "overflowY"], function (t, e) {
                                y.CSS.setPropertyValue(h, e, "hidden")
                            }), y.CSS.setPropertyValue(h, "position", t.position), y.CSS.setPropertyValue(h, "fontSize", t.fontSize), y.CSS.setPropertyValue(h, "boxSizing", "content-box"), d.each(["minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height"], function (t, e) {
                                y.CSS.setPropertyValue(h, e, r + "%")
                            }), y.CSS.setPropertyValue(h, "paddingLeft", r + "em"), l.percentToPxWidth = z.lastPercentToPxWidth = (parseFloat(w.getPropertyValue(h, "width", null, !0)) || 1) / r, l.percentToPxHeight = z.lastPercentToPxHeight = (parseFloat(w.getPropertyValue(h, "height", null, !0)) || 1) / r, l.emToPx = z.lastEmToPx = (parseFloat(w.getPropertyValue(h, "paddingLeft")) || 1) / r, t.myParent.removeChild(h)
                        }
                        return null === z.remToPx && (z.remToPx = parseFloat(w.getPropertyValue(i.body, "fontSize")) || 16), null === z.vwToPx && (z.vwToPx = parseFloat(e.innerWidth) / 100, z.vhToPx = parseFloat(e.innerHeight) / 100), l.remToPx = z.remToPx, l.vwToPx = z.vwToPx, l.vhToPx = z.vhToPx, y.debug >= 1 && console.log("Unit ratios: " + JSON.stringify(l), o), l
                    }

                    if (r.begin && 0 === C) try {
                        r.begin.call(f, f)
                    } catch (_) {
                        setTimeout(function () {
                            throw _
                        }, 1)
                    }
                    if ("scroll" === I) {
                        var x, D, P, S = /^x$/i.test(r.axis) ? "Left" : "Top", M = parseFloat(r.offset) || 0;
                        r.container ? m.isWrapped(r.container) || m.isNode(r.container) ? (r.container = r.container[0] || r.container, x = r.container["scroll" + S], P = x + d(o).position()[S.toLowerCase()] + M) : r.container = null : (x = y.State.scrollAnchor[y.State["scrollProperty" + S]], D = y.State.scrollAnchor[y.State["scrollProperty" + ("Left" === S ? "Top" : "Left")]], P = d(o).offset()[S.toLowerCase()] + M), l = {
                            scroll: {
                                rootPropertyValue: !1,
                                startValue: x,
                                currentValue: x,
                                endValue: P,
                                unitType: "",
                                easing: r.easing,
                                scrollData: {container: r.container, direction: S, alternateValue: D}
                            }, element: o
                        }, y.debug && console.log("tweensContainer (scroll): ", l.scroll, o)
                    } else if ("reverse" === I) {
                        if (!a(o).tweensContainer) return void d.dequeue(o, r.queue);
                        "none" === a(o).opts.display && (a(o).opts.display = "auto"), "hidden" === a(o).opts.visibility && (a(o).opts.visibility = "visible"), a(o).opts.loop = !1, a(o).opts.begin = null, a(o).opts.complete = null, b.easing || delete r.easing, b.duration || delete r.duration, r = d.extend({}, a(o).opts, r);
                        var A = d.extend(!0, {}, a(o).tweensContainer);
                        for (var O in A) if ("element" !== O) {
                            var E = A[O].startValue;
                            A[O].startValue = A[O].currentValue = A[O].endValue, A[O].endValue = E, m.isEmptyObject(b) || (A[O].easing = r.easing), y.debug && console.log("reverse tweensContainer (" + O + "): " + JSON.stringify(A[O]), o)
                        }
                        l = A
                    } else if ("start" === I) {
                        var A;
                        a(o).tweensContainer && a(o).isAnimating === !0 && (A = a(o).tweensContainer), d.each(g, function (t, e) {
                            if (RegExp("^" + w.Lists.colors.join("$|^") + "$").test(t)) {
                                var i = u(e, !0), n = i[0], o = i[1], a = i[2];
                                if (w.RegEx.isHex.test(n)) {
                                    for (var r = ["Red", "Green", "Blue"], l = w.Values.hexToRgb(n), h = a ? w.Values.hexToRgb(a) : s, c = 0; c < r.length; c++) {
                                        var d = [l[c]];
                                        o && d.push(o), h !== s && d.push(h[c]), g[t + r[c]] = d
                                    }
                                    delete g[t]
                                }
                            }
                        });
                        for (var N in g) {
                            var j = u(g[N]), W = j[0], F = j[1], Y = j[2];
                            N = w.Names.camelCase(N);
                            var L = w.Hooks.getRoot(N), R = !1;
                            if (a(o).isSVG || "tween" === L || w.Names.prefixCheck(L)[1] !== !1 || w.Normalizations.registered[L] !== s) {
                                (r.display !== s && null !== r.display && "none" !== r.display || r.visibility !== s && "hidden" !== r.visibility) && /opacity|filter/.test(N) && !Y && 0 !== W && (Y = 0), r._cacheValues && A && A[N] ? (Y === s && (Y = A[N].endValue + A[N].unitType), R = a(o).rootPropertyValueCache[L]) : w.Hooks.registered[N] ? Y === s ? (R = w.getPropertyValue(o, L), Y = w.getPropertyValue(o, N, R)) : R = w.Hooks.templates[L][1] : Y === s && (Y = w.getPropertyValue(o, N));
                                var V, B, X, q = !1;
                                if (V = p(N, Y), Y = V[0], X = V[1], V = p(N, W), W = V[0].replace(/^([+-\/*])=/, function (t, e) {
                                    return q = e, ""
                                }), B = V[1], Y = parseFloat(Y) || 0, W = parseFloat(W) || 0, "%" === B && (/^(fontSize|lineHeight)$/.test(N) ? (W /= 100, B = "em") : /^scale/.test(N) ? (W /= 100, B = "") : /(Red|Green|Blue)$/i.test(N) && (W = W / 100 * 255, B = "")), /[\/*]/.test(q)) B = X; else if (X !== B && 0 !== Y) if (0 === W) B = X; else {
                                    n = n || v();
                                    var $ = /margin|padding|left|right|width|text|word|letter/i.test(N) || /X$/.test(N) || "x" === N ? "x" : "y";
                                    switch (X) {
                                        case"%":
                                            Y *= "x" === $ ? n.percentToPxWidth : n.percentToPxHeight;
                                            break;
                                        case"px":
                                            break;
                                        default:
                                            Y *= n[X + "ToPx"]
                                    }
                                    switch (B) {
                                        case"%":
                                            Y *= 1 / ("x" === $ ? n.percentToPxWidth : n.percentToPxHeight);
                                            break;
                                        case"px":
                                            break;
                                        default:
                                            Y *= 1 / n[B + "ToPx"]
                                    }
                                }
                                switch (q) {
                                    case"+":
                                        W = Y + W;
                                        break;
                                    case"-":
                                        W = Y - W;
                                        break;
                                    case"*":
                                        W = Y * W;
                                        break;
                                    case"/":
                                        W = Y / W
                                }
                                l[N] = {
                                    rootPropertyValue: R,
                                    startValue: Y,
                                    currentValue: Y,
                                    endValue: W,
                                    unitType: B,
                                    easing: F
                                }, y.debug && console.log("tweensContainer (" + N + "): " + JSON.stringify(l[N]), o)
                            } else y.debug && console.log("Skipping [" + L + "] due to a lack of browser support.")
                        }
                        l.element = o
                    }
                    l.element && (w.Values.addClass(o, "velocity-animating"), H.push(l), "" === r.queue && (a(o).tweensContainer = l, a(o).opts = r), a(o).isAnimating = !0, C === k - 1 ? (y.State.calls.push([H, f, r, null, T.resolver]), y.State.isTicking === !1 && (y.State.isTicking = !0, c())) : C++)
                }

                var n, o = this, r = d.extend({}, y.defaults, b), l = {};
                switch (a(o) === s && y.init(o), parseFloat(r.delay) && r.queue !== !1 && d.queue(o, r.queue, function (t) {
                    y.velocityQueueEntryFlag = !0, a(o).delayTimer = {
                        setTimeout: setTimeout(t, parseFloat(r.delay)),
                        next: t
                    }
                }), r.duration.toString().toLowerCase()) {
                    case"fast":
                        r.duration = 200;
                        break;
                    case"normal":
                        r.duration = v;
                        break;
                    case"slow":
                        r.duration = 600;
                        break;
                    default:
                        r.duration = parseFloat(r.duration) || 1
                }
                y.mock !== !1 && (y.mock === !0 ? r.duration = r.delay = 1 : (r.duration *= parseFloat(y.mock) || 1, r.delay *= parseFloat(y.mock) || 1)), r.easing = h(r.easing, r.duration), r.begin && !m.isFunction(r.begin) && (r.begin = null), r.progress && !m.isFunction(r.progress) && (r.progress = null), r.complete && !m.isFunction(r.complete) && (r.complete = null), r.display !== s && null !== r.display && (r.display = r.display.toString().toLowerCase(), "auto" === r.display && (r.display = y.CSS.Values.getDisplayType(o))), r.visibility !== s && null !== r.visibility && (r.visibility = r.visibility.toString().toLowerCase()), r.mobileHA = r.mobileHA && y.State.isMobile && !y.State.isGingerbread, r.queue === !1 ? r.delay ? setTimeout(t, r.delay) : t() : d.queue(o, r.queue, function (e, i) {
                    return i === !0 ? (T.promise && T.resolver(f), !0) : (y.velocityQueueEntryFlag = !0, void t(e))
                }), "" !== r.queue && "fx" !== r.queue || "inprogress" === d.queue(o)[0] || d.dequeue(o)
            }

            var r, l, p, f, g, b,
                _ = arguments[0] && (arguments[0].p || d.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || m.isString(arguments[0].properties));
            if (m.isWrapped(this) ? (r = !1, p = 0, f = this, l = this) : (r = !0, p = 1, f = _ ? arguments[0].elements || arguments[0].e : arguments[0]), f = o(f)) {
                _ ? (g = arguments[0].properties || arguments[0].p, b = arguments[0].options || arguments[0].o) : (g = arguments[p], b = arguments[p + 1]);
                var k = f.length, C = 0;
                if (!/^(stop|finish)$/i.test(g) && !d.isPlainObject(b)) {
                    var D = p + 1;
                    b = {};
                    for (var P = D; P < arguments.length; P++) m.isArray(arguments[P]) || !/^(fast|normal|slow)$/i.test(arguments[P]) && !/^\d/.test(arguments[P]) ? m.isString(arguments[P]) || m.isArray(arguments[P]) ? b.easing = arguments[P] : m.isFunction(arguments[P]) && (b.complete = arguments[P]) : b.duration = arguments[P]
                }
                var T = {promise: null, resolver: null, rejecter: null};
                r && y.Promise && (T.promise = new y.Promise(function (t, e) {
                    T.resolver = t, T.rejecter = e
                }));
                var I;
                switch (g) {
                    case"scroll":
                        I = "scroll";
                        break;
                    case"reverse":
                        I = "reverse";
                        break;
                    case"finish":
                    case"stop":
                        d.each(f, function (t, e) {
                            a(e) && a(e).delayTimer && (clearTimeout(a(e).delayTimer.setTimeout), a(e).delayTimer.next && a(e).delayTimer.next(), delete a(e).delayTimer)
                        });
                        var S = [];
                        return d.each(y.State.calls, function (t, e) {
                            e && d.each(e[1], function (i, n) {
                                var o = b === s ? "" : b;
                                return o === !0 || e[2].queue === o || b === s && e[2].queue === !1 ? void d.each(f, function (i, s) {
                                    s === n && ((b === !0 || m.isString(b)) && (d.each(d.queue(s, m.isString(b) ? b : ""), function (t, e) {
                                        m.isFunction(e) && e(null, !0)
                                    }), d.queue(s, m.isString(b) ? b : "", [])), "stop" === g ? (a(s) && a(s).tweensContainer && o !== !1 && d.each(a(s).tweensContainer, function (t, e) {
                                        e.endValue = e.currentValue
                                    }), S.push(t)) : "finish" === g && (e[2].duration = 1))
                                }) : !0
                            })
                        }), "stop" === g && (d.each(S, function (t, e) {
                            u(e, !0)
                        }), T.promise && T.resolver(f)), t();
                    default:
                        if (!d.isPlainObject(g) || m.isEmptyObject(g)) {
                            if (m.isString(g) && y.Redirects[g]) {
                                var M = d.extend({}, b), A = M.duration, O = M.delay || 0;
                                return M.backwards === !0 && (f = d.extend(!0, [], f).reverse()), d.each(f, function (t, e) {
                                    parseFloat(M.stagger) ? M.delay = O + parseFloat(M.stagger) * t : m.isFunction(M.stagger) && (M.delay = O + M.stagger.call(e, t, k)), M.drag && (M.duration = parseFloat(A) || (/^(callout|transition)/.test(g) ? 1e3 : v), M.duration = Math.max(M.duration * (M.backwards ? 1 - t / k : (t + 1) / k), .75 * M.duration, 200)), y.Redirects[g].call(e, e, M || {}, t, k, f, T.promise ? T : s)
                                }), t()
                            }
                            var E = "Velocity: First argument (" + g + ") was not a property map, a known action, or a registered redirect. Aborting.";
                            return T.promise ? T.rejecter(new Error(E)) : console.log(E), t()
                        }
                        I = "start"
                }
                var z = {
                    lastParent: null,
                    lastPosition: null,
                    lastFontSize: null,
                    lastPercentToPxWidth: null,
                    lastPercentToPxHeight: null,
                    lastEmToPx: null,
                    remToPx: null,
                    vwToPx: null,
                    vhToPx: null
                }, H = [];
                d.each(f, function (t, e) {
                    m.isNode(e) && n.call(e)
                });
                var N, M = d.extend({}, y.defaults, b);
                if (M.loop = parseInt(M.loop), N = 2 * M.loop - 1, M.loop) for (var j = 0; N > j; j++) {
                    var W = {delay: M.delay, progress: M.progress};
                    j === N - 1 && (W.display = M.display, W.visibility = M.visibility, W.complete = M.complete), x(f, "reverse", W)
                }
                return t()
            }
        };
        y = d.extend(x, y), y.animate = x;
        var k = e.requestAnimationFrame || f;
        return y.State.isMobile || i.hidden === s || i.addEventListener("visibilitychange", function () {
            i.hidden ? (k = function (t) {
                return setTimeout(function () {
                    t(!0)
                }, 16)
            }, c()) : k = e.requestAnimationFrame || f
        }), t.Velocity = y, t !== e && (t.fn.velocity = x, t.fn.velocity.defaults = y.defaults), d.each(["Down", "Up"], function (t, e) {
            y.Redirects["slide" + e] = function (t, i, n, o, a, r) {
                var l = d.extend({}, i), h = l.begin, c = l.complete,
                    u = {height: "", marginTop: "", marginBottom: "", paddingTop: "", paddingBottom: ""}, p = {};
                l.display === s && (l.display = "Down" === e ? "inline" === y.CSS.Values.getDisplayType(t) ? "inline-block" : "block" : "none"), l.begin = function () {
                    h && h.call(a, a);
                    for (var i in u) {
                        p[i] = t.style[i];
                        var s = y.CSS.getPropertyValue(t, i);
                        u[i] = "Down" === e ? [s, 0] : [0, s]
                    }
                    p.overflow = t.style.overflow, t.style.overflow = "hidden"
                }, l.complete = function () {
                    for (var e in p) t.style[e] = p[e];
                    c && c.call(a, a), r && r.resolver(a)
                }, y(t, u, l)
            }
        }), d.each(["In", "Out"], function (t, e) {
            y.Redirects["fade" + e] = function (t, i, n, o, a, r) {
                var l = d.extend({}, i), h = {opacity: "In" === e ? 1 : 0}, c = l.complete;
                l.complete = n !== o - 1 ? l.begin = null : function () {
                    c && c.call(a, a), r && r.resolver(a)
                }, l.display === s && (l.display = "In" === e ? "auto" : "none"), y(this, h, l)
            }
        }), y
    }(window.jQuery || window.Zepto || window, window, document)
}), !function (t) {
    "function" == typeof require && "object" == typeof exports ? module.exports = t() : "function" == typeof define && define.amd ? define(["velocity"], t) : t()
}(function () {
    return function (t, e, i, s) {
        function n(t, e) {
            var i = [];
            return t && e ? (a.each([t, e], function (t, e) {
                var s = [];
                a.each(e, function (t, e) {
                    for (; e.toString().length < 5;) e = "0" + e;
                    s.push(e)
                }), i.push(s.join(""))
            }), parseFloat(i[0]) > parseFloat(i[1])) : !1
        }

        if (!t.Velocity || !t.Velocity.Utilities) return void (e.console && console.log("Velocity UI Pack: Velocity must be loaded first. Aborting."));
        var o = t.Velocity, a = o.Utilities, r = o.version, l = {major: 1, minor: 1, patch: 0};
        if (n(l, r)) {
            var h = "Velocity UI Pack: You need to update Velocity (jquery.velocity.js) to a newer version. Visit http://github.com/julianshapiro/velocity.";
            throw alert(h), new Error(h)
        }
        o.RegisterEffect = o.RegisterUI = function (t, e) {
            function i(t, e, i, s) {
                var n, r = 0;
                a.each(t.nodeType ? [t] : t, function (t, e) {
                    s && (i += t * s), n = e.parentNode, a.each(["height", "paddingTop", "paddingBottom", "marginTop", "marginBottom"], function (t, i) {
                        r += parseFloat(o.CSS.getPropertyValue(e, i))
                    })
                }), o.animate(n, {height: ("In" === e ? "+" : "-") + "=" + r}, {
                    queue: !1,
                    easing: "ease-in-out",
                    duration: i * ("In" === e ? .6 : 1)
                })
            }

            return o.Redirects[t] = function (n, r, l, h, c, u) {
                function d() {
                    r.display !== s && "none" !== r.display || !/Out$/.test(t) || a.each(c.nodeType ? [c] : c, function (t, e) {
                        o.CSS.setPropertyValue(e, "display", "none")
                    }), r.complete && r.complete.call(c, c), u && u.resolver(c || n)
                }

                var p = l === h - 1;
                e.defaultDuration = "function" == typeof e.defaultDuration ? e.defaultDuration.call(c, c) : parseFloat(e.defaultDuration);
                for (var f = 0; f < e.calls.length; f++) {
                    var m = e.calls[f], g = m[0], v = r.duration || e.defaultDuration || 1e3, b = m[1], y = m[2] || {},
                        _ = {};
                    if (_.duration = v * (b || 1), _.queue = r.queue || "", _.easing = y.easing || "ease", _.delay = parseFloat(y.delay) || 0, _._cacheValues = y._cacheValues || !0, 0 === f) {
                        if (_.delay += parseFloat(r.delay) || 0, 0 === l && (_.begin = function () {
                            r.begin && r.begin.call(c, c);
                            var e = t.match(/(In|Out)$/);
                            e && "In" === e[0] && g.opacity !== s && a.each(c.nodeType ? [c] : c, function (t, e) {
                                o.CSS.setPropertyValue(e, "opacity", 0)
                            }), r.animateParentHeight && e && i(c, e[0], v + _.delay, r.stagger)
                        }), null !== r.display) if (r.display !== s && "none" !== r.display) _.display = r.display; else if (/In$/.test(t)) {
                            var w = o.CSS.Values.getDisplayType(n);
                            _.display = "inline" === w ? "inline-block" : w
                        }
                        r.visibility && "hidden" !== r.visibility && (_.visibility = r.visibility)
                    }
                    f === e.calls.length - 1 && (_.complete = function () {
                        if (e.reset) {
                            for (var t in e.reset) {
                                var i = e.reset[t];
                                o.CSS.Hooks.registered[t] !== s || "string" != typeof i && "number" != typeof i || (e.reset[t] = [e.reset[t], e.reset[t]])
                            }
                            var a = {duration: 0, queue: !1};
                            p && (a.complete = d), o.animate(n, e.reset, a)
                        } else p && d()
                    }, "hidden" === r.visibility && (_.visibility = r.visibility)), o.animate(n, g, _)
                }
            }, o
        }, o.RegisterEffect.packagedEffects = {
            "callout.bounce": {
                defaultDuration: 550,
                calls: [[{translateY: -30}, .25], [{translateY: 0}, .125], [{translateY: -15}, .125], [{translateY: 0}, .25]]
            },
            "callout.shake": {
                defaultDuration: 800,
                calls: [[{translateX: -11}, .125], [{translateX: 11}, .125], [{translateX: -11}, .125], [{translateX: 11}, .125], [{translateX: -11}, .125], [{translateX: 11}, .125], [{translateX: -11}, .125], [{translateX: 0}, .125]]
            },
            "callout.flash": {
                defaultDuration: 1100,
                calls: [[{opacity: [0, "easeInOutQuad", 1]}, .25], [{opacity: [1, "easeInOutQuad"]}, .25], [{opacity: [0, "easeInOutQuad"]}, .25], [{opacity: [1, "easeInOutQuad"]}, .25]]
            },
            "callout.pulse": {
                defaultDuration: 825,
                calls: [[{scaleX: 1.1, scaleY: 1.1}, .5], [{scaleX: 1, scaleY: 1}, .5]]
            },
            "callout.swing": {
                defaultDuration: 950,
                calls: [[{rotateZ: 15}, .2], [{rotateZ: -10}, .2], [{rotateZ: 5}, .2], [{rotateZ: -5}, .2], [{rotateZ: 0}, .2]]
            },
            "callout.tada": {
                defaultDuration: 1e3,
                calls: [[{scaleX: .9, scaleY: .9, rotateZ: -3}, .1], [{
                    scaleX: 1.1,
                    scaleY: 1.1,
                    rotateZ: 3
                }, .1], [{
                    scaleX: 1.1,
                    scaleY: 1.1,
                    rotateZ: -3
                }, .1], ["reverse", .125], ["reverse", .125], ["reverse", .125], ["reverse", .125], ["reverse", .125], [{
                    scaleX: 1,
                    scaleY: 1,
                    rotateZ: 0
                }, .2]]
            },
            "transition.fadeIn": {defaultDuration: 500, calls: [[{opacity: [1, 0]}]]},
            "transition.fadeOut": {defaultDuration: 500, calls: [[{opacity: [0, 1]}]]},
            "transition.flipXIn": {
                defaultDuration: 700,
                calls: [[{opacity: [1, 0], transformPerspective: [800, 800], rotateY: [0, -55]}]],
                reset: {transformPerspective: 0}
            },
            "transition.flipXOut": {
                defaultDuration: 700,
                calls: [[{opacity: [0, 1], transformPerspective: [800, 800], rotateY: 55}]],
                reset: {transformPerspective: 0, rotateY: 0}
            },
            "transition.flipYIn": {
                defaultDuration: 800,
                calls: [[{opacity: [1, 0], transformPerspective: [800, 800], rotateX: [0, -45]}]],
                reset: {transformPerspective: 0}
            },
            "transition.flipYOut": {
                defaultDuration: 800,
                calls: [[{opacity: [0, 1], transformPerspective: [800, 800], rotateX: 25}]],
                reset: {transformPerspective: 0, rotateX: 0}
            },
            "transition.flipBounceXIn": {
                defaultDuration: 900,
                calls: [[{opacity: [.725, 0], transformPerspective: [400, 400], rotateY: [-10, 90]}, .5], [{
                    opacity: .8,
                    rotateY: 10
                }, .25], [{opacity: 1, rotateY: 0}, .25]],
                reset: {transformPerspective: 0}
            },
            "transition.flipBounceXOut": {
                defaultDuration: 800,
                calls: [[{opacity: [.9, 1], transformPerspective: [400, 400], rotateY: -10}, .5], [{
                    opacity: 0,
                    rotateY: 90
                }, .5]],
                reset: {transformPerspective: 0, rotateY: 0}
            },
            "transition.flipBounceYIn": {
                defaultDuration: 850,
                calls: [[{opacity: [.725, 0], transformPerspective: [400, 400], rotateX: [-10, 90]}, .5], [{
                    opacity: .8,
                    rotateX: 10
                }, .25], [{opacity: 1, rotateX: 0}, .25]],
                reset: {transformPerspective: 0}
            },
            "transition.flipBounceYOut": {
                defaultDuration: 800,
                calls: [[{opacity: [.9, 1], transformPerspective: [400, 400], rotateX: -15}, .5], [{
                    opacity: 0,
                    rotateX: 90
                }, .5]],
                reset: {transformPerspective: 0, rotateX: 0}
            },
            "transition.swoopIn": {
                defaultDuration: 850,
                calls: [[{
                    opacity: [1, 0],
                    transformOriginX: ["100%", "50%"],
                    transformOriginY: ["100%", "100%"],
                    scaleX: [1, 0],
                    scaleY: [1, 0],
                    translateX: [0, -700],
                    translateZ: 0
                }]],
                reset: {transformOriginX: "50%", transformOriginY: "50%"}
            },
            "transition.swoopOut": {
                defaultDuration: 850,
                calls: [[{
                    opacity: [0, 1],
                    transformOriginX: ["50%", "100%"],
                    transformOriginY: ["100%", "100%"],
                    scaleX: 0,
                    scaleY: 0,
                    translateX: -700,
                    translateZ: 0
                }]],
                reset: {transformOriginX: "50%", transformOriginY: "50%", scaleX: 1, scaleY: 1, translateX: 0}
            },
            "transition.whirlIn": {
                defaultDuration: 850,
                calls: [[{
                    opacity: [1, 0],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: [1, 0],
                    scaleY: [1, 0],
                    rotateY: [0, 160]
                }, 1, {easing: "easeInOutSine"}]]
            },
            "transition.whirlOut": {
                defaultDuration: 750,
                calls: [[{
                    opacity: [0, "easeInOutQuint", 1],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: 0,
                    scaleY: 0,
                    rotateY: 160
                }, 1, {easing: "swing"}]],
                reset: {scaleX: 1, scaleY: 1, rotateY: 0}
            },
            "transition.shrinkIn": {
                defaultDuration: 750,
                calls: [[{
                    opacity: [1, 0],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: [1, 1.5],
                    scaleY: [1, 1.5],
                    translateZ: 0
                }]]
            },
            "transition.shrinkOut": {
                defaultDuration: 600,
                calls: [[{
                    opacity: [0, 1],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: 1.3,
                    scaleY: 1.3,
                    translateZ: 0
                }]],
                reset: {scaleX: 1, scaleY: 1}
            },
            "transition.expandIn": {
                defaultDuration: 700,
                calls: [[{
                    opacity: [1, 0],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: [1, .625],
                    scaleY: [1, .625],
                    translateZ: 0
                }]]
            },
            "transition.expandOut": {
                defaultDuration: 700,
                calls: [[{
                    opacity: [0, 1],
                    transformOriginX: ["50%", "50%"],
                    transformOriginY: ["50%", "50%"],
                    scaleX: .5,
                    scaleY: .5,
                    translateZ: 0
                }]],
                reset: {scaleX: 1, scaleY: 1}
            },
            "transition.bounceIn": {
                defaultDuration: 800,
                calls: [[{opacity: [1, 0], scaleX: [1.05, .3], scaleY: [1.05, .3]}, .4], [{
                    scaleX: .9,
                    scaleY: .9,
                    translateZ: 0
                }, .2], [{scaleX: 1, scaleY: 1}, .5]]
            },
            "transition.bounceOut": {
                defaultDuration: 800,
                calls: [[{scaleX: .95, scaleY: .95}, .35], [{
                    scaleX: 1.1,
                    scaleY: 1.1,
                    translateZ: 0
                }, .35], [{opacity: [0, 1], scaleX: .3, scaleY: .3}, .3]],
                reset: {scaleX: 1, scaleY: 1}
            },
            "transition.bounceUpIn": {
                defaultDuration: 800,
                calls: [[{
                    opacity: [1, 0],
                    translateY: [-30, 1e3]
                }, .6, {easing: "easeOutCirc"}], [{translateY: 10}, .2], [{translateY: 0}, .2]]
            },
            "transition.bounceUpOut": {
                defaultDuration: 1e3,
                calls: [[{translateY: 20}, .2], [{opacity: [0, "easeInCirc", 1], translateY: -1e3}, .8]],
                reset: {translateY: 0}
            },
            "transition.bounceDownIn": {
                defaultDuration: 800,
                calls: [[{
                    opacity: [1, 0],
                    translateY: [30, -1e3]
                }, .6, {easing: "easeOutCirc"}], [{translateY: -10}, .2], [{translateY: 0}, .2]]
            },
            "transition.bounceDownOut": {
                defaultDuration: 1e3,
                calls: [[{translateY: -20}, .2], [{opacity: [0, "easeInCirc", 1], translateY: 1e3}, .8]],
                reset: {translateY: 0}
            },
            "transition.bounceLeftIn": {
                defaultDuration: 750,
                calls: [[{
                    opacity: [1, 0],
                    translateX: [30, -1250]
                }, .6, {easing: "easeOutCirc"}], [{translateX: -10}, .2], [{translateX: 0}, .2]]
            },
            "transition.bounceLeftOut": {
                defaultDuration: 750,
                calls: [[{translateX: 30}, .2], [{opacity: [0, "easeInCirc", 1], translateX: -1250}, .8]],
                reset: {translateX: 0}
            },
            "transition.bounceRightIn": {
                defaultDuration: 750,
                calls: [[{
                    opacity: [1, 0],
                    translateX: [-30, 1250]
                }, .6, {easing: "easeOutCirc"}], [{translateX: 10}, .2], [{translateX: 0}, .2]]
            },
            "transition.bounceRightOut": {
                defaultDuration: 750,
                calls: [[{translateX: -30}, .2], [{opacity: [0, "easeInCirc", 1], translateX: 1250}, .8]],
                reset: {translateX: 0}
            },
            "transition.slideUpIn": {
                defaultDuration: 900,
                calls: [[{opacity: [1, 0], translateY: [0, 20], translateZ: 0}]]
            },
            "transition.slideUpOut": {
                defaultDuration: 900,
                calls: [[{opacity: [0, 1], translateY: -20, translateZ: 0}]],
                reset: {translateY: 0}
            },
            "transition.slideDownIn": {
                defaultDuration: 900,
                calls: [[{opacity: [1, 0], translateY: [0, -20], translateZ: 0}]]
            },
            "transition.slideDownOut": {
                defaultDuration: 900,
                calls: [[{opacity: [0, 1], translateY: 20, translateZ: 0}]],
                reset: {translateY: 0}
            },
            "transition.slideLeftIn": {
                defaultDuration: 1e3,
                calls: [[{opacity: [1, 0], translateX: [0, -20], translateZ: 0}]]
            },
            "transition.slideLeftOut": {
                defaultDuration: 1050,
                calls: [[{opacity: [0, 1], translateX: -20, translateZ: 0}]],
                reset: {translateX: 0}
            },
            "transition.slideRightIn": {
                defaultDuration: 1e3,
                calls: [[{opacity: [1, 0], translateX: [0, 20], translateZ: 0}]]
            },
            "transition.slideRightOut": {
                defaultDuration: 1050,
                calls: [[{opacity: [0, 1], translateX: 20, translateZ: 0}]],
                reset: {translateX: 0}
            },
            "transition.slideUpBigIn": {
                defaultDuration: 850,
                calls: [[{opacity: [1, 0], translateY: [0, 75], translateZ: 0}]]
            },
            "transition.slideUpBigOut": {
                defaultDuration: 800,
                calls: [[{opacity: [0, 1], translateY: -75, translateZ: 0}]],
                reset: {translateY: 0}
            },
            "transition.slideDownBigIn": {
                defaultDuration: 850,
                calls: [[{opacity: [1, 0], translateY: [0, -75], translateZ: 0}]]
            },
            "transition.slideDownBigOut": {
                defaultDuration: 800,
                calls: [[{opacity: [0, 1], translateY: 75, translateZ: 0}]],
                reset: {translateY: 0}
            },
            "transition.slideLeftBigIn": {
                defaultDuration: 800,
                calls: [[{opacity: [1, 0], translateX: [0, -75], translateZ: 0}]]
            },
            "transition.slideLeftBigOut": {
                defaultDuration: 750,
                calls: [[{opacity: [0, 1], translateX: -75, translateZ: 0}]],
                reset: {translateX: 0}
            },
            "transition.slideRightBigIn": {
                defaultDuration: 800,
                calls: [[{opacity: [1, 0], translateX: [0, 75], translateZ: 0}]]
            },
            "transition.slideRightBigOut": {
                defaultDuration: 750,
                calls: [[{opacity: [0, 1], translateX: 75, translateZ: 0}]],
                reset: {translateX: 0}
            },
            "transition.perspectiveUpIn": {
                defaultDuration: 800,
                calls: [[{
                    opacity: [1, 0],
                    transformPerspective: [800, 800],
                    transformOriginX: [0, 0],
                    transformOriginY: ["100%", "100%"],
                    rotateX: [0, -180]
                }]]
            },
            "transition.perspectiveUpOut": {
                defaultDuration: 850,
                calls: [[{
                    opacity: [0, 1],
                    transformPerspective: [800, 800],
                    transformOriginX: [0, 0],
                    transformOriginY: ["100%", "100%"],
                    rotateX: -180
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateX: 0}
            },
            "transition.perspectiveDownIn": {
                defaultDuration: 800,
                calls: [[{
                    opacity: [1, 0],
                    transformPerspective: [800, 800],
                    transformOriginX: [0, 0],
                    transformOriginY: [0, 0],
                    rotateX: [0, 180]
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%"}
            },
            "transition.perspectiveDownOut": {
                defaultDuration: 850,
                calls: [[{
                    opacity: [0, 1],
                    transformPerspective: [800, 800],
                    transformOriginX: [0, 0],
                    transformOriginY: [0, 0],
                    rotateX: 180
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateX: 0}
            },
            "transition.perspectiveLeftIn": {
                defaultDuration: 950,
                calls: [[{
                    opacity: [1, 0],
                    transformPerspective: [2e3, 2e3],
                    transformOriginX: [0, 0],
                    transformOriginY: [0, 0],
                    rotateY: [0, -180]
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%"}
            },
            "transition.perspectiveLeftOut": {
                defaultDuration: 950,
                calls: [[{
                    opacity: [0, 1],
                    transformPerspective: [2e3, 2e3],
                    transformOriginX: [0, 0],
                    transformOriginY: [0, 0],
                    rotateY: -180
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateY: 0}
            },
            "transition.perspectiveRightIn": {
                defaultDuration: 950,
                calls: [[{
                    opacity: [1, 0],
                    transformPerspective: [2e3, 2e3],
                    transformOriginX: ["100%", "100%"],
                    transformOriginY: [0, 0],
                    rotateY: [0, 180]
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%"}
            },
            "transition.perspectiveRightOut": {
                defaultDuration: 950,
                calls: [[{
                    opacity: [0, 1],
                    transformPerspective: [2e3, 2e3],
                    transformOriginX: ["100%", "100%"],
                    transformOriginY: [0, 0],
                    rotateY: 180
                }]],
                reset: {transformPerspective: 0, transformOriginX: "50%", transformOriginY: "50%", rotateY: 0}
            }
        };
        for (var c in o.RegisterEffect.packagedEffects) o.RegisterEffect(c, o.RegisterEffect.packagedEffects[c]);
        o.RunSequence = function (t) {
            var e = a.extend(!0, [], t);
            e.length > 1 && (a.each(e.reverse(), function (t, i) {
                var s = e[t + 1];
                if (s) {
                    var n = i.options && i.options.sequenceQueue === !1 ? "begin" : "complete",
                        r = s.options && s.options[n], l = {};
                    l[n] = function () {
                        var t = s.elements.nodeType ? [s.elements] : s.elements;
                        r && r.call(t, t), o(i)
                    }, s.options = a.extend({}, s.options, l)
                }
            }), e.reverse()), o(e[0])
        }
    }(window.jQuery || window.Zepto || window, window, document)
}), function (t, e, i) {
    "function" == typeof define && define.amd ? define(["jquery"], function (s) {
        return i(s, t, e), s.mobile
    }) : i(t.jQuery, t, e)
}(this, document, function (t, e, i, s) {
    !function (t, e, i, s) {
        function n(t) {
            for (; t && "undefined" != typeof t.originalEvent;) t = t.originalEvent;
            return t
        }

        function o(e, i) {
            var o, a, r, l, h, c, u, d, p, f = e.type;
            if (e = t.Event(e), e.type = i, o = e.originalEvent, a = t.event.props, f.search(/^(mouse|click)/) > -1 && (a = M), o) for (u = a.length, l; u;) l = a[--u], e[l] = o[l];
            if (f.search(/mouse(down|up)|click/) > -1 && !e.which && (e.which = 1), -1 !== f.search(/^touch/) && (r = n(o), f = r.touches, h = r.changedTouches, c = f && f.length ? f[0] : h && h.length ? h[0] : s)) for (d = 0, p = I.length; p > d; d++) l = I[d], e[l] = c[l];
            return e
        }

        function a(e) {
            for (var i, s, n = {}; e;) {
                i = t.data(e, D);
                for (s in i) i[s] && (n[s] = n.hasVirtualBinding = !0);
                e = e.parentNode
            }
            return n
        }

        function r(e, i) {
            for (var s; e;) {
                if (s = t.data(e, D), s && (!i || s[i])) return e;
                e = e.parentNode
            }
            return null
        }

        function l() {
            W = !1
        }

        function h() {
            W = !0
        }

        function c() {
            R = 0, N.length = 0, j = !1, h()
        }

        function u() {
            l()
        }

        function d() {
            p(), O = setTimeout(function () {
                O = 0, c()
            }, t.vmouse.resetTimerDuration)
        }

        function p() {
            O && (clearTimeout(O), O = 0)
        }

        function f(e, i, s) {
            var n;
            return (s && s[e] || !s && r(i.target, e)) && (n = o(i, e), t(i.target).trigger(n)), n
        }

        function m(e) {
            var i, s = t.data(e.target, P);
            j || R && R === s || (i = f("v" + e.type, e), i && (i.isDefaultPrevented() && e.preventDefault(), i.isPropagationStopped() && e.stopPropagation(), i.isImmediatePropagationStopped() && e.stopImmediatePropagation()))
        }

        function g(e) {
            var i, s, o, r = n(e).touches;
            r && 1 === r.length && (i = e.target, s = a(i), s.hasVirtualBinding && (R = L++, t.data(i, P, R), p(), u(), H = !1, o = n(e).touches[0], E = o.pageX, z = o.pageY, f("vmouseover", e, s), f("vmousedown", e, s)))
        }

        function v(t) {
            W || (H || f("vmousecancel", t, a(t.target)), H = !0, d())
        }

        function b(e) {
            if (!W) {
                var i = n(e).touches[0], s = H, o = t.vmouse.moveDistanceThreshold, r = a(e.target);
                H = H || Math.abs(i.pageX - E) > o || Math.abs(i.pageY - z) > o, H && !s && f("vmousecancel", e, r), f("vmousemove", e, r), d()
            }
        }

        function y(t) {
            if (!W) {
                h();
                var e, i, s = a(t.target);
                f("vmouseup", t, s), H || (e = f("vclick", t, s), e && e.isDefaultPrevented() && (i = n(t).changedTouches[0], N.push({
                    touchID: R,
                    x: i.clientX,
                    y: i.clientY
                }), j = !0)), f("vmouseout", t, s), H = !1, d()
            }
        }

        function _(e) {
            var i, s = t.data(e, D);
            if (s) for (i in s) if (s[i]) return !0;
            return !1
        }

        function w() {
        }

        function x(e) {
            var i = e.substr(1);
            return {
                setup: function () {
                    _(this) || t.data(this, D, {});
                    var s = t.data(this, D);
                    s[e] = !0, A[e] = (A[e] || 0) + 1, 1 === A[e] && Y.bind(i, m), t(this).bind(i, w), F && (A.touchstart = (A.touchstart || 0) + 1, 1 === A.touchstart && Y.bind("touchstart", g).bind("touchend", y).bind("touchmove", b).bind("scroll", v))
                }, teardown: function () {
                    --A[e], A[e] || Y.unbind(i, m), F && (--A.touchstart, A.touchstart || Y.unbind("touchstart", g).unbind("touchmove", b).unbind("touchend", y).unbind("scroll", v));
                    var s = t(this), n = t.data(this, D);
                    n && (n[e] = !1), s.unbind(i, w), _(this) || s.removeData(D)
                }
            }
        }

        if (undefined === t.event.props) {
            return;
        }

        var k, C, D = "virtualMouseBindings", P = "virtualTouchID",
            T = "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "),
            I = "clientX clientY pageX pageY screenX screenY".split(" "),
            S = t.event.mouseHooks ? t.event.mouseHooks.props : [],
            M = t.event.props.concat(S),
            A = {},
            O = 0,
            E = 0,
            z = 0, H = !1, N = [], j = !1, W = !1, F = "addEventListener" in i, Y = t(i), L = 1, R = 0;
        for (t.vmouse = {
            moveDistanceThreshold: 10,
            clickDistanceThreshold: 10,
            resetTimerDuration: 1500
        }, C = 0; C < T.length; C++) t.event.special[T[C]] = x(T[C]);
        F && i.addEventListener("click", function (e) {
            var i, s, n, o, a, r, l = N.length, h = e.target;
            if (l) for (i = e.clientX, s = e.clientY, k = t.vmouse.clickDistanceThreshold, n = h; n;) {
                for (o = 0; l > o; o++) if (a = N[o], r = 0, n === h && Math.abs(a.x - i) < k && Math.abs(a.y - s) < k || t.data(n, P) === a.touchID) return e.preventDefault(), void e.stopPropagation();
                n = n.parentNode
            }
        }, !0)
    }(t, e, i), function (t) {
        t.mobile = {}
    }(t), function (t, e) {
        var s = {touch: "ontouchend" in i};
        t.mobile.support = t.mobile.support || {}, t.extend(t.support, s), t.extend(t.mobile.support, s)
    }(t), function (t, e, s) {
        function n(e, i, n, o) {
            var a = n.type;
            n.type = i, o ? t.event.trigger(n, s, e) : t.event.dispatch.call(e, n), n.type = a
        }

        var o = t(i), a = t.mobile.support.touch, r = "touchmove scroll", l = a ? "touchstart" : "mousedown",
            h = a ? "touchend" : "mouseup", c = a ? "touchmove" : "mousemove";
        t.each("touchstart touchmove touchend tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(" "), function (e, i) {
            t.fn[i] = function (t) {
                return t ? this.bind(i, t) : this.trigger(i)
            }, t.attrFn && (t.attrFn[i] = !0)
        }), t.event.special.scrollstart = {
            enabled: !0, setup: function () {
                function e(t, e) {
                    i = e, n(o, i ? "scrollstart" : "scrollstop", t)
                }

                var i, s, o = this, a = t(o);
                a.bind(r, function (n) {
                    t.event.special.scrollstart.enabled && (i || e(n, !0), clearTimeout(s), s = setTimeout(function () {
                        e(n, !1)
                    }, 50))
                })
            }, teardown: function () {
                t(this).unbind(r)
            }
        }, t.event.special.tap = {
            tapholdThreshold: 750, emitTapOnTaphold: !0, setup: function () {
                var e = this, i = t(e), s = !1;
                i.bind("vmousedown", function (a) {
                    function r() {
                        clearTimeout(c)
                    }

                    function l() {
                        r(), i.unbind("vclick", h).unbind("vmouseup", r), o.unbind("vmousecancel", l)
                    }

                    function h(t) {
                        l(), s || u !== t.target ? s && t.stopPropagation() : n(e, "tap", t)
                    }

                    if (s = !1, a.which && 1 !== a.which) return !1;
                    var c, u = a.target;
                    i.bind("vmouseup", r).bind("vclick", h), o.bind("vmousecancel", l), c = setTimeout(function () {
                        t.event.special.tap.emitTapOnTaphold || (s = !0), n(e, "taphold", t.Event("taphold", {target: u}))
                    }, t.event.special.tap.tapholdThreshold)
                })
            }, teardown: function () {
                t(this).unbind("vmousedown").unbind("vclick").unbind("vmouseup"), o.unbind("vmousecancel")
            }
        }, t.event.special.swipe = {
            scrollSupressionThreshold: 30, durationThreshold: 1e3, horizontalDistanceThreshold: 30,
            verticalDistanceThreshold: 30, getLocation: function (t) {
                var i = e.pageXOffset, s = e.pageYOffset, n = t.clientX, o = t.clientY;
                return 0 === t.pageY && Math.floor(o) > Math.floor(t.pageY) || 0 === t.pageX && Math.floor(n) > Math.floor(t.pageX) ? (n -= i, o -= s) : (o < t.pageY - s || n < t.pageX - i) && (n = t.pageX - i, o = t.pageY - s), {
                    x: n,
                    y: o
                }
            }, start: function (e) {
                var i = e.originalEvent.touches ? e.originalEvent.touches[0] : e,
                    s = t.event.special.swipe.getLocation(i);
                return {time: (new Date).getTime(), coords: [s.x, s.y], origin: t(e.target)}
            }, stop: function (e) {
                var i = e.originalEvent.touches ? e.originalEvent.touches[0] : e,
                    s = t.event.special.swipe.getLocation(i);
                return {time: (new Date).getTime(), coords: [s.x, s.y]}
            }, handleSwipe: function (e, i, s, o) {
                if (i.time - e.time < t.event.special.swipe.durationThreshold && Math.abs(e.coords[0] - i.coords[0]) > t.event.special.swipe.horizontalDistanceThreshold && Math.abs(e.coords[1] - i.coords[1]) < t.event.special.swipe.verticalDistanceThreshold) {
                    var a = e.coords[0] > i.coords[0] ? "swipeleft" : "swiperight";
                    return n(s, "swipe", t.Event("swipe", {
                        target: o,
                        swipestart: e,
                        swipestop: i
                    }), !0), n(s, a, t.Event(a, {target: o, swipestart: e, swipestop: i}), !0), !0
                }
                return !1
            }, eventInProgress: !1, setup: function () {
                var e, i = this, s = t(i), n = {};
                e = t.data(this, "mobile-events"), e || (e = {length: 0}, t.data(this, "mobile-events", e)), e.length++, e.swipe = n, n.start = function (e) {
                    if (!t.event.special.swipe.eventInProgress) {
                        t.event.special.swipe.eventInProgress = !0;
                        var s, a = t.event.special.swipe.start(e), r = e.target, l = !1;
                        n.move = function (e) {
                            a && (s = t.event.special.swipe.stop(e), l || (l = t.event.special.swipe.handleSwipe(a, s, i, r), l && (t.event.special.swipe.eventInProgress = !1)), Math.abs(a.coords[0] - s.coords[0]) > t.event.special.swipe.scrollSupressionThreshold && e.preventDefault())
                        }, n.stop = function () {
                            l = !0, t.event.special.swipe.eventInProgress = !1, o.off(c, n.move), n.move = null
                        }, o.on(c, n.move).one(h, n.stop)
                    }
                }, s.on(l, n.start)
            }, teardown: function () {
                var e, i;
                e = t.data(this, "mobile-events"), e && (i = e.swipe, delete e.swipe, e.length--, 0 === e.length && t.removeData(this, "mobile-events")), i && (i.start && t(this).off(l, i.start), i.move && o.off(c, i.move), i.stop && o.off(h, i.stop))
            }
        }, t.each({
            scrollstop: "scrollstart",
            taphold: "tap",
            swipeleft: "swipe",
            swiperight: "swipe"
        }, function (e, i) {
            t.event.special[e] = {
                setup: function () {
                    t(this).bind(i, t.noop)
                }, teardown: function () {
                    t(this).unbind(i)
                }
            }
        })
    }(t, this)
}), !function (t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t : t(jQuery)
}(function (t) {
    function e(e) {
        var a = e || window.event, r = l.call(arguments, 1), h = 0, u = 0, d = 0, p = 0, f = 0, m = 0;
        if (e = t.event.fix(a), e.type = "mousewheel", "detail" in a && (d = -1 * a.detail), "wheelDelta" in a && (d = a.wheelDelta), "wheelDeltaY" in a && (d = a.wheelDeltaY), "wheelDeltaX" in a && (u = -1 * a.wheelDeltaX), "axis" in a && a.axis === a.HORIZONTAL_AXIS && (u = -1 * d, d = 0), h = 0 === d ? u : d, "deltaY" in a && (d = -1 * a.deltaY, h = d), "deltaX" in a && (u = a.deltaX, 0 === d && (h = -1 * u)), 0 !== d || 0 !== u) {
            if (1 === a.deltaMode) {
                var g = t.data(this, "mousewheel-line-height");
                h *= g, d *= g, u *= g
            } else if (2 === a.deltaMode) {
                var v = t.data(this, "mousewheel-page-height");
                h *= v, d *= v, u *= v
            }
            if (p = Math.max(Math.abs(d), Math.abs(u)), (!o || o > p) && (o = p, s(a, p) && (o /= 40)), s(a, p) && (h /= 40, u /= 40, d /= 40), h = Math[h >= 1 ? "floor" : "ceil"](h / o), u = Math[u >= 1 ? "floor" : "ceil"](u / o), d = Math[d >= 1 ? "floor" : "ceil"](d / o), c.settings.normalizeOffset && this.getBoundingClientRect) {
                var b = this.getBoundingClientRect();
                f = e.clientX - b.left, m = e.clientY - b.top
            }
            return e.deltaX = u, e.deltaY = d, e.deltaFactor = o, e.offsetX = f, e.offsetY = m, e.deltaMode = 0, r.unshift(e, h, u, d), n && clearTimeout(n), n = setTimeout(i, 200), (t.event.dispatch || t.event.handle).apply(this, r)
        }
    }

    function i() {
        o = null
    }

    function s(t, e) {
        return c.settings.adjustOldDeltas && "mousewheel" === t.type && e % 120 === 0
    }

    var n, o, a = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
        r = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        l = Array.prototype.slice;
    if (t.event.fixHooks) for (var h = a.length; h;) t.event.fixHooks[a[--h]] = t.event.mouseHooks;
    var c = t.event.special.mousewheel = {
        version: "3.1.12", setup: function () {
            if (this.addEventListener) for (var i = r.length; i;) this.addEventListener(r[--i], e, !1); else this.onmousewheel = e;
            t.data(this, "mousewheel-line-height", c.getLineHeight(this)), t.data(this, "mousewheel-page-height", c.getPageHeight(this))
        }, teardown: function () {
            if (this.removeEventListener) for (var i = r.length; i;) this.removeEventListener(r[--i], e, !1); else this.onmousewheel = null;
            t.removeData(this, "mousewheel-line-height"), t.removeData(this, "mousewheel-page-height")
        }, getLineHeight: function (e) {
            var i = t(e), s = i["offsetParent" in t.fn ? "offsetParent" : "parent"]();
            return s.length || (s = t("body")), parseInt(s.css("fontSize"), 10) || parseInt(i.css("fontSize"), 10) || 16
        }, getPageHeight: function (e) {
            return t(e).height()
        }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
    };
    t.fn.extend({
        mousewheel: function (t) {
            return t ? this.bind("mousewheel", t) : this.trigger("mousewheel")
        }, unmousewheel: function (t) {
            return this.unbind("mousewheel", t)
        }
    })
}), function (t) {
    "use strict";
    t.srSmoothscroll = function (e) {
        var i, s = t.extend({step: 75, speed: 300, ease: "swing", target: t("body"), container: t(window)}, e || {}),
            n = s.container, o = 0, a = s.step, r = n.height(), l = !1;
        i = "body" == s.target.selector ? -1 !== navigator.userAgent.indexOf("AppleWebKit") ? s.target : t("html") : n, s.target.mousewheel(function (t, e) {
            return l = !0, o = 0 > e ? o + r >= s.target.outerHeight(!0) ? o : o += a : 0 >= o ? 0 : o -= a, i.stop().animate({scrollTop: o}, s.speed, s.ease, function () {
                l = !1
            }), !1
        }), n.on("resize", function (t) {
            r = n.height()
        }).on("scroll", function (t) {
            l || (o = n.scrollTop())
        })
    }
}(jQuery), !function (t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
}(function (t) {
    function e(e, s) {
        var n, o, a, r = e.nodeName.toLowerCase();
        return "area" === r ? (n = e.parentNode, o = n.name, e.href && o && "map" === n.nodeName.toLowerCase() ? (a = t("img[usemap='#" + o + "']")[0], !!a && i(a)) : !1) : (/input|select|textarea|button|object/.test(r) ? !e.disabled : "a" === r ? e.href || s : s) && i(e)
    }

    function i(e) {
        return t.expr.filters.visible(e) && !t(e).parents().addBack().filter(function () {
            return "hidden" === t.css(this, "visibility")
        }).length
    }

    function s(t) {
        for (var e, i; t.length && t[0] !== document;) {
            if (e = t.css("position"), ("absolute" === e || "relative" === e || "fixed" === e) && (i = parseInt(t.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
            t = t.parent()
        }
        return 0
    }

    function n() {
        this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: !1,
            showMonthAfterYear: !1,
            yearSuffix: ""
        }, this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: !1,
            hideIfNoPrevNext: !1,
            navigationAsDateFormat: !1,
            gotoCurrent: !1,
            changeMonth: !1,
            changeYear: !1,
            yearRange: "c-10:c+10",
            showOtherMonths: !1,
            selectOtherMonths: !1,
            showWeek: !1,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: !0,
            showButtonPanel: !1,
            autoSize: !1,
            disabled: !1
        }, t.extend(this._defaults, this.regional[""]), this.regional.en = t.extend(!0, {}, this.regional[""]), this.regional["en-US"] = t.extend(!0, {}, this.regional.en), this.dpDiv = o(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
    }

    function o(e) {
        var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return e.delegate(i, "mouseout", function () {
            t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")
        }).delegate(i, "mouseover", a)
    }

    function a() {
        t.datepicker._isDisabledDatepicker(v.inline ? v.dpDiv.parent()[0] : v.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))
    }

    function r(e, i) {
        t.extend(e, i);
        for (var s in i) null == i[s] && (e[s] = i[s]);
        return e
    }

    function l(t) {
        return function () {
            var e = this.element.val();
            t.apply(this, arguments), this._refresh(), e !== this.element.val() && this._trigger("change")
        }
    }

    t.ui = t.ui || {}, t.extend(t.ui, {
        version: "1.11.1",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), t.fn.extend({
        scrollParent: function (e) {
            var i = this.css("position"), s = "absolute" === i, n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
                o = this.parents().filter(function () {
                    var e = t(this);
                    return s && "static" === e.css("position") ? !1 : n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
                }).eq(0);
            return "fixed" !== i && o.length ? o : t(this[0].ownerDocument || document)
        }, uniqueId: function () {
            var t = 0;
            return function () {
                return this.each(function () {
                    this.id || (this.id = "ui-id-" + ++t)
                })
            }
        }(), removeUniqueId: function () {
            return this.each(function () {
                /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id")
            })
        }
    }), t.extend(t.expr[":"], {
        data: t.expr.createPseudo ? t.expr.createPseudo(function (e) {
            return function (i) {
                return !!t.data(i, e)
            }
        }) : function (e, i, s) {
            return !!t.data(e, s[3])
        }, focusable: function (i) {
            return e(i, !isNaN(t.attr(i, "tabindex")))
        }, tabbable: function (i) {
            var s = t.attr(i, "tabindex"), n = isNaN(s);
            return (n || s >= 0) && e(i, !n)
        }
    }), t("<a>").outerWidth(1).jquery || t.each(["Width", "Height"], function (e, i) {
        function s(e, i, s, o) {
            return t.each(n, function () {
                i -= parseFloat(t.css(e, "padding" + this)) || 0, s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), o && (i -= parseFloat(t.css(e, "margin" + this)) || 0)
            }), i
        }

        var n = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"], o = i.toLowerCase(), a = {
            innerWidth: t.fn.innerWidth,
            innerHeight: t.fn.innerHeight,
            outerWidth: t.fn.outerWidth,
            outerHeight: t.fn.outerHeight
        };
        t.fn["inner" + i] = function (e) {
            return void 0 === e ? a["inner" + i].call(this) : this.each(function () {
                t(this).css(o, s(this, e) + "px")
            })
        }, t.fn["outer" + i] = function (e, n) {
            return "number" != typeof e ? a["outer" + i].call(this, e) : this.each(function () {
                t(this).css(o, s(this, e, !0, n) + "px")
            })
        }
    }), t.fn.addBack || (t.fn.addBack = function (t) {
        return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
    }), t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = function (e) {
        return function (i) {
            return arguments.length ? e.call(this, t.camelCase(i)) : e.call(this)
        }
    }(t.fn.removeData)), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), t.fn.extend({
        focus: function (e) {
            return function (i, s) {
                return "number" == typeof i ? this.each(function () {
                    var e = this;
                    setTimeout(function () {
                        t(e).focus(), s && s.call(e)
                    }, i)
                }) : e.apply(this, arguments)
            }
        }(t.fn.focus), disableSelection: function () {
            var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function () {
                return this.bind(t + ".ui-disableSelection", function (t) {
                    t.preventDefault()
                })
            }
        }(), enableSelection: function () {
            return this.unbind(".ui-disableSelection")
        }, zIndex: function (e) {
            if (void 0 !== e) return this.css("zIndex", e);
            if (this.length) for (var i, s, n = t(this[0]); n.length && n[0] !== document;) {
                if (i = n.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), !isNaN(s) && 0 !== s)) return s;
                n = n.parent()
            }
            return 0
        }
    }), t.ui.plugin = {
        add: function (e, i, s) {
            var n, o = t.ui[e].prototype;
            for (n in s) o.plugins[n] = o.plugins[n] || [], o.plugins[n].push([i, s[n]])
        }, call: function (t, e, i, s) {
            var n, o = t.plugins[e];
            if (o && (s || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType)) for (n = 0; n < o.length; n++) t.options[o[n][0]] && o[n][1].apply(t.element, i)
        }
    };
    var h = 0, c = Array.prototype.slice;
    t.cleanData = function (e) {
        return function (i) {
            var s, n, o;
            for (o = 0; null != (n = i[o]); o++) try {
                s = t._data(n, "events"), s && s.remove && t(n).triggerHandler("remove")
            } catch (a) {
            }
            e(i)
        }
    }(t.cleanData), t.widget = function (e, i, s) {
        var n, o, a, r, l = {}, h = e.split(".")[0];
        return e = e.split(".")[1], n = h + "-" + e, s || (s = i, i = t.Widget), t.expr[":"][n.toLowerCase()] = function (e) {
            return !!t.data(e, n)
        }, t[h] = t[h] || {}, o = t[h][e], a = t[h][e] = function (t, e) {
            return this._createWidget ? void (arguments.length && this._createWidget(t, e)) : new a(t, e)
        }, t.extend(a, o, {
            version: s.version,
            _proto: t.extend({}, s),
            _childConstructors: []
        }), r = new i, r.options = t.widget.extend({}, r.options), t.each(s, function (e, s) {
            return t.isFunction(s) ? void (l[e] = function () {
                var t = function () {
                    return i.prototype[e].apply(this, arguments)
                }, n = function (t) {
                    return i.prototype[e].apply(this, t)
                };
                return function () {
                    var e, i = this._super, o = this._superApply;
                    return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, this._superApply = o, e
                }
            }()) : void (l[e] = s)
        }), a.prototype = t.widget.extend(r, {widgetEventPrefix: o ? r.widgetEventPrefix || e : e}, l, {
            constructor: a,
            namespace: h,
            widgetName: e,
            widgetFullName: n
        }), o ? (t.each(o._childConstructors, function (e, i) {
            var s = i.prototype;
            t.widget(s.namespace + "." + s.widgetName, a, i._proto)
        }), delete o._childConstructors) : i._childConstructors.push(a), t.widget.bridge(e, a), a
    }, t.widget.extend = function (e) {
        for (var i, s, n = c.call(arguments, 1), o = 0, a = n.length; a > o; o++) for (i in n[o]) s = n[o][i], n[o].hasOwnProperty(i) && void 0 !== s && (t.isPlainObject(s) ? e[i] = t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], s) : t.widget.extend({}, s) : e[i] = s);
        return e
    }, t.widget.bridge = function (e, i) {
        var s = i.prototype.widgetFullName || e;
        t.fn[e] = function (n) {
            var o = "string" == typeof n, a = c.call(arguments, 1), r = this;
            return n = !o && a.length ? t.widget.extend.apply(null, [n].concat(a)) : n, o ? this.each(function () {
                var i, o = t.data(this, s);
                return "instance" === n ? (r = o, !1) : o ? t.isFunction(o[n]) && "_" !== n.charAt(0) ? (i = o[n].apply(o, a), i !== o && void 0 !== i ? (r = i && i.jquery ? r.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + n + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + n + "'")
            }) : this.each(function () {
                var e = t.data(this, s);
                e ? (e.option(n || {}), e._init && e._init()) : t.data(this, s, new i(n, this))
            }), r
        }
    }, t.Widget = function () {
    }, t.Widget._childConstructors = [], t.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {disabled: !1, create: null},
        _createWidget: function (e, i) {
            i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = h++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this.bindings = t(), this.hoverable = t(), this.focusable = t(), i !== this && (t.data(i, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function (t) {
                    t.target === i && this.destroy()
                }
            }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: t.noop,
        _getCreateEventData: t.noop,
        _create: t.noop,
        _init: t.noop,
        destroy: function () {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: t.noop,
        widget: function () {
            return this.element
        },
        option: function (e, i) {
            var s, n, o, a = e;
            if (0 === arguments.length) return t.widget.extend({}, this.options);
            if ("string" == typeof e) if (a = {}, s = e.split("."), e = s.shift(), s.length) {
                for (n = a[e] = t.widget.extend({}, this.options[e]), o = 0; o < s.length - 1; o++) n[s[o]] = n[s[o]] || {}, n = n[s[o]];
                if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
                n[e] = i
            } else {
                if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                a[e] = i
            }
            return this._setOptions(a), this
        },
        _setOptions: function (t) {
            var e;
            for (e in t) this._setOption(e, t[e]);
            return this
        },
        _setOption: function (t, e) {
            return this.options[t] = e, "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!e), e && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
        },
        enable: function () {
            return this._setOptions({disabled: !1})
        },
        disable: function () {
            return this._setOptions({disabled: !0})
        },
        _on: function (e, i, s) {
            var n, o = this;
            "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), t.each(s, function (s, a) {
                function r() {
                    return e || o.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof a ? o[a] : a).apply(o, arguments) : void 0
                }

                "string" != typeof a && (r.guid = a.guid = a.guid || r.guid || t.guid++);
                var l = s.match(/^([\w:-]*)\s*(.*)$/), h = l[1] + o.eventNamespace, c = l[2];
                c ? n.delegate(c, h, r) : i.bind(h, r)
            })
        },
        _off: function (t, e) {
            e = (e || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, t.unbind(e).undelegate(e)
        },
        _delay: function (t, e) {
            function i() {
                return ("string" == typeof t ? s[t] : t).apply(s, arguments)
            }

            var s = this;
            return setTimeout(i, e || 0)
        },
        _hoverable: function (e) {
            this.hoverable = this.hoverable.add(e), this._on(e, {
                mouseenter: function (e) {
                    t(e.currentTarget).addClass("ui-state-hover")
                }, mouseleave: function (e) {
                    t(e.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function (e) {
            this.focusable = this.focusable.add(e), this._on(e, {
                focusin: function (e) {
                    t(e.currentTarget).addClass("ui-state-focus")
                }, focusout: function (e) {
                    t(e.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function (e, i, s) {
            var n, o, a = this.options[e];
            if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], o = i.originalEvent) for (n in o) n in i || (i[n] = o[n]);
            return this.element.trigger(i, s), !(t.isFunction(a) && a.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented())
        }
    }, t.each({show: "fadeIn", hide: "fadeOut"}, function (e, i) {
        t.Widget.prototype["_" + e] = function (s, n, o) {
            "string" == typeof n && (n = {effect: n});
            var a, r = n ? n === !0 || "number" == typeof n ? i : n.effect || i : e;
            n = n || {}, "number" == typeof n && (n = {duration: n}), a = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), a && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, o) : s.queue(function (i) {
                t(this)[e](), o && o.call(s[0]), i()
            })
        }
    });
    var u = (t.widget, !1);
    t(document).mouseup(function () {
        u = !1
    }), t.widget("ui.mouse", {
        version: "1.11.1",
        options: {cancel: "input,textarea,button,select,option", distance: 1, delay: 0},
        _mouseInit: function () {
            var e = this;
            this.element.bind("mousedown." + this.widgetName, function (t) {
                return e._mouseDown(t)
            }).bind("click." + this.widgetName, function (i) {
                return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0
            }), this.started = !1
        },
        _mouseDestroy: function () {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function (e) {
            if (!u) {
                this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                var i = this, s = 1 === e.which,
                    n = "string" == typeof this.options.cancel && e.target.nodeName ? t(e.target).closest(this.options.cancel).length : !1;
                return s && !n && this._mouseCapture(e) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
                    i.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(e) !== !1, !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (t) {
                    return i._mouseMove(t)
                }, this._mouseUpDelegate = function (t) {
                    return i._mouseUp(t)
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), u = !0, !0)) : !0
            }
        },
        _mouseMove: function (e) {
            return t.ui.ie && (!document.documentMode || document.documentMode < 9) && !e.button ? this._mouseUp(e) : e.which ? this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted) : this._mouseUp(e)
        },
        _mouseUp: function (e) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), u = !1, !1
        },
        _mouseDistanceMet: function (t) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function () {
            return this.mouseDelayMet
        },
        _mouseStart: function () {
        },
        _mouseDrag: function () {
        },
        _mouseStop: function () {
        },
        _mouseCapture: function () {
            return !0
        }
    }), !function () {
        function e(t, e, i) {
            return [parseFloat(t[0]) * (p.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (p.test(t[1]) ? i / 100 : 1)]
        }

        function i(e, i) {
            return parseInt(t.css(e, i), 10) || 0
        }

        function s(e) {
            var i = e[0];
            return 9 === i.nodeType ? {
                width: e.width(),
                height: e.height(),
                offset: {top: 0, left: 0}
            } : t.isWindow(i) ? {
                width: e.width(),
                height: e.height(),
                offset: {top: e.scrollTop(), left: e.scrollLeft()}
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {top: i.pageY, left: i.pageX}
            } : {width: e.outerWidth(), height: e.outerHeight(), offset: e.offset()}
        }

        t.ui = t.ui || {};
        var n, o, a = Math.max, r = Math.abs, l = Math.round, h = /left|center|right/, c = /top|center|bottom/,
            u = /[\+\-]\d+(\.[\d]+)?%?/, d = /^\w+/, p = /%$/, f = t.fn.position;
        t.position = {
            scrollbarWidth: function () {
                if (void 0 !== n) return n;
                var e, i,
                    s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                    o = s.children()[0];
                return t("body").append(s), e = o.offsetWidth, s.css("overflow", "scroll"), i = o.offsetWidth, e === i && (i = s[0].clientWidth), s.remove(), n = e - i
            }, getScrollInfo: function (e) {
                var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
                    s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
                    n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth,
                    o = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight;
                return {width: o ? t.position.scrollbarWidth() : 0, height: n ? t.position.scrollbarWidth() : 0}
            }, getWithinInfo: function (e) {
                var i = t(e || window), s = t.isWindow(i[0]), n = !!i[0] && 9 === i[0].nodeType;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: n,
                    offset: i.offset() || {left: 0, top: 0},
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: s || n ? i.width() : i.outerWidth(),
                    height: s || n ? i.height() : i.outerHeight()
                }
            }
        }, t.fn.position = function (n) {
            if (!n || !n.of) return f.apply(this, arguments);
            n = t.extend({}, n);
            var p, m, g, v, b, y, _ = t(n.of), w = t.position.getWithinInfo(n.within), x = t.position.getScrollInfo(w),
                k = (n.collision || "flip").split(" "), C = {};
            return y = s(_), _[0].preventDefault && (n.at = "left top"), m = y.width, g = y.height, v = y.offset, b = t.extend({}, v), t.each(["my", "at"], function () {
                var t, e, i = (n[this] || "").split(" ");
                1 === i.length && (i = h.test(i[0]) ? i.concat(["center"]) : c.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = h.test(i[0]) ? i[0] : "center", i[1] = c.test(i[1]) ? i[1] : "center", t = u.exec(i[0]), e = u.exec(i[1]), C[this] = [t ? t[0] : 0, e ? e[0] : 0], n[this] = [d.exec(i[0])[0], d.exec(i[1])[0]]
            }), 1 === k.length && (k[1] = k[0]), "right" === n.at[0] ? b.left += m : "center" === n.at[0] && (b.left += m / 2), "bottom" === n.at[1] ? b.top += g : "center" === n.at[1] && (b.top += g / 2), p = e(C.at, m, g), b.left += p[0], b.top += p[1], this.each(function () {
                var s, h, c = t(this), u = c.outerWidth(), d = c.outerHeight(), f = i(this, "marginLeft"),
                    y = i(this, "marginTop"), D = u + f + i(this, "marginRight") + x.width,
                    P = d + y + i(this, "marginBottom") + x.height, T = t.extend({}, b),
                    I = e(C.my, c.outerWidth(), c.outerHeight());
                "right" === n.my[0] ? T.left -= u : "center" === n.my[0] && (T.left -= u / 2), "bottom" === n.my[1] ? T.top -= d : "center" === n.my[1] && (T.top -= d / 2), T.left += I[0], T.top += I[1], o || (T.left = l(T.left), T.top = l(T.top)), s = {
                    marginLeft: f,
                    marginTop: y
                }, t.each(["left", "top"], function (e, i) {
                    t.ui.position[k[e]] && t.ui.position[k[e]][i](T, {
                        targetWidth: m,
                        targetHeight: g,
                        elemWidth: u,
                        elemHeight: d,
                        collisionPosition: s,
                        collisionWidth: D,
                        collisionHeight: P,
                        offset: [p[0] + I[0], p[1] + I[1]],
                        my: n.my,
                        at: n.at,
                        within: w,
                        elem: c
                    })
                }), n.using && (h = function (t) {
                    var e = v.left - T.left, i = e + m - u, s = v.top - T.top, o = s + g - d, l = {
                        target: {element: _, left: v.left, top: v.top, width: m, height: g},
                        element: {element: c, left: T.left, top: T.top, width: u, height: d},
                        horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
                        vertical: 0 > o ? "top" : s > 0 ? "bottom" : "middle"
                    };
                    u > m && r(e + i) < m && (l.horizontal = "center"), d > g && r(s + o) < g && (l.vertical = "middle"), a(r(e), r(i)) > a(r(s), r(o)) ? l.important = "horizontal" : l.important = "vertical", n.using.call(this, t, l)
                }), c.offset(t.extend(T, {using: h}))
            })
        }, t.ui.position = {
            fit: {
                left: function (t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollLeft : s.offset.left, o = s.width,
                        r = t.left - e.collisionPosition.marginLeft, l = n - r, h = r + e.collisionWidth - o - n;
                    e.collisionWidth > o ? l > 0 && 0 >= h ? (i = t.left + l + e.collisionWidth - o - n, t.left += l - i) : h > 0 && 0 >= l ? t.left = n : l > h ? t.left = n + o - e.collisionWidth : t.left = n : l > 0 ? t.left += l : h > 0 ? t.left -= h : t.left = a(t.left - r, t.left)
                }, top: function (t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollTop : s.offset.top, o = e.within.height,
                        r = t.top - e.collisionPosition.marginTop, l = n - r, h = r + e.collisionHeight - o - n;
                    e.collisionHeight > o ? l > 0 && 0 >= h ? (i = t.top + l + e.collisionHeight - o - n, t.top += l - i) : h > 0 && 0 >= l ? t.top = n : l > h ? t.top = n + o - e.collisionHeight : t.top = n : l > 0 ? t.top += l : h > 0 ? t.top -= h : t.top = a(t.top - r, t.top)
                }
            }, flip: {
                left: function (t, e) {
                    var i, s, n = e.within, o = n.offset.left + n.scrollLeft, a = n.width,
                        l = n.isWindow ? n.scrollLeft : n.offset.left, h = t.left - e.collisionPosition.marginLeft,
                        c = h - l, u = h + e.collisionWidth - a - l,
                        d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
                        p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
                        f = -2 * e.offset[0];
                    0 > c ? (i = t.left + d + p + f + e.collisionWidth - a - o, (0 > i || i < r(c)) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - l, (s > 0 || r(s) < u) && (t.left += d + p + f))
                }, top: function (t, e) {
                    var i, s, n = e.within, o = n.offset.top + n.scrollTop, a = n.height,
                        l = n.isWindow ? n.scrollTop : n.offset.top, h = t.top - e.collisionPosition.marginTop,
                        c = h - l, u = h + e.collisionHeight - a - l, d = "top" === e.my[1],
                        p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
                        f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
                        m = -2 * e.offset[1];
                    0 > c ? (s = t.top + p + f + m + e.collisionHeight - a - o, t.top + p + f + m > c && (0 > s || s < r(c)) && (t.top += p + f + m)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + m - l, t.top + p + f + m > u && (i > 0 || r(i) < u) && (t.top += p + f + m))
                }
            }, flipfit: {
                left: function () {
                    t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments)
                }, top: function () {
                    t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments)
                }
            }
        }, function () {
            var e, i, s, n, a, r = document.getElementsByTagName("body")[0], l = document.createElement("div");
            e = document.createElement(r ? "div" : "body"), s = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, r && t.extend(s, {position: "absolute", left: "-1000px", top: "-1000px"});
            for (a in s) e.style[a] = s[a];
            e.appendChild(l), i = r || document.documentElement, i.insertBefore(e, i.firstChild), l.style.cssText = "position: absolute; left: 10.7432222px;", n = t(l).offset().left, o = n > 10 && 11 > n, e.innerHTML = "", i.removeChild(e)
        }()
    }(), t.ui.position, t.widget("ui.accordion", {
        version: "1.11.1",
        options: {
            active: 0,
            animate: {},
            collapsible: !1,
            event: "click",
            header: "> li > :first-child,> :not(li):even",
            heightStyle: "auto",
            icons: {activeHeader: "ui-icon-triangle-1-s", header: "ui-icon-triangle-1-e"},
            activate: null,
            beforeActivate: null
        },
        hideProps: {
            borderTopWidth: "hide",
            borderBottomWidth: "hide",
            paddingTop: "hide",
            paddingBottom: "hide",
            height: "hide"
        },
        showProps: {
            borderTopWidth: "show",
            borderBottomWidth: "show",
            paddingTop: "show",
            paddingBottom: "show",
            height: "show"
        },
        _create: function () {
            var e = this.options;
            this.prevShow = this.prevHide = t(), this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"), e.collapsible || e.active !== !1 && null != e.active || (e.active = 0), this._processPanels(), e.active < 0 && (e.active += this.headers.length), this._refresh()
        },
        _getCreateEventData: function () {
            return {header: this.active, panel: this.active.length ? this.active.next() : t()}
        },
        _createIcons: function () {
            var e = this.options.icons;
            e && (t("<span>").addClass("ui-accordion-header-icon ui-icon " + e.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(e.header).addClass(e.activeHeader), this.headers.addClass("ui-accordion-icons"))
        },
        _destroyIcons: function () {
            this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()
        },
        _destroy: function () {
            var t;
            this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"), this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").removeUniqueId(), this._destroyIcons(), t = this.headers.next().removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").css("display", "").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && t.css("height", "")
        },
        _setOption: function (t, e) {
            return "active" === t ? void this._activate(e) : ("event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || this.options.active !== !1 || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons()), void ("disabled" === t && (this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!e))))
        },
        _keydown: function (e) {
            if (!e.altKey && !e.ctrlKey) {
                var i = t.ui.keyCode, s = this.headers.length, n = this.headers.index(e.target), o = !1;
                switch (e.keyCode) {
                    case i.RIGHT:
                    case i.DOWN:
                        o = this.headers[(n + 1) % s];
                        break;
                    case i.LEFT:
                    case i.UP:
                        o = this.headers[(n - 1 + s) % s];
                        break;
                    case i.SPACE:
                    case i.ENTER:
                        this._eventHandler(e);
                        break;
                    case i.HOME:
                        o = this.headers[0];
                        break;
                    case i.END:
                        o = this.headers[s - 1]
                }
                o && (t(e.target).attr("tabIndex", -1), t(o).attr("tabIndex", 0), o.focus(), e.preventDefault())
            }
        },
        _panelKeyDown: function (e) {
            e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().focus()
        },
        refresh: function () {
            var e = this.options;
            this._processPanels(), e.active === !1 && e.collapsible === !0 || !this.headers.length ? (e.active = !1, this.active = t()) : e.active === !1 ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
        },
        _processPanels: function () {
            this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-state-default ui-corner-all"), this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()
        },
        _refresh: function () {
            var e, i = this.options, s = i.heightStyle, n = this.element.parent();
            this.active = this._findActive(i.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"), this.active.next().addClass("ui-accordion-content-active").show(),
                this.headers.attr("role", "tab").each(function () {
                    var e = t(this), i = e.uniqueId().attr("id"), s = e.next(), n = s.uniqueId().attr("id");
                    e.attr("aria-controls", n), s.attr("aria-labelledby", i)
                }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
                "aria-selected": "false",
                "aria-expanded": "false",
                tabIndex: -1
            }).next().attr({"aria-hidden": "true"}).hide(), this.active.length ? this.active.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            }).next().attr({"aria-hidden": "false"}) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(i.event), "fill" === s ? (e = n.height(), this.element.siblings(":visible").each(function () {
                var i = t(this), s = i.css("position");
                "absolute" !== s && "fixed" !== s && (e -= i.outerHeight(!0))
            }), this.headers.each(function () {
                e -= t(this).outerHeight(!0)
            }), this.headers.next().each(function () {
                t(this).height(Math.max(0, e - t(this).innerHeight() + t(this).height()))
            }).css("overflow", "auto")) : "auto" === s && (e = 0, this.headers.next().each(function () {
                e = Math.max(e, t(this).css("height", "").height())
            }).height(e))
        },
        _activate: function (e) {
            var i = this._findActive(e)[0];
            i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
                target: i,
                currentTarget: i,
                preventDefault: t.noop
            }))
        },
        _findActive: function (e) {
            return "number" == typeof e ? this.headers.eq(e) : t()
        },
        _setupEvents: function (e) {
            var i = {keydown: "_keydown"};
            e && t.each(e.split(" "), function (t, e) {
                i[e] = "_eventHandler"
            }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {keydown: "_panelKeyDown"}), this._hoverable(this.headers), this._focusable(this.headers)
        },
        _eventHandler: function (e) {
            var i = this.options, s = this.active, n = t(e.currentTarget), o = n[0] === s[0], a = o && i.collapsible,
                r = a ? t() : n.next(), l = s.next(),
                h = {oldHeader: s, oldPanel: l, newHeader: a ? t() : n, newPanel: r};
            e.preventDefault(), o && !i.collapsible || this._trigger("beforeActivate", e, h) === !1 || (i.active = a ? !1 : this.headers.index(n), this.active = o ? t() : n, this._toggle(h), s.removeClass("ui-accordion-header-active ui-state-active"), i.icons && s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header), o || (n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), i.icons && n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader), n.next().addClass("ui-accordion-content-active")))
        },
        _toggle: function (e) {
            var i = e.newPanel, s = this.prevShow.length ? this.prevShow : e.oldPanel;
            this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)), s.attr({"aria-hidden": "true"}), s.prev().attr("aria-selected", "false"), i.length && s.length ? s.prev().attr({
                tabIndex: -1,
                "aria-expanded": "false"
            }) : i.length && this.headers.filter(function () {
                return 0 === t(this).attr("tabIndex")
            }).attr("tabIndex", -1), i.attr("aria-hidden", "false").prev().attr({
                "aria-selected": "true",
                tabIndex: 0,
                "aria-expanded": "true"
            })
        },
        _animate: function (t, e, i) {
            var s, n, o, a = this, r = 0, l = t.length && (!e.length || t.index() < e.index()),
                h = this.options.animate || {}, c = l && h.down || h, u = function () {
                    a._toggleComplete(i)
                };
            return "number" == typeof c && (o = c), "string" == typeof c && (n = c), n = n || c.easing || h.easing, o = o || c.duration || h.duration, e.length ? t.length ? (s = t.show().outerHeight(), e.animate(this.hideProps, {
                duration: o,
                easing: n,
                step: function (t, e) {
                    e.now = Math.round(t)
                }
            }), void t.hide().animate(this.showProps, {
                duration: o, easing: n, complete: u, step: function (t, i) {
                    i.now = Math.round(t), "height" !== i.prop ? r += i.now : "content" !== a.options.heightStyle && (i.now = Math.round(s - e.outerHeight() - r), r = 0)
                }
            })) : e.animate(this.hideProps, o, n, u) : t.animate(this.showProps, o, n, u)
        },
        _toggleComplete: function (t) {
            var e = t.oldPanel;
            e.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"), e.length && (e.parent()[0].className = e.parent()[0].className), this._trigger("activate", null, t)
        }
    }), t.widget("ui.menu", {
        version: "1.11.1",
        defaultElement: "<ul>",
        delay: 300,
        options: {
            icons: {submenu: "ui-icon-carat-1-e"},
            items: "> *",
            menus: "ul",
            position: {my: "left-1 top", at: "right top"},
            role: "menu",
            blur: null,
            focus: null,
            select: null
        },
        _create: function () {
            this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
                role: this.options.role,
                tabIndex: 0
            }), this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"), this._on({
                "mousedown .ui-menu-item": function (t) {
                    t.preventDefault()
                }, "click .ui-menu-item": function (e) {
                    var i = t(e.target);
                    !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && t(this.document[0].activeElement).closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                }, "mouseenter .ui-menu-item": function (e) {
                    var i = t(e.currentTarget);
                    i.siblings(".ui-state-active").removeClass("ui-state-active"), this.focus(e, i)
                }, mouseleave: "collapseAll", "mouseleave .ui-menu": "collapseAll", focus: function (t, e) {
                    var i = this.active || this.element.find(this.options.items).eq(0);
                    e || this.focus(t, i)
                }, blur: function (e) {
                    this._delay(function () {
                        t.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(e)
                    })
                }, keydown: "_keydown"
            }), this.refresh(), this._on(this.document, {
                click: function (t) {
                    this._closeOnDocumentClick(t) && this.collapseAll(t), this.mouseHandled = !1
                }
            })
        },
        _destroy: function () {
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(), this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function () {
                var e = t(this);
                e.data("ui-menu-submenu-carat") && e.remove()
            }), this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
        },
        _keydown: function (e) {
            function i(t) {
                return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
            }

            var s, n, o, a, r, l = !0;
            switch (e.keyCode) {
                case t.ui.keyCode.PAGE_UP:
                    this.previousPage(e);
                    break;
                case t.ui.keyCode.PAGE_DOWN:
                    this.nextPage(e);
                    break;
                case t.ui.keyCode.HOME:
                    this._move("first", "first", e);
                    break;
                case t.ui.keyCode.END:
                    this._move("last", "last", e);
                    break;
                case t.ui.keyCode.UP:
                    this.previous(e);
                    break;
                case t.ui.keyCode.DOWN:
                    this.next(e);
                    break;
                case t.ui.keyCode.LEFT:
                    this.collapse(e);
                    break;
                case t.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                    break;
                case t.ui.keyCode.ENTER:
                case t.ui.keyCode.SPACE:
                    this._activate(e);
                    break;
                case t.ui.keyCode.ESCAPE:
                    this.collapse(e);
                    break;
                default:
                    l = !1, n = this.previousFilter || "", o = String.fromCharCode(e.keyCode), a = !1, clearTimeout(this.filterTimer), o === n ? a = !0 : o = n + o, r = new RegExp("^" + i(o), "i"), s = this.activeMenu.find(this.options.items).filter(function () {
                        return r.test(t(this).text())
                    }), s = a && -1 !== s.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : s, s.length || (o = String.fromCharCode(e.keyCode), r = new RegExp("^" + i(o), "i"), s = this.activeMenu.find(this.options.items).filter(function () {
                        return r.test(t(this).text())
                    })), s.length ? (this.focus(e, s), s.length > 1 ? (this.previousFilter = o, this.filterTimer = this._delay(function () {
                        delete this.previousFilter
                    }, 1e3)) : delete this.previousFilter) : delete this.previousFilter
            }
            l && e.preventDefault()
        },
        _activate: function (t) {
            this.active.is(".ui-state-disabled") || (this.active.is("[aria-haspopup='true']") ? this.expand(t) : this.select(t))
        },
        refresh: function () {
            var e, i, s = this, n = this.options.icons.submenu, o = this.element.find(this.options.menus);
            this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length), o.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function () {
                var e = t(this), i = e.parent(),
                    s = t("<span>").addClass("ui-menu-icon ui-icon " + n).data("ui-menu-submenu-carat", !0);
                i.attr("aria-haspopup", "true").prepend(s), e.attr("aria-labelledby", i.attr("id"))
            }), e = o.add(this.element), i = e.find(this.options.items), i.not(".ui-menu-item").each(function () {
                var e = t(this);
                s._isDivider(e) && e.addClass("ui-widget-content ui-menu-divider")
            }), i.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({
                tabIndex: -1,
                role: this._itemRole()
            }), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !t.contains(this.element[0], this.active[0]) && this.blur()
        },
        _itemRole: function () {
            return {menu: "menuitem", listbox: "option"}[this.options.role]
        },
        _setOption: function (t, e) {
            "icons" === t && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(e.submenu), "disabled" === t && this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this._super(t, e)
        },
        focus: function (t, e) {
            var i, s;
            this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), s = this.active.addClass("ui-state-focus").removeClass("ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), this.active.parent().closest(".ui-menu-item").addClass("ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay(function () {
                this._close()
            }, this.delay), i = e.children(".ui-menu"), i.length && t && /^mouse/.test(t.type) && this._startOpening(i), this.activeMenu = e.parent(), this._trigger("focus", t, {item: e})
        },
        _scrollIntoView: function (e) {
            var i, s, n, o, a, r;
            this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, o = this.activeMenu.scrollTop(), a = this.activeMenu.height(), r = e.outerHeight(), 0 > n ? this.activeMenu.scrollTop(o + n) : n + r > a && this.activeMenu.scrollTop(o + n - a + r))
        },
        blur: function (t, e) {
            e || clearTimeout(this.timer), this.active && (this.active.removeClass("ui-state-focus"), this.active = null, this._trigger("blur", t, {item: this.active}))
        },
        _startOpening: function (t) {
            clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay(function () {
                this._close(), this._open(t)
            }, this.delay))
        },
        _open: function (e) {
            var i = t.extend({of: this.active}, this.options.position);
            clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
        },
        collapseAll: function (e, i) {
            clearTimeout(this.timer), this.timer = this._delay(function () {
                var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
                s.length || (s = this.element), this._close(s), this.blur(e), this.activeMenu = s
            }, this.delay)
        },
        _close: function (t) {
            t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active")
        },
        _closeOnDocumentClick: function (e) {
            return !t(e.target).closest(".ui-menu").length
        },
        _isDivider: function (t) {
            return !/[^\-\u2014\u2013\s]/.test(t.text())
        },
        collapse: function (t) {
            var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            e && e.length && (this._close(), this.focus(t, e))
        },
        expand: function (t) {
            var e = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
            e && e.length && (this._open(e.parent()), this._delay(function () {
                this.focus(t, e)
            }))
        },
        next: function (t) {
            this._move("next", "first", t)
        },
        previous: function (t) {
            this._move("prev", "last", t)
        },
        isFirstItem: function () {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        isLastItem: function () {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        _move: function (t, e, i) {
            var s;
            this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[e]()), this.focus(i, s)
        },
        nextPage: function (e) {
            var i, s, n;
            return this.active ? void (this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
                return i = t(this), i.offset().top - s - n < 0
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]()))) : void this.next(e)
        },
        previousPage: function (e) {
            var i, s, n;
            return this.active ? void (this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
                return i = t(this), i.offset().top - s + n > 0
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items).first()))) : void this.next(e)
        },
        _hasScroll: function () {
            return this.element.outerHeight() < this.element.prop("scrollHeight")
        },
        select: function (e) {
            this.active = this.active || t(e.target).closest(".ui-menu-item");
            var i = {item: this.active};
            this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i)
        }
    }), t.widget("ui.autocomplete", {
        version: "1.11.1",
        defaultElement: "<input>",
        options: {
            appendTo: null,
            autoFocus: !1,
            delay: 300,
            minLength: 1,
            position: {my: "left top", at: "left bottom", collision: "none"},
            source: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            response: null,
            search: null,
            select: null
        },
        requestIndex: 0,
        pending: 0,
        _create: function () {
            var e, i, s, n = this.element[0].nodeName.toLowerCase(), o = "textarea" === n, a = "input" === n;
            this.isMultiLine = o ? !0 : a ? !1 : this.element.prop("isContentEditable"), this.valueMethod = this.element[o || a ? "val" : "text"], this.isNewMenu = !0, this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"), this._on(this.element, {
                keydown: function (n) {
                    if (this.element.prop("readOnly")) return e = !0, s = !0, void (i = !0);
                    e = !1, s = !1, i = !1;
                    var o = t.ui.keyCode;
                    switch (n.keyCode) {
                        case o.PAGE_UP:
                            e = !0, this._move("previousPage", n);
                            break;
                        case o.PAGE_DOWN:
                            e = !0, this._move("nextPage", n);
                            break;
                        case o.UP:
                            e = !0, this._keyEvent("previous", n);
                            break;
                        case o.DOWN:
                            e = !0, this._keyEvent("next", n);
                            break;
                        case o.ENTER:
                            this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
                            break;
                        case o.TAB:
                            this.menu.active && this.menu.select(n);
                            break;
                        case o.ESCAPE:
                            this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(n), n.preventDefault());
                            break;
                        default:
                            i = !0, this._searchTimeout(n)
                    }
                }, keypress: function (s) {
                    if (e) return e = !1, void ((!this.isMultiLine || this.menu.element.is(":visible")) && s.preventDefault());
                    if (!i) {
                        var n = t.ui.keyCode;
                        switch (s.keyCode) {
                            case n.PAGE_UP:
                                this._move("previousPage", s);
                                break;
                            case n.PAGE_DOWN:
                                this._move("nextPage", s);
                                break;
                            case n.UP:
                                this._keyEvent("previous", s);
                                break;
                            case n.DOWN:
                                this._keyEvent("next", s)
                        }
                    }
                }, input: function (t) {
                    return s ? (s = !1, void t.preventDefault()) : void this._searchTimeout(t)
                }, focus: function () {
                    this.selectedItem = null, this.previous = this._value()
                }, blur: function (t) {
                    return this.cancelBlur ? void delete this.cancelBlur : (clearTimeout(this.searching), this.close(t), void this._change(t))
                }
            }), this._initSource(), this.menu = t("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({role: null}).hide().menu("instance"), this._on(this.menu.element, {
                mousedown: function (e) {
                    e.preventDefault(), this.cancelBlur = !0, this._delay(function () {
                        delete this.cancelBlur
                    });
                    var i = this.menu.element[0];
                    t(e.target).closest(".ui-menu-item").length || this._delay(function () {
                        var e = this;
                        this.document.one("mousedown", function (s) {
                            s.target === e.element[0] || s.target === i || t.contains(i, s.target) || e.close()
                        })
                    })
                }, menufocus: function (e, i) {
                    var s, n;
                    return this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type)) ? (this.menu.blur(), void this.document.one("mousemove", function () {
                        t(e.target).trigger(e.originalEvent)
                    })) : (n = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", e, {item: n}) && e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(n.value), s = i.item.attr("aria-label") || n.value, void (s && t.trim(s).length && (this.liveRegion.children().hide(), t("<div>").text(s).appendTo(this.liveRegion))))
                }, menuselect: function (t, e) {
                    var i = e.item.data("ui-autocomplete-item"), s = this.previous;
                    this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = s, this._delay(function () {
                        this.previous = s, this.selectedItem = i
                    })), !1 !== this._trigger("select", t, {item: i}) && this._value(i.value), this.term = this._value(), this.close(t), this.selectedItem = i
                }
            }), this.liveRegion = t("<span>", {
                role: "status",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body), this._on(this.window, {
                beforeunload: function () {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _destroy: function () {
            clearTimeout(this.searching), this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
        },
        _setOption: function (t, e) {
            this._super(t, e), "source" === t && this._initSource(), "appendTo" === t && this.menu.element.appendTo(this._appendTo()), "disabled" === t && e && this.xhr && this.xhr.abort()
        },
        _appendTo: function () {
            var e = this.options.appendTo;
            return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front")), e.length || (e = this.document[0].body), e
        },
        _initSource: function () {
            var e, i, s = this;
            t.isArray(this.options.source) ? (e = this.options.source, this.source = function (i, s) {
                s(t.ui.autocomplete.filter(e, i.term))
            }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function (e, n) {
                s.xhr && s.xhr.abort(), s.xhr = t.ajax({
                    url: i, data: e, dataType: "json", success: function (t) {
                        n(t)
                    }, error: function () {
                        n([])
                    }
                })
            }) : this.source = this.options.source
        },
        _searchTimeout: function (t) {
            clearTimeout(this.searching), this.searching = this._delay(function () {
                var e = this.term === this._value(), i = this.menu.element.is(":visible"),
                    s = t.altKey || t.ctrlKey || t.metaKey || t.shiftKey;
                (!e || e && !i && !s) && (this.selectedItem = null, this.search(null, t))
            }, this.options.delay)
        },
        search: function (t, e) {
            return t = null != t ? t : this._value(), this.term = this._value(), t.length < this.options.minLength ? this.close(e) : this._trigger("search", e) !== !1 ? this._search(t) : void 0
        },
        _search: function (t) {
            this.pending++, this.element.addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({term: t}, this._response())
        },
        _response: function () {
            var e = ++this.requestIndex;
            return t.proxy(function (t) {
                e === this.requestIndex && this.__response(t), this.pending--, this.pending || this.element.removeClass("ui-autocomplete-loading")
            }, this)
        },
        __response: function (t) {
            t && (t = this._normalize(t)), this._trigger("response", null, {content: t}), !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close()
        },
        close: function (t) {
            this.cancelSearch = !0, this._close(t)
        },
        _close: function (t) {
            this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t))
        },
        _change: function (t) {
            this.previous !== this._value() && this._trigger("change", t, {item: this.selectedItem})
        },
        _normalize: function (e) {
            return e.length && e[0].label && e[0].value ? e : t.map(e, function (e) {
                return "string" == typeof e ? {label: e, value: e} : t.extend({}, e, {
                    label: e.label || e.value,
                    value: e.value || e.label
                })
            })
        },
        _suggest: function (e) {
            var i = this.menu.element.empty();
            this._renderMenu(i, e), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(t.extend({of: this.element}, this.options.position)), this.options.autoFocus && this.menu.next()
        },
        _resizeMenu: function () {
            var t = this.menu.element;
            t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()))
        },
        _renderMenu: function (e, i) {
            var s = this;
            t.each(i, function (t, i) {
                s._renderItemData(e, i)
            })
        },
        _renderItemData: function (t, e) {
            return this._renderItem(t, e).data("ui-autocomplete-item", e)
        },
        _renderItem: function (e, i) {
            return t("<li>").text(i.label).appendTo(e)
        },
        _move: function (t, e) {
            return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this.isMultiLine || this._value(this.term), void this.menu.blur()) : void this.menu[t](e) : void this.search(null, e)
        },
        widget: function () {
            return this.menu.element
        },
        _value: function () {
            return this.valueMethod.apply(this.element, arguments)
        },
        _keyEvent: function (t, e) {
            (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(t, e), e.preventDefault())
        }
    }), t.extend(t.ui.autocomplete, {
        escapeRegex: function (t) {
            return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
        }, filter: function (e, i) {
            var s = new RegExp(t.ui.autocomplete.escapeRegex(i), "i");
            return t.grep(e, function (t) {
                return s.test(t.label || t.value || t)
            })
        }
    }), t.widget("ui.autocomplete", t.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.",
                results: function (t) {
                    return t + (t > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        }, __response: function (e) {
            var i;
            this._superApply(arguments), this.options.disabled || this.cancelSearch || (i = e && e.length ? this.options.messages.results(e.length) : this.options.messages.noResults, this.liveRegion.children().hide(), t("<div>").text(i).appendTo(this.liveRegion))
        }
    });
    var d, p = (t.ui.autocomplete, "ui-button ui-widget ui-state-default ui-corner-all"),
        f = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
        m = function () {
            var e = t(this);
            setTimeout(function () {
                e.find(":ui-button").button("refresh")
            }, 1)
        }, g = function (e) {
            var i = e.name, s = e.form, n = t([]);
            return i && (i = i.replace(/'/g, "\\'"), n = s ? t(s).find("[name='" + i + "'][type=radio]") : t("[name='" + i + "'][type=radio]", e.ownerDocument).filter(function () {
                return !this.form
            })), n
        };
    t.widget("ui.button", {
        version: "1.11.1",
        defaultElement: "<button>",
        options: {disabled: null, text: !0, label: null, icons: {primary: null, secondary: null}},
        _create: function () {
            this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, m), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
            var e = this, i = this.options, s = "checkbox" === this.type || "radio" === this.type,
                n = s ? "" : "ui-state-active";
            null === i.label && (i.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(p).attr("role", "button").bind("mouseenter" + this.eventNamespace, function () {
                i.disabled || this === d && t(this).addClass("ui-state-active")
            }).bind("mouseleave" + this.eventNamespace, function () {
                i.disabled || t(this).removeClass(n)
            }).bind("click" + this.eventNamespace, function (t) {
                i.disabled && (t.preventDefault(), t.stopImmediatePropagation())
            }), this._on({
                focus: function () {
                    this.buttonElement.addClass("ui-state-focus")
                }, blur: function () {
                    this.buttonElement.removeClass("ui-state-focus")
                }
            }), s && this.element.bind("change" + this.eventNamespace, function () {
                e.refresh()
            }), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                return i.disabled ? !1 : void 0
            }) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                if (i.disabled) return !1;
                t(this).addClass("ui-state-active"), e.buttonElement.attr("aria-pressed", "true");
                var s = e.element[0];
                g(s).not(s).map(function () {
                    return t(this).button("widget")[0]
                }).removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function () {
                return i.disabled ? !1 : (t(this).addClass("ui-state-active"), d = this, void e.document.one("mouseup", function () {
                    d = null
                }))
            }).bind("mouseup" + this.eventNamespace, function () {
                return i.disabled ? !1 : void t(this).removeClass("ui-state-active")
            }).bind("keydown" + this.eventNamespace, function (e) {
                return i.disabled ? !1 : void ((e.keyCode === t.ui.keyCode.SPACE || e.keyCode === t.ui.keyCode.ENTER) && t(this).addClass("ui-state-active"))
            }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function () {
                t(this).removeClass("ui-state-active")
            }), this.buttonElement.is("a") && this.buttonElement.keyup(function (e) {
                e.keyCode === t.ui.keyCode.SPACE && t(this).click()
            })), this._setOption("disabled", i.disabled), this._resetButton()
        },
        _determineButtonType: function () {
            var t, e, i;
            this.element.is("[type=checkbox]") ? this.type = "checkbox" : this.element.is("[type=radio]") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button", "checkbox" === this.type || "radio" === this.type ? (t = this.element.parents().last(), e = "label[for='" + this.element.attr("id") + "']", this.buttonElement = t.find(e), this.buttonElement.length || (t = t.length ? t.siblings() : this.element.siblings(), this.buttonElement = t.filter(e), this.buttonElement.length || (this.buttonElement = t.find(e))), this.element.addClass("ui-helper-hidden-accessible"), i = this.element.is(":checked"), i && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", i)) : this.buttonElement = this.element
        },
        widget: function () {
            return this.buttonElement
        },
        _destroy: function () {
            this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(p + " ui-state-active " + f).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title")
        },
        _setOption: function (t, e) {
            return this._super(t, e), "disabled" === t ? (this.widget().toggleClass("ui-state-disabled", !!e), this.element.prop("disabled", !!e), void (e && ("checkbox" === this.type || "radio" === this.type ? this.buttonElement.removeClass("ui-state-focus") : this.buttonElement.removeClass("ui-state-focus ui-state-active")))) : void this._resetButton()
        },
        refresh: function () {
            var e = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
            e !== this.options.disabled && this._setOption("disabled", e), "radio" === this.type ? g(this.element[0]).each(function () {
                t(this).is(":checked") ? t(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : t(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
        },
        _resetButton: function () {
            if ("input" === this.type) return void (this.options.label && this.element.val(this.options.label));
            var e = this.buttonElement.removeClass(f),
                i = t("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(e.empty()).text(),
                s = this.options.icons, n = s.primary && s.secondary, o = [];
            s.primary || s.secondary ? (this.options.text && o.push("ui-button-text-icon" + (n ? "s" : s.primary ? "-primary" : "-secondary")), s.primary && e.prepend("<span class='ui-button-icon-primary ui-icon " + s.primary + "'></span>"), s.secondary && e.append("<span class='ui-button-icon-secondary ui-icon " + s.secondary + "'></span>"), this.options.text || (o.push(n ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || e.attr("title", t.trim(i)))) : o.push("ui-button-text-only"), e.addClass(o.join(" "))
        }
    }), t.widget("ui.buttonset", {
        version: "1.11.1",
        options: {items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"},
        _create: function () {
            this.element.addClass("ui-buttonset")
        },
        _init: function () {
            this.refresh()
        },
        _setOption: function (t, e) {
            "disabled" === t && this.buttons.button("option", t, e), this._super(t, e)
        },
        refresh: function () {
            var e = "rtl" === this.element.css("direction"), i = this.element.find(this.options.items),
                s = i.filter(":ui-button");
            i.not(":ui-button").button(), s.button("refresh"), this.buttons = i.map(function () {
                return t(this).button("widget")[0]
            }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(e ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(e ? "ui-corner-left" : "ui-corner-right").end().end()
        },
        _destroy: function () {
            this.element.removeClass("ui-buttonset"), this.buttons.map(function () {
                return t(this).button("widget")[0]
            }).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
        }
    }), t.ui.button, t.extend(t.ui, {datepicker: {version: "1.11.1"}});
    var v;
    t.extend(n.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        _widgetDatepicker: function () {
            return this.dpDiv
        },
        setDefaults: function (t) {
            return r(this._defaults, t || {}), this
        },
        _attachDatepicker: function (e, i) {
            var s, n, o;
            s = e.nodeName.toLowerCase(), n = "div" === s || "span" === s, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), o = this._newInst(t(e), n), o.settings = t.extend({}, i || {}), "input" === s ? this._connectDatepicker(e, o) : n && this._inlineDatepicker(e, o)
        },
        _newInst: function (e, i) {
            var s = e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
            return {
                id: s,
                input: e,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: i,
                dpDiv: i ? o(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
            }
        },
        _connectDatepicker: function (e, i) {
            var s = t(e);
            i.append = t([]), i.trigger = t([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(i), t.data(e, "datepicker", i), i.settings.disabled && this._disableDatepicker(e))
        },
        _attachments: function (e, i) {
            var s, n, o, a = this._get(i, "appendText"), r = this._get(i, "isRTL");
            i.append && i.append.remove(), a && (i.append = t("<span class='" + this._appendClass + "'>" + a + "</span>"), e[r ? "before" : "after"](i.append)), e.unbind("focus", this._showDatepicker), i.trigger && i.trigger.remove(), s = this._get(i, "showOn"), ("focus" === s || "both" === s) && e.focus(this._showDatepicker), ("button" === s || "both" === s) && (n = this._get(i, "buttonText"), o = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                src: o,
                alt: n,
                title: n
            }) : t("<button type='button'></button>").addClass(this._triggerClass).html(o ? t("<img/>").attr({
                src: o,
                alt: n,
                title: n
            }) : n)), e[r ? "before" : "after"](i.trigger), i.trigger.click(function () {
                return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1
            }))
        },
        _autoSize: function (t) {
            if (this._get(t, "autoSize") && !t.inline) {
                var e, i, s, n, o = new Date(2009, 11, 20), a = this._get(t, "dateFormat");
                a.match(/[DM]/) && (e = function (t) {
                    for (i = 0, s = 0, n = 0; n < t.length; n++) t[n].length > i && (i = t[n].length, s = n);
                    return s
                }, o.setMonth(e(this._get(t, a.match(/MM/) ? "monthNames" : "monthNamesShort"))), o.setDate(e(this._get(t, a.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), t.input.attr("size", this._formatDate(t, o).length)
            }
        },
        _inlineDatepicker: function (e, i) {
            var s = t(e);
            s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), t.data(e, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))
        },
        _dialogDatepicker: function (e, i, s, n, o) {
            var a, l, h, c, u, d = this._dialogInst;
            return d || (this.uuid += 1, a = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + a + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), t("body").append(this._dialogInput), d = this._dialogInst = this._newInst(this._dialogInput, !1), d.settings = {}, t.data(this._dialogInput[0], "datepicker", d)), r(d.settings, n || {}), i = i && i.constructor === Date ? this._formatDate(d, i) : i, this._dialogInput.val(i), this._pos = o ? o.length ? o : [o.pageX, o.pageY] : null, this._pos || (l = document.documentElement.clientWidth, h = document.documentElement.clientHeight, c = document.documentElement.scrollLeft || document.body.scrollLeft, u = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [l / 2 - 100 + c, h / 2 - 150 + u]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), d.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), t.data(this._dialogInput[0], "datepicker", d),
                this
        },
        _destroyDatepicker: function (e) {
            var i, s = t(e), n = t.data(e, "datepicker");
            s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, "datepicker"), "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && s.removeClass(this.markerClassName).empty())
        },
        _enableDatepicker: function (e) {
            var i, s, n = t(e), o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, o.trigger.filter("button").each(function () {
                this.disabled = !1
            }).end().filter("img").css({
                opacity: "1.0",
                cursor: ""
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, function (t) {
                return t === e ? null : t
            }))
        },
        _disableDatepicker: function (e) {
            var i, s, n = t(e), o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, o.trigger.filter("button").each(function () {
                this.disabled = !0
            }).end().filter("img").css({
                opacity: "0.5",
                cursor: "default"
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, function (t) {
                return t === e ? null : t
            }), this._disabledInputs[this._disabledInputs.length] = e)
        },
        _isDisabledDatepicker: function (t) {
            if (!t) return !1;
            for (var e = 0; e < this._disabledInputs.length; e++) if (this._disabledInputs[e] === t) return !0;
            return !1
        },
        _getInst: function (e) {
            try {
                return t.data(e, "datepicker")
            } catch (i) {
                throw"Missing instance data for this datepicker"
            }
        },
        _optionDatepicker: function (e, i, s) {
            var n, o, a, l, h = this._getInst(e);
            return 2 === arguments.length && "string" == typeof i ? "defaults" === i ? t.extend({}, t.datepicker._defaults) : h ? "all" === i ? t.extend({}, h.settings) : this._get(h, i) : null : (n = i || {}, "string" == typeof i && (n = {}, n[i] = s), void (h && (this._curInst === h && this._hideDatepicker(), o = this._getDateDatepicker(e, !0), a = this._getMinMaxDate(h, "min"), l = this._getMinMaxDate(h, "max"), r(h.settings, n), null !== a && void 0 !== n.dateFormat && void 0 === n.minDate && (h.settings.minDate = this._formatDate(h, a)), null !== l && void 0 !== n.dateFormat && void 0 === n.maxDate && (h.settings.maxDate = this._formatDate(h, l)), "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(t(e), h), this._autoSize(h), this._setDate(h, o), this._updateAlternate(h), this._updateDatepicker(h))))
        },
        _changeDatepicker: function (t, e, i) {
            this._optionDatepicker(t, e, i)
        },
        _refreshDatepicker: function (t) {
            var e = this._getInst(t);
            e && this._updateDatepicker(e)
        },
        _setDateDatepicker: function (t, e) {
            var i = this._getInst(t);
            i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))
        },
        _getDateDatepicker: function (t, e) {
            var i = this._getInst(t);
            return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null
        },
        _doKeyDown: function (e) {
            var i, s, n, o = t.datepicker._getInst(e.target), a = !0, r = o.dpDiv.is(".ui-datepicker-rtl");
            if (o._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
                case 9:
                    t.datepicker._hideDatepicker(), a = !1;
                    break;
                case 13:
                    return n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", o.dpDiv), n[0] && t.datepicker._selectDay(e.target, o.selectedMonth, o.selectedYear, n[0]), i = t.datepicker._get(o, "onSelect"), i ? (s = t.datepicker._formatDate(o), i.apply(o.input ? o.input[0] : null, [s, o])) : t.datepicker._hideDatepicker(), !1;
                case 27:
                    t.datepicker._hideDatepicker();
                    break;
                case 33:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 34:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 35:
                    (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), a = e.ctrlKey || e.metaKey;
                    break;
                case 36:
                    (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), a = e.ctrlKey || e.metaKey;
                    break;
                case 37:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1 : -1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 38:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), a = e.ctrlKey || e.metaKey;
                    break;
                case 39:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1 : 1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                    break;
                case 40:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), a = e.ctrlKey || e.metaKey;
                    break;
                default:
                    a = !1
            } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : a = !1;
            a && (e.preventDefault(), e.stopPropagation())
        },
        _doKeyPress: function (e) {
            var i, s, n = t.datepicker._getInst(e.target);
            return t.datepicker._get(n, "constrainInput") ? (i = t.datepicker._possibleChars(t.datepicker._get(n, "dateFormat")), s = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || " " > s || !i || i.indexOf(s) > -1) : void 0
        },
        _doKeyUp: function (e) {
            var i, s = t.datepicker._getInst(e.target);
            if (s.input.val() !== s.lastVal) try {
                i = t.datepicker.parseDate(t.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, t.datepicker._getFormatConfig(s)), i && (t.datepicker._setDateFromField(s), t.datepicker._updateAlternate(s), t.datepicker._updateDatepicker(s))
            } catch (n) {
            }
            return !0
        },
        _showDatepicker: function (e) {
            if (e = e.target || e, "input" !== e.nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), !t.datepicker._isDisabledDatepicker(e) && t.datepicker._lastInput !== e) {
                var i, n, o, a, l, h, c;
                i = t.datepicker._getInst(e), t.datepicker._curInst && t.datepicker._curInst !== i && (t.datepicker._curInst.dpDiv.stop(!0, !0), i && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), n = t.datepicker._get(i, "beforeShow"), o = n ? n.apply(e, [e, i]) : {}, o !== !1 && (r(i.settings, o), i.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(i), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), a = !1, t(e).parents().each(function () {
                    return a |= "fixed" === t(this).css("position"), !a
                }), l = {
                    left: t.datepicker._pos[0],
                    top: t.datepicker._pos[1]
                }, t.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
                    position: "absolute",
                    display: "block",
                    top: "-1000px"
                }), t.datepicker._updateDatepicker(i), l = t.datepicker._checkOffset(i, l, a), i.dpDiv.css({
                    position: t.datepicker._inDialog && t.blockUI ? "static" : a ? "fixed" : "absolute",
                    display: "none",
                    left: l.left + "px",
                    top: l.top + "px"
                }), i.inline || (h = t.datepicker._get(i, "showAnim"), c = t.datepicker._get(i, "duration"), i.dpDiv.css("z-index", s(t(e)) + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[h] ? i.dpDiv.show(h, t.datepicker._get(i, "showOptions"), c) : i.dpDiv[h || "show"](h ? c : null), t.datepicker._shouldFocusInput(i) && i.input.focus(), t.datepicker._curInst = i))
            }
        },
        _updateDatepicker: function (e) {
            this.maxRows = 4, v = e, e.dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e);
            var i, s = this._getNumberOfMonths(e), n = s[1], o = 17, r = e.dpDiv.find("." + this._dayOverClass + " a");
            r.length > 0 && a.apply(r.get(0)), e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), n > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + n).css("width", o * n + "em"), e.dpDiv[(1 !== s[0] || 1 !== s[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.focus(), e.yearshtml && (i = e.yearshtml, setTimeout(function () {
                i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), i = e.yearshtml = null
            }, 0))
        },
        _shouldFocusInput: function (t) {
            return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")
        },
        _checkOffset: function (e, i, s) {
            var n = e.dpDiv.outerWidth(), o = e.dpDiv.outerHeight(), a = e.input ? e.input.outerWidth() : 0,
                r = e.input ? e.input.outerHeight() : 0,
                l = document.documentElement.clientWidth + (s ? 0 : t(document).scrollLeft()),
                h = document.documentElement.clientHeight + (s ? 0 : t(document).scrollTop());
            return i.left -= this._get(e, "isRTL") ? n - a : 0, i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, i.top -= s && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + n > l && l > n ? Math.abs(i.left + n - l) : 0), i.top -= Math.min(i.top, i.top + o > h && h > o ? Math.abs(o + r) : 0), i
        },
        _findPos: function (e) {
            for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[n ? "previousSibling" : "nextSibling"];
            return i = t(e).offset(), [i.left, i.top]
        },
        _hideDatepicker: function (e) {
            var i, s, n, o, a = this._curInst;
            !a || e && a !== t.data(e, "datepicker") || this._datepickerShowing && (i = this._get(a, "showAnim"), s = this._get(a, "duration"), n = function () {
                t.datepicker._tidyDialog(a)
            }, t.effects && (t.effects.effect[i] || t.effects[i]) ? a.dpDiv.hide(i, t.datepicker._get(a, "showOptions"), s, n) : a.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, n), i || n(), this._datepickerShowing = !1, o = this._get(a, "onClose"), o && o.apply(a.input ? a.input[0] : null, [a.input ? a.input.val() : "", a]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                position: "absolute",
                left: "0",
                top: "-100px"
            }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)
        },
        _tidyDialog: function (t) {
            t.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
        },
        _checkExternalClick: function (e) {
            if (t.datepicker._curInst) {
                var i = t(e.target), s = t.datepicker._getInst(i[0]);
                (i[0].id !== t.datepicker._mainDivId && 0 === i.parents("#" + t.datepicker._mainDivId).length && !i.hasClass(t.datepicker.markerClassName) && !i.closest("." + t.datepicker._triggerClass).length && t.datepicker._datepickerShowing && (!t.datepicker._inDialog || !t.blockUI) || i.hasClass(t.datepicker.markerClassName) && t.datepicker._curInst !== s) && t.datepicker._hideDatepicker()
            }
        },
        _adjustDate: function (e, i, s) {
            var n = t(e), o = this._getInst(n[0]);
            this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(o, i + ("M" === s ? this._get(o, "showCurrentAtPos") : 0), s), this._updateDatepicker(o))
        },
        _gotoToday: function (e) {
            var i, s = t(e), n = this._getInst(s[0]);
            this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date, n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), this._notifyChange(n), this._adjustDate(s)
        },
        _selectMonthYear: function (e, i, s) {
            var n = t(e), o = this._getInst(n[0]);
            o["selected" + ("M" === s ? "Month" : "Year")] = o["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(o), this._adjustDate(n)
        },
        _selectDay: function (e, i, s, n) {
            var o, a = t(e);
            t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(a[0]) || (o = this._getInst(a[0]), o.selectedDay = o.currentDay = t("a", n).html(), o.selectedMonth = o.currentMonth = i, o.selectedYear = o.currentYear = s, this._selectDate(e, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear)))
        },
        _clearDate: function (e) {
            var i = t(e);
            this._selectDate(i, "")
        },
        _selectDate: function (e, i) {
            var s, n = t(e), o = this._getInst(n[0]);
            i = null != i ? i : this._formatDate(o), o.input && o.input.val(i), this._updateAlternate(o), s = this._get(o, "onSelect"), s ? s.apply(o.input ? o.input[0] : null, [i, o]) : o.input && o.input.trigger("change"), o.inline ? this._updateDatepicker(o) : (this._hideDatepicker(), this._lastInput = o.input[0], "object" != typeof o.input[0] && o.input.focus(), this._lastInput = null)
        },
        _updateAlternate: function (e) {
            var i, s, n, o = this._get(e, "altField");
            o && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), n = this.formatDate(i, s, this._getFormatConfig(e)), t(o).each(function () {
                t(this).val(n)
            }))
        },
        noWeekends: function (t) {
            var e = t.getDay();
            return [e > 0 && 6 > e, ""]
        },
        iso8601Week: function (t) {
            var e, i = new Date(t.getTime());
            return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1
        },
        parseDate: function (e, i, s) {
            if (null == e || null == i) throw"Invalid arguments";
            if (i = "object" == typeof i ? i.toString() : i + "", "" === i) return null;
            var n, o, a, r, l = 0, h = (s ? s.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                c = "string" != typeof h ? h : (new Date).getFullYear() % 100 + parseInt(h, 10),
                u = (s ? s.dayNamesShort : null) || this._defaults.dayNamesShort,
                d = (s ? s.dayNames : null) || this._defaults.dayNames,
                p = (s ? s.monthNamesShort : null) || this._defaults.monthNamesShort,
                f = (s ? s.monthNames : null) || this._defaults.monthNames, m = -1, g = -1, v = -1, b = -1, y = !1,
                _ = function (t) {
                    var i = n + 1 < e.length && e.charAt(n + 1) === t;
                    return i && n++, i
                }, w = function (t) {
                    var e = _(t), s = "@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2,
                        n = "y" === t ? s : 1, o = new RegExp("^\\d{" + n + "," + s + "}"), a = i.substring(l).match(o);
                    if (!a) throw"Missing number at position " + l;
                    return l += a[0].length, parseInt(a[0], 10)
                }, x = function (e, s, n) {
                    var o = -1, a = t.map(_(e) ? n : s, function (t, e) {
                        return [[e, t]]
                    }).sort(function (t, e) {
                        return -(t[1].length - e[1].length)
                    });
                    if (t.each(a, function (t, e) {
                        var s = e[1];
                        return i.substr(l, s.length).toLowerCase() === s.toLowerCase() ? (o = e[0], l += s.length, !1) : void 0
                    }), -1 !== o) return o + 1;
                    throw"Unknown name at position " + l
                }, k = function () {
                    if (i.charAt(l) !== e.charAt(n)) throw"Unexpected literal at position " + l;
                    l++
                };
            for (n = 0; n < e.length; n++) if (y) "'" !== e.charAt(n) || _("'") ? k() : y = !1; else switch (e.charAt(n)) {
                case"d":
                    v = w("d");
                    break;
                case"D":
                    x("D", u, d);
                    break;
                case"o":
                    b = w("o");
                    break;
                case"m":
                    g = w("m");
                    break;
                case"M":
                    g = x("M", p, f);
                    break;
                case"y":
                    m = w("y");
                    break;
                case"@":
                    r = new Date(w("@")), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
                    break;
                case"!":
                    r = new Date((w("!") - this._ticksTo1970) / 1e4), m = r.getFullYear(), g = r.getMonth() + 1, v = r.getDate();
                    break;
                case"'":
                    _("'") ? k() : y = !0;
                    break;
                default:
                    k()
            }
            if (l < i.length && (a = i.substr(l), !/^\s+/.test(a))) throw"Extra/unparsed characters found in date: " + a;
            if (-1 === m ? m = (new Date).getFullYear() : 100 > m && (m += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (c >= m ? 0 : -100)), b > -1) for (g = 1, v = b; o = this._getDaysInMonth(m, g - 1), !(o >= v);) g++, v -= o;
            if (r = this._daylightSavingAdjust(new Date(m, g - 1, v)), r.getFullYear() !== m || r.getMonth() + 1 !== g || r.getDate() !== v) throw"Invalid date";
            return r
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)) * 60 * 60 * 1e7,
        formatDate: function (t, e, i) {
            if (!e) return "";
            var s, n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
                o = (i ? i.dayNames : null) || this._defaults.dayNames,
                a = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
                r = (i ? i.monthNames : null) || this._defaults.monthNames, l = function (e) {
                    var i = s + 1 < t.length && t.charAt(s + 1) === e;
                    return i && s++, i
                }, h = function (t, e, i) {
                    var s = "" + e;
                    if (l(t)) for (; s.length < i;) s = "0" + s;
                    return s
                }, c = function (t, e, i, s) {
                    return l(t) ? s[e] : i[e]
                }, u = "", d = !1;
            if (e) for (s = 0; s < t.length; s++) if (d) "'" !== t.charAt(s) || l("'") ? u += t.charAt(s) : d = !1; else switch (t.charAt(s)) {
                case"d":
                    u += h("d", e.getDate(), 2);
                    break;
                case"D":
                    u += c("D", e.getDay(), n, o);
                    break;
                case"o":
                    u += h("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                    break;
                case"m":
                    u += h("m", e.getMonth() + 1, 2);
                    break;
                case"M":
                    u += c("M", e.getMonth(), a, r);
                    break;
                case"y":
                    u += l("y") ? e.getFullYear() : (e.getYear() % 100 < 10 ? "0" : "") + e.getYear() % 100;
                    break;
                case"@":
                    u += e.getTime();
                    break;
                case"!":
                    u += 1e4 * e.getTime() + this._ticksTo1970;
                    break;
                case"'":
                    l("'") ? u += "'" : d = !0;
                    break;
                default:
                    u += t.charAt(s)
            }
            return u
        },
        _possibleChars: function (t) {
            var e, i = "", s = !1, n = function (i) {
                var s = e + 1 < t.length && t.charAt(e + 1) === i;
                return s && e++, s
            };
            for (e = 0; e < t.length; e++) if (s) "'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1; else switch (t.charAt(e)) {
                case"d":
                case"m":
                case"y":
                case"@":
                    i += "0123456789";
                    break;
                case"D":
                case"M":
                    return null;
                case"'":
                    n("'") ? i += "'" : s = !0;
                    break;
                default:
                    i += t.charAt(e)
            }
            return i
        },
        _get: function (t, e) {
            return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e]
        },
        _setDateFromField: function (t, e) {
            if (t.input.val() !== t.lastVal) {
                var i = this._get(t, "dateFormat"), s = t.lastVal = t.input ? t.input.val() : null,
                    n = this._getDefaultDate(t), o = n, a = this._getFormatConfig(t);
                try {
                    o = this.parseDate(i, s, a) || n
                } catch (r) {
                    s = e ? "" : s
                }
                t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), t.currentDay = s ? o.getDate() : 0, t.currentMonth = s ? o.getMonth() : 0, t.currentYear = s ? o.getFullYear() : 0, this._adjustInstDate(t)
            }
        },
        _getDefaultDate: function (t) {
            return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))
        },
        _determineDate: function (e, i, s) {
            var n = function (t) {
                    var e = new Date;
                    return e.setDate(e.getDate() + t), e
                }, o = function (i) {
                    try {
                        return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))
                    } catch (s) {
                    }
                    for (var n = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, o = n.getFullYear(), a = n.getMonth(), r = n.getDate(), l = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, h = l.exec(i); h;) {
                        switch (h[2] || "d") {
                            case"d":
                            case"D":
                                r += parseInt(h[1], 10);
                                break;
                            case"w":
                            case"W":
                                r += 7 * parseInt(h[1], 10);
                                break;
                            case"m":
                            case"M":
                                a += parseInt(h[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a));
                                break;
                            case"y":
                            case"Y":
                                o += parseInt(h[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a))
                        }
                        h = l.exec(i)
                    }
                    return new Date(o, a, r)
                },
                a = null == i || "" === i ? s : "string" == typeof i ? o(i) : "number" == typeof i ? isNaN(i) ? s : n(i) : new Date(i.getTime());
            return a = a && "Invalid Date" === a.toString() ? s : a, a && (a.setHours(0), a.setMinutes(0), a.setSeconds(0), a.setMilliseconds(0)), this._daylightSavingAdjust(a)
        },
        _daylightSavingAdjust: function (t) {
            return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2 : 0), t) : null
        },
        _setDate: function (t, e, i) {
            var s = !e, n = t.selectedMonth, o = t.selectedYear,
                a = this._restrictMinMax(t, this._determineDate(t, e, new Date));
            t.selectedDay = t.currentDay = a.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = a.getMonth(), t.drawYear = t.selectedYear = t.currentYear = a.getFullYear(), n === t.selectedMonth && o === t.selectedYear || i || this._notifyChange(t), this._adjustInstDate(t), t.input && t.input.val(s ? "" : this._formatDate(t))
        },
        _getDate: function (t) {
            var e = !t.currentYear || t.input && "" === t.input.val() ? null : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
            return e
        },
        _attachHandlers: function (e) {
            var i = this._get(e, "stepMonths"), s = "#" + e.id.replace(/\\\\/g, "\\");
            e.dpDiv.find("[data-handler]").map(function () {
                var e = {
                    prev: function () {
                        t.datepicker._adjustDate(s, -i, "M")
                    }, next: function () {
                        t.datepicker._adjustDate(s, +i, "M")
                    }, hide: function () {
                        t.datepicker._hideDatepicker()
                    }, today: function () {
                        t.datepicker._gotoToday(s)
                    }, selectDay: function () {
                        return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
                    }, selectMonth: function () {
                        return t.datepicker._selectMonthYear(s, this, "M"), !1
                    }, selectYear: function () {
                        return t.datepicker._selectMonthYear(s, this, "Y"), !1
                    }
                };
                t(this).bind(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])
            })
        },
        _generateHTML: function (t) {
            var e, i, s, n, o, a, r, l, h, c, u, d, p, f, m, g, v, b, y, _, w, x, k, C, D, P, T, I, S, M, A, O, E, z, H,
                N, j, W, F, Y = new Date,
                L = this._daylightSavingAdjust(new Date(Y.getFullYear(), Y.getMonth(), Y.getDate())),
                R = this._get(t, "isRTL"), V = this._get(t, "showButtonPanel"), B = this._get(t, "hideIfNoPrevNext"),
                X = this._get(t, "navigationAsDateFormat"), q = this._getNumberOfMonths(t),
                $ = this._get(t, "showCurrentAtPos"), U = this._get(t, "stepMonths"), Q = 1 !== q[0] || 1 !== q[1],
                K = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)),
                Z = this._getMinMaxDate(t, "min"), G = this._getMinMaxDate(t, "max"), J = t.drawMonth - $,
                tt = t.drawYear;
            if (0 > J && (J += 12, tt--), G) for (e = this._daylightSavingAdjust(new Date(G.getFullYear(), G.getMonth() - q[0] * q[1] + 1, G.getDate())), e = Z && Z > e ? Z : e; this._daylightSavingAdjust(new Date(tt, J, 1)) > e;) J--, 0 > J && (J = 11, tt--);
            for (t.drawMonth = J, t.drawYear = tt, i = this._get(t, "prevText"), i = X ? this.formatDate(i, this._daylightSavingAdjust(new Date(tt, J - U, 1)), this._getFormatConfig(t)) : i, s = this._canAdjustMonth(t, -1, tt, J) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'>" + i + "</span></a>" : B ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'>" + i + "</span></a>", n = this._get(t, "nextText"), n = X ? this.formatDate(n, this._daylightSavingAdjust(new Date(tt, J + U, 1)), this._getFormatConfig(t)) : n, o = this._canAdjustMonth(t, 1, tt, J) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'>" + n + "</span></a>" : B ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'>" + n + "</span></a>", a = this._get(t, "currentText"), r = this._get(t, "gotoCurrent") && t.currentDay ? K : L, a = X ? this.formatDate(a, r, this._getFormatConfig(t)) : a, l = t.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", h = V ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (R ? l : "") + (this._isInRange(t, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + a + "</button>" : "") + (R ? "" : l) + "</div>" : "", c = parseInt(this._get(t, "firstDay"), 10), c = isNaN(c) ? 0 : c, u = this._get(t, "showWeek"), d = this._get(t, "dayNames"), p = this._get(t, "dayNamesMin"), f = this._get(t, "monthNames"), m = this._get(t, "monthNamesShort"), g = this._get(t, "beforeShowDay"), v = this._get(t, "showOtherMonths"), b = this._get(t, "selectOtherMonths"), y = this._getDefaultDate(t), _ = "", x = 0; x < q[0]; x++) {
                for (k = "", this.maxRows = 4, C = 0; C < q[1]; C++) {
                    if (D = this._daylightSavingAdjust(new Date(tt, J, t.selectedDay)), P = " ui-corner-all", T = "", Q) {
                        if (T += "<div class='ui-datepicker-group", q[1] > 1) switch (C) {
                            case 0:
                                T += " ui-datepicker-group-first", P = " ui-corner-" + (R ? "right" : "left");
                                break;
                            case q[1] - 1:
                                T += " ui-datepicker-group-last", P = " ui-corner-" + (R ? "left" : "right");
                                break;
                            default:
                                T += " ui-datepicker-group-middle", P = ""
                        }
                        T += "'>"
                    }
                    for (T += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + P + "'>" + (/all|left/.test(P) && 0 === x ? R ? o : s : "") + (/all|right/.test(P) && 0 === x ? R ? s : o : "") + this._generateMonthYearHeader(t, J, tt, Z, G, x > 0 || C > 0, f, m) + "</div><table class='ui-datepicker-calendar'><thead><tr>", I = u ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>" : "", w = 0; 7 > w; w++) S = (w + c) % 7, I += "<th scope='col'" + ((w + c + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + d[S] + "'>" + p[S] + "</span></th>";
                    for (T += I + "</tr></thead><tbody>", M = this._getDaysInMonth(tt, J), tt === t.selectedYear && J === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, M)), A = (this._getFirstDayOfMonth(tt, J) - c + 7) % 7, O = Math.ceil((A + M) / 7), E = Q && this.maxRows > O ? this.maxRows : O, this.maxRows = E, z = this._daylightSavingAdjust(new Date(tt, J, 1 - A)), H = 0; E > H; H++) {
                        for (T += "<tr>", N = u ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(z) + "</td>" : "", w = 0; 7 > w; w++) j = g ? g.apply(t.input ? t.input[0] : null, [z]) : [!0, ""], W = z.getMonth() !== J, F = W && !b || !j[0] || Z && Z > z || G && z > G, N += "<td class='" + ((w + c + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (W ? " ui-datepicker-other-month" : "") + (z.getTime() === D.getTime() && J === t.selectedMonth && t._keyEvent || y.getTime() === z.getTime() && y.getTime() === D.getTime() ? " " + this._dayOverClass : "") + (F ? " " + this._unselectableClass + " ui-state-disabled" : "") + (W && !v ? "" : " " + j[1] + (z.getTime() === K.getTime() ? " " + this._currentClass : "") + (z.getTime() === L.getTime() ? " ui-datepicker-today" : "")) + "'" + (W && !v || !j[2] ? "" : " title='" + j[2].replace(/'/g, "&#39;") + "'") + (F ? "" : " data-handler='selectDay' data-event='click' data-month='" + z.getMonth() + "' data-year='" + z.getFullYear() + "'") + ">" + (W && !v ? "&#xa0;" : F ? "<span class='ui-state-default'>" + z.getDate() + "</span>" : "<a class='ui-state-default" + (z.getTime() === L.getTime() ? " ui-state-highlight" : "") + (z.getTime() === K.getTime() ? " ui-state-active" : "") + (W ? " ui-priority-secondary" : "") + "' href='#'>" + z.getDate() + "</a>") + "</td>", z.setDate(z.getDate() + 1), z = this._daylightSavingAdjust(z);
                        T += N + "</tr>"
                    }
                    J++, J > 11 && (J = 0, tt++), T += "</tbody></table>" + (Q ? "</div>" + (q[0] > 0 && C === q[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), k += T
                }
                _ += k
            }
            return _ += h, t._keyEvent = !1, _
        },
        _generateMonthYearHeader: function (t, e, i, s, n, o, a, r) {
            var l, h, c, u, d, p, f, m, g = this._get(t, "changeMonth"), v = this._get(t, "changeYear"),
                b = this._get(t, "showMonthAfterYear"), y = "<div class='ui-datepicker-title'>", _ = "";
            if (o || !g) _ += "<span class='ui-datepicker-month'>" + a[e] + "</span>"; else {
                for (l = s && s.getFullYear() === i, h = n && n.getFullYear() === i, _ += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", c = 0; 12 > c; c++) (!l || c >= s.getMonth()) && (!h || c <= n.getMonth()) && (_ += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + r[c] + "</option>");
                _ += "</select>"
            }
            if (b || (y += _ + (!o && g && v ? "" : "&#xa0;")), !t.yearshtml) if (t.yearshtml = "", o || !v) y += "<span class='ui-datepicker-year'>" + i + "</span>"; else {
                for (u = this._get(t, "yearRange").split(":"), d = (new Date).getFullYear(), p = function (t) {
                    var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
                    return isNaN(e) ? d : e
                }, f = p(u[0]), m = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, m = n ? Math.min(m, n.getFullYear()) : m, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; m >= f; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
                t.yearshtml += "</select>", y += t.yearshtml, t.yearshtml = null
            }
            return y += this._get(t, "yearSuffix"), b && (y += (!o && g && v ? "" : "&#xa0;") + _), y += "</div>"
        },
        _adjustInstDate: function (t, e, i) {
            var s = t.drawYear + ("Y" === i ? e : 0), n = t.drawMonth + ("M" === i ? e : 0),
                o = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e : 0),
                a = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, o)));
            t.selectedDay = a.getDate(), t.drawMonth = t.selectedMonth = a.getMonth(), t.drawYear = t.selectedYear = a.getFullYear(), ("M" === i || "Y" === i) && this._notifyChange(t)
        },
        _restrictMinMax: function (t, e) {
            var i = this._getMinMaxDate(t, "min"), s = this._getMinMaxDate(t, "max"), n = i && i > e ? i : e;
            return s && n > s ? s : n
        },
        _notifyChange: function (t) {
            var e = this._get(t, "onChangeMonthYear");
            e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])
        },
        _getNumberOfMonths: function (t) {
            var e = this._get(t, "numberOfMonths");
            return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e
        },
        _getMinMaxDate: function (t, e) {
            return this._determineDate(t, this._get(t, e + "Date"), null)
        },
        _getDaysInMonth: function (t, e) {
            return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()
        },
        _getFirstDayOfMonth: function (t, e) {
            return new Date(t, e, 1).getDay()
        },
        _canAdjustMonth: function (t, e, i, s) {
            var n = this._getNumberOfMonths(t),
                o = this._daylightSavingAdjust(new Date(i, s + (0 > e ? e : n[0] * n[1]), 1));
            return 0 > e && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), this._isInRange(t, o)
        },
        _isInRange: function (t, e) {
            var i, s, n = this._getMinMaxDate(t, "min"), o = this._getMinMaxDate(t, "max"), a = null, r = null,
                l = this._get(t, "yearRange");
            return l && (i = l.split(":"), s = (new Date).getFullYear(), a = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (a += s), i[1].match(/[+\-].*/) && (r += s)), (!n || e.getTime() >= n.getTime()) && (!o || e.getTime() <= o.getTime()) && (!a || e.getFullYear() >= a) && (!r || e.getFullYear() <= r)
        },
        _getFormatConfig: function (t) {
            var e = this._get(t, "shortYearCutoff");
            return e = "string" != typeof e ? e : (new Date).getFullYear() % 100 + parseInt(e, 10), {
                shortYearCutoff: e,
                dayNamesShort: this._get(t, "dayNamesShort"),
                dayNames: this._get(t, "dayNames"),
                monthNamesShort: this._get(t, "monthNamesShort"),
                monthNames: this._get(t, "monthNames")
            }
        },
        _formatDate: function (t, e, i, s) {
            e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
            var n = e ? "object" == typeof e ? e : this._daylightSavingAdjust(new Date(s, i, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
            return this.formatDate(this._get(t, "dateFormat"), n, this._getFormatConfig(t))
        }
    }), t.fn.datepicker = function (e) {
        if (!this.length) return this;
        t.datepicker.initialized || (t(document).mousedown(t.datepicker._checkExternalClick), t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
        var i = Array.prototype.slice.call(arguments, 1);
        return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i)) : this.each(function () {
            "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this].concat(i)) : t.datepicker._attachDatepicker(this, e)
        }) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i))
    }, t.datepicker = new n, t.datepicker.initialized = !1, t.datepicker.uuid = (new Date).getTime(), t.datepicker.version = "1.11.1", t.datepicker, t.widget("ui.draggable", t.ui.mouse, {
        version: "1.11.1",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function () {
            "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._setHandleClassName(), this._mouseInit()
        },
        _setOption: function (t, e) {
            this._super(t, e), "handle" === t && (this._removeHandleClassName(), this._setHandleClassName())
        },
        _destroy: function () {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? void (this.destroyOnClear = !0) : (this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._removeHandleClassName(), void this._mouseDestroy())
        },
        _mouseCapture: function (e) {
            var i = this.document[0], s = this.options;
            try {
                i.activeElement && "body" !== i.activeElement.nodeName.toLowerCase() && t(i.activeElement).blur()
            } catch (n) {
            }
            return this.helper || s.disabled || t(e.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(e), this.handle ? (t(s.iframeFix === !0 ? "iframe" : s.iframeFix).each(function () {
                t("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                    width: this.offsetWidth + "px",
                    height: this.offsetHeight + "px",
                    position: "absolute",
                    opacity: "0.001",
                    zIndex: 1e3
                }).css(t(this).offset()).appendTo("body")
            }), !0) : !1)
        },
        _mouseStart: function (e) {
            var i = this.options;
            return this.helper = this._createHelper(e), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, this.offset.scroll = !1, t.extend(this.offset, {
                click: {
                    left: e.pageX - this.offset.left,
                    top: e.pageY - this.offset.top
                }, parent: this._getParentOffset(), relative: this._getRelativeOffset()
            }), this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), this._trigger("start", e) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0)
        },
        _mouseDrag: function (e, i) {
            if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()),
                this.position = this._generatePosition(e, !0), this.positionAbs = this._convertPositionTo("absolute"), !i) {
                var s = this._uiHash();
                if (this._trigger("drag", e, s) === !1) return this._mouseUp({}), !1;
                this.position = s.position
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1
        },
        _mouseStop: function (e) {
            var i = this, s = !1;
            return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function () {
                i._trigger("stop", e) !== !1 && i._clear()
            }) : this._trigger("stop", e) !== !1 && this._clear(), !1
        },
        _mouseUp: function (e) {
            return t("div.ui-draggable-iframeFix").each(function () {
                this.parentNode.removeChild(this)
            }), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), this.element.focus(), t.ui.mouse.prototype._mouseUp.call(this, e)
        },
        cancel: function () {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
        },
        _getHandle: function (e) {
            return this.options.handle ? !!t(e.target).closest(this.element.find(this.options.handle)).length : !0
        },
        _setHandleClassName: function () {
            this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, this.handleElement.addClass("ui-draggable-handle")
        },
        _removeHandleClassName: function () {
            this.handleElement.removeClass("ui-draggable-handle")
        },
        _createHelper: function (e) {
            var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
            return s.parents("body").length || s.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s[0] === this.element[0] || /(fixed|absolute)/.test(s.css("position")) || s.css("position", "absolute"), s
        },
        _adjustOffsetFromHelper: function (e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _isRootNode: function (t) {
            return /(html|body)/i.test(t.tagName) || t === this.document[0]
        },
        _getParentOffset: function () {
            var e = this.offsetParent.offset(), i = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== i && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" !== this.cssPosition) return {top: 0, left: 0};
            var t = this.element.position(), e = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + (e ? 0 : this.scrollParent.scrollTop()),
                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + (e ? 0 : this.scrollParent.scrollLeft())
            }
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {width: this.helper.outerWidth(), height: this.helper.outerHeight()}
        },
        _setContainment: function () {
            var e, i, s, n = this.options, o = this.document[0];
            return this.relativeContainer = null, n.containment ? "window" === n.containment ? void (this.containment = [t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === n.containment ? void (this.containment = [0, 0, t(o).width() - this.helperProportions.width - this.margins.left, (t(o).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : n.containment.constructor === Array ? void (this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), i = t(n.containment), s = i[0], void (s && (e = "hidden" !== i.css("overflow"), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relativeContainer = i))) : void (this.containment = null)
        },
        _convertPositionTo: function (t, e) {
            e || (e = this.position);
            var i = "absolute" === t ? 1 : -1, s = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
                left: e.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
            }
        },
        _generatePosition: function (t, e) {
            var i, s, n, o, a = this.options, r = this._isRootNode(this.scrollParent[0]), l = t.pageX, h = t.pageY;
            return r && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), e && (this.containment && (this.relativeContainer ? (s = this.relativeContainer.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, t.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), t.pageY - this.offset.click.top < i[1] && (h = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), t.pageY - this.offset.click.top > i[3] && (h = i[3] + this.offset.click.top)), a.grid && (n = a.grid[1] ? this.originalPageY + Math.round((h - this.originalPageY) / a.grid[1]) * a.grid[1] : this.originalPageY, h = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - a.grid[1] : n + a.grid[1] : n, o = a.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / a.grid[0]) * a.grid[0] : this.originalPageX, l = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - a.grid[0] : o + a.grid[0] : o), "y" === a.axis && (l = this.originalPageX), "x" === a.axis && (h = this.originalPageY)), {
                top: h - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
                left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
            }
        },
        _clear: function () {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy()
        },
        _trigger: function (e, i, s) {
            return s = s || this._uiHash(), t.ui.plugin.call(this, e, [i, s, this], !0), "drag" === e && (this.positionAbs = this._convertPositionTo("absolute")), t.Widget.prototype._trigger.call(this, e, i, s)
        },
        plugins: {},
        _uiHash: function () {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), t.ui.plugin.add("draggable", "connectToSortable", {
        start: function (e, i, s) {
            var n = s.options, o = t.extend({}, i, {item: s.element});
            s.sortables = [], t(n.connectToSortable).each(function () {
                var i = t(this).sortable("instance");
                i && !i.options.disabled && (s.sortables.push({
                    instance: i,
                    shouldRevert: i.options.revert
                }), i.refreshPositions(), i._trigger("activate", e, o))
            })
        }, stop: function (e, i, s) {
            var n = t.extend({}, i, {item: s.element});
            t.each(s.sortables, function () {
                this.instance.isOver ? (this.instance.isOver = 0, s.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" === s.options.helper && this.instance.currentItem.css({
                    top: "auto",
                    left: "auto"
                })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, n))
            })
        }, drag: function (e, i, s) {
            var n = this;
            t.each(s.sortables, function () {
                var o = !1, a = this;
                this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (o = !0, t.each(s.sortables, function () {
                    return this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this !== a && this.instance._intersectsWith(this.instance.containerCache) && t.contains(a.instance.element[0], this.instance.element[0]) && (o = !1), o
                })), o ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = t(n).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function () {
                    return i.helper[0]
                }, e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = s.offset.click.top, this.instance.offset.click.left = s.offset.click.left, this.instance.offset.parent.left -= s.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= s.offset.parent.top - this.instance.offset.parent.top, s._trigger("toSortable", e), s.dropped = this.instance.element, s.currentItem = s.element, this.instance.fromOutside = s), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), s._trigger("fromSortable", e), s.dropped = !1)
            })
        }
    }), t.ui.plugin.add("draggable", "cursor", {
        start: function (e, i, s) {
            var n = t("body"), o = s.options;
            n.css("cursor") && (o._cursor = n.css("cursor")), n.css("cursor", o.cursor)
        }, stop: function (e, i, s) {
            var n = s.options;
            n._cursor && t("body").css("cursor", n._cursor)
        }
    }), t.ui.plugin.add("draggable", "opacity", {
        start: function (e, i, s) {
            var n = t(i.helper), o = s.options;
            n.css("opacity") && (o._opacity = n.css("opacity")), n.css("opacity", o.opacity)
        }, stop: function (e, i, s) {
            var n = s.options;
            n._opacity && t(i.helper).css("opacity", n._opacity)
        }
    }), t.ui.plugin.add("draggable", "scroll", {
        start: function (t, e, i) {
            i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset())
        }, drag: function (e, i, s) {
            var n = s.options, o = !1, a = s.scrollParentNotHidden[0], r = s.document[0];
            a !== r && "HTML" !== a.tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + a.offsetHeight - e.pageY < n.scrollSensitivity ? a.scrollTop = o = a.scrollTop + n.scrollSpeed : e.pageY - s.overflowOffset.top < n.scrollSensitivity && (a.scrollTop = o = a.scrollTop - n.scrollSpeed)), n.axis && "y" === n.axis || (s.overflowOffset.left + a.offsetWidth - e.pageX < n.scrollSensitivity ? a.scrollLeft = o = a.scrollLeft + n.scrollSpeed : e.pageX - s.overflowOffset.left < n.scrollSensitivity && (a.scrollLeft = o = a.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - t(r).scrollTop() < n.scrollSensitivity ? o = t(r).scrollTop(t(r).scrollTop() - n.scrollSpeed) : t(window).height() - (e.pageY - t(r).scrollTop()) < n.scrollSensitivity && (o = t(r).scrollTop(t(r).scrollTop() + n.scrollSpeed))), n.axis && "y" === n.axis || (e.pageX - t(r).scrollLeft() < n.scrollSensitivity ? o = t(r).scrollLeft(t(r).scrollLeft() - n.scrollSpeed) : t(window).width() - (e.pageX - t(r).scrollLeft()) < n.scrollSensitivity && (o = t(r).scrollLeft(t(r).scrollLeft() + n.scrollSpeed)))), o !== !1 && t.ui.ddmanager && !n.dropBehaviour && t.ui.ddmanager.prepareOffsets(s, e)
        }
    }), t.ui.plugin.add("draggable", "snap", {
        start: function (e, i, s) {
            var n = s.options;
            s.snapElements = [], t(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function () {
                var e = t(this), i = e.offset();
                this !== s.element[0] && s.snapElements.push({
                    item: this,
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: i.top,
                    left: i.left
                })
            })
        }, drag: function (e, i, s) {
            var n, o, a, r, l, h, c, u, d, p, f = s.options, m = f.snapTolerance, g = i.offset.left,
                v = g + s.helperProportions.width, b = i.offset.top, y = b + s.helperProportions.height;
            for (d = s.snapElements.length - 1; d >= 0; d--) l = s.snapElements[d].left, h = l + s.snapElements[d].width, c = s.snapElements[d].top, u = c + s.snapElements[d].height, l - m > v || g > h + m || c - m > y || b > u + m || !t.contains(s.snapElements[d].item.ownerDocument, s.snapElements[d].item) ? (s.snapElements[d].snapping && s.options.snap.release && s.options.snap.release.call(s.element, e, t.extend(s._uiHash(), {snapItem: s.snapElements[d].item})), s.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (n = Math.abs(c - y) <= m, o = Math.abs(u - b) <= m, a = Math.abs(l - v) <= m, r = Math.abs(h - g) <= m, n && (i.position.top = s._convertPositionTo("relative", {
                top: c - s.helperProportions.height,
                left: 0
            }).top - s.margins.top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u,
                left: 0
            }).top - s.margins.top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l - s.helperProportions.width
            }).left - s.margins.left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h
            }).left - s.margins.left)), p = n || o || a || r, "outer" !== f.snapMode && (n = Math.abs(c - b) <= m, o = Math.abs(u - y) <= m, a = Math.abs(l - g) <= m, r = Math.abs(h - v) <= m, n && (i.position.top = s._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top - s.margins.top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u - s.helperProportions.height,
                left: 0
            }).top - s.margins.top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l
            }).left - s.margins.left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h - s.helperProportions.width
            }).left - s.margins.left)), !s.snapElements[d].snapping && (n || o || a || r || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, e, t.extend(s._uiHash(), {snapItem: s.snapElements[d].item})), s.snapElements[d].snapping = n || o || a || r || p)
        }
    }), t.ui.plugin.add("draggable", "stack", {
        start: function (e, i, s) {
            var n, o = s.options, a = t.makeArray(t(o.stack)).sort(function (e, i) {
                return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0)
            });
            a.length && (n = parseInt(t(a[0]).css("zIndex"), 10) || 0, t(a).each(function (e) {
                t(this).css("zIndex", n + e)
            }), this.css("zIndex", n + a.length))
        }
    }), t.ui.plugin.add("draggable", "zIndex", {
        start: function (e, i, s) {
            var n = t(i.helper), o = s.options;
            n.css("zIndex") && (o._zIndex = n.css("zIndex")), n.css("zIndex", o.zIndex)
        }, stop: function (e, i, s) {
            var n = s.options;
            n._zIndex && t(i.helper).css("zIndex", n._zIndex)
        }
    }), t.ui.draggable, t.widget("ui.resizable", t.ui.mouse, {
        version: "1.11.1",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _num: function (t) {
            return parseInt(t, 10) || 0
        },
        _isNumber: function (t) {
            return !isNaN(parseInt(t, 10))
        },
        _hasScroll: function (e, i) {
            if ("hidden" === t(e).css("overflow")) return !1;
            var s = i && "left" === i ? "scrollLeft" : "scrollTop", n = !1;
            return e[s] > 0 ? !0 : (e[s] = 1, n = e[s] > 0, e[s] = 0, n)
        },
        _create: function () {
            var e, i, s, n, o, a = this, r = this.options;
            if (this.element.addClass("ui-resizable"), t.extend(this, {
                _aspectRatio: !!r.aspectRatio,
                aspectRatio: r.aspectRatio,
                originalElement: this.element,
                _proportionallyResizeElements: [],
                _helper: r.helper || r.ghost || r.animate ? r.helper || "ui-resizable-helper" : null
            }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                position: this.element.css("position"),
                width: this.element.outerWidth(),
                height: this.element.outerHeight(),
                top: this.element.css("top"),
                left: this.element.css("left")
            })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, this.element.css({
                marginLeft: this.originalElement.css("marginLeft"),
                marginTop: this.originalElement.css("marginTop"),
                marginRight: this.originalElement.css("marginRight"),
                marginBottom: this.originalElement.css("marginBottom")
            }), this.originalElement.css({
                marginLeft: 0,
                marginTop: 0,
                marginRight: 0,
                marginBottom: 0
            }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                position: "static",
                zoom: 1,
                display: "block"
            })), this.originalElement.css({margin: this.originalElement.css("margin")}), this._proportionallyResize()), this.handles = r.handles || (t(".ui-resizable-handle", this.element).length ? {
                n: ".ui-resizable-n",
                e: ".ui-resizable-e",
                s: ".ui-resizable-s",
                w: ".ui-resizable-w",
                se: ".ui-resizable-se",
                sw: ".ui-resizable-sw",
                ne: ".ui-resizable-ne",
                nw: ".ui-resizable-nw"
            } : "e,s,se"), this.handles.constructor === String) for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), e = this.handles.split(","), this.handles = {}, i = 0; i < e.length; i++) s = t.trim(e[i]), o = "ui-resizable-" + s, n = t("<div class='ui-resizable-handle " + o + "'></div>"), n.css({zIndex: r.zIndex}), "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[s] = ".ui-resizable-" + s, this.element.append(n);
            this._renderAxis = function (e) {
                var i, s, n, o;
                e = e || this.element;
                for (i in this.handles) this.handles[i].constructor === String && (this.handles[i] = this.element.children(this.handles[i]).first().show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (s = t(this.handles[i], this.element), o = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join(""), e.css(n, o), this._proportionallyResize()), t(this.handles[i]).length
            }, this._renderAxis(this.element), this._handles = t(".ui-resizable-handle", this.element).disableSelection(), this._handles.mouseover(function () {
                a.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), a.axis = n && n[1] ? n[1] : "se")
            }), r.autoHide && (this._handles.hide(), t(this.element).addClass("ui-resizable-autohide").mouseenter(function () {
                r.disabled || (t(this).removeClass("ui-resizable-autohide"), a._handles.show())
            }).mouseleave(function () {
                r.disabled || a.resizing || (t(this).addClass("ui-resizable-autohide"), a._handles.hide())
            })), this._mouseInit()
        },
        _destroy: function () {
            this._mouseDestroy();
            var e, i = function (e) {
                t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
            };
            return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
                position: e.css("position"),
                width: e.outerWidth(),
                height: e.outerHeight(),
                top: e.css("top"),
                left: e.css("left")
            }).insertAfter(e), e.remove()), this.originalElement.css("resize", this.originalResizeStyle), i(this.originalElement), this
        },
        _mouseCapture: function (e) {
            var i, s, n = !1;
            for (i in this.handles) s = t(this.handles[i])[0], (s === e.target || t.contains(s, e.target)) && (n = !0);
            return !this.options.disabled && n
        },
        _mouseStart: function (e) {
            var i, s, n, o = this.options, a = this.element;
            return this.resizing = !0, this._renderProxy(), i = this._num(this.helper.css("left")), s = this._num(this.helper.css("top")), o.containment && (i += t(o.containment).scrollLeft() || 0, s += t(o.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: i,
                top: s
            }, this.size = this._helper ? {
                width: this.helper.width(),
                height: this.helper.height()
            } : {width: a.width(), height: a.height()}, this.originalSize = this._helper ? {
                width: a.outerWidth(),
                height: a.outerHeight()
            } : {width: a.width(), height: a.height()}, this.sizeDiff = {
                width: a.outerWidth() - a.width(),
                height: a.outerHeight() - a.height()
            }, this.originalPosition = {left: i, top: s}, this.originalMousePosition = {
                left: e.pageX,
                top: e.pageY
            }, this.aspectRatio = "number" == typeof o.aspectRatio ? o.aspectRatio : this.originalSize.width / this.originalSize.height || 1, n = t(".ui-resizable-" + this.axis).css("cursor"), t("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), a.addClass("ui-resizable-resizing"), this._propagate("start", e), !0
        },
        _mouseDrag: function (e) {
            var i, s, n = this.originalMousePosition, o = this.axis, a = e.pageX - n.left || 0,
                r = e.pageY - n.top || 0, l = this._change[o];
            return this._updatePrevProperties(), l ? (i = l.apply(this, [e, a, r]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), this._updateCache(i), this._propagate("resize", e), s = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), t.isEmptyObject(s) || (this._updatePrevProperties(), this._trigger("resize", e, this.ui()), this._applyChanges()), !1) : !1
        },
        _mouseStop: function (e) {
            this.resizing = !1;
            var i, s, n, o, a, r, l, h = this.options, c = this;
            return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), n = s && this._hasScroll(i[0], "left") ? 0 : c.sizeDiff.height, o = s ? 0 : c.sizeDiff.width, a = {
                width: c.helper.width() - o,
                height: c.helper.height() - n
            }, r = parseInt(c.element.css("left"), 10) + (c.position.left - c.originalPosition.left) || null, l = parseInt(c.element.css("top"), 10) + (c.position.top - c.originalPosition.top) || null, h.animate || this.element.css(t.extend(a, {
                top: l,
                left: r
            })), c.helper.height(c.size.height), c.helper.width(c.size.width), this._helper && !h.animate && this._proportionallyResize()), t("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", e), this._helper && this.helper.remove(), !1
        },
        _updatePrevProperties: function () {
            this.prevPosition = {
                top: this.position.top,
                left: this.position.left
            }, this.prevSize = {width: this.size.width, height: this.size.height}
        },
        _applyChanges: function () {
            var t = {};
            return this.position.top !== this.prevPosition.top && (t.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (t.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (t.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (t.height = this.size.height + "px"), this.helper.css(t), t
        },
        _updateVirtualBoundaries: function (t) {
            var e, i, s, n, o, a = this.options;
            o = {
                minWidth: this._isNumber(a.minWidth) ? a.minWidth : 0,
                maxWidth: this._isNumber(a.maxWidth) ? a.maxWidth : 1 / 0,
                minHeight: this._isNumber(a.minHeight) ? a.minHeight : 0,
                maxHeight: this._isNumber(a.maxHeight) ? a.maxHeight : 1 / 0
            }, (this._aspectRatio || t) && (e = o.minHeight * this.aspectRatio, s = o.minWidth / this.aspectRatio, i = o.maxHeight * this.aspectRatio, n = o.maxWidth / this.aspectRatio, e > o.minWidth && (o.minWidth = e), s > o.minHeight && (o.minHeight = s), i < o.maxWidth && (o.maxWidth = i), n < o.maxHeight && (o.maxHeight = n)), this._vBoundaries = o
        },
        _updateCache: function (t) {
            this.offset = this.helper.offset(), this._isNumber(t.left) && (this.position.left = t.left), this._isNumber(t.top) && (this.position.top = t.top), this._isNumber(t.height) && (this.size.height = t.height), this._isNumber(t.width) && (this.size.width = t.width)
        },
        _updateRatio: function (t) {
            var e = this.position, i = this.size, s = this.axis;
            return this._isNumber(t.height) ? t.width = t.height * this.aspectRatio : this._isNumber(t.width) && (t.height = t.width / this.aspectRatio), "sw" === s && (t.left = e.left + (i.width - t.width), t.top = null), "nw" === s && (t.top = e.top + (i.height - t.height), t.left = e.left + (i.width - t.width)), t
        },
        _respectSize: function (t) {
            var e = this._vBoundaries, i = this.axis, s = this._isNumber(t.width) && e.maxWidth && e.maxWidth < t.width,
                n = this._isNumber(t.height) && e.maxHeight && e.maxHeight < t.height,
                o = this._isNumber(t.width) && e.minWidth && e.minWidth > t.width,
                a = this._isNumber(t.height) && e.minHeight && e.minHeight > t.height,
                r = this.originalPosition.left + this.originalSize.width, l = this.position.top + this.size.height,
                h = /sw|nw|w/.test(i), c = /nw|ne|n/.test(i);
            return o && (t.width = e.minWidth), a && (t.height = e.minHeight), s && (t.width = e.maxWidth), n && (t.height = e.maxHeight), o && h && (t.left = r - e.minWidth), s && h && (t.left = r - e.maxWidth), a && c && (t.top = l - e.minHeight), n && c && (t.top = l - e.maxHeight), t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null, t
        },
        _getPaddingPlusBorderDimensions: function (t) {
            for (var e = 0, i = [], s = [t.css("borderTopWidth"), t.css("borderRightWidth"), t.css("borderBottomWidth"), t.css("borderLeftWidth")], n = [t.css("paddingTop"), t.css("paddingRight"), t.css("paddingBottom"), t.css("paddingLeft")]; 4 > e; e++) i[e] = parseInt(s[e], 10) || 0, i[e] += parseInt(n[e], 10) || 0;
            return {height: i[0] + i[2], width: i[1] + i[3]}
        },
        _proportionallyResize: function () {
            if (this._proportionallyResizeElements.length) for (var t, e = 0, i = this.helper || this.element; e < this._proportionallyResizeElements.length; e++) t = this._proportionallyResizeElements[e], this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(t)), t.css({
                height: i.height() - this.outerDimensions.height || 0,
                width: i.width() - this.outerDimensions.width || 0
            })
        },
        _renderProxy: function () {
            var e = this.element, i = this.options;
            this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() - 1,
                height: this.element.outerHeight() - 1,
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++i.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        },
        _change: {
            e: function (t, e) {
                return {width: this.originalSize.width + e}
            }, w: function (t, e) {
                var i = this.originalSize, s = this.originalPosition;
                return {left: s.left + e, width: i.width - e}
            }, n: function (t, e, i) {
                var s = this.originalSize, n = this.originalPosition;
                return {top: n.top + i, height: s.height - i}
            }, s: function (t, e, i) {
                return {height: this.originalSize.height + i}
            }, se: function (e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
            }, sw: function (e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
            }, ne: function (e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
            }, nw: function (e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
            }
        },
        _propagate: function (e, i) {
            t.ui.plugin.call(this, e, [i, this.ui()]), "resize" !== e && this._trigger(e, i, this.ui())
        },
        plugins: {},
        ui: function () {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition
            }
        }
    }), t.ui.plugin.add("resizable", "animate", {
        stop: function (e) {
            var i = t(this).resizable("instance"), s = i.options, n = i._proportionallyResizeElements,
                o = n.length && /textarea/i.test(n[0].nodeName),
                a = o && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height, r = o ? 0 : i.sizeDiff.width,
                l = {width: i.size.width - r, height: i.size.height - a},
                h = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null,
                c = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
            i.element.animate(t.extend(l, c && h ? {top: c, left: h} : {}), {
                duration: s.animateDuration,
                easing: s.animateEasing,
                step: function () {
                    var s = {
                        width: parseInt(i.element.css("width"), 10),
                        height: parseInt(i.element.css("height"), 10),
                        top: parseInt(i.element.css("top"), 10),
                        left: parseInt(i.element.css("left"), 10)
                    };
                    n && n.length && t(n[0]).css({
                        width: s.width,
                        height: s.height
                    }), i._updateCache(s), i._propagate("resize", e)
                }
            })
        }
    }), t.ui.plugin.add("resizable", "containment", {
        start: function () {
            var e, i, s, n, o, a, r, l = t(this).resizable("instance"), h = l.options, c = l.element, u = h.containment,
                d = u instanceof t ? u.get(0) : /parent/.test(u) ? c.parent().get(0) : u;
            d && (l.containerElement = t(d), /document/.test(u) || u === document ? (l.containerOffset = {
                left: 0,
                top: 0
            }, l.containerPosition = {left: 0, top: 0}, l.parentData = {
                element: t(document),
                left: 0,
                top: 0,
                width: t(document).width(),
                height: t(document).height() || document.body.parentNode.scrollHeight
            }) : (e = t(d), i = [], t(["Top", "Right", "Left", "Bottom"]).each(function (t, s) {
                i[t] = l._num(e.css("padding" + s))
            }), l.containerOffset = e.offset(), l.containerPosition = e.position(), l.containerSize = {
                height: e.innerHeight() - i[3],
                width: e.innerWidth() - i[1]
            }, s = l.containerOffset, n = l.containerSize.height, o = l.containerSize.width, a = l._hasScroll(d, "left") ? d.scrollWidth : o, r = l._hasScroll(d) ? d.scrollHeight : n, l.parentData = {
                element: d,
                left: s.left,
                top: s.top,
                width: a,
                height: r
            }))
        }, resize: function (e) {
            var i, s, n, o, a = t(this).resizable("instance"), r = a.options, l = a.containerOffset, h = a.position,
                c = a._aspectRatio || e.shiftKey, u = {top: 0, left: 0}, d = a.containerElement, p = !0;
            d[0] !== document && /static/.test(d.css("position")) && (u = l), h.left < (a._helper ? l.left : 0) && (a.size.width = a.size.width + (a._helper ? a.position.left - l.left : a.position.left - u.left), c && (a.size.height = a.size.width / a.aspectRatio, p = !1), a.position.left = r.helper ? l.left : 0), h.top < (a._helper ? l.top : 0) && (a.size.height = a.size.height + (a._helper ? a.position.top - l.top : a.position.top), c && (a.size.width = a.size.height * a.aspectRatio, p = !1), a.position.top = a._helper ? l.top : 0), n = a.containerElement.get(0) === a.element.parent().get(0), o = /relative|absolute/.test(a.containerElement.css("position")), n && o ? (a.offset.left = a.parentData.left + a.position.left, a.offset.top = a.parentData.top + a.position.top) : (a.offset.left = a.element.offset().left, a.offset.top = a.element.offset().top), i = Math.abs(a.sizeDiff.width + (a._helper ? a.offset.left - u.left : a.offset.left - l.left)), s = Math.abs(a.sizeDiff.height + (a._helper ? a.offset.top - u.top : a.offset.top - l.top)), i + a.size.width >= a.parentData.width && (a.size.width = a.parentData.width - i, c && (a.size.height = a.size.width / a.aspectRatio, p = !1)), s + a.size.height >= a.parentData.height && (a.size.height = a.parentData.height - s, c && (a.size.width = a.size.height * a.aspectRatio, p = !1)), p || (a.position.left = a.prevPosition.left, a.position.top = a.prevPosition.top, a.size.width = a.prevSize.width, a.size.height = a.prevSize.height)
        }, stop: function () {
            var e = t(this).resizable("instance"), i = e.options, s = e.containerOffset, n = e.containerPosition,
                o = e.containerElement, a = t(e.helper), r = a.offset(), l = a.outerWidth() - e.sizeDiff.width,
                h = a.outerHeight() - e.sizeDiff.height;
            e._helper && !i.animate && /relative/.test(o.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: l,
                height: h
            }), e._helper && !i.animate && /static/.test(o.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: l,
                height: h
            })
        }
    }), t.ui.plugin.add("resizable", "alsoResize", {
        start: function () {
            var e = t(this).resizable("instance"), i = e.options, s = function (e) {
                t(e).each(function () {
                    var e = t(this);
                    e.data("ui-resizable-alsoresize", {
                        width: parseInt(e.width(), 10),
                        height: parseInt(e.height(), 10),
                        left: parseInt(e.css("left"), 10),
                        top: parseInt(e.css("top"), 10)
                    })
                })
            };
            "object" != typeof i.alsoResize || i.alsoResize.parentNode ? s(i.alsoResize) : i.alsoResize.length ? (i.alsoResize = i.alsoResize[0], s(i.alsoResize)) : t.each(i.alsoResize, function (t) {
                s(t)
            })
        }, resize: function (e, i) {
            var s = t(this).resizable("instance"), n = s.options, o = s.originalSize, a = s.originalPosition, r = {
                height: s.size.height - o.height || 0,
                width: s.size.width - o.width || 0,
                top: s.position.top - a.top || 0,
                left: s.position.left - a.left || 0
            }, l = function (e, s) {
                t(e).each(function () {
                    var e = t(this), n = t(this).data("ui-resizable-alsoresize"), o = {},
                        a = s && s.length ? s : e.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                    t.each(a, function (t, e) {
                        var i = (n[e] || 0) + (r[e] || 0);
                        i && i >= 0 && (o[e] = i || null)
                    }), e.css(o)
                })
            };
            "object" != typeof n.alsoResize || n.alsoResize.nodeType ? l(n.alsoResize) : t.each(n.alsoResize, function (t, e) {
                l(t, e)
            })
        }, stop: function () {
            t(this).removeData("resizable-alsoresize")
        }
    }), t.ui.plugin.add("resizable", "ghost", {
        start: function () {
            var e = t(this).resizable("instance"), i = e.options, s = e.size;
            e.ghost = e.originalElement.clone(), e.ghost.css({
                opacity: .25, display: "block", position: "relative",
                height: s.height, width: s.width, margin: 0, left: 0, top: 0
            }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost : ""), e.ghost.appendTo(e.helper)
        }, resize: function () {
            var e = t(this).resizable("instance");
            e.ghost && e.ghost.css({position: "relative", height: e.size.height, width: e.size.width})
        }, stop: function () {
            var e = t(this).resizable("instance");
            e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))
        }
    }), t.ui.plugin.add("resizable", "grid", {
        resize: function () {
            var e, i = t(this).resizable("instance"), s = i.options, n = i.size, o = i.originalSize,
                a = i.originalPosition, r = i.axis, l = "number" == typeof s.grid ? [s.grid, s.grid] : s.grid,
                h = l[0] || 1, c = l[1] || 1, u = Math.round((n.width - o.width) / h) * h,
                d = Math.round((n.height - o.height) / c) * c, p = o.width + u, f = o.height + d,
                m = s.maxWidth && s.maxWidth < p, g = s.maxHeight && s.maxHeight < f, v = s.minWidth && s.minWidth > p,
                b = s.minHeight && s.minHeight > f;
            s.grid = l, v && (p += h), b && (f += c), m && (p -= h), g && (f -= c), /^(se|s|e)$/.test(r) ? (i.size.width = p, i.size.height = f) : /^(ne)$/.test(r) ? (i.size.width = p, i.size.height = f, i.position.top = a.top - d) : /^(sw)$/.test(r) ? (i.size.width = p, i.size.height = f, i.position.left = a.left - u) : ((0 >= f - c || 0 >= p - h) && (e = i._getPaddingPlusBorderDimensions(this)), f - c > 0 ? (i.size.height = f, i.position.top = a.top - d) : (f = c - e.height, i.size.height = f, i.position.top = a.top + o.height - f), p - h > 0 ? (i.size.width = p, i.position.left = a.left - u) : (p = c - e.height, i.size.width = p, i.position.left = a.left + o.width - p))
        }
    }), t.ui.resizable, t.widget("ui.dialog", {
        version: "1.11.1",
        options: {
            appendTo: "body",
            autoOpen: !0,
            buttons: [],
            closeOnEscape: !0,
            closeText: "Close",
            dialogClass: "",
            draggable: !0,
            hide: null,
            height: "auto",
            maxHeight: null,
            maxWidth: null,
            minHeight: 150,
            minWidth: 150,
            modal: !1,
            position: {
                my: "center", at: "center", of: window, collision: "fit", using: function (e) {
                    var i = t(this).css(e).offset().top;
                    0 > i && t(this).css("top", e.top - i)
                }
            },
            resizable: !0,
            show: null,
            title: null,
            width: 300,
            beforeClose: null,
            close: null,
            drag: null,
            dragStart: null,
            dragStop: null,
            focus: null,
            open: null,
            resize: null,
            resizeStart: null,
            resizeStop: null
        },
        sizeRelatedOptions: {
            buttons: !0,
            height: !0,
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0,
            width: !0
        },
        resizableRelatedOptions: {maxHeight: !0, maxWidth: !0, minHeight: !0, minWidth: !0},
        _create: function () {
            this.originalCss = {
                display: this.element[0].style.display,
                width: this.element[0].style.width,
                minHeight: this.element[0].style.minHeight,
                maxHeight: this.element[0].style.maxHeight,
                height: this.element[0].style.height
            }, this.originalPosition = {
                parent: this.element.parent(),
                index: this.element.parent().children().index(this.element)
            }, this.originalTitle = this.element.attr("title"), this.options.title = this.options.title || this.originalTitle, this._createWrapper(), this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog), this._createTitlebar(), this._createButtonPane(), this.options.draggable && t.fn.draggable && this._makeDraggable(), this.options.resizable && t.fn.resizable && this._makeResizable(), this._isOpen = !1, this._trackFocus()
        },
        _init: function () {
            this.options.autoOpen && this.open()
        },
        _appendTo: function () {
            var e = this.options.appendTo;
            return e && (e.jquery || e.nodeType) ? t(e) : this.document.find(e || "body").eq(0)
        },
        _destroy: function () {
            var t, e = this.originalPosition;
            this._destroyOverlay(), this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(), this.uiDialog.stop(!0, !0).remove(), this.originalTitle && this.element.attr("title", this.originalTitle), t = e.parent.children().eq(e.index), t.length && t[0] !== this.element[0] ? t.before(this.element) : e.parent.append(this.element)
        },
        widget: function () {
            return this.uiDialog
        },
        disable: t.noop,
        enable: t.noop,
        close: function (e) {
            var i, s = this;
            if (this._isOpen && this._trigger("beforeClose", e) !== !1) {
                if (this._isOpen = !1, this._focusedElement = null, this._destroyOverlay(), this._untrackInstance(), !this.opener.filter(":focusable").focus().length) try {
                    i = this.document[0].activeElement, i && "body" !== i.nodeName.toLowerCase() && t(i).blur()
                } catch (n) {
                }
                this._hide(this.uiDialog, this.options.hide, function () {
                    s._trigger("close", e)
                })
            }
        },
        isOpen: function () {
            return this._isOpen
        },
        moveToTop: function () {
            this._moveToTop()
        },
        _moveToTop: function (e, i) {
            var s = !1, n = this.uiDialog.siblings(".ui-front:visible").map(function () {
                return +t(this).css("z-index")
            }).get(), o = Math.max.apply(null, n);
            return o >= +this.uiDialog.css("z-index") && (this.uiDialog.css("z-index", o + 1), s = !0), s && !i && this._trigger("focus", e), s
        },
        open: function () {
            var e = this;
            return this._isOpen ? void (this._moveToTop() && this._focusTabbable()) : (this._isOpen = !0, this.opener = t(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this.overlay && this.overlay.css("z-index", this.uiDialog.css("z-index") - 1), this._show(this.uiDialog, this.options.show, function () {
                e._focusTabbable(), e._trigger("focus")
            }), this._makeFocusTarget(), void this._trigger("open"))
        },
        _focusTabbable: function () {
            var t = this._focusedElement;
            t || (t = this.element.find("[autofocus]")), t.length || (t = this.element.find(":tabbable")), t.length || (t = this.uiDialogButtonPane.find(":tabbable")), t.length || (t = this.uiDialogTitlebarClose.filter(":tabbable")), t.length || (t = this.uiDialog), t.eq(0).focus()
        },
        _keepFocus: function (e) {
            function i() {
                var e = this.document[0].activeElement, i = this.uiDialog[0] === e || t.contains(this.uiDialog[0], e);
                i || this._focusTabbable()
            }

            e.preventDefault(), i.call(this), this._delay(i)
        },
        _createWrapper: function () {
            this.uiDialog = t("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                tabIndex: -1,
                role: "dialog"
            }).appendTo(this._appendTo()), this._on(this.uiDialog, {
                keydown: function (e) {
                    if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === t.ui.keyCode.ESCAPE) return e.preventDefault(), void this.close(e);
                    if (e.keyCode === t.ui.keyCode.TAB && !e.isDefaultPrevented()) {
                        var i = this.uiDialog.find(":tabbable"), s = i.filter(":first"), n = i.filter(":last");
                        e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== s[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (this._delay(function () {
                            n.focus()
                        }), e.preventDefault()) : (this._delay(function () {
                            s.focus()
                        }), e.preventDefault())
                    }
                }, mousedown: function (t) {
                    this._moveToTop(t) && this._focusTabbable()
                }
            }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({"aria-describedby": this.element.uniqueId().attr("id")})
        },
        _createTitlebar: function () {
            var e;
            this.uiDialogTitlebar = t("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog), this._on(this.uiDialogTitlebar, {
                mousedown: function (e) {
                    t(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus()
                }
            }), this.uiDialogTitlebarClose = t("<button type='button'></button>").button({
                label: this.options.closeText,
                icons: {primary: "ui-icon-closethick"},
                text: !1
            }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar), this._on(this.uiDialogTitlebarClose, {
                click: function (t) {
                    t.preventDefault(), this.close(t)
                }
            }), e = t("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar), this._title(e), this.uiDialog.attr({"aria-labelledby": e.attr("id")})
        },
        _title: function (t) {
            this.options.title || t.html("&#160;"), t.text(this.options.title)
        },
        _createButtonPane: function () {
            this.uiDialogButtonPane = t("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"), this.uiButtonSet = t("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane), this._createButtons()
        },
        _createButtons: function () {
            var e = this, i = this.options.buttons;
            return this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), t.isEmptyObject(i) || t.isArray(i) && !i.length ? void this.uiDialog.removeClass("ui-dialog-buttons") : (t.each(i, function (i, s) {
                var n, o;
                s = t.isFunction(s) ? {
                    click: s,
                    text: i
                } : s, s = t.extend({type: "button"}, s), n = s.click, s.click = function () {
                    n.apply(e.element[0], arguments)
                }, o = {
                    icons: s.icons,
                    text: s.showText
                }, delete s.icons, delete s.showText, t("<button></button>", s).button(o).appendTo(e.uiButtonSet)
            }), this.uiDialog.addClass("ui-dialog-buttons"), void this.uiDialogButtonPane.appendTo(this.uiDialog))
        },
        _makeDraggable: function () {
            function e(t) {
                return {position: t.position, offset: t.offset}
            }

            var i = this, s = this.options;
            this.uiDialog.draggable({
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar",
                containment: "document",
                start: function (s, n) {
                    t(this).addClass("ui-dialog-dragging"), i._blockFrames(), i._trigger("dragStart", s, e(n))
                },
                drag: function (t, s) {
                    i._trigger("drag", t, e(s))
                },
                stop: function (n, o) {
                    var a = o.offset.left - i.document.scrollLeft(), r = o.offset.top - i.document.scrollTop();
                    s.position = {
                        my: "left top",
                        at: "left" + (a >= 0 ? "+" : "") + a + " top" + (r >= 0 ? "+" : "") + r,
                        of: i.window
                    }, t(this).removeClass("ui-dialog-dragging"), i._unblockFrames(), i._trigger("dragStop", n, e(o))
                }
            })
        },
        _makeResizable: function () {
            function e(t) {
                return {
                    originalPosition: t.originalPosition,
                    originalSize: t.originalSize,
                    position: t.position,
                    size: t.size
                }
            }

            var i = this, s = this.options, n = s.resizable, o = this.uiDialog.css("position"),
                a = "string" == typeof n ? n : "n,e,s,w,se,sw,ne,nw";
            this.uiDialog.resizable({
                cancel: ".ui-dialog-content",
                containment: "document",
                alsoResize: this.element,
                maxWidth: s.maxWidth,
                maxHeight: s.maxHeight,
                minWidth: s.minWidth,
                minHeight: this._minHeight(),
                handles: a,
                start: function (s, n) {
                    t(this).addClass("ui-dialog-resizing"), i._blockFrames(), i._trigger("resizeStart", s, e(n))
                },
                resize: function (t, s) {
                    i._trigger("resize", t, e(s))
                },
                stop: function (n, o) {
                    var a = i.uiDialog.offset(), r = a.left - i.document.scrollLeft(),
                        l = a.top - i.document.scrollTop();
                    s.height = i.uiDialog.height(), s.width = i.uiDialog.width(), s.position = {
                        my: "left top",
                        at: "left" + (r >= 0 ? "+" : "") + r + " top" + (l >= 0 ? "+" : "") + l,
                        of: i.window
                    }, t(this).removeClass("ui-dialog-resizing"), i._unblockFrames(), i._trigger("resizeStop", n, e(o))
                }
            }).css("position", o)
        },
        _trackFocus: function () {
            this._on(this.widget(), {
                focusin: function (e) {
                    this._makeFocusTarget(), this._focusedElement = t(e.target)
                }
            })
        },
        _makeFocusTarget: function () {
            this._untrackInstance(), this._trackingInstances().unshift(this)
        },
        _untrackInstance: function () {
            var e = this._trackingInstances(), i = t.inArray(this, e);
            -1 !== i && e.splice(i, 1)
        },
        _trackingInstances: function () {
            var t = this.document.data("ui-dialog-instances");
            return t || (t = [], this.document.data("ui-dialog-instances", t)), t
        },
        _minHeight: function () {
            var t = this.options;
            return "auto" === t.height ? t.minHeight : Math.min(t.minHeight, t.height)
        },
        _position: function () {
            var t = this.uiDialog.is(":visible");
            t || this.uiDialog.show(), this.uiDialog.position(this.options.position), t || this.uiDialog.hide()
        },
        _setOptions: function (e) {
            var i = this, s = !1, n = {};
            t.each(e, function (t, e) {
                i._setOption(t, e), t in i.sizeRelatedOptions && (s = !0), t in i.resizableRelatedOptions && (n[t] = e)
            }), s && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", n)
        },
        _setOption: function (t, e) {
            var i, s, n = this.uiDialog;
            "dialogClass" === t && n.removeClass(this.options.dialogClass).addClass(e), "disabled" !== t && (this._super(t, e), "appendTo" === t && this.uiDialog.appendTo(this._appendTo()), "buttons" === t && this._createButtons(), "closeText" === t && this.uiDialogTitlebarClose.button({label: "" + e}), "draggable" === t && (i = n.is(":data(ui-draggable)"), i && !e && n.draggable("destroy"), !i && e && this._makeDraggable()), "position" === t && this._position(), "resizable" === t && (s = n.is(":data(ui-resizable)"), s && !e && n.resizable("destroy"), s && "string" == typeof e && n.resizable("option", "handles", e), s || e === !1 || this._makeResizable()), "title" === t && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
        },
        _size: function () {
            var t, e, i, s = this.options;
            this.element.show().css({
                width: "auto",
                minHeight: 0,
                maxHeight: "none",
                height: 0
            }), s.minWidth > s.width && (s.width = s.minWidth), t = this.uiDialog.css({
                height: "auto",
                width: s.width
            }).outerHeight(), e = Math.max(0, s.minHeight - t), i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - t) : "none", "auto" === s.height ? this.element.css({
                minHeight: e,
                maxHeight: i,
                height: "auto"
            }) : this.element.height(Math.max(0, s.height - t)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        },
        _blockFrames: function () {
            this.iframeBlocks = this.document.find("iframe").map(function () {
                var e = t(this);
                return t("<div>").css({
                    position: "absolute",
                    width: e.outerWidth(),
                    height: e.outerHeight()
                }).appendTo(e.parent()).offset(e.offset())[0]
            })
        },
        _unblockFrames: function () {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _allowInteraction: function (e) {
            return t(e.target).closest(".ui-dialog").length ? !0 : !!t(e.target).closest(".ui-datepicker").length
        },
        _createOverlay: function () {
            if (this.options.modal) {
                var e = !0;
                this._delay(function () {
                    e = !1
                }), this.document.data("ui-dialog-overlays") || this._on(this.document, {
                    focusin: function (t) {
                        e || this._allowInteraction(t) || (t.preventDefault(), this._trackingInstances()[0]._focusTabbable())
                    }
                }), this.overlay = t("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()), this._on(this.overlay, {mousedown: "_keepFocus"}), this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1)
            }
        },
        _destroyOverlay: function () {
            if (this.options.modal && this.overlay) {
                var t = this.document.data("ui-dialog-overlays") - 1;
                t ? this.document.data("ui-dialog-overlays", t) : this.document.unbind("focusin").removeData("ui-dialog-overlays"), this.overlay.remove(), this.overlay = null
            }
        }
    }), t.widget("ui.droppable", {
        version: "1.11.1",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function () {
            var e, i = this.options, s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = t.isFunction(s) ? s : function (t) {
                return t.is(s)
            }, this.proportions = function () {
                return arguments.length ? void (e = arguments[0]) : e ? e : e = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }
            }, this._addToManager(i.scope), i.addClasses && this.element.addClass("ui-droppable")
        },
        _addToManager: function (e) {
            t.ui.ddmanager.droppables[e] = t.ui.ddmanager.droppables[e] || [], t.ui.ddmanager.droppables[e].push(this)
        },
        _splice: function (t) {
            for (var e = 0; e < t.length; e++) t[e] === this && t.splice(e, 1)
        },
        _destroy: function () {
            var e = t.ui.ddmanager.droppables[this.options.scope];
            this._splice(e), this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function (e, i) {
            if ("accept" === e) this.accept = t.isFunction(i) ? i : function (t) {
                return t.is(i)
            }; else if ("scope" === e) {
                var s = t.ui.ddmanager.droppables[this.options.scope];
                this._splice(s), this._addToManager(i)
            }
            this._super(e, i)
        },
        _activate: function (e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", e, this.ui(i))
        },
        _deactivate: function (e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", e, this.ui(i))
        },
        _over: function (e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", e, this.ui(i)))
        },
        _out: function (e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", e, this.ui(i)))
        },
        _drop: function (e, i) {
            var s = i || t.ui.ddmanager.current, n = !1;
            return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function () {
                var i = t(this).droppable("instance");
                return i.options.greedy && !i.options.disabled && i.options.scope === s.options.scope && i.accept.call(i.element[0], s.currentItem || s.element) && t.ui.intersect(s, t.extend(i, {offset: i.element.offset()}), i.options.tolerance, e) ? (n = !0, !1) : void 0
            }), n ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e, this.ui(s)), this.element) : !1) : !1
        },
        ui: function (t) {
            return {
                draggable: t.currentItem || t.element,
                helper: t.helper,
                position: t.position,
                offset: t.positionAbs
            }
        }
    }), t.ui.intersect = function () {
        function t(t, e, i) {
            return t >= e && e + i > t
        }

        return function (e, i, s, n) {
            if (!i.offset) return !1;
            var o = (e.positionAbs || e.position.absolute).left, a = (e.positionAbs || e.position.absolute).top,
                r = o + e.helperProportions.width, l = a + e.helperProportions.height, h = i.offset.left,
                c = i.offset.top, u = h + i.proportions().width, d = c + i.proportions().height;
            switch (s) {
                case"fit":
                    return o >= h && u >= r && a >= c && d >= l;
                case"intersect":
                    return h < o + e.helperProportions.width / 2 && r - e.helperProportions.width / 2 < u && c < a + e.helperProportions.height / 2 && l - e.helperProportions.height / 2 < d;
                case"pointer":
                    return t(n.pageY, c, i.proportions().height) && t(n.pageX, h, i.proportions().width);
                case"touch":
                    return (a >= c && d >= a || l >= c && d >= l || c > a && l > d) && (o >= h && u >= o || r >= h && u >= r || h > o && r > u);
                default:
                    return !1
            }
        }
    }(), t.ui.ddmanager = {
        current: null, droppables: {"default": []}, prepareOffsets: function (e, i) {
            var s, n, o = t.ui.ddmanager.droppables[e.options.scope] || [], a = i ? i.type : null,
                r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
            t:for (s = 0; s < o.length; s++) if (!(o[s].options.disabled || e && !o[s].accept.call(o[s].element[0], e.currentItem || e.element))) {
                for (n = 0; n < r.length; n++) if (r[n] === o[s].element[0]) {
                    o[s].proportions().height = 0;
                    continue t
                }
                o[s].visible = "none" !== o[s].element.css("display"), o[s].visible && ("mousedown" === a && o[s]._activate.call(o[s], i), o[s].offset = o[s].element.offset(), o[s].proportions({
                    width: o[s].element[0].offsetWidth,
                    height: o[s].element[0].offsetHeight
                }))
            }
        }, drop: function (e, i) {
            var s = !1;
            return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), function () {
                this.options && (!this.options.disabled && this.visible && t.ui.intersect(e, this, this.options.tolerance, i) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
            }), s
        }, dragStart: function (e, i) {
            e.element.parentsUntil("body").bind("scroll.droppable", function () {
                e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
            })
        }, drag: function (e, i) {
            e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], function () {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, n, o, a = t.ui.intersect(e, this, this.options.tolerance, i),
                        r = !a && this.isover ? "isout" : a && !this.isover ? "isover" : null;
                    r && (this.options.greedy && (n = this.options.scope, o = this.element.parents(":data(ui-droppable)").filter(function () {
                        return t(this).droppable("instance").options.scope === n
                    }), o.length && (s = t(o[0]).droppable("instance"), s.greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
                }
            })
        }, dragStop: function (e, i) {
            e.element.parentsUntil("body").unbind("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
        }
    };
    var b = (t.ui.droppable, "ui-effects-"), y = t;
    t.effects = {effect: {}}, function (t, e) {
        function i(t, e, i) {
            var s = u[e.type] || {};
            return null == t ? i || !e.def ? null : e.def : (t = s.floor ? ~~t : parseFloat(t), isNaN(t) ? e.def : s.mod ? (t + s.mod) % s.mod : 0 > t ? 0 : s.max < t ? s.max : t)
        }

        function s(e) {
            var i = h(), s = i._rgba = [];
            return e = e.toLowerCase(), f(l, function (t, n) {
                var o, a = n.re.exec(e), r = a && n.parse(a), l = n.space || "rgba";
                return r ? (o = i[l](r), i[c[l].cache] = o[c[l].cache], s = i._rgba = o._rgba, !1) : void 0
            }), s.length ? ("0,0,0,0" === s.join() && t.extend(s, o.transparent), i) : o[e]
        }

        function n(t, e, i) {
            return i = (i + 1) % 1, 1 > 6 * i ? t + (e - t) * i * 6 : 1 > 2 * i ? e : 2 > 3 * i ? t + (e - t) * (2 / 3 - i) * 6 : t
        }

        var o,
            a = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
            r = /^([\-+])=\s*(\d+\.?\d*)/, l = [{
                re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                parse: function (t) {
                    return [t[1], t[2], t[3], t[4]]
                }
            }, {
                re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                parse: function (t) {
                    return [2.55 * t[1], 2.55 * t[2], 2.55 * t[3], t[4]]
                }
            }, {
                re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/, parse: function (t) {
                    return [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)]
                }
            }, {
                re: /#([a-f0-9])([a-f0-9])([a-f0-9])/, parse: function (t) {
                    return [parseInt(t[1] + t[1], 16), parseInt(t[2] + t[2], 16), parseInt(t[3] + t[3], 16)]
                }
            }, {
                re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                space: "hsla",
                parse: function (t) {
                    return [t[1], t[2] / 100, t[3] / 100, t[4]]
                }
            }], h = t.Color = function (e, i, s, n) {
                return new t.Color.fn.parse(e, i, s, n)
            }, c = {
                rgba: {
                    props: {
                        red: {idx: 0, type: "byte"},
                        green: {idx: 1, type: "byte"},
                        blue: {idx: 2, type: "byte"}
                    }
                },
                hsla: {
                    props: {
                        hue: {idx: 0, type: "degrees"},
                        saturation: {idx: 1, type: "percent"},
                        lightness: {idx: 2, type: "percent"}
                    }
                }
            }, u = {"byte": {floor: !0, max: 255}, percent: {max: 1}, degrees: {mod: 360, floor: !0}}, d = h.support = {},
            p = t("<p>")[0], f = t.each;
        p.style.cssText = "background-color:rgba(1,1,1,.5)", d.rgba = p.style.backgroundColor.indexOf("rgba") > -1, f(c, function (t, e) {
            e.cache = "_" + t, e.props.alpha = {idx: 3, type: "percent", def: 1}
        }), h.fn = t.extend(h.prototype, {
            parse: function (n, a, r, l) {
                if (n === e) return this._rgba = [null, null, null, null], this;
                (n.jquery || n.nodeType) && (n = t(n).css(a), a = e);
                var u = this, d = t.type(n), p = this._rgba = [];
                return a !== e && (n = [n, a, r, l], d = "array"), "string" === d ? this.parse(s(n) || o._default) : "array" === d ? (f(c.rgba.props, function (t, e) {
                    p[e.idx] = i(n[e.idx], e)
                }), this) : "object" === d ? (n instanceof h ? f(c, function (t, e) {
                    n[e.cache] && (u[e.cache] = n[e.cache].slice())
                }) : f(c, function (e, s) {
                    var o = s.cache;
                    f(s.props, function (t, e) {
                        if (!u[o] && s.to) {
                            if ("alpha" === t || null == n[t]) return;
                            u[o] = s.to(u._rgba)
                        }
                        u[o][e.idx] = i(n[t], e, !0)
                    }), u[o] && t.inArray(null, u[o].slice(0, 3)) < 0 && (u[o][3] = 1, s.from && (u._rgba = s.from(u[o])))
                }), this) : void 0
            }, is: function (t) {
                var e = h(t), i = !0, s = this;
                return f(c, function (t, n) {
                    var o, a = e[n.cache];
                    return a && (o = s[n.cache] || n.to && n.to(s._rgba) || [], f(n.props, function (t, e) {
                        return null != a[e.idx] ? i = a[e.idx] === o[e.idx] : void 0
                    })), i
                }), i
            }, _space: function () {
                var t = [], e = this;
                return f(c, function (i, s) {
                    e[s.cache] && t.push(i)
                }), t.pop()
            }, transition: function (t, e) {
                var s = h(t), n = s._space(), o = c[n], a = 0 === this.alpha() ? h("transparent") : this,
                    r = a[o.cache] || o.to(a._rgba), l = r.slice();
                return s = s[o.cache], f(o.props, function (t, n) {
                    var o = n.idx, a = r[o], h = s[o], c = u[n.type] || {};
                    null !== h && (null === a ? l[o] = h : (c.mod && (h - a > c.mod / 2 ? a += c.mod : a - h > c.mod / 2 && (a -= c.mod)), l[o] = i((h - a) * e + a, n)))
                }), this[n](l)
            }, blend: function (e) {
                if (1 === this._rgba[3]) return this;
                var i = this._rgba.slice(), s = i.pop(), n = h(e)._rgba;
                return h(t.map(i, function (t, e) {
                    return (1 - s) * n[e] + s * t
                }))
            }, toRgbaString: function () {
                var e = "rgba(", i = t.map(this._rgba, function (t, e) {
                    return null == t ? e > 2 ? 1 : 0 : t
                });
                return 1 === i[3] && (i.pop(), e = "rgb("), e + i.join() + ")"
            }, toHslaString: function () {
                var e = "hsla(", i = t.map(this.hsla(), function (t, e) {
                    return null == t && (t = e > 2 ? 1 : 0), e && 3 > e && (t = Math.round(100 * t) + "%"), t
                });
                return 1 === i[3] && (i.pop(), e = "hsl("), e + i.join() + ")"
            }, toHexString: function (e) {
                var i = this._rgba.slice(), s = i.pop();
                return e && i.push(~~(255 * s)), "#" + t.map(i, function (t) {
                    return t = (t || 0).toString(16), 1 === t.length ? "0" + t : t
                }).join("")
            }, toString: function () {
                return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
            }
        }), h.fn.parse.prototype = h.fn, c.hsla.to = function (t) {
            if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
            var e, i, s = t[0] / 255, n = t[1] / 255, o = t[2] / 255, a = t[3], r = Math.max(s, n, o),
                l = Math.min(s, n, o), h = r - l, c = r + l, u = .5 * c;
            return e = l === r ? 0 : s === r ? 60 * (n - o) / h + 360 : n === r ? 60 * (o - s) / h + 120 : 60 * (s - n) / h + 240, i = 0 === h ? 0 : .5 >= u ? h / c : h / (2 - c), [Math.round(e) % 360, i, u, null == a ? 1 : a]
        }, c.hsla.from = function (t) {
            if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
            var e = t[0] / 360, i = t[1], s = t[2], o = t[3], a = .5 >= s ? s * (1 + i) : s + i - s * i, r = 2 * s - a;
            return [Math.round(255 * n(r, a, e + 1 / 3)), Math.round(255 * n(r, a, e)), Math.round(255 * n(r, a, e - 1 / 3)), o]
        }, f(c, function (s, n) {
            var o = n.props, a = n.cache, l = n.to, c = n.from;
            h.fn[s] = function (s) {
                if (l && !this[a] && (this[a] = l(this._rgba)), s === e) return this[a].slice();
                var n, r = t.type(s), u = "array" === r || "object" === r ? s : arguments, d = this[a].slice();
                return f(o, function (t, e) {
                    var s = u["object" === r ? t : e.idx];
                    null == s && (s = d[e.idx]), d[e.idx] = i(s, e)
                }), c ? (n = h(c(d)), n[a] = d, n) : h(d)
            }, f(o, function (e, i) {
                h.fn[e] || (h.fn[e] = function (n) {
                    var o, a = t.type(n), l = "alpha" === e ? this._hsla ? "hsla" : "rgba" : s, h = this[l](),
                        c = h[i.idx];
                    return "undefined" === a ? c : ("function" === a && (n = n.call(this, c), a = t.type(n)), null == n && i.empty ? this : ("string" === a && (o = r.exec(n), o && (n = c + parseFloat(o[2]) * ("+" === o[1] ? 1 : -1))), h[i.idx] = n, this[l](h)))
                })
            })
        }), h.hook = function (e) {
            var i = e.split(" ");
            f(i, function (e, i) {
                t.cssHooks[i] = {
                    set: function (e, n) {
                        var o, a, r = "";
                        if ("transparent" !== n && ("string" !== t.type(n) || (o = s(n)))) {
                            if (n = h(o || n), !d.rgba && 1 !== n._rgba[3]) {
                                for (a = "backgroundColor" === i ? e.parentNode : e; ("" === r || "transparent" === r) && a && a.style;) try {
                                    r = t.css(a, "backgroundColor"), a = a.parentNode
                                } catch (l) {
                                }
                                n = n.blend(r && "transparent" !== r ? r : "_default")
                            }
                            n = n.toRgbaString()
                        }
                        try {
                            e.style[i] = n
                        } catch (l) {
                        }
                    }
                }, t.fx.step[i] = function (e) {
                    e.colorInit || (e.start = h(e.elem, i), e.end = h(e.end), e.colorInit = !0), t.cssHooks[i].set(e.elem, e.start.transition(e.end, e.pos))
                }
            })
        }, h.hook(a), t.cssHooks.borderColor = {
            expand: function (t) {
                var e = {};
                return f(["Top", "Right", "Bottom", "Left"], function (i, s) {
                    e["border" + s + "Color"] = t
                }), e
            }
        }, o = t.Color.names = {
            aqua: "#00ffff",
            black: "#000000",
            blue: "#0000ff",
            fuchsia: "#ff00ff",
            gray: "#808080",
            green: "#008000",
            lime: "#00ff00",
            maroon: "#800000",
            navy: "#000080",
            olive: "#808000",
            purple: "#800080",
            red: "#ff0000",
            silver: "#c0c0c0",
            teal: "#008080",
            white: "#ffffff",
            yellow: "#ffff00",
            transparent: [null, null, null, 0],
            _default: "#ffffff"
        }
    }(y), function () {
        function e(e) {
            var i, s,
                n = e.ownerDocument.defaultView ? e.ownerDocument.defaultView.getComputedStyle(e, null) : e.currentStyle,
                o = {};
            if (n && n.length && n[0] && n[n[0]]) for (s = n.length; s--;) i = n[s], "string" == typeof n[i] && (o[t.camelCase(i)] = n[i]); else for (i in n) "string" == typeof n[i] && (o[i] = n[i]);
            return o
        }

        function i(e, i) {
            var s, o, a = {};
            for (s in i) o = i[s], e[s] !== o && (n[s] || (t.fx.step[s] || !isNaN(parseFloat(o))) && (a[s] = o));
            return a
        }

        var s = ["add", "remove", "toggle"], n = {
            border: 1,
            borderBottom: 1,
            borderColor: 1,
            borderLeft: 1,
            borderRight: 1,
            borderTop: 1,
            borderWidth: 1,
            margin: 1,
            padding: 1
        };
        t.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function (e, i) {
            t.fx.step[i] = function (t) {
                ("none" !== t.end && !t.setAttr || 1 === t.pos && !t.setAttr) && (y.style(t.elem, i, t.end), t.setAttr = !0)
            }
        }), t.fn.addBack || (t.fn.addBack = function (t) {
            return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
        }), t.effects.animateClass = function (n, o, a, r) {
            var l = t.speed(o, a, r);
            return this.queue(function () {
                var o, a = t(this), r = a.attr("class") || "", h = l.children ? a.find("*").addBack() : a;
                h = h.map(function () {
                    var i = t(this);
                    return {el: i, start: e(this)}
                }), o = function () {
                    t.each(s, function (t, e) {
                        n[e] && a[e + "Class"](n[e])
                    })
                }, o(), h = h.map(function () {
                    return this.end = e(this.el[0]), this.diff = i(this.start, this.end), this
                }), a.attr("class", r), h = h.map(function () {
                    var e = this, i = t.Deferred(), s = t.extend({}, l, {
                        queue: !1, complete: function () {
                            i.resolve(e)
                        }
                    });
                    return this.el.animate(this.diff, s), i.promise()
                }), t.when.apply(t, h.get()).done(function () {
                    o(), t.each(arguments, function () {
                        var e = this.el;
                        t.each(this.diff, function (t) {
                            e.css(t, "")
                        })
                    }), l.complete.call(a[0])
                })
            })
        }, t.fn.extend({
            addClass: function (e) {
                return function (i, s, n, o) {
                    return s ? t.effects.animateClass.call(this, {add: i}, s, n, o) : e.apply(this, arguments)
                }
            }(t.fn.addClass), removeClass: function (e) {
                return function (i, s, n, o) {
                    return arguments.length > 1 ? t.effects.animateClass.call(this, {remove: i}, s, n, o) : e.apply(this, arguments)
                }
            }(t.fn.removeClass), toggleClass: function (e) {
                return function (i, s, n, o, a) {
                    return "boolean" == typeof s || void 0 === s ? n ? t.effects.animateClass.call(this, s ? {add: i} : {remove: i}, n, o, a) : e.apply(this, arguments) : t.effects.animateClass.call(this, {toggle: i}, s, n, o)
                }
            }(t.fn.toggleClass), switchClass: function (e, i, s, n, o) {
                return t.effects.animateClass.call(this, {add: i, remove: e}, s, n, o)
            }
        })
    }(), function () {
        function e(e, i, s, n) {
            return t.isPlainObject(e) && (i = e, e = e.effect), e = {effect: e}, null == i && (i = {}), t.isFunction(i) && (n = i, s = null, i = {}), ("number" == typeof i || t.fx.speeds[i]) && (n = s, s = i, i = {}), t.isFunction(s) && (n = s, s = null), i && t.extend(e, i), s = s || i.duration, e.duration = t.fx.off ? 0 : "number" == typeof s ? s : s in t.fx.speeds ? t.fx.speeds[s] : t.fx.speeds._default, e.complete = n || i.complete, e
        }

        function i(e) {
            return !e || "number" == typeof e || t.fx.speeds[e] ? !0 : "string" != typeof e || t.effects.effect[e] ? t.isFunction(e) ? !0 : "object" != typeof e || e.effect ? !1 : !0 : !0
        }

        t.extend(t.effects, {
            version: "1.11.1", save: function (t, e) {
                for (var i = 0; i < e.length; i++) null !== e[i] && t.data(b + e[i], t[0].style[e[i]])
            }, restore: function (t, e) {
                var i, s;
                for (s = 0; s < e.length; s++) null !== e[s] && (i = t.data(b + e[s]), void 0 === i && (i = ""), t.css(e[s], i))
            }, setMode: function (t, e) {
                return "toggle" === e && (e = t.is(":hidden") ? "show" : "hide"), e
            }, getBaseline: function (t, e) {
                var i, s;
                switch (t[0]) {
                    case"top":
                        i = 0;
                        break;
                    case"middle":
                        i = .5;
                        break;
                    case"bottom":
                        i = 1;
                        break;
                    default:
                        i = t[0] / e.height
                }
                switch (t[1]) {
                    case"left":
                        s = 0;
                        break;
                    case"center":
                        s = .5;
                        break;
                    case"right":
                        s = 1;
                        break;
                    default:
                        s = t[1] / e.width
                }
                return {x: s, y: i}
            }, createWrapper: function (e) {
                if (e.parent().is(".ui-effects-wrapper")) return e.parent();
                var i = {width: e.outerWidth(!0), height: e.outerHeight(!0), "float": e.css("float")},
                    s = t("<div></div>").addClass("ui-effects-wrapper").css({
                        fontSize: "100%",
                        background: "transparent",
                        border: "none",
                        margin: 0,
                        padding: 0
                    }), n = {width: e.width(), height: e.height()}, o = document.activeElement;
                try {
                    o.id
                } catch (a) {
                    o = document.body
                }
                return e.wrap(s), (e[0] === o || t.contains(e[0], o)) && t(o).focus(), s = e.parent(), "static" === e.css("position") ? (s.css({position: "relative"}), e.css({position: "relative"})) : (t.extend(i, {
                    position: e.css("position"),
                    zIndex: e.css("z-index")
                }), t.each(["top", "left", "bottom", "right"], function (t, s) {
                    i[s] = e.css(s), isNaN(parseInt(i[s], 10)) && (i[s] = "auto")
                }), e.css({
                    position: "relative",
                    top: 0,
                    left: 0,
                    right: "auto",
                    bottom: "auto"
                })), e.css(n), s.css(i).show()
            }, removeWrapper: function (e) {
                var i = document.activeElement;
                return e.parent().is(".ui-effects-wrapper") && (e.parent().replaceWith(e), (e[0] === i || t.contains(e[0], i)) && t(i).focus()), e
            }, setTransition: function (e, i, s, n) {
                return n = n || {}, t.each(i, function (t, i) {
                    var o = e.cssUnit(i);
                    o[0] > 0 && (n[i] = o[0] * s + o[1])
                }), n
            }
        }), t.fn.extend({
            effect: function () {
                function i(e) {
                    function i() {
                        t.isFunction(o) && o.call(n[0]), t.isFunction(e) && e()
                    }

                    var n = t(this), o = s.complete, r = s.mode;
                    (n.is(":hidden") ? "hide" === r : "show" === r) ? (n[r](), i()) : a.call(n[0], s, i)
                }

                var s = e.apply(this, arguments), n = s.mode, o = s.queue, a = t.effects.effect[s.effect];
                return t.fx.off || !a ? n ? this[n](s.duration, s.complete) : this.each(function () {
                    s.complete && s.complete.call(this)
                }) : o === !1 ? this.each(i) : this.queue(o || "fx", i)
            }, show: function (t) {
                return function (s) {
                    if (i(s)) return t.apply(this, arguments);
                    var n = e.apply(this, arguments);
                    return n.mode = "show", this.effect.call(this, n)
                }
            }(t.fn.show), hide: function (t) {
                return function (s) {
                    if (i(s)) return t.apply(this, arguments);
                    var n = e.apply(this, arguments);
                    return n.mode = "hide", this.effect.call(this, n)
                }
            }(t.fn.hide), toggle: function (t) {
                return function (s) {
                    if (i(s) || "boolean" == typeof s) return t.apply(this, arguments);
                    var n = e.apply(this, arguments);
                    return n.mode = "toggle", this.effect.call(this, n)
                }
            }(t.fn.toggle), cssUnit: function (e) {
                var i = this.css(e), s = [];
                return t.each(["em", "px", "%", "pt"], function (t, e) {
                    i.indexOf(e) > 0 && (s = [parseFloat(i), e])
                }), s
            }
        })
    }(), function () {
        var e = {};
        t.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function (t, i) {
            e[i] = function (e) {
                return Math.pow(e, t + 2)
            }
        }), t.extend(e, {
            Sine: function (t) {
                return 1 - Math.cos(t * Math.PI / 2)
            }, Circ: function (t) {
                return 1 - Math.sqrt(1 - t * t)
            }, Elastic: function (t) {
                return 0 === t || 1 === t ? t : -Math.pow(2, 8 * (t - 1)) * Math.sin((80 * (t - 1) - 7.5) * Math.PI / 15)
            }, Back: function (t) {
                return t * t * (3 * t - 2)
            }, Bounce: function (t) {
                for (var e, i = 4; t < ((e = Math.pow(2, --i)) - 1) / 11;) ;
                return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * e - 2) / 22 - t, 2)
            }
        }), t.each(e, function (e, i) {
            t.easing["easeIn" + e] = i, t.easing["easeOut" + e] = function (t) {
                return 1 - i(1 - t)
            }, t.easing["easeInOut" + e] = function (t) {
                return .5 > t ? i(2 * t) / 2 : 1 - i(-2 * t + 2) / 2
            }
        })
    }(), t.effects, t.effects.effect.blind = function (e, i) {
        var s, n, o, a = t(this), r = /up|down|vertical/, l = /up|left|vertical|horizontal/,
            h = ["position", "top", "bottom", "left", "right", "height", "width"],
            c = t.effects.setMode(a, e.mode || "hide"), u = e.direction || "up", d = r.test(u),
            p = d ? "height" : "width", f = d ? "top" : "left", m = l.test(u), g = {}, v = "show" === c;
        a.parent().is(".ui-effects-wrapper") ? t.effects.save(a.parent(), h) : t.effects.save(a, h), a.show(), s = t.effects.createWrapper(a).css({overflow: "hidden"}), n = s[p](), o = parseFloat(s.css(f)) || 0, g[p] = v ? n : 0, m || (a.css(d ? "bottom" : "right", 0).css(d ? "top" : "left", "auto").css({position: "absolute"}), g[f] = v ? o : n + o), v && (s.css(p, 0), m || s.css(f, o + n)), s.animate(g, {
            duration: e.duration,
            easing: e.easing,
            queue: !1,
            complete: function () {
                "hide" === c && a.hide(), t.effects.restore(a, h), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.bounce = function (e, i) {
        var s, n, o, a = t(this), r = ["position", "top", "bottom", "left", "right", "height", "width"],
            l = t.effects.setMode(a, e.mode || "effect"), h = "hide" === l, c = "show" === l, u = e.direction || "up",
            d = e.distance, p = e.times || 5, f = 2 * p + (c || h ? 1 : 0), m = e.duration / f, g = e.easing,
            v = "up" === u || "down" === u ? "top" : "left", b = "up" === u || "left" === u, y = a.queue(),
            _ = y.length;
        for ((c || h) && r.push("opacity"), t.effects.save(a, r), a.show(), t.effects.createWrapper(a), d || (d = a["top" === v ? "outerHeight" : "outerWidth"]() / 3), c && (o = {opacity: 1}, o[v] = 0, a.css("opacity", 0).css(v, b ? 2 * -d : 2 * d).animate(o, m, g)), h && (d /= Math.pow(2, p - 1)), o = {}, o[v] = 0, s = 0; p > s; s++) n = {}, n[v] = (b ? "-=" : "+=") + d, a.animate(n, m, g).animate(o, m, g), d = h ? 2 * d : d / 2;
        h && (n = {opacity: 0}, n[v] = (b ? "-=" : "+=") + d, a.animate(n, m, g)), a.queue(function () {
            h && a.hide(), t.effects.restore(a, r), t.effects.removeWrapper(a), i()
        }), _ > 1 && y.splice.apply(y, [1, 0].concat(y.splice(_, f + 1))), a.dequeue()
    }, t.effects.effect.clip = function (e, i) {
        var s, n, o, a = t(this), r = ["position", "top", "bottom", "left", "right", "height", "width"],
            l = t.effects.setMode(a, e.mode || "hide"), h = "show" === l, c = e.direction || "vertical",
            u = "vertical" === c, d = u ? "height" : "width", p = u ? "top" : "left", f = {};
        t.effects.save(a, r), a.show(), s = t.effects.createWrapper(a).css({overflow: "hidden"}), n = "IMG" === a[0].tagName ? s : a, o = n[d](), h && (n.css(d, 0), n.css(p, o / 2)), f[d] = h ? o : 0, f[p] = h ? 0 : o / 2, n.animate(f, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function () {
                h || a.hide(), t.effects.restore(a, r), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.drop = function (e, i) {
        var s, n = t(this), o = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
            a = t.effects.setMode(n, e.mode || "hide"), r = "show" === a, l = e.direction || "left",
            h = "up" === l || "down" === l ? "top" : "left", c = "up" === l || "left" === l ? "pos" : "neg",
            u = {opacity: r ? 1 : 0};
        t.effects.save(n, o), n.show(), t.effects.createWrapper(n), s = e.distance || n["top" === h ? "outerHeight" : "outerWidth"](!0) / 2, r && n.css("opacity", 0).css(h, "pos" === c ? -s : s), u[h] = (r ? "pos" === c ? "+=" : "-=" : "pos" === c ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function () {
                "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
            }
        })
    }, t.effects.effect.explode = function (e, i) {
        function s() {
            y.push(this), y.length === u * d && n()
        }

        function n() {
            p.css({visibility: "visible"}), t(y).remove(), m || p.hide(), i()
        }

        var o, a, r, l, h, c, u = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3, d = u, p = t(this),
            f = t.effects.setMode(p, e.mode || "hide"), m = "show" === f,
            g = p.show().css("visibility", "hidden").offset(), v = Math.ceil(p.outerWidth() / d),
            b = Math.ceil(p.outerHeight() / u), y = [];
        for (o = 0; u > o; o++) for (l = g.top + o * b, c = o - (u - 1) / 2, a = 0; d > a; a++) r = g.left + a * v, h = a - (d - 1) / 2, p.clone().appendTo("body").wrap("<div></div>").css({
            position: "absolute",
            visibility: "visible",
            left: -a * v,
            top: -o * b
        }).parent().addClass("ui-effects-explode").css({
            position: "absolute",
            overflow: "hidden",
            width: v,
            height: b,
            left: r + (m ? h * v : 0),
            top: l + (m ? c * b : 0),
            opacity: m ? 0 : 1
        }).animate({
            left: r + (m ? 0 : h * v),
            top: l + (m ? 0 : c * b),
            opacity: m ? 1 : 0
        }, e.duration || 500, e.easing, s)
    }, t.effects.effect.fade = function (e, i) {
        var s = t(this), n = t.effects.setMode(s, e.mode || "toggle");
        s.animate({opacity: n}, {queue: !1, duration: e.duration, easing: e.easing, complete: i})
    }, t.effects.effect.fold = function (e, i) {
        var s, n, o = t(this), a = ["position", "top", "bottom", "left", "right", "height", "width"],
            r = t.effects.setMode(o, e.mode || "hide"), l = "show" === r, h = "hide" === r, c = e.size || 15,
            u = /([0-9]+)%/.exec(c), d = !!e.horizFirst, p = l !== d, f = p ? ["width", "height"] : ["height", "width"],
            m = e.duration / 2, g = {}, v = {};
        t.effects.save(o, a), o.show(), s = t.effects.createWrapper(o).css({overflow: "hidden"}), n = p ? [s.width(), s.height()] : [s.height(), s.width()], u && (c = parseInt(u[1], 10) / 100 * n[h ? 0 : 1]), l && s.css(d ? {
            height: 0,
            width: c
        } : {
            height: c,
            width: 0
        }), g[f[0]] = l ? n[0] : c, v[f[1]] = l ? n[1] : 0, s.animate(g, m, e.easing).animate(v, m, e.easing, function () {
            h && o.hide(), t.effects.restore(o, a), t.effects.removeWrapper(o), i()
        })
    }, t.effects.effect.highlight = function (e, i) {
        var s = t(this), n = ["backgroundImage", "backgroundColor", "opacity"],
            o = t.effects.setMode(s, e.mode || "show"), a = {backgroundColor: s.css("backgroundColor")};
        "hide" === o && (a.opacity = 0), t.effects.save(s, n), s.show().css({
            backgroundImage: "none",
            backgroundColor: e.color || "#ffff99"
        }).animate(a, {
            queue: !1, duration: e.duration, easing: e.easing, complete: function () {
                "hide" === o && s.hide(), t.effects.restore(s, n), i()
            }
        })
    }, t.effects.effect.size = function (e, i) {
        var s, n, o, a = t(this),
            r = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
            l = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
            h = ["width", "height", "overflow"], c = ["fontSize"],
            u = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
            d = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
            p = t.effects.setMode(a, e.mode || "effect"), f = e.restore || "effect" !== p, m = e.scale || "both",
            g = e.origin || ["middle", "center"], v = a.css("position"), b = f ? r : l,
            y = {height: 0, width: 0, outerHeight: 0, outerWidth: 0};
        "show" === p && a.show(), s = {
            height: a.height(),
            width: a.width(),
            outerHeight: a.outerHeight(),
            outerWidth: a.outerWidth()
        }, "toggle" === e.mode && "show" === p ? (a.from = e.to || y, a.to = e.from || s) : (a.from = e.from || ("show" === p ? y : s), a.to = e.to || ("hide" === p ? y : s)), o = {
            from: {
                y: a.from.height / s.height,
                x: a.from.width / s.width
            }, to: {y: a.to.height / s.height, x: a.to.width / s.width}
        }, ("box" === m || "both" === m) && (o.from.y !== o.to.y && (b = b.concat(u), a.from = t.effects.setTransition(a, u, o.from.y, a.from), a.to = t.effects.setTransition(a, u, o.to.y, a.to)), o.from.x !== o.to.x && (b = b.concat(d), a.from = t.effects.setTransition(a, d, o.from.x, a.from), a.to = t.effects.setTransition(a, d, o.to.x, a.to))), ("content" === m || "both" === m) && o.from.y !== o.to.y && (b = b.concat(c).concat(h), a.from = t.effects.setTransition(a, c, o.from.y, a.from), a.to = t.effects.setTransition(a, c, o.to.y, a.to)), t.effects.save(a, b), a.show(), t.effects.createWrapper(a), a.css("overflow", "hidden").css(a.from), g && (n = t.effects.getBaseline(g, s), a.from.top = (s.outerHeight - a.outerHeight()) * n.y, a.from.left = (s.outerWidth - a.outerWidth()) * n.x, a.to.top = (s.outerHeight - a.to.outerHeight) * n.y, a.to.left = (s.outerWidth - a.to.outerWidth) * n.x), a.css(a.from), ("content" === m || "both" === m) && (u = u.concat(["marginTop", "marginBottom"]).concat(c), d = d.concat(["marginLeft", "marginRight"]), h = r.concat(u).concat(d), a.find("*[width]").each(function () {
            var i = t(this),
                s = {height: i.height(), width: i.width(), outerHeight: i.outerHeight(), outerWidth: i.outerWidth()};
            f && t.effects.save(i, h), i.from = {
                height: s.height * o.from.y,
                width: s.width * o.from.x,
                outerHeight: s.outerHeight * o.from.y,
                outerWidth: s.outerWidth * o.from.x
            }, i.to = {
                height: s.height * o.to.y,
                width: s.width * o.to.x,
                outerHeight: s.height * o.to.y,
                outerWidth: s.width * o.to.x
            }, o.from.y !== o.to.y && (i.from = t.effects.setTransition(i, u, o.from.y, i.from), i.to = t.effects.setTransition(i, u, o.to.y, i.to)), o.from.x !== o.to.x && (i.from = t.effects.setTransition(i, d, o.from.x, i.from), i.to = t.effects.setTransition(i, d, o.to.x, i.to)), i.css(i.from), i.animate(i.to, e.duration, e.easing, function () {
                f && t.effects.restore(i, h)
            })
        })), a.animate(a.to, {
            queue: !1, duration: e.duration, easing: e.easing, complete: function () {
                0 === a.to.opacity && a.css("opacity", a.from.opacity), "hide" === p && a.hide(), t.effects.restore(a, b), f || ("static" === v ? a.css({
                    position: "relative",
                    top: a.to.top,
                    left: a.to.left
                }) : t.each(["top", "left"], function (t, e) {
                    a.css(e, function (e, i) {
                        var s = parseInt(i, 10), n = t ? a.to.left : a.to.top;
                        return "auto" === i ? n + "px" : s + n + "px"
                    })
                })), t.effects.removeWrapper(a), i()
            }
        })
    }, t.effects.effect.scale = function (e, i) {
        var s = t(this), n = t.extend(!0, {}, e), o = t.effects.setMode(s, e.mode || "effect"),
            a = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0 : "hide" === o ? 0 : 100),
            r = e.direction || "both", l = e.origin,
            h = {height: s.height(), width: s.width(), outerHeight: s.outerHeight(), outerWidth: s.outerWidth()},
            c = {y: "horizontal" !== r ? a / 100 : 1, x: "vertical" !== r ? a / 100 : 1};
        n.effect = "size", n.queue = !1, n.complete = i, "effect" !== o && (n.origin = l || ["middle", "center"], n.restore = !0), n.from = e.from || ("show" === o ? {
            height: 0,
            width: 0,
            outerHeight: 0,
            outerWidth: 0
        } : h), n.to = {
            height: h.height * c.y,
            width: h.width * c.x,
            outerHeight: h.outerHeight * c.y,
            outerWidth: h.outerWidth * c.x
        }, n.fade && ("show" === o && (n.from.opacity = 0, n.to.opacity = 1), "hide" === o && (n.from.opacity = 1, n.to.opacity = 0)), s.effect(n)
    }, t.effects.effect.puff = function (e, i) {
        var s = t(this), n = t.effects.setMode(s, e.mode || "hide"), o = "hide" === n,
            a = parseInt(e.percent, 10) || 150, r = a / 100,
            l = {height: s.height(), width: s.width(), outerHeight: s.outerHeight(), outerWidth: s.outerWidth()};
        t.extend(e, {
            effect: "scale",
            queue: !1,
            fade: !0,
            mode: n,
            complete: i,
            percent: o ? a : 100,
            from: o ? l : {
                height: l.height * r,
                width: l.width * r,
                outerHeight: l.outerHeight * r,
                outerWidth: l.outerWidth * r
            }
        }), s.effect(e)
    }, t.effects.effect.pulsate = function (e, i) {
        var s, n = t(this), o = t.effects.setMode(n, e.mode || "show"), a = "show" === o, r = "hide" === o,
            l = a || "hide" === o, h = 2 * (e.times || 5) + (l ? 1 : 0), c = e.duration / h, u = 0, d = n.queue(),
            p = d.length;
        for ((a || !n.is(":visible")) && (n.css("opacity", 0).show(), u = 1), s = 1; h > s; s++) n.animate({opacity: u}, c, e.easing), u = 1 - u;
        n.animate({opacity: u}, c, e.easing), n.queue(function () {
            r && n.hide(), i()
        }), p > 1 && d.splice.apply(d, [1, 0].concat(d.splice(p, h + 1))), n.dequeue()
    }, t.effects.effect.shake = function (e, i) {
        var s, n = t(this), o = ["position", "top", "bottom", "left", "right", "height", "width"],
            a = t.effects.setMode(n, e.mode || "effect"), r = e.direction || "left", l = e.distance || 20,
            h = e.times || 3, c = 2 * h + 1, u = Math.round(e.duration / c),
            d = "up" === r || "down" === r ? "top" : "left", p = "up" === r || "left" === r, f = {}, m = {}, g = {},
            v = n.queue(), b = v.length;
        for (t.effects.save(n, o), n.show(), t.effects.createWrapper(n), f[d] = (p ? "-=" : "+=") + l, m[d] = (p ? "+=" : "-=") + 2 * l, g[d] = (p ? "-=" : "+=") + 2 * l, n.animate(f, u, e.easing), s = 1; h > s; s++) n.animate(m, u, e.easing).animate(g, u, e.easing);
        n.animate(m, u, e.easing).animate(f, u / 2, e.easing).queue(function () {
            "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
        }), b > 1 && v.splice.apply(v, [1, 0].concat(v.splice(b, c + 1))), n.dequeue()
    }, t.effects.effect.slide = function (e, i) {
        var s, n = t(this), o = ["position", "top", "bottom", "left", "right", "width", "height"],
            a = t.effects.setMode(n, e.mode || "show"), r = "show" === a, l = e.direction || "left",
            h = "up" === l || "down" === l ? "top" : "left", c = "up" === l || "left" === l, u = {};
        t.effects.save(n, o), n.show(), s = e.distance || n["top" === h ? "outerHeight" : "outerWidth"](!0), t.effects.createWrapper(n).css({overflow: "hidden"}), r && n.css(h, c ? isNaN(s) ? "-" + s : -s : s), u[h] = (r ? c ? "+=" : "-=" : c ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: e.duration,
            easing: e.easing,
            complete: function () {
                "hide" === a && n.hide(), t.effects.restore(n, o), t.effects.removeWrapper(n), i()
            }
        })
    }, t.effects.effect.transfer = function (e, i) {
        var s = t(this), n = t(e.to), o = "fixed" === n.css("position"), a = t("body"), r = o ? a.scrollTop() : 0,
            l = o ? a.scrollLeft() : 0, h = n.offset(),
            c = {top: h.top - r, left: h.left - l, height: n.innerHeight(), width: n.innerWidth()}, u = s.offset(),
            d = t("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(e.className).css({
                top: u.top - r,
                left: u.left - l,
                height: s.innerHeight(),
                width: s.innerWidth(),
                position: o ? "fixed" : "absolute"
            }).animate(c, e.duration, e.easing, function () {
                d.remove(), i()
            })
    }, t.widget("ui.progressbar", {
        version: "1.11.1", options: {max: 100, value: 0, change: null, complete: null}, min: 0, _create: function () {
            this.oldValue = this.options.value = this._constrainedValue(), this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                role: "progressbar",
                "aria-valuemin": this.min
            }), this.valueDiv = t("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element), this._refreshValue()
        }, _destroy: function () {
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.valueDiv.remove()
        }, value: function (t) {
            return void 0 === t ? this.options.value : (this.options.value = this._constrainedValue(t), void this._refreshValue())
        }, _constrainedValue: function (t) {
            return void 0 === t && (t = this.options.value), this.indeterminate = t === !1, "number" != typeof t && (t = 0), this.indeterminate ? !1 : Math.min(this.options.max, Math.max(this.min, t))
        }, _setOptions: function (t) {
            var e = t.value;
            delete t.value, this._super(t), this.options.value = this._constrainedValue(e), this._refreshValue()
        }, _setOption: function (t, e) {
            "max" === t && (e = Math.max(this.min, e)), "disabled" === t && this.element.toggleClass("ui-state-disabled", !!e).attr("aria-disabled", e), this._super(t, e)
        }, _percentage: function () {
            return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
        }, _refreshValue: function () {
            var e = this.options.value, i = this._percentage();
            this.valueDiv.toggle(this.indeterminate || e > this.min).toggleClass("ui-corner-right", e === this.options.max).width(i.toFixed(0) + "%"), this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = t("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
                "aria-valuemax": this.options.max,
                "aria-valuenow": e
            }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== e && (this.oldValue = e, this._trigger("change")), e === this.options.max && this._trigger("complete")
        }
    }), t.widget("ui.selectable", t.ui.mouse, {
        version: "1.11.1",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function () {
            var e, i = this;
            this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function () {
                e = t(i.options.filter, i.element[0]), e.addClass("ui-selectee"), e.each(function () {
                    var e = t(this), i = e.offset();
                    t.data(this, "selectable-item", {
                        element: this,
                        $element: e,
                        left: i.left,
                        top: i.top,
                        right: i.left + e.outerWidth(),
                        bottom: i.top + e.outerHeight(),
                        startselected: !1,
                        selected: e.hasClass("ui-selected"),
                        selecting: e.hasClass("ui-selecting"),
                        unselecting: e.hasClass("ui-unselecting")
                    })
                })
            }, this.refresh(), this.selectees = e.addClass("ui-selectee"), this._mouseInit(), this.helper = t("<div class='ui-selectable-helper'></div>")
        },
        _destroy: function () {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy()
        },
        _mouseStart: function (e) {
            var i = this, s = this.options;
            this.opos = [e.pageX, e.pageY], this.options.disabled || (this.selectees = t(s.filter, this.element[0]), this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
                left: e.pageX,
                top: e.pageY,
                width: 0,
                height: 0
            }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function () {
                var s = t.data(this, "selectable-item");
                s.startselected = !0, e.metaKey || e.ctrlKey || (s.$element.removeClass("ui-selected"), s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {unselecting: s.element}))
            }), t(e.target).parents().addBack().each(function () {
                var s, n = t.data(this, "selectable-item");
                return n ? (s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), n.$element.removeClass(s ? "ui-unselecting" : "ui-selected").addClass(s ? "ui-selecting" : "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {selecting: n.element}) : i._trigger("unselecting", e, {unselecting: n.element}), !1) : void 0
            }))
        },
        _mouseDrag: function (e) {
            if (this.dragged = !0, !this.options.disabled) {
                var i, s = this, n = this.options, o = this.opos[0], a = this.opos[1], r = e.pageX, l = e.pageY;
                return o > r && (i = r, r = o, o = i), a > l && (i = l, l = a, a = i), this.helper.css({
                    left: o,
                    top: a,
                    width: r - o,
                    height: l - a
                }), this.selectees.each(function () {
                    var i = t.data(this, "selectable-item"), h = !1;
                    i && i.element !== s.element[0] && ("touch" === n.tolerance ? h = !(i.left > r || i.right < o || i.top > l || i.bottom < a) : "fit" === n.tolerance && (h = i.left > o && i.right < r && i.top > a && i.bottom < l), h ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, s._trigger("selecting", e, {selecting: i.element}))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", e, {unselecting: i.element}))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {unselecting: i.element})))))
                }), !1
            }
        },
        _mouseStop: function (e) {
            var i = this;
            return this.dragged = !1, t(".ui-unselecting", this.element[0]).each(function () {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-unselecting"), s.unselecting = !1, s.startselected = !1, i._trigger("unselected", e, {unselected: s.element})
            }), t(".ui-selecting", this.element[0]).each(function () {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-selecting").addClass("ui-selected"), s.selecting = !1, s.selected = !0, s.startselected = !0, i._trigger("selected", e, {selected: s.element})
            }), this._trigger("stop", e), this.helper.remove(), !1
        }
    }), t.widget("ui.selectmenu", {
        version: "1.11.1",
        defaultElement: "<select>",
        options: {
            appendTo: null,
            disabled: null,
            icons: {button: "ui-icon-triangle-1-s"},
            position: {my: "left top", at: "left bottom", collision: "none"},
            width: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            select: null
        },
        _create: function () {
            var t = this.element.uniqueId().attr("id");
            this.ids = {
                element: t,
                button: t + "-button",
                menu: t + "-menu"
            }, this._drawButton(), this._drawMenu(), this.options.disabled && this.disable()
        },
        _drawButton: function () {
            var e = this, i = this.element.attr("tabindex");
            this.label = t("label[for='" + this.ids.element + "']").attr("for", this.ids.button), this._on(this.label, {
                click: function (t) {
                    this.button.focus(), t.preventDefault()
                }
            }), this.element.hide(), this.button = t("<span>", {
                "class": "ui-selectmenu-button ui-widget ui-state-default ui-corner-all",
                tabindex: i || this.options.disabled ? -1 : 0,
                id: this.ids.button,
                role: "combobox",
                "aria-expanded": "false",
                "aria-autocomplete": "list",
                "aria-owns": this.ids.menu,
                "aria-haspopup": "true"
            }).insertAfter(this.element), t("<span>", {"class": "ui-icon " + this.options.icons.button}).prependTo(this.button), this.buttonText = t("<span>", {"class": "ui-selectmenu-text"}).appendTo(this.button), this._setText(this.buttonText, this.element.find("option:selected").text()), this._resizeButton(), this._on(this.button, this._buttonEvents), this.button.one("focusin", function () {
                e.menuItems || e._refreshMenu()
            }), this._hoverable(this.button), this._focusable(this.button)
        },
        _drawMenu: function () {
            var e = this;
            this.menu = t("<ul>", {
                "aria-hidden": "true",
                "aria-labelledby": this.ids.button,
                id: this.ids.menu
            }), this.menuWrap = t("<div>", {"class": "ui-selectmenu-menu ui-front"}).append(this.menu).appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
                role: "listbox",
                select: function (t, i) {
                    t.preventDefault(), e._select(i.item.data("ui-selectmenu-item"), t)
                },
                focus: function (t, i) {
                    var s = i.item.data("ui-selectmenu-item");
                    null != e.focusIndex && s.index !== e.focusIndex && (e._trigger("focus", t, {item: s}), e.isOpen || e._select(s, t)), e.focusIndex = s.index, e.button.attr("aria-activedescendant", e.menuItems.eq(s.index).attr("id"))
                }
            }).menu("instance"), this.menu.addClass("ui-corner-bottom").removeClass("ui-corner-all"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function () {
                return !1
            }, this.menuInstance._isDivider = function () {
                return !1
            }
        },
        refresh: function () {
            this._refreshMenu(), this._setText(this.buttonText, this._getSelectedItem().text()), this.options.width || this._resizeButton()
        },
        _refreshMenu: function () {
            this.menu.empty();
            var t, e = this.element.find("option");
            e.length && (this._parseOptions(e), this._renderMenu(this.menu, this.items), this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup"), t = this._getSelectedItem(), this.menuInstance.focus(null, t), this._setAria(t.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")))
        },
        open: function (t) {
            this.options.disabled || (this.menuItems ? (this.menu.find(".ui-state-focus").removeClass("ui-state-focus"), this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.isOpen = !0, this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), this._trigger("open", t))
        },
        _position: function () {
            this.menuWrap.position(t.extend({of: this.button}, this.options.position))
        },
        close: function (t) {
            this.isOpen && (this.isOpen = !1, this._toggleAttr(), this._off(this.document), this._trigger("close", t))
        },
        widget: function () {
            return this.button
        },
        menuWidget: function () {
            return this.menu
        },
        _renderMenu: function (e, i) {
            var s = this, n = "";
            t.each(i, function (i, o) {
                o.optgroup !== n && (t("<li>", {
                    "class": "ui-selectmenu-optgroup ui-menu-divider" + (o.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : ""),
                    text: o.optgroup
                }).appendTo(e), n = o.optgroup), s._renderItemData(e, o)
            })
        },
        _renderItemData: function (t, e) {
            return this._renderItem(t, e).data("ui-selectmenu-item", e)
        },
        _renderItem: function (e, i) {
            var s = t("<li>");
            return i.disabled && s.addClass("ui-state-disabled"), this._setText(s, i.label), s.appendTo(e)
        },
        _setText: function (t, e) {
            e ? t.text(e) : t.html("&#160;")
        },
        _move: function (t, e) {
            var i, s, n = ".ui-menu-item";
            this.isOpen ? i = this.menuItems.eq(this.focusIndex) : (i = this.menuItems.eq(this.element[0].selectedIndex), n += ":not(.ui-state-disabled)"), s = "first" === t || "last" === t ? i["first" === t ? "prevAll" : "nextAll"](n).eq(-1) : i[t + "All"](n).eq(0), s.length && this.menuInstance.focus(e, s)
        },
        _getSelectedItem: function () {
            return this.menuItems.eq(this.element[0].selectedIndex)
        },
        _toggle: function (t) {
            this[this.isOpen ? "close" : "open"](t)
        },
        _documentClick: {
            mousedown: function (e) {
                this.isOpen && (t(e.target).closest(".ui-selectmenu-menu, #" + this.ids.button).length || this.close(e))
            }
        },
        _buttonEvents: {
            mousedown: function (t) {
                t.preventDefault()
            }, click: "_toggle", keydown: function (e) {
                var i = !0;
                switch (e.keyCode) {
                    case t.ui.keyCode.TAB:
                    case t.ui.keyCode.ESCAPE:
                        this.close(e), i = !1;
                        break;
                    case t.ui.keyCode.ENTER:
                        this.isOpen && this._selectFocusedItem(e);
                        break;
                    case t.ui.keyCode.UP:
                        e.altKey ? this._toggle(e) : this._move("prev", e);
                        break;
                    case t.ui.keyCode.DOWN:
                        e.altKey ? this._toggle(e) : this._move("next", e);
                        break;
                    case t.ui.keyCode.SPACE:
                        this.isOpen ? this._selectFocusedItem(e) : this._toggle(e);
                        break;
                    case t.ui.keyCode.LEFT:
                        this._move("prev", e);
                        break;
                    case t.ui.keyCode.RIGHT:
                        this._move("next", e);
                        break;
                    case t.ui.keyCode.HOME:
                    case t.ui.keyCode.PAGE_UP:
                        this._move("first", e);
                        break;
                    case t.ui.keyCode.END:
                    case t.ui.keyCode.PAGE_DOWN:
                        this._move("last", e);
                        break;
                    default:
                        this.menu.trigger(e), i = !1
                }
                i && e.preventDefault()
            }
        },
        _selectFocusedItem: function (t) {
            var e = this.menuItems.eq(this.focusIndex);
            e.hasClass("ui-state-disabled") || this._select(e.data("ui-selectmenu-item"), t)
        },
        _select: function (t, e) {
            var i = this.element[0].selectedIndex;
            this.element[0].selectedIndex = t.index, this._setText(this.buttonText, t.label), this._setAria(t), this._trigger("select", e, {item: t}), t.index !== i && this._trigger("change", e, {item: t}), this.close(e)
        },
        _setAria: function (t) {
            var e = this.menuItems.eq(t.index).attr("id");
            this.button.attr({
                "aria-labelledby": e,
                "aria-activedescendant": e
            }), this.menu.attr("aria-activedescendant", e)
        },
        _setOption: function (t, e) {
            "icons" === t && this.button.find("span.ui-icon").removeClass(this.options.icons.button).addClass(e.button), this._super(t, e), "appendTo" === t && this.menuWrap.appendTo(this._appendTo()), "disabled" === t && (this.menuInstance.option("disabled", e), this.button.toggleClass("ui-state-disabled", e).attr("aria-disabled", e), this.element.prop("disabled", e), e ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0)), "width" === t && this._resizeButton()
        },
        _appendTo: function () {
            var e = this.options.appendTo;
            return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front")), e.length || (e = this.document[0].body), e
        },
        _toggleAttr: function () {
            this.button.toggleClass("ui-corner-top", this.isOpen).toggleClass("ui-corner-all", !this.isOpen).attr("aria-expanded", this.isOpen), this.menuWrap.toggleClass("ui-selectmenu-open", this.isOpen), this.menu.attr("aria-hidden", !this.isOpen)
        },
        _resizeButton: function () {
            var t = this.options.width;
            t || (t = this.element.show().outerWidth(), this.element.hide()), this.button.outerWidth(t)
        },
        _resizeMenu: function () {
            this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1))
        },
        _getCreateOptions: function () {
            return {disabled: this.element.prop("disabled")}
        },
        _parseOptions: function (e) {
            var i = [];
            e.each(function (e, s) {
                var n = t(s), o = n.parent("optgroup");
                i.push({
                    element: n,
                    index: e,
                    value: n.attr("value"),
                    label: n.text(),
                    optgroup: o.attr("label") || "",
                    disabled: o.prop("disabled") || n.prop("disabled")
                })
            }), this.items = i
        },
        _destroy: function () {
            this.menuWrap.remove(), this.button.remove(), this.element.show(), this.element.removeUniqueId(), this.label.attr("for", this.ids.element)
        }
    }), t.widget("ui.slider", t.ui.mouse, {
        version: "1.11.1",
        widgetEventPrefix: "slide",
        options: {
            animate: !1,
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: !1,
            step: 1,
            value: 0,
            values: null,
            change: null,
            slide: null,
            start: null,
            stop: null
        },
        numPages: 5,
        _create: function () {
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1
        },
        _refresh: function () {
            this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
        },
        _createHandles: function () {
            var e, i, s = this.options,
                n = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                o = "<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>", a = [];
            for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), e = n.length; i > e; e++) a.push(o);
            this.handles = n.add(t(a.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each(function (e) {
                t(this).data("ui-slider-handle-index", e)
            })
        },
        _createRange: function () {
            var e = this.options, i = "";
            e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                left: "",
                bottom: ""
            }) : (this.range = t("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range : ""))) : (this.range && this.range.remove(), this.range = null)
        },
        _setupEvents: function () {
            this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles)
        },
        _destroy: function () {
            this.handles.remove(), this.range && this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy()
        },
        _mouseCapture: function (e) {
            var i, s, n, o, a, r, l, h, c = this, u = this.options;
            return u.disabled ? !1 : (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), i = {
                x: e.pageX,
                y: e.pageY
            }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function (e) {
                var i = Math.abs(s - c.values(e));
                i || (i = 0), (n > i || n === i && (e === c._lastChangedValue || c.values(e) === u.min)) && (n = i, o = t(this), a = e)
            }), u.range === !0 && this.values(1) === u.min && (a += 1, o = t(this.handles[a])), r = this._start(e, a), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = a, o.addClass("ui-state-active").focus(), l = o.offset(), h = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = h ? {
                left: 0,
                top: 0
            } : {
                left: e.pageX - l.left - o.width() / 2,
                top: e.pageY - l.top - o.height() / 2 - (parseInt(o.css("borderTopWidth"), 10) || 0) - (parseInt(o.css("borderBottomWidth"), 10) || 0) + (parseInt(o.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(e, a, s), this._animateOff = !0, !0))
        },
        _mouseStart: function () {
            return !0
        },
        _mouseDrag: function (t) {
            var e = {x: t.pageX, y: t.pageY}, i = this._normValueFromMouse(e);
            return this._slide(t, this._handleIndex, i), !1
        },
        _mouseStop: function (t) {
            return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
        },
        _detectOrientation: function () {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function (t) {
            var e, i, s, n, o;
            return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), s = i / e, s > 1 && (s = 1), 0 > s && (s = 0), "vertical" === this.orientation && (s = 1 - s), n = this._valueMax() - this._valueMin(), o = this._valueMin() + s * n, this._trimAlignValue(o)
        },
        _start: function (t, e) {
            var i = {handle: this.handles[e], value: this.value()};
            return this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("start", t, i)
        },
        _slide: function (t, e, i) {
            var s, n, o;
            this.options.values && this.options.values.length ? (s = this.values(e ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === e && i > s || 1 === e && s > i) && (i = s), i !== this.values(e) && (n = this.values(), n[e] = i, o = this._trigger("slide", t, {
                handle: this.handles[e],
                value: i,
                values: n
            }), s = this.values(e ? 0 : 1), o !== !1 && this.values(e, i))) : i !== this.value() && (o = this._trigger("slide", t, {
                handle: this.handles[e],
                value: i
            }), o !== !1 && this.value(i))
        },
        _stop: function (t, e) {
            var i = {handle: this.handles[e], value: this.value()};
            this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("stop", t, i)
        },
        _change: function (t, e) {
            if (!this._keySliding && !this._mouseSliding) {
                var i = {handle: this.handles[e], value: this.value()};
                this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._lastChangedValue = e, this._trigger("change", t, i)
            }
        },
        value: function (t) {
            return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), void this._change(null, 0)) : this._value()
        },
        values: function (e, i) {
            var s, n, o;
            if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), this._refreshValue(), void this._change(null, e);
            if (!arguments.length) return this._values();
            if (!t.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(e) : this.value();
            for (s = this.options.values, n = arguments[0], o = 0; o < s.length; o += 1) s[o] = this._trimAlignValue(n[o]), this._change(null, o);
            this._refreshValue()
        },
        _setOption: function (e, i) {
            var s, n = 0;
            switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), "disabled" === e && this.element.toggleClass("ui-state-disabled", !!i), this._super(e, i), e) {
                case"orientation":
                    this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue(), this.handles.css("horizontal" === i ? "bottom" : "left", "");
                    break;
                case"value":
                    this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                    break;
                case"values":
                    for (this._animateOff = !0, this._refreshValue(), s = 0; n > s; s += 1) this._change(null, s);
                    this._animateOff = !1;
                    break;
                case"min":
                case"max":
                    this._animateOff = !0, this._refreshValue(), this._animateOff = !1;
                    break;
                case"range":
                    this._animateOff = !0, this._refresh(), this._animateOff = !1
            }
        },
        _value: function () {
            var t = this.options.value;
            return t = this._trimAlignValue(t)
        },
        _values: function (t) {
            var e, i, s;
            if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);
            if (this.options.values && this.options.values.length) {
                for (i = this.options.values.slice(), s = 0; s < i.length; s += 1) i[s] = this._trimAlignValue(i[s]);
                return i
            }
            return []
        },
        _trimAlignValue: function (t) {
            if (t <= this._valueMin()) return this._valueMin();
            if (t >= this._valueMax()) return this._valueMax();
            var e = this.options.step > 0 ? this.options.step : 1, i = (t - this._valueMin()) % e, s = t - i;
            return 2 * Math.abs(i) >= e && (s += i > 0 ? e : -e), parseFloat(s.toFixed(5))
        },
        _valueMin: function () {
            return this.options.min
        },
        _valueMax: function () {
            return this.options.max
        },
        _refreshValue: function () {
            var e, i, s, n, o, a = this.options.range, r = this.options, l = this,
                h = this._animateOff ? !1 : r.animate, c = {};
            this.options.values && this.options.values.length ? this.handles.each(function (s) {
                i = (l.values(s) - l._valueMin()) / (l._valueMax() - l._valueMin()) * 100, c["horizontal" === l.orientation ? "left" : "bottom"] = i + "%", t(this).stop(1, 1)[h ? "animate" : "css"](c, r.animate), l.options.range === !0 && ("horizontal" === l.orientation ? (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({left: i + "%"}, r.animate), 1 === s && l.range[h ? "animate" : "css"]({width: i - e + "%"}, {
                    queue: !1,
                    duration: r.animate
                })) : (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({bottom: i + "%"}, r.animate), 1 === s && l.range[h ? "animate" : "css"]({height: i - e + "%"}, {
                    queue: !1,
                    duration: r.animate
                }))), e = i
            }) : (s = this.value(), n = this._valueMin(), o = this._valueMax(), i = o !== n ? (s - n) / (o - n) * 100 : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[h ? "animate" : "css"](c, r.animate), "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({width: i + "%"}, r.animate), "max" === a && "horizontal" === this.orientation && this.range[h ? "animate" : "css"]({width: 100 - i + "%"}, {
                queue: !1,
                duration: r.animate
            }), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({height: i + "%"}, r.animate), "max" === a && "vertical" === this.orientation && this.range[h ? "animate" : "css"]({height: 100 - i + "%"}, {
                queue: !1,
                duration: r.animate
            }))
        },
        _handleEvents: {
            keydown: function (e) {
                var i, s, n, o, a = t(e.target).data("ui-slider-handle-index");
                switch (e.keyCode) {
                    case t.ui.keyCode.HOME:
                    case t.ui.keyCode.END:
                    case t.ui.keyCode.PAGE_UP:
                    case t.ui.keyCode.PAGE_DOWN:
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, t(e.target).addClass("ui-state-active"), i = this._start(e, a), i === !1)) return
                }
                switch (o = this.options.step, s = n = this.options.values && this.options.values.length ? this.values(a) : this.value(), e.keyCode) {
                    case t.ui.keyCode.HOME:
                        n = this._valueMin();
                        break;
                    case t.ui.keyCode.END:
                        n = this._valueMax();
                        break;
                    case t.ui.keyCode.PAGE_UP:
                        n = this._trimAlignValue(s + (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case t.ui.keyCode.PAGE_DOWN:
                        n = this._trimAlignValue(s - (this._valueMax() - this._valueMin()) / this.numPages);
                        break;
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                        if (s === this._valueMax()) return;
                        n = this._trimAlignValue(s + o);
                        break;
                    case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (s === this._valueMin()) return;
                        n = this._trimAlignValue(s - o)
                }
                this._slide(e, a, n)
            }, keyup: function (e) {
                var i = t(e.target).data("ui-slider-handle-index");
                this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), t(e.target).removeClass("ui-state-active"))
            }
        }
    }), t.widget("ui.sortable", t.ui.mouse, {
        version: "1.11.1",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function (t, e, i) {
            return t >= e && e + i > t
        },
        _isFloating: function (t) {
            return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"))
        },
        _create: function () {
            var t = this.options;
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = this.items.length ? "x" === t.axis || this._isFloating(this.items[0].item) : !1, this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
        },
        _setOption: function (t, e) {
            this._super(t, e), "handle" === t && this._setHandleClassName()
        },
        _setHandleClassName: function () {
            this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), t.each(this.items, function () {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle")
            })
        },
        _destroy: function () {
            this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), this._mouseDestroy();
            for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
            return this
        },
        _mouseCapture: function (e, i) {
            var s = null, n = !1, o = this;
            return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(e), t(e.target).parents().each(function () {
                return t.data(this, o.widgetName + "-item") === o ? (s = t(this), !1) : void 0
            }), t.data(e.target, o.widgetName + "-item") === o && (s = t(e.target)), s && (!this.options.handle || i || (t(this.options.handle, s).find("*").addBack().each(function () {
                this === e.target && (n = !0)
            }), n)) ? (this.currentItem = s, this._removeCurrentsFromItems(), !0) : !1)
        },
        _mouseStart: function (e, i, s) {
            var n, o, a = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, t.extend(this.offset, {
                click: {left: e.pageX - this.offset.left, top: e.pageY - this.offset.top},
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, a.cursorAt && this._adjustOffsetFromHelper(a.cursorAt), this.domPosition = {
                prev: this.currentItem.prev()[0],
                parent: this.currentItem.parent()[0]
            }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), a.containment && this._setContainment(), a.cursor && "auto" !== a.cursor && (o = this.document.find("body"), this.storedCursor = o.css("cursor"), o.css("cursor", a.cursor), this.storedStylesheet = t("<style>*{ cursor: " + a.cursor + " !important; }</style>").appendTo(o)), a.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", a.opacity)), a.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", a.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s) for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
            return t.ui.ddmanager && (t.ui.ddmanager.current = this), t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(e), !0
        },
        _mouseDrag: function (e) {
            var i, s, n, o, a = this.options, r = !1;
            for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < a.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + a.scrollSpeed : e.pageY - this.overflowOffset.top < a.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - a.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < a.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + a.scrollSpeed : e.pageX - this.overflowOffset.left < a.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - a.scrollSpeed)) : (e.pageY - t(document).scrollTop() < a.scrollSensitivity ? r = t(document).scrollTop(t(document).scrollTop() - a.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < a.scrollSensitivity && (r = t(document).scrollTop(t(document).scrollTop() + a.scrollSpeed)), e.pageX - t(document).scrollLeft() < a.scrollSensitivity ? r = t(document).scrollLeft(t(document).scrollLeft() - a.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < a.scrollSensitivity && (r = t(document).scrollLeft(t(document).scrollLeft() + a.scrollSpeed))), r !== !1 && t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--) if (s = this.items[i], n = s.item[0], o = this._intersectsWithPointer(s), o && s.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === o ? "next" : "prev"]()[0] !== n && !t.contains(this.placeholder[0], n) && ("semi-dynamic" === this.options.type ? !t.contains(this.element[0], n) : !0)) {
                if (this.direction = 1 === o ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                this._rearrange(e, s), this._trigger("change", e, this._uiHash());
                break
            }
            return this._contactContainers(e), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function (e, i) {
            if (e) {
                if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), this.options.revert) {
                    var s = this, n = this.placeholder.offset(), o = this.options.axis, a = {};
                    o && "x" !== o || (a.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), o && "y" !== o || (a.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, t(this.helper).animate(a, parseInt(this.options.revert, 10) || 500, function () {
                        s._clear(e)
                    })
                } else this._clear(e, i);
                return !1
            }
        },
        cancel: function () {
            if (this.dragging) {
                this._mouseUp({target: null}), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), t.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function (e) {
            var i = this._getItemsAsjQuery(e && e.connected), s = [];
            return e = e || {}, t(i).each(function () {
                var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
                i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]))
            }), !s.length && e.key && s.push(e.key + "="), s.join("&")
        },
        toArray: function (e) {
            var i = this._getItemsAsjQuery(e && e.connected), s = [];
            return e = e || {}, i.each(function () {
                s.push(t(e.item || this).attr(e.attribute || "id") || "")
            }), s
        },
        _intersectsWith: function (t) {
            var e = this.positionAbs.left, i = e + this.helperProportions.width, s = this.positionAbs.top,
                n = s + this.helperProportions.height, o = t.left, a = o + t.width, r = t.top, l = r + t.height,
                h = this.offset.click.top, c = this.offset.click.left,
                u = "x" === this.options.axis || s + h > r && l > s + h,
                d = "y" === this.options.axis || e + c > o && a > e + c, p = u && d;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > t[this.floating ? "width" : "height"] ? p : o < e + this.helperProportions.width / 2 && i - this.helperProportions.width / 2 < a && r < s + this.helperProportions.height / 2 && n - this.helperProportions.height / 2 < l
        },
        _intersectsWithPointer: function (t) {
            var e = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top, t.height),
                i = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left, t.width),
                s = e && i, n = this._getDragVerticalDirection(), o = this._getDragHorizontalDirection();
            return s ? this.floating ? o && "right" === o || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1) : !1
        },
        _intersectsWithSides: function (t) {
            var e = this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height),
                i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width),
                s = this._getDragVerticalDirection(), n = this._getDragHorizontalDirection();
            return this.floating && n ? "right" === n && i || "left" === n && !i : s && ("down" === s && e || "up" === s && !e)
        },
        _getDragVerticalDirection: function () {
            var t = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== t && (t > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function () {
            var t = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== t && (t > 0 ? "right" : "left")
        },
        refresh: function (t) {
            return this._refreshItems(t), this._setHandleClassName(), this.refreshPositions(), this
        },
        _connectWith: function () {
            var t = this.options;
            return t.connectWith.constructor === String ? [t.connectWith] : t.connectWith
        },
        _getItemsAsjQuery: function (e) {
            function i() {
                r.push(this)
            }

            var s, n, o, a, r = [], l = [], h = this._connectWith();
            if (h && e) for (s = h.length - 1; s >= 0; s--) for (o = t(h[s]), n = o.length - 1; n >= 0; n--) a = t.data(o[n], this.widgetFullName), a && a !== this && !a.options.disabled && l.push([t.isFunction(a.options.items) ? a.options.items.call(a.element) : t(a.options.items, a.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), a]);
            for (l.push([t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                options: this.options,
                item: this.currentItem
            }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = l.length - 1; s >= 0; s--) l[s][0].each(i);
            return t(r)
        },
        _removeCurrentsFromItems: function () {
            var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = t.grep(this.items, function (t) {
                for (var i = 0; i < e.length; i++) if (e[i] === t.item[0]) return !1;
                return !0
            })
        },
        _refreshItems: function (e) {
            this.items = [], this.containers = [this];
            var i, s, n, o, a, r, l, h, c = this.items,
                u = [[t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {item: this.currentItem}) : t(this.options.items, this.element), this]],
                d = this._connectWith();
            if (d && this.ready) for (i = d.length - 1; i >= 0; i--) for (n = t(d[i]), s = n.length - 1; s >= 0; s--) o = t.data(n[s], this.widgetFullName), o && o !== this && !o.options.disabled && (u.push([t.isFunction(o.options.items) ? o.options.items.call(o.element[0], e, {item: this.currentItem}) : t(o.options.items, o.element), o]), this.containers.push(o));
            for (i = u.length - 1; i >= 0; i--) for (a = u[i][1], r = u[i][0], s = 0, h = r.length; h > s; s++) l = t(r[s]), l.data(this.widgetName + "-item", a), c.push({
                item: l,
                instance: a,
                width: 0,
                height: 0,
                left: 0,
                top: 0
            })
        },
        refreshPositions: function (e) {
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var i, s, n, o;
            for (i = this.items.length - 1; i >= 0; i--) s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, e || (s.width = n.outerWidth(), s.height = n.outerHeight()), o = n.offset(), s.left = o.left, s.top = o.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this); else for (i = this.containers.length - 1; i >= 0; i--) o = this.containers[i].element.offset(), this.containers[i].containerCache.left = o.left, this.containers[i].containerCache.top = o.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
            return this
        },
        _createPlaceholder: function (e) {
            e = e || this;
            var i, s = e.options;
            s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                element: function () {
                    var s = e.currentItem[0].nodeName.toLowerCase(),
                        n = t("<" + s + ">", e.document[0]).addClass(i || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tr" === s ? e.currentItem.children().each(function () {
                        t("<td>&#160;</td>", e.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(n)
                    }) : "img" === s && n.attr("src", e.currentItem.attr("src")), i || n.css("visibility", "hidden"), n
                }, update: function (t, n) {
                    (!i || s.forcePlaceholderSize) && (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)))
                }
            }), e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)), e.currentItem.after(e.placeholder), s.placeholder.update(e, e.placeholder)
        },
        _contactContainers: function (e) {
            var i, s, n, o, a, r, l, h, c, u, d = null, p = null;
            for (i = this.containers.length - 1; i >= 0; i--) if (!t.contains(this.currentItem[0], this.containers[i].element[0])) if (this._intersectsWith(this.containers[i].containerCache)) {
                if (d && t.contains(this.containers[i].element[0], d.element[0])) continue;
                d = this.containers[i], p = i
            } else this.containers[i].containerCache.over && (this.containers[i]._trigger("out", e, this._uiHash(this)), this.containers[i].containerCache.over = 0);
            if (d) if (1 === this.containers.length) this.containers[p].containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1); else {
                for (n = 1e4, o = null, c = d.floating || this._isFloating(this.currentItem), a = c ? "left" : "top", r = c ? "width" : "height", u = c ? "clientX" : "clientY", s = this.items.length - 1; s >= 0; s--) t.contains(this.containers[p].element[0], this.items[s].item[0]) && this.items[s].item[0] !== this.currentItem[0] && (l = this.items[s].item.offset()[a], h = !1, e[u] - l > this.items[s][r] / 2 && (h = !0), Math.abs(e[u] - l) < n && (n = Math.abs(e[u] - l), o = this.items[s], this.direction = h ? "up" : "down"));
                if (!o && !this.options.dropOnEmpty) return;
                if (this.currentContainer === this.containers[p]) return;
                o ? this._rearrange(e, o, null, !0) : this._rearrange(e, null, this.containers[p].element, !0), this._trigger("change", e, this._uiHash()), this.containers[p]._trigger("change", e, this._uiHash(this)), this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1
            }
        },
        _createHelper: function (e) {
            var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
            return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()), (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()), s
        },
        _adjustOffsetFromHelper: function (e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        },
        _getParentOffset: function () {
            this.offsetParent = this.helper.offsetParent();
            var e = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) {
                var t = this.currentItem.position();
                return {
                    top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {top: 0, left: 0}
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {width: this.helper.outerWidth(), height: this.helper.outerHeight()}
        },
        _setContainment: function () {
            var e, i, s, n = this.options;
            "parent" === n.containment && (n.containment = this.helper[0].parentNode), ("document" === n.containment || "window" === n.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, t("document" === n.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (t("document" === n.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), s = "hidden" !== t(e).css("overflow"), this.containment = [i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function (e, i) {
            i || (i = this.position);
            var s = "absolute" === e ? 1 : -1,
                n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                o = /(html|body)/i.test(n[0].tagName);
            return {
                top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : o ? 0 : n.scrollTop()) * s,
                left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : o ? 0 : n.scrollLeft()) * s
            }
        },
        _generatePosition: function (e) {
            var i, s, n = this.options, o = e.pageX, a = e.pageY,
                r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                l = /(html|body)/i.test(r[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (o = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (a = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (o = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (a = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((a - this.originalPageY) / n.grid[1]) * n.grid[1], a = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((o - this.originalPageX) / n.grid[0]) * n.grid[0], o = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), {
                top: a - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : l ? 0 : r.scrollTop()),
                left: o - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : l ? 0 : r.scrollLeft())
            }
        },
        _rearrange: function (t, e, i, s) {
            i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var n = this.counter;
            this._delay(function () {
                n === this.counter && this.refreshPositions(!s)
            })
        },
        _clear: function (t, e) {
            function i(t, e, i) {
                return function (s) {
                    i._trigger(t, s, e._uiHash(e))
                }
            }

            this.reverting = !1;
            var s, n = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (s in this._storedCSS) ("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else this.currentItem.show();
            for (this.fromOutside && !e && n.push(function (t) {
                this._trigger("receive", t, this._uiHash(this.fromOutside))
            }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || n.push(function (t) {
                this._trigger("update", t, this._uiHash())
            }), this !== this.currentContainer && (e || (n.push(function (t) {
                this._trigger("remove", t, this._uiHash())
            }), n.push(function (t) {
                return function (e) {
                    t._trigger("receive", e, this._uiHash(this))
                }
            }.call(this, this.currentContainer)), n.push(function (t) {
                return function (e) {
                    t._trigger("update", e, this._uiHash(this))
                }
            }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) e || n.push(i("deactivate", this, this.containers[s])), this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                if (!e) {
                    for (this._trigger("beforeStop", t, this._uiHash()), s = 0; s < n.length; s++) n[s].call(this, t);
                    this._trigger("stop", t, this._uiHash())
                }
                return this.fromOutside = !1, !1
            }
            if (e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !e) {
                for (s = 0; s < n.length; s++) n[s].call(this, t);
                this._trigger("stop", t, this._uiHash())
            }
            return this.fromOutside = !1, !0
        },
        _trigger: function () {
            t.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function (e) {
            var i = e || this;
            return {
                helper: i.helper,
                placeholder: i.placeholder || t([]),
                position: i.position,
                originalPosition: i.originalPosition,
                offset: i.positionAbs,
                item: i.currentItem,
                sender: e ? e.element : null
            }
        }
    }), t.widget("ui.spinner", {
        version: "1.11.1",
        defaultElement: "<input>",
        widgetEventPrefix: "spin",
        options: {
            culture: null,
            icons: {down: "ui-icon-triangle-1-s", up: "ui-icon-triangle-1-n"},
            incremental: !0,
            max: null,
            min: null,
            numberFormat: null,
            page: 10,
            step: 1,
            change: null,
            spin: null,
            start: null,
            stop: null
        },
        _create: function () {
            this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
                beforeunload: function () {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _getCreateOptions: function () {
            var e = {}, i = this.element;
            return t.each(["min", "max", "step"], function (t, s) {
                var n = i.attr(s);
                void 0 !== n && n.length && (e[s] = n)
            }), e
        },
        _events: {
            keydown: function (t) {
                this._start(t) && this._keydown(t) && t.preventDefault()
            }, keyup: "_stop", focus: function () {
                this.previous = this.element.val()
            }, blur: function (t) {
                return this.cancelBlur ? void delete this.cancelBlur : (this._stop(), this._refresh(), void (this.previous !== this.element.val() && this._trigger("change", t)))
            }, mousewheel: function (t, e) {
                if (e) {
                    if (!this.spinning && !this._start(t)) return !1;
                    this._spin((e > 0 ? 1 : -1) * this.options.step, t), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function () {
                        this.spinning && this._stop(t)
                    }, 100), t.preventDefault()
                }
            }, "mousedown .ui-spinner-button": function (e) {
                function i() {
                    var t = this.element[0] === this.document[0].activeElement;
                    t || (this.element.focus(), this.previous = s, this._delay(function () {
                        this.previous = s
                    }))
                }

                var s;
                s = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val(), e.preventDefault(), i.call(this), this.cancelBlur = !0, this._delay(function () {
                    delete this.cancelBlur, i.call(this)
                }), this._start(e) !== !1 && this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
            }, "mouseup .ui-spinner-button": "_stop", "mouseenter .ui-spinner-button": function (e) {
                return t(e.currentTarget).hasClass("ui-state-active") ? this._start(e) === !1 ? !1 : void this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e) : void 0
            }, "mouseleave .ui-spinner-button": "_stop"
        },
        _draw: function () {
            var t = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
            this.element.attr("role", "spinbutton"), this.buttons = t.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"), this.buttons.height() > Math.ceil(.5 * t.height()) && t.height() > 0 && t.height(t.height()), this.options.disabled && this.disable()
        },
        _keydown: function (e) {
            var i = this.options, s = t.ui.keyCode;
            switch (e.keyCode) {
                case s.UP:
                    return this._repeat(null, 1, e), !0;
                case s.DOWN:
                    return this._repeat(null, -1, e), !0;
                case s.PAGE_UP:
                    return this._repeat(null, i.page, e), !0;
                case s.PAGE_DOWN:
                    return this._repeat(null, -i.page, e), !0
            }
            return !1
        },
        _uiSpinnerHtml: function () {
            return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>"
        },
        _buttonHtml: function () {
            return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span></a><a class='ui-spinner-button ui-spinner-down ui-corner-br'><span class='ui-icon " + this.options.icons.down + "'>&#9660;</span></a>"
        },
        _start: function (t) {
            return this.spinning || this._trigger("start", t) !== !1 ? (this.counter || (this.counter = 1), this.spinning = !0, !0) : !1
        },
        _repeat: function (t, e, i) {
            t = t || 500, clearTimeout(this.timer), this.timer = this._delay(function () {
                this._repeat(40, e, i)
            }, t), this._spin(e * this.options.step, i)
        },
        _spin: function (t, e) {
            var i = this.value() || 0;
            this.counter || (this.counter = 1), i = this._adjustValue(i + t * this._increment(this.counter)), this.spinning && this._trigger("spin", e, {value: i}) === !1 || (this._value(i), this.counter++)
        },
        _increment: function (e) {
            var i = this.options.incremental;
            return i ? t.isFunction(i) ? i(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1
        },
        _precision: function () {
            var t = this._precisionOf(this.options.step);
            return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), t
        },
        _precisionOf: function (t) {
            var e = t.toString(), i = e.indexOf(".");
            return -1 === i ? 0 : e.length - i - 1
        },
        _adjustValue: function (t) {
            var e, i, s = this.options;
            return e = null !== s.min ? s.min : 0, i = t - e, i = Math.round(i / s.step) * s.step, t = e + i, t = parseFloat(t.toFixed(this._precision())), null !== s.max && t > s.max ? s.max : null !== s.min && t < s.min ? s.min : t
        },
        _stop: function (t) {
            this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", t))
        },
        _setOption: function (t, e) {
            if ("culture" === t || "numberFormat" === t) {
                var i = this._parse(this.element.val());
                return this.options[t] = e, void this.element.val(this._format(i));
            }
            ("max" === t || "min" === t || "step" === t) && "string" == typeof e && (e = this._parse(e)), "icons" === t && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(e.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(e.down)), this._super(t, e), "disabled" === t && (this.widget().toggleClass("ui-state-disabled", !!e), this.element.prop("disabled", !!e), this.buttons.button(e ? "disable" : "enable"))
        },
        _setOptions: l(function (t) {
            this._super(t)
        }),
        _parse: function (t) {
            return "string" == typeof t && "" !== t && (t = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(t, 10, this.options.culture) : +t), "" === t || isNaN(t) ? null : t
        },
        _format: function (t) {
            return "" === t ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(t, this.options.numberFormat, this.options.culture) : t
        },
        _refresh: function () {
            this.element.attr({
                "aria-valuemin": this.options.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            })
        },
        isValid: function () {
            var t = this.value();
            return null === t ? !1 : t === this._adjustValue(t)
        },
        _value: function (t, e) {
            var i;
            "" !== t && (i = this._parse(t), null !== i && (e || (i = this._adjustValue(i)), t = this._format(i))), this.element.val(t), this._refresh()
        },
        _destroy: function () {
            this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.uiSpinner.replaceWith(this.element)
        },
        stepUp: l(function (t) {
            this._stepUp(t)
        }),
        _stepUp: function (t) {
            this._start() && (this._spin((t || 1) * this.options.step), this._stop())
        },
        stepDown: l(function (t) {
            this._stepDown(t)
        }),
        _stepDown: function (t) {
            this._start() && (this._spin((t || 1) * -this.options.step), this._stop())
        },
        pageUp: l(function (t) {
            this._stepUp((t || 1) * this.options.page)
        }),
        pageDown: l(function (t) {
            this._stepDown((t || 1) * this.options.page)
        }),
        value: function (t) {
            return arguments.length ? void l(this._value).call(this, t) : this._parse(this.element.val())
        },
        widget: function () {
            return this.uiSpinner
        }
    }), t.widget("ui.tabs", {
        version: "1.11.1",
        delay: 300,
        options: {
            active: null,
            collapsible: !1,
            event: "click",
            heightStyle: "content",
            hide: null,
            show: null,
            activate: null,
            beforeActivate: null,
            beforeLoad: null,
            load: null
        },
        _isLocal: function () {
            var t = /#.*$/;
            return function (e) {
                var i, s;
                e = e.cloneNode(!1), i = e.href.replace(t, ""), s = location.href.replace(t, "");
                try {
                    i = decodeURIComponent(i)
                } catch (n) {
                }
                try {
                    s = decodeURIComponent(s)
                } catch (n) {
                }
                return e.hash.length > 1 && i === s
            }
        }(),
        _create: function () {
            var e = this, i = this.options;
            this.running = !1, this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", i.collapsible), this._processTabs(), i.active = this._initialActive(), t.isArray(i.disabled) && (i.disabled = t.unique(i.disabled.concat(t.map(this.tabs.filter(".ui-state-disabled"), function (t) {
                return e.tabs.index(t)
            }))).sort()), this.options.active !== !1 && this.anchors.length ? this.active = this._findActive(i.active) : this.active = t(), this._refresh(), this.active.length && this.load(i.active)
        },
        _initialActive: function () {
            var e = this.options.active, i = this.options.collapsible, s = location.hash.substring(1);
            return null === e && (s && this.tabs.each(function (i, n) {
                return t(n).attr("aria-controls") === s ? (e = i, !1) : void 0
            }), null === e && (e = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), (null === e || -1 === e) && (e = this.tabs.length ? 0 : !1)), e !== !1 && (e = this.tabs.index(this.tabs.eq(e)), -1 === e && (e = i ? !1 : 0)), !i && e === !1 && this.anchors.length && (e = 0), e
        },
        _getCreateEventData: function () {
            return {tab: this.active, panel: this.active.length ? this._getPanelForTab(this.active) : t()}
        },
        _tabKeydown: function (e) {
            var i = t(this.document[0].activeElement).closest("li"), s = this.tabs.index(i), n = !0;
            if (!this._handlePageNav(e)) {
                switch (e.keyCode) {
                    case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                        s++;
                        break;
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.LEFT:
                        n = !1, s--;
                        break;
                    case t.ui.keyCode.END:
                        s = this.anchors.length - 1;
                        break;
                    case t.ui.keyCode.HOME:
                        s = 0;
                        break;
                    case t.ui.keyCode.SPACE:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(s);
                    case t.ui.keyCode.ENTER:
                        return e.preventDefault(), clearTimeout(this.activating), void this._activate(s === this.options.active ? !1 : s);
                    default:
                        return
                }
                e.preventDefault(), clearTimeout(this.activating), s = this._focusNextTab(s, n), e.ctrlKey || (i.attr("aria-selected", "false"), this.tabs.eq(s).attr("aria-selected", "true"), this.activating = this._delay(function () {
                    this.option("active", s)
                }, this.delay))
            }
        },
        _panelKeydown: function (e) {
            this._handlePageNav(e) || e.ctrlKey && e.keyCode === t.ui.keyCode.UP && (e.preventDefault(), this.active.focus())
        },
        _handlePageNav: function (e) {
            return e.altKey && e.keyCode === t.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : e.altKey && e.keyCode === t.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : void 0
        },
        _findNextTab: function (e, i) {
            function s() {
                return e > n && (e = 0), 0 > e && (e = n), e
            }

            for (var n = this.tabs.length - 1; -1 !== t.inArray(s(), this.options.disabled);) e = i ? e + 1 : e - 1;
            return e
        },
        _focusNextTab: function (t, e) {
            return t = this._findNextTab(t, e), this.tabs.eq(t).focus(), t
        },
        _setOption: function (t, e) {
            return "active" === t ? void this._activate(e) : "disabled" === t ? void this._setupDisabled(e) : (this._super(t, e), "collapsible" === t && (this.element.toggleClass("ui-tabs-collapsible", e), e || this.options.active !== !1 || this._activate(0)), "event" === t && this._setupEvents(e), void ("heightStyle" === t && this._setupHeightStyle(e)))
        },
        _sanitizeSelector: function (t) {
            return t ? t.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""
        },
        refresh: function () {
            var e = this.options, i = this.tablist.children(":has(a[href])");
            e.disabled = t.map(i.filter(".ui-state-disabled"), function (t) {
                return i.index(t)
            }), this._processTabs(), e.active !== !1 && this.anchors.length ? this.active.length && !t.contains(this.tablist[0], this.active[0]) ? this.tabs.length === e.disabled.length ? (e.active = !1, this.active = t()) : this._activate(this._findNextTab(Math.max(0, e.active - 1), !1)) : e.active = this.tabs.index(this.active) : (e.active = !1, this.active = t()), this._refresh()
        },
        _refresh: function () {
            this._setupDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
                "aria-selected": "false",
                "aria-expanded": "false",
                tabIndex: -1
            }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({"aria-hidden": "true"}), this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            }), this._getPanelForTab(this.active).show().attr({"aria-hidden": "false"})) : this.tabs.eq(0).attr("tabIndex", 0)
        },
        _processTabs: function () {
            var e = this;
            this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist").delegate("> li", "mousedown" + this.eventNamespace, function (e) {
                t(this).is(".ui-state-disabled") && e.preventDefault()
            }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function () {
                t(this).closest("li").is(".ui-state-disabled") && this.blur()
            }), this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({
                role: "tab",
                tabIndex: -1
            }), this.anchors = this.tabs.map(function () {
                return t("a", this)[0]
            }).addClass("ui-tabs-anchor").attr({
                role: "presentation",
                tabIndex: -1
            }), this.panels = t(), this.anchors.each(function (i, s) {
                var n, o, a, r = t(s).uniqueId().attr("id"), l = t(s).closest("li"), h = l.attr("aria-controls");
                e._isLocal(s) ? (n = s.hash, a = n.substring(1), o = e.element.find(e._sanitizeSelector(n))) : (a = l.attr("aria-controls") || t({}).uniqueId()[0].id, n = "#" + a, o = e.element.find(n), o.length || (o = e._createPanel(a), o.insertAfter(e.panels[i - 1] || e.tablist)), o.attr("aria-live", "polite")), o.length && (e.panels = e.panels.add(o)), h && l.data("ui-tabs-aria-controls", h), l.attr({
                    "aria-controls": a,
                    "aria-labelledby": r
                }), o.attr("aria-labelledby", r)
            }), this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel")
        },
        _getList: function () {
            return this.tablist || this.element.find("ol,ul").eq(0)
        },
        _createPanel: function (e) {
            return t("<div>").attr("id", e).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0)
        },
        _setupDisabled: function (e) {
            t.isArray(e) && (e.length ? e.length === this.anchors.length && (e = !0) : e = !1);
            for (var i, s = 0; i = this.tabs[s]; s++) e === !0 || -1 !== t.inArray(s, e) ? t(i).addClass("ui-state-disabled").attr("aria-disabled", "true") : t(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");
            this.options.disabled = e
        },
        _setupEvents: function (e) {
            var i = {};
            e && t.each(e.split(" "), function (t, e) {
                i[e] = "_eventHandler"
            }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(!0, this.anchors, {
                click: function (t) {
                    t.preventDefault()
                }
            }), this._on(this.anchors, i), this._on(this.tabs, {keydown: "_tabKeydown"}), this._on(this.panels, {keydown: "_panelKeydown"}), this._focusable(this.tabs), this._hoverable(this.tabs)
        },
        _setupHeightStyle: function (e) {
            var i, s = this.element.parent();
            "fill" === e ? (i = s.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function () {
                var e = t(this), s = e.css("position");
                "absolute" !== s && "fixed" !== s && (i -= e.outerHeight(!0))
            }), this.element.children().not(this.panels).each(function () {
                i -= t(this).outerHeight(!0)
            }), this.panels.each(function () {
                t(this).height(Math.max(0, i - t(this).innerHeight() + t(this).height()))
            }).css("overflow", "auto")) : "auto" === e && (i = 0, this.panels.each(function () {
                i = Math.max(i, t(this).height("").height())
            }).height(i))
        },
        _eventHandler: function (e) {
            var i = this.options, s = this.active, n = t(e.currentTarget), o = n.closest("li"), a = o[0] === s[0],
                r = a && i.collapsible, l = r ? t() : this._getPanelForTab(o),
                h = s.length ? this._getPanelForTab(s) : t(),
                c = {oldTab: s, oldPanel: h, newTab: r ? t() : o, newPanel: l};
            e.preventDefault(), o.hasClass("ui-state-disabled") || o.hasClass("ui-tabs-loading") || this.running || a && !i.collapsible || this._trigger("beforeActivate", e, c) === !1 || (i.active = r ? !1 : this.tabs.index(o), this.active = a ? t() : o, this.xhr && this.xhr.abort(), h.length || l.length || t.error("jQuery UI Tabs: Mismatching fragment identifier."), l.length && this.load(this.tabs.index(o), e), this._toggle(e, c))
        },
        _toggle: function (e, i) {
            function s() {
                o.running = !1, o._trigger("activate", e, i)
            }

            function n() {
                i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"), a.length && o.options.show ? o._show(a, o.options.show, s) : (a.show(), s())
            }

            var o = this, a = i.newPanel, r = i.oldPanel;
            this.running = !0, r.length && this.options.hide ? this._hide(r, this.options.hide, function () {
                i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), n()
            }) : (i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), r.hide(), n()), r.attr("aria-hidden", "true"), i.oldTab.attr({
                "aria-selected": "false",
                "aria-expanded": "false"
            }), a.length && r.length ? i.oldTab.attr("tabIndex", -1) : a.length && this.tabs.filter(function () {
                return 0 === t(this).attr("tabIndex")
            }).attr("tabIndex", -1), a.attr("aria-hidden", "false"), i.newTab.attr({
                "aria-selected": "true",
                "aria-expanded": "true",
                tabIndex: 0
            })
        },
        _activate: function (e) {
            var i, s = this._findActive(e);
            s[0] !== this.active[0] && (s.length || (s = this.active), i = s.find(".ui-tabs-anchor")[0], this._eventHandler({
                target: i,
                currentTarget: i,
                preventDefault: t.noop
            }))
        },
        _findActive: function (e) {
            return e === !1 ? t() : this.tabs.eq(e)
        },
        _getIndex: function (t) {
            return "string" == typeof t && (t = this.anchors.index(this.anchors.filter("[href$='" + t + "']"))), t
        },
        _destroy: function () {
            this.xhr && this.xhr.abort(), this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"), this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"), this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(), this.tablist.unbind(this.eventNamespace), this.tabs.add(this.panels).each(function () {
                t.data(this, "ui-tabs-destroy") ? t(this).remove() : t(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")
            }), this.tabs.each(function () {
                var e = t(this), i = e.data("ui-tabs-aria-controls");
                i ? e.attr("aria-controls", i).removeData("ui-tabs-aria-controls") : e.removeAttr("aria-controls")
            }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "")
        },
        enable: function (e) {
            var i = this.options.disabled;
            i !== !1 && (void 0 === e ? i = !1 : (e = this._getIndex(e), i = t.isArray(i) ? t.map(i, function (t) {
                return t !== e ? t : null
            }) : t.map(this.tabs, function (t, i) {
                return i !== e ? i : null
            })), this._setupDisabled(i))
        },
        disable: function (e) {
            var i = this.options.disabled;
            if (i !== !0) {
                if (void 0 === e) i = !0; else {
                    if (e = this._getIndex(e), -1 !== t.inArray(e, i)) return;
                    i = t.isArray(i) ? t.merge([e], i).sort() : [e]
                }
                this._setupDisabled(i)
            }
        },
        load: function (e, i) {
            e = this._getIndex(e);
            var s = this, n = this.tabs.eq(e), o = n.find(".ui-tabs-anchor"), a = this._getPanelForTab(n),
                r = {tab: n, panel: a};
            this._isLocal(o[0]) || (this.xhr = t.ajax(this._ajaxSettings(o, i, r)), this.xhr && "canceled" !== this.xhr.statusText && (n.addClass("ui-tabs-loading"), a.attr("aria-busy", "true"), this.xhr.success(function (t) {
                setTimeout(function () {
                    a.html(t), s._trigger("load", i, r)
                }, 1)
            }).complete(function (t, e) {
                setTimeout(function () {
                    "abort" === e && s.panels.stop(!1, !0), n.removeClass("ui-tabs-loading"), a.removeAttr("aria-busy"), t === s.xhr && delete s.xhr
                }, 1)
            })))
        },
        _ajaxSettings: function (e, i, s) {
            var n = this;
            return {
                url: e.attr("href"), beforeSend: function (e, o) {
                    return n._trigger("beforeLoad", i, t.extend({jqXHR: e, ajaxSettings: o}, s))
                }
            }
        },
        _getPanelForTab: function (e) {
            var i = t(e).attr("aria-controls");
            return this.element.find(this._sanitizeSelector("#" + i))
        }
    }), t.widget("ui.tooltip", {
        version: "1.11.1", options: {
            content: function () {
                var e = t(this).attr("title") || "";
                return t("<a>").text(e).html()
            },
            hide: !0,
            items: "[title]:not([disabled])",
            position: {my: "left top+15", at: "left bottom", collision: "flipfit flip"},
            show: !0,
            tooltipClass: null,
            track: !1,
            close: null,
            open: null
        }, _addDescribedBy: function (e, i) {
            var s = (e.attr("aria-describedby") || "").split(/\s+/);
            s.push(i), e.data("ui-tooltip-id", i).attr("aria-describedby", t.trim(s.join(" ")))
        }, _removeDescribedBy: function (e) {
            var i = e.data("ui-tooltip-id"), s = (e.attr("aria-describedby") || "").split(/\s+/), n = t.inArray(i, s);
            -1 !== n && s.splice(n, 1), e.removeData("ui-tooltip-id"), s = t.trim(s.join(" ")), s ? e.attr("aria-describedby", s) : e.removeAttr("aria-describedby")
        }, _create: function () {
            this._on({
                mouseover: "open",
                focusin: "open"
            }), this.tooltips = {}, this.parents = {}, this.options.disabled && this._disable(), this.liveRegion = t("<div>").attr({
                role: "log",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body)
        }, _setOption: function (e, i) {
            var s = this;
            return "disabled" === e ? (this[i ? "_disable" : "_enable"](), void (this.options[e] = i)) : (this._super(e, i), void ("content" === e && t.each(this.tooltips, function (t, e) {
                s._updateContent(e)
            })))
        }, _disable: function () {
            var e = this;
            t.each(this.tooltips, function (i, s) {
                var n = t.Event("blur");
                n.target = n.currentTarget = s[0], e.close(n, !0)
            }), this.element.find(this.options.items).addBack().each(function () {
                var e = t(this);
                e.is("[title]") && e.data("ui-tooltip-title", e.attr("title")).removeAttr("title")
            })
        }, _enable: function () {
            this.element.find(this.options.items).addBack().each(function () {
                var e = t(this);
                e.data("ui-tooltip-title") && e.attr("title", e.data("ui-tooltip-title"))
            })
        }, open: function (e) {
            var i = this, s = t(e ? e.target : this.element).closest(this.options.items);
            s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), s.data("ui-tooltip-open", !0), e && "mouseover" === e.type && s.parents().each(function () {
                var e, s = t(this);
                s.data("ui-tooltip-open") && (e = t.Event("blur"), e.target = e.currentTarget = this, i.close(e, !0)), s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
                    element: this,
                    title: s.attr("title")
                }, s.attr("title", ""))
            }), this._updateContent(s, e))
        }, _updateContent: function (t, e) {
            var i, s = this.options.content, n = this, o = e ? e.type : null;
            return "string" == typeof s ? this._open(e, t, s) : (i = s.call(t[0], function (i) {
                t.data("ui-tooltip-open") && n._delay(function () {
                    e && (e.type = o), this._open(e, t, i)
                })
            }), void (i && this._open(e, t, i)))
        }, _open: function (e, i, s) {
            function n(t) {
                h.of = t, o.is(":hidden") || o.position(h)
            }

            var o, a, r, l, h = t.extend({}, this.options.position);
            if (s) {
                if (o = this._find(i), o.length) return void o.find(".ui-tooltip-content").html(s);
                i.is("[title]") && (e && "mouseover" === e.type ? i.attr("title", "") : i.removeAttr("title")), o = this._tooltip(i), this._addDescribedBy(i, o.attr("id")), o.find(".ui-tooltip-content").html(s), this.liveRegion.children().hide(), s.clone ? (l = s.clone(), l.removeAttr("id").find("[id]").removeAttr("id")) : l = s, t("<div>").html(l).appendTo(this.liveRegion), this.options.track && e && /^mouse/.test(e.type) ? (this._on(this.document, {mousemove: n}), n(e)) : o.position(t.extend({of: i}, this.options.position)), this.hiding = !1, this.closing = !1, o.hide(), this._show(o, this.options.show), this.options.show && this.options.show.delay && (r = this.delayedShow = setInterval(function () {
                    o.is(":visible") && (n(h.of), clearInterval(r))
                }, t.fx.interval)), this._trigger("open", e, {tooltip: o}), a = {
                    keyup: function (e) {
                        if (e.keyCode === t.ui.keyCode.ESCAPE) {
                            var s = t.Event(e);
                            s.currentTarget = i[0], this.close(s, !0)
                        }
                    }
                }, i[0] !== this.element[0] && (a.remove = function () {
                    this._removeTooltip(o)
                }), e && "mouseover" !== e.type || (a.mouseleave = "close"), e && "focusin" !== e.type || (a.focusout = "close"), this._on(!0, i, a)
            }
        }, close: function (e) {
            var i = this, s = t(e ? e.currentTarget : this.element), n = this._find(s);
            this.closing || (clearInterval(this.delayedShow), s.data("ui-tooltip-title") && !s.attr("title") && s.attr("title", s.data("ui-tooltip-title")), this._removeDescribedBy(s), this.hiding = !0, n.stop(!0), this._hide(n, this.options.hide, function () {
                i._removeTooltip(t(this)), this.hiding = !1, this.closing = !1
            }), s.removeData("ui-tooltip-open"), this._off(s, "mouseleave focusout keyup"), s[0] !== this.element[0] && this._off(s, "remove"), this._off(this.document, "mousemove"), e && "mouseleave" === e.type && t.each(this.parents, function (e, s) {
                t(s.element).attr("title", s.title), delete i.parents[e]
            }), this.closing = !0, this._trigger("close", e, {tooltip: n}), this.hiding || (this.closing = !1))
        }, _tooltip: function (e) {
            var i = t("<div>").attr("role", "tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || "")),
                s = i.uniqueId().attr("id");
            return t("<div>").addClass("ui-tooltip-content").appendTo(i), i.appendTo(this.document[0].body), this.tooltips[s] = e, i
        }, _find: function (e) {
            var i = e.data("ui-tooltip-id");
            return i ? t("#" + i) : t()
        }, _removeTooltip: function (t) {
            t.remove(), delete this.tooltips[t.attr("id")]
        }, _destroy: function () {
            var e = this;
            t.each(this.tooltips, function (i, s) {
                var n = t.Event("blur");
                n.target = n.currentTarget = s[0], e.close(n, !0), t("#" + i).remove(), s.data("ui-tooltip-title") && (s.attr("title") || s.attr("title", s.data("ui-tooltip-title")), s.removeData("ui-tooltip-title"))
            }), this.liveRegion.remove()
        }
    })
}), jQuery.fn.selectbox = function (t) {
    var e = {className: "jquery-selectbox", animationSpeed: "fast", listboxMaxSize: 10, replaceInvisible: !1},
        i = "jquery-custom-selectboxes-replaced", s = !1, n = function (t) {
            var i = t.parents("." + e.className);
            return t.slideDown(e.animationSpeed, function () {
                s = !0
            }), i.addClass("selecthover"), jQuery(document).bind("click", a), t
        }, o = function (t) {
            t.parents("." + e.className);
            return t.slideUp(e.animationSpeed, function () {
                s = !1, jQuery(this).parents("." + e.className).removeClass("selecthover")
            }), jQuery(document).unbind("click", a), t
        }, a = function (t) {
            var n = t.target, a = jQuery("." + e.className + "-list:visible").parent().find("*").andSelf();
            return jQuery.inArray(n, a) < 0 && s && o(jQuery("." + i + "-list")), !1
        };
    return e = jQuery.extend(e, t || {}), this.each(function () {
        var t = jQuery(this);
        if (0 != t.filter(":visible").length || e.replaceInvisible) {
            var s = jQuery('<div class="' + e.className + " " + i + '"><div class="' + e.className + '-moreButton" /><div class="' + e.className + "-list " + i + '-list" /><span class="' + e.className + '-currentItem" /></div>');
            jQuery(".option", t).each(function (t, i) {
                var i = jQuery(i),
                    a = jQuery('<span class="tax-filter3 ' + e.className + "-item value-" + i.val() + " item-" + t + '" title="' + i.text() + '">' + i.text() + "</span>");
                a.click(function () {
                    var t = jQuery(this), i = t.parents("." + e.className), s = t[0].className.split(" ");
                    for (k1 in s) if (/^item-[0-9]+$/.test(s[k1])) {
                        s = parseInt(s[k1].replace("item-", ""), 10);
                        break
                    }
                    var a = t[0].className.split(" ");
                    for (k1 in a) if (/^value-.+$/.test(a[k1])) {
                        a = a[k1].replace("value-", "");
                        break
                    }
                    i.find("." + e.className + "-currentItem").text(t.text()), i.find("select").val(a).triggerHandler("change");
                    var r = i.find("." + e.className + "-list");
                    r.filter(":visible").length > 0 ? o(r) : n(r)
                }).bind("mouseenter", function () {
                    jQuery(this).addClass("listelementhover")
                }).bind("mouseleave", function () {
                    jQuery(this).removeClass("listelementhover")
                }), jQuery("." + e.className + "-list", s).append(a), i.filter(":selected").length > 0 && jQuery("." + e.className + "-currentItem", s).text(i.text())
            }), jQuery(".option1", t).each(function (t, i) {
                var i = jQuery(i),
                    a = jQuery('<span class="tax-filter ' + e.className + "-item value-" + i.val() + " item-" + t + '" title="' + i.text() + '">' + i.text() + "</span>");
                a.click(function () {
                    var t = jQuery(this), i = t.parents("." + e.className), s = t[0].className.split(" ");
                    for (k1 in s) if (/^item-[0-9]+$/.test(s[k1])) {
                        s = parseInt(s[k1].replace("item-", ""), 10);
                        break
                    }
                    var a = t[0].className.split(" ");
                    for (k1 in a) if (/^value-.+$/.test(a[k1])) {
                        a = a[k1].replace("value-", "");
                        break
                    }
                    i.find("." + e.className + "-currentItem").text(t.text()), i.find("select").val(a).triggerHandler("change");
                    var r = i.find("." + e.className + "-list");
                    r.filter(":visible").length > 0 ? o(r) : n(r)
                }).bind("mouseenter", function () {
                    jQuery(this).addClass("listelementhover")
                }).bind("mouseleave", function () {
                    jQuery(this).removeClass("listelementhover")
                }), jQuery("." + e.className + "-list", s).append(a), i.filter(":selected").length > 0 && jQuery("." + e.className + "-currentItem", s).text(i.text())
            }), s.find("." + e.className + "-moreButton").click(function () {
                var t = jQuery(this),
                    i = jQuery("." + e.className + "-list").not(t.siblings("." + e.className + "-list"));
                o(i);
                var s = t.siblings("." + e.className + "-list");
                s.filter(":visible").length > 0 ? o(s) : n(s)
            }).bind("mouseenter", function () {
                jQuery(this).addClass("morebuttonhover")
            }).bind("mouseleave", function () {
                jQuery(this).removeClass("morebuttonhover")
            }), t.hide().replaceWith(s).appendTo(s)
        }
    })
}, jQuery.fn.unselectbox = function () {
    var t = "jquery-custom-selectboxes-replaced";
    return this.each(function () {
        var e = jQuery(this).filter("." + t);
        e.replaceWith(e.find("select").show())
    })
};