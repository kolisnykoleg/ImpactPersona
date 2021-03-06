<?php
$not_manually = !isset($manually);
?>
<div class="Page g g--dirCol">
    <div class="Page-fixed pv-s g-b fbAuto">
        <div class="c"><img src="/assets/img/logo.png"></div>
    </div>
    <div class="Page-content bg-g95 pv-xl g-b g-b--w1 fbAuto">
        <div class="c">
            <div class="g g--wrap g--gutterM">
                <?php if ($not_manually): ?>
                <div class="Page-contentCart g-b g-b--order1@l fb1/1 fb1/2@l">
                    <div class="Cart">
                        <div class="Cart-content pt-m">
                            <h2 class="Cart-title mb-m ph-m">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                                    <path d="M405 363a64 64 0 101 127 64 64 0 00-1-127zm0 89a26 26 0 110-51 26 26 0 010 51zM508 116c-4-5-9-7-15-7H118l-17-73c-2-8-10-14-19-14H19a19 19 0 100 38h48l62 260c3 9 10 15 19 15h298c9 0 17-6 19-14l46-189c2-5 1-11-3-16zm-77 181H163l-36-150h341l-37 150zM174 363a64 64 0 100 127 64 64 0 000-127zm0 89a26 26 0 110-51 26 26 0 010 51z"></path>
                                </svg>
                                Cart summary<span class="Cart-titleLink"></span>
                            </h2>
                            <div id="cart"></div>
                        </div>
                        <div class="Cart-helper mt-xs">
<!--
                            <p>Need help with your order?</p>
                            <p>Hotline: <b><a href="tel: +31 333 0140">+31 333 0140</a></b> (international)</p>
-->
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="Page-contentCheckout g-b fb1/1 fb1/2@l">
                    <form class="Checkout" method="post" action="/checkout/<?php echo $not_manually ? 'purchase' : 'manually-purchase'; ?>" novalidate>
                        <div class="Checkout-block mb-xl">
                            <h2 class="mb-m">Billing details</h2>
                            <div class="Field Field--group">
                                <div class="mt-0 g g--wrap g--gutterS">
                                    <div class="pt-0 g-b fb1/1 fb1/2@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">First name</span>
                                                <input type="text" name="Firstname" placeholder="Enter your first name" required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt-0 g-b fb1/1 fb1/2@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">Last name</span>
                                                <input type="text" name="Surname" placeholder="Enter your last name" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Field Field--typeTextfield">
                                <label><span class="Field-label">Email address</span>
                                    <input type="email" name="Email" required>
                                </label>
                            </div>
                            <div class="Field Field--typeTextfield">
                                <label><span class="Field-label">Phone number</span>
                                    <input type="tel" name="Phone" required>
                                </label>
                            </div>
                            <div class="Field Field--typeSelect">
                                <label>
                                    <span class="Field-label">Country</span>
                                    <select name="Country" data-placeholder="Select country">
                                        <option></option>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?= $country->Code ?>"><?= $country->Name ?></option>
                                        <?php endforeach; ?>
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
                                                <input type="text" name="State">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt-0 g-b fb1/1 fb1/3@l">
                                        <div class="Field Field--typeTextfield">
                                            <label><span class="Field-label">Zip / Postal code</span>
                                                <input type="text" name="Zip">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Field mt-m">
                                <h2 class="mb-xxs">Report Details</h2>
                                <input type="checkbox" name="report_details" id="report_details">
                                <label for="report_details">The name on the report and email address it will be sent to are the same as the billing
                                    details.</label>
                            </div>
                            <div class="Field" id="report_data">
                                <div class="Field">
                                    <div class="mt-0 g g--wrap g--gutterS">
                                        <div class="pt-0 g-b fb1/1 fb1/2@l">
                                            <div class="Field Field--typeTextfield">
                                                <label><span class="Field-label">First name</span>
                                                    <input type="text" name="report_firstname">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="pt-0 g-b fb1/1 fb1/2@l">
                                            <div class="Field Field--typeTextfield">
                                                <label><span class="Field-label">Last name</span>
                                                    <input type="text" name="report_surname">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Field Field--typeTextfield">
                                    <label><span class="Field-label">Email address</span>
                                        <input type="email" name="report_email">
                                    </label>
                                </div>
                            </div>
                            <div class="Field">
                                <input type="checkbox" name="terms_conditions" id="terms_conditions" required>
                                <label for="terms_conditions">I Agree to the <a
                                        href="https://www.impactpersona.com.au/terms-conditions-and-privacy-policy" target="_blank">Terms, Conditions
                                        and Privacy Statement</a> of Impact Persona</label>
                            </div>
                        </div>
                        <div class="Checkout-block">
                            <?php if ($not_manually): ?>
                                <h2 class="mb-xxs">Payment method</h2>
                                <div id="dropin-container"></div>
                            <?php else: ?>
                                <div class="Field Field--typeSelect">
                                    <label><span class="Field-label">Questionnaire</span>
                                        <select name="Questionnaire" data-placeholder="Select questionnaire" data-minimum-results-for-search="-1">
                                            <?php foreach ($assessments as $assessment): ?>
                                                <option value="<?= $assessment->ID ?>"><?= $assessment->Name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="Field Field--typeTextfield">
                                    <label><span class="Field-label">Price</span>
                                        <input type="text" name="Price" placeholder="Enter price" required>
                                    </label>
                                </div>
                            <?php endif; ?>
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

<script>
    let braintreeToken = '<?= $token ?>';
</script>
