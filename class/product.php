<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
**/
class Product implements \JsonSerializable {
	use \Edu\Cnm\DataDesign\ValidateDate;
	/**
	 * id for this Product; this is the primary key
	 * @var int $profileId
	 **/
	private $productId;
	/**
	 * id of the Product that sent this
	 */
}