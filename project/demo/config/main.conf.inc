<?php
# some properties
$config = array();

# include other config files
$incs = glob(CONFIG . '/*.inc');
foreach ($incs as $inc) {
	require_once ($inc);
}
