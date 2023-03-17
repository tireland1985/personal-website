<main id="admin-login">
        <div class="row">
            <div class="login-form">
                <div class="info">
                    <h3>Log In:</h3>
                    <?php if(isset($error)): ?>
                        <div class="row">
                            <div class="col s12 m12 center">
                                <div class="errors">
                                    &emsp; <strong><?=$error;?> </strong>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                <div class="row login-me">
                    <div class="card horizontal card-opacity center">
                        <div class="card-stacked">
                            <form onsubmit="return(validateForm());" action="/login/auth" method="post" class="col s8 m8 center" id="login-form" name="loginForm">
                                <div class="row col s12">
                                    <div class="input-field col s8 center">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input type="email" id="username" class="validate white-text" name="username">
                                        <label for="username" class="white-text" data-error="wrong" data-success="right">Email</label>

                                    </div>
                                </div>
                                <div class="row col s12">
                                    <div class="input-field col s8 center">
                                        <i class="material-icons prefix">key</i>
                                        <input type="password" class="white-text" id="password" name="password">
                                        <label for="password" class="white-text">Password</label>

                                    </div>
                                </div>
                                <div class="row col s8 m8 center">
                                    <input type="hidden" name="login_token" value="<?= $_SESSION['login_token'] ?? '' // basic CSRF protection  ?>"> 
                                    <button type="submit" name="submit">Log In &nbsp;<i class="material-icons white-text">send</i></button>
                                </div>
                                    
                               
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</main>