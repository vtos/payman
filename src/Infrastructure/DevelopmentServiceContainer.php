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

use Payman\Application\Application;
use Payman\Application\PaymentPlans\CreatePaymentPlanHandler;
use Payman\Application\PaymentPlans\RemovePaymentPlanHandler;
use Payman\Application\PaymentPlans\UpdatePaymentPlanHandler;
use Payman\Application\PaymentYears\AddPaymentYearToPlanHandler;
use Payman\Application\PaymentYears\RemovePaymentYearHandler;
use Payman\Application\Students\AssignStudentToPlanHandler;
use Payman\Application\Students\UnassignStudentFromPlanHandler;
use Payman\Domain\Model\PaymentPlan\PaymentPlanRepository;
use Payman\Domain\Model\PaymentYear\PaymentYearRepository;
use Payman\Domain\Model\Student\StudentRepository;

final class DevelopmentServiceContainer
{
    public function application(): Application
    {
        return new Application(
            $this->createPaymentPlanHandler(),
            $this->updatePaymentPlanHandler(),
            $this->removePaymentPlanHandler(),
            $this->addPaymentYearToPlanHandler(),
            $this->removePaymentYearHandler(),
            $this->assignStudentToPlanHandler(),
            $this->unassignStudentFromPlanHandler()
        );
    }

    private function createPaymentPlanHandler(): CreatePaymentPlanHandler
    {
        return new CreatePaymentPlanHandler(
            $this->PaymentPlanRepository()
        );
    }

    private function updatePaymentPlanHandler(): UpdatePaymentPlanHandler
    {
        return new UpdatePaymentPlanHandler(
            $this->PaymentPlanRepository()
        );
    }

    private function removePaymentPlanHandler(): RemovePaymentPlanHandler
    {
        return new RemovePaymentPlanHandler(
            $this->PaymentPlanRepository()
        );
    }

    private function addPaymentYearToPlanHandler(): AddPaymentYearToPlanHandler
    {
        return new AddPaymentYearToPlanHandler(
            $this->PaymentYearRepository()
        );
    }

    private function removePaymentYearHandler(): RemovePaymentYearHandler
    {
        return new RemovePaymentYearHandler(
            $this->PaymentYearRepository()
        );
    }

    private function assignStudentToPlanHandler(): AssignStudentToPlanHandler
    {
        return new AssignStudentToPlanHandler(
            $this->StudentRepository()
        );
    }

    private function unassignStudentFromPlanHandler(): UnassignStudentFromPlanHandler
    {
        return new UnassignStudentFromPlanHandler(
            $this->StudentRepository()
        );
    }

    private function PaymentPlanRepository(): PaymentPlanRepository
    {
        return new PaymentPlanRepositoryUsingSQLite();
    }

    private function PaymentYearRepository(): PaymentYearRepository
    {
        return new PaymentYearRepositoryUsingSQLite();
    }

    private function StudentRepository(): StudentRepository
    {
        return new StudentRepositoryUsingSQLite();
    }
}
