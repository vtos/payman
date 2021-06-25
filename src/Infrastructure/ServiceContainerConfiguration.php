<?php
/**
 * This file is part of the vtos/payment application.
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 *
 * @copyright 2021 Vitaly Potenko <potenkov@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3 or later
 * @link https://github.com/vtos/payman GitHub
 */

declare(strict_types=1);

namespace Payman\Infrastructure;

use InvalidArgumentException;
use RuntimeException;

final class ServiceContainerConfiguration
{
    private const DRIVEN_ADAPTER_TEST_ENVIRONMENT = 'driven_adapter_test';

    private string $varDir;

    private string $environment;

    private function __construct(string $varDir, string $environment)
    {
        if (!is_writable($varDir)) {
            throw new RuntimeException("$varDir is not a writable directory.");
        }
        $this->varDir = $varDir;

        if (empty(trim($environment))) {
            throw new InvalidArgumentException('Environment name cannot be empty.');
        }
        $this->environment = $environment;
    }

    public function varDir(): string
    {
        return $this->varDir;
    }

    public function environment(): string
    {
        return $this->environment;
    }

    public static function forDrivenAdapterTest(): self
    {
        return new self(
        // TODO: move this to kind of a config.
            '/home/vitaly/webdev/apps/payman/var',
            self::DRIVEN_ADAPTER_TEST_ENVIRONMENT
        );
    }
}
