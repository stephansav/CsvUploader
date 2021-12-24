<?php

namespace App\Entity;

class WellBeingQuestion extends AbstractQuestion
{
    public function __construct(string $label, array $notes)
    {
        $this->label = $label;
        $this->notes = $notes;
    }

    public function computeValues(): array
    {
        if (null == $this->label && null == $this->notes) {
            return null;
        }

        return [
            'question' => [
                'label' => $this->label,
                'statistics' => [
                    'min' => (float) min($this->notes),
                    'max' => (float) max($this->notes),
                    'mean' => array_sum($this->notes) / count($this->notes),
                ],
            ],
        ];
    }
}
