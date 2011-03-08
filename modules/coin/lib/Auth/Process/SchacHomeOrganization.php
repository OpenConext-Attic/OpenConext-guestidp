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
			$authStage = explode(':', $request["SimpleSAML_Auth_State.stage"]);
			$authId = $authStage[0] . ':AuthId';
			$authModule = $request[$authId];
		}

		$attributes =& $request['Attributes'];

		// Set or replace the schacHomeOrganization attribute
		if ($authModule !== NULL && array_key_exists($authModule, $this->map)) {
			$schacHomeOrganization = $this->map[$authModule];
			if (isset($schacHomeOrganization)) {
				$attributes["schacHomeOrganization"] = $schacHomeOrganization;
			}
		}
	}
}

?>
