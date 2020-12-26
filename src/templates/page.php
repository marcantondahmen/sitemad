<?php
return <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta tags -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<meta name="viewport" content="width=device-width" />
	<!-- Favicon and title -->
	<link rel="icon" href="$this->sitemadUrl/favicon.png">
	<title>$this->serverName &mdash; Sitemad</title>
	<!-- Halfmoon CSS -->
	<link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />
	<link href="$this->sitemadUrl/css/sitemad.css" rel="stylesheet" />
</head>
<body data-set-preferred-mode-onload="true">
	<!-- Page wrapper start -->
	<div class="page-wrapper with-navbar pb-20">
		<!-- Navbar start -->
		<nav class="navbar">
			<a href="$this->sitemadUrl" class="navbar-brand">
				<svg class="text-primary mr-15" xmlns="http://www.w3.org/2000/svg" width="1.45em" height="1.45em" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
					<path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
				</svg>
				<span class="pl-5">$this->serverName</span>
			</a>
			<div class="pl-20 navbar-content">
				<input id="filter" class="form-control w-lg-400" type="text" placeholder="Filter">
			</div>
			<div class="navbar-content ml-auto mr-5">
				<a href="$this->sitemadUrl/info.php" target="_blank" class="btn btn-rounded btn-sm text-capitalize">
					<b>$this->serverType</b> &mdash; PHP $this->phpVersion
				</a>
			</div>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="javascript:void(0);" title="Toggle Dark Mode" class="nav-link text-muted" onclick="halfmoon.toggleDarkMode()">
						<svg class="hidden-lm" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-toggle2-on" viewBox="0 0 16 16">
							<path d="M7 5H3a3 3 0 0 0 0 6h4a4.995 4.995 0 0 1-.584-1H3a2 2 0 1 1 0-4h3.416c.156-.357.352-.692.584-1z"/>
							<path d="M16 8A5 5 0 1 1 6 8a5 5 0 0 1 10 0z"/>
						</svg>
						<svg class="hidden-dm" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-toggle2-off" viewBox="0 0 16 16">
							<path d="M9 11c.628-.836 1-1.874 1-3a4.978 4.978 0 0 0-1-3h4a3 3 0 1 1 0 6H9z"/>
							<path d="M5 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1A5 5 0 1 0 5 3a5 5 0 0 0 0 10z"/>
						</svg>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Content wrapper start -->
		<div class="content-wrapper py-20">
			<div class="container pb-20">
				<table id="sites" class="table table-hover my-20 pb-20 font-weight-semi-bold">
					<thead>
						<tr>
							<th>Site</th>
							<th>Dashboard</th>
						</tr>
					</thead>
					<tbody>
						$rows
					</tbody>
				</table>
				<div class="my-20 py-20 px-15">
					<a href="https://github.com/marcantondahmen/sitemad" target="_blank" class="text-muted">
						<svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
							<path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Halfmoon JS -->
	<script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
	<script src="$this->sitemadUrl/js/sitemad.js"></script>
</body>
</html>
HTML;
