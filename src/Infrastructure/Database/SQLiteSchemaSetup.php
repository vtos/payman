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

final class SQLiteSchemaSetup
{
    private PDO  $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTablesIfNotExist(): void
    {
        $statements = [];
        $statements[] = '
            CREATE TABLE IF NOT EXISTS payment_plans (
                id INTEGER PRIMARY KEY,
                name VARCHAR (255) NOT NULL,
                type INTEGER NOT NULL
            )
        ';
        $statements[] = '
            CREATE TABLE IF NOT EXISTS models_id_sequence (
                model VARCHAR (100),
                seq INTEGER
            )
        ';

        foreach ($statements as $statement) {
            $this->pdo->exec($statement);
        }
    }

    public function dropTables(): void
    {
        $statements = [];
        $statements[] = '
            DROP TABLE payment_plans
        ';
        $statements[] = '
            DROP TABLE models_id_sequence
        ';

        foreach ($statements as $statement) {
            $this->pdo->exec($statement);
        }
    }
}
