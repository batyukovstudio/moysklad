<?php

namespace MoySklad\Client\Endpoint;

use MoySklad\Client\EntityClientBase;
use MoySklad\Entity\AbstractListEntity;
use MoySklad\Entity\ListEntity;
use MoySklad\Entity\MetaEntity;
use MoySklad\Entity\Product\Product;
use MoySklad\Http\RequestExecutor;
use MoySklad\Util\Exception\ApiClientException;
use MoySklad\Util\Param\Param;
use MoySklad\Util\Param\StandardFilter;

trait GetEntitiesListEndpoint
{

    /**
     * @param string $name
     * @return Product|null
     * @throws \MoySklad\Util\Exception\ApiClientException
     */
    public static function findDyName(string $name): ?Product
    {
        $params = [StandardFilter::eq('name', $name)];
        $list = self::getList($params);
        $rows = $list->rows;
        if (1 === count($rows)) {
            $result = $rows[0] ?? null;
        }
        return $result ?? null;
    }
    /**
     * @param Param[] $params
     * @return ListEntity
     * @throws ApiClientException
     * @throws \Exception
     */
    public function getList(array $params = []): AbstractListEntity
    {
        if (get_parent_class($this) !== EntityClientBase::class) {
            throw new \Exception('The trait cannot be used outside the EntityClientBase class');
        }

        /** @var $listEntity ListEntity */
        $listEntity = RequestExecutor::path($this->getApi(), $this->getPath())->params($params)->get($this->getListEntityClass());

        return $listEntity;
    }

    /**
     * Ищет строго одну позицию. Для абсолюнтого поиска.
     *
     * Если находит несколько — null
     *
     * @param string $name
     * @param bool $strict
     * @return MetaEntity|null
     * @throws ApiClientException
     */
    public function getByName(string $name, bool $strict = true):? MetaEntity
    {
        if (true === $strict) {
            $params = [StandardFilter::eq('name', $name)];
        } else {
            $params = [StandardFilter::like('name', $name)];
        }

        /** @var AbstractListEntity $list */
        $list =  $this->getList($params);

        $rows = $list->rows;
        if (1 === count($rows)) {
            $result = $rows[0] ?? null;
        }
        return $result ?? null;
    }

    /**
     * Класс списка для данной выборки
     *
     * @return string|AbstractListEntity
     */
    protected function getListEntityClass() : string
    {
        return ListEntity::class;
    }
}
