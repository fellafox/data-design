<?php

namespace Edu\Cnm\DataDesign;
require_once("autoload.php");

/**
 * put class docblock here
 *
 **/
class Favorite implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Favorite; this is the foreign key
	 * @var int $favoriteProfileId
	 **/
	private $favoriteProfileId;
	/**
	 * id of the product that was favorited; this is a foreign key
	 * @var int $favoriteProductId
	 **/
	private $favoriteProductId;
	/**
	 * date and time this Favorite was favorited, in a PHP DateTime object
	 * @var \DateTime $favoriteDate ;
	 **/
	private $favoriteDate;

	/**
	 * constructor for this Favorite
	 * FINISH THIS DOCBLOCK
	 **/
	public function _construct(int $newFavoriteProfileId, int $newFavoriteProductId, $newFavoriteDate = null) {
		try {
			$this->setFavoriteProfileId($newFavoriteProfileId);
			$this->setFavoriteProductId($newFavoriteProductId);
			$this->setFavoriteDate($newFavoriteDate);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for favorite profile id
	 *
	 * @return int value of favorite profile id
	 **/
	public function getFavoriteProfileId(): int {
		return $this->favoriteProfileId;
	}

	/**
	 * mutator method for favorite profile id
	 *
	 * @param int $newFavoriteProfileId new value of favorite profile id
	 * @throws \InvalidArgumentException if $newFavoriteProfileId is null
	 * @throws \RangeException if $newFavoriteProfileId is not positive
	 * @throws \TypeError if $newFavoriteProfileId is not an integer
	 **/
	public function setFavoriteProfileId(int $newFavoriteProfileId): void {
		//if profile id is null immediately return it
		if($newFavoriteProfileId === null) {
			// THROW AN EXCEPTION HERE
		}

		//verify the favorite profile id is positive
		if($newFavoriteProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		// convert snd store the favorite profile id
		$this->favoriteProfileId = $newFavoriteProfileId;
	}

	/**
	 * accessor method for favorite product id
	 *
	 * @return int value of favorite product id
	 **/
	public function getFavoriteProductId(): int {
		return ($this->favoriteProductId);
	}

	/**
	 * mutator method for favorite product id
	 *
	 * @param int $newFavoriteProductId new value of favorite product id
	 * @throws \InvalidArgumentException id $newFavoriteProductId is null
	 * @throws \RangeException if $newFavoriteProductId is not positive
	 * @throws \TypeError if $newFavoriteProductId is not an integer
	 **/
	public function setFavoriteProductId(int $newFavoriteProductId): void {
		// CHECK IF ITS NULL (SEE LINE 63)

		//verify the favoriteProductId is positive
		if($newFavoriteProductId <= 0) {
			throw(new \RangeException("favorite product id is not positive"));
		}

		//convert and store the favorite product id
		$this->favoriteProductId = $newFavoriteProductId;
	}


	/**
	 * accessor method for favorite date
	 *
	 * @return \DateTime value of favorite date
	 **/
	public function getFavoriteDate(): \DateTime {
		return ($this->favoriteDate);
	}

	/**
	 * mutator method for favorite date
	 *
	 * @param \DateTime|string|null $newFavoriteDate favorite date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newFavoriteDate is not a valid object or string
	 * @throws \RangeException if $newFavoriteDate is a date that does not exist
	 **/
	public function setFavoriteDate($newFavoriteDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newFavoriteDate === null) {
			$this->favoriteDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newFavoriteDate = self::validateDateTime($newFavoriteDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteDate = $newFavoriteDate;
	}

	/**
	 * inserts this Favorite into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		// enforce the favoriteProductId is null (i.e., don't insert a favorite that already exists)
		if($this->favoriteProductId !== null) {
			throw(new \PDOException("not a new favorite"));
		}
		// create query template
		$query = "INSERT INTO favorite(favoriteProfileId, favoriteProductId, favoriteDate) VALUES(:tweetProfileId, :tweetContent, :tweetDate)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s.u");
		$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId, "favoriteDate" => $formattedDate];
		$statement->execute($parameters);
		// update the null favoriteProductId with what mySQL just gave us
		$this->favoriteProductIdId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this Favorite from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// enforce the favoriteProductId is not null (i.e., don't delete a tweet that hasn't been inserted)
		if($this->tweetId === null) {
			throw(new \PDOException("unable to delete a tweet that does not exist"));
		}
		// create query template
		$query = "DELETE FROM favorite WHERE favoriteProductId = :favoriteProductId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["favoriteProductId" => $this->favoriteProductId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Favorite in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		// enforce the favoriteProductId is not null (i.e., don't update a favorite that hasn't been inserted)
		if($this->favoriteProductId === null) {
			throw(new \PDOException("unable to update a favorite that does not exist"));
		}
		// create query template
		$query = "UPDATE favorite SET favoriteProfileId = :favoriteProfileId, favoriteProductId = :favoriteProductId, favoriteDate = :favoriteDate WHERE favoriteProductId = :favoriteProductId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s.u");
		$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId, "favoriteDate" => $formattedDate, "favoriteProductId" => $this->favoriteProductId];
		$statement->execute($parameters);
	}

	/**
	 * gets a Favorite by favoriteProfileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $favoriteProfileId favorite id to search for
	 * @return Favorite|null Favorite found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getFavoriteByFavoriteProfileId(\PDO $pdo, int $favoriteProfileId): ?Favorite {
		// sanitize the tweetId before searching
		if($favoriteProfileId <= 0) {
			throw(new \PDOException("favorite profile id is not positive"));
		}
		// create query template
		$query = "SELECT favoriteProductId, favoriteProfileId, favoriteDate FROM favorite WHERE favoriteProfileId = :favoriteProfileId";
		$statement = $pdo->prepare($query);
		// bind the tweet id to the place holder in the template
		$parameters = ["favoriteProductId" => $favoriteProfileId];
		$statement->execute($parameters);
		// grab the favorite from mySQL
		try {
			$favorite = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$favorite = new Favorite($row["favoriteProfileId"], $row["favoriteProfileId"], $row["favoriteProductId"], $row["favoriteDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($favorite);
	}
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
		$favorite = Favorite::getFavoriteByFavoriteId($pdo, $id);
		if($favorite !== null) {
			$reply->data = $favorite;
		}
	} else if(empty($favoriteProfileId) === false) {
		$favorite = Favorite::getFavoriteByFavoriteProfileId(
			$pdo, $favoriteProfileId)->toArray();
		if($favorite !== null) {
			$reply->data = $favorite;
		}
	} else if(empty($favoriteProductId) === false) {
		$favorites = Favorite::getFavoriteByFavoriteProductId($pdo, $favoriteProductId)->toArray();
		if($favorites !=== null) {
			$reply->data = $favorites;
		}
	} else {
		$favorites = Favorite::getAllFavorites($pdo)->toArray();
		if($favorites !== null) {
			$reply->data = $favorites;
		}
	}
} elseif($method === "PUT" || $method === "POST") {