<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportSqliteToMysql extends Command
{
    protected $signature = 'app:export-sqlite-to-mysql {--output=database/mysql_import.sql : Output file path}';

    protected $description = 'Export SQLite data as MySQL-compatible INSERT statements';

    /** @var array<int, string> */
    private array $skipTables = [
        'sqlite_sequence',
        'migrations',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
        'password_reset_tokens',
        'notifications',
    ];

    public function handle(): int
    {
        $outputPath = base_path($this->option('output'));
        $pdo = DB::connection('sqlite')->getPdo();

        $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name")
            ->fetchAll(\PDO::FETCH_COLUMN);

        $sql = "-- SQLite to MySQL data export\n";
        $sql .= "-- Generated: ".now()->toDateTimeString()."\n";
        $sql .= "-- Import: mysql -u root iriseuroperevival < database/mysql_import.sql\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

        $totalRows = 0;

        foreach ($tables as $table) {
            if (in_array($table, $this->skipTables)) {
                continue;
            }

            $rows = $pdo->query("SELECT * FROM \"{$table}\"")->fetchAll(\PDO::FETCH_ASSOC);

            if (empty($rows)) {
                continue;
            }

            $sql .= "-- {$table} (".count($rows)." rows)\n";
            $sql .= "TRUNCATE TABLE `{$table}`;\n";

            foreach ($rows as $row) {
                $columns = array_keys($row);
                $values = array_map(function ($value) use ($pdo) {
                    if ($value === null) {
                        return 'NULL';
                    }

                    return $pdo->quote((string) $value);
                }, array_values($row));

                $columnList = '`'.implode('`, `', $columns).'`';
                $valueList = implode(', ', $values);
                $sql .= "INSERT INTO `{$table}` ({$columnList}) VALUES ({$valueList});\n";
            }

            $sql .= "\n";
            $totalRows += count($rows);
        }

        $sql .= "SET FOREIGN_KEY_CHECKS = 1;\n";

        file_put_contents($outputPath, $sql);

        $this->info("Exported {$totalRows} rows to {$outputPath}");

        return self::SUCCESS;
    }
}
