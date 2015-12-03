<?php

/*
 * Gobline
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Pimple\Container;
use Gobline\Logger\Writer\Provider\Pimple\TwitterLogWriterServiceProvider;

/**
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class ServiceProviderTest extends PHPUnit_Framework_TestCase
{
    public function testServiceProvider()
    {
        $container = new Container();

        $container['logwriter.twitter.oAuthAccessToken'] = 'foo';
        $container['logwriter.twitter.oAuthAccessTokenSecret'] = 'bar';
        $container['logwriter.twitter.consumerKey'] = 'baz';
        $container['logwriter.twitter.consumerKeySecret'] = 'qux';
        $container['logwriter.twitter.receiverScreenName'] = 'corge';
        $container->register(new TwitterLogWriterServiceProvider());
        $this->assertInstanceOf('Gobline\Logger\Writer\TwitterLogWriter', $container['logwriter.twitter']);
    }
}
