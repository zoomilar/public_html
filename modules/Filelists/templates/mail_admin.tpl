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
			{$admin_filelist_text}
		</div>
		<div>
			{$filelist.filename}
		</div>
		<div>
			<a href="{$backendlink}">{$admin_filelist_backendlink}</a>
		</div>
		<div>
			{$creator} {$filelist.user_name} {$filelist.user_email} {$filelist.user_nr}
		</div>
	</body>
</html>