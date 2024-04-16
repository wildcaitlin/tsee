function sendCommand(command) {
	fetch('/send-command', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({ command: command })
	})
	.then(response => response.json())
	.then(data => console.log(data))
	.catch(error => console.error('Error:', error));
}

window.onload = function() {
	
}

document.addEventListener("keydown", function(event) {
	console.log(event.key)
	switch (event.key) {
	case "ArrowUp":
	case "w":
		move('up')
		break;
	case "ArrowLeft":
	case "a":
		move('left')
		break;
	case "ArrowDown":
	case "s":
		move('down')
		break;
	case "ArrowRight":
	case "d":
		move('right')
		break;
	}
});

  function move(direction) {
	switch (direction) {
		case 'up':
			sendCommand(`{"command": "navigate.drive", "params": {"throttle": 1,"turn": 0,"powerDrive": false}}`);
			break;
		case 'left':
			sendCommand(`{"command": "navigate.drive", "params": {"throttle": 0,"turn": -1,"powerDrive": false}}`);
			break;
		case 'right':
			sendCommand(`{"command": "navigate.drive", "params": {"throttle": 0,"turn": 1,"powerDrive": false}}`);
			break;
		case 'down':
			sendCommand(`{"command": "navigate.drive", "params": {"throttle": -1,"turn": 0,"powerDrive": false}}`);
			break;
	}
	
  }


function test() {
	sendCommand(`{"command":"camera.enable", "params":{ "template": "screen" }}`)
}

function retract() {
	sendCommand(`{"command": "base.kickstand.retract"}`)
}

function deploy() {
	sendCommand(`{"command": "base.kickstand.deploy"}`)
}
