<?php
include 'userdashboard/server.php';
include 'header.php';
include 'navbar.php';
session_start();

$post_state = false;

    if(isset($_GET['post'])){
        $post_id = $_GET['post'];
        $post_state = true;
        $rec = mysqli_query($db, "SELECT * FROM tbl_posts WHERE post_id=$post_id");
        $record = mysqli_fetch_array($rec);
        $post_title = $record['post_title'];
        $post_description = $record['post_description'];
        $post_id = $record['post_id'];
    }
?>

<div class="rounded-lg" style=" margin: 15px;">
	<div class="row">

		<div class="col-md-9">
			<!-- Side Widget -->
				<div class="card my-4">

					<h3 class="card-header" style="text-align: left;"> <?php echo $post_title; ?>  </h3> 
					<div style="margin: auto">
						 <p class="card-text" style="text-indent: 50px; padding: 10px" >
                            <?php echo $post_description; ?>
						 </p>
					</div>
				</div>
			</div>

			<div class="col-md-3">
			<!-- Side Widget -->
				<div class="card my-4">
					<h5 class="card-header">My Profile</h5>
					<div class="avatar" style="margin: auto">
						<img class="card-img-top" src="https://i.ibb.co/NSzHzZC/avatar.png" width="200px" height="215px">
					</div class="card-footer">
						<ul style="list-style-type: none">
							<li>Username: Boss Moi</li>
							<li>Member Since: Dec 15, 2019</li>
							<li>Status: Active</li>
						</ul>
					</div>
				</div>			
			</div>


	<div class="row bootstrap snippets">
    <div class="col-md-9">
        <div class="comment-wrapper">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5><b>Comments:</b></h5>
                </div>
                <div class="panel-body">
                    <form method="POST" action="userdashboard/server.php">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>">
                    <textarea class="form-control" name="comment" placeholder="Write a comment..." rows="5" style="border: solid 2px #17A2B8; margin-bottom: 3px"></textarea>
                    <br>
                    <button type="submit" name="post_comment" class="btn btn-info" style="float: right;">Post</button>
                    </form>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">
                        <?php 
                        while ($row = mysqli_fetch_array($result_comments)) { ?>
                        <li class="media" style="border: solid 1px lightblue; margin-bottom: 5px">
                            <a href="#" class="pull-left">
                                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                            </a>
                            <div class="media-body">
                                <span class="text-muted pull-right">
                                    
                                    <small class="text-muted"><?php echo $row['created_at']; ?></small>
                                </span>
                                <strong class="text-success">@<?php echo $row['user_id']; ?></strong>
                                <p>
                                    <?php echo $row['comment']; ?>
                                </p>
                            </div>
                        
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<?php

include 'footer.php';

?>