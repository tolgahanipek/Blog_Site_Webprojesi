<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_sidebar.php"; ?>


    <div id="content-wrapper">
    <div class="container-fluid">
    <h1>ADMİN PANELİNE HOŞGELDİNİZ.</h1>
    <hr>

    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>AD</th>
            <th>EPOSTA</th>
            <th>PAROLA</th>
            <th>ROL </th>
            <th>EYLEMLER</th>
        </tr>
        </thead>
        <tbody>
                    <!--*********************   ADD    *********************************-->
                    <?php
                        
                        if(isset($_POST["add_user"]))
                        {
                            
                            $user_name      = $_POST["user_name"];
                            $user_email     = $_POST["user_email"];
                            $user_password  = $_POST["user_password"];
                            $user_role      = $_POST["user_role"];
                       
                            
                $query = "INSERT INTO users (user_name, user_email, user_password, user_role)";
                                
                $query .= "VALUES ('{$user_name}', '{$user_email}', '{$user_password}', '{$user_role}')";
                            
                            $create_user_query = mysqli_query($conn, $query);
                            header("Location: users.php");
                            
                        }
                    
                    ?>
                    <!--************************    EDİT    ********************************-->
                    <?php
                    
                        if(isset($_POST["edit_user"]))
                        {
                        
                            $user_name      = $_POST["user_name"];
                            $user_email     = $_POST["user_email"];
                            $user_password  = $_POST["user_password"];
                            $user_role      = $_POST["user_role"];                          
                         
                                                        
                            $sql_query2 = "UPDATE users SET 
                    
                            user_name      = '{$user_name}',
                            user_email     = '{$user_email}',
                            user_password  = '{$user_password}',
                            user_role      = '{$user_role}'

                            WHERE user_id = '$_POST[user_id]'";

                            $edit_user_query = mysqli_query($conn, $sql_query2);
                            header("Location: users.php");
                            
                        }
                           
                    ?>
                    
                    
                    
                    
                    <?php
                        
                        $sql_query = "SELECT * FROM users ORDER BY user_id DESC";
                        $select_all_users = mysqli_query($conn, $sql_query);
                        $k = 1;
                            while($row = mysqli_fetch_assoc($select_all_users))
                            {
                                
                                $user_id        = $row["user_id"];
                                $user_name      = $row["user_name"];     
                                $user_password  = $row["user_password"];
                                $user_email     = $row["user_email"];                              
                                $user_role      = $row["user_role"];
                    
                                
                                
                    echo "  
                                
                            <tr>
                                <td>{$user_id}</td>
                                <td>{$user_name}</td>
                                <td>{$user_email}</td>
                                <td>{$user_password}</td>
                                <td>{$user_role}</td>
                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Eylemler
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                            <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$k' href='#'>DÜZENLE</a>
                                            <div class='dropdown-divider'></div>
                                           
                                            <a class='dropdown-item' href='users.php?delete={$user_id}'>SİL</a>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    
                    ";
                                
                  ?>              
                     <!--************************    EDİT    ********************************-->
                    <div id="edit_modal<?php echo $k; ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Düzenle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="user_name">Kullanıcı Adı</label>
                                            <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">Kullanıcı Epostası</label>
                                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">Kullanıcı Parolası</label>
                                            <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_role">Kullanıcı Rolü</label>
                                            <select class="form-group" name="user_role">
                                                <option><?php echo $user_role; ?></option>
                                                <?php
                                                    if($user_role == "admin")
                                                    {
                                                        echo "<option value='subscriber'>Üye Olanlar</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='admin'>Yönetici</option>";
                                                    }
                                                ?>
    
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">
                                            <input type="submit" class="btn btn-primary" name="edit_user" value="Kullanıcı Düzenle">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php $k++; } ?>
                    
                    
                    
                </tbody>
            </table>
            
            
            
            <a class="btn btn-large btn-primary" data-toggle="modal" data-target="#add_modal">Yeni Kullanıcı Ekle</a>

            
             <!--************************    ADD    ********************************-->
            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yeni Kullanıcı Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                        <div class="form-group">
                                            <label for="user_name">Kullanıcı Adı</label>
                                            <input type="text" class="form-control" name="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_email">Kullanıcı Epostası</label>
                                            <input type="email" class="form-control" name="user_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_password">Kullanıcı Parolası</label>
                                            <input type="password" class="form-control" name="user_password">
                                        </div>

                                        <div class="form-group">
                                            <label for="user_role">Kullanıcı Rolü</label>
                                            <select class="form-group" name="admin_role">
                                                <option value="admin">Yönetici</option>
                                                <option value="subscriber">Üye Olanlar</option>
                                            </select>
                                        </div>

                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_user" value="Kullanıcı Ekle">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <?php
            
            if(isset($_GET["delete"]))
            {
                $delete_user_id = $_GET["delete"];
                
                $sql = "DELETE FROM users WHERE user_id = {$delete_user_id} ";
                
                $delete_user_query = mysqli_query($conn, $sql);
                
                header("Location: users.php");
            }
        
        
        ?>




            <?php include "includes/admin_footer.php"; ?>