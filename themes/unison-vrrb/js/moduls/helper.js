/**
 * @namespace PROJECTNAME
 */

(function (PROJECTNAME, $, undefined) {
  'use strict';

  /**
   * @namespace helper
   * @memberof PROJECTNAME
   *
   */
  PROJECTNAME.helper = (function () {
    function Helper() {


      var _this = this, // jshint ignore:line

        /**
         * @function setCookie
         * @memberof PROJECTNAME.helper
         * @public
         * @param {string} name - Name of the cookie
         * @param {string} value - Value of the cookie
         * @param {string} days - Number of days to expire
         *
         * @example
         * PROJECTNAME.helper.setCookie('cookiename', 'hello world', 99);
         *
         */

        setCookie = function (name, value, days) {
          var date = '',
            expires = '';

          if (days) {
            date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toGMTString();
          }

          document.cookie = name + '=' + value + expires + '; path=/';
        },

        /**
         * @function getCookie
         * @memberof PROJECTNAME.helper
         *
         * @param {string} name - Name of the cookie
         * @return {object} - value of the cookie
         * @example
         *
         * PROJECTNAME.helper.getCookie('cookiename');
         *
         */
        getCookie = function (name) {
          var nameEQ = name + '=',
            i,
            ca = document.cookie.split(';');
          for (i = 0; i < ca.length; i += 1) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
              c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
              return c.substring(nameEQ.length, c.length);
            }
          }
          return null;
        },


        /**
         * @function removeCookie
         * @memberof PROJECTNAME.helper
         * @description
         * Erase or delete cookie from user machine
         * @param {string} name - Name of the cookie
         *
         * @example
         * PROJECTNAME.helper.removeCookie('cookiename');
         *
         */
        removeCookie = function (name) {
          setCookie(name, '', -1);
        };




      this.init = function () {
        return this;
      };

      return this.init();
    }

    return new Helper();
  }());
}(window.PROJECTNAME = window.PROJECTNAME || {}, jQuery));
