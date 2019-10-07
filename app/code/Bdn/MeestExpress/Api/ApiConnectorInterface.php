<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Api;

/**
 * Interface ApiConnectorInterface
 *
 * @package Bdn\MeestExpress\Api
 */
interface ApiConnectorInterface
{

    /**
     * @param array  $request
     *
     * @param string $httpMethod
     *
     * @return void
     */
    function sendRequest(array $request = [], string $httpMethod = 'GET');

    /**
     * @return array
     */
    function getResponse(): array;

    /**
     * @return void
     */
    function validateResponse();

    /**
     * @param string $token
     *
     * @return $this
     */
    function setApiToken(string $token);
}
