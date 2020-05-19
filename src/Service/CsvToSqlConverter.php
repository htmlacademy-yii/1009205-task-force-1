<?php


namespace HtmlAcademy\Service;

use HtmlAcademy\Exceptions\InvalidFileException;
use HtmlAcademy\Exceptions\UselessException;
use SplFileObject;
use SplFileInfo;

class CsvToSqlConverter
{
    private string $path;
    private SplFileInfo $aboutFile;
    private SplFileObject $file;
    private string $tableName;
    private array $result;
    private array $columns;


    public function __construct($path)
    {
        $this->path = $path;
        $this->aboutFile = new SplFileInfo($this->path);
        if (!$this->aboutFile->isFile()) {
            throw new InvalidFileException('selected file does not exist or current path ' . $this->path . ' is wrong');
        } elseif ($this->aboutFile->getExtension() !== 'csv') {
            throw new InvalidFileException('Selected file ' . $this->aboutFile->getBasename() . ' is not a csv file');
        } else {
            $this->file = $this->aboutFile->openFile();
            $this->tableName = strstr($this->file->getFilename(), '.csv', true);
            $this->result = [];
            $this->columns = [];
        }
    }

    public function CsvParser(): void
    {
        while ((!$this->file->eof())) {
            $rows[] = $this->file->fgetcsv();
        }
        $this->columns = array_shift($rows);
        foreach ($rows as $key => $value) {
            if (!empty(array_filter($value))) {
                $this->result[] = $value;
            }
        }
        if (empty($this->result)) {
            throw new UselessException('Selected csv file ' . $this->aboutFile->getBasename() . ' is empty');
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
