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

namespace Payman\Infrastructure\Database;

use PDO;
use Payman\Domain\Model\PaymentPlan\PaymentPlan;
use Payman\Domain\Model\PaymentPlan\PaymentPlanId;
use Payman\Domain\Model\PaymentPlan\PaymentPlanRepository;

final class PaymentPlanRepositoryUsingSQLite implements PaymentPlanRepository
{
    private PDO  $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function store(PaymentPlan $plan): void
    {
        $record = $plan->asArray();

        $statement = $this->pdo->prepare('
            SELECT COUNT(*)
            FROM payment_plans
            WHERE id = ?
        ');
        $statement->execute(
            [
                $record['id']
            ]
        );

        $recordsFound = (int)$statement->fetchColumn();
        if (0 === $recordsFound) {
            $statement = $this->pdo->prepare('
                INSERT INTO payment_plans
                    (id, name, type)
                VALUES
                    (?, ?, ?)
            ');
            $statement->execute(
                [
                    $record['id'],
                    $record['name'],
                    $record['type'],
                ]
            );

            return;
        }

        $statement = $this->pdo->prepare('
            UPDATE payment_plans
            SET name = ?, type =?
            WHERE id = ?
        ');
        $statement->execute(
            [
                $record['name'],
                $record['type'],
                $record['id'],
            ]
        );
    }

    public function remove(PaymentPlanId $id): void
    {
        // TODO: Implement remove() method.
    }

    public function nextIdentity(): PaymentPlanId
    {
        $this->pdo->beginTransaction();

        $statement = $this->pdo->prepare('
            SELECT seq
            FROM models_id_sequence
            WHERE model = ?
        ');
        $statement->execute(
            [
                'payment_plan',
            ]
        );
        if (false === ($id = $statement->fetchColumn(0))) {
            $statement = $this->pdo->prepare('
                INSERT INTO models_id_sequence
                    (model, seq)
                VALUES
                    (?, ?)
            ');
            $statement->execute(
                [
                    'payment_plan',
                    2,
                ]
            );

            $id = 1;
        } else {
            $statement = $this->pdo->prepare('
                UPDATE models_id_sequence
                SET seq = seq + 1
                WHERE model = ?
            ');
            $statement->execute(
                [
                    'payment_plan',
                ]
            );
        }

        $this->pdo->commit();

        return PaymentPlanId::fromString(
            (string)$id
        );
    }
}
