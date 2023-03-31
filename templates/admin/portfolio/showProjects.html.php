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
            <?php require_once('../templates/admin/portfolio/view_types.html.php'); ?>


            <table>
                <tr>
                    <?php if($view == 'all' || $view == 'personal' || $view == 'university'): ?>
                        <th>Project Name:</th> <th>Project Type:</th> <th>Multiple Images Permitted</th>
                   <?php endif; ?>
                </tr>
                <?php foreach($projectsList as $row): ?>
                    <tr>
                        <td><?=$row->project_title;?></td>
                        <td><?=$row->project_type;?></td>
                        <td><?=$row->multiple_images;?></td>
                        <td><a href="/portfolio/editProjects?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/portfolio/deleteProjects" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>"/>
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</main>