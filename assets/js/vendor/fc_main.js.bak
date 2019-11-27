"use strict";
/* initiate */
if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.MetroAP = {};
$.MetroAP.options = {
    dropdownMenu: {
        effectIn: 'fadeIn',
        effectOut: 'fadeOut'
    }
}
//==========================================================================================================================

/* Input - Function ========================================================================================================
*  You can manage the inputs(also textareas) with name of class 'form-control'
*  
*/
$.MetroAP.input = {
    init: function () {
        //On focus event
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $('body').on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });
    }
}
//==========================================================================================================================

/* Form - Select - Function ================================================================================================
*  You can manage the 'select' of form elements
*  
*/
$.MetroAP.select = {
    init: function () {
        if ($.fn.selectpicker) { $('select:not(.ms)').selectpicker(); }
    }
}
//==========================================================================================================================

/* DropdownMenu - Function =================================================================================================
*  You can manage the dropdown menu
*  
*/

$.MetroAP.dropdownMenu = {
    init: function () {
        var _this = this;

        $('.dropdown, .dropup, .btn-group').on({
            "show.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                _this.dropdownEffectStart(dropdown, dropdown.effectIn);
            },
            "shown.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectIn && dropdown.effectOut) {
                    _this.dropdownEffectEnd(dropdown, function () { });
                }
            },
            "hide.bs.dropdown": function (e) {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectOut) {
                    e.preventDefault();
                    _this.dropdownEffectStart(dropdown, dropdown.effectOut);
                    _this.dropdownEffectEnd(dropdown, function () {
                        dropdown.dropdown.removeClass('open');
                    });
                }
            }
        });

        //Set Waves
        Waves.attach('.dropdown-menu li a', ['waves-block']);
        Waves.init();
    },
    dropdownEffect: function (target) {
        var effectIn = $.MetroAP.options.dropdownMenu.effectIn, effectOut = $.MetroAP.options.dropdownMenu.effectOut;
        var dropdown = $(target), dropdownMenu = $('.dropdown-menu', target);

        if (dropdown.size() > 0) {
            var udEffectIn = dropdown.data('effect-in');
            var udEffectOut = dropdown.data('effect-out');
            if (udEffectIn !== undefined) { effectIn = udEffectIn; }
            if (udEffectOut !== undefined) { effectOut = udEffectOut; }
        }

        return {
            target: target,
            dropdown: dropdown,
            dropdownMenu: dropdownMenu,
            effectIn: effectIn,
            effectOut: effectOut
        };
    },
    dropdownEffectStart: function (data, effectToStart) {
        if (effectToStart) {
            data.dropdown.addClass('dropdown-animating');
            data.dropdownMenu.addClass('animated dropdown-animated');
            data.dropdownMenu.addClass(effectToStart);
        }
    },
    dropdownEffectEnd: function (data, callback) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        data.dropdown.one(animationEnd, function () {
            data.dropdown.removeClass('dropdown-animating');
            data.dropdownMenu.removeClass('animated dropdown-animated');
            data.dropdownMenu.removeClass(data.effectIn);
            data.dropdownMenu.removeClass(data.effectOut);

            if (typeof callback == 'function') {
                callback();
            }
        });
    }
}
//==========================================================================================================================

/* Browser - Function ======================================================================================================
*  You can manage browser
*  
*/
var edge = 'Microsoft Edge';
var ie10 = 'Internet Explorer 10';
var ie11 = 'Internet Explorer 11';
var opera = 'Opera';
var firefox = 'Mozilla Firefox';
var chrome = 'Google Chrome';
var safari = 'Safari';

$.MetroAP.browser = {
    init: function () {
        var _this = this;
        var className = _this.getClassName();

        if (className !== '') $('html').addClass(_this.getClassName());
    },
    getBrowser: function () {
        var userAgent = navigator.userAgent.toLowerCase();

        if (/edge/i.test(userAgent)) {
            return edge;
        } else if (/rv:11/i.test(userAgent)) {
            return ie11;
        } else if (/msie 10/i.test(userAgent)) {
            return ie10;
        } else if (/opr/i.test(userAgent)) {
            return opera;
        } else if (/chrome/i.test(userAgent)) {
            return chrome;
        } else if (/firefox/i.test(userAgent)) {
            return firefox;
        } else if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) {
            return safari;
        }

        return undefined;
    },
    getClassName: function () {
        var browser = this.getBrowser();

        if (browser === edge) {
            return 'edge';
        } else if (browser === ie11) {
            return 'ie11';
        } else if (browser === ie10) {
            return 'ie10';
        } else if (browser === opera) {
            return 'opera';
        } else if (browser === chrome) {
            return 'chrome';
        } else if (browser === firefox) {
            return 'firefox';
        } else if (browser === safari) {
            return 'safari';
        } else {
            return '';
        }
    }
}

/* end */

/* jquery validate - global handle */
$.MetroAP.validator = {
    init: function () {
		$.validator.setDefaults({ 
			highlight: function (input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.input-group').append(error);
				$(element).parents('.form-group').append(error);
			},
			invalidHandler: function(form, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {                    
					validator.errorList[0].element.focus();
				}
			} 
		});
    }
}

$.MetroAP.additionalMethod = {
    init: function () {
		$.fn.removeClassPrefix = function(prefix) {
			this.each(function(i, it) {
				var classes = it.className.split(" ").map(function(item) {
				   return item.indexOf(prefix) === 0 ? "" : item;
				});
				it.className = classes.join(" ");
			});
			return this;
		}
		
		$('input[type=text], input[type=number], input[type=password]').each(function() {
			if ($(this).val() != '') {
				var group = $(this).closest('.form-group');
				if (group.hasClass('form-float')) $(this).closest('.form-line').removeClass('error').addClass('focused');
			}
		});	
		
		/* ajax global error handling */
		$(document).ajaxError(function(event, jqXHR, ajaxOptions, thrownError) {
			swal({ title:"[ ERROR - " + jqXHR.status + " ]", text:"Something weird happened!<br>Please refresh your page (CTRL + F5) and try again..", type:"error", html:true });
			console.log(ajaxOptions.url);
		});
    }
}

$(function () {
	
	$.MetroAP.browser.init();
    $.MetroAP.dropdownMenu.init();
    $.MetroAP.select.init();
    $.MetroAP.input.init();
    $.MetroAP.validator.init();
    $.MetroAP.additionalMethod.init();
    
    setTimeout(function() { $('.page-loader-wrapper').fadeOut(); }, 50);	
});

//Google Analytics ======================================================================================
// addLoadEvent(loadTracking);
// var trackingId = 'UA-30038099-6';

// function addLoadEvent(func) {
    // var oldonload = window.onload;
    // if (typeof window.onload != 'function') {
        // window.onload = func;
    // } else {
        // window.onload = function () {
            // oldonload();
            // func();
        // }
    // }
// }

// function loadTracking() {
    // (function (i, s, o, g, r, a, m) {
        // i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            // (i[r].q = i[r].q || []).push(arguments)
        // }, i[r].l = 1 * new Date(); a = s.createElement(o),
        // m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    // })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    // ga('create', trackingId, 'auto');
    // ga('send', 'pageview');
// }
//========================================================================================================