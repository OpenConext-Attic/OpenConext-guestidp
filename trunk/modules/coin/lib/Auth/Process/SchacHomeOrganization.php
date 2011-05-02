<?php

/**
 * Filter to add the SchacHomeOrganization.
 *
 * This filter allows you to add the SchacHomeOrganization attribute.
 *
 * @author Stein Welberg, Everett.
 * @version $Id$
 */
class sspmod_coin_Auth_Process_SchacHomeOrganization extends SimpleSAML_Auth_ProcessingFilter {

	/**
	 * Constant for the default schacHomeOrganization key
	 */
	const DEFAULT_SCHACHOMEORG = 'DEFAULT';

	/**
	 * Map with schacHomeOrganization - IDP mappings.
	 *
	 * Assiciative array of arrays.
	 */
	private $map = array();


	/**
	 * Initialize this filter.
	 *
	 * @param array $config  Configuration information about this filter.
	 * @param mixed $reserved  For future use.
	 */
	public function __construct($config, $reserved) {
		parent::__construct($config, $reserved);

		assert('is_array($config)');

		foreach($config as $name => $values) {
                        if(!is_string($name)) {
                                throw new Exception('Invalid authModule name: ' . var_export($name, TRUE));
                        }

                        if(!is_array($values)) {
                                $values = array($values);
                        }
                        foreach($values as $value) {
                                if(!is_string($value)) {
                                        throw new Exception('Invalid value for authModule ' . $name . ': ' .
                                                var_export($values, TRUE));
                                }
                        }

                        $this->map[$name] = $values;
		}
	}


	/**
	 * Apply filter to add the SchacHomeOrganization attribute.
	 *
	 * @param array &$request  The current request
	 */
	public function process(&$request) {
		assert('is_array($request)');
		assert('array_key_exists("Attributes", $request)');

		$authModule = NULL;
		
		// Fetch Auth module
		if(array_key_exists("SimpleSAML_Auth_State.stage", $request)) {
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

		// Set or replace the schacHomeOrganization attribute
		if (array_key_exists($authModule, $this->map)) {
			$schacHomeOrganization = $this->map[$authModule];
			if (isset($schacHomeOrganization)) {
				$attributes["schacHomeOrganization"] = $schacHomeOrganization;
                                return;
			}
		} 

		if (array_key_exists(DEFAULT_SCHACHOMEORG, $this->map)) {
                    throw new Exception("No default schacHomeOrganization?!?");
		}
		$attributes["schacHomeOrganization"] = $this->map[DEFAULT_SCHACHOMEORG];
	}
}

?>
