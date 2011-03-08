<?php
$attributemap = array(

        // Extra email mapping to uid, if the full name doesn't exist. Cannot be in the openid2name.php
	// file since double keys aren't accepted.
        'http://axschema.org/contact/email'             => 'uid', // Set email -> uid
	'openid.sreg.email'                             => 'uid',
	'http://axschema.org/namePerson'		=> 'uid', // Full name -> uid 
	'openid.sreg.fullname'				=> 'uid'
);

