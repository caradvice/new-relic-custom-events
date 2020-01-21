<?php


namespace CarAdvice\NewRelic\CustomEvents\Contracts;


use GuzzleHttp\Psr7\Response;

interface ApiClientContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function send(array $data = []): Response;
}