#Minecraft Server Status

Minecraft Server Status, library to make query with online players, motd, favicon and more server related informations without plugins and enable-query.

*Tested with Spigot 1.11

### Installation
```
composer require mops1k/minecraftserverstatus
```
###Tutorial
```php
<?php
use MinecraftServerStatus\MinecraftServerStatus;

require '../vendor/autoload.php';

$status = new MinecraftServerStatus();
$status
    ->setHost('localhost')
    ->setPort(25565)
;

if (!$status->query()) {
    echo "The Server is offline!";
} else {
    $data = $status->getData();

    if ($data->getFavicon()) {
        echo "<img width=\"64\" height=\"64\" src=\"" . $data->getFavicon() . "\" /> <br>";
    }
    echo "The Server " . $data->getHostname() . " is running on " . $data->getVersion() . " and is online,
		currently are " . $data->getPlayers() . " players online
		of a maximum of " . $data->getMaxPlayers() . ". The motd of the server is '" . $data->getDescription() . "'.
		The server has a ping of " . $data->getPing() . " milliseconds.";
}
```
If the server is offline $status->query() returns false else it returns true and fill the server informations to $status->getData().
