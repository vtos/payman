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

use Payman\Domain\Model\PaymentPlan\PaymentPlanId;
use Payman\Domain\Model\PaymentYear\PaymentYear;
use Payman\Domain\Model\PaymentYear\PaymentYearId;
use Payman\Domain\Model\PaymentYear\PaymentYearRepository;

final class PaymentYearRepositoryUsingSQLite implements PaymentYearRepository
{
    public function store(PaymentYear $paymentYear): void
    {
        // TODO: Implement store() method.
    }

    public function remove(PaymentYearId $id): void
    {
        // TODO: Implement remove() method.
    }

    public function nextIdentity(): string
    {
        // TODO: Implement nextIdentity() method.
    }

    /**
     * @inheritDoc
     */
    public function currentPaymentYearExistsInPaymentPlanWithId(PaymentPlanId $paymentPlanId): bool
    {
        // TODO: Implement currentPaymentYearExistsInPaymentPlanWithId() method.
    }
}
