"use strict";

jQuery(function ($) {
    var checkoutForm = document.querySelector(".Checkout");
    if (!checkoutForm) return; // Braintree drop-in init

    setTimeout(() => {
    braintree.dropin.create({
        authorization: braintreeToken,
        selector: "#dropin-container",
        paymentOptionPriority: ['paypal'],
        paypal: {
            flow: 'checkout',
            amount: $('#cartTotal').text(),
            currency: $('select[name=Country]').val() === 'AU' ? 'AUD' : 'USD'
        },
    }, function (createErr, instance) {
        if (createErr) {
            console.log(createErr);
            return;
        }

        $(checkoutForm).validate({
            errorElement: "span",
            submitHandler: function submitHandler(form) {
                instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                    if (requestPaymentMethodErr) {
                        console.log(requestPaymentMethodErr);
                        return;
                    } // Ready to send data
                    // Form data: $(form).serialize();
                    // Payment token: payload.nonce
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'nonce',
                        value: payload.nonce,
                    }).appendTo(form);
                    form.submit();
                });
            }
        });
    });
    }, 1000);
});
jQuery(function ($) {
    var sliderContent = $(".Slider--survey .Slider-content");
    sliderContent.slick({
        autoplay: false,
        draggable: false,
        swipe: false,
        touchMove: false,
        arrows: false,
        infinite: false
    });
    var btnNext = $(".Survey-control--next");
    var btnEnd = $(".Survey-control--end");
    var progressBar = $(".Survey-progressDone");
    var currentStep = $(".Survey-progressStepCurrent");
    $(".Survey-controls").on("click", function (e) {
        var target = $(e.target).closest("button");
        if (target.length === 0) return;

        if ($(target).hasClass("Survey-control--next") && $(target).prop("disabled") === false) {
            $(sliderContent).slick("slickNext");
        }
    });
    $(sliderContent).on("beforeChange", function (event, slick, currentSlide, nextSlide) {
        $(btnNext).prop("disabled", true);
        $(btnEnd).prop("disabled", true);
        $(currentStep).text(nextSlide + 1);
        $(progressBar).css("width", 100 / slick.slideCount * (nextSlide + 1) + "%");
    });
    $(sliderContent).on("afterChange", function (event, slick, currentSlide) {
        if (currentSlide === slick.slideCount - 1) {
            $(btnNext).addClass("is-hidden");
            $(btnEnd).removeClass("is-hidden");
        }
    });
});
jQuery(function ($) {
    var screens = $(".Survey-tab");
    var controls = $(".Survey-control");

    var disableControls = function disableControls() {
        controls.each(function (_idx, control) {
            $(control).prop("disabled", true);
        });
    };

    var enableControls = function enableControls() {
        controls.each(function (_idx, control) {
            $(control).prop("disabled", false);
        });
    };

    var validateChecked = function validateChecked(groups) {
        var groupsArray = $.map(groups, function (group) {
            return [group];
        });
        return groupsArray.every(function (group) {
            return group.some(function (radio) {
                return radio.checked;
            });
        });
    };

    if (screens.length) {
        var progressBar = $(".Survey-progressDone");
        var stepsTotal = $(".Survey-progressStepsTotal");
        $(progressBar).css("width", 100 / screens.length + "%");
        $(stepsTotal).text(screens.length);
        $(screens).each(function (_idx, screen) {
            var radios = $(screen).find("input[type=radio]");
            if (!radios.length) return;
            var radiosGroups = $.makeArray(radios).reduce(function (result, el) {
                var name = el.getAttribute("name");

                if (!result[name]) {
                    result[name] = [];
                }

                result[name].push(el);
                return result;
            }, {});
            $(radios).each(function (_idx, radio) {
                radio.addEventListener("change", function () {
                    var siblingRadios = $(radio).closest(".Survey-line").find("input[type=radio]");
                    $(siblingRadios).each(function (_idx, siblingRadio) {
                        if (siblingRadio === radio) return;
                        siblingRadio.checked = false;
                    });
                    validateChecked(radiosGroups) ? enableControls() : disableControls();
                });
            });
        });
    }
});

$(function () {
    renderCart();

    $('select[name=Country], select[name=australian_state], select[name=australian_suburb]').select2();

    $('select[name=Country]').change(function () {
        if (this.value === 'AU') {
            $('#australianLocation').slideDown();
            $('#otherLocation').hide();
        } else {
            $('#otherLocation').slideDown();
            $('#australianLocation').hide();
        }

        $.post('/cart/currency', {country: this.value}, renderCart);
    });

    $('select[name=australian_state]').change(function () {
        $.post('/locations/get-australian-suburbs', {state_id: this.value}, function (options) {
            $('select[name=australian_suburb]')
            .html(options)
            .select2();
        });
    });

    $(document).on('click', '.cart-delete', function () {
        let id = $(this).data('id');
        let country = $('select[name=Country]').val();
        $.post('/cart/delete', {id, country}, renderCart);
    });

});

function renderCart() {
    $.post('/cart/get', function(html) {
        $('#cart').html(html);
    });
}
