<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class ExcelImport implements OnEachRow {

	private $data = [];
	public function onRow(Row $row) {
		$rowIndex = $row->getIndex();
		$row = $row->toArray();
		$this->data[] = $row;
	}

	public function getData() {
		return $this->data;
	}
}