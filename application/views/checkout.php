<div class="Page g g--dirCol">
    <div class="Page-fixed pv-s g-b fbAuto">
        <div class="c"><img src="assets/img/logo.png"></div>
    </div>
    <div class="Page-content bg-g95 pv-xl g-b g-b--w1 fbAuto">
        <div class="c">
            <div class="g g--wrap g--gutterM">
                <div class="Page-contentCart g-b g-b--order1@l fb1/1 fb1/2@l">
                    <div class="Cart">
                        <div class="Cart-content pt-m">
                            <h2 class="Cart-title mb-m ph-m">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                                    <path d="M405 363a64 64 0 101 127 64 64 0 00-1-127zm0 89a26 26 0 110-51 26 26 0 010 51zM508 116c-4-5-9-7-15-7H118l-17-73c-2-8-10-14-19-14H19a19 19 0 100 38h48l62 260c3 9 10 15 19 15h298c9 0 17-6 19-14l46-189c2-5 1-11-3-16zm-77 181H163l-36-150h341l-37 150zM174 363a64 64 0 100 127 64 64 0 000-127zm0 89a26 26 0 110-51 26 26 0 010 51z"></path>
                                </svg>
                                Cart summary<span class="Cart-titleLink">(<a href="#edit">Edit</a>)</span>
                            </h2>
                            <div class="ph-m">
                                <div class="Cart-item pb-s">
                                    <h3 class="g"><span>1 x Maker The Agency Theme</span><span class="Cart-itemPrice">$49.89</span></h3>
                                    <p>Amazing UI Kit pack perfect for your next project</p>
                                </div>
                                <div class="Cart-item pb-s">
                                    <h3 class="g"><span>1 x Maker The Agency Theme</span><span class="Cart-itemPrice">$49.89</span></h3>
                                    <p>Amazing UI Kit pack perfect for your next project</p>
                                </div>
                            </div>
                            <div class="Cart-summary pv-xs ph-m">Sub total: <b>$102.44</b></div>
                        </div>
                        <div class="Cart-helper mt-xs">
                            <p>Need help with your order?</p>
                            <p>Hotline: <b><a href="tel: +31 333 0140">+31 333 0140</a></b> (international)</p>
                        </div>
                    </div>
                </div>
                <div class="Page-contentCheckout g-b fb1/1 fb1/2@l">
                    <form class="Checkout" method="post" action="" novalidate>
                        <div class="Checkout-block mb-xl">
                            <h2 class="mb-m">Billing details</h2>
                            <div class="Field Field--group">
                                <div class="mt-0 g g--wrap g--gutterS">
                                    <div class="pt-0 g-b fb1/1 fb1/2@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">First name</span>
                                                <input type="text" name="First name" placeholder="Enter your first name" required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt-0 g-b fb1/1 fb1/2@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">Last name</span>
                                                <input type="text" name="Last name" placeholder="Enter your last name" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Field Field--typeTextfield">
                                <label><span class="Field-label">Email address</span>
                                    <input type="email" name="email" required>
                                </label>
                            </div>
                            <div class="Field Field--typeTextfield">
                                <label><span class="Field-label">Phone number</span>
                                    <input type="tel" name="phone" required>
                                </label>
                            </div>
                            <div class="Field Field--typeSelect">
                                <label>
                                    <span class="Field-label">Country</span>
                                    <select name="country" data-placeholder="Select country" data-minimum-results-for-search="-1">
                                        <option></option>
                                        <option>Australia</option>
                                        <option>USA</option>
                                        <option>Japan</option>
                                    </select>
                                </label>
                            </div>
                            <div class="Field Field--group" id="australianLocation">
                                <div class="Field Field--typeSelect">
                                    <label><span class="Field-label">State</span>
                                        <select name="australian_state" data-placeholder="Select state" data-minimum-results-for-search="-1">
                                            <option></option>
                                            <?php foreach ($australian_states as $state): ?>
                                                <option value="<?= $state->ID ?>"><?= $state->Long_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="Field Field--typeSelect">
                                    <label><span class="Field-label">Suburb</span>
                                        <select name="australian_suburb" data-placeholder="Select suburb">
                                            <option></option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="Field Field--group" id="otherLocation">
                                <div class="mt-0 g g--wrap g--gutterS">
                                    <div class="pt-0 g-b fb1/1 fb2/3@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">State / County</span>
                                                <input type="text" name="state">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt-0 g-b fb1/1 fb1/3@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">Zip / Postal code</span>
                                                <input type="text" name="zip">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Checkout-block">
                            <h2 class="mb-xxs">Payment method</h2>
                            <div id="dropin-container"></div>
                            <div class="mt-m">
                                <button class="Btn" id="submit-button">Purchase</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #australianLocation,
    #otherLocation {
        display: none;
    }

    .Field--typeSelect label:after {
        display: none;
    }

    .select2-container--below,
    [data-select2-id] {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 0;
        width: 100%;
        height: 4.2rem;
        padding: 0 1.5rem;
        border: 1px solid #d9d9d9;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 4rem;
        padding: 0;
        color: #000;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 4.2rem;
        width: 30px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(function () {
            $('select[name=country], select[name=australian_state], select[name=australian_suburb]').select2();

            $('select[name=country]').change(function () {
                if (this.value === 'Australia') {
                    $(australianLocation).slideDown();
                    $(otherLocation).hide();
                } else {
                    $(otherLocation).slideDown();
                    $(australianLocation).hide();
                }
            });

            $('select[name=australian_state]').change(function () {
                $.post('/locations/get-australian-suburbs', {state_id: this.value}, function (options) {
                    $('select[name=australian_suburb]')
                    .html(options)
                    .select2();
                });
            });
        });
    });
</script>
