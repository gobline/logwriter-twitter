<?php

/*
 * Gobline
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gobline\Logger\Writer;

use Psr\Log\AbstractLogger;

/**
 * Tweets log information.
 *
 * Sources:
 * http://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1/15314662#15314662
 * https://github.com/J7mbo/twitter-api-php
 *
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class TwitterLogWriter extends AbstractLogger
{
    private $oAuthAccessToken;
    private $oAuthAccessTokenSecret;
    private $consumerKey;
    private $consumerKeySecret;
    private $receiverScreenName;

    /**
     * @param string $oAuthAccessToken
     * @param string $oAuthAccessTokenSecret
     * @param string $consumerKey
     * @param string $consumerKeySecret
     * @param string $receiverScreenName
     */
    public function __construct(
        $oAuthAccessToken,
        $oAuthAccessTokenSecret,
        $consumerKey,
        $consumerKeySecret,
        $receiverScreenName
    ) {
        $this->oAuthAccessToken = $oAuthAccessToken;
        $this->oAuthAccessTokenSecret = $oAuthAccessTokenSecret;
        $this->consumerKey = $consumerKey;
        $this->consumerKeySecret = $consumerKeySecret;
        $this->receiverScreenName = $receiverScreenName;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = [])
    {
        $message = '['.strtoupper($level).'] '.$message;

        // Set access tokens here - see: https://apps.twitter.com/
        $settings = [
            'oauth_access_token' => $this->oAuthAccessToken,
            'oauth_access_token_secret' => $this->oAuthAccessTokenSecret,
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerKeySecret,
        ];

        // URL for REST request, see: https://dev.twitter.com/rest/public
        $url = 'https://api.twitter.com/1.1/direct_messages/new.json';
        $requestMethod = 'POST';

        // POST fields required by the URL above. See relevant docs as above
        $postfields = [
            'screen_name' => $this->receiverScreenName,
            'text' => $message,
        ];

        // Perform the request and echo the response
        $twitter = new \TwitterAPIExchange($settings);

        $twitter->buildOauth($url, $requestMethod)
                ->setPostfields($postfields)
                ->performRequest(false);
    }
}
