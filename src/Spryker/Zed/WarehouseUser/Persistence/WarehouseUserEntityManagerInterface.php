<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\WarehouseUser\Persistence;

use Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentTransfer;

interface WarehouseUserEntityManagerInterface
{
    public function createWarehouseUserAssignment(WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer): WarehouseUserAssignmentTransfer;

    public function updateWarehouseUserAssignment(WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer): WarehouseUserAssignmentTransfer;

    public function deleteWarehouseUserAssignments(WarehouseUserAssignmentCollectionTransfer $warehouseUserAssignmentCollectionTransfer): void;
}
