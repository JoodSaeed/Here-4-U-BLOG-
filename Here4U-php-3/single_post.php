<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title> <?php echo $post['title'] ?> | Here4U</title>
<style type="text/css">
	
 * {
    box-sizing:border-box
  }
  .commentForm {
    width: 100%;
    color: #2a2e2e;
    cursor: text;
    resize: none;
    display: block;
    padding: 6px 0 6px 8px;
    line-height: 1.4;
    font-size: 18px;
    transition: all .15s ease-in-out;
    overflow: auto;
    background: #fff;
    border: 2px solid #dbdfe4;
    border-radius: 4px 4px 0 0;
    border-bottom: none;
  }

  .nameForm {
    border-radius: 4px;
    border: solid 2px #dbdfe4; 
    position: absolute;
    top: 0;
    left: 65px;
    right: 0;
    width: 81%;
  }

  .commentFormSubmit {
    border: none;
    background: rgba(29,47,58,.6);
    display: inline-block;
    color: #fff;
    line-height: 1.1;
    transition: background .2s;
    margin: -2px;
    white-space: nowrap;
    border-radius: 0 0 0 3px;
    font-size: 12px;
    padding: 12px 14px 13px;
    font-weight: 700;
  }
  .commentFormSubmit:hover {
    background: rgba(29,47,58,.7);
    color: #fff;
    cursor: pointer;
    transition: linear .3s;
  }
  .pp {
    border-radius: 5px;
    width: 56px;
  }
  .form-outer {
    width: 340px;
    position: relative;
  }
  .commentSubmitOuter {
    background: #f6f8f9;
    border-radius: 0 0 4px 4px;
    border: solid 2px #dbdfe4;
    bottom: 0;
    left: 0;
    right: 0;
    transition: opacity linear .2s;
  }


</style>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
	
	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
					<?php echo html_entity_decode($post['body']); ?>
				</div>
			<?php endif ?>
			</div>
			<!-- // full post div -->
			
			<!-- comments section -->
			<!--  coming soon ...  -->
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a> 
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
	<h1>Reviews</h1>
	<div id="show"></div>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('show.php')
			}, 1000);
		});
	</script>


	<br>
    <div class="form-outer">
      <img src="pp.png" class="pp" alt="">
      <input class="commentForm nameForm" type="text" name="name" placeholder="Name" id="commentName" required /><br>
      <textarea class="commentForm" name="comment" class="" id="commentText" placeholder="Join the Discussion..."></textarea>
      <div class="commentSubmitOuter">
      <input class="commentFormSubmit" id="commentSubmit" type="button" value="Submit" required/>
      </div>

      <div id="commentSuccess">Your comment has been submitted successfully.</div>
      <div id="commentError">There was an error submitting your comment.</div>
    </div>

</div>
<!-- // content -->


  <script>
      $("#commentSuccess").hide();
      $("#commentError").hide();


        $("#commentSubmit").click(function() {
            var name = document.getElementById("commentName").value;
            var comment = document.getElementById("commentText").value;
            var pageId = 1; //Every page with comments has an ID so I know which comments to display.

             $.ajax({
                type: "POST",
                url: "addcomment.php",
                data: {
                    "name": name,
                    "comment": comment,
                    "pageId": pageId
                },
                success: function(data) {
                   $("#commentSuccess").show();
                }
            });
        });
    </script>



<?php include( ROOT_PATH . '/includes/footer.php'); ?>