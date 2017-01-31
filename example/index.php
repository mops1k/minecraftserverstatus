<?php
use MinecraftServerStatus\MinecraftServerStatus;

require '../vendor/autoload.php';

$status = new MinecraftServerStatus();

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
