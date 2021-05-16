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

* Edit .env and configure these variables:

```
MULTICHAIN_RPC_HOST=127.0.0.1
MULTICHAIN_RPC_PORT=12345
MULTICHAIN_RPC_USER=username
MULTICHAIN_RPC_PASS=password
```

* To use:

```
use MetaverseSystems\MultiChain\Facades\MultiChain;

print_r(MultiChain::getinfo());

print_r(MultiChain::liststreams());

// Create a stream call 'mystream', make it an open stream (true)

MultiChain::create("stream", "mystream", true);

```
