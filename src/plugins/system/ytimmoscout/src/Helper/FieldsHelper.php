<?php

namespace Joomla\Plugin\System\Ytimmoscout\Helper;


use Joomla\CMS\Document\Document;

class FieldsHelper
{
    public static function setFieldMappings($realestate)
    {
        $realestateRemapped = [];

        $realestateRemapped[] = [
                'id' => $realestate->{'@id'},
                'type' => $realestate->realestateType,
                'title' => $realestate->title,
                'externalId' => $realestate->externalId,
                'creationDate' => $realestate->{'creationDate'},
                'modifiedDate' => $realestate->{'lastModificationDate'},
                'street' => $realestate->address->street,
                'houseNumber' => $realestate->address->houseNumber,
                'zipCode' => $realestate->address->postcode,
                'city' => $realestate->address->city,
                'lat' => $realestate->address->wgs84Coordinate->latitude,
                'lng' => $realestate->address->wgs84Coordinate->longitude,
                'latlng' => $realestate->address->wgs84Coordinate->latitude . ',' . $realestate->address->wgs84Coordinate->longitude,
        ];

        if ($realestate->realestateType === 'apartmentRent' || $realestate->realestateType === 'apartmentBuy' ) {

            $realestateRemapped[] = [
                'groupNumber' => $realestate->groupNumber,
                'descriptionNote' => $realestate->descriptionNote,
                'furnishingNote' => $realestate->furnishingNote,
                'locationNote' => $realestate->locationNote,
                'otherNote' => $realestate->otherNote,
                'lift' => $realestate->lift,
                'energyCertificateCreationDate' => $realestate->energyCertificate->energyCertificateCreationDate,
                'energyEfficiencyClass' => $realestate->energyCertificate->energyEfficiencyClass,
                'cellar' => $realestate->cellar,
                'handicappedAccessible' => $realestate->handicappedAccessible,
                'condition' => $realestate->condition,
                'constructionYear' => $realestate->constructionYear,
                'freeFrom' => $realestate->freeFrom,
                'heatingType' => $realestate->heatingType,
                'heatingTypeEnev2014' => $realestate->heatingTypeEnev2014,
                'energySourcesEnev2014' => $realestate->energySourcesEnev2014->energySourceEnev2014,
                'buildingEnergyRatingType' => $realestate->buildingEnergyRatingType,
                'thermalCharacteristic' => $realestate->thermalCharacteristic,
                'energyConsumptionContainsWarmWater' => $realestate->energyConsumptionContainsWarmWater,
                'guestToilet' => $realestate->guestToilet,
                'baseRent' => $realestate->baseRent,
                'totalRent' => $realestate->totalRent,
                'serviceCharge' => $realestate->serviceCharge,
                'deposit' => $realestate->deposit,
                'heatingCostsInServiceCharge' => $realestate->heatingCostsInServiceCharge,
                'petsAllowed' => $realestate->petsAllowed,
                'useAsFlatshareRoom' => $realestate->useAsFlatshareRoom,
                'livingSpace' => $realestate->livingSpace,
                'numberOfRooms' => $realestate->numberOfRooms,
                'energyPerformanceCertificate' => $realestate->energyPerformanceCertificate,
                'builtInKitchen' => $realestate->builtInKitchen,
                'balcony' => $realestate->balcony,
                'garden' => $realestate->garden,
                'courtage' => $realestate->courtage->hasCourtage,
                'certificateOfEligibilityNeeded' => $realestate->certificateOfEligibilityNeeded,
                'realestateState' => $realestate->realEstateState,
            ];

            foreach ($realestate->firingTypes as $firingType) {
                $realestateRemapped[0]['firingTypes'] = $firingType;
            }
        }



        if ($realestate->realestateType === 'houseBuy' || $realestate->realestateType === 'houseRent' ) {

            $realestateRemapped[] = [
                'groupNumber' => $realestate->groupNumber,
                'descriptionNote' => $realestate->descriptionNote,
                'furnishingNote' => $realestate->furnishingNote,
                'locationNote' => $realestate->locationNote,
                'otherNote' => $realestate->otherNote,
                'lift' => $realestate->lift,
                'energyCertificateCreationDate' => $realestate->energyCertificate->energyCertificateCreationDate,
                'energyEfficiencyClass' => $realestate->energyCertificate->energyEfficiencyClass,
                'cellar' => $realestate->cellar,
                'handicappedAccessible' => $realestate->handicappedAccessible,
                'condition' => $realestate->condition,
                'constructionYear' => $realestate->constructionYear,
                'freeFrom' => $realestate->freeFrom,
                'heatingType' => $realestate->heatingType,
                'heatingTypeEnev2014' => $realestate->heatingTypeEnev2014,
                'energySourcesEnev2014' => $realestate->energySourcesEnev2014->energySourceEnev2014,
                'buildingEnergyRatingType' => $realestate->buildingEnergyRatingType,
                'thermalCharacteristic' => $realestate->thermalCharacteristic,
                'energyConsumptionContainsWarmWater' => $realestate->energyConsumptionContainsWarmWater,
                'guestToilet' => $realestate->guestToilet,
                'baseRent' => $realestate->baseRent,
                'totalRent' => $realestate->totalRent,
                'serviceCharge' => $realestate->serviceCharge,
                'deposit' => $realestate->deposit,
                'heatingCostsInServiceCharge' => $realestate->heatingCostsInServiceCharge,
                'petsAllowed' => $realestate->petsAllowed,
                'useAsFlatshareRoom' => $realestate->useAsFlatshareRoom,
                'livingSpace' => $realestate->livingSpace,
                'numberOfRooms' => $realestate->numberOfRooms,
                'energyPerformanceCertificate' => $realestate->energyPerformanceCertificate,
                'builtInKitchen' => $realestate->builtInKitchen,
                'balcony' => $realestate->balcony,
                'garden' => $realestate->garden,
                'courtage' => $realestate->courtage->hasCourtage,
                'certificateOfEligibilityNeeded' => $realestate->certificateOfEligibilityNeeded,
                'price' => $realestate->price->value,
                'currency' => $realestate->price->currency,
                'realestateState' => $realestate->realEstateState,
                'titlePicture' => $realestate->titlePicture,
                'titlePictureUrl' => $realestate->titlePicture->urls[0]->url[0]->{'@href'},
            ];

            foreach ($realestate->firingTypes as $firingType) {
                $realestateRemapped[0]['firingTypes'] = $firingType;
            }
        }


        if ($realestate->realestateType === 'livingRentSite' || $realestate->realestateType === 'livingBuySite' ) {

            $realestateRemapped[] = [
                'groupNumber' => $realestate->groupNumber,
                'descriptionNote' => $realestate->descriptionNote,
                'locationNote' => $realestate->locationNote,
                'otherNote' => $realestate->otherNote,

                // Gemeinsame Felder für beide Immobilienarten
                'freeFrom' => $realestate->freeFrom,
                'hasCourtage' => $realestate->hasCourtage,
                'currency' => $realestate->currency,
                'creationDate' => $realestate->creationDate,
                'LastModificationDate' => $realestate->LastModificationDate,
                'marketingType' => $realestate->marketingType,
                'priceIntervalType' => $realestate->priceIntervalType,

                // Felder spezifisch für livingRentSite
                'tenancy' => $realestate->tenancy,
                'value' => $realestate->value,
                'plotArea' => $realestate->plotArea,
                'shortTermConstructible' => $realestate->shortTermConstructible,
                'buildingPermission' => $realestate->buildingPermission,
                'demolition' => $realestate->demolition,
                'siteDevelopmentType' => $realestate->siteDevelopmentType,
                'siteConstructibleType' => $realestate->siteConstructibleType,
                'grz' => $realestate->grz,
                'gfz' => $realestate->gfz,
                'latitude' => $realestate->latitude,
                'longitude' => $realestate->longitude,

                // Felder spezifisch für livingBuySite
                'recommendedUseTypes' => $realestate->recommendedUseTypes,
            ];


            foreach ($realestate->firingTypes as $firingType) {
                $realestateRemapped[0]['firingTypes'] = $firingType;
            }
        }

        if ($realestate->realestateType === 'garageRent' || $realestate->realestateType === 'garageBuy' ) {

            $realestateRemapped[] = [
                'groupNumber' => $realestate->groupNumber,
                'descriptionNote' => $realestate->descriptionNote,
                'locationNote' => $realestate->locationNote,
                'otherNote' => $realestate->otherNote,

                // Gemeinsame Felder für beide Immobilienarten
                'freeFrom' => $realestate->freeFrom,
                'hasCourtage' => $realestate->hasCourtage,
                'currency' => $realestate->currency,
                'creationDate' => $realestate->creationDate,
                'LastModificationDate' => $realestate->LastModificationDate,
                'marketingType' => $realestate->marketingType,
                'priceIntervalType' => $realestate->priceIntervalType,

                // Felder spezifisch für livingRentSite
                'tenancy' => $realestate->tenancy,
                'value' => $realestate->value,
                'plotArea' => $realestate->plotArea,
                'shortTermConstructible' => $realestate->shortTermConstructible,
                'buildingPermission' => $realestate->buildingPermission,
                'demolition' => $realestate->demolition,
                'siteDevelopmentType' => $realestate->siteDevelopmentType,
                'siteConstructibleType' => $realestate->siteConstructibleType,
                'grz' => $realestate->grz,
                'gfz' => $realestate->gfz,
                'latitude' => $realestate->latitude,
                'longitude' => $realestate->longitude,

                // Felder spezifisch für livingBuySite
                'recommendedUseTypes' => $realestate->recommendedUseTypes,
            ];


            foreach ($realestate->firingTypes as $firingType) {
                $realestateRemapped[0]['firingTypes'] = $firingType;
            }
        }


        if ($realestate->realestateType === 'garageRent' || $realestate->realestateType === 'garageBuy') {

            $realestateRemapped[] = [
                'groupNumber' => $realestate->groupNumber,
                'descriptionNote' => $realestate->descriptionNote,
                'locationNote' => $realestate->locationNote,
                'otherNote' => $realestate->otherNote,
                'freeFrom' => $realestate->freeFrom,
                'hasCourtage' => $realestate->hasCourtage,
                'currency' => $realestate->currency,
                'creationDate' => $realestate->creationDate,
                'LastModificationDate' => $realestate->LastModificationDate,
                'marketingType' => $realestate->marketingType,
                'priceIntervalType' => $realestate->priceIntervalType,
                'latitude' => $realestate->latitude,
                'longitude' => $realestate->longitude,
            ];

            if ($realestate->realestateType === 'garageRent') {
                $realestateRemapped[0] += [
                    'tenancy' => $realestate->tenancy,
                    'value' => $realestate->value,
                    'plotArea' => $realestate->plotArea,
                    'shortTermConstructible' => $realestate->shortTermConstructible,
                    'buildingPermission' => $realestate->buildingPermission,
                    'demolition' => $realestate->demolition,
                    'siteDevelopmentType' => $realestate->siteDevelopmentType,
                    'siteConstructibleType' => $realestate->siteConstructibleType,
                    'grz' => $realestate->grz,
                    'gfz' => $realestate->gfz,
                ];
            }

            if ($realestate->realestateType === 'garageBuy') {
                $realestateRemapped[0] += [
                    'furnishingNote' => $realestate->furnishingNote,
                    'additionalCosts' => $realestate->additionalCosts,
                    'usableFloorSpace' => $realestate->usableFloorSpace,
                    'freeUntil' => $realestate->freeUntil,
                    'garageType' => $realestate->garageType,
                    'constructionYear' => $realestate->constructionYear,
                    'constructionYearUnknown' => $realestate->constructionYearUnknown,
                    'lengthGarage' => $realestate->lengthGarage,
                    'widthGarage' => $realestate->widthGarage,
                    'heightGarage' => $realestate->heightGarage,
                    'condition' => $realestate->condition,
                    'lastRefurbishment' => $realestate->lastRefurbishment,
                ];
            }

            foreach ($realestate->firingTypes as $firingType) {
                $realestateRemapped[0]['firingTypes'] = $firingType;
            }
        }



        return $realestateRemapped;
    }

}
