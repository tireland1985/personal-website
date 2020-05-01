<?php require 'scripts/mail.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio website landing page">
    <title>Tim Ireland</title>
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
    <link rel="stylesheet" href="stylesheets/contact.min.css">

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
                <li><a href="/cv.html">CV</a></li>
                <li><a href="/cv.html#education">Education</a></li>
                <li><a href="/cv.html#pro-exp">Professional Experience</a></li>
                <li><a href="/cv.html#other-exp">Other Experience</a></li>
                <li><a href="/cv.html#skills">Skills</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo"><img src="/favicon-32x32.png" alt="Logo"></a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="/index.html">Home</a></li>
                        <li><a href="/portfolio.html">Portfolio</a></li>
                        <li class="active"><a href="/contact.php">Contact</a></li>
                        <li><a href="#!" class="dropdown-trigger" data-target="dropdown1">CV <i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="sidenav" id="mobile-nav">
            <li><a href="/index.html">Home</a></li>
            <li><a href="/portfolio.html">Portfolio</a></li>
            <li class="active"><a href="/contact.php">Contact</a></li>
            <li><a href="/cv.html">CV</a></li>
        </ul>
    </header>
    <main>
        <!-- Material Forms: https://materializecss.com/text-inputs.html viewed: 15/03/2020, some aspects from Assignment 1 modified. -->
        <div class="row">
            <div class="contact-form">
                <div class="info">
                    <h3>Tim Ireland</h3>
                    <ul class="ul_form">
                        <li><i class="white-text fa fa-road"></i>&nbsp;&nbsp;Milton Keynes</li>
                        <li><i
                                class="white-text fa fa-envelope"></i>&nbsp;&nbsp;&#116;im&#64;timire&#108;a&#110;&#100;&#46;u&#107;
                        </li>
                    </ul>
                </div>
                <div class="row contact-me">
                    <h3>E-mail Me</h3>
                    <div class="card horizontal card-opacity center">
                        <div class="card-stacked">
                            <!-- form uses validateForm() function to check data inputs to name, email & message fields. -->
                            <!-- also checks that email address entered appears to be a valid format -->
                            <form class="col s12" id="contact-me" name="contactForm" onsubmit="return(validateForm()); action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <!-- form has no action element currently. I have found a PHP script to deal with submission/sending the form, but this seemed outside the scope of the assignment. -->
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input placeholder="Enter your name" id="name" type="text" class="validate white-text" name="name" value="<?php echo isset($_POST['name']) ? $data['name'] : ''; // prevent removing value from the form after failed sending ?>" required oninvalid="this.setCustomValidity('Input your name')" oninput="setCustomValidity('')">
                                        <label for="name" class="white-text">Name</label>
                                    </div>
                                    <!--removed - no need for name to be in separate fields <div class="input-field col s6">
                        <input type="text" class="validate" id="last_name" name="last">
                        <label for="last_name" class="white-text">Last Name</label>
                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">email</i>
                                        <input type="email" class="validate white-text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $data['email'] : ''; // prevent removing value from the form after failed sending ?>" required>
                                        <label for="email" class="white-text" data-error="wrong" data-success="right">Email</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">call</i>
                                        <input type="tel" class="validate white-text" id="phone">
                                        <label for="phone" class="white-text">Telephone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea id="textarea2" class="materialize-textarea white-text validate" name="message" data-length="120" required oninvalid="this.setCustomValidity('Input your message')" oninput="setCustomValidity('')"><?php echo isset($_POST['message']) ? $data['message'] : ''; ?></textarea>
                                        <label for="textarea2" class="white-text">Message</label>
                                    </div>
                                </div>
                                <button type="submit">Submit &nbsp;<i class="material-icons white-text">send</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 center">
                <span id="date-time"></span>
            </div>
        </div>
    </main>
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
                <p>&copy; 2020</p>
            </div>
        </div>
    </footer>



    <!-- Link to jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- Link to Materialize JavaScript CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- local materialize js/ jQuery -->
    <script src="scripts/plugins.min.js"></script>

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/49d5ff7e71.js" crossorigin="anonymous"></script>
</body>

</html>