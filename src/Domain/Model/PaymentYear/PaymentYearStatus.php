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

namespace Payman\Domain\Model\PaymentYear;

use InvalidArgumentException;

final class PaymentYearStatus
{
    public const CURRENT = 1;

    public const PAST = 2;

    public const UPCOMING = 3;

    public function __construct(int $statusOption)
    {
        if (!in_array(
            $statusOption,
            [
                self::CURRENT,
                self::PAST,
                self::UPCOMING,
            ]
        )) {
            throw new InvalidArgumentException("Invalid option for payment year status: $statusOption.");
        }
    }

    public static function current(): self
    {
        return new self(self::CURRENT);
    }

    public static function past(): self
    {
        return new self(self::PAST);
    }

    public static function upcoming(): self
    {
        return new self(self::UPCOMING);
    }
}
