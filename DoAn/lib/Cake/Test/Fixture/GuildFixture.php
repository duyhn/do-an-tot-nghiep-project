<?php
/**
 * Short description for file.
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/2.0/en/development/testing.html>
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/2.0/en/development/testing.html CakePHP(tm) Tests
 * @package       Cake.Test.Fixture
 * @since         CakePHP(tm) v 2.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Class GuildFixture
 *
 * @package       Cake.Test.Fixture
 */
class GuildFixture extends CakeTestFixture {

	/**
	 * fields property
	 *
	 * @var array
	 */
	public $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false),
	);

	/**
	 * records property
	 *
	 * @var array
	*/
	public $records = array(
			array('name' => 'Warriors'),
			array('name' => 'Rangers'),
			array('name' => 'Wizards'),
	);
}
