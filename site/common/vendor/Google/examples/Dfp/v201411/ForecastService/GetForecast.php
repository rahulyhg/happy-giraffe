<?php
/**
 * This example gets a forecast for a prospective line item. To determine which
 * placements exist, run GetAllPlacements.php.
 *
 * Tags: ForecastService.getForecast
 *
 * PHP version 5
 *
 * Copyright 2013, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    GoogleApiAdsDfp
 * @subpackage v201411
 * @category   WebServices
 * @copyright  2013, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Eric Koleda
 * @author     Vincent Tsao
 */
error_reporting(E_STRICT | E_ALL);

// You can set the include path to src directory or reference
// DfpUser.php directly via require_once.
// $path = '/path/to/dfp_api_php_lib/src';
$path = dirname(__FILE__) . '/../../../../src';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once 'Google/Api/Ads/Dfp/Lib/DfpUser.php';
require_once dirname(__FILE__) . '/../../../Common/ExampleUtils.php';
require_once 'Google/Api/Ads/Dfp/Util/DateTimeUtils.php';

try {
  // Get DfpUser from credentials in "../auth.ini"
  // relative to the DfpUser.php file's directory.
  $user = new DfpUser();

  // Log SOAP XML request and response.
  $user->LogDefaults();

  // Get the ForecastService.
  $forecastService = $user->GetService('ForecastService', 'v201411');

  // Set the placement ID that the prospective line item will target.
  $targetPlacementId = 'INSERT_PLACEMENT_ID_HERE';

  // Create prospective line item.
  $lineItem = new LineItem();
  $lineItem->lineItemType = 'SPONSORSHIP';

  // Create inventory targeting.
  $inventoryTargeting = new InventoryTargeting();
  $inventoryTargeting->targetedPlacementIds = array($targetPlacementId);

  // Set targeting for line item.
  $targeting = new Targeting();
  $targeting->inventoryTargeting = $inventoryTargeting;
  $lineItem->targeting = $targeting;

  // Create the creative placeholder.
  $creativePlaceholder = new CreativePlaceholder();
  $creativePlaceholder->size = new Size(300, 250, FALSE);

  // Set the size of creatives that can be associated with this line item.
  $lineItem->creativePlaceholders = array($creativePlaceholder);

  // Set the line item's time to be now until the projected end date time.
  $lineItem->startDateTimeType = 'IMMEDIATELY';
  $lineItem->endDateTime =
      DateTimeUtils::GetDfpDateTime(new DateTime('+1 week'));

  // Set the line item to use 50% of the impressions.
  $goal = new Goal();
  $goal->units = 50;
  $goal->goalType = 'DAILY';
  $lineItem->primaryGoal = $goal;

  // Set the cost type to match the unit type.
  $lineItem->costType = 'CPM';

  // Get forecast for line item.
  $forecast = $forecastService->getForecast($lineItem);

  // Display results.
  $matchedUnits = $forecast->matchedUnits;
  $percentAvailableUnits = $forecast->availableUnits / $matchedUnits * 100;
  $unitType = strtolower($forecast->unitType);

  printf("%d %s matched.\n", $matchedUnits, $unitType);
  printf("%d%% %s available.\n",$percentAvailableUnits, $unitType);

  if (isset($forecast->possibleUnits)) {
    $percentPossibleUnits = $forecast->possibleUnits / $matchedUnits * 100;
    printf("%d%% %s possible.\n", $percentPossibleUnits, $unitType);
  }

  printf("%d contending line items.\n", count($forecast->contendingLineItems));
} catch (OAuth2Exception $e) {
  ExampleUtils::CheckForOAuth2Errors($e);
} catch (ValidationException $e) {
  ExampleUtils::CheckForOAuth2Errors($e);
} catch (Exception $e) {
  printf("%s\n", $e->getMessage());
}

