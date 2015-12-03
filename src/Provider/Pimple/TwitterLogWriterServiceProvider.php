<?php

/*
 * Gobline
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gobline\Logger\Writer\Provider\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Gobline\Logger\Writer\TwitterLogWriter;

/**
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class TwitterLogWriterServiceProvider implements ServiceProviderInterface
{
    private $reference;

    public function __construct($reference = 'logwriter.twitter')
    {
        $this->reference = $reference;
    }

    public function register(Container $container)
    {
        $container[$this->reference] = function ($c) {
            if (empty($c[$this->reference.'.oAuthAccessToken'])) {
                throw new \Exception('oAuthAccessToken not specified');
            }
            if (empty($c[$this->reference.'.oAuthAccessTokenSecret'])) {
                throw new \Exception('oAuthAccessTokenSecret not specified');
            }
            if (empty($c[$this->reference.'.consumerKey'])) {
                throw new \Exception('consumerKey not specified');
            }
            if (empty($c[$this->reference.'.consumerKeySecret'])) {
                throw new \Exception('consumerKeySecret not specified');
            }
            if (empty($c[$this->reference.'.receiverScreenName'])) {
                throw new \Exception('receiverScreenName not specified');
            }

            return new TwitterLogWriter(
                $c[$this->reference.'.oAuthAccessToken'],
                $c[$this->reference.'.oAuthAccessTokenSecret'],
                $c[$this->reference.'.consumerKey'],
                $c[$this->reference.'.consumerKeySecret'],
                $c[$this->reference.'.receiverScreenName']
            );
        };
    }
}
