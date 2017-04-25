<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
**/
class Profile implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;
	/**
	* for account verification
	 * @var int $profileActivationToken
	 **/
	private $profileActivationToken;
	/**
	 * e-mail for the profile account
	 * @var string $profileEmail
	 **/
	private $profileEmail;
	/**
	 * username for the profile
	 * @var string $profileAtHandle
	 **/
	private $profileAtHandle;
	/**
	 * salt for the account password
	 * @var int $profileSalt;
	 **/
	private $profileSalt;
	/**
	 * hash for the account password
	 * @var int $productHash;
	 **/
	private $profileHash;
	**/
}
