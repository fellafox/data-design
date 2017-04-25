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

	 */
}