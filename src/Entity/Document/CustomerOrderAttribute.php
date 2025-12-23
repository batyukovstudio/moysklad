<?php

namespace MoySklad\Entity\Document;

use JMS\Serializer\Annotation\Type;
use MoySklad\Entity\MetaEntity;
use MoySklad\Util\Object\Annotation\Generator;

class CustomerOrderAttribute extends  MetaEntity
{

    /**
     * @Type("string")
     * @Generator()
     */
    public $name;

    /**
     * @Type("DateTime<'Y-m-d H:i:s.v'>")
     * @Generator(type="datetime")
     */
    public $moment;

    /**
     * @Type("string")
     */
    public $href;

    /**
     * @Type("string")
     */
    public $fileName;

    /**
     * @Type("string")
     */
    public $type;

    public $value;
}
