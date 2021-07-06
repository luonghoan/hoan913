<?php
 namespace MailPoetVendor\Doctrine\DBAL\Types; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\DBAL\DBALException; use MailPoetVendor\Doctrine\DBAL\ParameterType; use MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform; use function end; use function explode; use function str_replace; abstract class Type { public const TARRAY = 'array'; public const SIMPLE_ARRAY = 'simple_array'; public const JSON_ARRAY = 'json_array'; public const JSON = 'json'; public const BIGINT = 'bigint'; public const BOOLEAN = 'boolean'; public const DATETIME = 'datetime'; public const DATETIME_IMMUTABLE = 'datetime_immutable'; public const DATETIMETZ = 'datetimetz'; public const DATETIMETZ_IMMUTABLE = 'datetimetz_immutable'; public const DATE = 'date'; public const DATE_IMMUTABLE = 'date_immutable'; public const TIME = 'time'; public const TIME_IMMUTABLE = 'time_immutable'; public const DECIMAL = 'decimal'; public const INTEGER = 'integer'; public const OBJECT = 'object'; public const SMALLINT = 'smallint'; public const STRING = 'string'; public const TEXT = 'text'; public const BINARY = 'binary'; public const BLOB = 'blob'; public const FLOAT = 'float'; public const GUID = 'guid'; public const DATEINTERVAL = 'dateinterval'; private static $_typeObjects = []; private static $_typesMap = [self::TARRAY => \MailPoetVendor\Doctrine\DBAL\Types\ArrayType::class, self::SIMPLE_ARRAY => \MailPoetVendor\Doctrine\DBAL\Types\SimpleArrayType::class, self::JSON_ARRAY => \MailPoetVendor\Doctrine\DBAL\Types\JsonArrayType::class, self::JSON => \MailPoetVendor\Doctrine\DBAL\Types\JsonType::class, self::OBJECT => \MailPoetVendor\Doctrine\DBAL\Types\ObjectType::class, self::BOOLEAN => \MailPoetVendor\Doctrine\DBAL\Types\BooleanType::class, self::INTEGER => \MailPoetVendor\Doctrine\DBAL\Types\IntegerType::class, self::SMALLINT => \MailPoetVendor\Doctrine\DBAL\Types\SmallIntType::class, self::BIGINT => \MailPoetVendor\Doctrine\DBAL\Types\BigIntType::class, self::STRING => \MailPoetVendor\Doctrine\DBAL\Types\StringType::class, self::TEXT => \MailPoetVendor\Doctrine\DBAL\Types\TextType::class, self::DATETIME => \MailPoetVendor\Doctrine\DBAL\Types\DateTimeType::class, self::DATETIME_IMMUTABLE => \MailPoetVendor\Doctrine\DBAL\Types\DateTimeImmutableType::class, self::DATETIMETZ => \MailPoetVendor\Doctrine\DBAL\Types\DateTimeTzType::class, self::DATETIMETZ_IMMUTABLE => \MailPoetVendor\Doctrine\DBAL\Types\DateTimeTzImmutableType::class, self::DATE => \MailPoetVendor\Doctrine\DBAL\Types\DateType::class, self::DATE_IMMUTABLE => \MailPoetVendor\Doctrine\DBAL\Types\DateImmutableType::class, self::TIME => \MailPoetVendor\Doctrine\DBAL\Types\TimeType::class, self::TIME_IMMUTABLE => \MailPoetVendor\Doctrine\DBAL\Types\TimeImmutableType::class, self::DECIMAL => \MailPoetVendor\Doctrine\DBAL\Types\DecimalType::class, self::FLOAT => \MailPoetVendor\Doctrine\DBAL\Types\FloatType::class, self::BINARY => \MailPoetVendor\Doctrine\DBAL\Types\BinaryType::class, self::BLOB => \MailPoetVendor\Doctrine\DBAL\Types\BlobType::class, self::GUID => \MailPoetVendor\Doctrine\DBAL\Types\GuidType::class, self::DATEINTERVAL => \MailPoetVendor\Doctrine\DBAL\Types\DateIntervalType::class]; private final function __construct() { } public function convertToDatabaseValue($value, \MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return $value; } public function convertToPHPValue($value, \MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return $value; } public function getDefaultLength(\MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return null; } public abstract function getSQLDeclaration(array $fieldDeclaration, \MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform); public abstract function getName(); public static function getType($name) { if (!isset(self::$_typeObjects[$name])) { if (!isset(self::$_typesMap[$name])) { throw \MailPoetVendor\Doctrine\DBAL\DBALException::unknownColumnType($name); } self::$_typeObjects[$name] = new self::$_typesMap[$name](); } return self::$_typeObjects[$name]; } public static function addType($name, $className) { if (isset(self::$_typesMap[$name])) { throw \MailPoetVendor\Doctrine\DBAL\DBALException::typeExists($name); } self::$_typesMap[$name] = $className; } public static function hasType($name) { return isset(self::$_typesMap[$name]); } public static function overrideType($name, $className) { if (!isset(self::$_typesMap[$name])) { throw \MailPoetVendor\Doctrine\DBAL\DBALException::typeNotFound($name); } if (isset(self::$_typeObjects[$name])) { unset(self::$_typeObjects[$name]); } self::$_typesMap[$name] = $className; } public function getBindingType() { return \MailPoetVendor\Doctrine\DBAL\ParameterType::STRING; } public static function getTypesMap() { return self::$_typesMap; } public function __toString() { $e = \explode('\\', static::class); return \str_replace('Type', '', \end($e)); } public function canRequireSQLConversion() { return \false; } public function convertToDatabaseValueSQL($sqlExpr, \MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return $sqlExpr; } public function convertToPHPValueSQL($sqlExpr, $platform) { return $sqlExpr; } public function getMappedDatabaseTypes(\MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return []; } public function requiresSQLCommentHint(\MailPoetVendor\Doctrine\DBAL\Platforms\AbstractPlatform $platform) { return \false; } } 