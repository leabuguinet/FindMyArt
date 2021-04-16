/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './styles/app.css';
import React from "react";
import ReactDOM from 'react-dom';
import App from "./js/app";


const RouteElement = document.getElementById('root');

if(RouteElement){
    ReactDOM.render(<App/>, document.getElementById('root'));
}

//Fonction permettant d'afficher les infos Particulier/Entreprise

function showInfo1() {

        let div = document.getElementById("info1");

        if (div.style.opacity == "0" || div.style.opacity == "") {
                 div.style.opacity = "1";
        } 
        else {
                div.style.opacity = "0";
        }

};

let button = document.getElementById('button1');

button.addEventListener('click', showInfo1);


function showInfo2() {

        let div2 = document.getElementById("info2");

        if (div2.style.opacity == "0" || div2.style.opacity == "") {
                 div2.style.opacity = "1";
        } 
        else {
                 div2.style.opacity = "0";
        }

        
};



let button2 = document.getElementById('button2');
button2.addEventListener('click', showInfo2);