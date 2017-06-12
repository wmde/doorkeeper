<?php
namespace RemotelyLiving\Doorkeeper\Rules;

/**
 * A type mapper if you choose to store integer types for persisted rules
 */
class TypeMapper
{
    public const RULE_TYPE_HEADER      = 1;
    public const RULE_TYPE_IP_ADDRESS  = 2;
    public const RULE_TYPE_PERCENTAGE  = 3;
    public const RULE_TYPE_RANDOM      = 4;
    public const RULE_TYPE_STRING_HASH = 5;
    public const RULE_TYPE_USER_ID     = 6;
    public const RULE_TYPE_ENVIRONMENT = 7;
    public const RULE_TYPE_BEFORE      = 8;
    public const RULE_TYPE_AFTER       = 9;

    /**
     * @var string[]
     */
    private $type_map = [];

    public function __construct()
    {
        $this->initTypeMap();
    }

    /**
     * @param int $integer_id
     *
     * @return string
     */
    public function getClassNameById(int $integer_id): string
    {
        return $this->type_map[$integer_id];
    }

    /**
     * @param string $class_name
     *
     * @return int
     */
    public function getIdForClassName(string $class_name): int
    {
        return array_flip($this->type_map)[$class_name];
    }

    public function pushExtraType(int $id, string $class_name): void
    {

        if (isset($this->type_map[$id])) {
            throw new \DomainException("Type {$id} already set by parent");
        }

        if (!class_exists($class_name)) {
            throw new \InvalidArgumentException("{$class_name} is not a loaded class");
        }

        $this->type_map[$id] = $class_name;
    }

    protected function initTypeMap(): void
    {
        $this->type_map = [
            self::RULE_TYPE_HEADER      => HttpHeader::class,
            self::RULE_TYPE_IP_ADDRESS  => IpAddress::class,
            self::RULE_TYPE_PERCENTAGE  => Percentage::class,
            self::RULE_TYPE_RANDOM      => Random::class,
            self::RULE_TYPE_STRING_HASH => StringHash::class,
            self::RULE_TYPE_USER_ID     => UserId::class,
            self::RULE_TYPE_ENVIRONMENT => Environment::class,
            self::RULE_TYPE_BEFORE      => TimeBefore::class,
            self::RULE_TYPE_AFTER       => TimeAfter::class,
        ];
    }
}
