<?php
namespace MinecraftServerStatus;

/**
 * Class MinecraftServerData
 * @package MinecraftServerStatus
 */
class MinecraftServerData
{
    /** @var string */
    protected $hostname;
    /** @var integer */
    protected $port;
    /** @var integer */
    protected $ping;
    /** @var string */
    protected $version;
    /** @var integer */
    protected $protocol;
    /** @var integer */
    protected $players;
    /** @var integer */
    protected $max_players;
    /** @var string */
    protected $description;
    /** @var string */
    protected $description_raw;
    /** @var string */
    protected $favicon;
    /** @var mixed */
    protected $modinfo;

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     * @return MinecraftServerData
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return MinecraftServerData
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return int
     */
    public function getPing()
    {
        return $this->ping;
    }

    /**
     * @param int $ping
     * @return MinecraftServerData
     */
    public function setPing($ping)
    {
        $this->ping = $ping;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return MinecraftServerData
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return int
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param int $protocol
     * @return MinecraftServerData
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param int $players
     * @return MinecraftServerData
     */
    public function setPlayers($players)
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPlayers()
    {
        return $this->max_players;
    }

    /**
     * @param int $max_players
     * @return MinecraftServerData
     */
    public function setMaxPlayers($max_players)
    {
        $this->max_players = $max_players;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MinecraftServerData
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionRaw()
    {
        return $this->description_raw;
    }

    /**
     * @param string $description_raw
     * @return MinecraftServerData
     */
    public function setDescriptionRaw($description_raw)
    {
        $this->description_raw = $description_raw;
        return $this;
    }

    /**
     * @return string
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * @param string $favicon
     * @return MinecraftServerData
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModinfo()
    {
        return $this->modinfo;
    }

    /**
     * @param mixed $modinfo
     * @return MinecraftServerData
     */
    public function setModinfo($modinfo)
    {
        $this->modinfo = $modinfo;
        return $this;
    }
}