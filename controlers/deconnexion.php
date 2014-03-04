<?php
	if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_type']);
	}

	header('Location: ');
?>