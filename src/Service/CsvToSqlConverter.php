<?php


namespace HtmlAcademy\Service;

use SplFileObject;

class CsvToSqlConverter
{
    private string $path;
    private SplFileObject $file;
    private string $tableName;
    private array $result;
    private array $columns;


    public function __construct($path)
    {
        $this->path = $path;
        $this->file = new SplFileObject($this->path);
        $this->tableName = strstr($this->file->getFilename(), '.csv', true);
        $this->result = [];
        $this->columns = [];
    }

    public function CsvParser(): void
    {
        while ((!$this->file->eof())) {
            $rows[] = $this->file->fgetcsv();
        }
        $this->columns = array_shift($rows);
        //вырезаем пустые последние строки
        array_pop($rows);
        foreach ($rows as $row) {
            $this->result[] = $row;
        }

    }

    public function getSqlFile(array $addColumns, array $addValues): void
    {
        if (!empty($addColumns) && !empty($addValues)) {
            $this->columns = array_merge($this->columns, $addColumns);
        }
        $sqlColumns = implode(",", $this->columns);
        $values = [];
        $i = 0;
        foreach ($this->result as $row) {
            if (!empty($addValues)) {
                $row = array_merge($row, $addValues[$i]);
            }
            $values[] = '(' . "'" . implode("','", $row) . "'" . ')';
            $i++;
        }
        $result = implode(",", $values);
        $sql = "INSERT INTO `" . $this->tableName . "`(" . $sqlColumns . ") VALUES " . $result;
        $sqlScript = fopen($this->tableName . '.sql', "w");
        fwrite($sqlScript, $sql);
        fclose($sqlScript);
    }
}
