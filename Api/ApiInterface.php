<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Api;

/**
 * Interface ApiInterface
 *
 * @package Bdn\MeestExpress\Api
 */
interface ApiInterface
{

    /**
     * @return array
     * @throws \Zend_Http_Exception
     */
    public function auth(): array;


    /**
     * @param string $refreshToken
     *
     * @return array
     */
    public function refreshToken(string $refreshToken): array;

    /**
     * @param string $cityId
     * @param string $addressDescriptionLike
     *
     * @return array
     * @throws \Zend_Http_Exception
     */
    public function addressSearch(string $cityId, string $addressDescriptionLike = ''): array;

    /**
     * @param string $countryDescriptionLike
     * @param string $countryId
     *
     * @return array
     */
    public function countrySearch(string $countryDescriptionLike, string $countryId = ''): array;

    /**
     * @param string $regionId
     * @param string $regionDescriptionLike
     * @param string $countryId
     * @param string $countryDescriptionLike
     *
     * @return array
     */
    public function regionSearch(
        string $regionId = '',
        string $regionDescriptionLike = '',
        string $countryId = '',
        string $countryDescriptionLike = ''
    ): array;

    /**
     * @param string $districtId
     * @param string $districtDescr
     * @param string $regionId
     * @param string $regionDescr
     *
     * @return array
     */
    public function districtSearch(
        string $districtId = '',
        string $districtDescr = '',
        string $regionId = '',
        string $regionDescr = ''
    ): array;

    /**
     * @param string $cityId
     * @param string $cityDescr
     * @param string $countryId
     * @param string $districtId
     * @param string $districtDescr
     * @param string $regionId
     * @param string $regionDescr
     *
     * @return array
     */
    public function citySearch(
        string $cityId = '',
        string $cityDescr = '',
        string $countryId = '',
        string $districtId = '',
        string $districtDescr = '',
        string $regionId = '',
        string $regionDescr = ''
    ): array;

    /**
     * @param string $zipCode
     *
     * @return array
     */
    public function zipCodeSearch(string $zipCode): array;

    /**
     * @return array
     */
    public function branchTypes(): array;

    /**
     * @param int $branchNo
     * @param string $branchTypeID
     * @param string $branchDescr
     * @param string $cityId
     * @param string $cityDescr
     * @param string $countryId
     * @param string $districtId
     * @param string $districtDescr
     * @param string $regionId
     * @param string $regionDescr
     *
     * @return array
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
    ): array;

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return array
     */
    public function payTerminalSearch(float $latitude, float $longitude): array;

    /**
     * @param array $generalInfo
     * @param array $sender
     * @param array $receiver
     * @param array $specConditionsItems
     * @param array $placesItems
     * @param array $contentsItems
     * @param array $codPaymentsItems
     *
     * @return array
     */
    public function parcelCreate(
        array $generalInfo,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems,
        array $contentsItems,
        array $codPaymentsItems
    ): array;

    /**
     * @param string $parcelId
     * @param array  $sender
     * @param array  $receiver
     * @param array  $specConditionsItems
     * @param array  $placesItems
     * @param array  $contentsItems
     * @param array  $codPaymentsItems
     *
     * @return array
     */
    public function parcelUpdate(
        string $parcelId,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems,
        array $contentsItems,
        array $codPaymentsItems
    ): array;

    /**
     * @param string $parcelId
     *
     * @return array
     */
    public function parcelDelete(string $parcelId): array;

    /**
     * @param array $generalInfo
     * @param array $sender
     * @param array $receiver
     * @param array $specConditionsItems
     * @param array $placesItems
     *
     * @return array
     */
    public function calculate(
        array $generalInfo,
        array $sender,
        array $receiver,
        array $specConditionsItems,
        array $placesItems
    ): array;

    /**
     * @param string $sendingDate
     *
     * @return array
     */
    public function parcelsList(string $sendingDate): array;

    /**
     * @return array
     */
    public function packTypes(): array;

    /**
     * @return array
     */
    public function specConditions(): array;

    /**
     * @param string $parcelId
     *
     * @return array
     */
    public function info4Sticker(string $parcelId): array;

    /**
     * @param string $notation
     * @param string $contractId
     * @param array  $parcelsItems
     *
     * @return array
     */
    public function registerBranchCreate(string $notation, string $contractId, array $parcelsItems): array;

    /**
     * @param string $registerId
     * @param string $notation
     * @param string $contractId
     * @param array  $parcelsItems
     *
     * @return array
     */
    public function registerBranchUpdate(
        string $registerId,
        string $notation,
        string $contractId,
        array $parcelsItems
    ): array;

    /**
     * @param string $registerId
     *
     * @return array
     */
    public function registerBranchDelete(string $registerId): array;

    /**
     * @param array $generalInfo
     * @param array $expectedPickUpDate
     * @param array $sender
     * @param array $parcelsItems
     *
     * @return array
     */
    public function registerPickupCreate(
        array $generalInfo,
        array $expectedPickUpDate,
        array $sender,
        array $parcelsItems
    ): array;

    /**
     * @param string $registerId
     * @param array  $generalInfo
     * @param array  $expectedPickUpDate
     * @param array  $sender
     * @param array  $parcelsItems
     *
     * @return array
     */
    public function registerPickupUpdate(
        string $registerId,
        array $generalInfo,
        array $expectedPickUpDate,
        array $sender,
        array $parcelsItems
    ): array;

    /**
     * @param string $registerId
     *
     * @return array
     */
    public function registerPickupDelete(string $registerId): array;

    /**
     * @param string $sendingDate
     *
     * @return array
     */
    public function registersList(string $sendingDate): array;

    /**
     * @param string $printValue
     * @param string $contentType
     * @param string $termoprint
     *
     * @return array
     */
    public function printSticker(string $printValue, string $contentType, string $termoprint): array;

    /**
     * @param string $printValue
     * @param string $contentType
     *
     * @return array
     */
    public function printDeclaration(string $printValue, string $contentType): array;

    /**
     * @param string $printValue
     * @param string $contentType
     *
     * @return array
     */
    public function printRegister(string $printValue, string $contentType): array;

    /**
     * @param $printValue
     * @param $contentType
     *
     * @return array
     */
    public function printCn23($printValue, $contentType): array;

    /**
     * @param string $trackNumber
     *
     * @return array
     */
    public function tracking(string $trackNumber): array;
}
