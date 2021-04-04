<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">


<?php include "includes/admin_sidebar.php"; ?>
        

      <div id="content-wrapper">

        <div class="container-fluid">
            <h1>ADMİN PANELİNE HOŞGELDİNİZ <small><?php echo $_SESSION["username"]; ?></small></h1>
            <hr>

            <div class="row">
            <!--*****************************************************************************-->
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-clipboard"></i>
                  </div>


                    <?php

                        $query = "SELECT * FROM posts";
                        $select_all_posts = mysqli_query($conn, $query);

                        $post_count = mysqli_num_rows($select_all_posts);

                        echo"<div class='mr-5'>{$post_count} Posts</div>";

                    ?>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="posts.php">
                  <span class="float-left">Detayları Göster</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <!--********************************************************************************-->
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-comment"></i>
                  </div>

                    <?php

                        $query = "SELECT * FROM comments";
                        $select_all_comments = mysqli_query($conn, $query);

                        $comment_count = mysqli_num_rows($select_all_comments);

                        echo"<div class='mr-5'>{$comment_count} Comments</div>";

                    ?>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="comment.php">
                  <span class="float-left">Detayları Göster</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-list-ul"></i>
                  </div>

                    <?php

                        $query = "SELECT * FROM categories";
                        $select_all_categories = mysqli_query($conn, $query);

                        $category_count = mysqli_num_rows($select_all_categories);

                        echo"<div class='mr-5'>{$category_count} Categories</div>";

                    ?>

                </div>


                <a class="card-footer text-white clearfix small z-1" href="categories.php">
                  <span class="float-left">Detayları Göster</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-file-image"></i>
                  </div>

                    <?php

                        $query = "SELECT * FROM portfolios";
                        $select_all_portfolios = mysqli_query($conn, $query);

                        $portfolio_count = mysqli_num_rows($select_all_portfolios);

                        echo"<div class='mr-5'>{$portfolio_count} Portfolio Items</div>";

                    ?>

                </div>
                <a class="card-footer text-white clearfix small z-1" href="portfolios.php">
                  <span class="float-left">Detayları Göster</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

            <hr>
            </br>


            <div class="row">
                <div class="col-md-6">

                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Information', 'Results'],
                              ['Posts', <?php echo $post_count; ?>],
                              ['Comments', <?php echo $comment_count; ?>],
                              ['Categories', <?php echo $category_count; ?>],
                              ['Portfolio Items', <?php echo $portfolio_count; ?>]
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                          }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: auto;"></div>

                </div>


                <?php

                    $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
                    $select_all_approved = mysqli_query($conn, $query);

                    $approved_count = mysqli_num_rows($select_all_approved);


                ?>




                <div class="col-md-6">

                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['gauge']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                              ['Label', 'Value'],
                              ['Approved', <?php echo $approved_count; ?>],
                              ['Unapproved', <?php echo ($comment_count-$approved_count); ?>],
                            ]);

                            var options = {
                              width: 400, height: 400,
                              greenFrom: 60, greenTo: 75,
                              redFrom: 90, redTo: 100,
                              yellowFrom:75, yellowTo: 90,
                              minorTicks: 5
                            };

                            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                            chart.draw(data, options);

                            /*setInterval(function() {
                              data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
                              chart.draw(data, options);
                            }, 13000);
                            setInterval(function() {
                              data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
                              chart.draw(data, options);
                            }, 5000);
                            setInterval(function() {
                              data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
                              chart.draw(data, options);
                            }, 26000);*/
                          }
                    </script>

                    <div id="chart_div" style="width: auto; height: auto;"></div>


</div>
                </div>
            </div>


<?php include "includes/admin_footer.php"; ?>
