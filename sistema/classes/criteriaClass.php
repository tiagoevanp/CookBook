<?php
	class criteria {
		public $select = ' * ';
		public $update;
		public $insert;
		public $join;
		public $condition;
		public $order = 1;
		public $group;

		public function addCondition ($column, $value, $operator = 'AND') {
			if (!empty($this->condition)) {
				return $this->condition .= ' ' . $operator . ' (' . $column . ' = \'' . $value . '\') ';	
			}
			else{
				return $this->condition .= " WHERE (" . $column . ' = \'' . $value . '\') ';	
			}
		}

		public function addConditionLike ($column, $value) {
			if (!empty($this->condition)) {
				return $this->condition .= " AND (" . $column . " LIKE " . '\'%' . $value . '%\') ';
			}
			else{
				return $this->condition .= " WHERE (" . $column . " LIKE " . '%' . $value . '%) ';
			}
		}

		public function addConditionUpdate ($column, $value) {
			if (!$this->update) {
				return $this->update .= ' ' . $column . ' = \'' . $value . '\' ';
			}
			else {
				return $this->update .= ', ' . $column . ' = \'' . $value . '\' ';
			}
		}

		public function addConditionInsert ($columns, $values) {
			return $this->insert .= ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', '\'' . $values . '\')');
		}
	}
?>