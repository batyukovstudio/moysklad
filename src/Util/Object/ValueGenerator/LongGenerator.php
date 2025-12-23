<?php

declare(strict_types=1);

namespace MoySklad\Util\Object\ValueGenerator;

use MoySklad\Util\Object\Annotation\Generator;

class LongGenerator implements GeneratorInterface
{
    public function generate(Generator $generatorConfig): int
    {
        return rand(-2^63, 2^63);
    }
}
