<?php

namespace VkApi\Classes;

abstract class Base {

    /**
     * Version VK API.
     *
     * @var float
     */
    protected $apiVersion;

    /**
     * Access VK token
     *
     * @var string
     */
    private static $accessToken = 'your-token';

    public function __construct()
    {
        $this->accessToken = self::$accessToken;
        $this->apiVersion = 5.126;
    }
}