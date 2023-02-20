<?php

namespace App\Entities;
use Doctrine\ORM\Mapping AS ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="integer")
     */
    protected $gender;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="date")
     */
    protected $email_verified_at;

    /**
     * @ORM\Column(type="date")
     */
    protected $two_factor_confirmed_at;

    /**
     * @ORM\Column(type="date")
     */
    protected $birth;

    /**
     * @ORM\Column(type="integer")
     */
    protected $city_id;
}
