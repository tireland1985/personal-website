<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio website landing page">
    <meta name="theme-color" content="#3d445c">
    <title>Tim Ireland - <?=$title;?></title>

    <link rel="manifest" href="/manifest.json">
    <!-- link to Google fonts (Material Icons)-->
    <link rel="dns-prefetch preconnect" href="https://fonts.googleapis.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">

    <!-- link to Materialize CSS Library via CDN -->
    <link rel="dns-prefetch preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- link to local stylesheet(s) -->
    <link rel="stylesheet" href="stylesheets/common.min.css">
		<?php if($title == 'Home'){ ?>
    <link rel="stylesheet" href="stylesheets/index.min.css">
		<?php } else if ($title == 'CV'){ ?>
    <link rel="stylesheet" href="stylesheets/cv.min.css">
		<?php } else if($title == 'Portfolio'){ ?>
    <link rel="stylesheet" href="stylesheets/portfolio.min.css">
		<?php } else if ($title == 'Contacts'){ ?>
    <link rel="stylesheet" href="stylesheets/contact.min.css">
    <?php }
    ?>
    <link rel="dns-prefetch" href="https://kit.font-awesome.com">

    <!-- favicon section -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body>
    <header>
        <div class="navbar-fixed">
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="/cv/overview">Overview</a></li>
                <li><a href="/cv/education">Education</a></li>
                <li><a href="/cv/pro-exp">Professional Experience</a></li>
                <li><a href="/cv/other-exp">Other Experience</a></li>
                <li><a href="/cv/skills">Skills</a></li>
                <li><a href="/download.php?download_file=Tim-Ireland-CV.pdf">Download</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo"><img src="/favicon-32x32.png" alt="Logo"></a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <?php if($title = 'Home'){ ?>
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/portfolio/projects">Portfolio</a></li>
                        <li><a href="/contact/form">Contact</a></li>
                        <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <?php } else if ($title = 'Portfolio'){ ?>
                        <li><a href="/">Home</a></li>
                        <li class="active"><a href="/portfolio/projects">Portfolio</a></li>
                        <li><a href="/contact/form">Contact</a></li>
                        <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <?php } else if ($title = 'CV'){ ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/portfolio/projects">Portfolio</a></li>
                        <li><a href="/contact/form">Contact</a></li>
                        <li class="active"><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <?php } else if ($title = 'Contact'){ ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/portfolio/projects">Portfolio</a></li>
                        <li class="active"><a href="/contact/form">Contact</a></li>
                        <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <?php } else { ?>
                        <li><a href="/">Home</a></li>
                        <li><a href="/portfolio/projects">Portfolio</a></li>
                        <li><a href="/contact/form">Contact</a></li>
                        <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="sidenav" id="mobile-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/portfolio/projects">Portfolio</a></li>
            <li><a href="/contact/form">Contact</a></li>
            <li><a href="/cv/overview">CV</a></li>
        </ul>
    </header>
    <?=$output?>

    <footer class="page-footer">
        <div class="row">
            <div class="col s12 center">
                <a href="https://github.com/tireland1985" aria-label="GitHub"><i
                    class="fab fa-github fa-2x"></i></a>&emsp;
            <a href="https://www.linkedin.com/in/tim-ireland-51508b196/" aria-label="LinkedIn"><i
                    class="fab fa-linkedin fa-2x"></i></a>&emsp;
            <a href="https://twitter.com/timirelanduk" aria-label="Twitter"><i
                    class="fab fa-twitter-square fa-2x"></i></a> &emsp;
            <a href="https://codepen.io/tireland1985" aria-label="Codepen.io"><i
                    class="fab fa-codepen fa-2x"></i></a> &emsp;
            <!-- email obfuscator - https://www.albionresearch.com/misc/obfuscator.php -->
            <a href='mail&#116;o&#58;tim&#64;t%69%&#54;&#68;ir&#101;&#108;%61%&#54;&#69;%&#54;4&#46;uk'
                aria-label="email"><i class="fas fa-envelope fa-2x"></i></a>
            <br>
            <p>&copy; 2020 - <?=date('Y');?></p>
            </div>
        </div>
        <!-- Install button, hidden by default -->
    <div id="installContainer" class="hidden">
        <button id="butInstall" type="button">
          Install
        </button>
      </div>
      <p id="requireHTTPS" class="hidden" style="text-align: center;">
        <b>STOP!</b> This page <b>must</b> be served over HTTPS.
        Please <a>reload this page via HTTPS</a>.
      </p>
    </footer>



    <!-- Link to jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- Link to Materialize JavaScript CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- local materialize js/ jQuery -->
    <script src="scripts/plugins.min.js"></script>

    	<?php if ($title == 'Home'){ ?>
	<script src="scripts/index.min.js" defer></script>
		<?php } else if ($title == 'CV') { ?>
	<script src="scripts/skills-list.js"></script>
		<?php } else if ($title == 'Portfolio'){ ?>
	<script src="scripts/lazyload.min.js"></script>
	<?php }
	?>
    <script src="scripts/pwa.js" defer></script>

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/49d5ff7e71.js" crossorigin="anonymous"></script>
</body>

</html>