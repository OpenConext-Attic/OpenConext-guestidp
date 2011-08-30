<?php

/**
 * Filter to add the UID. First checks whether the uid is set and then tries to set it from the cn, mail, firstname.lastname.
 *
 * This filter allows you to add the UID attribute.
 *
 * @author Stein Welberg, Everett.
 * @version $Id$
 */
class sspmod_coin_Auth_Process_SetUid extends SimpleSAML_Auth_ProcessingFilter
{
    /**
     * Map with IdP - filter mappings.
     *
     * Associative array of arrays.
     */
    private $map = array();


    /**
     * Initialize this filter.
     *
     * @param array $config  Configuration information about this filter.
     * @param mixed $reserved  For future use.
     */
    public function __construct($config, $reserved)
    {
        parent::__construct($config, $reserved);

        assert('is_array($config)');

        foreach ($config as $name => $value) {
            if (!is_string($name)) {
                throw new Exception('Invalid authModule name: ' . var_export($name, TRUE));
            }

            $this->map[$name] = $value;
        }
    }

    /**
     * Apply filter to add the UID attribute.
     *
     * @param array &$request  The current request
     */
    public function process(&$request)
    {
        assert('is_array($request)');
        assert('array_key_exists("Attributes", $request)');

        $authModule = NULL;

        // Fetch Auth module
        if (array_key_exists("SimpleSAML_Auth_State.stage", $request)) {
            $authStage = implode(":", array_slice(explode(':', $request["SimpleSAML_Auth_State.stage"]), 0, -1));
            $authId = $authStage . ':AuthId';
            $authModule = $request[$authId];
        }
        else if (isset($request['AuthnInstant']) && isset($request['Expire'])) {
            // Probably dealing with a cached response
            $cachedAuthModule = SimpleSAML_Session::getInstance()->getData(sspmod_multiauth_Auth_Source_MultiAuth::SESSION_SOURCE, 'multi');
            if ($cachedAuthModule) {
                $authModule = $cachedAuthModule;
            }
        }

        if (!isset($authModule)) {
            throw new Exception("Auth module not found?!?!");
        }

        $attributes =& $request['Attributes'];
        $filter = null;

        // Set or replace the filter attribute
        if (array_key_exists($authModule, $this->map)) {
            $filter = $this->map[$authModule];
        }

        switch ($filter) {
            case 'GOOGLE' :
                $attributes['uid'] = $this->_useEmailAsUid($attributes);
            break;
            case 'YAHOO' :
                $attributes['uid'] = $this->_useEmailAsUid($attributes);
            break;
            case 'HYVES' :
                if (!array_key_exists('openid.local_id', $attributes)) {
                    throw new Exception('No local id attribute provided! Cannot use it as UID');
                }
                $attributes['uid'] = str_replace('.hyves.nl/', '', str_replace('http://', '', $attributes['openid.local_id']));
            break;
            default;
                if (!array_key_exists('uid', $attributes)) {
                    throw new Exception('No UID set?!?!');
                }
            break;
        }
    }

    protected function _useEmailAsUid(array $attributes)
    {
        if (!array_key_exists('mail', $attributes)) {
            throw new Exception('No mail attribute provided! Cannot use it as UID');
        }
        return str_replace('@', '_', $attributes['mail']);
    }
}

?>
