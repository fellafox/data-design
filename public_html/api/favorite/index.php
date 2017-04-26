<?php
/**
 * Created by PhpStorm.
 * User: Emily Rose
 * Date: 4/26/2017
 * Time: 11:36 AM
 */
//sanitize input
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$favoriteProfileId = filter_input(INPUT_GET, "favoriteProfileId", FILTER_VALIDATE_INT);
$favoriteProductId = filter_input(INPUT_GET, "favoriteProductId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

//make sure the id is valid for methods that require it
if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
	throw (new \InvalidArgumentException("id cannot be empty or negative", 405));
}
// handle GET request - if id is present, that favorite is returned, otherwise all favorites are returned
if($method === "GET") {
	//set XSRF cookie
	setXsrfCookie();

	//get a specific favorite or all favorites and update reply
	if(empty($id) === false) {
		$favorite = Favorite::getFavoriteByFavoriteId ($pdo, $id);
		if($favorite !== null){
			$reply->data = $favorite;
		}
	} else if (empty($favoriteProfileId) === false){
		$favorite = Favorite::getFavoriteByFavoriteProfileId(
			$pdo, $favoriteProfileId)->toArray();
		if($favorite !== null) {
			$reply->data = $favorite;
		}
	} else if(empty($favoriteProductId) === false) {
		$favorites = Favorite::getFavoriteByFavoriteProductId ($pdo, $favoriteProductId)->toArray();
		if($favorites !=== null) {
			$reply->data = $favorites;
		}
	} else {
		$favorites = Favorite::getAllFavorites($pdo)->toArray();
		if($favorites !== null) {
			$reply->data = $favorites;
		}
	}
} elseif($method === "PUT" || $method === "POST")
{