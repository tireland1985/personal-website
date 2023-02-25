<main id="cv-page">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <div class="row">
            <div class="col s12 m12 center">
                <h1>Skills</h1>
                <h2>Click a skill for details</h2>
            <a href="#skills-modal-test" class="btn modal-trigger waves-effect waves-light cv-skill" id="">Cisco IOS</a>
				
			   <div id="skills-modal-test" class="modal cv-skill">
                    <div class="modal-content cv-skill white-text">
                        <h4>Cisco IOS</h4>
                        <p>Experience with IOS 15 through simulators, emulators and real equipment.</p>
                    </div>
                <div class="modal-footer cv-skill">
                    <a href="#!" class="modal-action modal-close btn blue darken-4 white-text">Close</a>
                </div>
            </div>
    <script>
		$(document).ready(function(){
			//initialise all modals
			$('.modal').modal();
			
			//open modal automatically
			//$('#skills-modal-test').modal('open');
			
			//load modal on click
			$('.trigger-modal').modal();
  });
    </script>
            </div>
        </div>

</main>