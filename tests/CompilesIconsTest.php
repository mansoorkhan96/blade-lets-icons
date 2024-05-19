<?php

declare(strict_types=1);

namespace Tests;

use Mansoor\LetsIcons\BladeLetsIconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Orchestra\Testbench\TestCase;

class CompilesIconsTest extends TestCase
{
    public function test_it_compiles_a_single_anonymous_component()
    {
        $result = svg('letsicon-bell')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path d="M6.448 7.97a5.586 5.586 0 0 1 11.104 0l.252 2.266l.006.057a8 8 0 0 0 1.074 3.18l.03.05l.577.963c.525.874.787 1.311.73 1.67a1 1 0 0 1-.345.61c-.279.234-.789.234-1.808.234H5.932c-1.02 0-1.53 0-1.808-.233a1 1 0 0 1-.346-.611c-.056-.359.206-.796.73-1.67l.579-.964l.03-.05a8 8 0 0 0 1.073-3.179l.006-.057z"/><path stroke-linecap="round" d="M8 17a4 4 0 1 0 8 0"/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    public function test_it_can_add_classes_to_icons()
    {
        $result = svg('letsicon-bell', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path d="M6.448 7.97a5.586 5.586 0 0 1 11.104 0l.252 2.266l.006.057a8 8 0 0 0 1.074 3.18l.03.05l.577.963c.525.874.787 1.311.73 1.67a1 1 0 0 1-.345.61c-.279.234-.789.234-1.808.234H5.932c-1.02 0-1.53 0-1.808-.233a1 1 0 0 1-.346-.611c-.056-.359.206-.796.73-1.67l.579-.964l.03-.05a8 8 0 0 0 1.073-3.179l.006-.057z"/><path stroke-linecap="round" d="M8 17a4 4 0 1 0 8 0"/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    public function test_it_can_add_styles_to_icons()
    {
        $result = svg('letsicon-bell', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path d="M6.448 7.97a5.586 5.586 0 0 1 11.104 0l.252 2.266l.006.057a8 8 0 0 0 1.074 3.18l.03.05l.577.963c.525.874.787 1.311.73 1.67a1 1 0 0 1-.345.61c-.279.234-.789.234-1.808.234H5.932c-1.02 0-1.53 0-1.808-.233a1 1 0 0 1-.346-.611c-.056-.359.206-.796.73-1.67l.579-.964l.03-.05a8 8 0 0 0 1.073-3.179l.006-.057z"/><path stroke-linecap="round" d="M8 17a4 4 0 1 0 8 0"/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeLetsIconsServiceProvider::class,
        ];
    }
}
