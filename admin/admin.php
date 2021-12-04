<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    
    if (get_perms_by_hash($_SESSION['login']) < 2) {
        header("Location: /index.php");
    }

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }

    $users = get_all_users();
?>

<div id="wrapper">
    <main>
        <section style="height: 100%">
            <table class="table" style="width: 98%; margin: 0px auto;" id="sortTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Permissions</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php foreach($users as $user): ?>
                <?php if (get_account_by_hash($_SESSION['login'])['email'] == $user['email']) {continue;}?>
                <?php if ($user['email'] == "admin@gelat.in") {continue;}?>
                <tr>
                    <form action="controller/user/permissions.php" method="POST">
                        <input name="id" id="id" value="<?php echo $user['id']?>" hidden>
                        <td><?php echo $user['id'];?></td>
                        <td><?php echo $user['f_name'];?></td>
                        <td><?php echo $user['l_name'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td>
                            <select id="perms" name="perms">
                                <?php for ($i = 0; $i <= 2; $i++): ?>
                                <option value="<?php echo $i;?>" <?php if ($user['perms'] == $i) {echo "selected";}?>>
                                    <?php echo $i;?></option>
                                <?php endfor;?>
                            </select>
                        </td>
                        <td><input type="submit" value="Submit"></type>
                        </td>
                    </form>
                </tr>
                <?php endforeach;?>
            </table>
        </section>
    </main>
</div>