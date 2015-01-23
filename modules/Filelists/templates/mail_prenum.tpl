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
			{$new_filelist_text}
		</div>
		<div>
			{$creator} {$filelist.user_name} {$filelist.user_surename}
		</div>
		<div>
			{$filelist.filename}
		</div>
		<div>
			{$filelist.detail}
		</div>
		<div>
			{$filelist.detail}
		</div>
		<div>
			<a href="{$link}">{$link_title}</a><br/>
			<a href="{$download_link}">{$download_link_title}</a>
		</div>
	</body>
</html>