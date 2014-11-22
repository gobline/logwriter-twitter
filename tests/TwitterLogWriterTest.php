<?php

/*
 * Mendo Framework
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Mendo\Logger\Writer\TwitterLogWriter;

/**
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class TwitterLogWriterTest extends PHPUnit_Framework_TestCase
{
    public function testLoggerTwitter()
    {
        $config = __DIR__.'./resources/conf.php';
        if (!file_exists($config)) {
            return;
        }
        $config = include $config;

        $oAuthAccessToken = $config['oAuthAccessToken'];
        $oAuthAccessTokenSecret = $config['oAuthAccessTokenSecret'];
        $consumerKey = $config['consumerKey'];
        $consumerKeySecret = $config['consumerKeySecret'];
        $receiverScreenName = $config['receiverScreenName'];

        $logger = new TwitterLogWriter(
            $oAuthAccessToken,
            $oAuthAccessTokenSecret,
            $consumerKey,
            $consumerKeySecret,
            $receiverScreenName
        );

        $logger->debug('another hello world!');

        $this->assertTrue(true);
    }
}
