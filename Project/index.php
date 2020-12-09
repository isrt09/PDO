<?php 
    require_once('./includes/db.php');
    require_once('./includes/header.php'); 
?>
 <?php 
    if(isset($_POST['submit']))
    {        
        $message       = '';
        $user_name     = $_POST['user_name'];
        $user_email    = $_POST['user_email'];                                
        $user_password = 'SECRET';                                
        if(empty($user_name) || empty($user_email))
        {
            $error = true;
        }else{
            $message = '';
            $sql  = "INSERT INTO users(user_name,user_email,user_password) VALUES(:user_name,:user_email,:user_password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_name'     => $user_name,
                ':user_email'    => $user_email,
                ':user_password' => $user_password
            ]);            
        }
    }
?>
    <div class="container">        
        <form class="py-4" method="POST" action="index.php"> 
        <?php if(isset($message)){ echo "<div class='alert alert-success'>Data Inserted Successfully!</div>";} ?>           
            <div class="row">
                <div class="col">
                    <input type="text" name="user_name" class="form-control" placeholder="Username">
                </div>
                <div class="col">
                    <input type="email" name="user_email" class="form-control" placeholder="Email Address">
                </div>
                <div class="col">
                    <input type="submit" name="submit" class="form-control btn btn-secondary" value="Add New User">
                </div>
                <?php 
                    if(isset($error)){
                        echo "<script>alert('Field can not be empty or blank...')</script>";
                    }
                 ?>          
            </div>                
        </form>
        
        <h2>All Users</h2>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    $sql  = "SELECT * FROM users";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                       $user_id    = $row['user_id'];
                       $user_name  = $row['user_name'];
                       $user_email = $row['user_email']; ?>                      
                       <tr>
                        <th><?php echo $user_id; ?></th>
                        <td><?php echo $user_name; ?></td>
                        <td><?php echo $user_email; ?></td>                        
                        <td>
                            <form action="edit.php" method="post">
                                <input type="hidden" name="edit" value="<?php echo $user_id; ?>">
                                <input type="submit" value="update" class="btn btn-success">
                            </form>
                        </td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="val" value="<?php echo $user_id; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete" name="del">
                            </form>
                        </td>
                      </tr>              
                <?php } ?>              
            </tbody>
        </table>
        <?php 
            if(isset($_POST['del'])){
                $id   = $_POST['val'];
                $sql  = "DELETE FROM users WHERE user_id =:id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id'=>$id
                ]);
                header('location:index.php');
            }
         ?>
    </div>
<?php require_once('./includes/footer.php'); ?>