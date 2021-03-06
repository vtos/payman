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
use Payman\Application\PaymentPlans\RemovePaymentPlan;
use Payman\Application\PaymentPlans\RemovePaymentPlanHandler;
use Payman\Application\PaymentPlans\UpdatePaymentPlan;
use Payman\Application\PaymentPlans\UpdatePaymentPlanHandler;
use Payman\Application\PaymentYears\AddPaymentYearToPlan;
use Payman\Application\PaymentYears\AddPaymentYearToPlanHandler;
use Payman\Application\PaymentYears\RemovePaymentYear;
use Payman\Application\PaymentYears\RemovePaymentYearHandler;
use Payman\Application\Students\AssignStudentToPlan;
use Payman\Application\Students\AssignStudentToPlanHandler;
use Payman\Application\Students\UnassignStudentFromPlan;
use Payman\Application\Students\UnassignStudentFromPlanHandler;

final class Application
{
    private CreatePaymentPlanHandler $createPaymentPlanHandler;

    private UpdatePaymentPlanHandler $updatePaymentPlanHandler;

    private RemovePaymentPlanHandler $removePaymentPlanHandler;

    private AddPaymentYearToPlanHandler $addPaymentYearToPlanHandler;

    private RemovePaymentYearHandler $removePaymentYearHandler;

    private AssignStudentToPlanHandler $assignStudentToPlanHandler;

    private UnassignStudentFromPlanHandler $unassignStudentFromPlanHandler;

    public function __construct(
        CreatePaymentPlanHandler $createPaymentPlanHandler,
        UpdatePaymentPlanHandler $updatePaymentPlanHandler,
        RemovePaymentPlanHandler $removePaymentPlanHandler,
        AddPaymentYearToPlanHandler $addPaymentYearToPlanHandler,
        RemovePaymentYearHandler $removePaymentYearHandler,
        AssignStudentToPlanHandler $assignStudentToPlanHandler,
        UnassignStudentFromPlanHandler $unassignStudentFromPlanHandler
    ) {
        $this->createPaymentPlanHandler = $createPaymentPlanHandler;
        $this->updatePaymentPlanHandler = $updatePaymentPlanHandler;
        $this->removePaymentPlanHandler = $removePaymentPlanHandler;
        $this->addPaymentYearToPlanHandler = $addPaymentYearToPlanHandler;
        $this->removePaymentYearHandler = $removePaymentYearHandler;
        $this->assignStudentToPlanHandler = $assignStudentToPlanHandler;
        $this->unassignStudentFromPlanHandler = $unassignStudentFromPlanHandler;
    }

    public function createPaymentPlan(CreatePaymentPlan $command): void
    {
        $this->createPaymentPlanHandler->handle($command);
    }

    public function updatePaymentPlan(UpdatePaymentPlan $command): void
    {
        $this->updatePaymentPlanHandler->handle($command);
    }

    public function removePaymentPlan(RemovePaymentPlan $command): void
    {
        $this->removePaymentPlanHandler->handle($command);
    }

    public function addPaymentYearToPlan(AddPaymentYearToPlan $command): void
    {
        $this->addPaymentYearToPlanHandler->handle($command);
    }

    public function removePaymentYearFromPlan(RemovePaymentYear $command): void
    {
        $this->removePaymentYearHandler->handle($command);
    }

    public function assignStudentToPlan(AssignStudentToPlan $command): void
    {
        $this->assignStudentToPlanHandler->handle($command);
    }

    public function unassignStudentFromPlan(UnassignStudentFromPlan $command): void
    {
        $this->unassignStudentFromPlanHandler->handle($command);
    }
}
