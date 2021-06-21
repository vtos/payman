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

namespace Payman\Application;

use Payman\Application\PaymentPlans\CreatePaymentPlan;
use Payman\Application\PaymentPlans\CreatePaymentPlanHandler;
use Payman\Application\PaymentPlans\UpdatePaymentPlan;
use Payman\Application\PaymentPlans\UpdatePaymentPlanHandler;

final class Application
{
    private CreatePaymentPlanHandler $createPaymentPlanHandler;

    private UpdatePaymentPlanHandler $updatePaymentPlanHandler;



    public function createPaymentPlan(CreatePaymentPlan $command): void
    {
        $this->createPaymentPlanHandler->handle($command);
    }

    public function updatePaymentPlan(UpdatePaymentPlan $command): void
    {
        $this->updatePaymentPlanHandler->handle($command);
    }

    public function addPaymentYearToPlan(): void
    {

    }

    public function removePaymentYearFromPlan(): void
    {

    }

    public function assignStudentToPlan(): void
    {

    }

    public function unassignStudentFromPlan(): void
    {

    }
}
