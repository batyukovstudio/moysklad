<?php

namespace MoySklad\Entity\Document;

use MoySklad\Entity\MetaEntity;
use JMS\Serializer\Annotation\Type;
use MoySklad\Util\Object\Annotation\Generator;

class CustomerOrder extends MetaEntity
{
    /**
     * @Type("string")
     */
    public $syncId;

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     */
    public $updated;

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     */
    public $deleted;

    /**
     * @Type("string")
     * @Generator()
     */
    public $name;

    /**
     * @Type("string")
     * @Generator()
     */
    public $description;

    /**
     * @Type("string")
     * @Generator()
     */
    public $externalCode;

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     * @Generator(type="datetime")
     */
    public $moment;

    /**
     * @Type("bool")
     * @Generator()
     */
    public $applicable;

    /**
     * @Type("bool")
     */
    public $vatIncluded;

    /**
     * @Type("bool")
     * @Generator()
     */
    public $vatEnabled;

    /**
     * @Type("int")
     */
    public $sum;

    /**
     * @Type("MoySklad\Entity\Rate")
     * @Generator(type="object")
     */
    public $rate;

    /**
     * @Type("MoySklad\Entity\Agent\Employee")
     */
    public $owner;

    /**
     * @Type("bool")
     */
    public $shared;

    /**
     * @Type("MoySklad\Entity\Group")
     * @Generator(type="object", anyFromExists=true)
     */
    public $group;

    /**
     * @Type("MoySklad\Entity\Agent\Organization")
     * @Generator(type="object", anyFromExists=true)
     */
    public $organization;

    /**
     * @Type("MoySklad\Entity\Agent\Counterparty")
     * @Generator(type="object")
     */
    public $agent;

    /**
     * @Type("MoySklad\Entity\Store\Store")
     * @Generator(type="object")
     */
    public $store;

    /**
     * @Type("MoySklad\Entity\Contract")
     */
    public $contract;

    /**
     * @Type("MoySklad\Entity\State")
     */
    public $state;

    /**
     * @Type("MoySklad\Entity\Account")
     */
    public $organizationAccount;

    /**
     * @Type("MoySklad\Entity\Account")
     */
    public $agentAccount;

    /**
     * @Type("array<MoySklad\Entity\Document\CustomerOrderAttribute>")
     */
    public $attributes = [];

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     */
    public $created;

    /**
     * @Type("int")
     */
    public $vatSum;

    /**
     * @Type("MoySklad\Entity\Document\CustomerOrderPositions")
     * @Generator(type="object")
     */
    public $positions;

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     * @Generator(type="datetime")
     */
    public $deliveryPlannedMoment;

    /**
     * @Type("int")
     */
    public $payedSum;

    /**
     * @Type("int")
     */
    public $shippedSum;

    /**
     * @Type("int")
     */
    public $invoicedSum;

    /**
     * @Type("MoySklad\Entity\Project")
     */
    public $project;

    /**
     * @Type("string")
     * @Generator(
     *     values={
     *         "GENERAL_TAX_SYSTEM",
     *         "SIMPLIFIED_TAX_SYSTEM_INCOME",
     *         "SIMPLIFIED_TAX_SYSTEM_INCOME_OUTCOME",
     *         "UNIFIED_AGRICULTURAL_TAX",
     *         "PRESUMPTIVE_TAX_SYSTEM",
     *         "PATENT_BASED"
     *     }
     * )
     */
    public $taxSystem;

    /**
     * @Type("array<MoySklad\Entity\Document\CustomerOrder>")
     */
    public $purchaseOrders = [];

    /**
     * @return array|null
     */
    public function getPositions(): ?array
    {
        if (
            (null === $this->positions || null === $this->positions->rows) && method_exists($this->positions, 'fetch')) {
            $this->positions->fetch();
        }

        $positions = $this->positions->rows ?? null;

        /** Подгружается продукты */
        if (is_countable($positions) && 0 < count($positions)) {
            foreach ($positions as $position) {
                $position->assortment->fetch();
            }
        }

        return $positions;
    }
}
