import fetch from 'node-fetch';
import express from 'express';
import asyncHandler from "express-async-handler";

const api = 'http://localhost:3001/api/v2/';

const front = express();
const front_port = 3000;

// FRONT-END

front.get('/', asyncHandler(async (req, res) => {

	let endpoint_scheme =  {
				'current': ['blocks','configuration','hashrate','metadata','miners','network','payments','ports','rounds','transactions','workers'],
                        	'historical': ['blocks','metadata','miners','network','payments','rounds','transactions','workers'],
                        	'combined': ['blocks','rounds']
                               };

	let result = '';

		for (let category in endpoint_scheme) {
			for(let endpoint in endpoint_scheme[category]) {
				let url = `${api}evrmore/${category}/${endpoint_scheme[category][endpoint]}`;
				let response = await fetch(url);
				let data = await response.json();
				result += `${url}<br><br>${JSON.stringify(data.body)}<hr>`;
			}
		}
	res.send(result);
}));

front.listen(front_port, () => {
	console.log(`Front-end started on ${front_port}`);
});
