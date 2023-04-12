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
                <a href="/otherexp/edit">Add to Other Experience</a>
                <table>
                    <tr>
                        <th>Record ID</th>
                        <th>Item Title</th>
                        
                    </tr>
                    
                    <?php foreach($otherExperienceList as $row): ?>
                    <tr>
                        <td><?=$row->id;?></td>
                        <td><?=$row->title;?></td>
                        <td><a href="/otherexp/edit?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/delete/deleteOtherExp" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>" />
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>
            </div>


        </div>
</main>