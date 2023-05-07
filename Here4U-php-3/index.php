<!-- The first include should be config.php -->
<?php require_once('config.php') ?>
<?php 
$API_key='AIzaSyDmPSzRpybikuuO2iG6jhhn4Q0qO0tvC8o';
$channelID='UCqKRlX8Pi6xg-lAAzkt3wfA';
$maxResults=6;

//Get Videos
$apiError ='Video not found';
try{
	$apiData=@file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.'');
	if($apiData){
		$videoList=json_decode($apiData);
	}else{
		throw new Exception('Invalid Api key or channel ID');
	}
}catch(Exception $e){
	$apiError=$e->getMessage();
}
?>
<style>
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<!-- config.php should be here as the first include  -->

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>


<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Here4U | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // navbar -->

		<!-- banner -->
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- // banner -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Tutorials to write blogs</h2>
			<hr>
			<div class="row">
				<?php
					if (!empty($videoList->items)) {
						foreach($videoList->items as $item){
							if (isset($item->id->videoId)) {
							?>
				<div class="column">
					<iframe width="325" height="150" src="https://www.youtube.com/embed/<?php echo $item->Id->videoId; ?>" frameborder="0" allowfullscreen></iframe>
					<?php echo $item->snippet->title; ?>
				</div>
				<?php						
					}
				}
			}else{
				echo '<p class="error">$apierror</p>';
			}
			?>
			</div>
		</div>





		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<!-- more content still to come here ... -->
			
<!-- Add this ... -->
<?php foreach ($posts as $post): ?>
	<div class="post" style="margin-left: 0px;">
		<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
        <!-- Added this if statement... -->
		<?php if (isset($post['topic']['name'])): ?>
			<a 
				href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
				class="btn category">
				<?php echo $post['topic']['name'] ?>
			</a>
		<?php endif ?>

		<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
			<div class="post_info" style="height:0% !important;">
				<h3><?php echo $post['title'] ?></h3>
				<div class="info">
					<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
					<span class="read_more">Read more...</span>
				</div>
			</div>
		</a>
	</div>
<?php endforeach ?>
		<!-- // Page content -->

		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->