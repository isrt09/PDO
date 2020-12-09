<?php
    ob_start(); 
    require_once('./includes/db.php');
    require_once('./includes/header.php');  
    if(isset($_POST['edit'])){
        $id   = $_POST['edit'];
        $sql  = "SELECT * FROM users WHERE user_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id'=>$id            
        ]);
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user_id        = $row['user_id'];
            $user_name      = $row['user_name'];
            $user_email     = $row['user_email'];
            $user_password  = $row['user_password'];
        }
    }
 ?>

    <div class="container">
        <h2 class="pt-4">User Update</h2>
        <?php 
    if(isset($_POST['update']))
    {
        $user_id       = $_POST['user_id'];
        $user_name     = $_POST['user_name'];
        $user_email    = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        if(empty($user_name) || empty($user_email) || empty($user_password)){
            $error = "<div class='alert alert-danger>Field can not be blank!</div>'";
        }else{
            
        }
        $sql     = "UPDATE users SET user_name = :user_name,user_email=:user_email, user_password=:user_password WHERE user_id=:user_id";
        $stmt    = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id'=>$user_id,
            ':user_name'=>$user_name,
            ':user_email'=>$user_email,
            ':user_password'=>$user_password,
        ]);
    }    
  ?>
        <form class="py-2" autocomplete="off" method="post" action="edit.php">
            <?php 
                if(isset($error)){
                    echo $error;
                }
             ?>
            <div class="form-group">            
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="user_name" class="form-control" id="username" value="<?php echo $user_name; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="user_email" class="form-control" id="email" value="<?php echo $user_email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="user_password" class="form-control" id="password" value="<?php echo $user_password; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
<?php require_once('./includes/footer.php'); ?>