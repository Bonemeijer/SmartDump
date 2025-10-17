<?php

declare(strict_types=1);

namespace Tests\Unit\Node\Type;

use Bonemeijer\PhpUnitExtensions\Assertion\JsonAssertionTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SmartDump\Node\DefaultNodeFactory;
use SmartDump\Node\NodeInterface;
use SmartDump\Node\Type\DateTimeType\DateTimeNodeTypeFactory;

class DateTimeTypeTest extends TestCase
{
    use JsonAssertionTrait;

    /**
     * @return mixed[]
     */
    public static function dataProvider(): array
    {
        return [
            'with datetime'           => [
                'value' => new \DateTime('2020-01-01 12:37:51', new \DateTimeZone('UTC')),
            ],
            'with immutable datetime' => [
                'value' => new \DateTimeImmutable('2020-01-01 12:37:51', new \DateTimeZone('Europe/Amsterdam')),
            ],
            'with ms'                 => [
                'value' => new \DateTimeImmutable('2020-01-01 12:37:51.123', new \DateTimeZone('Europe/Amsterdam')),
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    #[DataProvider('dataProvider')]
    public function testFactory(mixed $value): void
    {
        try {
            $dateTimeNodeTypeFactory = new DateTimeNodeTypeFactory(
                new DefaultNodeFactory(),
            );
            $node                    = $dateTimeNodeTypeFactory->create($value);
        } catch (\Throwable $exception) {
            // capture only
        }

        $this->getJsonAssertion(
            [
                'value'     => $value,
                'supported' => $dateTimeNodeTypeFactory->supports($value),
                'node'      => isset($node)
                    ? $this->exportNode($node)
                    : null,
                'exception' => isset($exception)
                    ? [
                        'class'   => get_class($exception),
                        'message' => $exception->getMessage(),
                    ]
                    : null,
            ],
        )->assertSame();
    }

    private function exportNode(?NodeInterface $node): ?array
    {
        return $node !== null
            ? [
                'name'         => $node->getName(),
                'visibility'   => $node->getVisibility(),
                'static'       => $node->isStatic(),
                'aggregate'    => $node->isAggregate(),
                'string_value' => $node->getStringValue(),
                'children'     => array_map(
                    fn(NodeInterface $childNode) => $this->exportNode($childNode),
                    $node->getChildren(),
                ),
            ]
            : null;
    }
}
