const DRDoubleSDK = require("./DRDoubleSDK.js");

var d3 = new DRDoubleSDK();

module.exports = d3;

//NODE JS SERVER SETUP
const express = require('express');
const path = require('path');
const app = express();
const bodyParser = require('body-parser');

app.use(express.static(path.join(__dirname)));
console.log(__dirname)

app.get('/', function(request, response) {
    response.sendFile(path.join(__dirname, 'controls.html'));
});


app.listen(3000, function() {
    console.log('Server is running on http://localhost:3000');
});


//ROBOT SETUP
d3.on("connect", () => {
	d3.sendCommand("events.subscribe", {
		events: [
			"DRBase.status",
			"DRCamera.enable",
			"DRCamera.disable"
		]
	});
	d3.sendCommand("screensaver.nudge");
	d3.sendCommand("navigate.enable");
	d3.sendCommand("base.requestStatus");
});

d3.on("event", (message) => {
	switch (message.class +"."+ message.key) {
		case "DRBase.status":
			console.log(message.data);
			break;
		case "DRCamera.enable":
			console.log("camera enabled");
			break;
	}
});

// Shutdown
var alreadyCleanedUp = false;
function exitHandler(options, exitCode) {
	console.log("Exiting with code:", exitCode, "Cleanup:", options.cleanup);

	if (options.cleanup && !alreadyCleanedUp) {
		alreadyCleanedUp = true;
		d3.sendCommand("camera.disable");
	}
	
	if (options.exit) process.exit();
}
process.on('exit', exitHandler.bind(null, {cleanup:true}));
process.on('SIGINT', exitHandler.bind(null, {cleanup:true, exit:true})); // catches ctrl+c event
process.on('SIGTERM', exitHandler.bind(null, {cleanup:true, exit:true})); // catches SIGTERM event
process.on('uncaughtException', exitHandler.bind(null, {cleanup:true, exit:true})); // catches uncaught exceptions

d3.connect();

///////////////////////////

app.use(bodyParser.json());

app.post('/send-command', function(req, res) {
    // Execute the command here
	const command = JSON.parse(req.body.command);

	if (command.params != null) {
		console.log("params");
		console.log(command.command + "," + JSON.stringify(command.params));
		d3.sendCommand(command.command, command.params);
	} else { console.log("no params"); d3.sendCommand(command.command); }
    
    // Respond with a success message
    res.send("Command sent successfully.");
});