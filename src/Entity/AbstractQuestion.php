<?php

namespace App\Entity;

abstract class AbstractQuestion
{
    /** var string $label */
    protected $label;

    /** var array $label */
    protected $notes;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return array
     */
    abstract public function computeValues();
}
