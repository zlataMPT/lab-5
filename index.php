<?php
if (isset($_POST['otpr'])) {
	// Получаем данные из формы
	$name = $_POST['name'];
	$phone = $_POST['phone']; // Исправлено на email
	$message = $_POST['message'];

	// Проверяем, что все поля заполнены
	if (empty($name) || empty($phone) || empty($message)) {
		exit("Все поля должны быть заполнены");
	}

	$conn = mysqli_connect("localhost", "root", "", "sakura");
	// Проверяем подключение к базе данных
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Подготавливаем SQL-запрос для предотвращения SQL-инъекций
	$stmt = $conn->prepare("INSERT INTO contact (name, phone, message) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $phone, $message);

	// Выполняем запрос
	if ($stmt->execute()) {
		echo "Спасибо за обращение";
	} else {
		echo "Ошибка: " . $stmt->error;
	}

	// Закрываем соединение
	$stmt->close();
	mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Кастомизация автомобилей" />
	<link rel="shortcut icon" href="img/logo/logo.svg" type="image/x-icon" />
	<link rel="stylesheet" href="./css2/style.min.css" />
	<title>Главная</title>
</head>

<body>
	<div class="wrapper">
		<header class="header header_absolute" data-aos="fade-down" data-aos-duration="1000">
			<?php
			session_start();
			$conn = mysqli_connect("localhost", "root", "", "sakura");
			// Проверяем подключение к базе данных
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			if (isset($_SESSION['login_user'])) {
				$user_check = $_SESSION['login_user'];
				$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
				$rows = mysqli_fetch_array($query);
				$status = $rows['admin'];
				$id_user = $rows['id_user'];
				if ($status == 1) {
					$admin = '<a href="account/header.php">Личный кабинет</a>';
				} else {
					$admin = '<a href="header.php">Личный кабинет</a>';
				}

				echo  $admin;
			} else {
				// echo '<div class="button"><a href="account/sql.php">Личный кабинет</a></div>';
			}
			mysqli_close($conn);
			?>
			<div class="blur"></div>
			<div class="container">
				<div class="header__content">
					<div class="header__content-row">
						<nav class="nav header__nav" id="headNav">
							<ul class="nav__ul">
								<li class="nav__li"><a class="nav__link" href="index.html">Главная</a></li>
								<li class="nav__li"><a class="nav__link" href="#services">Оклейка автомобилей</a></li>
								<li class="nav__li"><a class="nav__link" href="#services">Детейлинг автомобилей</a></li>
								<li class="nav__li"><a class="nav__link" href="#works">Галерея работ</a></li>
								<li class="nav__li"><a class="nav__link" href="account/sql.php">Админ-панель</a></li>
							</ul>
						</nav>
						<div class="burg header-burg" data-target="#headNav"></div>
					</div>
				</div>
			</div>
		</header>

		<main class="main">
			<section class="hero">
				<div class="container hero__container">
					<div class="hero__content">
						<div class="hero__main-block" data-aos="fade-up" data-aos-duration="1000">
							<h1 class="hero__title title rectangles">CAR MUSC</h1>
							<h2 class="hero__subtitle"> <span class="hero__subtitle-line">Ваш автомобиль заслуживает лучшего ухода!
							</h2><a class="hero__btn btn" href="#services">Наши услуги</a>
						</div>
					</div>
				</div>
				<div class="hero__bottom" data-aos="fade" data-aos-duration="1000" data-aos-delay="250">
					<div class="contact hero__item">
						<p class="contact__title">адрес:</p>
						<p class="contact__text">г. Москва, ул. Тверская, д. 16, стр. 1.</p>
					</div>
					<div class="contact hero__item">
						<p class="contact__title">телефон:</p>
						<p class="contact__text"><a class="contact__link" href="tel:88121234567">8 (812) 123-45-67</a><a class="contact__link" href="tel:89111234567">8-911-123-45-67</a></p>
					</div>
					<div class="contact hero__item">
						<p class="contact__title">Режим работы:</p>
						<p class="contact__text"> <span class="contact__mobile-line">пн-пт : </span><span class="contact__mobile-line">10:00 - 20:00 </span></p>
						<p class="contact__text"> <span class="contact__mobile-line">сб-вск : </span><span class="contact__mobile-line">12:00 - 20:00</span></p>
					</div>
				</div>
			</section>
			<section class="achievements">
				<div class="container">
					<div class="achievements__content">
						<div class="achievements__item" data-aos="fade-right" data-aos-duration="1000">
							<h2 class="title achievements__title rectangles rectangles_left">Что получите при<br>обращении к нам</h2>
							<div class="achievements__text">
								При обращении к нам вы можете рассчитывать на качественное выполнение работ по детейлингу вашего
								автомобиля. Наши специалисты имеют большой опыт работы и используют только профессиональные средства и
								инструменты.
								<br><br>
								Мы гарантируем индивидуальный подход к каждому клиенту и максимальный результат. Вы получите не только
								чистый и блестящий автомобиль, но и продление его срока службы благодаря защите от внешних воздействий.
							</div>
						</div>
						<div class="achievements__item achievements__item-grid" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="250">
							<!--input#showmore.visually-hidden(type="checkbox")-->
							<div class="achievements__col">
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"> <span>#</span><span>1</span></div>
									<div class="achievement-grid-item__text">Опытный персонал</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>3</span></div>
									<div class="achievement-grid-item__text">Ответственность</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>5</span></div>
									<div class="achievement-grid-item__text">Приятные цены</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>7</span></div>
									<div class="achievement-grid-item__text">Гарантия результата</div>
								</div>
							</div>
							<div class="achievements__col achievements__col_pt_40">
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>2</span></div>
									<div class="achievement-grid-item__text">Качественные материалы</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>4</span></div>
									<div class="achievement-grid-item__text">Безопасность автомобиля</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__number"><span>#</span><span>6</span></div>
									<div class="achievement-grid-item__text">Быстрый сервис</div>
								</div>
								<div class="achievement-grid-item">
									<div class="achievement-grid-item__img-wrapper"><img class="achievement-grid-item__img" src="./img/svg/kubok.svg" aria-hidden="true"></div>
									<div class="achievement-grid-item__text">Лидеры на рынке РФ</div>
								</div>
							</div>
							<!--label.achievements__read-more.btn(for="showmore") Показать ещё-->
						</div>
					</div>
				</div>
			</section>
			<div class="main-slider-section">
				<div class="container-big main-slider-section__container">
					<div class="swiper main-slider">
						<div class="swiper-wrapper">
							<div class="swiper-slide" data-hash="slide1"><img class="main-slider-image" src="img/slide1.jpg" alt="тюнингованные авто">
								<p class="main-slider-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate
									laoreet sapien a sit ante.</p>
							</div>
							<div class="swiper-slide" data-hash="slide2"><img class="main-slider-image" src="img/slide2.jpg" alt="ниссан скайлайн">
								<p class="main-slider-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate
									laoreet sapien a sit </p>
							</div>
							<div class="swiper-slide" data-hash="slide3"><img class="main-slider-image" src="img/slide3.jpg" alt="тюнингованная тачка">
								<p class="main-slider-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate
									laoreet sapien a sit ante</p>
							</div>
							<div class="swiper-slide" data-hash="slide1"><img class="main-slider-image" src="img/slide1.jpg" alt="тюнингованные авто">
								<p class="main-slider-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate
									laoreet sapien a sit ante.</p>
							</div>
							<div class="swiper-slide" data-hash="slide2"><img class="main-slider-image" src="img/slide2.jpg" alt="ниссан скайлайн">
								<p class="main-slider-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate
									laoreet sapien a sit </p>
							</div>
							<div class="swiper-slide" data-hash="slide3"><img class="main-slider-image" src="img/slide3.jpg" alt="тюнингованная тачка">
								<p class="main-slider-text">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate laoreet sapien a sit ante

								</p>
							</div>
						</div>
					</div>
					<svg class="swiper-button-prev main-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
						<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
					</svg>
					<svg class="swiper-button-next main-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g filter="url(#filter0_d_2_277)">
							<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
							<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
						</g>
						<defs>
							<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
								<feFlood flood-opacity="0" result="BackgroundImageFix" />
								<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
								<feOffset dy="4" />
								<feGaussianBlur stdDeviation="2" />
								<feComposite in2="hardAlpha" operator="out" />
								<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
								<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
								<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
							</filter>
						</defs>
					</svg>
				</div>
			</div>
			<section class="advantages">
				<div class="container">
					<div class="advantages__content">
						<h2 class="advantages__title visually-hidden">преимущества</h2>
						<div class="advantages__articles">
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image advantage__image_left_7" src="img/svg/advantages-icon-1.svg" aria="hidden">
									<h3 class="advantage__title">материалы от лучших компаний</h3>
									<div class="advantage__text">Мы используем только высококачественные материалы от лучших мировых
										производителей, чтобы гарантировать нашим клиентам безупречный результат и долговременную защиту их
										автомобилей.
									</div>
								</div>
							</article>
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image advantage__image_top_15" src="img/svg/advantages-icon-2.svg" aria="hidden">
									<h3 class="advantage__title">Опытные мастера</h3>
									<div class="advantage__text">Наши опытные мастера прошли обучение и сертификацию, что позволяет им
										выполнять работы любой сложности. Они знают все тонкости и нюансы детейлинга и готовы предложить
										оптимальное решение для каждого конкретного случая. Доверьтесь профессионалам и ваш автомобиль будет
										выглядеть как новый!
									</div>
								</div>
							</article>
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image" src="img/svg/advantages-icon-3.svg" aria="hidden">
									<h3 class="advantage__title">Гарантия на все виды работы</h3>
									<div class="advantage__text">Мы предоставляем гарантию на все виды выполненных нами работ. Это
										означает, что если вы останетесь недовольны результатом, то мы бесплатно исправим все недочеты. Наша
										главная цель - сделать вас счастливым клиентом, который будет рекомендовать нас своим друзьям и
									</div>
							</article>
						</div>
						<div class="advantages__slider swiper">
							<div class="swiper-wrapper">
								<div class="swiper-slide advantages-slide" data-hash="slide1"><img class="advantages-slide__image" src="img/advantages.jpg" alt="бэха">
									<p class="advantages-slide__text">BMW G30 из 2017в 2023 год<br>
										с оклейкой в плёнку
										<svg class="swiper-button-prev advantages-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide2"><img class="advantages-slide__image" src="img/advantages-2.jpg" alt="мерс">
									<p class="advantages-slide__text">BMW G30 из 2017в 2023 год<br>
										с оклейкой в плёнку
										<svg class="swiper-button-prev advantages-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide2"><img class="advantages-slide__image" src="img/advantages.jpg" alt="бэха">
									<p class="advantages-slide__text">BMW G30 из 2017в 2023 год<br>
										с оклейкой в плёнку
										<svg class="swiper-button-prev advantages-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide3"><img class="advantages-slide__image" src="img/advantages-2.jpg" alt="бэха">
									<p class="advantages-slide__text">BMW G30 из 2017в 2023 год<br>
										с оклейкой в плёнку
										<svg class="swiper-button-prev advantages-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="services" id="services" data-aos="fade-up" data-aos-duration="1000">
				<div class="services__content container">
					<h2 class="services__title title rectangles">Наши услуги</h2>
					<div class="tabs">
						<div class="tabs__buttons">
							<button class="tabs__button btn" data-target="#tab1">Оклейка</button>
							<button class="tabs__button btn" data-target="#tab2">Детейлинг</button>
						</div>
						<div class="tabs__content" id="tab1">
							<svg class="swiper-button-prev services1-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
								<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
							</svg>
							<svg class="swiper-button-next services1-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g filter="url(#filter0_d_2_277)">
									<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
									<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
								</g>
								<defs>
									<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
										<feFlood flood-opacity="0" result="BackgroundImageFix" />
										<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
										<feOffset dy="4" />
										<feGaussianBlur stdDeviation="2" />
										<feComposite in2="hardAlpha" operator="out" />
										<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
										<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
										<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
									</filter>
								</defs>
							</svg>
							<div class="swiper services__slider-1">
								<div class="swiper-wrapper">
									<div class="swiper-slide" data-hash="slide1">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon service-card__icon_top_6" src="img/svg/service-icon-1.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Защитные пленки</h3>
												<div class="service-card__text">Установка защитных пленок на автомобили помогает предотвратить
													появление царапин, сколов и других повреждений</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
									<div class="swiper-slide" data-hash="slide2">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon" src="img/svg/advantages-icon-1.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Цветные пленки</h3>
												<div class="service-card__text">Услуга предполагает оклейку автомобиля специальной виниловой
													пленкой, которая может изменить цвет автомобиля</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
									<div class="swiper-slide" data-hash="slide3">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon service-card__icon_top_12" src="img/svg/advantages-icon-2.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Дизайн</h3>
												<div class="service-card__text">Услуга включает в себя разработку индивидуального дизайна для
													вашего автомобиля, включая выбор цветов, материалов и элементов декора.</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
									<div class="swiper-slide" data-hash="slide4">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon" src="img/svg/advantages-icon-3.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Оклейка салона</h3>
												<div class="service-card__text">Услуга предполагает оклейку внутренних поверхностей автомобиля
													специальной пленкой, которая может изменить цвет материалов салона.</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
								</div>
							</div>
						</div>
						<div class="tabs__content" id="tab2">
							<svg class="swiper-button-prev services2-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
								<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
							</svg>
							<svg class="swiper-button-next services2-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g filter="url(#filter0_d_2_277)">
									<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
									<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
								</g>
								<defs>
									<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
										<feFlood flood-opacity="0" result="BackgroundImageFix" />
										<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
										<feOffset dy="4" />
										<feGaussianBlur stdDeviation="2" />
										<feComposite in2="hardAlpha" operator="out" />
										<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
										<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
										<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
									</filter>
								</defs>
							</svg>
							<div class="swiper services__slider-2">
								<div class="swiper-wrapper">
									<div class="swiper-slide" data-hash="slide1">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon" src="img/svg/service-icon-1.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Защитные пленки</h3>
												<div class="service-card__text">Услуга предполагает оклейку внутренних поверхностей автомобиля
													специальной пленкой, которая может изменить цвет материалов салона.</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
									<div class="swiper-slide" data-hash="slide2">
										<article class="service-card">
											<div class="service-card__content"><img class="service-card__icon" src="img/svg/advantages-icon-1.svg" aria-hidden="true" alt="">
												<h3 class="service-card__title">Цветные пленки</h3>
												<div class="service-card__text">Установка защитных пленок на автомобили помогает предотвратить
													появление царапин, сколов и других повреждений.</div><a class="btn service-card__link" href="service.html">Подробнее</a>
											</div>
										</article>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="advantages advantages_2">
				<div class="container">
					<div class="advantages__content advantages__content-invert">
						<h2 class="advantages__title visually-hidden">преимущества</h2>
						<div class="advantages__articles">
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image" src="img/svg/service-icon-1.svg" aria="hidden">
									<h3 class="advantage__title">100% полироль axem</h3>
									<div class="advantage__text">Полироль Axem 100% - это высококачественный продукт, предназначенный для
										восстановления и защиты поверхности автомобиля. Он содержит 100% карнаубский воск, который известен
										своей способностью придавать поверхности глубокий блеск</div>
								</div>
							</article>
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image advantage__image_left_7" src="img/svg/advantages-icon-1.svg" aria="hidden">
									<h3 class="advantage__title">выполняем работу четко по тз</h3>
									<div class="advantage__text">Мы всегда стремимся точно следовать всем требованиям и пожеланиям
										клиента, указанным в техническом задании. Это помогает нам гарантировать, что конечный результат
										будет полностью соответствовать ожиданиям заказчика.
									</div>
								</div>
							</article>
							<article class="advantage rectangles">
								<div class="advantage__content"><img class="advantage__image advantage__image_top_15" src="img/svg/advantages-icon-2.svg" aria="hidden">
									<h3 class="advantage__title">у нас лучшие мастера</h3>
									<div class="advantage__text">Наши мастера являются настоящими профессионалами своего дела. Они
										обладают всеми необходимыми знаниями и умениями, чтобы выполнить любую задачу качественно и в срок.
										Кроме того, они постоянно совершенствуют свои навыки, чтобы быть в курсе всех новинок и тенденций в
										области детейлинга.
									</div>
								</div>
							</article>
						</div>
						<div class="advantages__slider advantages__slider2 swiper">
							<div class="swiper-wrapper">
								<div class="swiper-slide advantages-slide" data-hash="slide1"><img class="advantages-slide__image" src="img/advantages-2.jpg" alt="мерс">
									<p class="advantages-slide__text">Мега проект. Простенький штатный GLC <br> в мощнейший GLC63 AMG
										Manhart.
										<svg class="swiper-button-prev advantages2-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages2-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide2"><img class="advantages-slide__image" src="img/advantages.jpg" alt="бэха">
									<p class="advantages-slide__text">Мега проект. Простенький штатный GLC<br>в мощнейший GLC63 AMG
										Manhart.
										<svg class="swiper-button-prev advantages2-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages2-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide2"><img class="advantages-slide__image" src="img/advantages-2.jpg" alt="мерс">
									<p class="advantages-slide__text">Мега проект. Простенький штатный GLC<br> в мощнейший GLC63 AMG
										Manhart.
										<svg class="swiper-button-prev advantages2-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages2-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
								<div class="swiper-slide advantages-slide" data-hash="slide3"><img class="advantages-slide__image" src="img/advantages.jpg" alt="бэха">
									<p class="advantages-slide__text">Мега проект. Простенький штатный GLC<br> в мощнейший GLC63 AMG
										Manhart.
										<svg class="swiper-button-prev advantages2-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
											<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
										</svg>
										<svg class="swiper-button-next advantages2-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g filter="url(#filter0_d_2_277)">
												<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
												<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
											</g>
											<defs>
												<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
													<feFlood flood-opacity="0" result="BackgroundImageFix" />
													<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
													<feOffset dy="4" />
													<feGaussianBlur stdDeviation="2" />
													<feComposite in2="hardAlpha" operator="out" />
													<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
													<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
													<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
												</filter>
											</defs>
										</svg>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="works" id="works">
				<div class="works__content" data-aos="fade-up" data-aos-duration="1000">
					<h2 class="works__title title rectangles">Наши работы</h2>
					<div class="works__galery">
						<div class="swiper works__slider">
							<div class="swiper-wrapper">
								<div class="swiper-slide" data-hash="slide1">
									<div class="works__slide"><a class="gallery__item" data-fancybox="gallery" href="img/work-1.jpg"><img src="img/work-1.jpg" alt="ауди"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-2.jpg"><img src="img/work-2.jpg" alt="тойота супра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-3.jpg"><img src="img/work-3.jpg" alt="тойота брз"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-6.jpg"><img src="img/work-6.jpg" alt="бмв"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-5.jpg"><img src="img/work-5.jpg" alt="тойота супра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-4.jpg"><img src="img/work-4.jpg" alt="ламборгини"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-1.jpg"><img src="img/work-1.jpg" alt="ауди"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-2.jpg"><img src="img/work-2.jpg" alt="тойота супра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-3.jpg"><img src="img/work-3.jpg" alt="тойота брз"></a></div>
								</div>
								<div class="swiper-slide" data-hash="slide2">
									<div class="works__slide"><a class="gallery__item" data-fancybox="gallery" href="img/work-4.jpg"><img src="img/work-4.jpg" alt="ламборгини"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-5.jpg"><img src="img/work-5.jpg" alt="тойота супра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-6.jpg"><img src="img/work-6.jpg" alt="бмв"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-3.jpg"><img src="img/work-3.jpg" alt="тойота брз"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-2.jpg"><img src="img/work-2.jpg" alt="тойота супра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-1.jpg"><img src="img/work-1.jpg" alt="ауди"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-4.jpg"><img src="img/work-4.jpg" alt="ламборгини"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-5.jpg"><img src="img/work-5.jpg" alt="тойота бсупра"></a><a class="gallery__item" data-fancybox="gallery" href="img/work-6.jpg"><img src="img/work-6.jpg" alt="бмв"></a></div>
								</div>
							</div>
						</div>
						<svg class="swiper-button-prev works-slider-prev" width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="2.12132" y="35.3553" width="47" height="47" transform="rotate(-45 2.12132 35.3553)" stroke="#DB3138" stroke-width="3" />
							<path d="M39 27.8555L31.5 35.3555L39 42.8555L37.5 45.8555L27 35.3555L37.5 24.8555L39 27.8555Z" fill="white" />
						</svg>
						<svg class="swiper-button-next works-slider-next" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g filter="url(#filter0_d_2_277)">
								<rect x="-2.12132" width="47" height="47" transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 71.0894 33.8553)" stroke="#DB3138" stroke-width="3" />
								<path d="M35.7107 27.8555L43.2107 35.3555L35.7107 42.8555L37.2107 45.8555L47.7107 35.3555L37.2107 24.8555L35.7107 27.8555Z" fill="white" />
							</g>
							<defs>
								<filter id="filter0_d_2_277" x="0" y="0" width="78.7107" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
									<feFlood flood-opacity="0" result="BackgroundImageFix" />
									<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
									<feOffset dy="4" />
									<feGaussianBlur stdDeviation="2" />
									<feComposite in2="hardAlpha" operator="out" />
									<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
									<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_277" />
									<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_277" result="shape" />
								</filter>
							</defs>
						</svg>
					</div>
				</div>
			</section>
			<section class="form-section">
				<div class="form-section__content container" data-aos="flip-down" data-aos-duration="1000">
					<h2 class="form-section__title title rectangles">ответим на любой вопрос</h2>
					<form class="form" id="form" action="#" method="POST">
						<div class="form__row">
							<input class="form__input form__input_email" id="email" type="name" name="name" placeholder="имя" required minlength="3" maxlength="32">
							<input class="form__input form__input_phone" type="tel" name="phone" name="phone" placeholder="телефон" required>
						</div>
						<div class="form__row"><textarea class="form__textarea" name="message" placeholder="Вопрос по дизайну, тюнингу и др." value=""></textarea>
							<ul class="social">
								<li class="social__li social-telegram"><a class="social__link" href="#"><img class="social__icon" src="img/svg/social/telegram.svg" alt="телеграм"></a></li>
								<li class="social__li social-youtube"><a class="social__link" href="#"><img class="social__icon" src="img/svg/social/youtube.svg" alt="ютуб"></a></li>
								<li class="social__li social-vk"><a class="social__link" href="#"><img class="social__icon" src="img/svg/social/vk.svg" alt="вконтакте"></a></li>
							</ul>
						</div>
						<div class="form__row">
							<button name="otpr" class="btn btn form__btn" type="submit">Отправить</button>
							<address>
								<div class="contact-location">г. Москва, ул. Тверская, д. 16, стр. 1.</div><a class="contact-phone contact-phone_top_6" href="tel:88121234567">+7 (545) 454-54-54</a><a class="contact-mail contact-mail_top_6" href="mailto:test@test.ru">test@test.ru</a>
							</address>
						</div>
					</form>
				</div>
			</section>
		</main>
		<footer class="footer">
			<div class="container">
				<div class="footer__content">
					<div class="copy">2024 © CAR MUSC</div>
					<nav class="nav footer__nav" id="footnav">
						<ul class="nav__ul">
							<li class="nav__li"><a class="nav__link" href="index.html">Главная</a></li>
							<li class="nav__li"><a class="nav__link" href="#services">Оклейка автомобилей</a></li>
							<li class="nav__li"><a class="nav__link" href="#services">Детейлинг автомобилей</a></li>
							<li class="nav__li"><a class="nav__link" href="#works">Галерея работ</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</footer>
		<!-- auth -->
		<div class="overlay">
			<div class="popup">
				<div class="bg">
					<h2 class="popup__h2">Авторизация</h2>
					<div class="inp flex">
						<form action="php/login.php" method="POST">
							<label for="Email" class="label">Email</label><br>
							<input type="email" required name="email" class="input"><br>
							<label for="pass" class="label">Password</label><br>
							<input type="password" required name="password" class="input"><br>
							<!-- <a href="account.php"> -->
							<button name="login" class="btn ml">Войти</button>
							<!-- </a><br> -->
						</form>
					</div>
				</div>
				<div class="close-popup"></div>
			</div>
		</div>
		<!--  -->

		<br>
		<!-- register -->
		<div class="overlay2">
			<div class="popup">
				<div class="bg2">
					<h2 class="popup__h2">Регистрация</h2>
					<div class="inp flex">
						<form action="php/register.php" method="POST">
							<label for="name" class="label">Имя</label><br>
							<input type="text" required name="name" class="input"><br>
							<label for="lastname" class="label">Номер Телефона</label><br>
							<input type="text" required name="number" class="input"><br>
							<label for="Email" class="label">Email</label><br>
							<input type="email" required name="email" class="input"><br>
							<label for="pass" class="label">Password</label><br>
							<input type="password" required name="password" class="input"><br>
							<!-- <a href="account.php"> -->
							<button class="btn ml" name="registration">Зарегистрироваться</button>
							<!-- </a><br> -->

						</form>
					</div>
				</div>
				<div class="close-popup2"></div>
			</div>
		</div>
		<!--  -->
	</div>
	<script src="js/app.min.js"></script>
	<script src="js/"></script>
</body>

</html>