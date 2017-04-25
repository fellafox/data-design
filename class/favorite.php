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
 * constructor for this Favorite
 *
	 * /**
	 */
	}
	 */
}