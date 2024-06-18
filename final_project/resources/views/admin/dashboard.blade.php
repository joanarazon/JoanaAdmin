<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="/css/admin.css">

	<title>Admin Dashboard</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">	
			<i class='bx bxs-smile'></i>
			<span class="text">DewyDoIt App</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="{{ route('admin') }}">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Admin Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('accountmanagement') }}">
					<i class='bx bxs-user'></i>
					<span class="text">Account Management</span>
				</a>
			</li>

		<ul class="side-menu">
			<li>
            <form method="get" action="{{ route('showLogin') }}">
    @csrf

    <button type="button" onclick="event.preventDefault(); this.closest('form').submit();">
        {{ __('Log Out') }}
    </button>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<form action="#">
				<div class="form-input">
					
				</div>
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Admin Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Admin Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				
			</div>
			
			<div class="welcome-message">
				<h2>Welcome to DewyDoIt!</h2>
				<p>Organize your tasks efficiently with our Kanban-style task management app.</p>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script src="script.js"></script>

	
</body>
</html>