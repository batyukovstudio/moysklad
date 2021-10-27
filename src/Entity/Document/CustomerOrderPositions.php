<?php

namespace MoySklad\Entity\Document;

use JMS\Serializer\Annotation\Type;
use MoySklad\Entity\ListEntity;

class CustomerOrderPositions extends ListEntity
{
    /**
     * @Type("array<MoySklad\Entity\Document\CustomerOrderPosition>")
     */
    public $rows;
}
