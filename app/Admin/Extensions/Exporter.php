<?php
/**
 * Created by PhpStorm.
 * User: xueke
 * Date: 2019/5/23
 * Time: 12:51
 */

namespace App\Admin\Extensions;


use Encore\Admin\Grid\Exporters\ExcelExporter;

class Exporter extends ExcelExporter
{
    public function options($fileName, $columns)
    {
        $this->fileName = $fileName;
        $this->columns = $columns;
    }
}