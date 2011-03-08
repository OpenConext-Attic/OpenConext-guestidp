<?php
/**
 * SAML 2.0 remote IdP metadata for simpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://rnd.feide.no/content/idp-remote-metadata-reference
 */

/*
 * Guest IdP. allows users to sign up and register. Great for testing!
 */
$metadata['https://openidp.feide.no'] = array(
	'name' => array(
		'en' => 'Feide OpenIdP - guest users',
		'no' => 'Feide Gjestebrukere',
	),
	'description'          => 'Here you can login with your account on Feide RnD OpenID. If you do not already have an account on this identity provider, you can create a new one by following the create new account link and follow the instructions.',

	'SingleSignOnService'  => 'https://openidp.feide.no/simplesaml/saml2/idp/SSOService.php',
	'SingleLogoutService'  => 'https://openidp.feide.no/simplesaml/saml2/idp/SingleLogoutService.php',
	'certFingerprint'      => 'c9ed4dfb07caf13fc21e0fec1572047eb8a7a4cb'
);


/*
 * Feide, the norwegian federation. Test and production metadata.
 */
$metadata['https://idp-test.feide.no'] = array(
	'name' => array(
		'en' => 'Feide Test environment',
		'no' => 'Feide testmiljø',
	),
	'description'                  => 'Feide test environment (idp-test.feide.no). Authenticate with your identity from a school or university in Norway.',

	'SingleSignOnService'          => 'https://idp-test.feide.no/simplesaml/saml2/idp/SSOService.php',
	'SingleLogoutService'          => 'https://idp-test.feide.no/simplesaml/saml2/idp/SingleLogoutService.php',

	'certFingerprint'              => 'fa982efdb69f26e8073c8f815a82a0c5885960a2',
	'hint.cidr'                    => '158.38.0.0/16',
);

$metadata['https://idp.feide.no'] = array(
	'name' => 'Feide',
	'description' => array(
		'en' => 'Authenticate with your identity from a school or university in Norway.',
		'no' => 'Logg inn med din identitet fra skolen eller universitetet du er tilknyttet (i Norge).',
	),
	'SingleSignOnService'          => 'https://idp.feide.no/simplesaml/saml2/idp/SSOService.php',
	'SingleLogoutService'          => 'https://idp.feide.no/simplesaml/saml2/idp/SingleLogoutService.php',
	'certFingerprint'              => 'cde69e332fa7dd0eaa99ee0ddf06916e8942ac53',
	'hint.cidr'                    => '158.38.0.0/16',
);



/*
 * Wayf, the danish federation metadata.
 */
$metadata['https://wayf.wayf.dk'] = array(
	'name' => array(
		'en' => 'DK-WAYF Production server',
		'da' => 'DK-WAYF Produktionsmiljøet',
	),
	'description'          => 'Login with your identity from a danish school, university or library.',
	'SingleSignOnService'  => 'https://wayf.wayf.dk/saml2/idp/SSOService.php',
	'SingleLogoutService'  => 'https://wayf.wayf.dk/saml2/idp/SingleLogoutService.php',
	'certFingerprint'      => 'c215d7bf9d51c7805055239f66b957d9a72ff44b'
);

$metadata['https://betawayf.wayf.dk'] = array(
	'name' => array(
		'en' => 'DK-WAYF Quality Assurance',
		'da' => 'DK-WAYF Quality Assurance miljøet',
	),
	'description'          => 'Login with your identity from a danish school, university or library.',
	'SingleSignOnService'  => 'https://betawayf.wayf.dk/saml2/idp/SSOService.php',
	'SingleLogoutService'  => 'https://betawayf.wayf.dk/saml2/idp/SingleLogoutService.php',
	'certFingerprint'      => 'c215d7bf9d51c7805055239f66b957d9a72ff44b'
);

$metadata['https://testidp.wayf.dk'] = array(
	'name' => array(
		'en' => 'DK-WAYF Test Server',
		'da' => 'DK-WAYF Test Miljøet',
	),
	'description'          => 'Login with your identity from a danish school, university or library.',
	'SingleSignOnService'  => 'https://testidp.wayf.dk/saml2/idp/SSOService.php',
	'SingleLogoutService'  => 'https://testidp.wayf.dk/saml2/idp/SingleLogoutService.php',
	'certFingerprint'      => '04b3b08bce004c27458b3e85b125273e67ef062b'
);

