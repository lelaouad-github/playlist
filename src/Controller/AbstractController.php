<?php

namespace App\Controller;

use App\Mapper\AbstractMapper;

abstract class AbstractController
{
    /**
     * @var AbstractMapper
     */
    protected $mapper;

    public function __construct(AbstractMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}