<?php

namespace JesseVooges\PHPvCard\Parsers;

use JesseVooges\PHPvCard\Exceptions\NoVCardsException;
use InvalidArgumentException;
use JesseVooges\PHPvCard\Exceptions\VCardNotFoundException;
use JesseVooges\PHPvCard\Helpers\TypeChecker;
use JesseVooges\PHPvCard\VCard;

final class VCardParser
{
    private array $vCards = [];

    /**
     * @param VCard|VCard[] $toAdd Optional. The vCard(s) to add.
     * 
     * @throws InvalidArgumentException
     */
    public function __construct(mixed $toAdd = null)
    {
        if($toAdd !== null)
        {
            TypeChecker::check($toAdd, VCard::class);
            
            /**
            * Check if $toAdd is an array and cast to array if it isn't, then add it to the vCards array.
             */

            $this->vCards = array_merge(
                $this->vCards, 
                gettype($toAdd) === 'array' 
                    ? $toAdd 
                    : [$toAdd]
            );
        }
    }

    /**
     * Adds the provided vCards to the VCardParser instance
     * 
     * @param VCard|VCard[] $toAdd The vCard(s) to add.
     * 
     * @throws InvalidArgumentException
     */
    public function add(mixed $toAdd) : void
    {
        TypeChecker::check($toAdd, VCard::class);

        /**
         * Check if $toAdd is an array and cast to array if it isn't, then add it to the vCards array.
         */
        $this->vCards = array_merge(
            $this->vCards, 
            gettype($toAdd) === 'array' 
                ? $toAdd 
                : [$toAdd]
        );
    }

    /**
     * Removes the provided vCards.
     * 
     * @param Integer|Integer[] $toRemove The indexes for the vCard(s) to remove.
     * 
     * @throws InvalidArgumentException
     * @throws VCardNotFoundException
     */
    public function remove(mixed $toRemove) : void
    {
        /**
         * Check if $toRemove is an array and cast to array if it isn't.
         */
        $toRemove = gettype($toRemove) === 'array' ? $toRemove : [$toRemove];

        foreach($toRemove as $r)
        {
            if(gettype($r) !== 'integer')
            {
                throw new InvalidArgumentException();
            }
        }

        /**
         * Remove each array element from the vCards array.
         */
        foreach($toRemove as $r)
        {
            /**
             * Check if vCard has been added.
             */
            if(!array_key_exists($r, $this->vCards))
            {
                throw new VCardNotFoundException();
            }

            /**
             * Remove vCard.
             */
            unset($this->vCards[$r]);
        }

        /**
         * Reset indexing on vCard array.
         */
        $this->vCards = array_values($this->vCards);
    }

    /**
     * Creates a .vcf file at the specified path and adds all the vCards to it. 
     * Will overwrite the file if it already exists.
     * 
     * @param string $path The path to where the file should be created.
     * @param string $filename Optional. The name of the file to create. Default: contacts.
     */
    public function toFile(string $path, string $filename = 'contacts') : void
    {
        /**
         * Check if the vCards array is empty to prevent empty .vcf file from being written.
         */
        if(count($this->vCards) === 0)
        {
            throw new NoVCardsException();
        }

        /**
         * Assemble the total path and create the file.
         */
        $totalPath = $path . "/" . $filename . '.vcf';
        $file = fopen($totalPath, 'w');
        
        /**
         * Write the parsed vCards to the file
         */        
        fwrite($file, $this->parse());

        fclose($file);
    }

    /**
     * Parses all vCards and puts them in a single string.
     * 
     * @return String
     */
    public function parse() : string
    {
        $content = "";

        /**
         * Write the parsed vCards to the content string.
         */
        foreach($this->vCards as $v)
        {
            $content .= $v->parse();
        }

        return $content;
    }

    public function getVCards() : array
    {
        return $this->vCards;
    }
}