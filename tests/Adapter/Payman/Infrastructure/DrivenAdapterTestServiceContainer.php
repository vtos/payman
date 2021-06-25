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
use Payman\Domain\Model\PaymentPlan\PaymentPlanRepository;
use Payman\Infrastructure\Database\PaymentPlanRepositoryUsingSQLite;
use Payman\Infrastructure\ServiceContainerConfiguration;
use Payman\Infrastructure\Database\SQLiteSchemaSetup;

final class DrivenAdapterTestServiceContainer
{
    private PDO $pdo;

    public function __construct(ServiceContainerConfiguration $containerConfiguration)
    {
        $filePath = $containerConfiguration->varDir() . '/' .
            $containerConfiguration->environment() .
            '.sqlite3';
        $this->pdo = new PDO("sqlite:$filePath");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function PaymentPlanRepository(): PaymentPlanRepository
    {
        return new PaymentPlanRepositoryUsingSQLite($this->pdo);
    }

    public function SQLiteSchemaSetup(): SQLiteSchemaSetup
    {
         return new SQLiteSchemaSetup($this->pdo);
    }

    public function PDO(): PDO
    {
        return  $this->pdo;
    }
}
