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
                <a href="/certs/edit">Add Certification</a>
            </div>
            <table>
                <tr>
                    <th>Vendor Name</th> <th>Cert Name</th> <th>Start Date</th> <th>End Date</th>
                </tr>
                
                    <?php foreach($certsList as $row): ?>
                    <tr>
                        <td><?=$row->vendor_name;?></td>
                        <td><?=$row->cert_name;?></td>
                        <td><?=$row->valid_from ?? '' ?></td>
                        <td><?=$row->valid_to ?? '' ?></td>
                        <td><a href="/certs/edit?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/delete/deleteCert" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>" />
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                
            </table>
        </div>
</main>