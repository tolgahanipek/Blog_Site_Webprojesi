<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_sidebar.php"; ?>


    <div id="content-wrapper">
        <div class="container-fluid">
            <h1>ADMİN PANELİNE HOŞGELDİNİZ</h1>
            <hr>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Gönderi Başlığı</th>
                        <th>Kategori</th>
                        <th>Yazar</th>
                        <th>Tarih</th>
                        <th>Yorumlar</th>
                        <th>Resim</th>
                        <th>Metin</th>
                        <th>Etiketler</th>
                        <th>Eylemler</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    <!--*********************   ADD    *********************************-->
                    <?php
                        
                        if(isset($_POST["add_post"]))
                        {
                            $post_title     = $_POST["post_title"];
                            $post_category  = $_POST["post_category"];
                            $post_author    = $_POST["post_author"];
                            $post_tags      = $_POST["post_tags"];
                            $post_text      = $_POST["post_text"];
                            $post_date      = date("d-m-y");
                            $post_comment_number = 8;
                            
                            $post_image      =   $_FILES["post_image"]["name"];
                            $post_image_temp =   $_FILES["post_image"]["tmp_name"];
                        
                            move_uploaded_file($post_image_temp, "../img/$post_image");
                            
                $query = "INSERT INTO posts (post_title, post_category, post_author, post_tags, post_text, post_date, post_comment_number, post_image)";
                                
                $query .= "VALUES ('{$post_title}', '{$post_category}', '{$post_author}', '{$post_tags}', '{$post_text}', now(), '{$post_comment_number}', '{$post_image}')";
                            
                            $create_post_query = mysqli_query($conn, $query);
                            header("Location: posts.php");
                            
                        }
                    
                    ?>
                        
                    
                     <!--************************    EDİT    ********************************-->
                    
                    <?php
                    
                        if(isset($_POST["edit_post"]))
                        {
                        
                            $post_title = $_POST["post_title"];
                            $post_category = $_POST["post_category"];
                            $post_author = $_POST["post_author"];
                            $post_tags = $_POST["post_tags"];
                            $post_text = $_POST["post_text"];
                            
                            
                            $post_image      =   $_FILES["post_image"]["name"];
                            $post_image_temp =   $_FILES["post_image"]["tmp_name"];
                        
                            move_uploaded_file($post_image_temp, "../img/$post_image");
                            
                            if(empty($post_image))
                            {
                                $query = "SELECT * FROM posts WHERE post_id = '$_POST[post_id]'";
                                $select_image = mysqli_query($conn, $query);
                                
                                while($row = mysqli_fetch_array($select_image))
                                {
                                    $post_image = $row["post_image"];
                                }
                            }
                            
                            $sql_query2 = "UPDATE posts SET 
                    
                            post_title      = '{$post_title}',
                            post_category   = '{$post_category}',
                            post_author     = '{$post_author}',
                            post_tags       = '{$post_tags}',
                            post_text       = '{$post_text}',
                            post_image      = '{$post_image}'

                            WHERE post_id = '$_POST[post_id]'";

                            $edit_post_query = mysqli_query($conn, $sql_query2);
                            header("Location: posts.php");
                            
                        }
                           
                    ?>
                    
                
                                        
                    <?php
                        
                        $sql_query = "SELECT * FROM posts ORDER BY post_id DESC";
                        $select_all_post = mysqli_query($conn, $sql_query);
                        $k = 1;
                            while($row = mysqli_fetch_assoc($select_all_post))
                            {
                                
                                $post_id             = $row["post_id"];
                                $post_category       = $row["post_category"];
                                $post_title          = $row["post_title"];
                                $post_author         = $row["post_author"];
                                $post_date           = $row["post_date"];
                                $post_image          = $row["post_image"];
                                $post_text           = substr($row["post_text"], 0, 100);
                                $post_tags           = $row["post_tags"];
                                
                                
                                
                                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'approved'";
                            
                                $select_comment_query = mysqli_query($conn, $query);
                                $post_comment_number = mysqli_num_rows($select_comment_query);
                                
                                
                                echo "
                                        
                                         <tr>
                                            <td>{$post_id}</td>
                                            <td>{$post_category}</td>
                                            <td>{$post_title}</td>
                                            <td>{$post_author}</td>
                                            <td>{$post_date}</td>
                                            <td>{$post_comment_number}</td>
                                            <td><img src='../img/$post_image' width='80px' height='80px'></td>
                                            <td>{$post_text}</td>
                                            <td>{$post_tags}</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        Eylemler
                                                    </button>
                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                        <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$k' href='#'>Düzenle</a>
                                                        <div class='dropdown-divider'></div>
                                                        <a class='dropdown-item' href='posts.php?delete={$post_id}'>Sil</a>
                                                        <div class='dropdown-divider'></div>
                                                        <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Ekle</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        
                                     ";          
                    ?>
                    
                    <div id="edit_modal<?php echo $k; ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Gönderiyi Düzenle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="post_title">Gönderi Başlığı</label>
                                            <input type="text" class="form-control" name="post_title" value="<?php echo "$post_title"; ?>">
                                        </div>
                                        
                                        <div class="form-group">                                
                                            <label for="post_category">Gönderi Kategorisi</label>
                                                <select class="form-group" name="post_category">  
                                                <?php
                                                    $edit_category_sql = "SELECT * FROM categories";
                                                    $edit_category_run = mysqli_query($conn, $edit_category_sql);
                                                        while($edit_category_row = mysqli_fetch_assoc($edit_category_run))
                                                        {
                                                            $edited_category = $edit_category_row["category_name"];

                                                            if($edit_category_row["category_name"] == $row["post_category"])
                                                            {
                                                                echo "<option selected>$edited_category</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option>$edited_category</option>";
                                                            } 
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="post_author">Yazar Gönderisi</label>
                                            <input type="text" class="form-control" name="post_author" value="<?php echo "$post_author"; ?>">
                                        </div>

                                        <div class="form-group">
                                            <img width="100px" src="../img/<?php echo $post_image; ?>">
                                            <input type="file" class="form-control" name="post_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="post_tags">Gönderi Etiketleri</label>
                                            <input type="text" class="form-control" name="post_tags" value="<?php echo "$post_tags"; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="post_text">Gönderi Metni</label>
                                            <textarea class="form-control" name="post_text" id="" cols="20" rows="5"><?php echo $row["post_text"]; ?></textarea><!--burayı incele-->
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="post_id" value="<?php echo $row["post_id"]; ?>">
                                            <input type="submit" class="btn btn-primary" name="edit_post" value="Gönderiyi Düzenle">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                    
                    <?php  $k++; }   ?>
                    
                </tbody>
            </table>

            
            
            
            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yeni Gönderi Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="post_title">Gönderi Başlığı</label>
                                    <input type="text" class="form-control" name="post_title">
                                </div>
                                <div class="form-group">
                                    <label for="post_category">Gönderi Kategorisi</label>
                                    <select class="form-group" name="post_category">  
                                            <?php
                                                $edit_category_sql = "SELECT * FROM categories";
                                                $edit_category_run = mysqli_query($conn, $edit_category_sql);
                                        
                                                    while($edit_category_row = mysqli_fetch_assoc($edit_category_run))
                                                    {
                                                        $edited_category = $edit_category_row["category_name"];
                                                            if($edit_category_row["category_name"] == $row["post_category"])
                                                        {
                                                            echo "<option selected>$edited_category</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option>$edited_category</option>";
                                                        } 
                                                    }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="post_author">Yazar Gönderisi</label>
                                    <input type="text" class="form-control" name="post_author">
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Gönderilen Resim</label>
                                    <input type="file" class="form-control" name="post_image">
                                </div>
                                <div class="form-group">
                                    <label for="post_tags">Gönderi Etiketleri</label>
                                    <input type="text" class="form-control" name="post_tags">
                                </div>
                                <div class="form-group">
                                    <label for="post_text">Gönderilen Metin</label>
                                    <textarea class="form-control" name="post_text" id="" cols="20" rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="post_id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_post" value="Gönderi Ekle">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <?php
            
            if(isset($_GET["delete"]))
            {
                $delete_post_id = $_GET["delete"];
                
                $sql = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
                
                $delete_post_query = mysqli_query($conn, $sql);
                
                header("Location: posts.php");
            }
        
        
        ?>



            <?php include "includes/admin_footer.php"; ?>