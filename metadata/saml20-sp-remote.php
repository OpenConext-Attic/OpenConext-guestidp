<?php
/**
 * SAML 2.0 remote SP metadata for simpleSAMLphp.
 *
 * See: http://simplesamlphp.org/docs/trunk/simplesamlphp-reference-sp-remote
 */

# Testing EngineBlock - New
$metadata['https://engine.surfconext.nl/authentication/sp/metadata'] = array(
        'AssertionConsumerService' => 'https://engine.surfconext.nl/authentication/sp/consume-assertion',
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
        'simplesaml.nameidattribute' => 'urn:mace:dir:attribute-def:uid',
);

$localConfig = '/etc/surfconext/guestidp.saml20-sp-remote.php';
if (file_exists($localConfig)) {
    require $localConfig;
}
