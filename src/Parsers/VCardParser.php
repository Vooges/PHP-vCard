<?php

namespace JesseVooges\PHPvCard\Parsers;

use JesseVooges\PHPvCard\Exceptions\NoVCardsException;
use JesseVooges\PHPvCard\Exceptions\UnsupportedTypeException;
use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\VCard;

final class VCardParser
{
    private array $vCards;

    /**
     * @param VCard|VCard[] $toAdd The vCard(s) to add.
     * 
     * @throws UnsupportedTypeException
     */
    public function __construct(mixed $toAdd = null)
    {
        if($toAdd !== null)
        {
            TypeChecker::check($toAdd, VCard::class);
        }

        $this->vCards = gettype($toAdd) === 'array' ? $toAdd : [$toAdd];
    }

    /**
     * Adds the provided vCards to the VCardParser instance
     * 
     * @param VCard|VCard[] $toAdd The vCard(s) to add.
     * 
     * @throws UnsupportedTypeException
     */
    public function add(mixed $toAdd){
        TypeChecker::check($toAdd, VCard::class);

        array_push($this->vCards, gettype($toAdd) === 'array' ? $toAdd : [$toAdd]);
    }

    /**
     * Creates a .vcf file at the specified path and adds all the vCards to it. Will overwrite existing .vcf file with the same filename.
     * 
     * @param string $path The path to where the file should be created.
     * @param string $filename The name of the file to create.
     */
    public function toFile(string $path, string $filename = 'contacts')
    {
        /**
         * Check if the vCards array is empty to prevent empty .vcf file from being written.s
         */
        if(count($this->vCards) === 0)
        {
            throw new NoVCardsException();
        }

        /**
         * Assemble the total path and create the file.
         */
        $totalPath = $path . '\\' . $filename . '.vcf';
        $file = fopen($totalPath, 'w');
        
        /**
         * Write the parsed vCards to the file
         */
        foreach($this->vCards as $v)
        {
            fwrite($file, $v->parse() . "\r\n");
        }

        fclose($file);
    }

    /**
     * Parses all vCards and puts them in a single string
     * 
     * @return String
     */
    public function parse(): string
    {
        $content = '';

        /**
         * Write the parsed vCards to the content string.
         */
        foreach($this->vCards as $v)
        {
            $content .= $v->parse() . "\r\n";
        }

        return $content;
    }
}