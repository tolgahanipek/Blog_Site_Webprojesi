<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

	<!--==========================
    INSIDE HERO SECTION Section
============================-->
	<section class="page-image page-image-blog md-padding">
		<h1 class="text-white text-center">BLOG</h1>
	</section>

	<!--==========================
    Contact Section
============================-->
	<section id="blog" class="md-padding">
		<div class="container">
			<div class="row">
				<main id="main" class="col-md-8">
					<div class="row">
                        
                        <?php
                        
                            if(isset($_GET["page"]))
                            {
                                $page = $_GET["page"];
                            }
                            else
                            {
                                $page = "";
                            }
                        
                            if($page == "" || $page == 1)
                            {
                                $starter_post = 0;
                            }
                            else
                            {
                                $starter_post = ($page - 1) * 4;        //blog yazılarının nasıl gösterileceği burda
                            }
                        
                        
                        
                            $sql_query = "SELECT * FROM posts";
                            $look_all_posts = mysqli_query($conn, $sql_query);
                            $post_count = mysqli_num_rows($look_all_posts);
                            $page_number = ceil($post_count / 4) ;
                        
                                                                                    //LIMIT 2(2ADET GÖSTERİİLİR) LIMIT 2,4(3.DEN BASLAR 4 TANE GOSTERİRİR)
                            $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $starter_post,4";
                            $select_all_posts = mysqli_query($conn, $sql);         //conn bağlantıyı kur. - sql sorgusunu çalıştır. - değişkene ata.
                            
                            while($row = mysqli_fetch_assoc($select_all_posts))    //fetch_assoc satırlar bitene kadar çalış-dbde kaç satır varsa o kadar döner
                            {
                                $post_id       = $row["post_id"];
                                $post_author   = $row["post_author"];
                                $post_date     = $row["post_date"];
                                $post_hits     = $row["post_hits"];
                                $post_title    = $row["post_title"];                  //strtoupper(YOKSAY)-strtolower(yoksay)-ucfirst(Yoksay)
                                $post_text     = substr($row["post_text"], 0, 200);                   //substr("$degisken",0,100)
                                $post_image    = $row["post_image"];
                        ?>        
                        
                                <div class="col-md-6">
                                    <div class="blog">
                                        <div class="blog-img">
                                            <img src="img/<?php echo $post_image ?>" class="img-fluid">
                                        </div>
                                        <div class="blog-content">
                                            <ul class="blog-meta">
                                                <li><i class="fas fa-users"></i><span class="writer"><?php echo $post_author ?></span></li>
                                                <li><i class="fas fa-clock"></i><span class="writer"><?php echo $post_date ?></span></li>
                                                <li><i class="fas fa-eye"></i><span class="writer"><?php echo $post_hits ?></span></li>
                                            </ul>
                                            <h3><?php echo $post_title ?></h3>
                                            <p><?php echo $post_text ?></p>
                                            <a href="blog-single.php?look=<?php echo $post_id; ?>">DAHA FAZLASINI OKU</a>
                                        </div>
                                    </div>
                                </div>
                                
                                                                                        
                <?php       }  ?>
                                       
                   
					</div>
                    <div class="row">
                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">
                            <li class="page-item">
                              <a class="page-link" href="blog.php?page=<?php      
                                        
                                        if($page > 1)
                                        {
                                            echo $page-1;
                                        }
                                        
                                        else
                                        {
                                            echo 1;
                                        }?>">ÖNCEKİ</a>
                            </li>                       
                                    <?php

                                        for( $i=1; $i<=$page_number; $i++ )
                                        {
                                            echo "<li class='page-item'><a class='page-link' href='blog.php?page={$i}'>{$i}</a></li>";
                                        }


                                    ?>
                            <li class="page-item">
                              <a class="page-link" href="blog.php?page=<?php      
                                        
                                        if($page_number > $page)
                                        {
                                            echo $page+1;
                                        }
                                        
                                        else
                                        {
                                            echo $page;
                                        }?>">SONRAKİ</a>
                            </li>
                          </ul>
                        </nav>
                    </div>
				</main>
				

            <?php 
                include "includes/sidebar.php";
            ?>
				
			</div>

		</div>
	</section>

<?php include "includes/footer.php"; ?>