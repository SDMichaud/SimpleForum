<?php
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../src/classes/PostClass.php');

class PostClassTest extends TestCase
{
    /**
     * @dataProvider postDataArrayProvider
     */
    public function testCreatePostDivHTML_Returns_String($post_data_array)
    {
	$this->assertInternalType('string', PostClass::createPostDivHTML($post_data_array));
    }
    
    public function postDataArrayProvider()
    {
	/**
	 * Data Providers must return an array of arrays
	 * The data to be provided is also an array
	 * We therefore need our data to be the last in three arrays
	 */
	$data_array = array(
	    'photo' => 'test.jpg',
	    'id' => 1,
	    'author' => 'Anonymous',
	    'subject' => '',
	    'updated' => 0,
	    'content' => 'Testing'
	);
	return array(
	    'default' => array($data_array)
	);
    }
}
?>
