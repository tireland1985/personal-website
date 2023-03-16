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
            <!-- CONTENT HERE -->
            <table>
                <tr>
                    <th>Email</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
                <?php foreach($userList as $row){ ?>
                    <tr>
                        <td><?=$row->email;?></td>
                        <td><?=$row->firstname;?></td>
                        <td><?=$row->lastname;?></td>
                        <td><a href="/user/editUsers?id=<?=$row->id;?>">Edit</a></td>
                        <td>
                            <form action="/user/deleteUser" method="post">
                                <input type="hidden" name="id" value="<?=$row->id;?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
</div>
</main>