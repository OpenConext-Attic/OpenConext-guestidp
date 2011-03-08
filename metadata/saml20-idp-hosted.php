<?php
/**
 * SAML 2.0 IdP configuration for simpleSAMLphp.
 *
 * See: https://rnd.feide.no/content/idp-hosted-metadata-reference
 */

$metadata['__DYNAMIC:1__'] = array(
	/*
	 * The hostname of the server (VHOST) that will use this SAML entity.
	 *
	 * Can be '__DEFAULT__', to use this entry by default.
	 */
	'host' => '__DEFAULT__',

	/* X.509 key and certificate. Relative to the cert directory. */
        //'privatekey' => 'star.dev.coin.surf.net.key',
        //'certificate' => 'star.dev.coin.surf.net.pem',
        'privatekey' => 'server.pem',
        'certificate' => 'server.crt',

	/*
	 * Authentication source to use. Must be one that is configured in
	 * 'config/authsources.php'.
	 */
	'auth' => 'multi',

	/* Uncomment the following to use the uri NameFormat on attributes. */
	//'AttributeNameFormat' => 'urn:oasis:names:tc:SAML:2.0:attrname-format:uri',
	'authproc' => array(
		90 => array('class' => 'core:AttributeMap', 'removeurnprefix'),
		100 => array('class' => 'core:AttributeMap', 'facebook2name'),
		110 => array('class' => 'core:AttributeMap', 'openid2name'),
		120 => array('class' => 'core:AttributeMap', 'twitter2name'),
		130 => array('class' => 'coin:SetUid'),
		140 => array('class' => 'coin:SchacHomeOrganization',
			'facebook' => 'facebook.com',
			'twitter' => 'twitter.com', 
			'google' => 'google.com',
			'yahoo' => 'yahoo.com',
			'hyves' => 'hyves.nl',
			'OpenID' => 'openid.net',
			'SURFguest' => 'surfguest.nl',
			'DEFAULT' => 'surfguestidp'
		),
		145 => array('class' => 'core:AttributeLimit',
			'uid', 'cn', 'displayName', 'mail', 'givenName', 'sn', 'schacHomeOrganization'),
		150 => array('class' => 'core:AttributeMap', 'addurnprefix'),
	),

);

