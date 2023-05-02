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
                <a href="/skills/edit">Add New Skill</a>
            </div>
            <br>
            <table>
                <tr>
                    <th>Skill Name:</th> <th>Modal Name:</th>
                </tr>
                <?php foreach($skillsList as $row): ?>
                    <tr>
                        <td><?=$row->skill_name; ?></td>
                        <td><?=$row->modal_name; ?></td>
                        <td><a href="/skills/edit?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/skills/delete" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
</main>