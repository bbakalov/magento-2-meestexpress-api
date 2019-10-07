<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Model\Service;

use Bdn\MeestExpress\Api\ApiConnectorInterface;
use Bdn\MeestExpress\Model\Config\MeestExpressConfig;
use Magento\Config\Model\Config\Backend\Encrypted;
use Magento\Framework\HTTP\ZendClientFactory;

/**
 * Class Api
 *
 * @package Bdn\MeestExpress\Model\Service
 */
abstract class AbstractApiConnector implements ApiConnectorInterface
{

    /**
     * HTTP request methods
     */
    const GET     = 'GET';
    const POST    = 'POST';
    const PUT     = 'PUT';
    const DELETE  = 'DELETE';

    /**
     * API error list
     *
     * @var array
     */
    protected $errorCodes = [];

    /**
     * @var string
     */
    protected $apiUser;

    /**
     * @var string
     */
    protected $apiPassword;

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @var string
     */
    protected $apiUrl;

    /** @var  \Magento\Framework\HTTP\ZendClient */
    protected $httpClient;

    /**
     * @var \Zend_Http_Response
     */
    protected $response;

    /**
     * @var \Bdn\MeestExpress\Model\Config\MeestExpressConfig
     */
    protected $meestExpressConfig;

    /**
     * @var Encrypted
     */
    protected $encrypted;

    /**
     * Api constructor.
     *
     * @param ZendClientFactory                              $httpClientFactory
     * @param MeestExpressConfig                             $meestExpressConfig
     * @param Encrypted $encrypted
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        MeestExpressConfig $meestExpressConfig,
        Encrypted $encrypted
    ) {
        $this->httpClient         = $httpClientFactory->create();
        $this->meestExpressConfig = $meestExpressConfig;
        $this->encrypted          = $encrypted;
        $this->apiUrl             = $meestExpressConfig->getApiUrl();
        $this->apiUser            = $meestExpressConfig->getApiUser();
        $this->apiPassword        = $this->encrypted->processValue($meestExpressConfig->getApiPassword());
        $this->apiToken           = $meestExpressConfig->getApiToken();
    }

    /**
     * Send request require array with params like this:
     * [ 'method' => 'methodName', 'data' => ['param1' => 'value1', 'param2' => 'value2']]
     *
     * @param array  $request
     * @param string $httpMethod
     */
    public function sendRequest(array $request = [], string $httpMethod = 'GET')
    {
        if (isset($request['data']['password'])) {
            $request['data']['password'] = $this->encrypted->processValue($request['data']['password']);
        }
        try {
            $client = $this->httpClient;
            if ($httpMethod === self::GET) {
                $uri = sprintf("%s/%s/%s", $this->apiUrl, $request['method'], implode('/', $request['data']));
            } else {
                $uri = sprintf("%s/%s/", $this->apiUrl, $request['method']);
                $client->setRawData(utf8_encode(json_encode($request['data'])));
            }
            $client->setUri($uri);
            $client->setHeaders('Content-Type', 'application/json');
            $client->setHeaders('token', $this->apiToken);

            $this->response = $client->request($httpMethod);
        } catch (\Zend_Http_Client_Exception $e) {

        }
    }

    /**
     * @return array
     * @throws \Zend_Http_Exception
     */
    public function getResponse(): array
    {
        $this->validateResponse();

        return json_decode($this->response->getBody(), true);
    }

    /**
     * @throws \Zend_Http_Exception
     */
    public abstract function validateResponse();

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setApiToken(string $token)
    {
        $this->apiToken = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiPassword(): string
    {
        return $this->apiPassword;
    }

    /**
     * @return string
     */
    public function getApiUser(): string
    {
        return $this->apiUser;
    }
}
