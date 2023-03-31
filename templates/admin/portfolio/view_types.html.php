<?php if($view == 'all'): ?>
                   <h2>All Projects:</h2> 
                   <p>
                        <a href="/portfolio/showPersonal">Personal Projects</a> &emsp;
                        <a href="/portfolio/showUniversity">University Projects</a> &emsp;
                        <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                    </p>
            <?php   endif; 
            if($view =='personal'): ?>
                <h2>Personal Projects</h2>
                <p>
                    <a href="/portfolio/showProjects">All Projects</a> &emsp;
                    <a href="/portfolio/showUniversity">University Projects</a> &emsp;
                    <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                </p>
            <?php endif;
            if($view == 'university'): ?>
                <h2>University Projects</h2>
                <p>
                    <a href="/portfolio/showProjects">All Projects</a> &emsp;
                    <a href="/portfolio/showPersonal">Personal Projects</a> &emsp;
                    <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                </p>
            <?php endif;
            ?>