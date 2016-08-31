<?php
class AdminerSqlLog {
	/** @access protected */
	var $filename;

	/**
	* @param string defaults to "$database.sql"
	*/
	function __construct($base) {
        $this->logBase = $base;
	}

	function messageQuery($query, $time) {
		if ($this->filename == "") {
			$adminer = adminer();
            // no database goes to ".sql" to avoid collisions
			$this->filename = $this->logBase. '/' . $adminer->database() . ".sql";
		}
		$fp = fopen($this->filename, "a+");
		flock($fp, LOCK_EX);
		fwrite($fp, $query);
		fwrite($fp, "\n\n");
		flock($fp, LOCK_UN);
		fclose($fp);
	}
}

class AdminerDumpJson {
	/** @access protected */
	var $database = false;

	function dumpFormat() {
		return array('json' => 'JSON');
	}

	function dumpTable($table, $style, $is_view = false) {
		if ($_POST["format"] == "json") {
			return true;
		}
	}

	function _database() {
		echo "}\n";
	}

	function dumpData($table, $style, $query) {
		if ($_POST["format"] == "json") {
			if ($this->database) {
				echo ",\n";
			} else {
				$this->database = true;
				echo "{\n";
				register_shutdown_function(array($this, '_database'));
			}
			$connection = connection();
			$result = $connection->query($query, 1);
			if ($result) {
				echo '"' . addcslashes($table, "\r\n\"\\") . "\": [\n";
				$first = true;
				while ($row = $result->fetch_assoc()) {
					echo ($first ? "" : ", ");
					$first = false;
					foreach ($row as $key => $val) {
						json_row($key, $val);
					}
					json_row("");
				}
				echo "]";
			}
			return true;
		}
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["format"] == "json") {
			header("Content-Type: application/json; charset=utf-8");
			return "json";
		}
	}

}

/** Remembers and restores scollbar position of side menu
* @author Jiří @NoxArt Petruželka, www.noxart.cz
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerRestoreMenuScroll {

	protected $script;

	/**
	* @param string text to append before first calendar usage
	*/
	public function __construct($script = "<script type='text/javascript'>\n(function(){\nvar executed = false;\nvar saveAndRestore = function() {\nif( executed ) {\nreturn;\n}\n
executed = true;\nvar menu = document.getElementById('menu');\nvar scrolled = localStorage.getItem('_adminerScrolled');\nif( scrolled && scrolled >= 0 ) {\nmenu.scrollTop = scrolled;\n}\n
window.addEventListener('unload', function(){\nlocalStorage.setItem('_adminerScrolled', menu.scrollTop);\n});\n};\ndocument.addEventListener && document.addEventListener('DOMContentLoaded', saveAndRestore);\ndocument.attachEvent && document.attachEvent('onreadystatechange', saveAndRestore);\n})();\n</script>")
	{
		$this->script = $script;
	}

	public function head()
	{
		echo $this->script;
	}

}

/** Use filter in tables list
* @link https://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTablesFilter {

	function tablesPrint($tables) {
		?>
<script type="text/javascript">
function tablesFilter(value) {
	var tables = document.getElementById('tables').getElementsByTagName('span');
	for (var i = tables.length; i--; ) {
		var a = tables[i].children[1];
		var text = a.innerText || a.textContent;
		tables[i].className = (text.indexOf(value) == -1 ? 'hidden' : '');
		a.innerHTML = text.replace(value, '<b>' + value + '</b>');
	}
}
</script>
<p class="jsonly"><input onkeyup="tablesFilter(this.value);">
<?php
		echo "<p id='tables' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>\n";
		foreach ($tables as $table => $type) {
			echo '<span><a href="' . h(ME) . 'select=' . urlencode($table) . '"' . bold($_GET["select"] == $table) . ">" . lang('select') . "</a> ";
			echo '<a href="' . h(ME) . 'table=' . urlencode($table) . '"' . bold($_GET["table"] == $table) . ">" . h($table) . "</a><br></span>\n";
		}
		return true;
	}

}