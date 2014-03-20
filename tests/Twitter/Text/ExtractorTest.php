<?php

/**
 * @author     Nick Pope <nick@nickpope.me.uk>
 * @copyright  Copyright © 2010, Mike Cochrane, Nick Pope
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License v2.0
 * @package    Twitter.Text
 */

namespace Twitter\Text;

use Twitter\Text\Extractor;
use Symfony\Component\Yaml\Yaml;

/**
 * Twitter Extractor Class Unit Tests
 *
 * @author     Nick Pope <nick@nickpope.me.uk>
 * @copyright  Copyright © 2010, Mike Cochrane, Nick Pope
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License v2.0
 * @package    Twitter.Text
 * @param      Extractor $extractor
 */
class ExtractorTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        parent::setUp();
        $this->extractor = Extractor::create();
    }

    protected function tearDown()
    {
        unset($this->extractor);
        parent::tearDown();
    }

    /**
     * A helper function for providers.
     *
     * @param  string  $test  The test to fetch data for.
     *
     * @return  array  The test data to provide.
     */
    protected function providerHelper($test)
    {
        $data = Yaml::parse(DATA . '/extract.yml');
        return isset($data['tests'][$test]) ? $data['tests'][$test] : array();
    }

    /**
     * @group Extractor
     */
    public function testExtractURLsWithoutProtocol()
    {
        $extracted = Extractor::create('text: example.com http://foobar.example.com')->extractUrlWithoutProtocol(false)->extractURLs();
        $this->assertSame(array('http://foobar.example.com'), $extracted, 'Unextract url without protocol');
    }

    /**
     * @group Extractor
     */
    public function testExtractURLsWithIndicesWithoutProtocol()
    {
        $extracted = Extractor::create('text: example.com')->extractUrlWithoutProtocol(false)->extractURLsWithIndices();
        $this->assertSame(array(), $extracted, 'Unextract url without protocol');
    }
}
