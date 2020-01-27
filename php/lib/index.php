<?php

namespace rmnunn\ObjectOrientedPhase1;

require_once(dirname(__DIR__) . "classes/autoload.php");

//use rmnunn\ObjectOrientedPhase1\Author;

$newAuthor = new Author("511aa979-6452-4de8-8935-1bd81c719ae2", "ActivationString", "www.avatarurl.com",
	"rnunn@dsf.edu", "password", "rnunn4");

echo $newAuthor->getAuthorEmail();
