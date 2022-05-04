<?php
namespace Highpoint\Core\Model;

use Highpoint\Core\Model\contracts\ModelInterface;
use Highpoint\Core\Model\contracts\ModelServiceInterface;
use Highpoint\Core\Model\services\MysqlService;

class Model implements ModelInterface
{
    private ModelServiceInterface $modelService;

    protected string|null $table = null;

    public function __construct()
    {

        $this->modelService = new MysqlService();
        
        //set table name
        $this->setTable();

    }
    
    public function setTable(): self
    {
        if ( !$this->table ) {
            $path = explode('\\', get_class($this) );
            $className = array_pop( $path );

            // convert camelCase to snakeCase
            $convert = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $className));

            //TODO need add 's end of table name
            $this->table = strtolower($convert);
        }
        $this->modelService->setTable($this->table);

        return $this;
    }

    public function where(string $columnName, string $columnValue)
    {
        $this->modelService->where($columnName, $columnValue);
        return $this;
    }

    public function create(array $createData)
    {
        $result = $this->modelService->create($createData);
        return $result ? 
            $this->where('id', $result)->first() :
            $result;
    }

    public function delete(string|array $Id, string $columnName = 'id')
    {
        return $this->modelService->delete($Id, $columnName);
    }

    public function all(): self
    {
        return $this;
    }

    public function first(): array|null
    {
        $content = $this->modelService->first();
        return $content;
    }

    public function get(): array|null
    {
        $contents = $this->modelService->get();
        return $contents;
    }

    public function orderBy(string|null $column = null, string|null $sortBy = null): self
    {
        $column = $column ?? 'id';
        $sortBy = $sortBy ?? 'ASC';
        $this->modelService->orderBy($column, $sortBy);
        return $this;
    }

    public function leftJoin(string $tableName, string $foreignKey, string $localKey): self
    {
        $this->modelService->leftJoin($tableName, $foreignKey, $localKey);
        return $this;
    }
}