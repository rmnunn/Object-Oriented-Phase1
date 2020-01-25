<?php

/**
* Author of a Tweet
*
 *This author class will store all the necessary data to keep on the author (profile)
 *
 * @author Reece Nunn
 **/
class author {
	use ValidateUuid;
	/**
	 * id for this author; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * token handed out to verify that the profile is valid and not malicious
	 * @var $authorActivationToken
	 */
	private $authorActivationToken;
	/**
	 * Avatar URL for author
	 * @var string $authorAvatarUrl
	 */
	private $authorAvatarUrl;
	/**
	 * Email of author
	 * @var string $authorEmail
	 */
	private $authorEmail;
	/**
	 * Hashed password for author
	 * @var $authorHash
	 */
	private $authorHash;
	/**
	 * Username of the author
	 * @var string $authorUserName
	 */
	private $authorUserName;

	/**
	 * accessor method for author id
	 *
	 * @return Uuid
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 * @param Uuid / string $newAuthorId value of new author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if the profile Id is not a uuid
	 */
	public function setAuthorId($newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// Convert and store the author id
		$this->authorId = $uuid;
	}
	/**
	 * accessor method for author activation token
	 *
	 * @return string value of activation token
	 */
	public function getAuthorActivationToken() : ?string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string $newAuthorActivationToken
	 *
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken) : void {
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("author activation is not valid"));
		}
		//make sure author activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("author activation token has to be 32 characters"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for author avatar url
	 * @return string value of avatar url
	 */
	public function getAuthorAvatarUrl() : ?string {
			return ($this->authorAvatarUrl);
		}
	/**
	 * mutator method for author avatar url
	 *
	 * @param string $newAuthorAvatarUrl
	 *
	 * @throws /RangeException if the author avatar url string is too long
	 */
	public function setAuthorAvatarUrl(?string $newAuthorAvatarUrl) : void {
		if ($newAuthorAvatarUrl === null) {
			$this->authorAvatarUrl = null;
			return;
		}
		if (strlen($newAuthorAvatarUrl) > 255) {
			throw (new\RangeException("Avatar URL can only be a max of 255 characters"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/**
	 * accessor method for author email
	 * @returns string value of authors email
	 */
	public function getAuthorEmail() : ?string {
		return ($this->authorEmail);
	}
	/**
	 * mutator method for author email
	 *
	 * @param string $newAuthorEmail
	 *
	 * @throws /RangeException if author email string is null or too long
	 */
	public function setAuthorEmail(?string $newAuthorEmail) : void {
		if ($newAuthorEmail === null) {
			throw (new\RangeException("author needs an email"));
		}
		if (strlen($newAuthorEmail) > 128) {
			throw (new\RangeException("author email can be a max of 128 characters"));
		}
		$this->authorEmail = $newAuthorEmail;
	}

	/**
	 * accessor method for author hash
	 *
	 * @returns string value of author hash
	 */
	public function getAuthorHash() : ?string {
		return ($this->authorHash);
	}
	/**
	 * mutator method for author hash
	 *
	 * @param string $newAuthorHash
	 *
	 * @throws /RangeException if hash is hash string is null
	 * @throws /RangeException if hash isn't exactly 97 characters
	 */
	public function setAuthorHash(?string $newAuthorHash) : void {
		if ($newAuthorHash === null) {
			throw (new\RangeException("author needs a hash"));
		}
		if (strlen($newAuthorHash) !== 97) {
			throw (new\RangeException("hash must be 97 characters long"));
		}
		$this->authorHash = $newAuthorHash;
	}

	/**
	 * accessor method for author username
	 * @returns string author username
	 */
	public function getAuthorUserName() : ?string {
		return ($this->authorUserName);
	}
	/**
	 * mutator method for author user name
	 *
	 * @param string $newAuthorUserName
	 *
	 * @throws /RangeException if username is null
	 * @throws /RangeException if username is more than 32 characters
	 */
	public  function setAuthorUserName(?string $newAuthorUserName) : void {
		if ($newAuthorUserName === null) {
			throw (new\RangeException("author needs a username"));
		}
		if (strlen($newAuthorUserName) > 32) {
			throw (new\RangeException("username must not be longer than 32 characters"));
		}
		$this->authorUserName = $newAuthorUserName;
	}

	/**
	 * constructor for this Author
	 *
	 * @param string|Uuid $newAuthorId id of this author
	 * @param $newAuthorActivationToken activation token for this author
	 * @param string $newAuthorAvatarUrl string containing author avatar url
	 * @param string $newAuthorEmail string containing author's email address
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newAuthorId, $newAuthorActivationToken, string $newAuthorAvatarUrl, $newAuthorEmail) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
}



