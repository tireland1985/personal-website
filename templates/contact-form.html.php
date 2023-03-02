<?php 

    if(isset($_POST['submit'])){
                    //filter and sanitize provided data - ensure the phone number (if provided) contains only numbers
                    $args = array(
                        'name' => FILTER_SANITIZE_STRING,
                        'phone' => preg_replace('/[^0-9]/', '', $_POST['phone']),
                        'email' => FILTER_SANITIZE_EMAIL,
                        'message' => FILTER_SANITIZE_STRING
                    );
        
                    //populate 'data' array with sanitized information from POST array
                    $data = filter_input_array(INPUT_POST, $args);
    }
	?>
<main id="contacts-page">
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
                <!-- <script>alert("E-Mails sent using this form are not currently being received. In the mean time, please use the email address listed. Apologies for the inconvenience");</script> -->
                <div class="row contact-me">
                    <h3>E-mail Me</h3>
                    <div class="card horizontal card-opacity center">
                        <div class="card-stacked">
                            <!-- form uses validateForm() function to check data inputs to name, email & message fields. -->
                            <!-- also checks that email address entered appears to be a valid format -->
                            <form class="col s12" id="contact-me" name="contactForm" onsubmit="return(validateForm());" action="/contact/form" method="post">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input placeholder="Enter your name" id="name" type="text" class="validate white-text" name="name" value="<?php echo isset($_POST['name']) ? $data['name'] : ''; // prevent removing value from the form after failed sending ?>" required oninvalid="this.setCustomValidity('Input your name')" oninput="setCustomValidity('')">
                                        <label for="name" class="white-text">Name</label>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">email</i>
                                        <input type="email" class="validate white-text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $data['email'] : ''; // prevent removing value from the form after failed sending ?>" required>
                                        <label for="email" class="white-text" data-error="wrong" data-success="right">Email</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">call</i>
                                        <input type="tel" class="validate white-text" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $data['phone'] : ''; // value for 'phone' is validated/ sanitized on back-end ?>">
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
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' // basic CSRF protection ?>"> 
                                <button type="submit" name="submit">Submit &nbsp;<i class="material-icons white-text">send</i></button>
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