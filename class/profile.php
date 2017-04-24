<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
**/
class Profile implements \JsonSerializable {
	use \Edu\Cnm\DataDesign\ValidateDate;
	/**
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;
	/**
	 * id of the Profile that made this action: this is a foreign key
	 * @var int $profileId
	 * */
	private $profileId;
	/**
	 */
}
