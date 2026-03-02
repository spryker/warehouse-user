<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\WarehouseUser\Business\Mapper;

use Generated\Shared\Transfer\WarehouseUserAssignmentCollectionDeleteCriteriaTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentConditionsTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentCriteriaTransfer;

class WarehouseUserAssignmentCriteriaMapper implements WarehouseUserAssignmentCriteriaMapperInterface
{
    public function mapWarehouseUserAssignmentCollectionDeleteCriteriaTransferToWarehouseUserAssignmentCriteriaTransfer(
        WarehouseUserAssignmentCollectionDeleteCriteriaTransfer $warehouseUserAssignmentCollectionDeleteCriteriaTransfer,
        WarehouseUserAssignmentCriteriaTransfer $warehouseUserAssignmentCriteriaTransfer
    ): WarehouseUserAssignmentCriteriaTransfer {
        $warehouseUserAssignmentConditionsTransfer = $warehouseUserAssignmentCriteriaTransfer->getWarehouseUserAssignmentConditions()
            ?? new WarehouseUserAssignmentConditionsTransfer();
        $warehouseUserAssignmentConditionsTransfer->fromArray($warehouseUserAssignmentCollectionDeleteCriteriaTransfer->modifiedToArray(), true);

        return $warehouseUserAssignmentCriteriaTransfer->setWarehouseUserAssignmentConditions($warehouseUserAssignmentConditionsTransfer);
    }
}
