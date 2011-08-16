<?php

unset($metadata['https://engine.surfconext.nl/authentication/sp/metadata']);
$metadata['https://engine.dev.surfconext.nl/authentication/sp/metadata'] = array(
        'AssertionConsumerService' => 'https://engine.dev.surfconext.nl/authentication/sp/consume-assertion',
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
        'simplesaml.nameidattribute' => 'urn:mace:dir:attribute-def:uid',
);
