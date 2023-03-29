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
            <div>
                <a href="/cv/editProfessionalExperience">Add new record</a>
            </div>

            <table>
                <tr>
                    <th>Company Name</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                </tr>
                
                    <?php foreach($employmentList as $row): ?>
                        <tr>
                        <td><?=$row->employer_name;?></td>
                        <td><?=$row->start_date;?></td>
                        <td><?=$row->end_date;?></td>
                        <td><a href="/cv/editProfessionalExperience?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/cv/deleteProfessionalExperience" method="post">
                                <input type="hidden" name="id" value="<?$row->id;?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                
            </table>
            <!-- CONTENT HERE-->
        </div>
</main>