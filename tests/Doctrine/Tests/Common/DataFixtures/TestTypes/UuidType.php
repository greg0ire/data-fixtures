<?php

declare(strict_types=1);

namespace Doctrine\Tests\Common\DataFixtures\TestTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\Tests\Common\DataFixtures\TestValueObjects\Uuid;

class UuidType extends Type
{
    public const NAME = 'uuid';

    /**
     * @param mixed[] $fieldDeclaration
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $fieldDeclaration['length'] = 36;
        $fieldDeclaration['fixed']  = true;

        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param ?string $value
     *
     * @return ?Uuid
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : new Uuid($value);
    }

    /**
     * @param ?Uuid $value
     *
     * @return ?string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : (string) $value;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
