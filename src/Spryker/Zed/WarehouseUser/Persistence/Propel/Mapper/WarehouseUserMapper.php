<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\WarehouseUser\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\StockTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer;
use Generated\Shared\Transfer\WarehouseUserAssignmentTransfer;
use Orm\Zed\Stock\Persistence\SpyStock;
use Orm\Zed\WarehouseUser\Persistence\SpyWarehouseUserAssignment;
use Propel\Runtime\Collection\ObjectCollection;

class WarehouseUserMapper
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<array-key, \Orm\Zed\WarehouseUser\Persistence\SpyWarehouseUserAssignment> $warehouseUserAssignmentEntityCollection
     * @param \Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer $warehouseUserAssignmentCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\WarehouseUserAssignmentCollectionTransfer
     */
    public function mapWarehouseUserAssignmentEntityCollectionToWarehouseUserAssignmentCollectionTransfer(
        ObjectCollection $warehouseUserAssignmentEntityCollection,
        WarehouseUserAssignmentCollectionTransfer $warehouseUserAssignmentCollectionTransfer
    ): WarehouseUserAssignmentCollectionTransfer {
        foreach ($warehouseUserAssignmentEntityCollection as $warehouseUserAssignmentEntity) {
            $warehouseUserAssignmentTransfer = $this->mapWarehouseUserAssignmentEntityToWarehouseUserAssignmentTransfer(
                $warehouseUserAssignmentEntity,
                new WarehouseUserAssignmentTransfer(),
            );
            $warehouseUserAssignmentCollectionTransfer->addWarehouseUserAssignment($warehouseUserAssignmentTransfer);
        }

        return $warehouseUserAssignmentCollectionTransfer;
    }

    public function mapWarehouseUserAssignmentTransferToWarehouseUserAssignmentEntity(
        WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer,
        SpyWarehouseUserAssignment $warehouseUserAssignmentEntity
    ): SpyWarehouseUserAssignment {
        $warehouseUserAssignmentEntity = $warehouseUserAssignmentEntity->fromArray($warehouseUserAssignmentTransfer->modifiedToArray());
        if ($warehouseUserAssignmentTransfer->getWarehouse()) {
            $warehouseUserAssignmentEntity = $warehouseUserAssignmentEntity->setFkWarehouse(
                $warehouseUserAssignmentTransfer->getWarehouseOrFail()->getIdStockOrFail(),
            );
        }

        return $warehouseUserAssignmentEntity;
    }

    public function mapWarehouseUserAssignmentEntityToWarehouseUserAssignmentTransfer(
        SpyWarehouseUserAssignment $warehouseUserAssignmentEntity,
        WarehouseUserAssignmentTransfer $warehouseUserAssignmentTransfer
    ): WarehouseUserAssignmentTransfer {
        $warehouseUserAssignmentTransfer = $warehouseUserAssignmentTransfer->fromArray($warehouseUserAssignmentEntity->toArray(), true);
        $stockTransfer = $this->mapStockEntityToStockTransfer($warehouseUserAssignmentEntity->getSpyStock(), new StockTransfer());

        return $warehouseUserAssignmentTransfer->setWarehouse($stockTransfer);
    }

    protected function mapStockEntityToStockTransfer(SpyStock $stockEntity, StockTransfer $stockTransfer): StockTransfer
    {
        return $stockTransfer->fromArray($stockEntity->toArray());
    }
}
