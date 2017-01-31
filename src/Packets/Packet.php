<?php
namespace MinecraftServerStatus\Packets;

/**
 * Class Packet
 * @package MinecraftServerStatus\Packets
 */
class Packet
{
    /** @var mixed $packetID */
    protected $packetID;

    /** @var mixed $data */
    protected $data;

    /**
     * Packet constructor.
     * @param $packetID
     */
    public function __construct($packetID)
    {
        $this->packetID = $packetID;
        $this->data = pack('C', $packetID);
    }

    /**
     * @param $data
     */
    public function addSignedChar($data)
    {
        $this->data .= pack('c', $data);
    }

    /**
     * @param $data
     */
    public function addUnsignedChar($data)
    {
        $this->data .= pack('C', $data);
    }

    /**
     * @param $data
     */
    public function addSignedShort($data)
    {
        $this->data .= pack('s', $data);
    }

    /**
     * @param $data
     */
    public function addUnsignedShort($data)
    {
        $this->data .= pack('S', $data);
    }

    /**
     * @param $data
     */
    public function addString($data)
    {
        $this->data .= pack('C', strlen($data));
        $this->data .= $data;
    }

    /**
     * @param $socket
     */
    public function send($socket)
    {
        $this->data = pack('C', strlen($this->data)) . $this->data;
        socket_send($socket, $this->data, strlen($this->data), 0);
    }
}