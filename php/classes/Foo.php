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
		if ($newAuthorActivationToken === null) {
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
	/**
	 * accessor method for author avatar url
	 * @return string value of avatar url
	 */
	public function getAuthorAvatarUrl() {

	}
}


