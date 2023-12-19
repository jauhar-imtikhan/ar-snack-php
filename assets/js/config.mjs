"use strict";

import { config } from "dotenv";
config();
console.log(process.env.API_KEY);
const firebaseConfig = {
	apiKey: env("apiKey"),
	authDomain: "iot-farm-ffe52.firebaseapp.com",
	databaseURL:
		"https://iot-farm-ffe52-default-rtdb.asia-southeast1.firebasedatabase.app",
	projectId: "iot-farm-ffe52",
	storageBucket: "iot-farm-ffe52.appspot.com",
	messagingSenderId: "1025990914080",
	appId: "1:1025990914080:web:72ed5fd3c98aa5b6878c45",
};
firebase.initializeApp(firebaseConfig);
let db = firebase.database();
