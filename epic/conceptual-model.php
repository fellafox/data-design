<!DOCTYPE hmtl>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Conceptual-Model</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
	</head>
	<body>
		<h1>Conceptual-Model</h1>
		<main>
<h2>Main Entities and Attributes</h2>
			<h3>Profile</h3>
			<ol>
				<li>profileId (primary key)</li>
				<li>profileSalt (for account password)</li>
				<li>profileHash {for account password)</li>
				<li>profileActivationToken (for account verification)</li>
				<li>profileEmail</li>
				<li>profileAtHandle</li>
			</ol>
			<h3>Product</h3>
			<ol>
			<li>productId (primary key)</li>
			<li>productDescription</li>
				<li>productName</li>
				<li>productPrice</li>
			</ol>
			<h3>Favorite :)</h3>
		<ol>
			<li>favoriteProfileId (foreign key)</li>
			<li>favoriteProductId (foreign key)</li>
			<li>favoriteDate</li>
		</ol>
			<h2>Relationships:</h2>
			<ol>
			<li>many users can favorite many products (m to n)</li>
			<li>many products can be favorited by many users (m to n)</li>
		</ol>
			<img src="img/stayweird.png" alt="stayweird" style="float: left"/>
			<img src="img/cat.png" alt="Kitty" style="float: right"/>
		</main>
	</body>

</html>