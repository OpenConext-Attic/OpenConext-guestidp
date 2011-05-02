<?php

/**
 * Filter to add the UID. First checks whether the uid is set and then tries to set it from the cn, mail, firstname.lastname.
 *
 * This filter allows you to add the UID attribute.
 *
 * @author Stein Welberg, Everett.
 * @version $Id$
 */
class sspmod_coin_Auth_Process_SetUid extends SimpleSAML_Auth_ProcessingFilter {

	/**
	 * Apply filter to add the UID attribute.
	 *
	 * @param array &$request  The current request
	 */
	public function process(&$request) {
		assert('is_array($request)');
		assert('array_key_exists("Attributes", $request)');

		$attributes =& $request['Attributes'];
		
		if(!array_key_exists("uid", $attributes)) {
			switch($attributes) {
				case (array_key_exists("cn", $attributes)):
					$attributes["uid"] = $attributes["cn"];
					break;
				case (array_key_exists("mail", $attributes)):
					$attributes["uid"] = $attributes["mail"];
					break;
				case (array_key_exists("givenName", $attributes) && array_key_exists("sn")):
					$attributes["uid"] = $attributes["givenName"] . "." . $attributes["sn"];
					break;
				case (array_key_exists("givenName", $attributes)):
					$attributes["uid"] = $attributes["givenName"];
					break;
			}
		}
	}

}

?>
