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
            <!-- CONTENT HERE-->
            <div>
                <a href="/editCV/editEducation">Add Education</a>
            </div>
            <table>
                <tr>
                    <th>Educational Institute</th> <th>Start Year</th> <th>Graduation Year</th>
                </tr>
                
                    <?php foreach($educationList as $row): ?>
                    <tr>
                        <td><?=$row->institute_name;?></td>
                        <td><?=$row->start_year;?></td>
                        <td><?=$row->end_year ?? '' ?></td>
                        <td><a href="/editCV/editEducation?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/delete/deleteEducation" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>" />
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                
            </table>
        </div>
</main>