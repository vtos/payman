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
use Payman\Domain\Model\PaymentPlan\PaymentPlanId;

final class PaymentYear
{
    private PaymentYearId $id;

    private string $name;

    private PaymentPlanId $paymentPlanId;

    private Cost $cost;

    private PaymentYearStatus $status;

    private bool $visible;

    public function __construct(
        PaymentYearId $id,
        string $name,
        PaymentPlanId $paymentPlanId,
        Cost $cost,
        PaymentYearStatus $status,
        bool $visible
    ) {
        if (empty(trim($name)))
        {
            throw new InvalidArgumentException('Payment year name cannot be empty.');
        }
        $this->name = $name;

        $this->id = $id;
        $this->paymentPlanId = $paymentPlanId;
        $this->cost = $cost;
        $this->status = $status;
        $this->visible = $visible;
    }
}
