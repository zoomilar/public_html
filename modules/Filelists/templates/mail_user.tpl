<html>
	<head>
		<title>
			{$prenum_subject}
		</title>
	</head>
	<body>
		<div>
			<h1>{$prenum_subject}</h1>
		</div>
		<div>
			{$user_filelist_text}
		</div>
		<div>
			{$filelist.filename}
		</div>
		<div>
			{$link_title} {$link}
		</div>
		<div>
			{$user_status} {$user_status_val}
		</div>
		{if $admin_msg}
			<div>
				{$admin_msg_title} {$admin_msg}
			</div>
		{/if}
	</body>
</html>