<?php

namespace PCsoft\RakanFon\Contracts;

interface Operation
{
    /**
     * Get operation type.
     *
     * @return string
     */
    public function getType(): ?string;

    /**
     * Get operation trackingId.
     *
     * @return string
     */
    public function getTrakingId(): string;

    /**
     * Converet operation to message.
     *
     * @return string
     */
    public function toMessage(): string;
}
