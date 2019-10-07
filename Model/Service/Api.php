<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Model\Service;

use Bdn\MeestExpress\Api\ApiInterface;
use Bdn\MeestExpress\Api\ApiConnectorInterface;
use Bdn\MeestExpress\Model\Config\MeestExpressConfig;

/**
 * Class Api
 *
 * @package Bdn\MeestExpress\Model\Service
 */
class Api implements ApiInterface
{

    /**
     * @var ApiConnectorInterface
     */
    private $apiConnector;

    /**
     * @var MeestExpressConfig
     */
    private $meestExpressConfig;

    public function __construct(
        ApiConnectorInterface $apiConnector,
        MeestExpressConfig $meestExpressConfig
    ) {
        $this->apiConnector       = $apiConnector;
        $this->meestExpressConfig = $meestExpressConfig;
    }

    /**
     * {@inheritDoc}
     */
    public function auth(string $username = '', string $password = ''): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'auth',
            'data'   => [
                'username' => $username ?: $this->meestExpressConfig->getApiUser(),
                'password' => $password ?: $this->meestExpressConfig->getApiPassword(),
            ],
        ], AbstractApiConnector::POST);
        $this->apiConnector->setApiToken($this->apiConnector->getResponse()['result']['token']);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function refreshToken(string $refreshToken): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'refreshToken',
            'data'   => [
                'refreshToken' => $refreshToken,
            ],
        ]);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function countrySearch(string $countryDescriptionLike, string $countryId = ''): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'countrySearch',
            'data'   => [
                'filters' => [
                    "countryID"    => "{$countryId}",
                    "countryDescr" => "{$countryDescriptionLike}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function regionSearch(
        string $regionId = '',
        string $regionDescriptionLike = '',
        string $countryId = '',
        string $countryDescriptionLike = ''
    ): array {
        $this->apiConnector->sendRequest([
            'method' => 'regionSearch',
            'data'   => [
                'filters' => [
                    "regionID"     => $regionId,
                    "regionDescr"  => "%{$regionDescriptionLike}%",
                    "countryID"    => $countryId,
                    "countryDescr" => "{$countryDescriptionLike}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function districtSearch(
        string $districtId = '',
        string $districtDescr = '',
        string $regionId = '',
        string $regionDescr = ''
    ): array {
        $this->apiConnector->sendRequest([
            'method' => 'districtSearch',
            'data'   => [
                'filters' => [
                    "districtID"    => $districtId,
                    "districtDescr" => "%{$districtDescr}%",
                    "regionID"      => $regionId,
                    "regionDescr"   => "%{$regionDescr}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function citySearch(
        string $cityId = '',
        string $cityDescr = '',
        string $countryId = '',
        string $districtId = '',
        string $districtDescr = '',
        string $regionId = '',
        string $regionDescr = ''
    ): array {
        $this->apiConnector->sendRequest([
            'method' => 'citySearch',
            'data'   => [
                'filters' => [
                    "cityID"        => $cityId,
                    "cityDescr"     => "%{$cityDescr}%",
                    "countryID"     => $countryId,
                    "districtID"    => $districtId,
                    "districtDescr" => "%{$districtDescr}%",
                    "regionID"      => $regionId,
                    "regionDescr"   => "%{$regionDescr}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function zipCodeSearch(string $zipCode): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'zipCodeSearch',
            'data'   => [$zipCode],
        ], AbstractApiConnector::GET);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function addressSearch(string $cityId, string $addressDescriptionLike = ''): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'addressSearch',
            'data'   => [
                'filters' => [
                    "cityID"       => $cityId,
                    "addressDescr" => "%{$addressDescriptionLike}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function branchTypes(): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'branchTypes',
            'data'   => [],
        ], AbstractApiConnector::GET);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function branchSearch(
        int $branchNo = 0,
        string $branchTypeID = '',
        string $branchDescr = '',
        string $cityId = '',
        string $cityDescr = '',
        string $countryId = '',
        string $districtId = '',
        string $districtDescr = '',
        string $regionId = '',
        string $regionDescr = ''
    ): array {
        $this->apiConnector->sendRequest([
            'method' => 'branchSearch',
            'data'   => [
                'filters' => [
                    "branchNo"      => $branchNo,
                    "branchTypeID"  => $branchTypeID,
                    "branchDescr"   => "%{$branchDescr}%",
                    "cityID"        => $cityId,
                    "cityDescr"     => "%{$cityDescr}%",
                    "districtID"    => $districtId,
                    "districtDescr" => "%{$districtDescr}%",
                    "regionID"      => $regionId,
                    "regionDescr"   => "%{$regionDescr}%",
                ],
            ],
        ], AbstractApiConnector::POST);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function payTerminalSearch(float $latitude, float $longitude): array
    {
        $this->apiConnector->sendRequest([
            'method' => 'payTerminalSearch',
            'data'   => [$latitude, $longitude],
        ], AbstractApiConnector::GET);

        return $this->apiConnector->getResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function parcelCreate(
        array $generalInfo,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems,
        array $contentsItems,
        array $codPaymentsItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function parcelUpdate(
        string $parcelId,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems,
        array $contentsItems,
        array $codPaymentsItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function parcelDelete(string $parcelId): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function calculate(
        array $generalInfo,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function parcelsList(string $sendingDate): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function packTypes(): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function specConditions(): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function info4Sticker(string $parcelId): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerBranchCreate(string $notation, string $contractId, array $parcelsItems): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerBranchUpdate(
        string $registerId,
        string $notation,
        string $contractId,
        array $parcelsItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerBranchDelete(string $registerId): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerPickupCreate(
        array $generalInfo,
        array $expectedPickUpDate,
        array $sender,
        array $parcelsItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerPickupUpdate(
        string $registerId,
        array $generalInfo,
        array $expectedPickUpDate,
        array $sender,
        array $parcelsItems
    ): array {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registerPickupDelete(string $registerId): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function registersList(string $sendingDate): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function printSticker(string $printValue, string $contentType, string $termoprint): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function printDeclaration(string $printValue, string $contentType): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function printRegister(string $printValue, string $contentType): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function printCn23($printValue, $contentType): array
    {
        return ['Not implemented yet'];
    }

    /**
     * {@inheritDoc}
     */
    public function tracking(string $trackNumber): array
    {
        return ['Not implemented yet'];
    }
}
