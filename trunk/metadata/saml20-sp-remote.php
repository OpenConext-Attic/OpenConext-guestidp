<?php
/**
 * SAML 2.0 remote SP metadata for simpleSAMLphp.
 *
 * See: http://simplesamlphp.org/docs/trunk/simplesamlphp-reference-sp-remote
 */

# Testing EngineBlock - New
$metadata['https://engineblock.dev.coin.surf.net/authentication/sp/metadata'] = array(
        'AssertionConsumerService' => 'https://engineblock.dev.coin.surf.net/authentication/sp/consume-assertion',
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
        'simplesaml.nameidattribute' => 'urn:mace:dir:attribute-def:uid',
);
?>
