# metaverse-systems/multichain-php-client

PHP package for communicating with MultiChain node

* Install

```
composer require metaverse-systems/multichain-php-client
```

* Publish config file

```
php artisan vendor:publish --provider="MetaverseSystems\MultiChain\MultiChainProvider" --tag=config
```

* Install multichain daemon 

```
php artisan multichain:daemon-install
```

* Create block chain, .env will be configured

```
php artisan multichain:create mychain
```

* To use:

```
use MetaverseSystems\MultiChain\Facades\MultiChain;

print_r(MultiChain::getinfo());

print_r(MultiChain::liststreams());

// Create a stream call 'mystream', make it an open stream (true)

MultiChain::create("stream", "mystream", true);

```
