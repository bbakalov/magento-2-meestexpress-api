<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Model\Config;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\{
    ScopeConfigInterface,
    Storage\WriterInterface
};

/**
 * Class CourierConfig
 *
 * @package Bdn\MeestExpress\Model\Config
 */
class MeestExpressConfig
{

    const API_TOKEN_PATH = 'bdn_meesteexpress/api/token';

    const API_URL_PATH = 'bdn_meesteexpress/api/url';

    const API_USER_PATH = 'bdn_meesteexpress/api/user';

    const API_PASSWORD_PATH = 'bdn_meesteexpress/api/password';

    const API_VERSION = '3.0';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    private $cacheTypeList;

    /**
     * CourierConfig constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param WriterInterface      $configWriter
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        TypeListInterface $cacheTypeList
    ) {
        $this->scopeConfig   = $scopeConfig;
        $this->configWriter  = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return (string)$this->scopeConfig->getValue(self::API_TOKEN_PATH);
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return (string)$this->scopeConfig->getValue(self::API_URL_PATH);
    }

    /**
     * @return string
     */
    public function getApiUser(): string
    {
        return (string)$this->scopeConfig->getValue(self::API_USER_PATH);
    }

    /**
     * @return string
     */
    public function getApiPassword(): string
    {
        return (string)$this->scopeConfig->getValue(self::API_PASSWORD_PATH);
    }

    public function saveApiToken(
        string $value,
        string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        int $scopeId = 0
    ) {
        $this->configWriter->save(self::API_TOKEN_PATH, $value, $scope, $scopeId);
        $this->cacheTypeList->cleanType('config');
    }
}
