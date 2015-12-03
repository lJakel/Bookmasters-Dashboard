<?php
/**
 * Check Digit
 *
 * @author Fabio Alessandro Locati <fabiolocati@gmail.com>
 * @author linkkingjay <linkingjay@gmail.com>
 * @author Wenzel Pünter <wenzel@phelix.me>
 * @author Daniel Mejta <daniel@mejta.net>
 * @version 2.0.0
 * @package ISBN
*/
namespace Isbn;

/**
 * Translate
*/
class Translate
{
    /**
     * Check Digit Instance
     *
     * @var CheckDigit
    */    
    private $checkDigit;
    
    /**
     * Constructor
     *
     * @param CheckDigit $checkDigit
    */
    public function __construct(CheckDigit $checkDigit)
    {
        $this->checkDigit = $checkDigit;
    }

    /**
     * Convert $isbn to ISBN-10
     *
     * @param string $isbn
     * @return string
    */
    public function to10($isbn)
    {
        if (strlen($isbn) > 13) {
            $isbn = substr($isbn, 4, -1);
        } else {
            $isbn = substr($isbn, 3, -1);
        }

        return $isbn.$this->checkDigit->make($isbn);
    }

    /**
     * Convert $isbn to ISBN-13
     *
     * @param string $isbn
     * @return string
    */
    public function to13($isbn)
    {
        $isbn = substr($isbn, 0, -1);

        if (strlen($isbn) > 9) {
            $isbn = "978-".$isbn;
        } else {
            $isbn = "978".$isbn;
        }

        return $isbn.$this->checkDigit->make($isbn);
    }
}
