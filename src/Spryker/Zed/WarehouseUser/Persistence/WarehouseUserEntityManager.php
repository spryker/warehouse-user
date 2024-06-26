<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\WarehouseUser\Persistence;

use Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentTransfer;
use Orm\Zed\WarehouseUser\Persistence\SpyWarehouseUserAssignment;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Spryker\Zed\WarehouseUser\Persistence\WarehouseUserPersistenceFactory getFactory()
 */
class WarehouseUserEntityManager extends AbstractEntityManager implements WarehouseUserEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer
     *
     * @return \Generated\Shared\Transfer\WarehouseUserAssignmentTransfer
     */
    public function createWarehouseUserAssignment(WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer): WarehouseUserAssignmentTransfer
    {
        $warehouseUserMapper = $this->getFactory()->createWarehouseUserMapper();
        $warehouseUserAssignmentEntity = $warehouseUserMapper->mapWarehouseUserAssignmentTransferToWarehouseUserAssignmentEntity(
            $warehouseUserAssignmentTransfer,
            new SpyWarehouseUserAssignment(),
        );

        $warehouseUserAssignmentEntity->save();

        return $warehouseUserMapper->mapWarehouseUserAssignmentEntityToWarehouseUserAssignmentTransfer(
            $warehouseUserAssignmentEntity,
            $warehouseUserAssignmentTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer
     *
     * @return \Generated\Shared\Transfer\WarehouseUserAssignmentTransfer
     */
    public function updateWarehouseUserAssignment(WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer): WarehouseUserAssignmentTransfer
    {
        $warehouseUserAssignmentEntity = $this->getFactory()
            ->createWarehouseUserAssignmentQuery()
            ->filterByUuid($warehouseUserAssignmentTransfer->getUuid())
            ->findOne();

        if (!$warehouseUserAssignmentEntity) {
            return $warehouseUserAssignmentTransfer;
        }

        $warehouseUserMapper = $this->getFactory()->createWarehouseUserMapper();
        $warehouseUserAssignmentEntity = $warehouseUserMapper->mapWarehouseUserAssignmentTransferToWarehouseUserAssignmentEntity(
            $warehouseUserAssignmentTransfer,
            $warehouseUserAssignmentEntity,
        );

        $warehouseUserAssignmentEntity->save();

        return $warehouseUserMapper->mapWarehouseUserAssignmentEntityToWarehouseUserAssignmentTransfer(
            $warehouseUserAssignmentEntity,
            $warehouseUserAssignmentTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer $warehouseUserAssignmentCollectionTransfer
     *
     * @return void
     */
    public function deleteWarehouseUserAssignments(WarehouseUserAssignmentCollectionTransfer $warehouseUserAssignmentCollectionTransfer): void
    {
        $warehouseUserAssignmentIds = [];
        foreach ($warehouseUserAssignmentCollectionTransfer->getWarehouseUserAssignments() as $warehouseUserAssignmentTransfer) {
            $warehouseUserAssignmentIds[] = $warehouseUserAssignmentTransfer->getIdWarehouseUserAssignmentOrFail();
        }

        /** @var \Propel\Runtime\Collection\ObjectCollection $warehouseUserAssignmentCollection */
        $warehouseUserAssignmentCollection = $this->getFactory()
            ->createWarehouseUserAssignmentQuery()
            ->filterByIdWarehouseUserAssignment_In($warehouseUserAssignmentIds)
            ->find();

        $warehouseUserAssignmentCollection->delete();
    }
}
