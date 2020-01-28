<?php
namespace rmnunn\ObjectOrientedPhase1;


require_once(dirname(__DIR__) . "/classes/autoload.php");

//use rmnunn\ObjectOrientedPhase1\Author;

$hash = password_hash("password", PASSWORD_ARGON2I, ["time_cost=>7"]);

$newAuthor = new Author("cad80653-b18c-42db-869f-b93bf2ffffef", "12345678901234567890123456789012", "www.avatarurl.com",
	"rnunn@dsf.edu", $hash, "rnunn4");

echo ($newAuthor->getAuthorEmail()), ($newAuthor->getAuthorActivationToken()), ($newAuthor->getAuthorAvatarUrl()), ($newAuthor->getAuthorEmail()), ($newAuthor->getAuthorHash()), ($newAuthor->getAuthorUserName());
