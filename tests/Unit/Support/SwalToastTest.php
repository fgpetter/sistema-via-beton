<?php

namespace Tests\Unit\Support;

use App\Support\SwalToast;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SwalToastTest extends TestCase
{
    public function test_defaults_use_two_second_timer_when_not_provided(): void
    {
        $defaults = SwalToast::defaults();

        $this->assertSame(2000, $defaults['timer']);
        $this->assertTrue($defaults['toast']);
        $this->assertSame('top-end', $defaults['position']);
        $this->assertFalse($defaults['showConfirmButton']);
    }

    public function test_defaults_use_two_second_timer_when_null_is_passed(): void
    {
        $defaults = SwalToast::defaults(null);

        $this->assertSame(2000, $defaults['timer']);
    }

    public function test_defaults_respect_custom_timer(): void
    {
        $defaults = SwalToast::defaults(5000);

        $this->assertSame(5000, $defaults['timer']);
    }

    #[DataProvider('optionsProvider')]
    public function test_options_include_timer(string $method, ?int $timer, int $expectedTimer): void
    {
        $options = SwalToast::$method('Salvo com sucesso!', null, $timer);

        $this->assertSame($expectedTimer, $options['timer']);
        $this->assertSame('Salvo com sucesso!', $options['title']);
    }

    /**
     * @return array<string, array{0: string, 1: ?int, 2: int}>
     */
    public static function optionsProvider(): array
    {
        return [
            'success options default timer' => ['successOptions', null, 2000],
            'error options default timer' => ['errorOptions', null, 2000],
            'success options custom timer' => ['successOptions', 3500, 3500],
        ];
    }
}
