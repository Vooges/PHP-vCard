<?php

namespace JesseVooges\PHPvCard\Properties;

use JesseVooges\PHPvCard\Properties\Property;
use JesseVooges\PHPvCard\Properties\Interfaces\PropertyInterface;

final class Photo extends Property implements PropertyInterface
{
    private string $url;
    private string $fileType;

    /**
     * Represents the photo property on a vCard.
     * 
     * @param String $url The url to the person's photo.
     * @param String $type The file type of the person's photo.
     */
    public function __construct(string $url, string $fileType)
    {
        $this->url = $url;
        $this->fileType = $fileType;
    }

    public function parse(): string
    {
        return 'PHOTO:MEDIATYPE=image/'. $this->fileType . ':' . $this->url;
    }
}