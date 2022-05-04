<?php
namespace Highpoint\Core\Model\contracts;

interface ModelInterface
{
    public function where(string $columnName, string $columnValue);

    public function all(): self;

    public function get(): array|null;

    public function first(): array|null;

    public function orderBy(string|null $column = null, string|null $sortBy = null): self;

    public function leftJoin(string $tableName, string $foreignKey, string $localKey): self;

    public function create(array $createData);

    public function delete(string|array $Id, string $columnName = 'id');
}