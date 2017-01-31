<?php
namespace MinecraftServerStatus\Packets;

class PingPacket extends Packet
{
    /**
     * PingPacket constructor.
     */
    public function __construct()
    {
        parent::__construct(0);
    }
}