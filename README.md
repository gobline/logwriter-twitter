# Twitter Log Writer Component - Mendo Framework

```Mendo\Logger\Writer\TwitterLogWriter``` tweets log information (as private [DM (direct messages)](https://support.twitter.com/articles/14606-posting-or-deleting-direct-messages)).
With the Twitter app installed, you have instant notifications on your mobile.
[If your mobile carrier is supported](https://support.twitter.com/articles/20170024-twitter-s-supported-mobile-carriers), you can also activate SMS notfications.

## Usage

1. Create a new Twitter user for your web application and a **[Twitter App](https://apps.twitter.com/)**.
2. Select the new App and change **permissions** to *Read and Write*.
3. Generate consumer key, consumer secret, access token and access token secret (make sure you (re)generate **after** you have set the permissions).

```php
$logger = new Mendo\Logger\Writer\TwitterLogWriter(
    $oAuthAccessToken, // your genenated access token
    $oAuthAccessTokenSecret, // your genenated access token secret
    $consumerKey, // your genenated consumer key
    $consumerKeySecret, // your genenated consumer key secret
    $receiverScreenName // the user account display name of the receiver
);

$logger->info('hello world');
```

Note that 
* you need two Twitter accounts for this to work: the twitter account sending the direct message, and the twitter account receiving it.
* the receiver account needs to follow the sender.
* Twitter will block consecutive duplicated messages.

## Installation

You can install Mendo Twitter Log Writer using the dependency management tool [Composer](https://getcomposer.org/).
Run the *require* command to resolve and download the dependencies:

```
composer require mendoframework/logwriter-twitter
```