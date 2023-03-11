<main id="admin-page">
    <div class="row">
        <div class="col s3">
        <ul>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == '1'){
                require_once('../templates/admin/nav-admin.html.php');
            } ?>
        </ul>
        </div>
        <div class="col s9">
            <?php if($view == 'all'){ ?>
                   <h2>All Projects:</h2> 
                   <p>
                        <a href="/portfolio/showPersonal">Personal Projects</a> &emsp;
                        <a href="/portfolio/showUniversity">University Projects</a> &emsp;
                        <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                    </p>
            <?php   } 
            if($view =='personal'){ ?>
                <h2>Personal Projects</h2>
                <p>
                    <a href="/portfolio/showProjects">All Projects</a> &emsp;
                    <a href="/portfolio/showUniversity">University Projects</a> &emsp;
                    <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                </p>
            <?php }
            if($view == 'university'){ ?>
                <h2>University Projects</h2>
                <p>
                    <a href="/portfolio/showProjects">All Projects</a> &emsp;
                    <a href="/portfolio/showPersonal">Personal Projects</a> &emsp;
                    <a href="/portfolio/editProjects">Add New Project</a>&emsp;
                </p>
            <?php }
            ?>

            <table>
                <tr>
                    <?php if($view == 'all' || $view == 'personal' || $view == 'university'){ ?>
                        <th>Project Name:</th> <th>Project Type:</th>
                   <?php } ?>
                </tr>
                <?php foreach($projectsList as $row){ ?>
                    <tr>
                        <td><?=$row->project_title;?></td>
                        <td><?=$row->project_type;?></td>
                        <td><a href="/portfolio/editProjects?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/portfolio/deleteProjects" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>"/>
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</main>