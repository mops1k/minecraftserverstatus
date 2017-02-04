<?php
namespace MinecraftServerStatus;
use MinecraftServerStatus\Packets\HandshakePacket;
use MinecraftServerStatus\Packets\PingPacket;

class MinecraftServerStatus
{
    /** @var MinecraftServerData */
    private $data;

    /** @var string */
    private $host = '127.0.0.1';

    /** @var integer */
    private $port = 25565;

    /**
     * MinecraftServerStatus constructor.
     */
    public function __construct()
    {
        $this->data = new MinecraftServerData;
    }

    /**
     * Queries the server and returns the servers information
     * @return bool
     */
    public function query()
    {
        // check if the host is in ipv4 format
        $host = filter_var($this->host, FILTER_VALIDATE_IP) ? $this->host : gethostbyname($this->host);
        
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

        if (!@socket_connect($socket, $host, $this->port)) {
            return false;
        }
        
        // create the handshake and ping packet
        $handshakePacket = new HandshakePacket($host, $this->port, 107, 1);
        $pingPacket = new PingPacket();

        $handshakePacket->send($socket);

        // high five
        $start = microtime(true);
        $pingPacket->send($socket);
        $length = $this->readVarInt($socket);
        $ping = round((microtime(true) - $start) * 1000);

        // read the requested data
        $data = socket_read($socket, $length, PHP_NORMAL_READ);
        $data = strstr($data, '{');
        $data = json_decode($data);

        $descriptionRaw = isset($data->description) ? $data->description : null;
        $description = $descriptionRaw;

        // colorize the description if it is supported
        if (gettype($descriptionRaw) == 'object') {
            $description = '';

            if (isset($descriptionRaw->text)) {
                $color = isset($descriptionRaw->color) ? $descriptionRaw->color : null;
                $description = $descriptionRaw->text;
                if ($color !== null) {
                    $description = '<font color="' . $color . '">' . $descriptionRaw->text . '</font>';
                }
            }

            if (isset($descriptionRaw->extra)) {
                foreach ($descriptionRaw->extra as $item) {
                    $description .= isset($item->bold) && $item->bold ? '<b>' : null;
                    $description .= isset($item->color) ? '<font color="' . $item->color . '">' . $item->text . '</font>' : $item->text;
                    $description .= isset($item->bold) && $item->bold ? '</b>' : null;
                }
            }
        }

        $this->data
            ->setHostname($host)
            ->setPort($this->port)
            ->setPing($ping)
            ->setVersion(isset($data->version->name) ? $data->version->name : null)
            ->setProtocol(isset($data->version->protocol) ? $data->version->protocol : null)
            ->setPlayers(isset($data->players->online) ? $data->players->online : null)
            ->setMaxPlayers(isset($data->players->max) ? $data->players->max : null)
            ->setDescription($description)
            ->setDescriptionRaw($descriptionRaw)
            ->setFavicon(isset($data->favicon) ? $data->favicon : null)
            ->setModinfo(isset($data->modinfo) ? $data->modinfo : null)
        ;

        return true;
    }

    private function readVarInt($socket)
    {
        $a = 0;
        $b = 0;
        while (true) {
            $c = socket_read($socket, 1);
            if (! $c) {
                return 0;
            }

            $c = Ord($c);
            $a |= ($c & 0x7F) << $b ++ * 7;
            if ($b > 5) {
                return false;
            }

            if (($c & 0x80) != 128) {
                break;
            }
        }
        return $a;
    }

    /**
     * @param string $host
     * @return MinecraftServerStatus
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param int $port
     * @return MinecraftServerStatus
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }


    /**
     * @return MinecraftServerData
     */
    public function getData()
    {
        return $this->data;
    }
}