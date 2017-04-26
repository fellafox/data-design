<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
**/
class Favorite implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Favorite; this is the primary key
	 * @var int $favoriteProfileId
	 **/
	private $favoriteProfileId;
	/**
	 * id of the Favorite that sent this; this is a foreign key
	 * @var int $favoriteProfileId
	 **/
	private $favoriteProductId;
	/**
	 * date and time this Favorite was favorited, in a PHP DateTime object
	 * @var \DateTime $favoriteDate;
	 **/
	private $favoriteDate;
	/**
	 **/
 	* constructor for this Favorite
 /**
**/
	public function _construct(?int $newFavoriteProfileId, int $newFavoriteProductId,string $newFavoriteDate, = null) {
		try {
			$this->setFavoriteProfileId($newFavoriteProfileId);
			$this->setFavoriteProductId($newFavoriteProductId);
			$this->setFavoriteDate($newFavoriteDate);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception ));
		}
	}


	/**
	 * accessor method for favorite profile id
	 *
	 * @return int|null value of favorite profile id
	 **/
	/**
	 * @return int
	 */
	public function getFavoriteProfileId(): int {
		return $this->favoriteProfileId;
	}

	/**
	 * mutator method for favorite profile id
	 *
	 * @param int|null $newFavoriteProfileId new value of favorite profile id
	 * @throws \RangeException if $newFavoriteProfileId is not positive
	 * @throws \TypeError if $newFavoriteProfileId is not an integer
	 **/
	public function setFavoriteProfileId(?int $newFavoriteProfileId) : void {
		//if profile id is null immediately return it
		if($newFavoriteProfileId === null)}
$this->favoriteprofileId = null;
return;
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
public function getFavoriteProductId() : int {
	return($this->favoriteProductId);
}

/**
 * mutator method for favorite product id
 *
 * @param int $newFavoriteProductId new value of favorite product id
 * @throws \RangeException if $newFavoriteProductId is not positive
 * @throws \TypeError if $newFavoriteProductId is not an integer
 **/
public function setFavoriteProductId(int $newFavoriteProductId) : void {
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
public function getFavoriteDate() : \DateTime {
	return($this->favoriteDate);
}

/**
 * mutator method for favorite date
 *
 * @param \DateTime|string|null $newFavoriteDate favorite date as a DateTime object or string (or null to load the current time)
 * @throws \InvalidArgumentException if $newFavoriteDate is not a valid object or string
 * @throws \RangeException if $newFavoriteDate is a date that does not exist
 **/
public function setFavoriteDate($newFavoriteDate = null) : void {
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
