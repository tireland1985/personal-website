<?php if($view == 'all'): ?>
                   <h1 class="center">Projects Overview:</h1> 
                   <p class="center">
                        <a href="/portfolio/personalProjects">Personal Projects</a> &emsp;
                        <a href="/portfolio/universityProjects">University Projects</a> &emsp;
                    </p>
            <?php   endif; 
            if($view =='personal'): ?>
                <h1 class="center">Personal Projects:</h1>
                <p class="center">
                    <a href="/portfolio/projects">All Projects</a> &emsp;
                    <a href="/portfolio/universityProjects">University Projects</a> &emsp;
                </p>
            <?php endif;
            if($view == 'university'): ?>
                <h1 class="center">University Projects:</h1>
                <p class="center">
                    <a href="/portfolio/projects">All Projects</a> &emsp;
                    <a href="/portfolio/personalProjects">Personal Projects</a> &emsp;
                </p>
            <?php endif;
            ?>
