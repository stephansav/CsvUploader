<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UploadedFile
{
    /**
     * @Assert\File(
     *     mimeTypes = {"text/x-comma-separated-values","text/comma-separated-values","text/x-csv","text/csv",
     *     "text/plain","application/octet-stream","application/x-csv","application/csv"},
     *     mimeTypesMessage = "This document is invalid. The file type must be CSV"
     * )
     */
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }
}
