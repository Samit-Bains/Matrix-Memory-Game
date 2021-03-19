let tile = [9, 16, 25, 36, 49];
let tilesize = 0;
let correcttiles;
let fail = document.getElementById("fail");
let pass = document.getElementById("next");
let failcounter = false;
let wrongAttempts;
let rightAttempts;
let id;
let points = 0;
let gg = document.getElementById("resultScreen");
let lives = 3;
let livescounter = 0;

function randomNumberGenerator(x) {
	return Math.floor(x * Math.random());
}

function displayCorrectTiles() {
	let rotate = document.getElementById("rotate");
	id = assignTiles();
	for (let i = 0; i < id.length; i++) {
		let x = document.getElementById(id[i]);
		x.classList.add('fliping');
	}
	rotate.classList.remove('rotate');
}


function passing() {
	gg.style.display = "block";
	pass.style.display = "block";
}

function createMatrix() {
	rightAttempts = correcttiles;
	wrongAttempts = numberOfCorrectTiles - rightAttempts;
	document.getElementById('beginning').style.display = 'none';
	timing();
}

function showMatrix(y) {
	for (let i = 0; i <= y; i++) {
		let turnOver = document.createElement('div');
		let face = document.createElement('div');
		let x = document.createElement("div");
		let backside = document.createElement("div");
		x.className = "tile";
		x.id = i;
		x.appendChild(turnOver);
		document.querySelector('.createMatrix').appendChild(x);
		turnOver.appendChild(face);
		backside.className = "backside";
		face.className = "face";
		turnOver.className = "turnOver";
		turnOver.appendChild(backside);
	}
}

function timing() {
	setTimeout(function () {
		displayCorrectTiles()
	}, 500);

	setTimeout(function () {
		deletTiles()
	}, 1500);

	setTimeout(function () {
		rotate()
	}, 3000);
}

function assignTiles() {
	let x = [];
	for (let i = 0; i < correcttiles; i++) {
		let y = randomNumberGenerator(numberOfCorrectTiles);
		if (x.indexOf(y) >= 0) {
			i--;
		} else {
			x[i] = y;
		}
	}
	return x;
}

function nextlevel() {
	if (failcounter == false) {
		if (tilesize < tile.length - 1) {
			tilesize++;
			hideMatrix();
			initialize();
		} else {
			hideMatrix();
			initialize();
		}

	} else {
		if (tilesize == 0) {
			failcounter = false;
			hideMatrix();
			initialize();
		} else {
			failcounter = false;
			hideMatrix();
			initialize();
		}
	}
}

function initialize() {
	numberOfCorrectTiles = tile[tilesize];
	switch (numberOfCorrectTiles) {
		case 9:
			correcttiles = 4;
			break;
		case 16:
			correcttiles = 7;
			break;
		case 25:
			correcttiles = 10;
			break;
		case 36:
			correcttiles = 17;
			break;
		case 49:
			correcttiles = 22;
			break;
	}
	showMatrix(numberOfCorrectTiles - 1);
	console.log(typeof (numberOfCorrectTiles));
	let allTiles = document.querySelectorAll(".tile");
	document.getElementById('beginning').style.display = '';
	allTiles.forEach(item => item.addEventListener('click', function () {
		selectTiles(Number(item.id));
		this.classList.add('fliping');
	}));
	document.getElementById('container').style.width = `${12+100*Math.sqrt(numberOfCorrectTiles)}px`;
	document.getElementById('resultScreen').style.display = 'none';
	document.getElementById('container').classList.add('displayAll');
}

function alertbox() {
	passing();
	alert("you got " + points + " points");
}

function myFunction() {
	var txt;
	if (confirm("Press a button!")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
	document.getElementById("demo").innerHTML = txt;
}

function selectTiles(tile) {
	const elementSeleted = document.getElementById(tile);
	let x = id.indexOf(tile);
	let pointElement = document.getElementById('points');
	let LivesElement = document.getElementById('lives');
	if (!elementSeleted.classList.contains('fliping')) {
		if (x < 0) {
			points -= 1;
			lives -= 1;
			localStorage.setItem("score", points);
			pointElement.innerHTML = `Current Points : ${points}`;
			LivesElement.innerHTML = `Current Lives : ${lives}`;

			wrongAttempts--;

			elementSeleted.querySelector('.backside').style.backgroundColor = "red";
			if (points < 0) {
				alertbox();
				document.getElementById('sound').play();
				LivesElement.innerHTML = `Current Lives : ${lives}`;
			}
			if (lives <= 0) {
				failcounter = true;
				alertbox();
				document.getElementById('sound').play();
				LivesElement.innerHTML = `Current Lives : ${lives}`;
			}
		} else {
			points += 1;
			rightAttempts--;
			localStorage.setItem("score", points);
			elementSeleted.querySelector('.backside').style.backgroundColor = "green";
			pointElement.innerHTML = `Current Points : ${points}`;
			LivesElement.innerHTML = `Current Lives : ${lives}`;
			if (rightAttempts == 0) {
				passing();
				livescounter += 1;
				lives = 3 + livescounter;
				LivesElement.innerHTML = `Current Lives : ${lives}`;
				document.getElementById('sound').play();
			}
		}
	}
}

function deletTiles() {
	let hoverTiles = document.querySelectorAll(".fliping");
	hoverTiles.forEach(item => {
		item.querySelector('.backside').removeAttribute('style');
		item.classList.remove('fliping');
	});
}

function rotate() {
	let rotate = document.getElementById("rotate");
	rotate.classList.add('rotate');
}

function hideMatrix() {
	let x = document.querySelectorAll('.tile');
	document.getElementById('initialpage').style.opacity = '1';
	document.getElementById('container').classList.remove('displayAll');
	console.log(x);
	for (let i = 0; i < x.length; i++) {
		document.querySelector('.createMatrix').removeChild(x[i]);
	}
}
