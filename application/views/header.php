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
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/app.css"/>
    <script>
        {
            let lastWidth = 0;

            function setRealVh() {
                const newWidth = window.innerWidth;
                if (newWidth === lastWidth) return;

                requestAnimationFrame(function () {
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
