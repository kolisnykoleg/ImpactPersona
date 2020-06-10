<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Impact Persona</title>
    <meta property="og:locale" content="en_EN">
    <meta property="og:type" content="article">
    <meta property="og:image:width" content="966">
    <meta property="og:image:height" content="580">
    <meta property="og:image" content="assets/img/og-image.jpg">
    <meta property="og:description" content="">
    <meta property="description" content="">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css?1591609653475"/>
    <link rel="stylesheet" type="text/css" href="assets/css/app.css?1591609653475"/>
    <script>
        {
            let lastWidth = 0;

            function setRealVh() {
                const newWidth = window.innerWidth;
                if (newWidth === lastWidth) return;

                requestAnimationFrame(function() {
                    document.documentElement.style.setProperty('--vh', window.innerHeight * 0.01 + "px")
                });

                lastWidth = newWidth;
            };

            setRealVh();
            window.addEventListener("resize", setRealVh);
        }
    </script>
</head>
<body>
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
                                </svg>Cart summary<span class="Cart-titleLink">(<a href="#edit">Edit</a>)</span>
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
                                <label><span class="Field-label">Country</span>
                                    <select name="country">
                                        <option>Australia</option>
                                        <option>USA</option>
                                        <option>Japan</option>
                                    </select>
                                </label>
                            </div>
                            <div class="Field Field--group">
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
<script src="assets/js/jquery.min.js?1591609653475"></script>
<script src="assets/js/slick.min.js?1591609653475"></script>
<script src="assets/js/jquery.validate.min.js?1591609653475"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.js"></script>
<script src="assets/js/app.js?1591609653475"></script>
</body>
</html>
