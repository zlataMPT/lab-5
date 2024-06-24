var modal = document.getElementById("modal")

// Получаем кнопку, которая открывает модальное окно
var btn = document.querySelector(".button a")

// Получаем элемент <span>, который закрывает модальное окно
var span = document.getElementsByClassName("close-button")[0]

// Когда пользователь нажимает на кнопку, открываем модальное окно
btn.onclick = function () {
	modal.style.display = "block"
}

// Когда пользователь нажимает на <span> (x), закрываем модальное окно
span.onclick = function () {
	modal.style.display = "none"
}

// Когда пользователь нажимает в любом месте вне модального окна, закрываем его
window.onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none"
	}
}