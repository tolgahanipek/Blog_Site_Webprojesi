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
                    <th>Kategori Adı</th>
                    <th>Ekle - Düzenle - Sil</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                    /*ekleme işemi*/
                    if(isset($_POST["add_category"]))
                    {
                        $category_name = $_POST["category_name"];
                        
                        if($category_name == "" || empty($category_name))
                        {
                           echo " 
                                    <div class='alert alert-danger' role='alert'>
                                        Boş kayıt eklenemez!
                                    </div>                              
                                ";
                        }
                        else
                        {
                            $sql_query = "INSERT INTO categories(category_name) VALUES ('$category_name')";
                            $add_new_category_query = mysqli_query($conn, $sql_query);
                            
                            echo " 
                                    <div class='alert alert-success' role='alert'>
                                        Kayıt ekleme başarılı.
                                    </div>                              
                                ";
                            header("Location: categories.php");
                        }
                        
                    }    
                /*---------*/
                ?>
                
                
                
                <?php //son ders
                
                    if(isset($_POST["edit_category"]))
                    {
                        $edit_cat_title = $_POST["category_namex"];
                        
                        $sql_query2 = "UPDATE categories SET category_name = '$edit_cat_title' WHERE category_id = '$_POST[category_id]'";
                        
                        $edit_category_query = mysqli_query($conn, $sql_query2);
                        
                        header("Location: categories.php");
                    }
                    
                    //sonders
                ?>
                
                
                
                
                
                
                <!--burdaki echonun içi farklı şekilde yazılamaz mı?-->
                <?php 
                    
                    $sql_query = "SELECT * FROM categories ORDER BY category_id DESC";
                    $select_all_categories = mysqli_query($conn, $sql_query);
                        
                        $k = 1;
                        while($row = mysqli_fetch_assoc($select_all_categories))                        
                        {
                            
                            $category_id    =   $row["category_id"];
                            $category_name  =   $row["category_name"];
                            
                            echo"
                            
                                <tr>
                                    <td>{$category_id}</td>
                                    <td>{$category_name}</td>
                                    <td>
                                        <div class='dropdown'>
                                            <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                Eylemler
                                            </button>
                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal$k' href='#'>Düzenle</a>
                                                <div class='dropdown-divider'></div>
                                                <a class='dropdown-item' href='categories.php?delete={$category_id}'>Sil</a>
                                                <div class='dropdown-divider'></div>
                                                <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Ekle</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            ";
                        
                
                ?>
                <!--echonun içindeki html ler php tagları dışında yazılabilir mi?-->
                <!--ekleme butonuna gelindiğinde el çıkmıyor nasıl düzeltilir-->
                
                                <!--buradaki boşluk neden kodu bozar?-->
                <div id="edit_modal<?php echo $k;?>" class="modal fade">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kategori Düzenle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">

                                        <input value="<?php if(isset ($category_name)) { echo $category_name; } ?>" type="text" class="form-control" name="category_namex">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="category_id" value="<?php echo $row["category_id"]; ?> ">
                                        <input type="submit" class="btn btn-primary" name="edit_category" value="Kategori Düzenle">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php $k++; } ?>
                
            </tbody>
        </table>

        <div id="add_modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yeni Kategori Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="add_category" value="Kategori Ekle">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php
        //silme işlemi
            if(isset($_GET["delete"]))
            {
                $del_cat_id = $_GET["delete"];
                
                $sql_query = "DELETE FROM categories WHERE category_id = {$del_cat_id}";
                
                $delete_category_query = mysqli_query($conn, $sql_query);
               
                
                 header("Location: categories.php");
            }
        
        
        
        
        
        ?>
        


<?php include "includes/admin_footer.php"; ?>
