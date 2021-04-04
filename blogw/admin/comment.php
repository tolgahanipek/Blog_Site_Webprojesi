
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
                        <th>Yazar</th>
                        <th>Email</th>
                        <th>Yorum</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>Yanıt</th>
                        <th>Eylemler</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    <?php
                        
                        $sql_query = "SELECT * FROM comments ORDER BY comment_id DESC";
                        $select_all_comments = mysqli_query($conn, $sql_query);
                        $k = 1;
                            while($row = mysqli_fetch_assoc($select_all_comments))
                            {
                                
                                $comment_id          = $row["comment_id"];
                                $comment_post_id     = $row["comment_post_id"];
                                $comment_date        = $row["comment_date"];
                                $comment_author      = $row["comment_author"];
                                $comment_email        = $row["comment_email"];
                                $comment_text        = $row["comment_text"];
                                $comment_status      = $row["comment_status"];
                              
                    
                    
                    
                    echo "
                    
                        <tr>
                            <td>{$comment_id}</td>
                            <td>{$comment_author}</td>
                            <td>{$comment_email}</td>
                            <td>{$comment_text}</td>
                            <td>{$comment_date}</td>
                            <td>{$comment_status}</td>";
                                
                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                            $select_post_id_query = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_assoc($select_post_id_query))
                                {
                                    $post_id = $row["post_id"];
                                    $post_title = $row["post_title"];
                                }
                            
                            echo "<td>{$post_title}</td>";
                            
                            
                            echo"
                            
                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Eylemler
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                            <a class='dropdown-item' data-toggle='modal' data-target='#view_modal$k' href='#'>Göster</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comment.php?delete={$comment_id}'>Sil</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comment.php?approved={$comment_id}'>Onaylandı</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comment.php?unapproved={$comment_id}'>Onaylanmadı</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    
                            ";
                                
                                
                    ?>
                    
                    

                    <div id="view_modal<?php echo $k; ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Yorumu Göster</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="comment_author">Yorum Yazarı</label>
                                            <input type="text" readonly class="form-control" name="comment_author" value="<?php echo $comment_author; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_email">Yorum Epostası</label>
                                            <input type="text" readonly class="form-control" name="comment_email" value="<?php echo $comment_email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_text">Yorum Metni</label>
                                            <textarea class="form-control" readonly name="comment_text" id="" cols="20" rows="5"><?php echo $comment_text?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_status">Yorum Durumları</label>
                                            <input type="text" class="form-control" name="comment_status" value="<?php echo $comment_status ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="commented_post">Yorum Yazısı</label>
                                            <input type="text" readonly class="form-control" name="commented_post" value="<?php echo $post_title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="comment_id" value="">
                                            <input type="submit" class="btn btn-primary" name="view_post" value="Gönderileri Gör">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php  $k++; }   ?>
                    
                    
                </tbody>
            </table>
            
            <?php
            
                if(isset($_GET["approved"]))
                {
                    $the_comment_id = $_GET["approved"];

                    $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";

                    $approve_comment_query = mysqli_query($conn, $sql);

                    header("Location: comment.php");
                }
        
     
            
                if(isset($_GET["unapproved"]))
                {
                    $the_comment_id = $_GET["unapproved"];

                    $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";

                    $unapprove_comment_query = mysqli_query($conn, $sql);

                    header("Location: comment.php");
                }
        
        ?>
            
            
            

            <?php
            
                if(isset($_GET["delete"]))
                {
                    $delete_comment_id = $_GET["delete"];

                    $sql = "DELETE FROM comments WHERE comment_id = {$delete_comment_id} ";

                    $delete_comment_query = mysqli_query($conn, $sql);

                    header("Location: comment.php");
                }
        
        ?>
            
            
            
            
            
            <?php include "includes/admin_footer.php"; ?>