"use strict";jQuery(function(e){var n=document.querySelector(".Checkout");n&&braintree.dropin.create({authorization:"sandbox_g42y39zw_348pk9cgf3bgyw2b",selector:"#dropin-container"},function(t,r){t?console.log(t):e(n).validate({errorElement:"span",submitHandler:function(e){r.requestPaymentMethod(function(e,n){e&&console.log(e)})}})})}),jQuery(function(e){var n=e(".Slider--survey .Slider-content");n.slick({autoplay:!1,draggable:!1,swipe:!1,touchMove:!1,arrows:!1,infinite:!1});var t=e(".Survey-control--next"),r=e(".Survey-control--end"),o=e(".Survey-progressDone"),i=e(".Survey-progressStepCurrent");e(".Survey-controls").on("click",function(t){var r=e(t.target).closest("button");0!==r.length&&e(r).hasClass("Survey-control--next")&&!1===e(r).prop("disabled")&&e(n).slick("slickNext")}),e(n).on("beforeChange",function(n,c,u,a){e(t).prop("disabled",!0),e(r).prop("disabled",!0),e(i).text(a+1),e(o).css("width",100/c.slideCount*(a+1)+"%")}),e(n).on("afterChange",function(n,o,i){i===o.slideCount-1&&(e(t).addClass("is-hidden"),e(r).removeClass("is-hidden"))})}),jQuery(function(e){var n=e(".Survey-tab"),t=e(".Survey-control");if(n.length){var r=e(".Survey-progressDone"),o=e(".Survey-progressStepsTotal");e(r).css("width",100/n.length+"%"),e(o).text(n.length),e(n).each(function(n,r){var o=e(r).find("input[type=radio]");if(o.length){var i=e.makeArray(o).reduce(function(e,n){var t=n.getAttribute("name");return e[t]||(e[t]=[]),e[t].push(n),e},{});e(o).each(function(n,r){r.addEventListener("change",function(){var n,o=e(r).closest(".Survey-line").find("input[type=radio]");e(o).each(function(e,n){n!==r&&(n.checked=!1)}),n=i,e.map(n,function(e){return[e]}).every(function(e){return e.some(function(e){return e.checked})})?t.each(function(n,t){e(t).prop("disabled",!1)}):t.each(function(n,t){e(t).prop("disabled",!0)})})})}})}});