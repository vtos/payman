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

namespace Tests\Adapter\Payman\Infrastructure;

use PDO;
use RuntimeException;
use PHPUnit\Framework\TestCase;
use Payman\Infrastructure\ServiceContainerConfiguration;
use Payman\Domain\Model\PaymentPlan\PaymentPlan;
use Payman\Domain\Model\PaymentPlan\PaymentPlanId;
use Payman\Domain\Model\PaymentPlan\PaymentPlanType;

final class PaymentPlanRepositoryUsingSQLiteContractTest extends TestCase
{
    protected function setUp(): void
    {
        $schemaSetup = $this->serviceContainer()->SQLiteSchemaSetup();
        $schemaSetup->createTablesIfNotExist();
    }

    protected function tearDown(): void
    {
        $schemaSetup = $this->serviceContainer()->SQLiteSchemaSetup();
        $schemaSetup->dropTables();
    }

    /**
     * @test
     */
    public function it_provides_next_identity(): void
    {
        $repository = $this->serviceContainer()->PaymentPlanRepository();

        $this->assertEquals(
            '1',
            $repository->nextIdentity()->asString()
        );
        $this->assertEquals(
            '2',
            $repository->nextIdentity()->asString()
        );
        $this->assertEquals(
            '3',
            $repository->nextIdentity()->asString()
        );
    }

    /**
     * @test
     */
    public function payment_plan_instance_can_be_stored(): void
    {
        $repository = $this->serviceContainer()->PaymentPlanRepository();
        $id = $repository->nextIdentity();

        $paymentPlan = new PaymentPlan(
            $id,
            'Plan 1',
            PaymentPlanType::fromInt(1)
        );
        $repository->store($paymentPlan);

        $this->assertStored($paymentPlan, $id);

        // Then update it.
        $paymentPlan = new PaymentPlan(
            $id,
            'Plan 1 Renamed',
            PaymentPlanType::fromInt(2)
        );
        $repository->store($paymentPlan);

        $this->assertStored($paymentPlan, $id);
    }

    private function assertStored(PaymentPlan $expected, PaymentPlanId $id): void
    {
        $pdo = $this->serviceContainer()->PDO();

        $statement = $pdo->prepare('
            SELECT *
            FROM payment_plans
            WHERE id = ?
        ');
        $statement->execute(
            [
                $id->asString(),
            ]
        );
        if (false === ($record = $statement->fetch(PDO::FETCH_ASSOC))) {
            throw new RuntimeException('Unable to find record with id ' . $id->asString() . '.');
        }

        $this->assertEquals(
            $expected,
            new PaymentPlan(
                PaymentPlanId::fromString($record['id']),
                $record['name'],
                PaymentPlanType::fromInt(
                    (int)$record['type']
                )
            )
        );
    }

    private function serviceContainer(): DrivenAdapterTestServiceContainer
    {
        return new DrivenAdapterTestServiceContainer(
            ServiceContainerConfiguration::forDrivenAdapterTest()
        );
    }
}
