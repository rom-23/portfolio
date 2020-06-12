<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this -> email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail( $email ): void
    {
        $this -> email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this -> message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage( $message ): void
    {
        $this -> message = $message;
    }


}
