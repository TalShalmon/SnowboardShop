<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<!DOCTYPE html>
<html lang="he-IL">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta name="keywords" content="snowboard, סנובורד" />
	<meta name="description" content="החנות הויטרואלית לסנובורדים" />
	<title>SnowBording <?php if (isset($this->title)) echo $this->title; ?></title>
	<link rel="icon" href="<?php echo URL; ?>favicon.ico" type="image/x-icon" />
	<link href="<?php echo URL; ?>public/css/default.css" rel="stylesheet" type="text/css" />
	<?php
	if (isset($this->css)) {
		foreach ($this->css as $css) {
			echo '<link href="' . URL . 'public/css/' . $css . '" rel="stylesheet" type="text/css" />';
			echo "\n";
		}
	}
	?>
	<?php if (!isset($this->loginHide) || $this->loginHide == false): ?>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>
	<?php endif; ?>
	<?php
	if (isset($this->js)) {
		foreach ($this->js as $js) {
			echo '<script type="text/javascript" src="' . URL . 'public/js/' . $js . '"></script>';
			echo "\n";
		}
	}
	?>
</head>
<body>
<?php Session::init(); ?>
<div id="cart">
	<a id="shopping-cart" href="<?php echo URL; ?>cart"><img src="<?php echo URL; ?>public/images/cart.PNG" width="50" border="0"/></a>
</div>
<div id="site-layout">
	<header id="header">
		<div id="site-title">
			<div id="logo">
				<a id="btn-logo" class="title" href="<?php echo URL; ?>" alt="SnowBording Logo"></a>
			</div>
			<div id="title">
				<a id="btn-title" class="title" href="<?php echo URL; ?>" alt="SnowBording Title"></a>
			</div>
		</div>
		<nav id="top-menu">
			<ul class="top-menu">
				<li class="top-menu"><a href="<?php echo URL; ?>">ראשי</a></li>
				<?php if (Session::get('loggedIn') == true): ?>
				<li class="top-menu"><a href="<?php echo URL; ?>user/details">פרטים</a></li>
				<?php if (Session::get('admin') == 'true'): ?>
				<li class="top-menu"><a href="<?php echo URL; ?>product/add">הוספת מוצר</a></li>
				<?php endif; ?>
				<?php endif; ?>
			</ul>
		</nav>
	</header>
	<section id="left-col-main">
		<div id="main">
			<div id="right-col">
				<?php if (!isset($this->loginHide) || $this->loginHide == false):?>
				<div id="right-menu">
					<div id="login-menu">
						<?php if (Session::get('loggedIn') == false):?>
						שלום אורח
						<form action="/user/login" method="post">
							<fieldset class="logging">
								<label for="username">מייל:</label><br />
								<input type="text" name="username" id="username" required><br />
								<label for="password">סיסמה:</label><br />
								<input type="password" name="password" id="password" required>
							</fieldset>
							<fieldset class="logging">
								<button type="submit" id="login-submit">התחבר</button>
							</fieldset>
						</form>
						<fieldset class="logging">
							<a href="<?php echo URL; ?>user/forgotPassword">שכחתי סיסמה</a><br />
							<a href="<?php echo URL; ?>user/register">יצירת משתמש חדש</a>
						</fieldset>
						<?php else: ?>
						שלום <?php echo Session::get('name') ?>
						<fieldset class="logging">
							<button type="button" id="logout" onclick="logout();">התנתק</button>
						</fieldset>
						<?php endif; ?>
					</div>
				</div>
				<?php else: ?>&nbsp;
				<?php endif; ?>
			</div>
			<div id="left-col">
				<div id="content">
					<?php require_once VIEWS . $name . '.php';?>
				</div>
			</div>
		</div>
	</section>
	<footer id="footer">
		<div class="slogen">
			<h3><?php echo SLOGEN ?></h3>
		</div>
		<div class="copyrights">
			<h4><?php echo COPYRIGHTS ?></h4>
		</div>
	</footer>
</div>
</body>
</html>
