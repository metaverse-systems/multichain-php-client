# multichain-php-client

PHP package for communicating with MultiChain node

* Install config file

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
