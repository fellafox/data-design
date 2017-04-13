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
<h2>Main Entity: Profile</h2>
			<h2>Attributes:</h2>
			<ol>
				<li>salt</li>
				<li>hash</li>
				<li>validationTokein</li>
				<li>profileId</li>
				<li>productId</li>
				<li>favoriteDate</li>
				<li>productPrice</li>
				<li>productName</li>
				<li>productDescription</li>
				<li>the foreign key in the profile</li>
				<li>the foreign key in the product</li>
			</ol>
			<h2>Relationships:</h2>
			<ol>
			<li>many users can favorite many products</li>
			<li>many products can be favorited by many users</li>
		</ol>
		</main>
	</body>

</html>