$metadata['SURFnetGuests'] = array (
	'entityid' => 'SURFnetGuests',
	'name' => array (
		'nl' => 'SURFguest (test)',
		'en' => 'SURFguest (test)',
	),
	'description'		=> 'SURFguest',
	'SingleSignOnService'	=> 'https://espee-test.surfnet.nl/federate/saml20/SURFnetGuests',
	'SingleLogoutService'	=> 'https://espee-test.surfnet.nl/federate/saml20',
	'certFingerprint'	=> '93E14C76386C6550553B3915274BDAA52811EA8D',
	'certData'		=> 'MIIEHjCCAwagAwIBAgILAQAAAAABFg7hy6swDQYJKoZIhvcNAQEFBQAwXzELMAkGA1UEBhMCQkUx
EzARBgNVBAoTCkN5YmVydHJ1c3QxFzAVBgNVBAsTDkVkdWNhdGlvbmFsIENBMSIwIAYDVQQDExlD
eWJlcnRydXN0IEVkdWNhdGlvbmFsIENBMB4XDTA3MTEwNTA4MTYyN1oXDTEwMTEwNTA4MTYyN1ow
TTELMAkGA1UEBhMCTkwxEDAOBgNVBAoTB1NVUkZuZXQxETAPBgNVBAsTCFNlcnZpY2VzMRkwFwYD
VQQDExBlc3BlZS5zdXJmbmV0Lm5sMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIcRvAXwUW
lE12NCkgPR9V6G90tu9C4gQ3cMGzF3b8fGg5A01/F7TcIMNohFFEee4GiYWmU5+xRZByQw5BXpSl
qbDn/G3QSJqOcXzxcelWY8jlJUHx91ved6aSvDXZx5Jkv9wP1ZVOKWRfKOGENqwNQZeUEiKUhrYu
5wEBsBpDMwIDAQABo4IBbzCCAWswUAYDVR0gBEkwRzBFBgcqhkixPgEAMDowOAYIKwYBBQUHAgEW
LGh0dHA6Ly93d3cuZ2xvYmFsc2lnbi5uZXQvcmVwb3NpdG9yeS9jcHMuY2ZtMA4GA1UdDwEB/wQE
AwIFoDAfBgNVHSMEGDAWgBRlZaM91zsRowoHJTfJQkpbdndQ4TAdBgNVHQ4EFgQUHZSyxc2114FH
O3aPxNUz0xKzfDgwOgYDVR0fBDMwMTAvoC2gK4YpaHR0cDovL2NybC5nbG9iYWxzaWduLm5ldC9l
ZHVjYXRpb25hbC5jcmwwTwYIKwYBBQUHAQEEQzBBMD8GCCsGAQUFBzAChjNodHRwOi8vc2VjdXJl
Lmdsb2JhbHNpZ24ubmV0L2NhY2VydC9lZHVjYXRpb25hbC5jcnQwHQYDVR0lBBYwFAYIKwYBBQUH
AwEGCCsGAQUFBwMCMBsGA1UdEQQUMBKCEGVzcGVlLnN1cmZuZXQubmwwDQYJKoZIhvcNAQEFBQAD
ggEBAAojubZKLWWymxYMTmYUxpxm1Me1FPvd8HlmPg5gWdmbw8piO92thM9KROLpG/zK5GKC4Zvr
sEPpvToCQpPVyEVf3DpCOJKOOIv3//a5BKuhWLTtzqJsAvIp2BS7e4p1GuKnYhOvlxf3pueAmJAd
3Z2/V0VIpHhzCKehI1pvZr/P7auQplTWnbPplAcwvaLxvovpzhXRDXWPVqfjGBKlXvJQEIR8mXvO
I/ZzU/5sZH7CAZstly5TVqn1MGodCZEdIMv2I9tj5k+dv3/Z/x2lm9QAmvvqVzzXlAXVg2kJZ5zW
zr6qKeyUJsnOwtE2lGjexPGy2H0ezUpfFImKgOl4dWE='
);
