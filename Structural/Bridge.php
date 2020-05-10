<?php

interface Device {
    public function isEnabled();
    public function enable();
    public function disable();
    public function getVolume();
    public function setVolume($percent);
    public function getChannel();
    public function setChannel($channel);
}

class Radio implements Device {
    private $power = false;

    private $channel = 0;

    private $volume = 0;

    public function isEnabled(): bool
    {
        return $this->power;
    }

    public function enable(): void
    {
        $this->power = true;
    }

    public function disable(): void
    {
        $this->power = false;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume($percent): void
    {
        $this->volume = $percent;
    }

    public function getChannel(): int
    {
        return $this->channel;
    }

    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }
}

class TV implements Device {
    private $power = false;

    private $channel = 0;

    private $volume = 0;

    public function isEnabled(): bool
    {
        return $this->power;
    }

    public function enable(): void
    {
        $this->power = true;
    }

    public function disable(): void
    {
        $this->power = false;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume($percent): void
    {
        $this->volume = $percent;
    }

    public function getChannel(): int
    {
        return $this->channel;
    }

    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }
}

class Remote {
    protected Device $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function togglePower(): void
    {
        $this->device->isEnabled() ? $this->device->disable() : $this->device->enable();
    }

    public function volumeDown(): void
    {
        $volume = $this->device->getVolume();

        if ($volume === 0)
            return;

        $this->device->setVolume($volume - 1);
    }

    public function volumeUp(): void
    {
        $volume = $this->device->getVolume();

        if ($volume === 100)
            return;

        $this->device->setVolume($volume + 1);
    }

    public function channelUp(): void
    {
        $this->device->setChannel($this->device->getChannel() + 1);
    }

    public function channelDown(): void
    {
        $channel = $this->device->getChannel();

        if ($channel === 0)
            return;

        $this->device->setChannel($channel - 1);
    }
}

class AdvancedRemote extends Remote {
    public function mute(): void
    {
        $this->device->setVolume(0);
    }
}

$radio = new Radio();

$radioRemote = new Remote($radio);

$radioRemote->togglePower();

$radioRemote->channelUp();
$radioRemote->channelUp();

$radioRemote->volumeUp();
$radioRemote->volumeUp();
$radioRemote->volumeUp();

$radioRemote->togglePower();

var_dump($radio);

$tv = new TV();

$tvRemote = new AdvancedRemote($tv);

$tvRemote->togglePower();

$tvRemote->volumeUp();
$tvRemote->volumeUp();

$tvRemote->channelUp();

$tvRemote->mute();

$tvRemote->togglePower();

var_dump($tv);
