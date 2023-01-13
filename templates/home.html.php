<main id="landing-page">
        <div class="row">
            <div class="col s12 center">
                <h1>Hi, I'm Tim.</h1>
                <div class="profile">
                    <a href="#" class="profile" onmouseover="changePic()" onmouseout="normalPic()"><img
                            src="/images/tim.jpg" alt="profile picture" id="profilePic"></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <h2> I'm a recent graduate of The <a href="https://www.northampton.ac.uk/">University of
                        Northampton</a>, </h2>
                <h3>I attained a BEng (First class) in  <a
                        href="https://www.northampton.ac.uk/courses/computing-computer-networks-engineering-beng-hons/">
                        Computer Networks Engineering</a>.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <div class="quote-container">
                    <div class="card center card-opacity-index">
                        <div class="card-image">

                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="header fas fa-quote-left fa-2x"></i>
                                </span>
                                <p id="quote">"Education is the kindling of a flame, not the filling of a vessel."
                                    &emsp;-<em>Socrates</em></p>
                            </div>
                            <div class="card-action">
                                <button id="gen" onclick="genQuote()" aria-label="Generate Quote"><i
                                        class="fas fa-redo-alt"></i></button> &emsp;
                                <button id="tweet" onclick="tweetQuote()" aria-label="Retweet Quote"><i
                                        class="fab fa-twitter"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <div class="clock">
                    <span class="clock-text"></span>
                </div>
            </div>
        </div>
    </main>
