<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
**/
class Product implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Product; this is the primary key
	 * @var int $productIdId
	 **/
	private $productId;
	/**
	 * Description of the product
	 * @var string $productDescription
	 **/
	private $productDescription;
	/**
	 * profile id of the product that has been favorited
	 * @var int $productProfileId
	 **/
	private $productProfileId;
	/**
	 * date of the product
	 * @var string $productDate
	 **/
	private $productDate;
	/**
	 **/
	 * @param int|null $newProductId
	 * @param string $newProductDescription
	 * @param int $newProductProfileId
	 * @param string $newProductDate
	/**
	**/
	public function _construct(?int $newProductId, string $newProductDescription, int $newProductprofileId, string $newProductDate, = null) {
	try {
	$this->setProductId($newProductId);
	$this->setProductDescription($newProductDescription);
	$this->setProductProfileId($newProductprofileId);
	$this->setProductDate($newProductDate);
	}
	//determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
	$exceptionType = get_class($exception);
	throw(new $exceptionType($exception->getMessage(), 0, $exception ));
	}
	}


	/**
	 * accessor method for product id
	 *
	 * @return int|null value of product id
	 **/
	/**
	 * @return int
	 */
	public function getProductId(): int {
		return $this->ProductId;
	}

	/**
	 * mutator method for product id
	 *
	 * @param int|null $newProductId new value of product id
	 * @throws \RangeException if $newProductId is not positive
	 * @throws \TypeError if $newProductId is not an integer
	 **/
	public function setProductId(?int $newProductId) : void {
		//if product id is null immediately return it
		if($newProductId === null)}
$this->productId = null;
return;
}
//verify the product id is positive
if($newProductId <= 0) {
	throw(new \RangeException("product id is not positive"));
}
// convert snd store the product id
$this->productId = $newProductId;

}

/**
 * accessor method for product description
 *
 * @return string value of product description
 **/
public function getProductDescription() : string {
	return($this->productDescription);
}

/**
 * mutator method for product description
 *
@param string $newProductDescription new value of product description
 * @throws \InvalidArgumentException if $newProductDescription is not a string or insecure
 * @throws \RangeException if $newProductDescription is > 140 characters
 * @throws \TypeError if $newProductDescription is not a string
 **/
public function setProductDescription(string $newProductDescription) : void {
	//verify the product description is secure
	$newProductDescription = trim($newProductDescription);
	$newProductDescription = filter_var($newProductDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)
	if(empty($newProductDescription) === true) {
		throw(new \InvalidArgumentException("profile email is empty or insecure"));
	}
	// verify the product description will fit in the database
	if(strlen($newProductDescription) > 60) {
		throw(new \RangeException("product description too large"));
	}
//store the product description
	$this->productDescription = $newProductDescription;
}

/**
 * accessor method for product date
 *
 * @return \DateTime value of product date
 **/
public function getProductDate() : \DateTime {
	return($this->productDate);
}

/**
 * mutator method for product date
 *
 * @param \DateTime|string|null $newProductDate product date as a DateTime object or string (or null to load the current time)
 * @throws \InvalidArgumentException if $newProductDate is not a valid object or string
 * @throws \RangeException if $newProductDate is a date that does not exist
 **/
public function setProductDate($newProductDate = null) : void {
	// base case: if the date is null, use the current date and time
	if($newProductDate === null) {
		$this->productDate = new \DateTime();
		return;
	}
	// store the like date using the ValidateDate trait
	try {
		$newProductDate = self::validateDateTime($newProductDate);
	} catch(\InvalidArgumentException | \RangeException $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	$this->productDate = $newProductDate;
}

	 */
}